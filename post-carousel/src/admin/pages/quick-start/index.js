import { useState, useEffect, useMemo } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import Card from "../../components/cards/Card";
import ProModal from "../../components/modals/ProModal";
import { cardData } from "../blocks";
import useTotalSaveTemplate from "../../hooks/getSaveTemplateCount";
import { priceLink } from "../../../blocks/shared/helpFn";
import Modules from "../modules";
import {
	PlayIcon,
	ArrowRight,
	DocIcon,
	SupportIcon,
	TeamIcon,
	ProIconLight,
	BlocksProIcon,
	PatternsProIcon,
	FilterIcon,
	QueryIcon,
	WishlistIcon,
	CartIcon,
	TaxonomyIcon,
	RefreshIcon,
	FeaturedPostIcon,
} from "../shared/icon";

// Blocks to display in quick start grid (first 10 blocks)
const quickStartBlocks = [
	"post-carousel",
	"post-slider",
	"thumbnail-slider",
	"post-grid-one",
	"post-grid-two",
	"post-list-one",
	"post-timeline-one",
	"news-ticker",
	"taxonomy",
	"smart-search",
	"table-of-content",
	"smart-info-box",
];

// Modules to display in quick start grid (first 4 modules)
const quickStartModules = [
	"saved-template",
	"template-library",
	"back-to-top",
	"taxonomy",
];

// Pro features list
const proFeatures = [
	{
		icon: <FeaturedPostIcon />,
		label: __("Advanced Posts Query Builder", "post-carousel"),
		hot: true,
	},
	{
		url: "https://wpsmartpost.com/blocks/#demoId3647",
		icon: <FeaturedPostIcon />,
		label: __("Smart Frontend Live Filter & Search", "post-carousel"),
		hot: true,
	},
	{
		icon: <FeaturedPostIcon />,
		label: __("Custom Archive & Single Post Builder", "post-carousel"),
		// hot: true,
	},
	{
		icon: <FeaturedPostIcon />,
		label: __("Build Reusable Templates", "post-carousel"),
		hot: true,
	},
	{
		url: "https://wpsmartpost.com/patterns/",
		icon: <FeaturedPostIcon />,
		label: __("250+ Ready Designs/Patterns Library", "post-carousel"),
	},
	{
		url: "https://wpsmartpost.com/blocks/",
		icon: <FeaturedPostIcon />,
		label: __("60+ Gutenberg Blocks", "post-carousel"),
	},
	{
		url: "https://wpsmartpost.com/blocks/#demoId3511",
		icon: <FeaturedPostIcon />,
		label: __("Modern Post Grid, List, Slider Layouts", "post-carousel"),
		// hot: true,
	},
	{
		url: "https://wpsmartpost.com/blocks/#demoId3514",
		icon: <FeaturedPostIcon />,
		label: __("Post Featured Video & Gallery Images", "post-carousel"),
	},
	{
		url: "https://wpsmartpost.com/blocks/#demoId3514",
		icon: <FeaturedPostIcon />,
		label: __("Post Highlights & Badges", "post-carousel"),
		hot: true,
	},
	{
		url: "https://wpsmartpost.com/blocks/#demoId3604",
		icon: <FeaturedPostIcon />,
		label: __("Custom Taxonomy Image & Color", "post-carousel"),
	},
	{
		icon: <FeaturedPostIcon />,
		label: __("Post Content Drag & Drop Sorting", "post-carousel"),
	},
	{
		icon: <FeaturedPostIcon />,
		label: __("Pre-made Starter Sites (Upcoming)", "post-carousel"),
	},
];

// Helper: Capitalize first letter
const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1);

