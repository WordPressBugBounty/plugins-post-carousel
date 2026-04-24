import { __ } from "@wordpress/i18n";
import {
	Background,
	Border,
	BoxShadow,
	InputControl,
	MultiSelectDndKit,
	SelectField,
	Spacing,
	SpColorPicker,
	SPRangeControl,
	SPToggleGroupControl,
	Toggle,
	TypographyNew,
} from "../../components";
import {
	BackToTopArrowFive,
	BackToTopArrowFour,
	BackToTopArrowOne,
	BackToTopArrowThree,
	BackToTopArrowTwo,
} from "../template-parts/icons";
import { BgIcon, GradientIcon } from "../../components/background/svgIcon";
import { useSelect } from "@wordpress/data";
import { useEffect, useMemo, useState } from "@wordpress/element";
import classNames from "classnames";
import moduleDynamicCss from "../template-parts/moduleDynamicCss";
import { googleFonts } from "../../controls/controls";

export const BackToTopGeneral = ({ attributes, props }) => {
	const { setSettingsValue } = props;
	const {
		display_position,
		horizontal_position,
		vertical_position,
		back_to_top_icon,
		top_icon_source,
		icon_size,
		back_top_label,
		display_on,
		exclude_page,
		include_only,
		smooth_scroll,
		transition_delay,
		entrance_animation,
		go_to_bottom,
		back_bottom_label,
	} = attributes?.options;

	const [pageListItems, setPageListItems] = useState([]);

	const allPagesList = useSelect((select) => {
		return select("core").getEntityRecords("postType", "page", {
			per_page: -1,
			status: "publish",
			_fields: "id,title,slug",
		});
	}, []);

	useEffect(() => {
		const topTen =
			allPagesList?.map((item) => ({ id: item.id, label: item.title?.rendered, value: item.slug })) || [];
		setPageListItems(topTen);
	}, [allPagesList]);

	const updateStateHandler = (valueKey, value) => {
		setSettingsValue({ ...attributes, options: { ...attributes.options, [valueKey]: value } });
	};

	return (
		<>
			<SPToggleGroupControl
				label={__("Display Position", "post-carousel")}
				attributes={display_position}
				onClick={(newValue) => updateStateHandler("display_position", newValue)}
				items={[
					{ label: "Button Left", value: "button-left" },
					{ label: "Button Right", value: "button-right" },
				]}
			/>
			<SPRangeControl
				label={__("Horizontal Distance", "post-carousel")}
				attributes={horizontal_position}
				units={["px", "%", "em"]}
				defaultValue={{ value: 30, unit: "px" }}
				onValueChange={(newValue) =>
					updateStateHandler("horizontal_position", { ...horizontal_position, value: newValue?.value })
				}
				onUnitChange={(newUnit) =>
					updateStateHandler("horizontal_position", { ...horizontal_position, unit: newUnit?.unit })
				}
				setCustomReset={true}
			/>
			<SPRangeControl
				label={__("Vertical Distance", "post-carousel")}
				attributes={vertical_position}
				units={["px", "%", "em"]}
				defaultValue={{ value: 30, unit: "px" }}
				onValueChange={(newValue) =>
					updateStateHandler("vertical_position", { ...vertical_position, value: newValue?.value })
				}
				onUnitChange={(newUnit) =>
					updateStateHandler("vertical_position", { ...vertical_position, unit: newUnit?.unit })
				}
				setCustomReset={true}
			/>
			<Toggle
				label={__("Icon", "post-carousel")}
				attributes={back_to_top_icon}
				onChange={(newToggle) => updateStateHandler("back_to_top_icon", !newToggle)}
			/>
			{back_to_top_icon && (
				<>
					<SPToggleGroupControl
						label={__("Icon Source", "post-carousel")}
						extraClass={"sp-module-arrow-icon"}
						attributes={top_icon_source}
						onClick={(newValue) => updateStateHandler("top_icon_source", newValue)}
						items={[
							{ label: <BackToTopArrowOne />, value: "top-arrow-one" },
							{ label: <BackToTopArrowTwo />, value: "top-arrow-two" },
							{ label: <BackToTopArrowThree />, value: "top-arrow-three" },
							{ label: <BackToTopArrowFour />, value: "top-arrow-four" },
							{ label: <BackToTopArrowFive />, value: "top-arrow-five" },
						]}
					/>
					<SPRangeControl
						label={__("Icon Size", "post-carousel")}
						attributes={icon_size}
						units={["px", "%", "em"]}
						defaultValue={{ value: 24, unit: "px" }}
						onValueChange={(newValue) =>
							updateStateHandler("icon_size", { ...icon_size, value: newValue?.value })
						}
						onUnitChange={(newUnit) =>
							updateStateHandler("icon_size", { ...icon_size, unit: newUnit?.unit })
						}
						setCustomReset={true}
					/>
				</>
			)}
			<InputControl
				label={__("Back to Top Text Label", "post-carousel")}
				attributes={back_top_label}
				flex={false}
				inputType="text"
				onChange={(newValue) => updateStateHandler("back_top_label", newValue)}
			/>

			<SelectField
				label={__("Display On", "post-carousel")}
				attributes={display_on}
				onChange={(newValue) => updateStateHandler("display_on", newValue)}
				items={[
					{ label: "All Pages", value: "all-pages" },
					{ label: "Only Archive Pages", value: "only-archive-pages" },
					{ label: "Single Post Pages", value: "single-pages" },
					{ label: "Specific Pages", value: "specific-pages" },
				]}
			/>
			{display_on === "specific-pages" && (
				<MultiSelectDndKit
					label={__("Select Pages", "post-carousel")}
					values={include_only}
					searchable={true}
					onChange={(e) => updateStateHandler("include_only", e)}
					items={pageListItems}
				/>
			)}
			{display_on === "all-pages" && (
				<MultiSelectDndKit
					label={__("Exclude Pages", "post-carousel")}
					values={exclude_page}
					searchable={true}
					onChange={(e) => updateStateHandler("exclude_page", e)}
					items={pageListItems}
				/>
			)}
			<Toggle
				label={__("Smooth Scroll", "post-carousel")}
				attributes={smooth_scroll}
				onChange={(newToggle) => updateStateHandler("smooth_scroll", !newToggle)}
			/>
			{smooth_scroll && (
				<SPRangeControl
					label={__("Transition Delay", "post-carousel")}
					attributes={transition_delay}
					units={["s"]}
					min={0.1}
					max={2}
					step={0.1}
					defaultValue={{ value: 24, unit: "s" }}
					onValueChange={(newValue) =>
						updateStateHandler("transition_delay", { ...transition_delay, value: newValue?.value })
					}
					onUnitChange={(newUnit) =>
						updateStateHandler("transition_delay", { ...transition_delay, unit: newUnit?.unit })
					}
					setCustomReset={true}
				/>
			)}
			<SelectField
				label={__("Entrance Animation", "post-carousel")}
				attributes={entrance_animation}
				onChange={(newValue) => updateStateHandler("entrance_animation", newValue)}
				items={[
					{ label: "Fade In", value: "fade-in" },
					{ label: "Slide In Left", value: "slide-in-left" },
					{ label: "Slide In Right", value: "slide-in-right" },
					{ label: "Slide In Up", value: "slide-in-up" },
				]}
			/>
			<Toggle
				label={__("Go to Bottom", "post-carousel")}
				attributes={go_to_bottom}
				onChange={(newVal) => updateStateHandler("go_to_bottom", !newVal)}
			/>
			{go_to_bottom && (
				<InputControl
					label={__("Back to Bottom Text Label", "post-carousel")}
					attributes={back_bottom_label}
					flex={false}
					inputType="text"
					onChange={(newValue) => updateStateHandler("back_bottom_label", newValue)}
				/>
			)}
		</>
	);
};

