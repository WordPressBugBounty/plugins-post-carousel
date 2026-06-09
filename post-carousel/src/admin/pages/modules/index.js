import {
	taxonomyModuleIcon,
	shortcodeModuleIcon,
	webBuilderModuleIcon,
	templateLibraryModuleIcon,
	saveTemplateModuleIcon,
	dynamicDataFieldModuleIcon,
	frontPostSubmissionModuleIcon,
	readingScrollModuleIcon,
	postImageGalleryModuleIcon,
	postFeaturedVideoModuleIcon,
	postBadgesModuleIcon,
	StarterSitesModuleIcon,
	BackToTopModuleIcon,
} from "../../components/icons/modules";
import ModulesCard from "../../components/cards/ModulesCard";
import { useSelect } from "@wordpress/data";
import { SelectField } from "../../../components";
import { BackToTopGeneral, BackToTopPreview, BackToTopStyle } from "../shared/modulePart";
import { useMemo } from "@wordpress/element";

export const SettingsDemoTab = ({ attributes, setSettingsValue }) => {
	const { post_type } = attributes?.options;

	const allPostTypes = useSelect((select) => select("core").getPostTypes(), [] );
	const getPostTypes = useMemo(() => {
		if (!allPostTypes) {
			return [];
		}
		return Object.values(allPostTypes)
			.filter(({ viewable }) => viewable)
			?.map(({ name, slug }) => ({ label: name, value: slug }));
	}, [allPostTypes]);
	const postTypeHandler = (newValue) => {
		setSettingsValue({ ...attributes, options: { post_type: newValue } });
	};

	return (
		<>
			<SelectField
				label="Button Group"
				attributes={post_type}
				attributesKey={"post_type"}
				onChange={(newValue) => postTypeHandler(newValue)}
				items={getPostTypes}
			/>
		</>
	);
};

const modulesData = {
	"back-to-top": {
		Icon: BackToTopModuleIcon,
		title: "Back To Top",
		text: "This lets you add a back-to-top button to help users navigate efficiently and enhance experience.",
		// demoLink: "https://wpsmartpost.com/back-to-top/",
		docsLink: "https://wpsmartpost.com/docs/back-to-top/",
		settings: true,
		General: BackToTopGeneral,
		Style: BackToTopStyle,
		Preview: BackToTopPreview,
	},
	"saved-template": {
		Icon: saveTemplateModuleIcon,
		title: "Saved Templates",
		text: "This lets you create unlimited templates by converting blocks into shortcodes to reuse anywhere.",
		// demoLink: "https://wpsmartpost.com/saved-template/",
		docsLink: "https://wpsmartpost.com/docs/saved-templates/",
		settings: false,
	},
	"template-library": {
		Icon: templateLibraryModuleIcon,
		title: "Smart Design Library",
		text: "Access a library of professional, ready-made starter sites, patterns, and pages for creating fast, elegant websites.",
		docsLink: "https://wpsmartpost.com/docs/smart-design-library/",
	},
	taxonomy: {
		Icon: taxonomyModuleIcon,
		title: "Taxonomy Image & Color",
		text: "It allows you to assign featured images and colors to categories and taxonomies for better visual appeal.",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3604",
		docsLink: "https://wpsmartpost.com/docs/taxonomy-image-color/",
		pro: true,
	},
	"post-badges": {
		Icon: postBadgesModuleIcon,
		title: "Post Badges",
		text: "This lets you add taxonomy fields and highlight posts with badges like “Hot,” “New,” or custom labels.",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3514",
		docsLink: "https://wpsmartpost.com/docs/post-badges/",
		settings: false,
		SettingsTab: SettingsDemoTab,
		pro: true,
	},
	"image-gallery": {
		Icon: postImageGalleryModuleIcon,
		title: "Post Image Gallery",
		text: "Lets you add and display images in a responsive gallery slider within your post card to boost engagement.",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3497",
		docsLink: "https://wpsmartpost.com/docs/post-image-gallery/",
		settings: false,
		pro: true,
	},
	"featured-video": {
		Icon: postFeaturedVideoModuleIcon,
		title: "Post Featured Video",
		text: "This allows you to add video links to replace the featured image for more engaging posts and a better impact.",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3514",
		docsLink: "https://wpsmartpost.com/docs/post-featured-video/",
		settings: false,
		pro: true,
	},
};
const upcomingModulesData = {
	"website-builder": {
		Icon: webBuilderModuleIcon,
		title: "Website Builder",
		text: "This lets you create dynamic home and archive page templates with a powerful Gutenberg builder.",
		demoLink: "#",
		docsLink: "#",
	},
	"starter-sites": {
		Icon: StarterSitesModuleIcon,
		title: "Starter Sites",
		text: "Starter Sites are ready-made website templates designed to help you launch professional, responsive sites quickly.",
		demoLink: "#",
		docsLink: "#",
	},
	"dynamic-datafield": {
		Icon: dynamicDataFieldModuleIcon,
		title: "Dynamic Data & Fields",
		text: "Add dynamic content like excerpts, dates, authors, and fields into SmartPost blocks and layouts.",
		demoLink: "#",
		docsLink: "#",
	},
	"front-post-submission": {
		Icon: frontPostSubmissionModuleIcon,
		title: "Frontend Post Submission",
		text: "It allows your users to submit posts from the frontend without accessing the WordPress dashboard.",
		demoLink: "#",
		docsLink: "#",
	},
	"reading-scroll-progress": {
		Icon: readingScrollModuleIcon,
		title: "Reading & Scroll Progress",
		text: "Display a visual indicator of reading progress for blog posts and scrolling progress on pages.",
		demoLink: "#",
		docsLink: "#",
	},
	shortcode: {
		Icon: shortcodeModuleIcon,
		title: "Classic Shortcode Generator",
		text: "Lets you disable the Classic Shortcode Generator menu (Manage Shows, Replace Layout) to improve speed.",
		demoLink: "#",
		docsLink: "#",
	},
};
const haveUpcomingData = Object.entries(upcomingModulesData)?.length > 0;

