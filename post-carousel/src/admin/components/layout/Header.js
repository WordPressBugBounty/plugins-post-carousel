import { useEffect, useState, useRef } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import useGetChangeLogData from "../../hooks/getChangeLogData";
import { Arrow, ArrowRight } from "../icons/navigation";
import { Logo, OurPluginsIcon } from "../icons/brand";
import { LogNoticeIcon, Blog, Community, DocsStroked, FeatRequest, GetHelp, Roadmap, SetupWizard, TechSupport, Video, WhatsNew } from "../icons/ui";
import { CloseIcon } from "../../../prebuild-library/icons";

const GreenCheckIcon = () => (
	<img
		src={`${sp_pcp_block_settings?.pluginUrl}/assets/images/bell-icon.gif`}
		width={18}
		height={18}
		alt=""
	/>
);

const GetHelpItems = [
	{
		title: __("Documentation", "post-carousel"),
		Icon: DocsStroked,
		link: "https://wpsmartpost.com/docs/",
	},
	{
		title: __("Technical Support", "post-carousel"),
		Icon: TechSupport,
		link: "https://shapedplugin.com/create-new-ticket/",
	},
	{
		title: __("Setup Wizard", "post-carousel"),
		Icon: SetupWizard,
		link: `${sp_pcp_block_settings?.homeUrl}wp-admin/admin.php?page=pcp_help#setupwizard`,
	},
	{
		title: __("Public Roadmap", "post-carousel"),
		Icon: Roadmap,
		link: "https://community.shapedplugin.com/roadmap/smart-post/",
	},
	{
		title: __("Request a Feature", "post-carousel"),
		Icon: FeatRequest,
		link: "https://community.shapedplugin.com/portal/space/smartpost/home",
	},
	{
		title: __("Video Tutorials", "post-carousel"),
		Icon: Video,
		link: "https://youtu.be/vnveuaiPBdc?si=B-DH-foeAh9TwjE5",
	},
	{
		title: __("What's New", "post-carousel"),
		Icon: WhatsNew,
		link: "https://wpsmartpost.com/changelog/",
	},
	{
		title: __("Blog: Latest News", "post-carousel"),
		Icon: Blog,
		link: "https://wpsmartpost.com/blog/",
	},
	{
		title: __("Join Community", "post-carousel"),
		Icon: Community,
		link: "https://community.shapedplugin.com/portal/",
	},
	{
		title: __("About Us", "post-carousel"),
		Icon: DocsStroked,
		link: "#about-us",
		value: "about-us",
		internal: true,
	},
];

