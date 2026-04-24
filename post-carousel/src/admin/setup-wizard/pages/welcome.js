import { __ } from "@wordpress/i18n";
import { useState } from "@wordpress/element";
import { FeatureListIcon } from "../../../icons/icons";

const WelcomePage = () => {
	const [showVideo, setShowVideo] = useState(false);
	const featureLists = [
		{
			title: __("160+ Ready Patterns Library", "post-carousel"),
		},
		{
			title: __("60+ Advanced Post & Builder Blocks", "post-carousel"),
		},
		{
			title: __("Seamless Drag & Drop Editing", "post-carousel"),
		},
		{
			title: __("Frontend Filter & Pagination", "post-carousel"),
		},
		{
			title: __("Advanced Query Builder", "post-carousel"),
		},
		
		// second column.
		
		{
			title: __("Customize Everything with Ease", "post-carousel"),
		},
		{
			title: __("Global Settings Control", "post-carousel"),
		},
		{
			title: __("Smart Modules & Functionalities", "post-carousel"),
		},
	];

	function getGreeting() {
		const hour = new Date().getHours();
		if (hour >= 5 && hour < 12) {
			return __("Good morning", "post-carousel");
		}
		if (hour >= 12 && hour < 17) {
			return __("Good afternoon", "post-carousel");
		}
		if (hour >= 17 && hour < 21) {
			return __("Good evening", "post-carousel");
		}
		return __("Good night", "post-carousel");
	}

	return (
		<div className="sp-smart-post-setup-welcome-page">
			<div className="sp-smart-post-setup-welcome-page-left">
				<span className="sp-smart-post-setup-page-subtitle">{getGreeting()}, {sp_pcp_block_settings?.userName || ""}</span>
				<h3 className="sp-smart-post-setup-page-title">Welcome to <span className="sp-smart-post-setup-page-title-highlight">Smart Post!</span></h3>
				<p className="sp-smart-post-setup-page-desc">
					Thanks for installing Smart Post — your all-in-one solution for creating, organizing, and publishing
					content more efficiently inside WordPress.
				</p>
				<p className="sp-smart-post-setup-page-desc">
					Smart Post is an Advanced Gutenberg Blocks Library plugin with <strong>60+ ready-to-use post and smart blocks</strong> to
					showcase your content beautifully. Create stunning layouts like post grid, list, slider, thumbnail
					slider, carousel and additional page builder blocks—all with just a few clicks.
				</p>
				<div className="sp-smart-post-setup-feature-lists">
					{featureLists?.map(({ title }, index) => (
						<div key={index} className="sp-smart-post-setup-feature-list">
							<span className="sp-smart-post-setup-feature-list-icon">
								<FeatureListIcon />
							</span>
							<span className="sp-smart-post-setup-feature-title">{title}</span>
							{/* { index === featureLists.length - 1 && (
								<span className="sp-smart-post-setup-feature-hot">
									Upcoming
								</span>
							) } */}
						</div>
					))}
				</div>
			</div>
			<div
				className="sp-smart-post-setup-welcome-page-right"
				style={{
					backgroundImage: `url(${sp_pcp_block_settings?.wizardImages}thumbnail.png)`,
				}}
			>
				{showVideo ? (
					<iframe
						width="510"
						height="410"
						src="https://www.youtube.com/embed/vnveuaiPBdc?si=2pLSHQVHgpTe9nZS&autoplay=1"
						title="YouTube video player"
						allow="autoplay; encrypted-media"
					></iframe>
				) : (
					<div className="sp-smart-post-setup-video-overlay">
						<button
							id="sp-smart-post-play-btn"
							className="sp-smart-post-play-btn-sonar"
							onClick={() => setShowVideo(true)}
						>
							<img src={`${sp_pcp_block_settings?.wizardImages}video-play-icon.svg`} alt="Smart Post" />
						</button>
					</div>
				)}
			</div>
		</div>
	);
};

export default WelcomePage;
