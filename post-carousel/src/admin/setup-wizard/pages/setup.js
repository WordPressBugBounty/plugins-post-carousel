import { __ } from "@wordpress/i18n";
import { SelectField } from "../../../components";

const websiteTypes = [
	{
		label: __("Select a website type", "post-carousel"),
		value: "",
	},
	{
		label: __("Personal blogs", "post-carousel"),
		value: "personal_blogs",
	},
	{
		label: __("Travel blogs", "post-carousel"),
		value: "travel_blogs",
	},
	{
		label: __("Food blogs", "post-carousel"),
		value: "food_blogs",
	},
	{
		label: __("Recipe websites", "post-carousel"),
		value: "recipe_websites",
	},
	{
		label: __("Lifestyle blogs", "post-carousel"),
		value: "lifestyle_blogs",
	},
	{
		label: __("Fitness & health blogs", "post-carousel"),
		value: "fitness_and_health_blogs",
	},
	{
		label: __("Online newspapers", "post-carousel"),
		value: "online_newspaper",
	},
	{
		label: __("Magazine portals", "post-carousel"),
		value: "maganize_portals",
	},
	{
		label: __("Niche news sites (tech, sports, fashion)", "post-carousel"),
		value: "niche_news_sites",
	},
	{
		label: __("Company news & updates", "post-carousel"),
		value: "company_news_updates",
	},
	{
		label: __("Case studies", "post-carousel"),
		value: "case_studies",
	},
	{
		label: __("Press releases", "post-carousel"),
		value: "press_releases",
	},
	{
		label: __("Photographer portfolios", "post-carousel"),
		value: "photographer_portfolios",
	},
	{
		label: __("Writers / Author sites", "post-carousel"),
		value: "writers_or_author_sites",
	},
	{
		label: __("School / College news portals", "post-carousel"),
		value: "academic_news_portals",
	},
	{
		label: __("Product update blogs", "post-carousel"),
		value: "product_update_blogs",
	},
	{
		label: __("Coastal Businesses", "post-carousel"),
		value: "coastal_businesses",
	},
	{
		label: __("Other", "post-carousel"),
		value: "other",
	},
];

const BlocksSetup = ({ websiteType, setWebsiteType, errorMessage }) => {
	return (
		<div className="sp-smart-post-setup-blocks-page-header">
			<div className="sp-smart-post-setup-page-wrapper">
				<h3 className="sp-smart-post-setup-page-title">{__("Tell Us About Your Website", "post-carousel")}</h3>
				<p className="sp-smart-post-setup-page-desc">
					{__("Choose the website or business type that best describes your site.", "post-carousel")}
				</p>
			</div>
			<div className="sp-smart-post-setup-website-type-select">
				<SelectField
					attributes={websiteType}
					onChange={(val) => setWebsiteType(val)}
					items={websiteTypes}
				/>
				{errorMessage && websiteType === "" && (
					<p
						className="sp-smart-post-setup-page-desc"
						style={{
							color: "red",
							position: "absolute",
							marginTop: "4px",
						}}
					>
						{__("Please select your website type to proceed.", "post-carousel")}
					</p>
				)}
			</div>
		</div>
	);
};

export default BlocksSetup;
