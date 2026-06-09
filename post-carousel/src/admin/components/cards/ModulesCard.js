import Toggle from "react-toggle";
import { Demos, Docs, GearIcon } from "../icons/ui";
import { useEffect, useRef, useState } from "@wordpress/element";
import ModulesModal from "../modals/SidebarModal";
import apiFetch from "@wordpress/api-fetch";
import { Popover } from "@wordpress/components";
import ProBadge from "../badges/ProBadge";

const ModulesCard = ({ data, moduleName, blockShowHideHandler, value, isDisabled = false, type = "" }) => {
	const [sidebarToggle, setSidebarToggle] = useState(false);
	const { Icon, title, text, docsLink, demoLink, pro = false } = data;
	const disabledClass = isDisabled ? " sp-disabled" : "";

	const [settingsValue, setSettingsValue] = useState({});

	const cardRef = useRef(null);
	const popoverRef = useRef(null);
	const exitTimeoutRef = useRef(null);
	const [showTooltip, setShowTooltip] = useState(false);

	useEffect(() => {
		const fetchPost = async () => {
			try {
				const fetchedAttr = await apiFetch({ path: "sp-smart-post/v2/get-module-settings" });
				if (fetchedAttr) {
					setSettingsValue(fetchedAttr?.[moduleName] || {});
				}
			} catch (error) {
				console.log(error);
			}
		};
		fetchPost();
	}, []);

	const updateModuleSettings = async (updateModule) => {
		try {
			await apiFetch({
				path: "sp-smart-post/v2/set-module-settings",
				method: "POST",
				headers: { "Content-Type": "application/json" },
				body: JSON.stringify({
					...updateModule,
					module_name: moduleName,
				}),
			});
		} catch (error) {
			console.log("Failed ", error);
		}
	};

	// const mouseEnterControl = () => {

	// 	if (exitTimeoutRef.current) {
	// 		clearTimeout(exitTimeoutRef.current);
	// 		exitTimeoutRef.current = null;
	// 	}

	// 	if (popoverRef.current) {
	// 		const popover = popoverRef.current.closest(".sp-pcp-module-popover");
	// 		popover?.classList.remove("is-exiting");
	// 	}

	// 	setShowTooltip(true);
	// };

	// const mouseLeaveControl = () => {
	// 	if (popoverRef.current) {
	// 		const popover = popoverRef.current.closest(".sp-pcp-module-popover");
	// 		popover?.classList.add("is-exiting");
	// 	}

	// 	exitTimeoutRef.current = setTimeout(() => {
	// 		setShowTooltip(false);
	// 	}, 400);
	// };

	return (
		<>
			<div 
				ref={cardRef} 
				className={`sp-pcp-blocks-settings-card ${type}${disabledClass}${pro ? " sp-pcp-pro-card" : ""}`}
				// onMouseEnter={mouseEnterControl}
				// onMouseLeave={mouseLeaveControl}
			>
				{/* {("setup-wizard" === type && showTooltip) && <Popover
					anchor={cardRef.current}
					onClose={() => setShowTooltip(false)}
					placement="top"
					flip={false}
					className="sp-pcp-module-popover"
					ref={popoverRef}
				>
					<div className="sp-tooltip-body">
						{text}
					</div>
				</Popover>} */}

				{pro && <ProBadge />}
				<div className="sp-pcp-blocks-settings-card-info">
					<div className={`sp-pcp-blocks-settings-card-icon sp-${moduleName}`}>
						<Icon />
					</div>
					<div className="sp-pcp-blocks-settings-card-docs">
						<h4>{title}</h4>
						{("setup-wizard" !== type && "quick-start" !== type) && <>
							<span>{text}</span>
							<ul>
								{docsLink && (
									<li>
										<a target="_blank" href={docsLink} rel="noreferrer">
											<Docs /> Docs
										</a>
									</li>
								)}
								{demoLink && (
									<li>
										<a target="_blank" href={demoLink} rel="noreferrer">
											<Demos /> Demo
										</a>
									</li>
								)}
							</ul>
						</>}
					</div>
				</div>

				<div className="sp-pcp-blocks-settings-toggle-btn">
					<Toggle
						defaultChecked={pro ? false : value}
						icons={false}
						onChange={() => blockShowHideHandler(moduleName, "modules-option")}
						disabled={isDisabled}
					/>
								{("setup-wizard" !== type && "quick-start" !== type && data?.settings) && (
						<div
							className="sp-smart-post-sidebar-popup-toggle"
							onClick={() => setSidebarToggle((prev) => !prev)}
						>
							<GearIcon />
						</div>
					)}
				</div>
			</div>
			{sidebarToggle && settingsValue && Object.keys(settingsValue?.options || {}).length > 0 && (
				<>
					<ModulesModal
						title={data.title}
						moduleName={moduleName}
						sidebarToggle={sidebarToggle}
						setSidebarToggle={setSidebarToggle}
						GeneralTab={data?.General && data.General}
						StyleTab={data?.Style && data.Style}
						SettingsTab={data?.SettingsTab && data.SettingsTab}
						PreviewTab={data?.Preview && data.Preview}
						updateModuleSettings={updateModuleSettings}
						settingsValue={settingsValue}
						setSettingsValue={setSettingsValue}
					/>
				</>
			)}
		</>
	);
};

export default ModulesCard;
