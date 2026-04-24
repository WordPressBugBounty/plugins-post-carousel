import Toggle from "react-toggle";
import { Demos, Docs } from "./icons";
import ProBadge from "./pro-badge";

// Blocks settings page block on/off card component.
const Card = ({ blockName, attributes, blockShowHideHandler, blocksSettings, type = "" }) => {
	const findBlockData = blocksSettings?.find((item) => blockName === item.block_name);

	if (!findBlockData) {
		return;
	}

	const { show } = findBlockData;

	const Icon = attributes?.Icon || null;
	const demoLink = attributes?.demoLink || null;
	const docLink = attributes?.docLink || null;
	const title = attributes?.title || null;
	const pro = attributes?.pro || null;

	return (
		<div className={`sp-pcp-blocks-settings-card${pro ? " sp-pcp-pro-card" : ""}`}>
			<div className="sp-pcp-blocks-settings-card-info">
				{pro && <ProBadge />}
				<div className="sp-pcp-blocks-settings-card-icon">
					<Icon />
				</div>
				<div className="sp-pcp-blocks-settings-card-docs">
					<div className="sp-pcp-blocks-settings-card-title">
						<h4>{title}</h4>
						{/* {("setup-wizard" !== type && pro) && <ProBadge />} */}
					</div>
					{"setup-wizard" !== type && <ul>
						<li>
							<a target="_blank" href={docLink} rel="noreferrer">
								<Docs /> Docs
							</a>
						</li>
						<li>
							{/* <a target="_blank" href={ demoLink }> */}
							{demoLink && (
								<a target="_blank" href={demoLink || null} rel="noreferrer">
									<Demos /> Demo
								</a>
							)}
						</li>
					</ul>}
				</div>
			</div>

			<div className="sp-pcp-blocks-settings-toggle-btn">
				<Toggle defaultChecked={pro ? false : show} icons={false} onChange={() => blockShowHideHandler(blockName)} />
			</div>
		</div>
	);
};

export default Card;
