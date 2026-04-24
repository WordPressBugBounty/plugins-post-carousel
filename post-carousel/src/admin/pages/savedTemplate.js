import { useEffect, useRef, useState } from "@wordpress/element";
import { LeftArrow, PlusIcon, RightArrow } from "../../icons/arrowIcons";
import { useDispatch, useSelect, resolveSelect, dispatch } from "@wordpress/data";
import { CopyIcon, DeleteBinIcon, EditPencilIcon } from "../template-parts/icons";
import { toast } from "react-hot-toast";
import { Button, Modal, Spinner, Tooltip } from "@wordpress/components";
import { priceLink } from "../../blocks/shared/helpFn";
import useTotalSaveTemplate from "../hooks/getSaveTemplateCount";

const SavedTemplate = () => {
	const tableCol = ["checkBox", "title", "shortcode", "date", "action"];
	const [allCheck, setAllCheck] = useState(false);
	const [checkId, setCheckId] = useState([]);
	const [searchValue, setSearchValue] = useState("");
	const [shortcodeCoped, setShortcodeCoped] = useState("");
	const [selectBulkValue, setSelectBulkValue] = useState("");
	const [currentPage, setCurrentPage] = useState(1);
	const timeoutRef = useRef(null);
	const [noPostText, setNoPostText] = useState(false);

	const [ isOpen, setOpen ] = useState( false );
    const openModal = () => setOpen( true );
    const closeModal = () => setOpen( false );

	const {totalSaveTemplate} = useTotalSaveTemplate();


	// Get All Post Count.
	const totalPostCount = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_template", {
				status: "any",
				per_page: -1,
				search: searchValue,
				_fields: ["id"],
			})?.length,
		[searchValue]
	);
	// Get All Saved Template.
	const savedTemplateList = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_template", {
				status: "any",
				per_page: 10,
				offset: searchValue ? 0 : (currentPage - 1) * 10,
				search: searchValue,
				_fields: ["id", "modified", "title", "status"],
			}),
		[currentPage, searchValue]
	);

	// Get Delete entity record.
	const { deleteEntityRecord, editEntityRecord, saveEditedEntityRecord, invalidateResolution } = useDispatch("core");
	const deleteItemHandler = async (itemId = null) => {
		const deleteId = itemId ? [itemId] : checkId;
		if (deleteId?.length < 1) {
			return;
		}
		const confirmed = window.confirm("Are you sure you want to delete this template?");

		if (confirmed) {
			await Promise.all(
				deleteId.map(async (id) => {
					try {
						await deleteEntityRecord("postType", "sp_post_template", id, { force: true });
					} catch (error) {
						// console.error(`Error deleting template ID: ${id}`, error);
						notify(`Error deleting template ID: ${id}: ${error} `);
					}
				})
			);
			const updateData = itemId ? checkId?.filter((itemValueId) => itemValueId !== deleteId) : [];
			setCheckId(updateData);
			notify("Template delete successfully");
		}
	};

	// Update Post Status.
	const updateStatusHandler = async (newStatus = "publish") => {
		const updateId = checkId;
		if (updateId?.length < 1) {
			return;
		}
		await Promise.all(
			updateId?.map(async (id) => {
				try {
					if (!id) {
						return;
					}
					// Check if record exists in the store
					const record = await resolveSelect("core").getEntityRecord("postType", "sp_post_template", id);

					if (!record) {
						return;
					}
					await editEntityRecord("postType", "sp_post_template", id, { status: newStatus });
					await saveEditedEntityRecord("postType", "sp_post_template", id);
				} catch (error) {
					// console.error(`Error update template ID: ${id}`, error);
					notify(`Error update template ID: ${id}: ${error} `);
				}
			})
		);
		notify("Template post status update successfully");
		setCheckId([]);
	};

	const copyText = async (text) => {
		// First try Clipboard API
		if (navigator.clipboard && navigator.clipboard.writeText) {
			try {
				await navigator.clipboard.writeText(text);
				return true;
			} catch (e) {
				console.warn("Clipboard API failed, using fallback.", e);
			}
		}

		// Fallback method: hidden textarea + execCommand
		try {
			const textarea = document.createElement("textarea");
			textarea.value = text;

			// Hide from screen
			textarea.style.position = "fixed";
			textarea.style.opacity = "0";
			textarea.style.pointerEvents = "none";

			document.body.appendChild(textarea);
			textarea.select();

			const success = document.execCommand("copy");
			document.body.removeChild(textarea);

			return success;
		} catch (err) {
			console.error("Fallback copy failed:", err);
			return false;
		}
	};

	// Copy Shortcode Upon Clicking Short code.
	const copyShortCodeHandler = async (value) => {
		if (!value) {
			return;
		}
		try {
			const updateValue = `[smart_post id="${value}"]`;

			const copied = await copyText(updateValue);

			if (copied) {
				setShortcodeCoped(value);
			} else {
				notify("Failed to copy shortcode.");
			}
		} catch (error) {
			notify(`Error: ${error}`);
		}
	};

	// Bulk Action Function.
	const bulkActionHandler = () => {
		if (selectBulkValue === "") {
			return;
		}
		switch (selectBulkValue) {
			case "publish":
				updateStatusHandler("publish");
				break;

			case "draft":
				updateStatusHandler("draft");
				break;

			case "delete":
				deleteItemHandler();
				break;

			default:
				break;
		}
		setCheckId([]);
		setAllCheck(false);
		setSelectBulkValue("");
	};

	// Notify Toaster.
	const notify = (message, type = "success") => {
		if (type === "success") {
			toast.success(message, { style: { marginTop: "20px" } });
		} else if (type === "error") {
			toast.error(message, { style: { marginTop: "20px" } });
		} else {
			toast(message, { style: { marginTop: "20px" } });
		}
	};

	// Set Search value with debounce.
	const searchValueHandler = (e) => {
		const searchInputValue = e.target?.value;
		if (timeoutRef.current) {
			clearTimeout(timeoutRef.current);
		}
		timeoutRef.current = setTimeout(() => {
			setSearchValue(searchInputValue);
		}, 100);
	};

	const duplicateShortcodeHandler = async (duplicateId) => {
		try {
			const response = await fetch(
				`${sp_pcp_block_settings?.restUrl}sp-smart-post/v2/saved-templates-duplicate/${duplicateId}`,
				{
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-WP-Nonce": sp_pcp_block_settings?.restNonce,
					},
				}
			);
			if (response.ok) {
				notify("Template duplicated successfully");
				invalidateResolution("getEntityRecords", [
					"postType",
					"sp_post_template",
					{
						status: "any",
						per_page: 10,
						offset: searchValue ? 0 : (currentPage - 1) * 10,
						search: searchValue,
						_fields: ["id", "modified", "title", "status"],
					},
				]);
				invalidateResolution("getEntityRecords", [
					"postType",
					"sp_post_template",
					{
						status: "any",
						per_page: -1,
						search: searchValue,
						_fields: ["id"],
					},
				]);
			}
		} catch (error) {
			console.error(error);
		}
	};

	useEffect(() => {
		if (savedTemplateList?.length < 1) {
			if (timeoutRef.current) {
				clearTimeout(timeoutRef.current);
			}
			timeoutRef.current = setTimeout(() => {
				setNoPostText(true);
			}, 1500);
		}
	}, [savedTemplateList]);

	// Copy Tooltip Show and Hide Timeout.
	useEffect(() => {
		if (shortcodeCoped) {
			const timeOutId = setTimeout(() => {
				setShortcodeCoped("");
			}, 1000);

			// Cleanup to avoid memory leaks if the component unmounts early
			return () => clearTimeout(timeOutId);
		}
	}, [shortcodeCoped]);

	const checkIdHandler = (itemId) => {
		const hasValue = checkId.includes(itemId);
		const updateValue = hasValue ? checkId?.filter((value) => value !== itemId) : [...checkId, itemId];
		setCheckId(updateValue);
		setAllCheck(false);
	};

	// Pagination.
	const totalPages = Math.ceil(totalPostCount / 10);
	const pages = Array.from({ length: totalPages }, (_, i) => i + 1);

	const addNewTemplate = async (e) => {
		e.preventDefault();

		const totalTemplate = await totalSaveTemplate();

		if(totalTemplate >= 2) {
			openModal();
		}else {
			window.open(`${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template`, "_blank");
		}
	}

	return (
		<div className="sp-pcp-blocks-setting-saved-template-page">
			
			{/* <Button variant="secondary" onClick={ openModal }>
                Open Modal
            </Button> */}
            { isOpen && (
                <Modal className="sp-pcp-pro-modal-components" onRequestClose={ closeModal }>
                    <div className="sp-pcp-pro-modal">
						<div className="sp-pcp-pro-modal-wrapper">
							<span className="sp-pcp-pro-modal-cross" onClick={closeModal}>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"></path></svg>
							</span>
							<div className="sp-pcp-pro-modal-box">
								<div className="sp-pcp-pro-modal-icon">
									<img src={`${sp_pcp_block_settings.pluginUrl}admin/assets/img/proLockIcon.svg`} alt="Pro Lock Icon" />
								</div>
								<div className="sp-pcp-pro-modal-info">
									<h5>Create Unlimited Saved Templates with Smart Post Pro</h5>
									<p>The free version allows two saved templates. Upgrade to Smart Post Pro to create and reuse unlimited templates, saving time while building your site.</p>
									<a href={priceLink} target="_blank" 
									rel="noreferrer" className="sp-pcp-pro-modal-btn">
										<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 14 14" fill="none"><path d="M8.637 5.535a.99.99 0 0 0 .66.506.92.92 0 0 0 .814-.23l1.725-1.584-.56 4.45H2.735l-.56-4.45L3.9 5.81a.92.92 0 0 0 .813.23c.287-.06.52-.25.66-.505l1.631-2.992z" stroke="#fff"></path><path d="M11.226 12.057H2.784c-.272 0-.492-.269-.492-.6v-1.32h9.424v1.32c0 .331-.22.6-.492.6" fill="#fff"></path></svg>
										<span>Upgrade to Pro</span>
									</a>
								</div>
							</div>
						</div>
					</div>
                </Modal>
            ) }
			<div className="sp-pcp-blocks-setting-saved-template-container">
				<div className="sp-pcp-blocks-setting-saved-template-header">
					<div className="sp-pcp-blocks-setting-template-header-left">
						<div className="sp-pcp-blocks-setting-template-bulk-action-form">
							<select
								className="sp-pcp-blocks-setting-template-select"
								value={selectBulkValue}
								onChange={(e) => setSelectBulkValue(e.target.value)}
							>
								<option value={""}>Bulk Action</option>
								<option value={"publish"}>Publish</option>
								<option value={"draft"}>Draft</option>
								<option value={"delete"}>Delete</option>
							</select>
							<button className="sp-pcp-blocks-setting-template-select-apply" onClick={bulkActionHandler}>
								Apply
							</button>
						</div>
						<div className="sp-pcp-blocks-setting-template-search">
							<input
								className="sp-pcp-blocks-setting-template-search-field"
								type="text"
								placeholder="Search..."
								spellCheck="false"
								data-ms-editor="true"
								onChange={searchValueHandler}
							/>
						</div>
					</div>
					<div className="sp-pcp-blocks-setting-template-header-right">
						<div className="sp-pcp-blocks-setting-template-add-new">
							<a
								onClick={addNewTemplate}
								href={`${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template`}
								target="_blank"
								className="sp-pcp-blocks-setting-template"
								rel="noreferrer"
							>
								<PlusIcon />
								Add New
							</a>
						</div>
					</div>
				</div>
				<div className="sp-pcp-blocks-setting-saved-template-content-table-wrapper">
					<table className="sp-pcp-blocks-setting-saved-template-content-table">
						<thead className="sp-pcp-blocks-setting-saved-template-table-head">
							<tr>
								{tableCol?.map((item, i) => (
									<th key={i} className={`sp-pcp-blocks-setting-saved-template-table-${item}`}>
										{item !== "checkBox" ? (
											item
										) : (
											<input
												type="checkbox"
												onChange={() => {
													setAllCheck((prev) => !prev);
													setCheckId(
														!allCheck
															? savedTemplateList?.map((listItem) => listItem.id)
															: []
													);
												}}
												checked={allCheck}
											/>
										)}
									</th>
								))}
							</tr>
						</thead>
						<tbody className="sp-pcp-blocks-setting-saved-template-table-body">
							{!noPostText && (!savedTemplateList || savedTemplateList.length === 0) && (
								<tr>
									<td className="sp-pcp-saved-template-preloader-no-data">
										<span className="sp-pcp-saved-template-loading">
											<Spinner />
										</span>
									</td>
								</tr>
							)}
							{savedTemplateList?.map((item, i) => {
								const date = new Date(item?.modified);
								const checkBoxValue = allCheck ? true : checkId?.some((itemId) => itemId === item?.id);

								return (
									<tr key={i} className="sp-pcp-blocks-setting-saved-template-table-row">
										<td
											id={item?.id}
											className="sp-pcp-blocks-setting-saved-template-table-checkBox"
										>
											<input
												type="checkbox"
												onChange={() => checkIdHandler(item?.id)}
												checked={checkBoxValue}
											/>
										</td>
										<td className="sp-pcp-blocks-setting-saved-template-table-title">
											<a
												href={`${sp_pcp_block_settings.adminUrl}post.php?post=${item?.id}&action=edit`}
												target="_blank"
												rel="noreferrer noopener"
											>
												{item?.title?.rendered}
											</a>
										</td>
										<td
											className="sp-pcp-blocks-setting-saved-template-table-shortcode"
											onClick={() => copyShortCodeHandler(item?.id)}
										>
											<span className="sp-smart-saved-template-shortcode-text">{`[smart_post id="${item?.id}"]`}</span>{" "}
											{shortcodeCoped === item.id && (
												<span className="sp-smart-post-shortcode-copy-tooltip">Copied!</span>
											)}
											{shortcodeCoped !== item.id && <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fillRule="evenodd" clipRule="evenodd" d="M1.35417 1.25H9.47917C9.53667 1.25 9.58333 1.29667 9.58333 1.35417V9.47917C9.58333 9.50679 9.57236 9.53329 9.55282 9.55282C9.53329 9.57236 9.50679 9.58333 9.47917 9.58333H1.35417C1.32654 9.58333 1.30004 9.57236 1.28051 9.55282C1.26097 9.53329 1.25 9.50679 1.25 9.47917V1.35417C1.25 1.29667 1.29667 1.25 1.35417 1.25ZM0 1.35417C0 0.606667 0.606667 0 1.35417 0H9.47917C10.2275 0 10.8333 0.606667 10.8333 1.35417V9.47917C10.8333 10.2275 10.2275 10.8333 9.47917 10.8333H1.35417C0.995019 10.8333 0.650582 10.6907 0.396626 10.4367C0.142671 10.1828 0 9.83831 0 9.47917V1.35417ZM12.0833 11.0675V3.5675H13.3333V11.0675C13.3333 12.3333 12.3083 13.3333 11.0425 13.3333H1.875V12.0833H11.0425C11.6175 12.0833 12.0833 11.6433 12.0833 11.0675Z" fill="#2F2F2F"/>
											</svg>}

										</td>
										<td className="sp-pcp-blocks-setting-saved-template-table-date">
											<div>{item?.status}</div>
											<div>{date?.toLocaleString("en-US")}</div>
										</td>
										<td className="sp-pcp-blocks-setting-saved-template-table-action">
											<div className="sp-pcp-blocks-setting-saved-template-table-action-btn">
												<Tooltip text="Edit" delay={300} placement="top">
													<a
														aria-label="Edit"
														href={`${sp_pcp_block_settings.adminUrl}post.php?post=${item?.id}&action=edit`}
														target="_blank"
														className="sp-pcp-saved-template-action sp-action-edit"
														rel="noreferrer"
													>
														<EditPencilIcon />
													</a>
												</Tooltip>
												<Tooltip text="Duplicate" delay={300} placement="top">
													<button
														aria-label="Duplicate"
														className="sp-pcp-saved-template-action sp-action-copy"
														onClick={() => duplicateShortcodeHandler(item?.id)}
													>
														<CopyIcon />
													</button>
												</Tooltip>
												<Tooltip text="Delete" delay={300} placement="top">
													<button
														aria-label="Delete"
														className="sp-pcp-saved-template-action sp-action-delete"
														onClick={() => deleteItemHandler(item?.id)}
													>
														<DeleteBinIcon />
													</button>
												</Tooltip>
											</div>
										</td>
									</tr>
								);
							})}
							{noPostText && (!savedTemplateList || savedTemplateList.length === 0) && (
								<tr>
									<td className="sp-pcp-saved-template-preloader-no-data">
										<span className="sp-pcp-saved-template-no-data">No saved template found!</span>
									</td>
								</tr>
							)}
						</tbody>
					</table>
				</div>
				<div className="sp-pcp-blocks-setting-saved-template-footer">
					<div className="sp-pcp-blocks-setting-saved-template-footer-content">
						<div className="sp-pcp-blocks-setting-template-count">
							Page {currentPage} of {Math.ceil(totalPostCount / 10) || 1} &nbsp;{" "}
							<span>[ {totalPostCount} Items ]</span>
						</div>
						<div className="sp-pcp-blocks-setting-template-pagination">
							{pages?.length > 1 && (
								<>
									<button
										className={`sp-pcp-template-pagination-btn sp-btn-prev ${currentPage === 1 ? "btn-disabled" : ""}`}
										onClick={() => setCurrentPage(currentPage !== 1 ? currentPage - 1 : 1)}
									>
										<LeftArrow />
									</button>
									{pages.map((item, i) => (
										<button
											key={i}
											className={`sp-pcp-template-pagination-btn ${currentPage === item ? "btn-active" : "sp-btn-numb"}`}
											onClick={(e) => setCurrentPage(Number(e.target?.value))}
											value={item}
										>
											{item}
										</button>
									))}
									<button
										className={`sp-pcp-template-pagination-btn sp-btn-next ${currentPage === pages?.length ? "btn-disabled" : ""}`}
										onClick={() =>
											setCurrentPage(
												currentPage !== pages?.length ? currentPage + 1 : pages?.length
											)
										}
									>
										<RightArrow />
									</button>
								</>
							)}
						</div>
					</div>
				</div>
			</div>
		</div>
	);
};

export default SavedTemplate;
