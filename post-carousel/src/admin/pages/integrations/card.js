import Toggle from "react-toggle";
import { __ } from "@wordpress/i18n";
import { Demos, Docs } from "../../template-parts/icons";

const IntegrateCard = ({ data, isDisabled = false, value, integrationName, blockShowHideHandler }) => {

    const { Icon, title, text, docsLink, demoLink, upcoming } = data || {};
    const disabledClass = isDisabled ? " sp-disabled" : "";

    return (
        <>
            <div className={`sp-pcp-blocks-settings-card${disabledClass}`}>
                <div className="sp-pcp-blocks-settings-card-info">
                    <div className="sp-pcp-blocks-settings-card-icon">
                        <Icon />
                    </div>

                    <div className="sp-pcp-blocks-settings-card-docs">
                        <h4>{title} 
                            {upcoming && <span className="sp-smart-upcoming">upcoming</span>}
                        </h4>
                        <span>{text}</span>

                        <ul>
                            {docsLink && (
                                <li>
                                    <a target="_blank" href={docsLink} rel="noreferrer">
                                        <Docs /> Docs
                                    </a>
                                </li>
                            )}

                            {demoLink && (
                                <li>
                                    <a target="_blank" href={demoLink} rel="noreferrer">
                                        <Demos /> Demo
                                    </a>
                                </li>
                            )}
                        </ul>
                    </div>
                </div>

                <div className="sp-pcp-blocks-settings-toggle-btn">
                    <Toggle
                        defaultChecked={value}
                        icons={false}
                        onChange={() => blockShowHideHandler(integrationName, "integration-option")}
                    />
                </div>
            </div>
        </>
    );
};

export default IntegrateCard;
