import { boxCss, colorControls, objectToCssString, spacingGenerate } from "../../../blocks/shared/helpFn";

const moduleDynamicCss = (attributes) => {
	const {
		icon_size,
		typography,
		font_size,
		line_height,
		letter_spacing,
		word_spacing,
		color,
		background_color,
		border,
		border_width,
		border_radius,
		box_shadow_enable,
		box_shadow,
		padding,
		margin,
		horizontal_position,
		vertical_position,
		box_shadow_enable_hover,
		box_shadow_hover,
	} = attributes;

	const staticCss = [
		{
			class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper`,
			styles: {
				display: "inline-block",
				background: colorControls(
					background_color?.color?.style,
					background_color?.color?.solidColor,
					background_color?.color?.gradient
				),
				"border-style": border?.style,
				"border-color": border?.color,
				"border-width": spacingGenerate(border_width),
				"border-radius": spacingGenerate(border_radius),
				padding: spacingGenerate(padding),
				margin: spacingGenerate(margin),
				position: "fixed",
				bottom: 0,
				cursor: "pointer",
				"z-index": "999",
				transition: "background 0.3s, border-color 0.3s, box-shadow 0.3s",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper:hover`,
			styles: {
				background: colorControls(
					background_color?.hover?.style,
					background_color?.hover?.solidColor,
					background_color?.hover?.gradient
				),
				"border-color": border?.hoverColor,
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-icon`,
			styles: {
				display: "inline-block",
				color: color?.color,
				width: icon_size?.value + icon_size.unit,
				height: icon_size?.value + icon_size.unit,
				transition: "color 0.3s",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-text`,
			styles: {
				color: color?.color,
				"font-family": typography.typography.family,
				"font-style": typography.typography.style,
				"font-weight": typography.typography.fontWeight,
				"text-decoration": typography.typography.decoration,
				"text-transform": typography.typography.transform,
				"font-size": font_size?.value + font_size.unit,
				"line-height": line_height?.value,
				"letter-spacing": letter_spacing?.value + letter_spacing?.unit,
				"word-spacing": word_spacing?.value + word_spacing?.unit,
				transition: "color 0.3s",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn:hover .sp-smart-post-back-to-top-icon, #sp-smart-post-back-to-top-btn:hover .sp-smart-post-back-to-top-text`,
			styles: {
				color: color.hoverColor,
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper.sp-position-button-right`,
			styles: {
				left: "unset",
				right: horizontal_position.value + horizontal_position.unit,
				bottom: vertical_position.value + vertical_position.unit,
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper.sp-position-button-left`,
			styles: {
				right: "unset",
				left: horizontal_position.value + horizontal_position.unit,
				bottom: vertical_position.value + vertical_position.unit,
			},
		},
		// Static CSS.
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-button`,
			styles: {
				display: "flex",
				"align-items": "center",
				"justify-content": "center",
				gap: "8px",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-icon svg`,
			styles: {
				width: "inherit",
				height: "inherit",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-btn-text .sp-hide-label`,
			styles: {
				display: "none",
				visibility: "hidden",
				opacity: "0",
				width: "0",
				height: "0",
				transition: "all 0.9s ease",
			},
		},
		{
			class: `#sp-smart-post-back-to-top-btn .sp-smart-post-back-to-top-btn-text .sp-show-label`,
			styles: {
				display: "flex",
				visibility: "visible",
				opacity: "1",
				width: "fit-content",
				height: "fit-content",
				transition: "all 0.9s ease",
			},
		},
	];
	if (box_shadow_enable) {
		staticCss.push(
			...[
				{
					class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper`,
					styles: {
						"box-shadow": boxCss(box_shadow_enable, "Desktop", box_shadow, "color"),
					},
				},
			]
		);
	}
	if (box_shadow_enable_hover) {
		staticCss.push(
			...[
				{
					class: `#sp-smart-post-back-to-top-btn.sp-smart-post-back-to-top-wrapper:hover`,
					styles: {
						"box-shadow": boxCss(box_shadow_enable_hover, "Desktop", box_shadow_hover, "color"),
					},
				},
			]
		);
	}
	const dynamicStyle = objectToCssString(staticCss);

	return dynamicStyle;
};
export default moduleDynamicCss;
