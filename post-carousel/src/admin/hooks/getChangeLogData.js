import axios from "axios";

const useGetChangeLogData = () => {
	const getChangeLog = async () => {
		const data = new FormData();
		data.append("nonce", sp_pcp_block_settings.nonce);
		data.append("action", "sp_smart_post_block_changelog");
		try {
			const response = await axios.post(ajaxurl, data);
			return response.data;
		} catch (error) {
			// console.error("Error fetching posts:", error.message);
			throw error;
		}
	};

	return { getChangeLog: getChangeLog };
};

export default useGetChangeLogData;
