import { useRef, useState, useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

import { LeftArrow, RightArrow, TickIcon, RightArrowLong } from "../../icons/icons";
import WelcomePage from "./pages/welcome";
import BlocksSetup from "./pages/setup";
import classNames from "classnames";
import FinishPage from "./pages/finish";
import "../style.scss";
import { BlockPage, cardData } from "../pages/blocks";
import { WEBSITE_BUILDER_BLOCKS } from "../../controls/constants";
import { Toaster } from "react-hot-toast";
import Modules from "../pages/modules";

// const licenseStatus = sp_pcp_block_settings?.license_data?.status || false;
const spPCPSiteType = sp_pcp_block_settings?.sp_ua_site_type;

const SetupWizard = ({ blocksSettings, modulesOptions, blockShowHideHandler }) => {
	const footer = document.querySelector("#wpfooter");

	if (footer) {
		footer.style.display = "none";
	}
	const nextBtnRef = useRef(null);
	const [stepNumber, setStepNumber] = useState(0);
	const [websiteType, setWebsiteType] = useState(spPCPSiteType);
	const [isExiting, setIsExiting] = useState(false);
	const [errorMessage, setErrorMessage] = useState("");

	const [direction, setDirection] = useState("left");
	const [animationClass, setAnimationClass] = useState("");

	const setupSteps = [
		"Welcome",
		"Blocks",
		"Modules",
		"Finish",
	];

	const onAnimationEnd = () => {
		if (isExiting) {
			if (direction === "left") {
				setStepNumber((prev) => prev + 1);
			} else {
				setStepNumber((prev) => prev - 1);
			}
			setAnimationClass("is-entering");
			setIsExiting(false);
		}
	};

	const nextStep = () => {
		setDirection("left");
		setIsExiting(true);
		setAnimationClass("is-exiting");
	};

	const handleNext = () => {
		if (stepNumber === 1 && websiteType === "") {
			setErrorMessage(true);
			return;
		}
		setErrorMessage(false);
		nextStep();
	};

	const handlePrev = () => {
		setDirection("right");
		setIsExiting(true);
		setAnimationClass("is-exiting");
	};

	return (
		<div className="sp-pcp-blocks-setting-wrapper setup-wizard">
			<div className="sp-smart-post-setup-wizard-wrapper">
				<div className={`sp-smart-post-setup-wizard-content`}>
					<div className="sp-smart-post-setup-steps">
						{setupSteps?.map((step, index) => (
							<div className="sp-smart-post-setup-step" key={index}>
								<span
									className={classNames(
										"sp-smart-post-setup-step-number",
										{
											active: index === stepNumber,
											previous: index < stepNumber,
										}
									)}
								>
									{index < stepNumber ? (
										<TickIcon />
									) : (
										"0" + (index + 1)
									)}
								</span>
								<span className="sp-smart-post-setup-step-title">
									{step}
								</span>
								{index !== setupSteps.length - 1 && (
									<RightArrowLong />
								)}
							</div>
						))}
					</div>
					<div
						className={`sp-smart-post-setup-step-page ${animationClass}`}
						onAnimationEnd={onAnimationEnd}
					>
						{setupSteps[stepNumber] === "Welcome" && (
							<WelcomePage />
						)}

						{setupSteps[stepNumber] === "Blocks" && (
							<div className="sp-smart-post-setup-wizard-selected-blocks-page">
								<BlocksSetup
									websiteType={websiteType}
									setWebsiteType={setWebsiteType}
									errorMessage={errorMessage}
								/>
								<div className="sp-smart-post-setup-page-wrapper">
									<h3 className="sp-smart-post-setup-page-title">{__("Enable the Blocks You Need", "post-carousel")}</h3>
									<p className="sp-smart-post-setup-page-desc">
										{__("Turn on the blocks that fit your workflow. You can update your selection anytime.", "post-carousel")}
									</p>
								</div>
								<div className="sp-smart-post-wizard-blocks-container">
									<BlockPage 
										blocksSettings={blocksSettings} 	blockShowHideHandler={blockShowHideHandler}
										type="setup-wizard"
									/>
								</div>
							</div>
						)}
						{setupSteps[stepNumber] === "Modules" && (
							<div className="sp-smart-post-modules-wizard">
								<div className="sp-smart-post-setup-page-wrapper">
									<h3 className="sp-smart-post-setup-page-title">{__("Enable the Modules You Need", "post-carousel")}</h3>
									<p className="sp-smart-post-setup-page-desc">
										{__("Turn on the features that match your workflow. You can update your selection anytime.", "post-carousel")}
									</p>
								</div>
								<Modules 
									modulesOptions={modulesOptions} blockShowHideHandler={blockShowHideHandler}
									type="setup-wizard"
								/>
							</div>
						)}
						{setupSteps[stepNumber] === "Finish" && (
							<FinishPage websiteType={websiteType} />
						)}
					</div>
					<div className="sp-smart-post-setup-wizard-btn-wrapper">
						{stepNumber !== 0 &&
							stepNumber !== setupSteps.length - 1 && (
								<button
									className="sp-smart-post-setup-wizard-nav-btn prev-btn"
									onClick={handlePrev}
								>
									<LeftArrow />
									{__("Previous", "post-carousel")}
								</button>
							)}

						{stepNumber === 0 && (
							<a
								className="sp-smart-post-setup-wizard-nav-btn prev-btn skip-it-btn"
								href={`${sp_pcp_block_settings?.homeUrl}wp-admin/edit.php?post_type=sp_post_carousel&page=pcp_help`}
							>
								{"Skip it"}
							</a>
						)}
						{stepNumber !== setupSteps.length - 1 && (
							<button
								className="sp-smart-post-setup-wizard-nav-btn next-btn"
								onClick={handleNext}
								ref={nextBtnRef}
							>
								{__("Next Step", "post-carousel")}
								<RightArrow />
							</button>
						)}
					</div>
				</div>
			</div>
			<Toaster position="top-right" reverseOrder={false} />
		</div>
	);
};


export default SetupWizard;