export const BackToTopStyle = ({ attributes, props }) => {
	const { setSettingsValue } = props;
	const {
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
		box_shadow_enable_hover,
		box_shadow_hover,
		padding,
	} = attributes?.options;

	const [colorState, setColorState] = useState("color");

	const updateStateHandler = (valueKey, value) => {
		setSettingsValue({ ...attributes, options: { ...attributes.options, [valueKey]: value } });
	};

	const updateSpacingUtilityHandler = (attrKey, attr, type, newUtility) => {
		const updateAttr = { ...attr, [type]: newUtility };
		updateStateHandler(attrKey, updateAttr);
	};

	const updateValueByColorState = (valueKey, value, attr, state) => {
		const updateValue = { ...attr, [state]: value };
		updateStateHandler(valueKey, updateValue);
	};

	return (
		<>
			<TypographyNew
				attributes={{
					family: typography,
					familyKey: "typography",
					fontSize: font_size,
					fontSizeKey: "font_size",
					lineHeight: line_height,
					lineHeightKey: "line_height",
					fontSpacing: letter_spacing,
					fontSpacingKey: "letter_spacing",
					wordSpacing: word_spacing,
					wordSpacingKey: "word_spacing",
				}}
				onStateUpdate={(valueKey, value) => updateStateHandler(valueKey, value)}
			/>
			<SPToggleGroupControl
				attributes={colorState}
				onClick={(newValue) => setColorState(newValue)}
				items={[
					{ label: "Normal", value: "color" },
					{ label: "Hover", value: "hover" },
				]}
			/>
			{colorState === "color" ? (
				<>
					<SpColorPicker
						label={__("Color", "post-carousel")}
						value={color?.color}
						onChange={(newValue) => updateValueByColorState("color", newValue, color, "color")}
					/>
					<Background
						label={__("Background Type", "post-carousel")}
						colorLabel="Solid Color"
						defaultColor="#fff"
						attributes={background_color}
						attributesKey={"background_color"}
						onStateUpdate={(key, value) =>
							updateStateHandler("background_color", value, background_color, "color")
						}
						colorType={"color"}
						items={[
							{
								label: <BgIcon />,
								value: "bgColor",
								tooltip: "Solid",
							},
							{
								label: <GradientIcon />,
								value: "gradient",
								tooltip: "Gradient",
							},
						]}
					/>
					<Toggle
						label={__("Box Shadow", "post-carousel")}
						attributes={box_shadow_enable}
						attributesKey={"box_shadow_enable"}
						onChange={(newVal) => updateStateHandler("box_shadow_enable", !newVal)}
					/>
					{box_shadow_enable && (
						<BoxShadow
							label={__("Shadow Type", "post-carousel")}
							attributes={box_shadow}
							attributesKey={"box_shadow"}
							setAttributes={() => {}}
							onChange={(key, newVal) => updateStateHandler(key, newVal)}
						/>
					)}
				</>
			) : (
				<>
					<SpColorPicker
						label={__("Color", "post-carousel")}
						value={color.hoverColor}
						onChange={(newValue) => updateValueByColorState("color", newValue, color, "hoverColor")}
					/>
					<Background
						label={__("Background Type", "post-carousel")}
						colorLabel="Solid Color"
						defaultColor="#fff"
						attributes={background_color}
						attributesKey={"background_color"}
						onStateUpdate={(key, value) => updateStateHandler("background_color", value)}
						colorType={"hover"}
						items={[
							{
								label: <BgIcon />,
								value: "bgColor",
								tooltip: "Solid",
							},
							{
								label: <GradientIcon />,
								value: "gradient",
								tooltip: "Gradient",
							},
						]}
					/>
					<Toggle
						label={__("Hover Box Shadow", "post-carousel")}
						attributes={box_shadow_enable_hover}
						attributesKey={"box_shadow_enable_hover"}
						onChange={(newVal) => updateStateHandler("box_shadow_enable_hover", !newVal)}
					/>
					{box_shadow_enable_hover && (
						<BoxShadow
							label={__("Hover Shadow Type", "post-carousel")}
							attributes={box_shadow_hover}
							attributesKey={"box_shadow_hover"}
							setAttributes={() => {}}
							onChange={(key, newVal) => updateStateHandler(key, newVal)}
						/>
					)}
				</>
			)}
			<Border
				attributes={{
					border: border,
					borderWidth: border_width,
				}}
				attributesKey={{
					border: "border",
					borderWidth: "border_width",
				}}
				onStateUpdate={(key, newValue) => updateStateHandler(key, newValue)}
			/>
			<Spacing
				label={__("Border Radius", "post-carousel")}
				attributes={border_radius}
				attributesKey={"border_radius"}
				units={["px", "%", "em"]}
				defaultValue={{ unit: "px", value: { top: 4, right: 4, bottom: 4, left: 4 } }}
				onChange={(newValue) => updateStateHandler("border_radius", newValue)}
				onUnitChange={(unit) => updateSpacingUtilityHandler("border_radius", border_radius, "unit", unit)}
				updateAllChange={(newAllChange) =>
					updateSpacingUtilityHandler("border_radius", border_radius, "allChange", newAllChange)
				}
			/>
			<Spacing
				label={__("Padding", "post-carousel")}
				attributes={padding}
				attributesKey={"padding"}
				units={["px", "%", "em"]}
				defaultValue={{ unit: "px", value: { top: 8, right: 16, bottom: 8, left: 12 } }}
				onChange={(newValue) => updateStateHandler("padding", newValue)}
				onUnitChange={(unit) => updateSpacingUtilityHandler("padding", padding, "unit", unit)}
				updateAllChange={(newAllChange) =>
					updateSpacingUtilityHandler("padding", padding, "allChange", newAllChange)
				}
			/>
		</>
	);
};

