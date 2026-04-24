<?php
/**
 * WPBakery Page Builder - smart post show Element
 *
 * @package Smart_Post_Show_Pro
 */

use SmartPostShow\Blocks\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register the smart post show element with WPBakery.
 *
 * This function maps a new shortcode element in WPBakery
 * with a Select field to choose a Smart Post Show template.
 *
 * @since 4.0.0
 * @return void
 */
function sp_wpbakery_register_element() {

	// Check if WPBakery Page Builder is active.
	if ( ! defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	vc_map(
		array(
			// ── Basic Info ────────────────────────────────────────────────
			'name'        => __( 'Smart Post', 'post-carousel' ),
			'base'        => 'sp_smart_wpbakery_shortcode',
			'description' => __( 'Display a Smart Post template.', 'post-carousel' ),
			'category'    => __( 'Smart Post', 'post-carousel' ),
			'icon'        => 'sps-wpbakery-icon',

			// ── Fields (Params) ───────────────────────────────────────────
			'params'      => array(

				// Select field to choose a template.
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Saved Templates', 'post-carousel' ),
					'param_name'  => 'template_id',
					'value'       => sp_wpbakery_get_template_list(),
					'std'         => '',
					'description' => __( 'Select a Smart Post saved template to display.', 'post-carousel' ),
					'save_always' => true,
				),

			),
		)
	);
}

// Register the element after WPBakery has fully loaded.
add_action( 'vc_before_init', 'sp_wpbakery_register_element' );

// Enqueue scripts for WPBakery frontend.
add_action( 'wp_enqueue_scripts', 'sp_wpbakery_enqueue_scripts' );

// Enqueue styles for WPBakery admin editor.
add_action( 'admin_enqueue_scripts', 'sp_wpbakery_admin_enqueue_styles' );

/**
 * Enqueue scripts for WPBakery frontend.
 *
 * @since 4.0.0
 * @return void
 */
function sp_wpbakery_enqueue_scripts() {
	// Only enqueue if we're on the frontend.
	if ( is_admin() ) {
		return;
	}

	$scripts = array(
		'sp_pc_blocks_script_js'     => 'blocks/assets/js/builder-scripts.js',
		'sp_pc_news_ticker_script'   => 'blocks/assets/js/news-ticker.min.js',
		'sp_pc_video_gallery_slider' => 'blocks/assets/js/video-and-gallery-slider.min.js',
		'sp_pc_smart_search_script'  => 'blocks/assets/js/smart-search.min.js',
		'sp_pc_smart_toc_script'     => 'blocks/assets/js/table-of-content.min.js',
	);

	foreach ( $scripts as $handle => $path ) {
		wp_enqueue_script(
			$handle,
			SP_PC_URL . $path,
			array( 'jquery' ),
			SMART_POST_SHOW_VERSION,
			true
		);
	}

	// Add inline script to reinitialize after WPBakery frontend editor updates.
	wp_add_inline_script(
		'sp_pc_blocks_script_js',
		'jQuery(document).ready(function($) {
			// Re-initialize scripts when WPBakery updates content
			function reinitSmartPostScripts() {
				if (typeof window.init === "function") {
					window.init();
				}
			}

			// Listen for various WPBakery events
			$(document).on("vc_js_reload", reinitSmartPostScripts);
			$(document).on("vc_frontend_default_editor_loaded", reinitSmartPostScripts);
			$(document).on("vc_frontend_render", reinitSmartPostScripts);

			// Also observe DOM changes as fallback - watch for .sp-smart-post-builder-wrap
			var observer = new MutationObserver(function(mutations) {
				mutations.forEach(function(mutation) {
					if (mutation.addedNodes.length) {
						for (var i = 0; i < mutation.addedNodes.length; i++) {
							var node = mutation.addedNodes[i];
							if (node.nodeType === 1) {
								if ($(node).hasClass("sp-smart-post-builder-wrap") || $(node).find(".sp-smart-post-builder-wrap").length) {
									reinitSmartPostScripts();
									break;
								}
							}
						}
					}
				});
			});

			// Start observing the document for changes
			if (document.body) {
				observer.observe(document.body, { childList: true, subtree: true });
			}
		});'
	);
}

/**
 * Enqueue styles for WPBakery admin editor.
 *
 * @since 4.0.0
 * @return void
 */
function sp_wpbakery_admin_enqueue_styles() {
	// Check if WPBakery is active and we're on a valid edit screen.
	if ( ! defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( ! $screen ) {
		return;
	}

	// Only enqueue on post edit screens.
	if ( 'post' !== $screen->base ) {
		return;
	}

	// Enqueue fontello icons and other required styles.
	wp_enqueue_style( 'pcp-font-awesome' );
	wp_enqueue_style( 'pcp_swiper' );
	wp_enqueue_style( 'pcp-bxslider' );
	wp_enqueue_style( 'pcp-likes' );
	wp_enqueue_style( 'pcp-popup' );
	wp_enqueue_style( 'pcp_fonttello_icon' );
	wp_enqueue_style( 'pcp-style' );
}

/**
 * Retrieve all published Smart Post Templates for the dropdown.
 *
 * WPBakery dropdown options format: array( 'Label' => 'value' )
 *
 * @return array
 */
/**
 * Retrieve all published Smart Post Templates.
 *
 * @since 4.0.0
 * @return array Template list.
 */
function sp_wpbakery_get_template_list() {
	$list = array( '' => esc_html__( 'Select Template', 'post-carousel' ) );

		$query = new \WP_Query(
			array(
				'post_type'      => 'sp_post_template',
				'post_status'    => 'publish',
				'posts_per_page' => 10000,
			)
		);

	if ( $query->have_posts() ) {
		foreach ( $query->posts as $post ) {
			$list[ $post->ID ] = $post->post_title;
		}

		// Sort by ID descending so the latest template appears first.
		krsort( $list );
	}
	// WPBakery format: label => ID (flip from Helper's ID => label).
	$template_list = array();
	foreach ( $list as $id => $title ) {
		$template_list[ $title ] = $id;
	}
	return $template_list;
}

/**
 * Shortcode handler for [sp_smart_wpbakery_shortcode].
 *
 * This function is called when WPBakery renders the element
 * on the frontend. It executes the Smart Post Show shortcode
 * with the selected template ID.
 *
 * @since 4.0.0
 * @param array  $atts    Shortcode attributes.
 * @param string $content Inner content (not used).
 * @return string HTML output.
 */
function sp_wpbakery_render_element( $atts, $content = null ) {

	// Extract and sanitize shortcode attributes.
	$atts = shortcode_atts(
		array(
			'template_id' => '',
		),
		$atts,
		'sp_smart_wpbakery_shortcode'
	);

	$template_id = (int) $atts['template_id'];

	// Show a placeholder if no template has been selected.
	if ( empty( $template_id ) ) {
		return '<div style="
			text-align: center;
			padding: 20px;
			border: 2px dashed #ccc;
			color: #999;
			font-size: 14px;
		">
			Please Select a Smart Post Saved Templates
		</div>';
	}

	// Execute the shortcode and return the rendered output.
	$output = do_shortcode( '[smart_post id="' . $template_id . '"]' );

	return '<div class="sp-smart-post-builder-wrap" data-builderTemplateId="' . esc_attr( $template_id ) . '">' . $output . '</div>';
}

// Register the shortcode handler for the WPBakery element.
add_shortcode( 'sp_smart_wpbakery_shortcode', 'sp_wpbakery_render_element' );
