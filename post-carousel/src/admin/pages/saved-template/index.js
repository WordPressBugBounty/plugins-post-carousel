import { useEffect, useRef, useState } from "@wordpress/element";
import { BuilderLeftArrow, BuilderRightArrow } from "../../components/icons/builder";
import { SimplePlusIcon, CheckIcon, CopyIcon, DeleteBinIcon, EditPencilIcon } from "../../components/icons/ui";
import { useDispatch, useSelect, resolveSelect, dispatch } from "@wordpress/data";
import { toast } from "react-hot-toast";
import { Button, Spinner, Tooltip } from "@wordpress/components";
import ProModal from "../../components/modals/ProModal";
import useTotalSaveTemplate from "../../hooks/getSaveTemplateCount";

const VIDEO_ID = "ked_hHmjRow";

const SavedTemplatesPromo = ({ addNewTemplate }) => {
	const [isPlaying, setIsPlaying] = useState(false);
	const addNewUrl = `${sp_pcp_block_settings?.adminUrl}post-new.php?post_type=sp_post_template&spblock_inserter`;

	return (
		<div className="sp-pcp-saved-template-promo">
			<div className="sp-pcp-saved-template-promo__text">
				<div className="sp-pcp-saved-template-promo__title-wrap">
					<h2 className="sp-pcp-saved-template-promo__title">
						Design visually. <span>Place it </span>
						<span className="sp-pcp-saved-template-promo__title-accent">anywhere.</span>
					</h2>
					<p className="sp-pcp-saved-template-promo__desc">
						Saved Templates let you build post layouts with Gutenberg blocks and use them as{" "}
						<b>shortcodes</b> — perfect for page builders like <b>Elementor, Divi, WPBakery</b>, and more.
					</p>
					<p className="sp-pcp-saved-template-promo__desc">
						Smart Post blocks work directly on any page or post in Gutenberg. To reuse blocks use
						WordPress's built-in{" "}
						<a
							href="https://wpsmartpost.com/docs/how-to-create-gutenberg-reusable-blocks-with-patterns-in-wordpress/"
							target="_blank"
						>
							<b>Reusable Blocks (Patterns)</b>
						</a>{" "}
						feature.
					</p>
				</div>
				<a
					onClick={addNewTemplate}
					href={addNewUrl}
					rel="noreferrer"
					className="sp-pcp-saved-template-promo__cta"
				>
					<i className="dashicons dashicons-plus-alt2"></i>
					Add New Template
				</a>
			</div>
			<div className="sp-pcp-saved-template-promo__video">
				{isPlaying ? (
					<iframe
						className="sp-pcp-saved-template-promo__video-frame"
						src={`https://www.youtube.com/embed/${VIDEO_ID}?autoplay=1`}
						title="Smart Post overview video"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowFullScreen
					></iframe>
				) : (
					<button
						type="button"
						className="sp-pcp-saved-template-promo__video-thumb"
						style={{
							backgroundImage: `url(https://img.youtube.com/vi/${VIDEO_ID}/maxresdefault.jpg)`,
						}}
						onClick={() => setIsPlaying(true)}
						aria-label="Play overview video"
					>
						<span className="sp-pcp-saved-template-promo__video-overlay" />
						<span className="sp-pcp-saved-template-promo__video-play">
							<svg
								width="22"
								height="22"
								viewBox="0 0 22 22"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
								aria-hidden="true"
							>
								<path d="M19 11L4 19.6603L4 2.33975L19 11Z" fill="rgba(100, 29, 215, 1)" />
							</svg>
						</span>
					</button>
				)}
			</div>
		</div>
	);
};

