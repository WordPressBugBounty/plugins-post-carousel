<?php
/**
 * Bricks Builder Integration for Smart Post Show.
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Smart_Post_Show
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use SmartPostShow\Blocks\Helper;

/**
 * Smart Post Bricks Integration Class.
 *
 * Integrates Smart Post Show with Bricks page builder.
 *
 * @since 4.0.0
 */
class Smart_Post_Bricks_Integration extends \Bricks\Element {
	/**
	 * Element category.
	 *
	 * @var string
	 */
	public $category = 'general';

	/**
	 * Element name.
	 *
	 * @var string
	 */
	public $name = 'smart-post-addon';

	/**
	 * Element icon.
	 *
	 * @var string
	 */
	public $icon = 'sps-icon-elementor';

	/**
	 * Get the element label.
	 *
	 * Returns the localized label for the element.
	 *
	 * @since 4.0.0
	 * @return string Element label.
	 */
	public function get_label() {
		return esc_html__( 'Saved Templates', 'post-carousel' );
	}

	/**
	 * Enqueue scripts for Bricks builder.
	 *
	 * Registers and enqueues JavaScript files for the Bricks builder functionality.
	 *
	 * @since 4.0.0
	 * @return void
	 */
	public function enqueue_scripts() {
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

		// Add inline script to reinitialize after Bricks builder updates.
		wp_add_inline_script(
			'sp_pc_blocks_script_js',
			'jQuery(document).ready(function($) {
				// Re-initialize when Bricks builder updates elements
				$(document).on("bricksAjaxRender", function() {
					if (typeof window.init === "function") {
						window.init();
					}
				});
			});'
		);
	}

	/**
	 * Enqueue styles for Bricks builder.
	 *
	 * Registers and enqueues CSS stylesheets for the Bricks builder.
	 *
	 * @since 4.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		// Enqueue fontello icons.
		wp_enqueue_style(
			'pcp_fonttello_icon',
			SP_PC_URL . 'admin/css/fontello.css',
			array(),
			SMART_POST_SHOW_VERSION,
			'all'
		);

		wp_enqueue_style( 'pcp-font-awesome' );
		wp_enqueue_style( 'pcp_swiper' );
		wp_enqueue_style( 'pcp-bxslider' );
		wp_enqueue_style( 'pcp-likes' );
		wp_enqueue_style( 'pcp-popup' );
		wp_enqueue_style( 'pcp_fonttello_icon' );
		wp_enqueue_style( 'pcp-style' );
	}

	/**
	 * Set up element controls.
	 *
	 * Defines the controls for the element in the Bricks builder panel.
	 *
	 * @since 4.0.0
	 * @return void
	 */
	public function set_controls() {
		$this->controls['template_id'] = array(
			'type'        => 'select',
			'label'       => esc_html__( 'Select Template', 'post-carousel' ),
			'options'     => Helper::get_save_template_list(),
			'clearable'   => false,
			'default'     => '0',
			'pasteStyles' => true,
			'inline'      => true,
		);
		$this->controls['separator']   = array(
			'type' => 'separator',
		);
		$this->controls['help']        = array(
			'type'    => 'info',
			'content' => 'Please Select a Smart Post Saved Templates',
		);
	}

	/**
	 * Render the element output on the frontend.
	 *
	 * Called by Bricks Builder when rendering the element
	 * on the page — both in the editor and on the frontend.
	 * Outputs the Smart Post Show template with optional CSS.
	 *
	 * @since 4.0.0
	 * @return void
	 */
	public function render() {

		// Get the selected template ID from element settings.
		$template_id = isset( $this->settings['template_id'] ) ? (int) $this->settings['template_id'] : 0;

		// Show a placeholder if no template has been selected.
		if ( empty( $template_id ) ) {
			echo '<div style="
				text-align: center;
				padding: 20px;
				border: 2px dashed #ccc;
				color: #999;
				font-size: 14px;
			">' . esc_html__( 'Please select a Smart Post Saved Templates', 'post-carousel' ) . '</div>';
			return;
		}

		$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true ); // phpcs:ignore WordPress.WP.DeprecatedParameters

		// Execute the Smart Post Show shortcode.
		$shortcode_output = do_shortcode( '[smart_post id="' . $template_id . '"]' );

		// Output the wrapping element tag (Bricks handles root attributes).
		echo '<div ' . $this->render_attributes( '_root' ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div class="sp-smart-post-builder-wrap" data-builderTemplateId="' . esc_attr( $template_id ) . '">';
		echo $shortcode_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';

		echo '</div>';
	}
}
