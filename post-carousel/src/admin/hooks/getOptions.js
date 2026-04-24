import { useState, useEffect } from "@wordpress/element";
import axios from "axios";

const useGetOptions = (blocksSettings, modulesOptions, integrationOptions) => {
	const [success, setSuccess] = useState(true);

	const formData = new FormData();
	formData.append("nonce", sp_pcp_block_settings.nonce);
	formData.append("action", "sp_smart_post_block_option");
	formData.append("optionData", JSON.stringify(blocksSettings));
	formData.append("modulesData", JSON.stringify(modulesOptions));
	formData.append("integrations", JSON.stringify(integrationOptions));

	const fetchApi = async (data) => {
		try {
			const response = await axios.post(ajaxurl, data);
			if (200 !== response.status) {
				setSuccess(false);
			}
		} catch (error) {
			setSuccess(false);
			console.error("Error fetching posts:", error.message);
		}
	};

	useEffect(() => {
		fetchApi(formData);
	}, [blocksSettings, modulesOptions, integrationOptions]);

	return success;
};

export default useGetOptions;
