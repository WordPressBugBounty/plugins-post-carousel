/**
 * Module Icons Registration
 * Registers custom icons for Divi 5 modules
 * Following official Divi 5 pattern from d5-extension-example-modules
 *
 * @package Smart_Post_Show_Pro
 */

import { addFilter } from "@wordpress/hooks";
import { spspIcon } from "./icons";

// Add module icons to the icon library - following official Divi 5 pattern
addFilter("divi.iconLibrary.icon.map", "spsp.divi5IconLibrary", (icons) => {
	return {
		...icons, // Important: preserves all existing icons
		[spspIcon.name]: spspIcon,
	};
});