const Modules = ({ blockShowHideHandler, modulesOptions, type = "", filterModules = null }) => {
	// Filter modulesData if filterModules is provided
	const filteredModulesData = filterModules
		? Object.fromEntries(Object.entries(modulesData).filter(([moduleName]) => filterModules.includes(moduleName)))
		: modulesData;

	// For quick-start type, don't use the wrapper div since it's already wrapped in the parent
	const isQuickStart = type === "quick-start";

	if (isQuickStart) {
		return (
			<>
				{Object.entries(filteredModulesData)?.map(([moduleName, data]) => {
					const toggleValue = modulesOptions.find((item) => item?.module_name === moduleName)?.show;
					return (
						<ModulesCard
							key={moduleName}
							value={toggleValue}
							moduleName={moduleName}
							data={data}
							blockShowHideHandler={blockShowHideHandler}
							settingsValue={modulesOptions}
							type={type}
						/>
					);
				})}
			</>
		);
	}

	return (
		<>
			<div className="sp-pcp-blocks-setting-modules-page">
				{"setup-wizard" !== type &&
					<div className="sp-pcp-page-section-title">
						<h3 className="sp-pcp-blocks-setting-title">Manage Modules</h3>
						<span>Enable only the modules you need to keep your site fast and optimized.</span>
					</div>
				}
				{Object.entries(filteredModulesData)?.map(([moduleName, data]) => {
					const toggleValue = modulesOptions.find((item) => item?.module_name === moduleName)?.show;
					return (
						<ModulesCard
							key={moduleName}
							value={toggleValue}
							moduleName={moduleName}
							data={data}
							blockShowHideHandler={blockShowHideHandler}
							settingsValue={modulesOptions}
							type={type}
							// settingsAttr={ settingsAttr || {}}
							// setSettingsAttr={ setSettingsAttr }
						/>
					);
				})}
				{haveUpcomingData && (
					<>
						<h3 className="sp-pcp-blocks-setting-title">Upcoming Modules</h3>
						{Object.entries(upcomingModulesData)?.map(([moduleName, data]) => (
							<ModulesCard
								key={moduleName}
								value={modulesOptions[moduleName]}
								moduleName={moduleName}
								data={data}
								blockShowHideHandler={blockShowHideHandler}
								isDisabled={true}
								type={type}
							/>
						))}
					</>
				)}
			</div>
		</>
	);
};

export default Modules;
