import { useEffect, useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import useGetChangeLogData from "../hooks/getChangeLogData";
import {
	Arrow,
	LogNoticeIcon,
	Logo,
	SpikerNoticeIcon,
	Support,
	Blog,
	Community,
	DocsStroked,
	FeatRequest,
	GetHelp,
	Roadmap,
	SetupWizard,
	TechSupport,
	Video,
	WhatsNew,
	ChangeLogNoticeIcon,
} from "./icons";
import { CloseIcon } from "../../prebuild-library/icons";

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
];

const Header = ({ page, setPage, modulesOptions }) => {
	const [changeLogToggle, setChangeLogToggle] = useState(false);
	const [changeLodData, setChangeLogData] = useState(null);

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
			if (e.target.classList.contains("show-change-log")) {
				setChangeLogToggle(false);
				document.querySelector("body").classList.remove("show-change-log");
			}
		};
		document.addEventListener("click", closeChangeLog);
		return () => document.removeEventListener("click", closeChangeLog);
	}, []);

	const enabledSavedTemplate = modulesOptions?.some((item) => item.module_name === "saved-template" && item.show);

	useEffect(() => {
		const postMenu = document.getElementById("menu-posts-sp_post_carousel");
		const saveTemplateItem = postMenu?.querySelectorAll("li");

		if(!enabledSavedTemplate) {
			saveTemplateItem[3].style.display = "none";
		}else {
			saveTemplateItem[3].style.display = "block";
		}

	}, [enabledSavedTemplate])

	const tabChange = (e) => {
		const targetValue = e.target.getAttribute( "value" );
		setPage( targetValue );

		const recommendedPage = document.querySelector(".spspc-recommended-page");

		if(!recommendedPage) return;

		if("about-us" === targetValue) {
			recommendedPage.style.display = "block";
		}else{
			recommendedPage.style.display = "none";
		}

	}

	const navigationItems = [
		{
			title: __("Quick Start", "post-carousel"),
			value: "quick-start",
			href: "#",
			show: true,
		},
		{
			title: __("Blocks", "post-carousel"),
			value: "blocks",
			href: "#blocks",
			show: true,
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
			title: __("About Us", "post-carousel"),
			value: "about-us",
			href: "#about-us",
			show: true,
		},
	];

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

			<div className="sp-pcp-blocks-settings-page-header">
				<div className="sp-pcp-blocks-settings-header-area-top">
					<p>
						<span className="sp-pcp-blocks-slogan-icon">
							<SpikerNoticeIcon />
						</span>
						Welcome to{" "}
						<a target="_blank" rel="noreferrer" href="https://wpsmartpost.com/">
							<strong>Smart Post!</strong>
						</a>{" "}
						Rebranded & fully rebuilt with 60+ powerful new blocks.{" "}
						<a
							target="_blank"
							rel="noreferrer"
							href="https://wpsmartpost.com/smart-post-4-0-0-lite-released-ready-patterns-smart-blocks-more/"
						>
							<strong>Explore it now</strong> <Arrow />
						</a>
						{/* 🚀 */}
					</p>
				</div>
				<div className="sp-pcp-blocks-settings-page-header-body">
					<div className="sp-pcp-blocks-settings-page-header-left">
						<Logo />
						<span>{sp_pcp_block_settings.pluginVersion}</span>
						<span onClick={() => changeLogControl()} className="sp-pcp-change-log-notice-icon">
							{/* <ChangeLogNoticeIcon /> */}
							<LogNoticeIcon />
						</span>
					</div>
					<button className="sp-pcp-blocks-settings-page-header-right">
							<GetHelp />

							<span className="get-help">{__("Get Help", "post-carousel")}</span>
							<div className="sp-pcp-help-drop-down">
								{GetHelpItems?.map(
									({ title, link, Icon }, index) => (
										<a
											key={index}
											href={link}
											target="_blank"
											rel="noopener noreferrer"
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
					</button>
				</div>
			</div>
			<div className="sp-smart-post-block-settings-nev">
				<ul>
					{navigationItems?.map(
						({ title, value, href, show }, index) =>
							show && (
								<li key={index}>
									<a
										href={href}
										className={(page === value || "" === page) ? "active" : ""}
										value={value}
										onClick={tabChange}
									>
										{title}
									</a>
								</li>
							)
					)}
				</ul>
			</div>
		</>
	);
};

export default Header;
