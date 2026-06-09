import { useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import Toggle from "react-toggle";
import Select from "react-select";
import { SelectField } from "../../../components";
import { saveSettingOptions, renderInfoText, InfoText, SaveAndReset } from "./functions";

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

	const isChanged = initialValues.siteMode !== siteMode || initialValues.selectPage !== selectPage;

	const saveSiteAvailabilityOptions = (actionType = "save") => {
		const updatedSettings = {
			pcp_site_mode: siteMode,
			pcp_select_page: selectPage,
		};
		setIsSaving(true);

		saveSettingOptions(updatedSettings, actionType, setSettingsOptions).then(() => {
			setInitialValues({
				siteMode,
				selectPage,
			});
			setIsSaving(false);
		});
	};

	return (
		<div className="sp-pcp-settings-advanced-controls">
			<div className="sp-pcp-settings-option">
				<div className="sp-pcp-option-label-wrapper">
					<span className="sp-pcp-component-title">
						{__("Site Mode", "post-carousel")}
					</span>
					<span className="sp-pcp-option-help-text">
						{renderInfoText("siteMode")}
					</span>
				</div>
				<div className="sp-pcp-blocks-settings-select-field">
					<SelectField
						value={siteMode}
						onChange={(val) => setSiteMode(val)}
						items={[
							{ label: __("Live", "post-carousel"), value: "live" },
							{
								label: __("Coming Soon (Pro)", "post-carousel"),
								value: "coming_soon",
								disabled: true,
							},
							{
								label: __("Maintenance (Pro)", "post-carousel"),
								value: "maintenance",
								disabled: true,
							},
						]}
					/>
				</div>
			</div>
			{siteMode !== "live" && (
				<div className="sp-pcp-settings-option">
					<div className="sp-pcp-option-label-wrapper">
						<span className="sp-pcp-component-title">{__("Select Page", "post-carousel")}</span>
					</div>
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
		cleanDataOnDelete: phpToJsBool[settingsOptions?.pcp_delete_all_data] || false,
		editorPreference: sp_pcp_block_settings?.pcp_editor_preference || '',
		// googleFonts: phpToJsBool[settingsOptions?.pcp_enqueue_google_font] || false,
	});
	const [isSaving, setIsSaving] = useState(false);

	const [cleanDataOnDelete, setCleanDataOnDelete] = useState(initialValues.cleanDataOnDelete);
	const [editorPreference, setEditorPreference] = useState(initialValues.editorPreference);

	// const [googleFonts, setGoogleFonts] = useState(
	// 	initialValues.googleFonts
	// );

	const isChanged = initialValues.cleanDataOnDelete !== cleanDataOnDelete || initialValues.editorPreference !== editorPreference;

	const saveAdvancedControls = (actionType = "save") => {
		const newCleanOnDelete = cleanDataOnDelete;
		const newEditorPreference = editorPreference;
		// const newGoogleFonts = googleFonts;

		const updatedSettings = {
			pcp_delete_all_data: jsToPhpBool(newCleanOnDelete),
		};
		setIsSaving(true);

		saveSettingOptions(updatedSettings, actionType, setSettingsOptions, null, newEditorPreference).then(() => {
			setInitialValues({
				cleanDataOnDelete: newCleanOnDelete,
				editorPreference: newEditorPreference,
				// googleFonts: newGoogleFonts,
			});
			setIsSaving(false);
		});
	};

	return (
		<div className="sp-pcp-settings-advanced-controls">
			<div className="sp-pcp-settings-option">
				<div className="sp-pcp-option-label-wrapper">
					<span className="sp-pcp-component-title">
						{__("Clean-up Data on Deletion", "post-carousel")}
					</span>
					<span className="sp-pcp-option-help-text">
						{renderInfoText("cleanOnDeletion")}
					</span>
				</div>
				<div className="sp-pcp-blocks-settings-toggle-btn">
					<Toggle
						checked={cleanDataOnDelete}
						icons={false}
						onChange={() => setCleanDataOnDelete(!cleanDataOnDelete)}
					/>
				</div>
			</div>
			<div className="sp-pcp-settings-option">
				<div className="sp-pcp-option-label-wrapper">
					<span className="sp-pcp-component-title">
						{__("Default Editor", "post-carousel")}
					</span>
					<span className="sp-pcp-option-help-text">
						{__("Choose which editor opens when you click 'Add New Show'. Pick 'Ask each time' to keep the welcome popup.", "post-carousel")}
					</span>
				</div>
				<div className="sp-pcp-blocks-settings-select-field">
					<SelectField
						value={editorPreference}
						onChange={(val) => setEditorPreference(val)}
						items={[
							{
								label: __("Ask each time", "post-carousel"),
								value: "",
							},
							{
								label: __("Block Editor", "post-carousel"),
								value: "block_editor",
							},
							{
								label: __("Classic Shortcode", "post-carousel"),
								value: "classic_shortcode",
							},
						]}
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

			<SaveAndReset onSave={() => saveAdvancedControls("save")} isChanged={isChanged} isSaving={isSaving} />
		</div>
	);
};

export const Tools = ({ setPage }) => {
	const [exportType, setExportType] = useState("all-shows");
	const [selectedFile, setSelectedFile] = useState(null);
	const [fileName, setFileName] = useState(__("No File Choosen", "post-carousel"));
	const [shortcodeList, setShortcodeList] = useState([]);
	const [selectedShortcodes, setSelectedShortcodes] = useState([]);
	const [isImporting, setIsImporting] = useState(false);
	const [isDragging, setIsDragging] = useState(false);

	// Fetch shortcode list using AJAX
	useEffect(() => {
		const formData = new FormData();
		formData.append("action", "pcp_get_shortcode_list_for_export");

		fetch(ajaxurl, {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success && Array.isArray(data.data)) {
					const list = data.data.map((post) => ({
						label: post.title || `#${post.id}`,
						value: post.id,
					}));
					setShortcodeList(list);
				} else {
					setShortcodeList([]);
				}
			})
			.catch((error) => {
				console.error("Error fetching shortcode list:", error);
				setShortcodeList([]);
			});
	}, []);

	const handleFileChange = (e) => {
		const file = e.target.files[0];
		if (file) {
			setSelectedFile(file);
			setFileName(file.name);
		}
	};

	const handleDragEnter = (e) => {
		e.preventDefault();
		e.stopPropagation();
		setIsDragging(true);
	};

	const handleDragLeave = (e) => {
		e.preventDefault();
		e.stopPropagation();
		// Only set dragging to false if leaving the actual drop zone
		if (e.target === e.currentTarget) {
			setIsDragging(false);
		}
	};

	const handleDragOver = (e) => {
		e.preventDefault();
		e.stopPropagation();
	};

	const handleDrop = (e) => {
		e.preventDefault();
		e.stopPropagation();
		setIsDragging(false);

		const files = e.dataTransfer.files;
		if (files && files.length > 0) {
			const file = files[0];
			const acceptedExtensions = ['.json', '.csv'];
			const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();

			if (acceptedExtensions.includes(fileExtension)) {
				setSelectedFile(file);
				setFileName(file.name);
			} else {
				alert(__("Please select a valid JSON or CSV file.", "post-carousel"));
			}
		}
	};

	const handleExport = () => {
		// Export functionality
		const exportValue = exportType === "all-shows" ? "all_shortcodes" : "selected_shortcodes";
		const selectedShortcode = exportValue === "selected_shortcodes" ? selectedShortcodes.join(",") : "all_shortcodes";

		if (
			exportValue === "all_shortcodes" ||
			(exportValue === "selected_shortcodes" && selectedShortcodes.length > 0)
		) {
			const formData = new FormData();
			formData.append("action", "pcp_export_shortcodes");
			formData.append("pcp_ids", selectedShortcode);

			fetch(ajaxurl, {
				method: "POST",
				body: formData,
			})
				.then((response) => response.text())
				.then((resp) => {
					if (resp) {
						// Convert JSON Array to string.
						let json;
						try {
							const parsed = JSON.parse(resp);
							json = JSON.stringify(parsed);
						} catch {
							json = JSON.stringify(resp);
						}

						// Convert JSON string to BLOB.
						const blob = new Blob([json], { type: "application/json" });
						const link = document.createElement("a");
						const timestamp = Date.now();
						link.href = window.URL.createObjectURL(blob);
						link.download = "smart-post-show-" + timestamp + ".json";
						link.click();
					}
				});
		}
	};

	const handleImport = () => {
		// Import functionality
		if (selectedFile) {
			setIsImporting(true);
			const reader = new FileReader();
			reader.onload = (e) => {
				const fileContent = e.target.result;
				const formData = new FormData();
				formData.append("action", "pcp_import_shortcodes");
				formData.append("shortcode", fileContent);

				fetch(ajaxurl, {
					method: "POST",
					body: formData,
				})
					.then((response) => response.json())
					.then((data) => {
						setIsImporting(false);
						if (data.success) {
							// alert(__("Import successful!", "post-carousel"));
							setSelectedFile(null);
							setFileName(__("No File Choosen", "post-carousel"));
							setPage("savedTemplate");
						} else {
							alert(data.data?.message || __("Import failed.", "post-carousel"));
						}
					})
					.catch((error) => {
						setIsImporting(false);
						console.error("Import error:", error);
						alert(__("Import failed.", "post-carousel"));
					});
			};
			reader.readAsText(selectedFile);
		}
	};

	return (
		<div className="sp-pcp-settings-tools-controls">
			<div className="sp-pcp-settings-tools-section">
				<div className="sp-pcp-settings-tools-section-header">
					<h3 className="sp-pcp-settings-tools-section-title">{__("Export", "post-carousel")}</h3>
				</div>
				<div className="sp-pcp-settings-tools-section-content">
					<p className="sp-pcp-settings-tools-subtitle">{__("Choose What to Export", "post-carousel")}</p>
					<div className="sp-pcp-settings-tools-radio-group">
						<label className={`sp-pcp-settings-tools-radio ${exportType === "all-shows" ? "active" : ""}`}>
							<input
								type="radio"
								name="export-type"
								value="all-shows"
								checked={exportType === "all-shows"}
								onChange={() => setExportType("all-shows")}
							/>
							<span className="sp-pcp-settings-tools-radio-label">
								{__("All Shows (Shortcodes)", "post-carousel")}
							</span>
						</label>
						<label
							className={`sp-pcp-settings-tools-radio ${exportType === "selected-shows" ? "active" : ""}`}
						>
							<input
								type="radio"
								name="export-type"
								value="selected-shows"
								checked={exportType === "selected-shows"}
								onChange={() => setExportType("selected-shows")}
							/>
							<span className="sp-pcp-settings-tools-radio-label">
								{__("Selected Show(s)", "post-carousel")}
							</span>
						</label>
					</div>

					{exportType === "selected-shows" && (
						<div className="sp-pcp-settings-tools-multiselect">
							<Select
								isMulti
								value={shortcodeList.filter((item) => selectedShortcodes.includes(item.value))}
								onChange={(selectedOptions) => {
									const values = selectedOptions ? selectedOptions.map((opt) => opt.value) : [];
									setSelectedShortcodes(values);
								}}
								options={shortcodeList}
								placeholder={__("Choose show(s)", "post-carousel")}
								className="sp-pcp-tools-multi-select"
								classNamePrefix="sp-pcp-tools"
								noOptionsMessage={() => __("No shows available", "post-carousel")}
							/>
						</div>
					)}
					<button
						className="sp-pcp-settings-tools-btn sp-pcp-settings-tools-btn-primary"
						onClick={handleExport}
					>
						{__("Export File", "post-carousel")}
					</button>
				</div>
			</div>

			<div className="sp-pcp-settings-tools-divider"></div>

			<div className="sp-pcp-settings-tools-section">
				<div className="sp-pcp-settings-tools-section-header">
					<h3 className="sp-pcp-settings-tools-section-title">{__("Import", "post-carousel")}</h3>
				</div>
				<div className="sp-pcp-settings-tools-section-content">
					<p className="sp-pcp-settings-tools-subtitle">
						{__("Import JSON File to Upload", "post-carousel")}
					</p>
					<div
						className={`sp-pcp-settings-tools-file-input${isDragging ? ' dragging' : ''}`}
						onDragEnter={handleDragEnter}
						onDragLeave={handleDragLeave}
						onDragOver={handleDragOver}
						onDrop={handleDrop}
					>
						<label className="sp-pcp-settings-tools-file-btn">
							{__("Choose File", "post-carousel")}
							<input
								type="file"
								accept=".json,.csv"
								onChange={handleFileChange}
								style={{ display: "none" }}
							/>
						</label>
						<span className="sp-pcp-settings-tools-file-name">{fileName}</span>
					</div>
					<button
						className={`sp-pcp-settings-tools-btn sp-pcp-settings-tools-btn-secondary${selectedFile ? " has-file" : ""}`}
						onClick={handleImport}
						disabled={!selectedFile || isImporting}
					>
						{isImporting ? __("Importing...", "post-carousel") : __("Import File", "post-carousel")}
					</button>
				</div>
			</div>
		</div>
	);
};
