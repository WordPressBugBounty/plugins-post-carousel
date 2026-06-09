import { useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import { GeneratorSettingsPageArrow, SiteAvailabilityIcon, AdvancedIcon, ToolsIcon } from "../../../icons/icons";

import { SiteAvailability, Advanced, Tools } from "./SettingsOptions";

import "./setting-styles.scss";

const Settings = (props) => {

	const { setPage } = props;
	const [settingsOptions, setSettingsOptions] = useState(sp_pcp_block_settings?.settings);

	const tabs = [
		{
			label: __("Site Availability", "post-carousel"),
			Icon: SiteAvailabilityIcon,
			value: "site-availability",
			Render: SiteAvailability,
		},
		{
			label: __("Advanced Controls", "post-carousel"),
			Icon: AdvancedIcon,
			value: "advanced",
			Render: Advanced,
		},
		{
			label: __("Tools", "post-carousel"),
			Icon: ToolsIcon,
			value: "tools",
			Render: Tools,
		},
	];

	// Get default tab from hash or use 'license-key'
	const getInitialTab = () => {
		const hash = window.location.hash.replace("#", "");
		const tabValue = hash.split("=")[1];
		return tabValue || "site-availability";
	};

	const [settingTab, setSettingTab] = useState(getInitialTab());

	// Update hash when tab changes
	useEffect(() => {
		window.location.hash = `#settings=${settingTab}`;
	}, [settingTab]);

	// Listen for hash changes (back button, direct URL)
	useEffect(() => {
		const handleHashChange = () => {
			const hash = window.location.hash.replace("#", "");
			const tabValue = hash.split("=")[1];
			if (tabValue) {
				setSettingTab(tabValue);
			}
		};

		window.addEventListener("hashchange", handleHashChange);
		return () => window.removeEventListener("hashchange", handleHashChange);
	}, []);

	return (
		<>
			<section className="sp-pcp-settings-page-container">
				<div className="sp-pcp-setting-tabs">
					<ul>
						{tabs?.map(({ label, value, Icon }) => (
							<li
								key={value}
								className={`sp-pcp-setting-tab ${settingTab === value ? "active" : ""}`}
								onClick={() => setSettingTab(value)}
							>
								<span className="sp-pcp-setting-icon">
									<Icon />
								</span>{" "}
								<span>{label}</span>
							</li>
						))}
					</ul>
					<div className="sp-pcp-setting-tabs-bottom"></div>
				</div>
				<div className="sp-pcp-setting-tab-content">
					{tabs?.map(({ value, Render }) =>
							settingTab === value ? (<>
									<Render
										key={value}
										settingsOptions={settingsOptions}
										setSettingsOptions={setSettingsOptions}
										setPage={setPage}
									/>
								</>) : null

					)}
				</div>
			</section>
			<a
				href={`${sp_pcp_block_settings?.homeUrl}wp-admin/edit.php?post_type=sp_post_carousel&page=pcp_settings`}
				rel="noopener noreferrer"
				className="sp-pcp-classic-settings-page-link"
			>
				Classic Shortcode Generator Setting
				<span className="sp-pcp-classic-settings-page-link-arrow">
					<GeneratorSettingsPageArrow />
				</span>
			</a>
		</>
	);
};

export default Settings;
