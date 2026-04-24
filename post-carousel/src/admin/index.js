/* eslint-disable react/no-deprecated */
import * as ReactDOM from "@wordpress/element";
import Render from "./Render";
import "../global-settings/index.js";

window.addEventListener("DOMContentLoaded", () => {
	const element = document.getElementById("sp-smart-post-blocks-settings-page");
	if (!element) {
		return;
	}

	if (typeof ReactDOM.createRoot === "function") {
		const root = ReactDOM.createRoot(element);
		root.render(<Render />);
	} else if (typeof ReactDOM.render === "function") {
		ReactDOM.render(<Render />, element);
	}
});
