import { Fragment } from "@wordpress/element";
import Card from "../../components/cards/Card";

import { SectionHeadingBlockIcon } from "../../../blocks/section-heading/icons";
import { PostCarouselBlockIcon } from "../../../blocks/post-carousel/icon";
import { PostSliderBlockIcon } from "../../../blocks/post-slider/icon";
import { PostSliderTwoBlockIcon } from "../../../blocks/post-slider-two/icon";
import { PostThumbnailSlider } from "../../../blocks/thumbnail-slider/icon";
import { PostThumbnailSliderTwoBlockIcon } from "../../../blocks/thumbnail-slider-two/icon";
import { NewsTicker } from "../../../blocks/news-ticker/icon";
import { GridOneBlockIcon } from "../../../blocks/post-grid-one/icon";
import { GridTwoBlockIcon } from "../../../blocks/post-grid-two/icon";
import { GridThreeBlockIcon } from "../../../blocks/post-grid-three/icon";
import { GridFourBlockIcon } from "../../../blocks/post-grid-four/icon";
import { GridFiveBlockIcon } from "../../../blocks/post-grid-five/icon";
import { GridSixBlockIcon } from "../../../blocks/post-grid-six/icon";
import { ListOneBlockIcon } from "../../../blocks/post-list-one/icon";
import { ListTwoBlockIcon } from "../../../blocks/post-list-two/icon";
import { ListThreeBlockIcon } from "../../../blocks/post-list-three/icon";
import { TimelineOneBlockIcon } from "../../../blocks/post-timeline-one/icon";
import { TimelineTwoBlockIcon } from "../../../blocks/post-timeline-two/icon";
import { TimelineThreeBlockIcon } from "../../../blocks/post-timeline-three/icon";
import { ContainerBlockIcon } from "../../../blocks/container/icons";
import { ButtonsBlockIcon } from "../../../blocks/buttons/icon";
import { TaxonomyBlockIcon } from "../../../blocks/taxonomy/icon";
import { SocialProfilesBlockIcon } from "../../../blocks/social-profiles/icons";
import { SearchBlockIcon } from "../../../blocks/smart-search/icons";
import { PostCarouselTwoBlockIcon } from "../../../blocks/post-carousel-two/icons";
import { TableOfContentIcon } from "../../../blocks/table-of-content/icons";
import { SmartImageBlockIcon } from "../../../blocks/smart-image/icons";
import { InfoBoxBlockIcon } from "../../../blocks/smart-info-box/icons";
import { SmartListBlockIcon } from "../../../blocks/smart-lists/icons";
import { ArchiveTitleIcon, PostAuthorBoxIcon, PostAuthorMetaIcon, PostBreadcrumbsBlockIcon, PostCategoryBlockIcon, PostCommentCountIcon, PostCommentIcon, PostContentIcon, PostDateMetaBlockIcon, PostExcerptIcon, PostFeatureImageIcon, PostLikeCountIcon, PostMetaBlockIcon, PostNextPreviousIcon, PostReadingTimeIcon, PostSocialShareIcon, PostTagBlockIcon, PostTitleIcon, PostViewCountIcon } from "../../../icons/builderBlockIcon";

