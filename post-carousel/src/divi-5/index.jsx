/**
 * Smart Post Show Pro - Divi 5 Module
 *
 * React component for Divi 5 Visual Builder
 * Uses useFetch pattern following official Divi 5 Dynamic Module example
 *
 * @package Smart_Post_Show_Pro
 */

import metadata from "./module.json";
import { SettingsContent } from "./settings-content";
import "./module-icons"; // Import to register custom icon

// Access React from global scope (Divi provides this).
const React = window?.vendor?.React;
const { useEffect, useRef } = React || {};

// Access Divi globals - these are provided by Divi in the window object
const ModuleContainer = window?.divi?.module?.ModuleContainer;
const StyleContainer = window?.divi?.module?.StyleContainer;
const elementClassnames = window?.divi?.module?.elementClassnames;
const registerModule = window?.divi?.moduleLibrary?.registerModule;
const addAction = window?.vendor?.wp?.hooks?.addAction;
const useFetch = window?.divi?.rest?.useFetch;

/**
 * Styles Component
 * Generates module styles
 */
const ModuleStyles = ({ elements, settings, mode, state, noStyleTag }) => {
	return (
		<StyleContainer mode={mode} state={state} noStyleTag={noStyleTag}>
			{elements.style({
				attrName: "module",
				styleProps: { disabledOn: { disabledModuleVisibility: settings?.disabledModuleVisibility } },
			})}
		</StyleContainer>
	);
};

/**
 * Script Data Component
 * Outputs module script data
 */
const ModuleScriptData = ({ elements }) => {
	return <>{elements.scriptData({ attrName: "module" })}</>;
};

/**
 * Classnames Function
 * Adds module CSS classes
 */
const moduleClassnames = ({ classnamesInstance, attrs }) => {
	classnamesInstance.add(elementClassnames({ attrs: attrs?.module?.decoration ?? {} }));
};

/**
 * Edit Renderer Component
 *
 * Uses useFetch pattern following official Divi 5 Dynamic Module example.
 * Fetches template HTML from REST API for visual builder.
 * CSS and Google Fonts are now included inline in the HTML response.
 */
const EditRenderer = ({ attrs, id, name, elements }) => {
	const templateId = attrs?.templateId?.innerContent?.desktop?.value || "0";

	// useFetch hook for fetching template HTML from REST API.
	const { fetch, response, isLoading } = useFetch(null);

	// Reference for handling fetch abort (following Divi 5 pattern).
	const fetchAbortRef = useRef(null);

	// Track last fetched template ID to prevent duplicate requests.
	const lastFetchedRef = useRef(null);

	// Load template HTML when templateId changes (following Divi 5 pattern).
	useEffect(() => {
		// Don't fetch if no template selected.
		if (!templateId || templateId === "0") {
			return;
		}

		// Prevent duplicate requests for the same template ID.
		if (lastFetchedRef.current === templateId) {
			return;
		}

		// Mark this template as being fetched.
		lastFetchedRef.current = templateId;

		// Abort previous fetch if there's any.
		if (fetchAbortRef.current) {
			fetchAbortRef.current.abort();
		}

		// Create new AbortController instance.
		fetchAbortRef.current = new AbortController();

		// Fetch template HTML from REST API (following Divi 5 useFetch pattern).
		// Response includes HTML with inline CSS and Google Fonts.
		fetch({
			method: "GET",
			restRoute: `/spsp/divi5/v1/template-html?template_id=${templateId}`,
		})
			.then(() => {
				setTimeout(() => {
					if (typeof window !== "undefined" && typeof window.init === "function") {
						window.init();
					}
				}, 0);
			})
			.catch((error) => {
				// Only log non-abort errors.
				if (error.name !== "AbortError") {
					console.error("Smart Post Show Pro: Error loading template", error);
				}
			});

		// Cleanup function - abort fetch on unmount or templateId change.
		return () => {
			if (fetchAbortRef.current) {
				fetchAbortRef.current.abort();
				fetchAbortRef.current = null;
			}
		};
		// Only depend on templateId - NOT fetch (causes infinite loop)
	}, [templateId]);

	// Compute template HTML from response.
	let templateHtml = '<div style="padding:20px;text-align:center;color:#999;">Failed to load template</div>';

	if (response && response.success && response.html) {
		templateHtml = response.html;
	} else if (response && !response.success) {
		templateHtml = '<div style="padding:20px;text-align:center;color:#999;">Failed to load template</div>';
	} else if (!response) {
		templateHtml = '<div style="padding:20px;text-align:center;color:#999;">No response from server</div>';
	}

	// Following Divi 5 pattern: conditional rendering inside return statement.
	return (
		<ModuleContainer
			attrs={attrs}
			elements={elements}
			id={id}
			moduleClassName="spsp_divi5_smart_post_show"
			name={name}
			scriptDataComponent={ModuleScriptData}
			stylesComponent={ModuleStyles}
			classnamesFunction={moduleClassnames}
		>
			{elements.styleComponents({ attrName: "module" })}
			<div className="et_pb_module_inner spsp-divi5-testimonial-wrapper" data-template-id={templateId}>
				{!templateId || templateId === "0" ? (
					<div
						style={{
							padding: "20px",
							textAlign: "center",
							color: "#999",
							borderRadius: "4px",
							border: "1px dotted #ddd",
						}}
					>
						<p style={{ fontSize: "14px", margin: "0" }}>Please select a saved template</p>
					</div>
				) : isLoading ? (
					<div
						style={{
							padding: "20px",
							textAlign: "center",
							color: "#666",
							borderRadius: "4px",
							border: "1px dotted #ddd",
						}}
					>
						<p>Loading template...</p>
					</div>
				) : (
					<div dangerouslySetInnerHTML={{ __html: templateHtml }} />
				)}
			</div>
		</ModuleContainer>
	);
};

/**
 * Smart Post Show Pro Module Definition
 * Exported for Divi 5 to pick up
 */
export const spspDivi5SmartPostShow = {
	metadata,
	renderers: {
		edit: EditRenderer,
	},
	settings: {
		content: SettingsContent,
	},
};

// Also register via hooks for compatibility
addAction("divi.moduleLibrary.registerModuleLibraryStore.after", "spsp.divi5SmartPostShow", () => {
	registerModule(spspDivi5SmartPostShow.metadata, spspDivi5SmartPostShow);
});
