import { useEffect, useState } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";

const useTotalSaveTemplate = () => {
	const [total, setTotal] = useState(0);
	const [loading, setLoading] = useState(true);

	const fetchTotal = async () => {
		try {
			const result = await apiFetch({
				path: "/sp-smart-post/v2/get-total-save-template",
			});

			setTotal(result);
            return result;
		} catch (error) {
			console.error("API Error:", error);
		}

		setLoading(false);
	};

	useEffect(() => {
		fetchTotal();
	}, []);

	return { total, loading, totalSaveTemplate: fetchTotal };
};

export default useTotalSaveTemplate;