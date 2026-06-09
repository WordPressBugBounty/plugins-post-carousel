import { __ } from "@wordpress/i18n";
import { VideoTooltipIcon } from "../../../icons/icons";
import { StarHalfIcon, StarIcon, TrustPilotIcon, TrustPilotStar, WPIcon } from "../shared/icon";
import { Fragment } from "@wordpress/element";

const InfoText = ({ text }) => {
	return (
		<span className="spspc-settings-info">
			<i className="dashicons dashicons-info-outline spspc-info-icon"></i>
			<span className="spspc-help-tooltip">{text}</span>
		</span>
	);
};

const LightToPro = () => {
    const features = [
        {
            title: __("Design & Templates", "post-carousel"),
            section: true
        },
        {
            title: __("All Core Plugin Features", "post-carousel"),
            free: "yes",
            pro: "yes",
        },
        {
            title: __("Advanced Gutenberg Post Blocks", "post-carousel"),
            free: "27",
            pro: "51+",
            hot: true,
            new: true,
            info: __("Showcase Posts, Pages, or Media in Elegant Post Carousel, Slider, Grid, List, Thumbnails, Timeline, and News Ticker layouts.", "post-carousel")
        },
        {
            title: __("Starter Sites, Templates, and Ready Patterns", "post-carousel"),
            free: "no",
            pro: "yes",
            new: true,
        },
        {
            title: __("Smart Design Library", "post-carousel"),
            free: "20+",
            pro: "100+",
            new: true,
        },
        {
            title: __("Modern Post Layouts & Built-in Templates", "post-carousel"),
            free: "25+",
            pro: "150+",
        },
        {
            title: __("Archive & Single Pages Builder", "post-carousel"),
            free: "no",
            pro: "19",
            hot: true,
            new: true,
            info: __("Build Post Archive or Single Page with Stylish & Customizable Post Title, Featured Image/Video, Post Excerpt, Post Count, Likes, Date, Comments, Reading Time, Views, Like Count, Archive Title, Breadcrumbs, Next/Previous, Social Share, Author Box, Smart Post Tag, and more.", "post-carousel")
        },
        {
            title: __("Smart Content Blocks for Dynamic Display", "post-carousel"),
            free: "1",
            pro: "10",
            hot: true,
            new: true,
            info: __("Add Versatile Website Section with Smart Blocks, including Section Heading, Container, Smart Image, Smart Search (Pro), Smart List, Smart Button, Taxonomy, Social Profiles, Smart Info Box, and Table of Contents-TOC blocks.", "post-carousel")
        },
        {
            title: __("Reusable Saved Templates for Page Builders", "post-carousel"),
            // free: "yes",
            // pro: "yes",
            free: "2",
            pro: "Unlimited",
        },
        {
            title: __("Query & Filtering", "post-carousel"),
            section: true
        },
        {
            title: __("Advanced Post Query Builder", "post-carousel"),
            free: "Limited",
            pro: "Advanced",
        },
        {
            title: __("Filter Post by Keyword & Custom Fields", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Include / Exclude Post Control", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Advanced Frontend Live Filtering", "post-carousel"),
            free: "Limited",
            pro: "Advanced",
            hot: true,
            new: true,
            info: __("Use filters like keyword, author, taxonomy, or date to refine results and discover content faster.", "post-carousel")
        },
        {
            title: __("AJAX Live Search", "post-carousel"),
            free: "no",
            pro: "yes",
            hot: true,
        },
        {
            title: __("AJAX Pagination & Infinite Scroll", "post-carousel"),
            free: "Limited",
            pro: "Advanced",
        },
        {
            title: __("Content & Layout Control", "post-carousel"),
            section: true
        },
        {
            title: __("Supports All Content Types", "post-carousel"),
            free: "yes",
            pro: "yes",
            info: __("Display Any content types like Post Pages, Media, and CPTs with Smart Posts Easily.", "post-carousel")
        },
        {
            title: __("Dynamic Layout Control Per Blocks", "post-carousel"),
            free: "Limited",
            pro: "Advanced",
            hot: true,
        },
        {
            title: __("Trendy Content Orientations", "post-carousel"),
            free: "1",
            pro: "8",
        },
        {
            title: __("Advanced Carousel & Slider Controls", "post-carousel"),
            free: "Basic",
            pro: "Advanced",
        },
        {
            title: __("Equal Height & Partial Slide View", "post-carousel"),
            free: "no",
            pro: "yes",
            hot: true,
        },
        {
            title: __("Post Featured Video Support", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Taxonomy Display Positions and Custom Styling", "post-carousel"),
            free: "Limited",
            pro: "Advanced",
        },
        {
            title: __("Display Posts Gallery Images", "post-carousel"),
            free: "no",
            pro: "yes",
            new: true,
        },
        {
            title: __("Popup Post View", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Highlight Latest Posts with a Scrolling News Ticker", "post-carousel"),
            free: "no",
            pro: "yes",
            hot: true,
        },
        {
            title: __("Drag & Drop Content Ordering", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Engagement & Visual Effects", "post-carousel"),
            section: true
        },
        {
            title: __("Interactive Hover Effects & Animations", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Post Highlight & Badges", "post-carousel"),
            free: "no",
            pro: "yes",
            new: true,
            hot: true,
        },
        {
            title: __("Customizable CTA & Read More Button", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Social Share Popup Display", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Back-to-Top Navigation", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Performance & Integrations", "post-carousel"),
            section: true
        },
        {
            title: __("SEO Meta Integration (Yoast, Rank Math, All-in-One SEO, Squirrly, SEOPress, etc.)", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Popular Page Builders: Elementor, Divi, WPBakery, Beaver, Bricks, and more", "post-carousel"),
            free: "yes",
            pro: "yes",
        },
        {
            title: __("Responsive Device-Based Content Control", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Image Optimization", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Global Typography & Styling", "post-carousel"),
            free: "yes",
            pro: "yes",
            hot: true,
        },
        {
            title: __("ACF, Pods, Meta box, Toolset, and etc. Compatible", "post-carousel"),
            free: "yes",
            pro: "yes",
            hot: true,
        },
        {
            title: __("Lightweight, Fast & Fully Responsive", "post-carousel"),
            free: "yes",
            pro: "yes",
        },
        {
            title: __("Retina-Ready & Custom Responsive Breakpoints", "post-carousel"),
            free: "yes",
            pro: "yes",
        },
        {
            title: __("Translation and Localization Support", "post-carousel"),
            free: "yes",
            pro: "yes",
        },
        {
            title: __("Premium Updates & Security", "post-carousel"),
            free: "no",
            pro: "yes",
        },
        {
            title: __("Priority Expert Support", "post-carousel"),
            free: "no",
            pro: "yes",
        },
    ];

    const testimonials = [
        {
            text: "Very easy to set up and nice options even in the free version which I'm using on a NFP horse club site. Very professional look. I'm new to WordPress and still getting the hang of it so finding a plugin...",
            name: "Comlodge",
            role: "Web Developer",
            img: "comlodge.png",
            user: "wordpress",
        },
        {
            text: "The support is excellent !!,Five stars for the plugin and five stars for the support service. We have had some doubts and they have been resolved all of them at the moment.We are very happy with the...",
            name: "Annamaspons",
            role: "Entrepreneur",
            img: "testimonial-avatar.svg",
            user: "wordpress",
        },
        {
            text: "The Team at ShapedPlugin are amazing. They helped me custom stylise a post header. I would recommend Smart Post pro to anyone looking for a different set up on their Wordpress site.",
            name: "Adrian North",
            role: "Agency Owner from London",
            img: "testimonial-avatar.svg",
            user: "trustpilot",
        },
    ];

    const generateFreeOrProContent = (content, type) => {
		if (content === "yes") {
			return <span className={`spspc-free-pro spspc-check-icon`}></span>;
		}

		if (content === "no") {
			return <span className={`spspc-free-pro spspc-close-icon`}></span>;
		}

		return <span className={`spspc-free-pro`}> <b>{content}</b></span>;
	};

	return (
		<section className="spspc__help lite-to-pro-page" id="lite-to-pro-tab">
			<div className="spspc-container">
				<div className="spspc-lite-to-pro-wrap">
					<div className="spspc-call-to-action-top">
						<div>
							<h2 className="spspc-section-title">Unlock the Full Editorial Experience</h2>
							<span className="spspc-section-subtitle">
								Design, organize, and display your content exactly the way you want with powerful features.
							</span>
						</div>
						<a
							target="_blank"
							rel="noreferrer"
							href="https://wpsmartpost.com/pricing/?ref=1"
							className="spspc-big-btn"
						>
							Upgrade to Pro Now!
						</a>
					</div>
					<div className="spspc-features">
						<ul>
							<li className="spspc-header">
								<span className="spspc-title">FEATURES</span>
								<span className="spspc-free">Lite</span>
								<span className="spspc-pro">
									<i className="spspc-light-to-pro-icon">
										<svg
											width="18"
											height="18"
											viewBox="0 0 18 18"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<path
												d="M11.494 5.77c.212.388.568.679 1.005.77a1.4 1.4 0 0 0 1.24-.352l2.63-2.41-.853 6.78H2.5l-.854-6.78 1.08.989 1.55 1.421a1.4 1.4 0 0 0 1.242.352 1.5 1.5 0 0 0 1.003-.77l2.487-4.56z"
												stroke="#fff"
												strokeWidth="1.524"
											/>
											<path
												d="M15.439 15.707H2.577c-.414 0-.749-.41-.749-.915v-2.01h14.36v2.01c0 .506-.336.915-.75.915"
												fill="#fff"
											/>
										</svg>
									</i>{" "}
									PRO
								</span>
							</li>

							{features.map((item, index) => (
								<Fragment key={index}>
	                            {!item.section && <li className="spspc-body" key={index}>
									<span className="spspc-title">
										{item?.title}
										{item?.info && <InfoText text={item?.info} />}
										{item?.video && (
											<span className="spspc-settings-info">
												<VideoTooltipIcon color="#757575" />
												<span className="spspc-help-tooltip">
													<video src={item?.video} autoPlay loop muted />
												</span>
											</span>
										)}
										{item?.new && <i className="spspc-new">{__("new", "post-carousel")}</i>}
										{item?.hot && <i className="spspc-hot">{__("hot", "post-carousel")}</i>}
									</span>
	                            {generateFreeOrProContent(item?.free, "free")}
	                            {generateFreeOrProContent(item?.pro, "pro")}
								</li>}
	                            {item.section && <li className="spspc-lite-vs-pro-section-title">
	                                <span>{item?.title}</span>
	                            </li>}
	                            </Fragment>
							))}
						</ul>
					</div>
	                {/* <div className="spspc-trustpilot-section">
	                    <h4>Excellent</h4>
	                    <ul>
	                      <li><TrustPilotIcon /></li>
	                      <li><TrustPilotIcon /></li>
	                      <li><TrustPilotIcon /></li>
	                      <li><TrustPilotIcon /></li>
	                      <li><TrustPilotIcon /></li>
	                    </ul>
	                    <span>4.8/5 based on 112+ reviews on</span>
	                    <TrustPilotStar />
	                    <strong><a href="https://www.trustpilot.com/review/shapedplugin.com" target="_blank">Trustpilot</a></strong>
	                </div> */}
					<div className="spspc-upgrade-to-pro">
						<h2 className="spspc-section-title">Upgrade To PRO & Enjoy Advanced Features!</h2>
						<span className="spspc-section-subtitle">
							Already, <b>30000+</b> people are using Smart Post to build more engaging and dynamic websites.
						</span>
						<div className="spspc-upgrade-to-pro-btn">
							<div className="spspc-action-btn">
								<a
									target="_blank"
									href="https://wpsmartpost.com/pricing/?ref=1"
									className="spspc-big-btn"
								>
									Upgrade to Pro Now!
								</a>
								<span className="spspc-small-paragraph">
									14-Day No-Questions-Asked{" "}
									<a target="_blank" href="https://shapedplugin.com/refund-policy/">
										Refund Policy
									</a>
								</span>
							</div>
							<a target="_blank" href="https://wpsmartpost.com/" className="spspc-big-btn-border">
								See Full Features
							</a>
						</div>
					</div>
				</div>
				<div className="spspc-testimonial">
					<div className="spspc-testimonial-header">
						<div className="spspc-testimonial-ratings">
							<a
							href='https://wordpress.org/support/plugin/post-carousel/reviews/'
							target='_blank'
                            rel="noreferrer"
                            title="Reviews on WordPress"
							className="spspc-testimonial-rating-item">
								<div className="spspc-testimonial-rating-wordpress">
									<div className="spspc-wp-mark">
										<WPIcon />
									</div>
										<div className="spspc-wp-text">
											<StarIcon />
											<StarIcon />
											<StarIcon />
											<StarIcon />
											<StarHalfIcon />
										</div>
								</div>
								<span className="spspc-testimonial-rating-score">4.8/5</span>
								<span className="spspc-testimonial-review-count">200+ Reviews</span>
							</a>
							<a
							href='https://www.trustpilot.com/review/shapedplugin.com'
							target='_blank'
                            rel="noreferrer"
                            title="Reviews on Trustpilot"
							className="spspc-testimonial-rating-item">
								<div className="spspc-testimonial-rating-trustpilot">
									<div className="spspc-trustpilot-mark">
										<TrustPilotStar />
									</div>
								</div>
								<div className="spspc-trustpilot-stars">
									<StarIcon color='#fff' />
									<StarIcon color='#fff' />
									<StarIcon color='#fff' />
									<StarIcon color='#fff' />
									<StarIcon color='#fff' />
								</div>
								<span className="spspc-testimonial-rating-score">4.8/5</span>
								<span className="spspc-testimonial-review-count">130+ Reviews</span>
							</a>
						</div>
						<h2 className="spspc-testimonial-title">
							Don't Just Take Our Word for It — See What Users Say!
						</h2>
					</div>
					<div className="spspc-testimonial-wrap">
						{testimonials.map((item, index) => (
							<div className={`spspc-testimonial-card ${item?.user === 'trustpilot' ? 'spspc-testimonial-card-trustpilot' : ''}`} key={index}>
								<div className="spspc-testimonial-card-header">
									<div className="spspc-testimonial-reviewer">
										<div className="spspc-testimonial-avatar">
											{item?.user === 'trustpilot' ? (
												<div className="spspc-testimonial-avatar-initials">
													<span>{item.name.slice(0, 2).toUpperCase()}</span>
												</div>
											) : (
												<img
													src={`${sp_pcp_block_settings?.pluginUrl}admin/help-page/img/${item.img}`}
													alt={item.name}
												/>
											)}
											<div className="spspc-testimonial-source-badge">
												{item?.user === 'trustpilot' ? <TrustPilotStar /> : <WPIcon />}
											</div>
										</div>
										<div className="spspc-testimonial-reviewer-info">
											<h3>{item.name}</h3>
											<p>{item.role}</p>
										</div>
									</div>
								</div>
								<div className="spspc-testimonial-rating-stars">
									{item?.user === 'trustpilot' ? (
										<div className="spspc-testimonial-rating-trustpilot-stars">
											<span className="spspc-trustpilot-star-item"><StarIcon color='#fff' /></span>
											<span className="spspc-trustpilot-star-item"><StarIcon color='#fff' /></span>
											<span className="spspc-trustpilot-star-item"><StarIcon color='#fff' /></span>
											<span className="spspc-trustpilot-star-item"><StarIcon color='#fff' /></span>
											<span className="spspc-trustpilot-star-item"><StarIcon color='#fff' /></span>
										</div>
									) : (
										<span>★★★★★</span>
									)}
								</div>
								<div className="spspc-testimonial-card-content">
									<p>{item.text}</p>
								</div>
							</div>
						))}
					</div>
				</div>
			</div>
		</section>
	);
};

export default LightToPro;
