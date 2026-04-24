<?php
/**
 * Oxygen Builder Integration for Smart Post Show.
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
 * Smart Post Oxygen Element Class.
 *
 * Integrates Smart Post Show with Oxygen page builder.
 *
 * @since 4.0.0
 */
class SmartPostOxygenElement extends OxyEl {


	/**
	 * Get the element name.
	 *
	 * @return string Element name.
	 */
	public function name() {
		return __( 'Saved Templates', 'post-carousel' );
	}

	/**
	 * Get the element slug.
	 *
	 * @return string Element slug.
	 */
	public function slug() {
		return 'smart-post-templates';
	}

	/**
	 * Get the element icon URL.
	 *
	 * @return string Icon URL.
	 */
	public function icon() {
		return SP_PC_URL . 'admin/page-builder/oxygen/icon.svg';
	}

	/**
	 * Get the button priority.
	 *
	 * @return int Button priority.
	 */
	public function button_priority() {
		return 9;
	}

	/**
	 * Get the element HTML tag.
	 *
	 * @return string HTML tag name.
	 */
	public function tag() {
		return 'div';
	}

	/**
	 * Enable full CSS for the element.
	 *
	 * @return bool True to enable full CSS.
	 */
	public function enableFullCSS() {
		return true;
	}

	/**
	 * Callback after element initialization.
	 *
	 * Enqueues scripts for the page builder.
	 *
	 * @return void
	 */
	public function afterInit() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_page_builder_scripts' ) );
	}

	/**
	 * Enqueue page builder scripts.
	 *
	 * Registers and enqueues JavaScript files for the page builder functionality.
	 *
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

		// Add inline script to reinitialize after builder updates.
		wp_add_inline_script(
			'sp_pc_blocks_script_js',
			'jQuery(document).ready(function($) {
				// Re-initialize when Oxygen builder updates elements
				$(document).on("oxygen-ajax-element-loaded", function() {
					if (typeof window.init === "function") {
						window.init();
					}
				});
			});'
		);
	}

	/**
	 * Render the element output.
	 *
	 * Displays the Smart Post template content with optional CSS.
	 *
	 * @param array  $options Element options.
	 * @param array  $defaults Default values.
	 * @param string $content Inner content.
	 *
	 * @return void
	 */
	public function render( $options, $defaults, $content ) {
		$template_id = isset( $options['template_id'] ) ? absint( $options['template_id'] ) : 0;

		// Validate template_id is a valid published post.
		if ( $template_id ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['action'] ) && strpos( sanitize_key( $_GET['action'] ), 'oxy_render_oxy' ) !== false ) {

				$upload_dir = wp_upload_dir();
				$css_file   = $upload_dir['basedir'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';
				$css_url    = $upload_dir['baseurl'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';

				// Enqueue CSS file if exists.
				if ( file_exists( $css_file ) ) {
					echo '<link rel="stylesheet" href="' . esc_url( $css_url ) . '?v=' . filemtime( $css_file ) . '">'; // phpcs:ignore
				}

				$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true ); // phpcs:ignore WordPress.WP.DeprecatedParameters.Get_post_meta_param2
				if ( ! empty( $dynamic_css ) ) {
					echo '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			echo '<div class="sp-smart-post-builder-wrap" data-builderTemplateId="' . esc_attr( $template_id ) . '">';
			echo do_shortcode( '[smart_post id="' . $template_id . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';

		} elseif ( isset( $_GET['action'] ) && strpos( sanitize_key( $_GET['action'] ), 'oxy_render_oxy' ) !== false ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div style="
				text-align: center;
				padding: 20px;
				border: 2px dashed #ccc;
				color: #999;
				font-size: 14px;
			">
				Please Select a Smart Post Saved Templates
			</div>';
		}
	}

	/**
	 * Render element controls in Oxygen builder.
	 *
	 * Adds template selection dropdown control.
	 *
	 * @return void
	 */
	public function controls() {
		$this->addOptionControl(
			array(
				'type'    => 'dropdown',
				'name'    => esc_html__( 'Select Your Template', 'post-carousel' ),
				'slug'    => 'template_id',
				'default' => 'none',
			)
		)->setValue( Helper::get_save_template_list() )->rebuildElementOnChange();
	}
}

new SmartPostOxygenElement();