const SavedTemplate = () => {
	const [allCheck, setAllCheck] = useState(false);
	const [checkId, setCheckId] = useState([]);
	const [searchValue, setSearchValue] = useState("");
	const [shortcodeCoped, setShortcodeCoped] = useState("");
	const [selectBulkValue, setSelectBulkValue] = useState("");
	const [currentPage, setCurrentPage] = useState(1);
	const timeoutRef = useRef(null);
	const [noPostText, setNoPostText] = useState(false);

	const [isOpen, setOpen] = useState(false);
	const [hasPostCarouselPosts, setHasPostCarouselPosts] = useState(false);
	const openModal = () => setOpen(true);
	const closeModal = () => setOpen(false);

	const { totalSaveTemplate } = useTotalSaveTemplate();

	// Check for show_pro_modal URL parameter to auto-open modal and check posts
	useEffect(() => {
		const urlParams = new URLSearchParams(window.location.search);
		if (urlParams.get("show_pro_modal") === "1") {
			setOpen(true);
			// Check if there are sp_post_carousel posts
			const checkPosts = async () => {
				try {
					const response = await fetch(`${sp_pcp_block_settings?.adminUrl || ""}admin-ajax.php`, {
						method: "POST",
						headers: {
							"Content-Type": "application/x-www-form-urlencoded",
						},
						body: new URLSearchParams({
							action: "check_sp_post_carousel_posts",
							nonce: sp_pcp_block_settings?.nonce || "",
						}),
					});

					if (response.ok) {
						const contentType = response.headers.get("content-type");
						if (contentType && contentType.includes("application/json")) {
							const data = await response.json();
							if (data.success && data.data?.has_posts) {
								setHasPostCarouselPosts(true);
							}
						}
					}
				} catch (error) {
					console.error("Error checking posts:", error);
				}
			};
			checkPosts();

			// Remove show_pro_modal from URL
			urlParams.delete("show_pro_modal");
			const newUrl = `${window.location.pathname}${urlParams.toString() ? "?" + urlParams.toString() : ""}${window.location.hash}`;
			window.history.replaceState({}, "", newUrl);
		}
	}, []);

	const handleViewMoreBlocks = (page) => {
		window.location.href = `${sp_pcp_block_settings.adminUrl}edit.php?post_type=sp_post_carousel&page=pcp_help#${page}`;
	};

	// Get Block Editor Templates count.
	const blockTemplateCount = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_template", {
				status: "any",
				per_page: -1,
				search: searchValue,
				_fields: ["id"],
			})?.length || 0,
		[searchValue]
	);

	// Get Classic Shortcode Posts count.
	const classicShortcodeCount = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_carousel", {
				status: "any",
				per_page: -1,
				search: searchValue,
				_fields: ["id"],
			})?.length || 0,
		[searchValue]
	);

	// Total count for pagination.
	const totalPostCount = blockTemplateCount + classicShortcodeCount;

	// Dynamic table columns - only show editor_type when classic shortcodes exist.
	const tableCol =
		classicShortcodeCount > 0
			? ["checkBox", "title", "editor_type", "shortcode", "date", "action"]
			: ["checkBox", "title", "shortcode", "date", "action"];

	// Get Block Editor Templates.
	const blockTemplateList = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_template", {
				status: "any",
				per_page: -1,
				search: searchValue,
				_fields: ["id", "modified", "title", "status"],
			}) || [],
		[searchValue]
	);

	// Get Classic Shortcode Posts.
	const classicShortcodeList = useSelect(
		(select) =>
			select("core")?.getEntityRecords("postType", "sp_post_carousel", {
				status: "any",
				per_page: -1,
				search: searchValue,
				_fields: ["id", "modified", "title", "status"],
			}) || [],
		[searchValue]
	);

	// Combine and sort by modified date (newest first).
	const allTemplates = [...blockTemplateList, ...classicShortcodeList].sort((a, b) => {
		return new Date(b.modified) - new Date(a.modified);
	});

	// Paginate combined list.
	const savedTemplateList = allTemplates.slice(
		searchValue ? 0 : (currentPage - 1) * 10,
		searchValue ? 10 : currentPage * 10
	);

	// Get Delete entity record.
	const { deleteEntityRecord, editEntityRecord, saveEditedEntityRecord, saveEntityRecord, invalidateResolution } =
		useDispatch("core");

	// Helper to determine post type from item.
	const getPostType = (item) => {
		// Check if item has a type property or determine from the list
		const isBlockTemplate = blockTemplateList?.some((bt) => bt.id === item.id);
		return isBlockTemplate ? "sp_post_template" : "sp_post_carousel";
	};

	const deleteItemHandler = async (itemId = null, postType = null) => {
		const deleteId = itemId ? [itemId] : checkId;
		if (deleteId?.length < 1) {
			return;
		}
		const confirmed = window.confirm("Are you sure you want to delete this template?");

		if (confirmed) {
			await Promise.all(
				deleteId.map(async (id) => {
					try {
						// Determine post type if not provided.
						const type = postType || getPostType({ id });
						await deleteEntityRecord("postType", type, id, { force: true });
					} catch (error) {
						// console.error(`Error deleting template ID: ${id}`, error);
						notify(`Error deleting template ID: ${id}: ${error} `);
					}
				})
			);
			const updateData = itemId ? checkId?.filter((itemValueId) => itemValueId !== deleteId[0]) : [];
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
					// Determine post type for this ID
					const postType = getPostType({ id });

					// Check if record exists in the store
					const record = await resolveSelect("core").getEntityRecord("postType", postType, id);

					if (!record) {
						return;
					}
					await editEntityRecord("postType", postType, id, { status: newStatus });
					await saveEditedEntityRecord("postType", postType, id);
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
	const copyShortCodeHandler = async (item) => {
		if (!item || !item.id) {
			return;
		}
		try {
			const postType = getPostType(item);
			const shortcode =
				postType === "sp_post_template" ? `[smart_post id="${item.id}"]` : `[smart_post_show id="${item.id}"]`;

			const copied = await copyText(shortcode);

			if (copied) {
				setShortcodeCoped(item.id);
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

	const duplicateShortcodeHandler = async (item) => {
		// Only check limit for block templates, not classic shortcodes
		const postType = getPostType(item);
		if (postType === "sp_post_template") {
			const totalTemplate = await totalSaveTemplate();
			if (totalTemplate >= 2) {
				openModal();
				return;
			}
		}

		try {
			const response = await fetch(
				`${sp_pcp_block_settings?.restUrl}sp-smart-post/v2/saved-templates-duplicate/${item.id}`,
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
			} else {
				notify("Failed to duplicate template");
				return;
			}

			// Invalidate both lists to refresh.
			invalidateResolution("getEntityRecords", [
				"postType",
				"sp_post_template",
				{
					status: "any",
					per_page: -1,
					search: searchValue,
					_fields: ["id", "modified", "title", "status"],
				},
			]);
			invalidateResolution("getEntityRecords", [
				"postType",
				"sp_post_carousel",
				{
					status: "any",
					per_page: -1,
					search: searchValue,
					_fields: ["id", "modified", "title", "status"],
				},
			]);
		} catch (error) {
			console.error(error);
			notify("Failed to duplicate template");
		}
	};

	useEffect(() => {
		if (savedTemplateList?.length < 1) {
			if (timeoutRef.current) {
				clearTimeout(timeoutRef.current);
			}
			timeoutRef.current = setTimeout(() => {
				setNoPostText(true);
			}, 15000);
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
		setHasPostCarouselPosts(false);

		if (totalTemplate >= 2) {
			openModal();
		} else {
			window.location.href = `${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template&spblock_inserter=true`;
		}
	};

	return (
		<>
			<div className="sp-pcp-blocks-setting-saved-template-page">
				{/* <Button variant="secondary" onClick={ openModal }>
                Open Modal
            </Button> */}
				<ProModal
					hasPostCarouselPosts={hasPostCarouselPosts}
					onViewMoreBlocks={handleViewMoreBlocks}
					isOpen={isOpen}
					onClose={closeModal}
				/>
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
								<button
									className="sp-pcp-blocks-setting-template-select-apply"
									onClick={bulkActionHandler}
								>
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
									href={`${sp_pcp_block_settings.adminUrl}post-new.php?post_type=sp_post_template&spblock_inserter=true`}
									className="sp-pcp-blocks-setting-template"
									rel="noreferrer"
								>
									<i className="dashicons dashicons-plus-alt2"></i>
									Add New Template
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
											{item === "checkBox" ? (
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
											) : item === "editor_type" ? (
												"Editor Type"
											) : (
												item
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
									const checkBoxValue = allCheck
										? true
										: checkId?.some((itemId) => itemId === item?.id);

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
													rel="noreferrer noopener"
												>
													{item?.title?.rendered || "(No Title)"}
												</a>
											</td>
											{classicShortcodeCount > 0 && (
												<td className="sp-pcp-blocks-setting-saved-template-table-editor_type">
													<span
														className={`sp-pcp-editor-type-badge ${getPostType(item) === "sp_post_template" ? "block-editor" : "classic-editor"}`}
													>
														{getPostType(item) === "sp_post_template"
															? "Block Editor"
															: "Classic"}
													</span>
												</td>
											)}
											<td
												className="sp-pcp-blocks-setting-saved-template-table-shortcode"
												onClick={() => copyShortCodeHandler(item)}
											>
												<span className="sp-smart-saved-template-shortcode-text">
													{getPostType(item) === "sp_post_template"
														? `[smart_post id="${item?.id}"]`
														: `[smart_post_show id="${item?.id}"]`}
												</span>{" "}
												{shortcodeCoped === item.id && (
													<span className="sp-smart-post-shortcode-copy-tooltip">
														<CheckIcon />
														Copied!
													</span>
												)}
												{shortcodeCoped !== item.id && (
													<svg
														width="14"
														height="14"
														viewBox="0 0 14 14"
														fill="none"
														xmlns="http://www.w3.org/2000/svg"
													>
														<path
															fillRule="evenodd"
															clipRule="evenodd"
															d="M1.35417 1.25H9.47917C9.53667 1.25 9.58333 1.29667 9.58333 1.35417V9.47917C9.58333 9.50679 9.57236 9.53329 9.55282 9.55282C9.53329 9.57236 9.50679 9.58333 9.47917 9.58333H1.35417C1.32654 9.58333 1.30004 9.57236 1.28051 9.55282C1.26097 9.53329 1.25 9.50679 1.25 9.47917V1.35417C1.25 1.29667 1.29667 1.25 1.35417 1.25ZM0 1.35417C0 0.606667 0.606667 0 1.35417 0H9.47917C10.2275 0 10.8333 0.606667 10.8333 1.35417V9.47917C10.8333 10.2275 10.2275 10.8333 9.47917 10.8333H1.35417C0.995019 10.8333 0.650582 10.6907 0.396626 10.4367C0.142671 10.1828 0 9.83831 0 9.47917V1.35417ZM12.0833 11.0675V3.5675H13.3333V11.0675C13.3333 12.3333 12.3083 13.3333 11.0425 13.3333H1.875V12.0833H11.0425C11.6175 12.0833 12.0833 11.6433 12.0833 11.0675Z"
															fill="#757575"
														/>
													</svg>
												)}
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
															onClick={() => duplicateShortcodeHandler(item)}
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
											<span className="sp-pcp-saved-template-no-data">
												No saved template found!
											</span>
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
											<BuilderLeftArrow />
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
											<BuilderRightArrow />
										</button>
									</>
								)}
							</div>
						</div>
					</div>
				</div>
			</div>
			<SavedTemplatesPromo addNewTemplate={addNewTemplate} />
		</>
	);
};

export default SavedTemplate;
