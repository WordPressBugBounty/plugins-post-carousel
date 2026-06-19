<?php
/**
 * Divi Builder Integration for Smart Post Show.
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Smart_Post_Show
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

use SmartPostShow\Blocks\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Smart Post Show Divi Module.
 *
 * This module allows selecting a template via a Select field
 * and renders the corresponding shortcode output.
 *
 * @since 4.0.0
 */

add_action( 'et_builder_ready', 'smart_post_template_divi_modules' );

/**
 * Register the Smart Post Template module with Divi Builder.
 *
 * This function registers the custom module once Divi
 * Builder has fully loaded.
 *
 * @since 4.0.0
 * @return void
 */
function smart_post_template_divi_modules() {

	if ( ! class_exists( 'ET_Builder_Module' ) ) {
		return;
	}

	/**
	 * Smart Post Template Module Class.
	 *
	 * Integrates Smart Post Show with Divi Builder.
	 *
	 * @since 4.0.0
	 */
	class Smart_Post_Template_Module extends ET_Builder_Module {

		/**
		 * Module slug.
		 *
		 * @var string
		 */
		public $slug = 'smart_post_template';

		/**
		 * Module icon path.
		 *
		 * @var string
		 */
		public $icon_path = '';

		/**
		 * Visual Builder support.
		 *
		 * @var string
		 */
		public $vb_support = 'partial';

		/**
		 * Initialize the module.
		 *
		 * Sets up the module name, icon, and enqueues necessary scripts.
		 *
		 * @since 4.0.0
		 * @return void
		 */
		public function init() {
			$this->name      = esc_html__( 'Saved Templates', 'post-carousel' );
			$this->icon_path = plugin_dir_path( __FILE__ ) . 'icon.svg';

			// Enqueue scripts for page builder.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_page_builder_scripts' ) );
		}

		/**
		 * Enqueue scripts for Divi builder.
		 *
		 * Registers and enqueues JavaScript files for the Divi builder functionality.
		 *
		 * @since 4.0.0
		 * @return void
		 */
		public function enqueue_page_builder_scripts() {
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

			// Add inline script to reinitialize after Divi builder updates.
			wp_add_inline_script(
				'sp_pc_blocks_script_js',
				'jQuery(document).ready(function($) {
					// Re-initialize when Divi builder updates modules
					$(document).on("et_pb_after_module_render et_fb_ajax_render_shortcode", function() {
						if (typeof window.init === "function") {
							window.init();
						}
					});
				});'
			);
		}

		/**
		 * Define module fields (controls).
		 *
		 * @return array
		 */
		public function get_fields() {
			return array(
				'templates' => array(
					'label'   => esc_html__( 'Select Your Template', 'post-carousel' ),
					'type'    => 'select',
					'options' => Helper::get_save_template_list(),
					'default' => 'none',
				),
			);
		}

		/**
		 * Render the module output on the frontend.
		 *
		 * @param array  $attrs       Module attributes/settings.
		 * @param string $content     Inner content (if any).
		 * @param string $render_slug Module slug.
		 * @return string HTML output.
		 */
		public function render( $attrs, $content = null, $render_slug = '' ) {

			// Get the selected template ID from module settings.
			$template_id = (int) $this->props['templates'];

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

			// Check if we're in Divi Visual Builder.
			$is_divi_builder = $this->is_divi_builder_render();

			$output = '';

			// In Divi Builder, enqueue CSS.
			if ( $is_divi_builder ) {
				$upload_dir = wp_upload_dir();
				$css_file   = $upload_dir['basedir'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';
				$css_url    = $upload_dir['baseurl'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';

				// Enqueue CSS file if exists.
				if ( file_exists( $css_file ) ) {
					$output .= '<link rel="stylesheet" href="' . esc_url( $css_url ) . '?v=' . esc_attr( filemtime( $css_file ) ) . '">'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
				}

				// Enqueue dynamic CSS.
				$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true );
				if ( ! empty( $dynamic_css ) ) {
					$output .= '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

					// Hide preloader in all page builder editors.
					$output .= '<style>
						.fl-builder-edit .sp-smart-post-preloader,
						.oxygen-builder-body .sp-smart-post-preloader,
						.vc_editor .sp-smart-post-preloader,
						.wp-theme-Divi .sp-smart-post-preloader,
						.bricks-edit-mode .sp-smart-post-preloader {
							display: none !important;
						}
					</style>';
			}

			// Execute the shortcode.
			$shortcode_output = do_shortcode( '[smart_post id="' . $template_id . '"]' );

			// Wrap with div on frontend only (not in Divi Builder).
			if ( ! $is_divi_builder ) {
				$output .= '<div class="sp-smart-post-builder-wrap" data-builderTemplateId="' . esc_attr( $template_id ) . '">' . $shortcode_output . '</div>';
			} else {
				$output .= $shortcode_output;
			}

			return $output;
		}

		/**
		 * Check if currently rendering in Divi Visual Builder.
		 *
		 * Determines if the current render context is within the Divi
		 * Visual Builder by checking for builder-specific parameters.
		 *
		 * @since 4.0.0
		 * @return bool True if in Divi builder, false otherwise.
		 */
		protected function is_divi_builder_render() {
			// Check for Divi builder specific parameters or context.
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Divi builder context check, not form processing.
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Divi specific parameters, compared as strict strings.
			return ( isset( $_GET['et_fb'] ) && '1' === $_GET['et_fb'] ) ||
					( isset( $_POST['action'] ) && 'et_fb_ajax_render_shortcode' === $_POST['action'] ) ||
					( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() );
		}
	}

	new Smart_Post_Template_Module();
}
