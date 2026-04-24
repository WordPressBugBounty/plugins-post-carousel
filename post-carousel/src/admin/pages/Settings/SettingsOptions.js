import { useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import Toggle from "react-toggle";
import {
	SelectField,
} from "../../../components";
import {
	saveSettingOptions,
	renderInfoText,
	InfoText,
	SaveAndReset,
} from "./functions";

const jsToPhpBool = (val) => {
	return val ? "1" : "0";
};

const phpToJsBool = {
	0: false,
	1: true,
};

export const SiteAvailability = ({ settingsOptions, setSettingsOptions }) => {
	const [initialValues, setInitialValues] = useState({
		siteMode: settingsOptions?.pcp_site_mode || "live",
		selectPage: settingsOptions?.pcp_select_page || "",
	});
	const [siteMode, setSiteMode] = useState(initialValues.siteMode);
	const [selectPage, setSelectPage] = useState(initialValues.selectPage);
	const [pages, setPages] = useState([]);
	const [isSaving, setIsSaving] = useState(false);

	const isChanged =
		initialValues.siteMode !== siteMode ||
		initialValues.selectPage !== selectPage;

	const saveSiteAvailabilityOptions = (actionType = "save") => {
		const updatedSettings = {
			pcp_site_mode: siteMode,
			pcp_select_page: selectPage,
		};
		setIsSaving(true);

		saveSettingOptions(
			updatedSettings,
			actionType,
			setSettingsOptions
		).then(() => {
			setInitialValues({
				siteMode,
				selectPage,
			});
			setIsSaving(false);
		});
	};

	return (
		<div className="sp-pcp-settings-advanced-controls">
			<div className="sp-pcp-settings-select-field sp-pcp-settings-option">
				<span className="sp-pcp-component-title site-mode-title">
					{__("Site Mode", "post-carousel")}
					<InfoText text={renderInfoText("siteMode")} />
				</span>
				<div className="sp-pcp-blocks-settings-select-field">
					<SelectField
						value={siteMode}
						onChange={(val) => setSiteMode(val)}
						items={[
							{ label: __("Live", "post-carousel"), value: "live" },
							{ 
								label: __("Coming Soon (Pro)", "post-carousel"), value: "coming_soon",
								disabled: true 
							},
							{ 
								label: __("Maintenance (Pro)", "post-carousel"), value: "maintenance",
								disabled: true
							},
						]}
					/>
				</div>
			</div>
			{siteMode !== "live" && (
				<div className="sp-pcp-settings-select-field sp-pcp-settings-option">
					<span className="sp-pcp-component-title">
						{__("Select Page", "post-carousel")}
					</span>
					<div className="sp-pcp-blocks-settings-select-field">
						<SelectField
							value={selectPage}
							onChange={(val) => setSelectPage(val)}
							items={pages}
							defaultOption={true}
						/>
					</div>
				</div>
			)}
			<SaveAndReset
				onSave={() => saveSiteAvailabilityOptions("save")}
				isChanged={isChanged}
				isSaving={isSaving}
			/>
		</div>
	);
};

export const Advanced = ({ settingsOptions, setSettingsOptions }) => {
	const [initialValues, setInitialValues] = useState({
		cleanDataOnDelete:
			phpToJsBool[settingsOptions?.pcp_delete_all_data] || false,
			// googleFonts: phpToJsBool[settingsOptions?.pcp_enqueue_google_font] || false,
	});
	const [isSaving, setIsSaving] = useState(false);

	const [cleanDataOnDelete, setCleanDataOnDelete] = useState(
		initialValues.cleanDataOnDelete
	);

	// const [googleFonts, setGoogleFonts] = useState(
	// 	initialValues.googleFonts
	// );

	const isChanged =
		initialValues.cleanDataOnDelete !== cleanDataOnDelete;

	const saveAdvancedControls = (actionType = "save") => {
		const newCleanOnDelete = cleanDataOnDelete;
		// const newGoogleFonts = googleFonts;

		const updatedSettings = {
			pcp_delete_all_data: jsToPhpBool(newCleanOnDelete),
		};
		setIsSaving(true);

		saveSettingOptions(
			updatedSettings,
			actionType,
			setSettingsOptions
		).then(() => {
			setInitialValues({
				cleanDataOnDelete: newCleanOnDelete,
				// googleFonts: newGoogleFonts,
			});
			setIsSaving(false);
		});
	};

	return (
		<div className="sp-pcp-settings-advanced-controls">
			<div className="sp-pcp-settings-toggle sp-pcp-settings-option">
				<span className="sp-pcp-component-title">
					{__("Clean-up Data on Deletion", "post-carousel")}
					<InfoText text={renderInfoText("cleanOnDeletion")} />
				</span>
				<div className="sp-pcp-blocks-settings-toggle-btn">
					<Toggle
						checked={cleanDataOnDelete}
						icons={false}
						onChange={() => setCleanDataOnDelete(!cleanDataOnDelete)}
					/>
				</div>
			</div>
			{/* <div className="sp-pcp-settings-toggle sp-pcp-settings-option">
				<span className="sp-pcp-component-title">
					{__("Google Fonts", "post-carousel")}
				</span>
				<div className="sp-pcp-blocks-settings-toggle-btn">
					<Toggle
						checked={googleFonts}
						icons={false}
						onChange={() => setGoogleFonts(!googleFonts)}
					/>
				</div>
			</div> */}

			<SaveAndReset
				onSave={() => saveAdvancedControls("save")}
				isChanged={isChanged}
				isSaving={isSaving}
			/>
		</div>
	);
};