const Header = ({ page, setPage, modulesOptions }) => {
	const [changeLogToggle, setChangeLogToggle] = useState(false);
	const [changeLodData, setChangeLogData] = useState(null);
	const [showUpgradeNotice, setShowUpgradeNotice] = useState(!!sp_pcp_block_settings?.upgradeNoticeVisible);
	const [activeItemPosition, setActiveItemPosition] = useState({ left: 0, width: 0 });
	const navRef = useRef();
	const itemsRef = useRef({});
	const getHelpRef = useRef();

	const { getChangeLog } = useGetChangeLogData();

	const changeLogControl = async () => {
		if (!changeLodData) {
			const changelog = await getChangeLog();
			setChangeLogData(changelog);
		}
		setChangeLogToggle(!changeLogToggle);
		if (!changeLogToggle) {
			document.querySelector("body").classList.add("show-change-log");
		} else {
			document.querySelector("body").classList.remove("show-change-log");
		}
	};

	useEffect(() => {
		const closeChangeLog = (e) => {
			if (changeLogToggle) {
				const changelogEl = document.querySelector(".sp-pcp-change-log");
				if (changelogEl && !changelogEl.contains(e.target)) {
					setChangeLogToggle(false);
					document.querySelector("body").classList.remove("show-change-log");
				}
			}
		};
		document.addEventListener("click", closeChangeLog);
		return () => document.removeEventListener("click", closeChangeLog);
	}, [changeLogToggle]);

	const enabledSavedTemplate = modulesOptions?.some((item) => item.module_name === "saved-template" && item.show);

	useEffect(() => {
		const postMenu = document.getElementById("menu-posts-sp_post_carousel");
		if (!postMenu) {
			return;
		}
		const saveTemplateItem = postMenu?.querySelectorAll("li");

		if (saveTemplateItem && saveTemplateItem.length > 3) {
			if (!enabledSavedTemplate) {
				saveTemplateItem[3].style.display = "none";
			} else {
				saveTemplateItem[3].style.display = "block";
			}
		}

		// Initialize recommended plugins wrapper visibility on mount
		const pluginsContainer = document.querySelector(".spspc-recommended-page");
		if (pluginsContainer) {
			if (page === "our-plugins") {
				pluginsContainer.style.display = "block";
			} else {
				pluginsContainer.style.display = "none";
			}
		}
	}, [enabledSavedTemplate, page]);

	// Update sliding indicator position when current page changes
	useEffect(() => {
		if (page === "about-us") {
			// Position indicator below Get Help button
			const getHelpEl = getHelpRef.current;
			const nav = navRef.current;
			if (getHelpEl && nav) {
				const navRect = nav.getBoundingClientRect();
				const getHelpRect = getHelpEl.getBoundingClientRect();
				setActiveItemPosition({
					left: getHelpRect.left - navRect.left,
					width: getHelpRect.width,
				});
			}
		} else if (itemsRef.current[page]) {
			// Position indicator below nav item
			const item = itemsRef.current[page];
			const nav = navRef.current;
			if (item && nav) {
				const navRect = nav.getBoundingClientRect();
				const itemRect = item.getBoundingClientRect();
				setActiveItemPosition({
					left: itemRect.left - navRect.left,
					width: itemRect.width,
				});
			}
		}

		// Show/hide recommended plugins wrapper based on active page
		const pluginsContainer = document.querySelector(".spspc-recommended-page");
		if (pluginsContainer) {
			if (page === "our-plugins") {
				pluginsContainer.style.display = "block";
			} else {
				pluginsContainer.style.display = "none";
			}
		}
	}, [page]);

	const tabChange = (e) => {
		e.preventDefault();
		const targetLink = e.currentTarget.closest("a");
		const targetValue = targetLink.getAttribute("value");
		setPage(targetValue);
		window.location.hash = targetValue;
	};

	// Permanently dismiss the upgrade notice: hide it immediately and persist the
	// choice via AJAX so it never shows again on subsequent page loads.
	const dismissUpgradeNotice = () => {
		setShowUpgradeNotice(false);

		const formData = new FormData();
		formData.append("action", "sp_pcp_dismiss_upgrade_notice");
		formData.append("nonce", sp_pcp_block_settings?.nonce);
		formData.append("dismissed", true);

		fetch(ajaxurl, { method: "POST", body: formData }).catch(() => {});
	};

	const navigationItems = [
		{
			title: __("Dashboard", "post-carousel"),
			value: "quick-start",
			href: "#",
			show: true,
		},
		{
			title: __("Blocks", "post-carousel"),
			value: "blocks",
			href: "#blocks",
			show: true,
			badge: __("NEW!", "post-carousel"),
		},
		{
			title: __("Modules", "post-carousel"),
			value: "modules",
			href: "#modules",
			show: true,
		},
		{
			title: __("Saved Templates", "post-carousel"),
			value: "savedTemplate",
			href: "#savedTemplate",
			show: enabledSavedTemplate,
		},
		{
			title: __("Integrations", "post-carousel"),
			value: "integrations",
			href: "#integrations",
			show: true,
		},
		{
			title: __("Settings", "post-carousel"),
			value: "settings",
			href: "#settings",
			show: true,
		},
		{
			title: __("Lite vs Pro", "post-carousel"),
			value: "lite-vs-pro",
			href: "#lite-vs-pro",
			show: true,
		},
		{
			title: __("Our Plugins", "post-carousel"),
			value: "our-plugins",
			href: "#our-plugins",
			show: true,
			icon: <OurPluginsIcon />,
		},
	];

	const getNavDividerClass = (value) => {
		if (value === "lite-vs-pro") {
			return "sp-pcp-nav-divider";
		}
		if (value === "our-plugins") {
			return "sp-pcp-nav-item-with-icon";
		}
		return "";
	};

	return (
		<>
			<div className="sp-pcp-change-log">
				<div className="sp-pcp-change-log-header">
					<h4>Latest Updates - Changelog</h4>
					<span onClick={() => changeLogControl()} className="sp-pcp-change-log-close">
						<CloseIcon />
					</span>
				</div>
				{changeLodData && (
					<div
						className="sp-smart-changelog-details"
						dangerouslySetInnerHTML={{
							__html: changeLodData?.changelog,
						}}
					/>
				)}
				{!changeLodData && changeLogToggle && (
					<div className="sp-smart-changelog-details">
						<p>Loading....</p>
					</div>
				)}
			</div>

			{/* Upgrade Notice with Close Button */}
			{showUpgradeNotice && (
				<div className="sp-pcp-green-header-notice">
					<div className="sp-pcp-green-header-notice-content">
						<GreenCheckIcon />
						<span className="sp-pcp-green-header-notice-text">
							You're currently using <strong>Smart Post Lite</strong>. To access additional features, consider
						</span>
						<a
							className="sp-pcp-green-header-notice-link"
							href="https://wpsmartpost.com/pricing/?ref=1"
							target="_blank"
							rel="noopener noreferrer"
						>
							{__("Upgrade to Pro", "post-carousel")}
							<ArrowRight />
						</a>
						<button
							className="sp-pcp-green-header-notice-close"
							onClick={dismissUpgradeNotice}
							type="button"
						>
							<CloseIcon />
						</button>
					</div>
				</div>
			)}

			{/* Header with Three-Column Layout */}
			<div className="sp-pcp-blocks-settings-page-header">
				<div className="sp-pcp-block-setting-header-wrapper">
					{/* Left: Logo + Version */}
					<div className="sp-pcp-blocks-settings-page-header-left">
						<Logo />
						<span onClick={() => changeLogControl()} className="sp-pcp-plugin-version">
							<LogNoticeIcon /> {sp_pcp_block_settings.pluginVersion}
						</span>
					</div>

					{/* Center: Navigation with Sliding Indicator */}
					<div className="sp-pcp-admin-dashboard-nav" ref={navRef}>
						<span
							className="sp-pcp-nav-sliding-indicator"
							style={{ left: `${activeItemPosition.left}px`, width: `${activeItemPosition.width}px` }}
						></span>
						<ul>
							{navigationItems?.map(
								({ title, value, href, show, badge, icon }, index) =>
									show && (
										<li
											key={index}
											className={getNavDividerClass(value)}
											ref={(el) => (itemsRef.current[value] = el)}
										>
											<a
												href={href}
												className={page === value ? "active" : ""}
												value={value}
												onClick={tabChange}
											>
												{icon}
												{title}
												{badge && (
													<span className="sp-pcp-nav-badge">{badge}</span>
												)}
											</a>
										</li>
									)
							)}
						</ul>
					</div>

					{/* Right: Get Help */}
					<div
						ref={getHelpRef}
						className={`sp-pcp-blocks-settings-page-header-right${page === "about-us" ? " active" : ""}`}
					>
						<GetHelp />
						<span className="get-help">{__("Get Help", "post-carousel")}</span>
						<div className="sp-pcp-help-drop-down">
							{GetHelpItems?.map(
								({ title, link, Icon, internal, value }, index) => (
									<a
										key={index}
										href={link}
										{...(!internal && { target: "_blank", rel: "noopener noreferrer" })}
										{...(internal && {
											onClick: (e) => {
												e.preventDefault();
												setPage(value);
												window.location.hash = value;
											}
										})}
									>
										<Icon />
										<span>{title}</span>
										<span className="drop-down-arrow">
											<Arrow />
										</span>
									</a>
								)
							)}
						</div>
					</div>
				</div>
			</div>
		</>
	);
};

export default Header;
