import axios from "axios";
import { __ } from "@wordpress/i18n";
import toast from "react-hot-toast";
import { Modal, Spinner } from "@wordpress/components";
import { Arrow, InfoIcon } from "../../../icons/icons";
import { createInterpolateElement } from "@wordpress/element";

export const saveSettingOptions = async (settings, actionType = "save", setSettingsOptions, shareData) => {
	try {
		const formData = new FormData();

		formData.append("nonce", sp_pcp_block_settings.nonce);
		formData.append("action", "sp_pcp_update_setting_options");
		formData.append("optionData", JSON.stringify(settings));
		if (shareData !== undefined) {
			formData.append("shareData", JSON.stringify(shareData));
		}

		const response = await axios.post(ajaxurl, formData);

		if (response?.data?.success) {
			if (actionType === "save") {
				toastSuccessMsg(__("Saved successfully", "post-carousel"));
			} else {
				toastSuccessMsg(__("Reset successfully", "post-carousel"));
			}
			setSettingsOptions(response?.data?.data?.options);
		} else {
			toastErrorMsg(__("Something Went Wrong", "post-carousel"));
			return { success: false, data: response.data };
		}
	} catch (error) {
		toastErrorMsg(__("Something Went Wrong", "post-carousel"));
		console.error(error);
		return { success: false, error };
	}
};

export const toastSuccessMsg = (message) => {
	return toast.success(message, {
		style: {
			marginTop: "28px",
			fontSize: "15px",
			padding: "10px 18px",
		},
	});
};

export const toastErrorMsg = (message) => {
	return toast.error(message, {
		style: {
			marginTop: "28px",
			fontSize: "15px",
			padding: "10px 18px",
		},
	});
};

export const UserDataInfoModal = ({ closeModal }) => {
	return (
		<Modal
			title={__("What We Collect?", "post-carousel")}
			onRequestClose={closeModal}
			className="sp-smart-post-setup-page-modal"
		>
			<hr />
			<p className="modal-description">
				{__(
					"We collect only non-sensitive diagnostic data and basic plugin usage information. This may include:",
					"post-carousel"
				)}
			</p>
			<ul>
				<li className="modal-description">{__("WordPress & PHP version", "post-carousel")}</li>
				<li className="modal-description">{__("Active theme and plugins", "post-carousel")}</li>
				<li className="modal-description">{__("General system details", "post-carousel")}</li>
				<li className="modal-description">
					{__("Email address only for sending helpful updates or optional offers.", "post-carousel")}
				</li>
			</ul>
			<p className="modal-description">
				{__(
					"This information helps us improve performance, fix issues faster, and ensure Smart Post stays compatible with the popular plugins and themes.",
					"post-carousel"
				)}
			</p>
			<p className="modal-description">
				<b>{__(
					"No personal data is collected, and we never send spam—promise.",
					"post-carousel"
				)}</b>
			</p>
			<p className="modal-description">
				<b>{__("Your privacy comes first.", "post-carousel")}</b>
				{" "}
				<a href="https://wpsmartpost.com/information-we-collect/" target="_blank" className="modal-description">
					{__("Learn More", "post-carousel")}
					<Arrow />
				</a>
			</p>
		</Modal>
	);
};

export const InfoText = ({ text }) => {
	return (
		<span className="sp-pcp-settings-info">
			<InfoIcon />
			<span className="sp-pcp-settings-info-text">{text}</span>
		</span>
	);
};

export const renderInfoText = (label) => {
	const infoTexts = {
		cleanOnDeletion: __(
			"Check this box if you would like Smart Post to completely clean-up all of its data when the plugin is deleted.",
			"post-carousel"
		),
		siteMode: createInterpolateElement(
			__(
				`Choose a mode based on your website's current status.
			<strong>Live:</strong> Select this when your website is ready for visitors and should be fully accessible.
			<strong>Coming Soon:</strong> Choose this if your site is still in progress and not ready to go public.
			<strong>Maintenance:</strong> Use this when updating your site and temporarily limiting visitor access.`,
				"post-carousel"
			),
			{
				strong: <strong />,
			}
		),
		// ... other info texts will be added here if necessary.
	};
	return infoTexts[label];
};

export const SaveAndReset = ({ onSave, onReset, isChanged, isSaving }) => {
	return (
		<div className={`sp-pcp-settings-save-wrapper`}>
			<button className={`sp-pcp-settings-save-btn ${isChanged ? "active" : ""}`} onClick={onSave}>
				{isSaving ? (
					<>
						<Spinner /> {__("Saving…", "post-carousel")}
					</>
				) : (
					<>{__("Save Changes", "post-carousel")}</>
				)}
			</button>
		</div>
	);
};
