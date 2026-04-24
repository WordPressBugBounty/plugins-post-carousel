import { updateCategory } from "@wordpress/blocks";
import domReady from "@wordpress/dom-ready";
import "./style.scss";
import "./editor.scss";
import { SmartPostShowLogoIcon } from "../icons/icons.js";
import saveBlockCSS from "../controls/saveBlockCSS.js";
import "../global-settings/index.js";
import "./section-heading/block.js";
import "./search-filter/block.js";
import "./author-filter/block.js";
import "./post-carousel/block.js";
import "./post-carousel-two/block.js";
import "./post-slider/block.js";
import "./post-slider-two/block.js";
import "./thumbnail-slider/block.js";
import "./thumbnail-slider-two/block.js";
import "./news-ticker/block.js";
import "./post-grid-one/block.js";
import "./post-grid-two/block.js";
import "./post-grid-three/block.js";
import "./post-grid-four/block.js";
import "./post-grid-five/block.js";
import "./post-grid-six/block.js";
import "./post-list-one/block.js";
import "./post-list-two/block.js";
import "./post-list-three/block.js";
import "./post-timeline-one/block.js";
import "./post-timeline-two/block.js";
import "./post-timeline-three/block.js";
import "./container/block.js";
import "./buttons/block.js";
import "./button/block.js";
import "./smart-search/block.js";
import "./column/block.js";
import "./social-profiles/block.js";
import "./social-profile-item/block.js";
import "./pagination/block.js";
import "./taxonomy-filter/block.js";
import "./sort-filter/block.js";
import "./live-filter/block.js";
import "./smart-post-parent/block.js";
import "./taxonomy/block.js";
import "./table-of-content/block.js";
import "./smart-image/block.js";
import "./smart-info-box/block.js";
import "./smart-lists/block.js";
import "./smart-list/block.js";
import "./shortcode/block.js";
import "../prebuild-library/index.js";
import "./explore-blocks.js";

updateCategory("sp-smart-post-show", {
	icon: <SmartPostShowLogoIcon color="var(--sp-smart-primary-2-400)" />,
});

domReady(() => {
	saveBlockCSS();
});
