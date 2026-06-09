import useGetFontsType from "../hooks/getFontsType";
import { BuilderDownArrow } from "../components/icons/builder";
import { SimplePlusIcon } from "../components/icons/ui";
import { useEffect, useState } from "@wordpress/element";

const CustomFront = () => {
	const [fontList, setFontList] = useState([]);
	const myAdminUrl = window.location.href.split("/wp-admin")[0].toString();

	const fontData = useGetFontsType(myAdminUrl);
	useEffect(() => {
		setFontList(fontData);
	}, [fontData]);

	return (
		<div className="sp-pcp-blocks-setting-custom-font-page">
			<div className="sp-pcp-custom-font-wrapper">
				<div className="sp-pcp-custom-font-header">
					<div className="sp-pcp-header-left">
						<form
							className="sp-pcp-header-custom-form"
							onSubmit={(e) => {
								e.preventDefault();
							}}
						>
							<div className="sp-pcp-custom-select">
								<select>
									<option>Bulk Action</option>
									<option>Publish</option>
									<option>Draft</option>
									<option>Delete</option>
								</select>
								<span className="sp-pcp-dropdown-arrow">
									<BuilderDownArrow />
								</span>
							</div>
							<input type="submit" value="Apply" />
						</form>
						<input type="search" placeholder="Search.." />
					</div>
					<div className="sp-pcp-header-right">
						<a href={`${myAdminUrl}/wp-admin/post-new.php?post_type=sp_smart_post_font`} target="_blank">
							<button className="sp-pcp-add-btn">
								<span className="sp-pcp-plus-icon">
									<SimplePlusIcon />
								</span>
								Add New
							</button>
						</a>
					</div>
				</div>
				<div className="sp-pcp-custom-font-content">
					<div className="sp-pcp-content-box sp-pcp-builder-list-wrapper">
						<ul>
							<li className="sp-pcp-builder-list-item list-heading">
								<span className="sp-pcp-checkbox">
									<input type="checkbox" />
								</span>
								<span className="sp-pcp-font-list-heading sp-pcp-list-font-family">Font Family</span>
								<span className="sp-pcp-font-list-heading sp-pcp-list-preview">preview</span>
								<span className="sp-pcp-font-list-heading sp-pcp-list-file-type">file type</span>
								<span className="sp-pcp-font-list-heading sp-pcp-list-date">date</span>
								<span className="sp-pcp-font-list-heading sp-pcp-list-action">Action</span>
							</li>
							{fontList?.length === 0 ? (
								<li className="sp-pcp-no-data">No Data Found</li>
							) : (
								<li className="sp-pcp-content-list">Hello World!!</li>
							)}
						</ul>
					</div>
				</div>
				<div className="sp-pcp-custom-font-footer"></div>
			</div>
		</div>
	);
};

export default CustomFront;
