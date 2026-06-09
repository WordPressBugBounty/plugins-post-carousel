import { Modal } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { priceLink } from "../../../blocks/shared/helpFn";

const ProModal = ({ isOpen, onClose, hasPostCarouselPosts = false, onViewMoreBlocks = null }) => {
	if (!isOpen) return null;

	return (
		<Modal className="sp-pcp-pro-modal-components" onRequestClose={onClose}>
			<div className="sp-pcp-pro-modal">
				<div className="sp-pcp-pro-modal-wrapper">
					<span className="sp-pcp-pro-modal-cross" onClick={onClose}>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 24 24"
							width="24"
							height="24"
							aria-hidden="true"
							focusable="false"
						>
							<path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"></path>
						</svg>
					</span>
					<div className="sp-pcp-pro-modal-box">
						<div className="sp-pcp-pro-modal-icon">
							<img
								src={`${sp_pcp_block_settings.pluginUrl}admin/assets/img/proLockIcon.svg`}
								alt="Pro Lock Icon"
							/>
						</div>
						<div className="sp-pcp-pro-modal-info">
							<h5>{__("Create Unlimited Saved Templates with Smart Post Pro", "post-carousel")}</h5>
							<p>
								The free version allows <b style={{backgroundColor: "yellow"}}>two saved templates</b>. Upgrade to Smart Post Pro to create and reuse unlimited templates, saving time while building your site.
							</p>
							<p>
								Note: You can use Smart Post blocks <b>directly on any pages or posts for free</b>.
							</p>
							<a
								href={priceLink}
								target="_blank"
								rel="noreferrer"
								className="sp-pcp-pro-modal-btn"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="22"
									height="22"
									viewBox="0 0 14 14"
									fill="none"
								>
									<path
										d="M8.637 5.535a.99.99 0 0 0 .66.506.92.92 0 0 0 .814-.23l1.725-1.584-.56 4.45H2.735l-.56-4.45L3.9 5.81a.92.92 0 0 0 .813.23c.287-.06.52-.25.66-.505l1.631-2.992z"
										stroke="#fff"
									></path>
									<path
										d="M11.226 12.057H2.784c-.272 0-.492-.269-.492-.6v-1.32h9.424v1.32c0 .331-.22.6-.492.6"
										fill="#fff"
									></path>
								</svg>
								<span>{__("Upgrade to Pro", "post-carousel")}</span>
							</a>
							{hasPostCarouselPosts && onViewMoreBlocks && (
								<p className="sp-pcp-qs-classic-editor-link">
									{__("Switch to Classic Editor?", "post-carousel")}{" "}
									<span
										onClick={() => onViewMoreBlocks("settings=advanced")}
										style={{ cursor: "pointer", textDecoration: "underline" }}
									>
										{__("Click here", "post-carousel")}
									</span>
								</p>
							)}
						</div>
					</div>
				</div>
			</div>
		</Modal>
	);
};

export default ProModal;
