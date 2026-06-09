import { __ } from "@wordpress/i18n";
import { useEffect, useState } from "@wordpress/element";
import { PanelBody, Spinner } from "@wordpress/components";
import { TabControls } from "../../../components";
import { CloseIcon, PopoverCrosseIcon } from "../icons/ui";

const ModulesModal = ({
	moduleName,
	title = "Hello",
	showSidebar,
	setSidebarToggle,
	GeneralTab = null,
	StyleTab = null,
	SettingsTab = null,
	PreviewTab = null,
	settingsValue,
	setSettingsValue,
	updateModuleSettings,
}) => {
	const [activePanel, setActivePanel] = useState(title);
	const [loading, setLoading] = useState(false);

	const sidebarCloseHandler = () => {
		document.querySelector("body").classList.remove("show-module-sidebar-popup");
		setSidebarToggle(false);
	};

	useEffect(() => {
		const closeChangeLog = (e) => {
			if (e.target.classList.contains("show-module-sidebar-popup")) {
				document.querySelector("body").classList.remove("show-module-sidebar-popup");
				setSidebarToggle(false);
			}
		};
		document.addEventListener("click", closeChangeLog);
		return () => document.removeEventListener("click", closeChangeLog);
	}, []);

	useEffect(() => {
		if (!showSidebar) {
			document.querySelector("body").classList.add("show-module-sidebar-popup");
		} else {
			document.querySelector("body").classList.remove("show-module-sidebar-popup");
		}
	}, [showSidebar]);

	useEffect(() => {
		if (!loading) {
			return;
		}
		const timeout = setTimeout(() => {
			setLoading(false);
		}, 500);

		return () => {
			clearTimeout(timeout);
		};
	}, [loading]);

	useEffect(() => {
		const handleKeyDown = (event) => {
			// Check for Ctrl key (or Command key on Mac) and 'S' key
			if ((event.ctrlKey || event.metaKey) && event.key === "s") {
				event.preventDefault();
				updateModuleSettings(settingsValue);
				setLoading(true);
			}
		};

		document.addEventListener("keydown", handleKeyDown);
		return () => {
			document.removeEventListener("keydown", handleKeyDown);
		};
	}, [settingsValue]);

	return (
		<div className={`sp-smart-post-modules-popup-settings-wrapper width-sm`}>
			<div className="sp-smart-post-modules-popup-settings-container">
				<div className="sp-smart-post-sidebar-popup-header">
					<div className="sp-smart-post-sidebar-popup-heading-top">
						<div className="sp-smart-post-sidebar-title">{title}</div>
						<span onClick={sidebarCloseHandler} className="sp-smart-post-sidebar-popup-close">
							<PopoverCrosseIcon />
						</span>
					</div>
				</div>
				<div className="sp-smart-post-sidebar-popup-content">
					<div className="sp-smart-post-module-popup-preview-wrapper">
						{PreviewTab && (
							<PreviewTab attributes={settingsValue} props={{ moduleName, setSettingsValue }} />
						)}
					</div>
					<div className="sp-smart-post-module-popup-sidebar-container">
						<div className="sp-smart-post-module-popup-sidebar-wrapper sp-smart-post-tab-panel">
							<PanelBody
								title={title}
								opened={activePanel === title}
								onToggle={() => setActivePanel(activePanel ? "" : title)}
							>
								{!SettingsTab && activePanel === title && (
									<TabControls
										attributes={settingsValue}
										// setSettingsValue={setSettingsValue}
										GeneralTab={GeneralTab && GeneralTab}
										StyleTab={StyleTab && StyleTab}
										props={{ moduleName, setSettingsValue }}
									/>
								)}
								{SettingsTab && activePanel === title && (
									<SettingsTab
										attributes={settingsValue}
										setSettingsValue={setSettingsValue}
										props={{ moduleName }}
									/>
								)}
							</PanelBody>
						</div>
						<button
							className={`sp-smart-post-module-popup-sidebar-save-btn ${loading ? " is-busy is-disabled" : ""}`}
							onClick={() => {
								updateModuleSettings(settingsValue);
								setLoading(true);
							}}
							disabled={loading}
						>
							{loading
								? __("Saving Changes", "post-carousel")
								: __("Save Changes", "post-carousel")}{" "}
							{loading && (
								<span className="sp-smart-post-module-popup-sidebar-save-btn-spinner">
									<Spinner />
								</span>
							)}
						</button>
					</div>
				</div>
			</div>
		</div>
	);
};
export default ModulesModal;