const QuickStart = ({ blocksSettings, blockShowHideHandler, setPageAndHash, modulesOptions }) => {
	const [isVideoModalOpen, setIsVideoModalOpen] = useState(false);
	const [userName, setUserName] = useState("");
	const [isOpen, setOpen] = useState(false);

	const openModal = () => setOpen(true);
	const closeModal = () => setOpen(false);

	const { totalSaveTemplate } = useTotalSaveTemplate();

	// Memoized greeting based on time of day
	const greeting = useMemo(() => {
		const hour = new Date().getHours();
		if (hour < 12) return __("Good morning", "post-carousel");
		if (hour < 17) return __("Good afternoon", "post-carousel");
		if (hour < 21) return __("Good evening", "post-carousel");
		return __("Good night", "post-carousel");
	}, []);

	// Fetch user name on mount
	useEffect(() => {
		const getUserName = () => {
			// Priority: Localized data
			if (sp_pcp_block_settings?.userName) {
				return capitalize(sp_pcp_block_settings.userName);
			}

			// Fallback: wp.data store
			try {
				const store = wp.data?.select("core");
				if (store) {
					const user = store.getCurrentUser?.() || store.currentUser;
					return user?.display_name || user?.name || "";
				}
			} catch {
				// Silent fail
			}

			return "";
		};

		const name = getUserName();
		if (name) {
			setUserName(`, ${name}`);
		}
	}, []);

	const handleViewMoreBlocks = (page) => {
		setPageAndHash(page || "blocks");
	};

	const addNewTemplate = async (e, url = `${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template&spblock_inserter=true`) => {
		e.preventDefault();

		const totalTemplate = await totalSaveTemplate();

		if (totalTemplate >= 2) {
			openModal();
		} else {
			window.location.href = url;
		}
	};

	return (
		<div className="sp-pcp-settings-getting-start-page">
			<div className="sp-pcp-settings-getting-start-page-content">
				{/* Left Side */}
				<div className="sp-pcp-qs-left">
					{/* About Section */}
					<div className="sp-pcp-qs-about-section">
						<div className="sp-pcp-qs-about-content">
							<div className="sp-pcp-qs-about-text">
								<p className="sp-pcp-qs-greeting">{greeting + userName}</p>
								<h3 className="sp-pcp-qs-welcome-title">
									{__("Welcome to Smart Post!", "post-carousel")}
								</h3>
								<p className="sp-pcp-qs-welcome-desc">
									{__(
										"Thank you for installing Smart Post! This video will help you get started with the plugin. Enjoy!",
										"post-carousel"
									)}
								</p>
								<a
									href={`${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template&spblock_inserter=true`}
									onClick={addNewTemplate}
									className="sp-pcp-qs-create-btn"
								>
									<i className="dashicons dashicons-plus-alt2"></i>
									{__("Add Your First Layout", "post-carousel")}
								</a>
							</div>
							<div className="sp-pcp-qs-video-wrapper">
								<div className="sp-pcp-qs-video-placeholder">
										<img
											src={`${sp_pcp_block_settings?.pluginUrl || ""}/admin/assets/img/video-overlay.png`}
											alt=""
										/>
									</div>
								<button className="sp-pcp-qs-play-btn" onClick={() => setIsVideoModalOpen(true)}>
									<PlayIcon color={"rgba(100, 29, 215, 1)"} />
								</button>
							</div>
						</div>
					</div>

					{/* Post Carousel Blocks Section */}
					<div className="sp-pcp-qs-blocks-section">
						<div className="sp-pcp-qs-section-header">
							<h3 className="sp-pcp-qs-section-title">{__("Layout & Builder Blocks", "post-carousel")}</h3>
							<button className="sp-pcp-qs-view-more-btn" onClick={() => {
								setPageAndHash("blocks");
								setTimeout(() => window.scrollTo(0, 0), 100);
							}}>
								{__("View All Blocks", "post-carousel")}
								<ArrowRight />
							</button>
						</div>
						<div className="sp-pcp-qs-blocks-grid sp-post-carousel-settings-card-wrapper">
							{quickStartBlocks.map((blockName) => {
								const card = cardData[blockName];
								if (!card) {
									return null;
								}
								return (
									<Card
										key={blockName}
										blockName={blockName}
										attributes={card}
										blocksSettings={blocksSettings}
										blockShowHideHandler={blockShowHideHandler}
										type="quick-start"
									/>
								);
							})}
						</div>
						<div className="sp-pcp-qs-blocks-gradient"></div>
					</div>

					{/* Modules Section */}
					<div className="sp-pcp-qs-modules-page">
						<div className="sp-pcp-qs-section-header">
								<h3 className="sp-pcp-qs-section-title">{__("Modules", "post-carousel")}</h3>
							<button className="sp-pcp-qs-view-more-btn" onClick={() => {
								setPageAndHash("modules");
								setTimeout(() => window.scrollTo(0, 0), 100);
							}}>
									{__("Manage All Modules", "post-carousel")}
								<ArrowRight />
							</button>
						</div>
						<div className="sp-pcp-qs-modules-grid">
							<Modules
								modulesOptions={modulesOptions}
								blockShowHideHandler={blockShowHideHandler}
								type="quick-start"
								filterModules={quickStartModules}
							/>
						</div>
						<div className="sp-pcp-qs-modules-gradient"></div>
						</div>

					{/* Video Tutorials Section */}
					<div className="sp-pcp-qs-tutorials-section">
						<div className="sp-pcp-qs-section-header">
							<h3 className="sp-pcp-qs-section-title">{__("Video Tutorials", "post-carousel")}</h3>
							<a
								href="https://www.youtube.com/watch?v=_WxI7oyxdPA&list=PLoUb-7uG-5jMKaIryd6B0d41Lafvx4UF5"
								target="_blank"
								rel="noreferrer"
								className="sp-pcp-qs-view-more-btn"
							>
								{__("View More Tutorials", "post-carousel")}
								<ArrowRight />
							</a>
						</div>
						<div className="sp-pcp-qs-tutorials-grid">
							<div className="sp-pcp-qs-tutorial-card">
								<div className="sp-pcp-qs-tutorial-video">
									<iframe
										width="560"
										height="315"
										src="https://www.youtube.com/embed/_WxI7oyxdPA?si=LiF0ANuFWMq_UmUy"
										title="YouTube video player"
										frameBorder="0"
										allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
										referrerPolicy="strict-origin-when-cross-origin"
										allowFullScreen
									></iframe>
								</div>
								<h4 className="sp-pcp-qs-tutorial-title">
									{__("How to Use Smart Post Gutenberg Blocks", "post-carousel")}
								</h4>
							</div>
							<div className="sp-pcp-qs-tutorial-card">
								<div className="sp-pcp-qs-tutorial-video">
									<iframe
										width="560"
										height="315"
										src="https://www.youtube.com/embed/ked_hHmjRow?si=i9ayd25U6qxVBw_J"
										title="YouTube video player"
										frameBorder="0"
										allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
										referrerPolicy="strict-origin-when-cross-origin"
										allowFullScreen
									></iframe>
								</div>
								<h4 className="sp-pcp-qs-tutorial-title">
									{__("How to Use Smart Post Blocks in Elementor", "post-carousel")}
								</h4>
							</div>
						</div>
					</div>
				</div>

				{/* Right Side - Sidebar */}
				<div className="sp-pcp-qs-sidebar">
					{/* Patterns Library Card */}
					<div className="sp-pcp-qs-patterns-card">
						<div className="sp-pcp-qs-patterns-image">
							<div className="sp-pcp-qs-patterns-bg"></div>
							<div className="sp-pcp-qs-patterns-cards-placeholder">
								<img
									src={`${sp_pcp_block_settings?.pluginUrl || ""}/admin/assets/img/patterns-card.png`}
									alt=""
								/>
							</div>
							<span className="sp-pcp-qs-hot-tag">{__("Hot", "post-carousel")}</span>
							<div className="sp-pcp-qs-patterns-gradient">
								<span className="sp-pcp-qs-patterns-text">
									{__("250+ Patterns Library", "post-carousel")}
								</span>
							</div>
						</div>
						<div className="sp-pcp-qs-patterns-content">
							<h4 className="sp-pcp-qs-patterns-title">
								{__("Ready Patterns Made Easy", "post-carousel")}
							</h4>
							<p className="sp-pcp-qs-patterns-desc">
								{__(
									"Choose from beautifully crafted layouts and launch stunning post layouts in seconds.",
									"post-carousel"
								)}
							</p>
							<div className="sp-pcp-qs-patterns-btn-wrapper">
								<a
									href={`${sp_pcp_block_settings?.homeUrl}wp-admin/post-new.php?post_type=sp_post_template&sp_pcp_pattern_library`}
									onClick={(e) => addNewTemplate(e, `${sp_pcp_block_settings?.homeUrl}wp-admin/post-new.php?post_type=sp_post_template&sp_pcp_pattern_library`)}
									className="sp-pcp-qs-patterns-btn"
								>
									{__("Start with Ready Patterns", "post-carousel")}
								</a>
							</div>
						</div>
					</div>

					{/* Go Pro Card */}
					<div className="sp-pcp-qs-pro-card">
						<div className="sp-pcp-qs-pro-content">
							<div className="sp-pcp-qs-pro-header">
								<h4 className="sp-pcp-qs-pro-title">
									{__("Go Pro & Unlock More! 🚀", "post-carousel")}
								</h4>
								<p className="sp-pcp-qs-pro-desc">
									{__(
										"Unlock the full potential of Smart Post Pro and build beautiful blog & news layouts in minutes.",
										"post-carousel"
									)}
								</p>
							</div>
							<div className="sp-pcp-qs-pro-features">
								{proFeatures.map((feature, index) => {
									const FeatureComponent = feature.url ? "a" : "span";
									const featureProps = feature.url
										? { href: feature.url, target: "_blank", rel: "noreferrer" }
										: {};
									return (
										<FeatureComponent
											key={index}
											{...featureProps}
											className="sp-pcp-qs-pro-feature"
										>
											<span className="sp-pcp-qs-pro-icon">
												{feature.icon}
											</span>
											<span>
												{feature.label}
												{feature.hot && " 🔥"}
											</span>
											{feature.url && <ArrowRight className="sp-pcp-qs-pro-feature-arrow" />}
										</FeatureComponent>
									);
								})}
							</div>
							<div className="sp-pcp-qs-pro-buttons">
								<a
									href="https://wpsmartpost.com/pricing/?ref=1"
									target="_blank"
									rel="noreferrer"
									className="sp-pcp-qs-pro-upgrade-btn"
								>
									<ProIconLight />
									{__("Upgrade to Pro", "post-carousel")}
								</a>
								<button
									onClick={() => {
										setPageAndHash("lite-vs-pro");
										setTimeout(() => window.scrollTo(0, 0), 100);
									}}
									className="sp-pcp-qs-pro-compare-btn"
								>
									{__("Lite vs Pro", "post-carousel")}
								</button>
							</div>
						</div>
					</div>

					{/* Documentation Card */}
					<div className="sp-pcp-qs-info-card">
						<div className="sp-pcp-qs-info-header">
							<div className="sp-pcp-qs-info-icon">
								<DocIcon />
							</div>
							<h4 className="sp-pcp-qs-info-title">{__("Documentation", "post-carousel")}</h4>
						</div>
						<div className="sp-pcp-qs-info-content-wrapper">
							<p className="sp-pcp-qs-info-desc">
								{__(
									"Explore Smart Post plugin capabilities in our enriched documentation.",
									"post-carousel"
								)}
							</p>
							<div className="sp-pcp-qs-info-link-wrapper">
								<a
									href="https://wpsmartpost.com/docs/"
									target="_blank"
									rel="noreferrer"
									className="sp-pcp-qs-info-link"
								>
									{__("Browse Now", "post-carousel")}
									<ArrowRight />
								</a>
							</div>
						</div>
					</div>

					{/* Community Card */}
					<div className="sp-pcp-qs-info-card">
						<div className="sp-pcp-qs-info-header">
							<div className="sp-pcp-qs-info-icon">
								<TeamIcon />
							</div>
							<h4 className="sp-pcp-qs-info-title">{__("Join The Community", "post-carousel")}</h4>
						</div>
						<div className="sp-pcp-qs-info-content-wrapper">
							<p className="sp-pcp-qs-info-desc">
								{__(
									"Join the official ShapedPlugin Community to share your experiences, thoughts, and ideas.",
									"post-carousel"
								)}
							</p>
							<div className="sp-pcp-qs-info-link-wrapper">
								<a
									href="https://community.shapedplugin.com/portal/space/smartpost/home"
									target="_blank"
									rel="noreferrer"
									className="sp-pcp-qs-info-link"
								>
									{__("Join Now", "post-carousel")}
									<ArrowRight />
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			{/* Video Modal */}
			{isVideoModalOpen && (
				<div className="sp-pcp-qs-video-modal" onClick={() => setIsVideoModalOpen(false)}>
					<div className="sp-pcp-qs-video-modal-content" onClick={(e) => e.stopPropagation()}>
						<button className="sp-pcp-qs-video-modal-close" onClick={() => setIsVideoModalOpen(false)}>
							×
						</button>
						<div className="sp-pcp-qs-video-modal-wrapper">
							<iframe
								width="100%"
								height="100%"
								src="https://www.youtube.com/embed/_WxI7oyxdPA?si=LiF0ANuFWMq_UmUy&autoplay=1"
								title="YouTube video player"
								frameBorder="0"
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
								allowFullScreen
							></iframe>
						</div>
					</div>
				</div>
			)}

			{/* Pro Modal */}
			<ProModal
				isOpen={isOpen}
				onClose={closeModal}
				hasPostCarouselPosts={false}
				onViewMoreBlocks={handleViewMoreBlocks}
			/>
		</div>
	);
};

export default QuickStart;
