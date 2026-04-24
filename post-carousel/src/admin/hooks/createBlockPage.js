import axios from "axios";
import { jsonStringify } from "../../blocks/shared/helpFn";

const useCreateBlockPage = ({ actionType, templateType, id, status, attributes, setAttributes }) => {
	const data = new FormData();
	const queryData = {
		actionType: actionType,
		templateId: id,
		status: status,
		templateType: templateType,
	};

	data.append("nonce", sp_pcp_block_settings.nonce);
	data.append("action", "sp_smart_post_create_page");
	data.append("data", jsonStringify(queryData));

	const fetchApi = async (data) => {
		try {
			const response = await axios.post(ajaxurl, data);
			if ("createBlankTemplate" === actionType) {
				const { newID } = response.data;
				location.href = `${sp_pcp_block_settings.homeUrl}wp-admin/post.php?post=${newID}&action=edit`;
			} else {
				setAttributes({
					...attributes,
					showTemplate: true,
					templateLists: response.data?.templateLists,
				});
			}
		} catch (error) {
			console.error("Error fetching posts:", error.message);
		}
	};

	return fetchApi(data);
};

export default useCreateBlockPage;
