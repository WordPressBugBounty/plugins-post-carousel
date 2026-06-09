import { ArrowRight, Arrow } from "../../components/icons/navigation";
import {
	EasyAccordionIcon,
	WPCarouselIcon,
	RealTestimonialIcon,
	SmartTabsIcon,
	SmartTeamIcon,
	LogoShowcaseIcon,
	WooGalleryIcon,
	WooProductIcon,
	LocationWeatherIcon,
	WooCategoryIcon,
	SmartSwatch,
	SmartBrand,
} from "../shared/icon";
import { __ } from "@wordpress/i18n";

const AboutUs = () => {
	// More plugins data with icons
	const morePlugins = [
		{
			name: "Easy Accordion",
			description: "The best accordion and FAQs builder plugin for WordPress to create stunning FAQ sections.",
			url: "https://easyaccordion.io/",
			icon: <EasyAccordionIcon />,
		},
		{
			name: "WP Carousel",
			description:
				"The most powerful and user-friendly multi-purpose carousel, slider, & gallery plugin for WordPress.",
			url: "https://wpcarousel.io/",
			icon: <WPCarouselIcon />,
		},
		{
			name: "Real Testimonial",
			description: "Simply collect, manage, and display Testimonials on your website and boost conversions.",
			url: "https://realtestimonials.io/",
			icon: <RealTestimonialIcon />,
		},
		{
			name: "Smart Tabs",
			description:
				"Best WooCommerce Custom Product Tabs & WordPress Tabs Builder Plugin to create responsive tabs.",
			url: "https://wptabs.com/",
			icon: <SmartTabsIcon />,
		},
		{
			name: "Smart Team",
			description: "Simply collect, manage, and display team members on your website beautifully.",
			url: "https://getwpteam.com/",
			icon: <SmartTeamIcon />,
		},
		{
			name: "Logo Showcase",
			description:
				"Showcase a group of logo images with Title, Description, Tooltips, Links, and Popup as a grid or in a carousel.",
			url: "https://logocarousel.com/",
			icon: <LogoShowcaseIcon />,
		},
		{
			name: "Location Weather",
			description:
				"Display beautiful weather update widgets to your WordPress site in a minute without coding skills!",
			url: "https://locationweather.io/",
			icon: <LocationWeatherIcon />,
		},
		{
			name: "WooGallery",
			description:
				"Product gallery slider and additional variation images gallery for WooCommerce and boost your sales.",
			url: "https://woogallery.io/",
			icon: <WooGalleryIcon />,
		},
		{
			name: "Product Slider for WooCommerce",
			description:
				"Boost sales by interactive product Slider, Grid, and Table in your WooCommerce website or store.",
			url: "https://wooproductslider.io/",
			icon: <WooProductIcon />,
		},
		{
			name: "WooCategory",
			description: "Display by filtering the list of categories aesthetically and boosting sales.",
			url: "https://shapedplugin.com/woocategory/",
			icon: <WooCategoryIcon />,
		},
		{
			name: "Smart Swatches",
			description:
				"Smart Swatches is a Best Product Variation Swatches for WooCommerce to Boost Your Store Sales.",
			url: "https://shapedplugin.com/smart-swatches-for-woocommerce",
			icon: <SmartSwatch />,
		},
		{
			name: "Smart Brands",
			description:
				"Smart Brands for WooCommerce Pro helps you display product brands in an attractive way on your online store.",
			url: "https://shapedplugin.com/smart-brands/",
			icon: <SmartBrand />,
		},
	];

	return (
		<section id="about-us-tab" className="spspc__help about-page">
			<div className="spspc-container">
				<div className="spspc-about-box">
					<div className="spspc-about-info">
						<h3>The Most Powerful Post Grid & Page Builder Blocks for Blogs, News & Any Site</h3>
						<p>
							<b>Smart Post</b> is an advanced Gutenberg blocks library designed to help you showcase your
							content beautifully—without writing a single line of code.{" "}
						</p>
						<p>
							Create stunning layouts like post grids, lists, sliders, carousels, timelines, and more
							using <strong>60+ ready-to-use blocks and modules</strong>. Easily display posts, pages,
							custom post types, taxonomies, and custom fields exactly the way you want.
						</p>
						<p>
							Perfect for <strong>blogs, news sites, magazines, portfolios, and niche websites</strong>
							—Smart Post gives you full control to build engaging, high-performing layouts in just a few
							clicks.
						</p>
						<div className="spspc-about-btn">
							<a target="_blank" href="https://wpsmartpost.com/" className="spspc-medium-btn">
								Explore Smart Post
							</a>
							<a
								target="_blank"
								href="https://shapedplugin.com/about-us/"
								className="spspc-medium-btn spspc-arrow-btn"
							>
								More About Us <Arrow />
							</a>
						</div>
					</div>
					<div className="spspc-about-img">
						<img
							src={`${sp_pcp_block_settings?.pluginUrl}admin/assets/img/shapedplugin-team.jpg`}
							alt="ShapedPlugin Team"
						/>
						<span>The Creative Minds Behind the Smart Post Plugin</span>
					</div>
				</div>

				{/* More Plugins Section */}
				<div className="spspc-more-plugins-section">
					<div className="spspc-more-plugins-header">
						<h2 className="spspc-more-plugins-title">
							{__("Your Website Deserves More Than Typical — Go Premium Today!", "post-carousel")}
						</h2>
						<p className="spspc-more-plugins-subtitle">
							{__(
								"Unlock powerful plugins built to boost performance, elevate design, and grow your business.",
								"post-carousel"
							)}
						</p>
					</div>
					<div className="spspc-more-plugins-grid">
						{morePlugins.map((plugin) => (
							<a
								key={plugin.name}
								href={plugin.url}
								target="_blank"
								rel="noopener noreferrer"
								className="spspc-plugin-card"
							>
								<div className="spspc-plugin-card-icon">{plugin.icon}</div>
								<div className="spspc-plugin-card-content">
									<h3 className="spspc-plugin-card-title">{plugin.name}</h3>
									<p className="spspc-plugin-card-desc">{plugin.description}</p>
								</div>
								<span className="spspc-plugin-card-arrow">
									<ArrowRight />
								</span>
							</a>
						))}
					</div>
				</div>
			</div>
		</section>
	);
};

export default AboutUs;
