import { useState, useEffect } from "@wordpress/element";
import axios from "axios";

const useGetFontsType = (adminUrl) => {
	const [options, setOptions] = useState([]);

	// const data = new FormData();
	const fontApi = adminUrl + "/wp-json/wp/v2/sp_smart_post_font";

	const fetchApi = async (fontApi) => {
		try {
			const response = await axios.get(fontApi);
			setOptions(response.data);
		} catch (error) {
			console.error("Error fetching posts:", error.message);
		}
	};

	useEffect(() => {
		fetchApi(fontApi);
	}, []);

	return options;
};

export default useGetFontsType;
