import IntegrateCard from "./card";
import {
    ElementorIcon,
    DiviIcon,
    WPBakeryIcon,
    Oxygen,
    Beaver,
    Bricks,
} from "./icons";

const integrationData = {
    elementor: {
        Icon: ElementorIcon,
        title: "Elementor",
        text: "This addon lets you use Smart Post Gutenberg blocks in Elementor as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-elementor/",
    },
    divi: {
        title: "Divi",
        Icon: DiviIcon,
        text: "This addon lets you use Smart Post Gutenberg blocks in Divi as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-divi/",
    },
    wpbakery: {
        title: "WPBakery",
        Icon: WPBakeryIcon,
        text: "This addon lets you use Smart Post Gutenberg blocks in WPBakery as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-wpbakery/",
    },
    oxygen: {
        title: "Oxygen",
        Icon: Oxygen,
        text: "This addon lets you use Smart Post Gutenberg blocks in Oxygen as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-oxygen/",
    },
    beaver: {
        title: "Beaver Builder",
        Icon: Beaver,
        text: "This addon lets you use Smart Post Gutenberg blocks in Beaver as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-beaver-builder/",
    },
    bricks: {
        title: "Bricks",
        Icon: Bricks,
        text: "This addon lets you use Smart Post Gutenberg blocks in Bricks as reusable shortcodes with Saved Templates.",
        // demoLink: "#",
        docsLink: "https://wpsmartpost.com/docs/integrate-with-gutenberg-editor/integrate-with-bricks/",
    },
};

const Integrations = ({ integrationOptions, blockShowHideHandler }) => {
    return (
        <>
            <div className="sp-pcp-blocks-setting-modules-page">
                <div className="sp-pcp-page-section-title">
                    <h3 className="sp-pcp-blocks-setting-title">Control Page Builder Addons</h3>
                    <span>Turn page builder addons on or off as needed to improve performance.</span>
                </div>
                {Object.entries(integrationData)?.map(([name, data]) => {
                    const toggleValue = integrationOptions.find((item) => item?.name === name)?.show;

                    return <IntegrateCard 
                        key={name} 
                        itemName={name} 
                        data={data}
                        value={toggleValue}
                        integrationName={name}
                        blockShowHideHandler={blockShowHideHandler}
                    />;
                })}
            </div>
        </>
    );
};

export default Integrations;
