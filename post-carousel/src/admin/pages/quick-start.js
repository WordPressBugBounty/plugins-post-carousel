import {
	Arrow,
	CommunityIcon,
	DocIcon,
	FbIcon,
	LoveIcon,
	ReviewStarIcon,
	SupportIcon,
	WpIcon,
	XIcon,
	YouTubeIcon,
} from "../template-parts/icons";

const QuickStart = () => {
	return (
		<div className="sp-pcp-block-settings-start-page">
			<div className="sp-pcp-block-settings-start-page-wrapper">
				<div className="sp-pcp-video-section">
					<div className="sp-pcp-video-section-text">
						<h3>Welcome to Smart Post!</h3>
						<span>
							Thank you for installing Smart Post! This video will help you get started with the plugin.
							Enjoy!
						</span>
					</div>
					<div className="sp-pcp-video-section-video">
						<iframe
							width="724"
							height="405"
							src="https://www.youtube.com/embed/vnveuaiPBdc?si=r6NFfvReMj-ABx7y"
							title="YouTube video player"
						></iframe>
					</div>
					<div className="sp-pcp-video-section-btn">
						<ul>
							<li>
								<a
									href={`${sp_pcp_block_settings.homeUrl}wp-admin/post-new.php?post_type=page&spblock_inserter=true`}
									target="_blank"
									rel="noreferrer"
								>
									Explore Blocks
								</a>
							</li>
							<li>
								<a target="_blank" href="https://wpsmartpost.com/" rel="noreferrer">
									See Full Features <Arrow />
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div className="sp-pcp-sidebar-section">
					<div className="sp-pcp-sidebar-box">
						<div className="sp-pcp-sidebar-box-title">
							<span>
								<DocIcon />
							</span>
							<h4>Documentation</h4>
						</div>
						<p className="sp-pcp-sidebar-box-text">
							Explore Smart Post plugin capabilities in our enriched documentation.
						</p>
						<a
							target="_blank"
							href="https://wpsmartpost.com/docs/"
							className="sp-pcp-sidebar-box-btn"
							rel="noreferrer"
						>
							Browse Now
						</a>
					</div>
					<div className="sp-pcp-sidebar-box">
						<div className="sp-pcp-sidebar-box-title">
							<span>
								<SupportIcon />
							</span>
							<h4>Technical Support</h4>
						</div>
						<p className="sp-pcp-sidebar-box-text">
							For personalized assistance, reach out to our skilled support team for prompt help.
						</p>
						<a
							target="_blank"
							href="https://shapedplugin.com/create-new-ticket/"
							className="sp-pcp-sidebar-box-btn"
							rel="noreferrer"
						>
							Ask Now
						</a>
					</div>
					<div className="sp-pcp-sidebar-box">
						<div className="sp-pcp-sidebar-box-title">
							<span>
								<CommunityIcon />
							</span>
							<h4>Join The Community</h4>
						</div>
						<p className="sp-pcp-sidebar-box-text">
							Join the official ShapedPlugin community to share your experiences, thoughts, and ideas.
						</p>
						<a
							target="_blank"
							href="https://community.shapedplugin.com/portal/"
							className="sp-pcp-sidebar-box-btn"
							rel="noreferrer"
						>
							Join Now
						</a>
					</div>
				</div>
			</div>
			<div className="sp-pcp-block-settings-start-page-footer">
				<span>
					Made with <LoveIcon /> by the <a href="https://shapedplugin.com"> ShapedPlugin LLC </a> Team
				</span>
				<p>Get Connected With</p>
				<ul>
					<li>
						<a target="_blank" href="https://www.facebook.com/ShapedPlugin/" rel="noreferrer">
							<FbIcon />
						</a>
					</li>
					<li>
						<a
							target="_blank"
							href="https://twitter.com/intent/follow?screen_name=ShapedPlugin"
							rel="noreferrer"
						>
							<XIcon />
						</a>
					</li>
					<li>
						<a
							target="_blank"
							href="https://profiles.wordpress.org/shapedplugin/#content-plugins"
							rel="noreferrer"
						>
							<WpIcon />
						</a>
					</li>
					<li>
						<a target="_blank" href="https://youtube.com/@ShapedPlugin?sub_confirmation=1" rel="noreferrer">
							<YouTubeIcon />
						</a>
					</li>
				</ul>
			</div>
		</div>
	);
};

export default QuickStart;
