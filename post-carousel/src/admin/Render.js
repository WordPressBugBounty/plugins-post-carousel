import { useEffect, useState } from "@wordpress/element";
import { Toaster, toast } from "react-hot-toast";
import Header from "./components/layout/Header";
import "./style.scss";
import useGetOptions from "./hooks/getOptions";
import BlockPage from "./pages/blocks";
import QuickStart from "./pages/quick-start";
import Modules from "./pages/modules";
import SavedTemplate from "./pages/saved-template";
import "./editor.scss";
import LightToPro from "./pages/lite-to-pro";
import AboutUs from "./pages/about-us";
import SetupWizard from "./setup-wizard";
import "./setup-wizard/setup-wizard.scss";
import Settings from "./pages/Settings/Settings";
import Integrations from "./pages/integrations";

// Inject Crisp chat script
const initCrispChat = () => {
    if (window.$crisp) {
        return;
    }
    window.$crisp = [];
    window.CRISP_WEBSITE_ID = "3770a55e-947f-424d-87b8-d93a86f2cd7b";
    (function () {
        const d = document;
        const s = d.createElement("script");
        s.src = "https://client.crisp.chat/l.js";
        s.async = 1;
        d.getElementsByTagName("head")[0].appendChild(s);
    })();
};

const options = sp_pcp_block_settings.getOptions;
const modules = sp_pcp_block_settings?.modulesOptions;
const integrations = sp_pcp_block_settings?.integrationOptions;

const Render = () => {
	const hashValue = window.location.hash.replace("#", "").split("=")[0];
	const hashTabValue = window.location.hash.replace("#", "").split("=")[1];

	const [blocksSettings, setBlocksSettings] = useState(options);
	const [modulesOptions, setModulesOptions] = useState(modules);
	const [integrationOptions, setIntegrationOptions] = useState(integrations);

	const [page, setPage] = useState(hashValue ? hashValue : "quick-start");

	const postMenu = document.querySelector("#menu-posts-sp_post_carousel .wp-submenu");
	const allItems = postMenu?.querySelectorAll("li");

	useEffect(() => {
		const removeCurrentClass = () => {
			allItems?.forEach((element) => {
				element.classList.remove("current");
			});
		};

		const postMenuAction = (e) => {
			const currentItem = e.target.closest("li");
			removeCurrentClass();
			currentItem?.classList.add("current");

			setTimeout(() => {
				setPage(window.location.hash.replace("#", ""));
			}, 0);
		};

		// Extract base page name from page value (e.g., "settings" from "settings=advanced")
		const basePageName = page.includes("=") ? page.split("=")[0] : page;
		const pageLink = ["blocks", "savedTemplate", "settings", "lite-vs-pro"].includes(basePageName) ? basePageName : "pcp_help";

		const blocksMenuLi = postMenu.querySelector(`a[href$="${pageLink}"]`)?.closest("li");

		if(blocksMenuLi) {
			removeCurrentClass();
			blocksMenuLi.classList.add("current");
		}

		const recommendedPage = document.querySelector(".spspc-recommended-page");

		if("our-plugins" === page && recommendedPage) {
			recommendedPage.style.display = "block";
		}

		postMenu?.addEventListener("click", postMenuAction);

		return () => postMenu?.removeEventListener("click", postMenuAction);
	}, [page]);

	// Initialize Crisp chat
	useEffect(() => {
		initCrispChat();
	}, []);

	// Update hash when page changes (for pages with tab parameters like settings=advanced)
	useEffect(() => {
		if (page && page.includes("=")) {
			window.location.hash = `#${page}`;
		}
	}, [page]);

	const successMes = useGetOptions(blocksSettings, modulesOptions, integrationOptions);

	const notify = (message, type = "success") => {
		if (type === "success") {
			toast.success(message, { style: { marginTop: "20px" } });
		} else if (type === "error") {
			toast.error(message, { style: { marginTop: "20px" } });
		} else {
			toast(message, { style: { marginTop: "20px" } });
		}
	};

	const blockShowHideHandler = (block_name, type = "block-option") => {
		const notifyChange = (name, currentValue, kind = "block") => {
			if (successMes) {
				notify(`The ${kind} has been ${currentValue ? "disabled" : "enabled"}`);
			}
		};

		if (type === "block-option") {
			const newData = blocksSettings?.map((item) =>
				item.block_name === block_name ? { ...item, show: !item.show } : item
			);
			const findCurrentBlock = blocksSettings.find((block) => block.block_name === block_name);
			notifyChange(block_name, findCurrentBlock?.show, "block");
			setBlocksSettings(newData);
		}

		if (type === "modules-option") {
			const moduleData = modulesOptions?.map((item) => {
				return item.module_name === block_name ? { ...item, show: !item.show } : item;
			});
			const findCurrentModule = modulesOptions.find((item) => item.module_name === block_name);
			notifyChange(block_name, findCurrentModule?.show, "module");
			setModulesOptions(moduleData);
		}

		if (type === "integration-option") {
			const integrationData = integrationOptions?.map((item) => {
				return item.name === block_name ? { ...item, show: !item.show } : item;
			});
			const findCurrentIntegration = integrationOptions.find((item) => item.name === block_name);
			notifyChange(block_name, findCurrentIntegration?.show, "integration");
			setIntegrationOptions(integrationData);
		}
	};

	const enabledSavedTemplate = modulesOptions?.some((item) => item.module_name === "saved-template" && item.show);

	if (page === "setupwizard") {
		return <SetupWizard
			blocksSettings={blocksSettings}
			modulesOptions={modulesOptions}
			blockShowHideHandler={blockShowHideHandler}
		/>;
	}

	return (
		<>
			<Header setPage={setPage} page={page} modulesOptions={modulesOptions} />

			<div className="sp-pcp-blocks-setting-wrapper">
				{(page === "quick-start" || "" === page) && <QuickStart blocksSettings={blocksSettings} blockShowHideHandler={blockShowHideHandler} setPageAndHash={setPage} modulesOptions={modulesOptions} />}
				{page === "blocks" && (
					<BlockPage blocksSettings={blocksSettings} blockShowHideHandler={blockShowHideHandler} />
				)}
				{page === "modules" && (
					<Modules modulesOptions={modulesOptions} blockShowHideHandler={blockShowHideHandler} />
				)}
				{page === "lite-vs-pro" && <LightToPro />}
				{page === "about-us" && <AboutUs />}
				{( page === "savedTemplate" && enabledSavedTemplate ) && <SavedTemplate />}
				{page === "integrations" && <Integrations 
					integrationOptions={integrationOptions}
					blockShowHideHandler={blockShowHideHandler}
				/>}
				{(page === "settings" || page?.startsWith("settings=")) && <Settings setPage={setPage} />}
			</div>

			<Toaster position="top-right" reverseOrder={false} />
		</>
	);
};

export default Render;