// Blocks settings page block on/off cards data.
export const cardData = {
	"post-carousel": {
		Icon: PostCarouselBlockIcon,
		title: "Post Carousel 01",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/post-carousel-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3514",
	},
	"post-carousel-two": {
		Icon: PostCarouselTwoBlockIcon,
		title: "Post Carousel 02",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/post-carousel-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3516",
	},
	"post-slider": {
		Icon: PostSliderBlockIcon,
		title: "Post Slider 01",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/post-slider-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3490",
	},
	"post-slider-two": {
		Icon: PostSliderTwoBlockIcon,
		title: "Post Slider 02",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/post-slider-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3493",
		pro: true,
	},
	"thumbnail-slider": {
		Icon: PostThumbnailSlider,
		title: "Thumbnails Slider 01",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/thumbnails-slider-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3570",
	},
	"thumbnail-slider-two": {
		Icon: PostThumbnailSliderTwoBlockIcon,
		title: "Thumbnails Slider 02",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/thumbnails-slider-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3572",
		pro: true,
	},
	"news-ticker": {
		Icon: NewsTicker,
		title: "News Ticker",
		docLink: "https://wpsmartpost.com/docs/post-carousel-slider-blocks/news-ticker/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3568",
	},
	"post-grid-one": {
		Icon: GridOneBlockIcon,
		title: "Post Grid 01",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3497",
	},
	"post-grid-two": {
		Icon: GridTwoBlockIcon,
		title: "Post Grid 02",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3504",
	},
	"post-grid-three": {
		Icon: GridThreeBlockIcon,
		title: "Post Grid 03",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-03/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3505",
	},
	"post-grid-four": {
		Icon: GridFourBlockIcon,
		title: "Post Grid 04",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-04/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3506",
		pro: true,
	},
	"post-grid-five": {
		Icon: GridFiveBlockIcon,
		title: "Post Grid 05",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-05/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3507",
	},
	"post-grid-six": {
		Icon: GridSixBlockIcon,
		title: "Post Grid 06",
		docLink: "https://wpsmartpost.com/docs/post-grid-blocks/post-grid-06/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3508",
	},
	"post-list-one": {
		Icon: ListOneBlockIcon,
		title: "Post List 01",
		docLink: "https://wpsmartpost.com/docs/post-list-blocks/post-list-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3509",
	},
	"post-list-two": {
		Icon: ListTwoBlockIcon,
		title: "Post List 02",
		docLink: "https://wpsmartpost.com/docs/post-list-blocks/post-list-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3511",
		pro: true
	},
	"post-list-three": {
		Icon: ListThreeBlockIcon,
		title: "Post List 03",
		docLink: "https://wpsmartpost.com/docs/post-list-blocks/post-list-03/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3520",
	},
	"post-timeline-one": {
		Icon: TimelineOneBlockIcon,
		title: "Post Timeline 01",
		docLink: "https://wpsmartpost.com/docs/post-timeline-blocks/post-timeline-01/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3522",
	},
	"post-timeline-two": {
		Icon: TimelineTwoBlockIcon,
		title: "Post Timeline 02",
		docLink: "https://wpsmartpost.com/docs/post-timeline-blocks/post-timeline-02/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3524",
	},
	"post-timeline-three": {
		Icon: TimelineThreeBlockIcon,
		title: "Post Timeline 03",
		docLink: "https://wpsmartpost.com/docs/post-timeline-blocks/post-timeline-03/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3526",
	},
	"section-heading": {
		Icon: SectionHeadingBlockIcon,
		title: "Section Heading",
		docLink: "https://wpsmartpost.com/docs/section-heading/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3586",
	},
	container: {
		Icon: ContainerBlockIcon,
		title: "Container",
		docLink: "https://wpsmartpost.com/docs/container/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3580",
	},

	buttons: {
		Icon: ButtonsBlockIcon,
		title: "Smart Button",
		docLink: "https://wpsmartpost.com/docs/smart-button/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3588",
	},
	taxonomy: {
		Icon: TaxonomyBlockIcon,
		title: "Taxonomy",
		docLink: "https://wpsmartpost.com/docs/taxonomy/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3604",
	},
	"social-profiles": {
		Icon: SocialProfilesBlockIcon,
		title: "Social Profiles",
		docLink: "https://wpsmartpost.com/docs/social-profiles/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3528",
	},
	"table-of-content": {
		Icon: TableOfContentIcon,
		title: "Table Of Contents",
		docLink: "https://wpsmartpost.com/docs/table-of-content/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3602",
	},
	"smart-image": {
		Icon: SmartImageBlockIcon,
		title: "Smart Image",
		docLink: "https://wpsmartpost.com/docs/smart-image/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3584",
	},
	"smart-search": {
		Icon: SearchBlockIcon,
		title: "Smart Search",
		docLink: "https://wpsmartpost.com/docs/smart-search/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3596",
		pro: true,
	},
	"smart-info-box": {
		Icon: InfoBoxBlockIcon,
		title: "Smart Info Box",
		docLink: "https://wpsmartpost.com/docs/smart-info-box/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3590",
	},
	"smart-lists": {
		Icon: SmartListBlockIcon,
		title: "Smart List",
		docLink: "https://wpsmartpost.com/docs/smart-list/",
		demoLink: "https://wpsmartpost.com/blocks/#demoId3592",
	},

	// Website builder blocks.
	"archive-title": {
		Icon: ArchiveTitleIcon,
		title: "Archive Title",
		docLink: "https://wpsmartpost.com/docs/archive-title/",
		pro: true,
	},
	"post-title": {
		Icon: PostTitleIcon,
		title: "Post Title",
		docLink: "https://wpsmartpost.com/docs/post-title/",
		pro: true,
	},
	"post-featured-image": {
		Icon: PostFeatureImageIcon,
		title: "Post Featured Image",
		docLink: "https://wpsmartpost.com/docs/post-featured-image/",
		pro: true,
	},
	"post-content": {
		Icon: PostContentIcon,
		title: "Post Content",
		docLink: "https://wpsmartpost.com/docs/post-content/",
		pro: true,
	},
	"post-excerpt": {
		Icon: PostExcerptIcon,
		title: "Post Excerpt",
		docLink: "https://wpsmartpost.com/docs/post-excerpt/",
		pro: true,
	},
	"post-meta": {
		Icon: PostMetaBlockIcon,
		title: "Post Meta",
		docLink: "https://wpsmartpost.com/docs/post-meta/",
		pro: true,
	},
	"post-category": {
		Icon: PostCategoryBlockIcon,
		title: "Post Category",
		docLink: "https://wpsmartpost.com/docs/post-category/",
		pro: true,
	},
	"smart-post-tag": {
		Icon: PostTagBlockIcon,
		title: "Smart Post Tag",
		docLink: "https://wpsmartpost.com/docs/smart-post-tag/",
		pro: true,
	},
	"post-author-meta": {
		Icon: PostAuthorMetaIcon,
		title: "Post Author Meta",
		docLink: "https://wpsmartpost.com/docs/post-author-meta/",
		pro: true,
	},
	"post-next-previous": {
		Icon: PostNextPreviousIcon,
		title: "Post Next Previous",
		docLink: "https://wpsmartpost.com/docs/post-next-previous/",
		pro: true,
	},
	"post-comment-count": {
		Icon: PostCommentCountIcon,
		title: "Post Comment Count",
		docLink: "https://wpsmartpost.com/docs/post-comment-count/",
		pro: true,
	},
	"post-reading-time": {
		Icon: PostReadingTimeIcon,
		title: "Post Reading Time",
		docLink: "https://wpsmartpost.com/docs/post-reading-time/",
		pro: true,
	},
	"post-like-count": {
		Icon: PostLikeCountIcon,
		title: "Post Like Count",
		docLink: "https://wpsmartpost.com/docs/post-like-count/",
		pro: true,
	},
	"post-view-count": {
		Icon: PostViewCountIcon,
		title: "Post View Count",
		docLink: "https://wpsmartpost.com/docs/post-view-count-2/",
		pro: true,
	},
	"post-author-box": {
		Icon: PostAuthorBoxIcon,
		title: "Post Author Box",
		docLink: "https://wpsmartpost.com/docs/post-author-box/",
		pro: true,
	},
	"post-date-meta": {
		Icon: PostDateMetaBlockIcon,
		title: "Post Date Meta",
		docLink: "https://wpsmartpost.com/docs/post-date-meta/",
		pro: true,
	},
	"post-breadcrumbs": {
		Icon: PostBreadcrumbsBlockIcon,
		title: "Post Breadcrumbs",
		docLink: "https://wpsmartpost.com/docs/post-breadcrumbs/",
		pro: true,
	},
	"post-social-share": {
		Icon: PostSocialShareIcon,
		title: "Post Social Share",
		docLink: "https://wpsmartpost.com/docs/post-social-share/",
		pro: true,
	},
	"post-comment": {
		Icon: PostCommentIcon,
		title: "Post Comment",
		docLink: "https://wpsmartpost.com/docs/post-comment/",
		pro: true,
	},
};

