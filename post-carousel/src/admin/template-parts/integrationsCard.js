import Toggle from "react-toggle";
import { Demos, Docs, GearIcon } from "./icons";
import { useState } from "@wordpress/element";
import { Modal } from "@wordpress/components";

const IntegrationsCard = ({
	attributes,
	blockName,
	blockShowHideHandler,
	value,
	isDisabled = false,
	token,
	updateIntegrateToken,
}) => {
	const { Icon, title, text, docsLink, demoLink } = attributes;
	const disabledClass = isDisabled ? " sp-disabled" : "";
	const [isOpen, setIsOpen] = useState(false);
	const [apiToken, setApiToken] = useState(token);

	return (
		<>
			<div className={`sp-pcp-blocks-settings-card${disabledClass}`}>
				<div className="sp-pcp-blocks-settings-card-info">
					<div className={`sp-pcp-blocks-settings-card-icon sp-${blockName}`}>
						{!attributes?.imgUrl ? <Icon /> : <img src={attributes?.imgUrl} alt={title} width={"44px"} />}
					</div>
					<div className="sp-pcp-blocks-settings-card-docs">
						<h4>{title}</h4>
						<span>{text}</span>
						<ul>
							<li>
								<a target="_blank" href={docsLink} rel="noreferrer">
									<Docs /> Docs
								</a>
							</li>
							<li>
								<a target="_blank" href={demoLink} rel="noreferrer">
									<Demos /> Demo
								</a>
							</li>
							<li>
								<span
									className="sp-pcp-blocks-settings-card-ai-settings"
									onClick={() => setIsOpen((prev) => !prev)}
								>
									<GearIcon />
								</span>
							</li>
						</ul>
					</div>
				</div>

				<div className="sp-pcp-blocks-settings-toggle-btn">
					<Toggle
						defaultChecked={value}
						icons={false}
						onChange={() => blockShowHideHandler(blockName, "integrates-options")}
						disabled={isDisabled}
					/>
				</div>
			</div>
			{isOpen && (
				<Modal
					icon={<Icon />}
					title={title}
					onRequestClose={() => setIsOpen(false)}
					className="sp-pcp-blocks-settings-popup-container"
				>
					<div className="sp-pcp-blocks-settings-popup-setup">
						<div className="sp-pcp-blocks-settings-body">
							<div className="sp-pcp-blocks-settings-body-content">
								<div className="sp-pcp-blocks-settings-form">
									<div className="sp-pcp-blocks-settings-label">Token:</div>
									<div className="sp-pcp-blocks-settings-input">
										<input
											name="api_token_field"
											type="text"
											className="sp-pcp-blocks-settings-input-field"
											placeholder="Please enter you api token "
											onChange={(e) => setApiToken(e?.target?.value)}
											value={apiToken || ""}
										/>
									</div>
								</div>
								<div className="sp-pcp-blocks-settings-form-save">
									<button
										className="sp-pcp-blocks-settings-form-save-btn"
										onClick={() => {
											updateIntegrateToken(blockName, apiToken);
										}}
									>
										Save Token
									</button>
								</div>
							</div>
						</div>
					</div>
				</Modal>
			)}
		</>
	);
};

export default IntegrationsCard;
