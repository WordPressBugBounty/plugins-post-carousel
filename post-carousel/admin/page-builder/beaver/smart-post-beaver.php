<?php
/**
 * Beaver Builder Integration for Smart Post Show.
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
 * Smart Post Show Beaver Builder Module Class.
 *
 * Registers a custom module in Beaver Builder with a
 * Select field to choose and render a Smart Post Show
 * template via shortcode.
 *
 * @since 4.0.0
 */
class SP_Beaver_Smart_Post_Module extends FLBuilderModule {

	/**
	 * Constructor - defines module properties.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		parent::__construct(
			array(
				// Module name shown in the builder panel.
				'name'            => __( 'Saved Templates', 'post-carousel' ),

				// Short description shown on hover.
				'description'     => __( 'Display a Smart Post Saved Templates.', 'post-carousel' ),

				// Module category in the builder panel.
				'category'        => __( 'Smart Post', 'post-carousel' ),

				// Folder path to this module's files.
				// frontend.php must be inside this directory.
				'dir'             => plugin_dir_path( __FILE__ ),

				// URL path to this module's files.
				'url'             => plugin_dir_url( __FILE__ ),

				// Module icon (FontAwesome class).
				'icon'            => file_get_contents( plugin_dir_path( __FILE__ ) . 'icon.svg' ),

				// Editor export enabled.
				'editor_export'   => true,

				// Module is enabled by default.
				'enabled'         => true,

				// Partial refresh on setting change (no full reload).
				'partial_refresh' => true,
			)
		);

		// Enqueue scripts for page builder.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts for Beaver Builder.
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

		// Add inline script to reinitialize after Beaver Builder updates.
		wp_add_inline_script(
			'sp_pc_blocks_script_js',
			'jQuery(document).ready(function($) {
				// Re-initialize when Beaver Builder updates modules
				$(document).on("fl-builder-layout-rendered", function() {
					if (typeof window.init === "function") {
						window.init();
					}
				});
			});'
		);
	}
}


/**
 * Initialize and register the Beaver Builder module.
 *
 * All registration must happen inside this function so that
 * FLBuilder is guaranteed to be available at call time.
 *
 * @since 4.0.0
 * @return void
 */
function sp_beaver_init_module() {

	// Check if Beaver Builder is active.
	if ( ! class_exists( 'FLBuilder' ) ) {
		return;
	}

	// Register the module class together with its settings fields.
	// FLBuilder::register_module() must receive both the class name
	// and the settings array — never call it without arguments.
	FLBuilder::register_module(
		'SP_Beaver_Smart_Post_Module',
		array(

			// ── Settings Tab ──────────────────────────────────────────────
			'general' => array(
				'title'    => __( 'General', 'post-carousel' ),

				// ── Section inside the tab ────────────────────────────────
				'sections' => array(
					'content' => array(
						'title'  => __( 'Smart Post', 'post-carousel' ),

						// ── Fields inside the section ─────────────────────
						'fields' => array(

							// Select dropdown to pick a template.
							'template_id' => array(
								'type'    => 'select',
								'label'   => __( 'Select Template', 'post-carousel' ),
								'default' => 'none',
								'options' => Helper::get_save_template_list(),
								'help'    => __( 'Please Select a Smart Post Saved Templates', 'post-carousel' ),
							),

						),
					),
				),
			),
		)
	);
}

// Use Beaver Builder's own hook to load modules at the right time.
add_action( 'init', 'sp_beaver_init_module' );