export const BackToTopPreview = ({ attributes, props }) => {
	const { setSettingsValue } = props;
	const {
		display_position,
		back_to_top_icon,
		top_icon_source,
		back_top_label,
		smooth_scroll,
		entrance_animation,
		go_to_bottom,
		back_bottom_label,
		fontListsEditPage,
		typography,
		icon_size,
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
		display_on,
		exclude_page,
		include_only,
		transition_delay,
	} = attributes?.options;

	const dynamicStyle = useMemo(() => {
		return moduleDynamicCss(attributes?.options);
	}, [attributes?.options]);

	const iconListObj = {
		"top-arrow-one": <BackToTopArrowOne />,
		"top-arrow-two": <BackToTopArrowTwo />,
		"top-arrow-three": <BackToTopArrowThree />,
		"top-arrow-four": <BackToTopArrowFour />,
		"top-arrow-five": <BackToTopArrowFive />,
	};

	const wrapperClass = classNames(
		"sp-smart-post-back-to-top-wrapper",
		`sp-position-${display_position}`,
		`sp-animation-${entrance_animation}`,
		smooth_scroll && " sp-scroll-smooth"
	);

	const updateStateHandler = (valueKey, value) => {
		setSettingsValue({ ...attributes, options: { ...attributes.options, [valueKey]: value } });
	};

	useEffect(() => {
		updateStateHandler("dynamic_style", moduleDynamicCss(attributes?.options));
		// eslint-disable-next-line
	}, [
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
		display_position,
		back_to_top_icon,
		top_icon_source,
		back_top_label,
		smooth_scroll,
		entrance_animation,
		go_to_bottom,
		back_bottom_label,
		fontListsEditPage,
		horizontal_position,
		vertical_position,
		box_shadow_enable_hover,
		box_shadow_hover,
		display_on,
		exclude_page,
		include_only,
		transition_delay,
	]);

	const googleFontLists = [typography];
	useEffect(() => {
		updateStateHandler("fontListsEditPage", googleFonts(googleFontLists));
		// eslint-disable-next-line
	}, [typography]);

	return (
		<>
			<style>{dynamicStyle}</style>
			<style>{fontListsEditPage}</style>
			<div id="sp-smart-post-back-to-top-btn" className={wrapperClass}>
				<div className="sp-smart-post-back-to-top-content">
					<div className="sp-smart-post-back-to-top-button">
						{back_to_top_icon && (
							<span className="sp-smart-post-back-to-top-icon">{iconListObj[top_icon_source]}</span>
						)}
						{back_top_label && (
							<span className="sp-smart-post-back-to-top-text sp-back-to-top-text">{back_top_label}</span>
						)}
						{/* {go_to_bottom && back_bottom_label && (
							<span className="sp-smart-post-back-to-top-text sp-go-to-bottom-text">
								{back_bottom_label}
							</span>
						)} */}
					</div>
				</div>
			</div>
		</>
	);
};
