import { __ } from "@wordpress/i18n";
import { useState } from "@wordpress/element";
import { CheckboxControl, Spinner } from "@wordpress/components";
import axios from "axios";
import { toastErrorMsg, UserDataInfoModal } from "../../pages/Settings/functions";
import { RightArrow } from "../../../icons/icons";

const FinishPage = ({ websiteType }) => {
	const phpToJsBool = {
		0: false,
		1: true,
	};
	const initialConsent =
		sp_pcp_block_settings?.sp_pcp_user_consent === "undefined"
			? true
			: phpToJsBool[sp_pcp_block_settings?.sp_pcp_user_consent];
	const [shareData, setShareData] = useState(initialConsent);
	const [isFinishing, setIsFinishing] = useState(false);

	const [isOpenModal, setOpenModal] = useState(false);
	const openModal = () => setOpenModal(true);
	const closeModal = () => setOpenModal(false);

	const saveUserData = async () => {
		setIsFinishing(true);
		try {
			const formData = new window.FormData();
			formData.append("action", "sp_smart_post_get_user_consent");
			formData.append("nonce", sp_pcp_block_settings.nonce);
			formData.append("shareData", JSON.stringify(shareData));
			formData.append("website_type", websiteType);

			const response = await axios.post(ajaxurl, formData);

			if (response?.data?.success) {
				window.location.href = `${sp_pcp_block_settings?.homeUrl}wp-admin/admin.php?page=pcp_help`;
			}
		} catch (error) {
			toastErrorMsg(__("Something Went Wrong", "post-carousel"));
			return { success: false, error };
		} finally {
			setIsFinishing(false);
		}
	};

	return (
		<div className="sp-smart-post-setup-finish-page">
			<div className="sp-smart-post-setup-plugin-logo-wrapper">
				<img src={`${sp_pcp_block_settings?.wizardImages}/plugin-logo.svg`} alt="Plugin Logo" />
			</div>
			<img src={`${sp_pcp_block_settings?.wizardImages}/congratulations.svg`} alt="Congratulations" />
			<h3 className="sp-smart-post-setup-page-title">
				{__("All Set to Create Your Website!", "post-carousel")}
			</h3>
			<p className="sp-smart-post-setup-page-desc" style={{ width: "636px", textAlign: "center" }}>
				{__(
					"You’re ready to build your website with Smart Post. Enjoy a seamless, efficient content-building experience—no coding, no complications.",
					"post-carousel"
				)}
			</p>
			<button
				className="sp-smart-post-setup-wizard-nav-btn next-btn"
				onClick={saveUserData}
				disabled={isFinishing}
				aria-busy={isFinishing ? "true" : "false"}
			>
				{isFinishing ? (
					<>
						<Spinner /> {__("Finishing…", "post-carousel")}
					</>
				) : (
					__("Finish & Let's Get Started", "post-carousel")
				)}
			</button>
			<div className="sp-smart-post-setup-finish-page-banner">
				{/* <div className="sp-smart-post-setup-finish-page-left-banner-img">
					<img src={`${sp_pcp_block_settings?.wizardImages}finish-page-banner-left.png`} alt="smart post" />
				</div> */}
				<div className="sp-smart-post-setup-finish-page-banner-content">
					<h4 className="sp-smart-post-setup-page-title">
						{__("Effortlessly Create Stunning Post Layouts for Blogs, News & Any Website—With Smart Post", "post-carousel")}
					</h4>
					<p>Trusted by <b>30,000+</b> bloggers, writers, creators, agencies, marketers, and design professionals.</p>
					<div className="sp-smart-post-setup-wizard-btn">
						{/* <a
							className="sp-smart-post-upgrade-btn pro-btn"
							href="https://wpsmartpost.com/patterns/"
							target="_blank"
						>
							<span className="sp-go-pro-icon"></span>
							{__("Upgrade to Pro!", "post-carousel")}
						</a> */}
						<a className="sp-smart-post-upgrade-btn-wrapper" href="https://wpsmartpost.com/pricing/?ref=1" target="_blank">
							<span className="sp-smart-post-upgrade-btn">
								<span className="sp-go-pro-icon"></span>
								{__("Upgrade to Pro!", "post-carousel")}
							</span>
						</a>
						<a
							className="sp-smart-post-setup-wizard-nav-btn prev-btn"
							href="https://wpsmartpost.com/patterns/"
							target="_blank"
						>
							{__("Explore All Patterns", "post-carousel")}
							<RightArrow />
						</a>
					</div>
				</div>
				<div className="sp-smart-post-setup-finish-page-right-banner-img">
					<img src={`${sp_pcp_block_settings?.wizardImages}wizard-banner-footer.png`} alt="smart post" />
				</div>
			</div>
			<div className="sp-smart-post-checkbox-component-wrapper">
				<p className="sp-smart-post-setup-page-desc">
					{__(
						"Help us improve Smart Post and get useful tips by sharing non-sensitive diagnostic data. See ",
						"post-carousel"
					)}
					<span
						className="sp-smart-post-modal-btn"
						style={{
							fontWeight: "600",
							textDecoration: "underline",
						}}
						onClick={openModal}
					>
						{__("what we collect.", "post-carousel")}
					</span>
				</p>
				<CheckboxControl
					checked={shareData}
					onChange={() => setShareData(!shareData)}
					__nextHasNoMarginBottom
				/>
			</div>
			{isOpenModal && <UserDataInfoModal closeModal={closeModal} />}
		</div>
	);
};

export default FinishPage;