export const BlockPage = ({ blocksSettings, blockShowHideHandler, type = "" }) => {
	return (
		<div className="sp-pcp-blocks-setting-blocks-page">

			{"setup-wizard" !== type && 
				<>
				<div className="sp-pcp-page-section-title">
					<h3 className="sp-pcp-blocks-setting-title">Control Blocks</h3>
					<span>Turn blocks on or off as needed to improve performance.</span>
				</div>
					{/* <h3 className="sp-pcp-blocks-setting-title sp-smart-carousel-title">Post Carousel & Slider Blocks</h3> */}
				</>
			}
			{Object.entries(cardData)?.map(([blockName, card]) => (
				<Fragment key={blockName}>
					<Card
						attributes={card}
						blockName={blockName}
						blocksSettings={blocksSettings}
						blockShowHideHandler={blockShowHideHandler}
						type={type}
					/>
					{("setup-wizard" !== type && "post-list-three" === blockName) && (
						<h3 className="sp-pcp-blocks-setting-title">Post Timeline Blocks</h3>
					)}
					{( "setup-wizard" !== type && "post-grid-six" === blockName ) && <h3 className="sp-pcp-blocks-setting-title">Post List Blocks</h3>}
					{("setup-wizard" !== type && "news-ticker" === blockName) && <h3 className="sp-pcp-blocks-setting-title">Post Grid Blocks</h3>}
					{"post-timeline-three" === blockName && (
						<h3 className="sp-pcp-blocks-setting-title">Smart Blocks</h3>
					)}
					{"smart-lists" === blockName && (
						<h3 className="sp-pcp-blocks-setting-title">Website Builder Blocks</h3>
					)}
				</Fragment>
			))}
		</div>
	);
};

export default BlockPage;
