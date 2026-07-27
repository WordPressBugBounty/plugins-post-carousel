; (function ($) {
	'use strict'

	/**
	 * JavaScript code for admin dashboard.
	 *
	 */
	$(function () {
		/* Preloader */
		$("#sp_pcp_view_options .spf-metabox").css("visibility", "hidden");

		// Function to toggle visibility of menu items based on layout value.
		function toggleMenuItems(layoutValue) {
			// Determine whether to hide the pagination menu item
			var isCarouselSliderThumbnail = (layoutValue === 'carousel_layout' || layoutValue === 'slider_layout');
			$('.spf-tabbed-nav .pcp_ajax_pagination').toggle(!isCarouselSliderThumbnail);

			// Show or hide the common menu item for carousel, slider, and thumbnail
			$('.menu-item_sp_pcp_view_options_3').toggle(isCarouselSliderThumbnail);
			$('.pcp-display-tabs .spf-tabbed-nav a:nth-child(1)').trigger('click');
		}

		$('.post_content_sorter .spf--sortable .spf--sortable-item:nth-child(1)').find('.spf-accordion-title').trigger('click');
		// Initial setup
		var layoutValue = $('.pcp-layout-preset .spf--sibling.spf--active').find('input').val();
		toggleMenuItems(layoutValue);

		// Event listener for layout change
		$('.pcp-layout-preset .spf--sibling').on('change', 'input', function (event) {
			layoutValue = $(this).val();
			toggleMenuItems(layoutValue);
		});

		// Get the last activated or selected layout.
		var lastSelectedOption = $('input[name="sp_pcp_layouts[pcp_layout_preset]"]:checked').val();
		$('input[name="sp_pcp_layouts[pcp_layout_preset]"]').on('change', function () {
			if (!$(this).is(':disabled')) {
				lastSelectedOption = $(this).val();
			}
		});
		// Get the last activated or selected layout.
		var lastSelectedContentOrientation = 'default';
		$('input[name="sp_pcp_view_options[post_content_orientation]"]').on('change', function () {
			if (!$(this).is(':disabled')) {
				lastSelectedContentOrientation = $(this).val();
			}
		});

		// Revert the selection to the last valid activated option that was selected before if the disabled/pro option is chosen.
		$('#publishing-action').on('click', '#publish', function (e) {
			if ($('input[name="sp_pcp_layouts[pcp_layout_preset]"]:checked').is(':disabled')) {
				$('input[name="sp_pcp_layouts[pcp_layout_preset]"][value="' + lastSelectedOption + '"]').prop('checked', true);
			}
			if ($('input[name="sp_pcp_view_options[post_content_orientation]"]:checked').is(':disabled')) {
				$('input[name="sp_pcp_view_options[post_content_orientation]"][value="' + lastSelectedContentOrientation + '"]').prop('checked', true);
			}
		});
		// Disable specific select options by their values
		var valuesToDisable = ['1', '2', '3', '4', '5'];

		valuesToDisable.forEach(function (value) {
			$('.pro-overlay-options-select').find('select option[value="' + value + '"]').attr('disabled', 'disabled').addClass('pcp_pro_only');
		});

		$('.sps-live-demo-icon').on('click', function (event) {
			event.stopPropagation();
		})

		/* Preloader js */
		$("#sp_pcp_view_options .spf-metabox").css({ "backgroundImage": "none", "visibility": "visible", "minHeight": "auto" });
		$("#sp_pcp_view_options .spf-nav-metabox li").css("opacity", 1);

		/* Copy to clipboard */
		$('.pcp-shortcode-selectable').on('click', function (e) {
			e.preventDefault();
			pcp_copyToClipboard($(this));
			pcp_SelectText($(this));
			$(this).focus().select();
			$('.pcp-after-copy-text').animate({
				opacity: 1,
				bottom: 25
			}, 300);
			setTimeout(function () {
				jQuery(".pcp-after-copy-text").animate({
					opacity: 0,
				}, 200);
				jQuery(".pcp-after-copy-text").animate({
					bottom: 0
				}, 0);
			}, 2000);
		});
		$('.sp_pcp_input').on('click', function (e) {
			e.preventDefault();
			/* Get the text field */
			var copyText = $(this);
			/* Select the text field */
			copyText.select();
			document.execCommand("copy");
			$('.pcp-after-copy-text').animate({
				opacity: 1,
				bottom: 25
			}, 300);
			setTimeout(function () {
				jQuery(".pcp-after-copy-text").animate({
					opacity: 0,
				}, 200);
				jQuery(".pcp-after-copy-text").animate({
					bottom: 0
				}, 0);
			}, 2000);
		});
		function pcp_copyToClipboard(element) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(element).text()).select();
			document.execCommand("copy");
			$temp.remove();
		}
		function pcp_SelectText(element) {
			var r = document.createRange();
			var w = element.get(0);
			r.selectNodeContents(w);
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange(r);
		}

		/* Add Visual Block Editor button on the list page */
		function addVisualBlockEditorButton() {
			if (typeof ajaxurl === 'undefined') {
				return false;
			}
			if (document.body.classList.contains('post-type-sp_post_carousel') &&
				document.body.classList.contains('edit-php')) {
				var pageTitleAction = document.querySelector('.page-title-action');
				if (pageTitleAction && !document.querySelector('.sp-pcp-visual-block-editor-btn')) {
					var button = document.createElement('a');
					button.href = ajaxurl.replace('admin-ajax.php', 'post-new.php?post_type=page&spblock_inserter=true');
					button.className = 'sp-pcp-visual-block-editor-btn';
					button.textContent = 'Start with Smart Post Blocks';
					pageTitleAction.parentNode.insertBefore(button, pageTitleAction.nextSibling);
					return true;
				}
			}
			return false;
		}

		function tryAddButton() {
			if (addVisualBlockEditorButton()) {
				return;
			}
			setTimeout(tryAddButton, 100);
		}

		tryAddButton();
	})
})(jQuery)
