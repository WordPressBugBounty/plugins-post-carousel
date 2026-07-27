<?php
/**
 * Divi 5 Builder Integration
 *
 * @package     Smart_Post_Show_Pro
 * @subpackage  Smart_Post_Show_Pro/admin/PageBuilders
 * @since       4.0.0
 */

namespace SmartPostShow\Admin\PageBuilders\Divi5;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Cannot access directly.
}

/**
 * Divi 5 Builder class for initialization.
 *
 * @since 4.0.0
 */
class Divi5_Builder {

	/**
	 * Initialize the integration.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public static function init() {
		// Only load if Divi 5 is active.
		if ( ! self::is_divi_5_active() ) {
			return;
		}

		// Check if integration is enabled in dashboard settings.
		$options = get_option( 'sp_pcp_modules_settings', array() );
		$divi_enabled = true;

		// Check integrations settings (matches JavaScript structure).
		if ( isset( $options['integrations']['divi']['is_active'] ) ) {
			$divi_enabled = (bool) $options['integrations']['divi']['is_active'];
		}

		if ( ! $divi_enabled ) {
			return;
		}

		// Note: server/index.php is already loaded in Manager.php at file level
		// to ensure the dependency tree hook registers before Divi fires it.

		// Enqueue visual builder assets.
		add_action( 'divi_visual_builder_assets_before_enqueue_scripts', array( __CLASS__, 'enqueue_visual_builder_assets' ) );

		// Enqueue frontend assets (outside builder).
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_frontend_assets' ) );
	}

	/**
	 * Check if Divi 5 is active.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if Divi 5.x is active.
	 */
	public static function is_divi_5_active() {
		// Check for Divi 5.x using the d5_enabled function.
		if ( function_exists( 'et_builder_d5_enabled' ) && et_builder_d5_enabled() ) {
			return true;
		}

		// Version constant check.
		if ( defined( 'ET_BUILDER_VERSION' ) ) {
			return version_compare( ET_BUILDER_VERSION, '5.0', '>=' );
		}

		return false;
	}

	/**
	 * Enqueue visual builder assets.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public static function enqueue_visual_builder_assets() {
		if ( ! function_exists( 'et_core_is_fb_enabled' ) || ! et_core_is_fb_enabled() ) {
			return;
		}

		if ( ! function_exists( 'et_builder_d5_enabled' ) || ! et_builder_d5_enabled() ) {
			return;
		}

		$plugin_url = SP_PC_URL;
		$version    = SMART_POST_SHOW_VERSION;

		// Register the React module build.
		if ( class_exists( 'ET\Builder\VisualBuilder\Assets\PackageBuildManager' ) ) {
			\ET\Builder\VisualBuilder\Assets\PackageBuildManager::register_package_build(
				array(
					'name'    => 'spsp-divi5-visual-builder',
					'version' => $version,
					'script'  => array(
						'src'                => $plugin_url . 'blocks/build/divi5/spsp-divi5.js',
						'deps'               => array( 'react', 'jquery', 'divi-module-library', 'wp-hooks', 'divi-rest' ),
						'enqueue_app_window' => true,
					),
				)
			);
		}

		// ==========================================
		// REGISTER STYLES
		// ==========================================

		// Social icons CSS.
		if ( ! wp_style_is( 'sp_smart_post_blocks_social_icons', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_social_icons',
				$plugin_url . 'blocks/assets/css/icons.min.css',
				array(),
				$version,
				'all'
			);
		}

		// Editor styles.
		if ( ! wp_style_is( 'sp_smart_post_blocks_editor_style', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_editor_style',
				$plugin_url . 'blocks/build/editor/index.css',
				array(),
				$version,
				'all'
			);
		}

		// Main blocks CSS.
		if ( ! wp_style_is( 'sp_smart_post_blocks_css', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_css',
				$plugin_url . 'blocks/build/editor/style-index.css',
				array(),
				$version,
				'all'
			);
		}

		// Swiper CSS (for carousel/slider functionality).
		if ( ! wp_style_is( 'sp_smart_post_swiper_css', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_swiper_css',
				$plugin_url . 'public/assets/css/swiper-bundle.min.css',
				array(),
				$version,
				'all'
			);
		}

		// ==========================================
		// REGISTER SCRIPTS
		// ==========================================

		// Swiper JS (CRITICAL - must be loaded before builder-scripts.js).
		if ( ! wp_script_is( 'sp_smart_post_swiper_js', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_swiper_js',
				$plugin_url . 'public/assets/js/swiper-bundle.min.js',
				array(),
				$version,
				true
			);
		}

		// News ticker script.
		if ( ! wp_script_is( 'sp_smart_post_news_ticker_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_news_ticker_script',
				$plugin_url . 'blocks/assets/js/news-ticker.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Video and gallery slider script.
		if ( ! wp_script_is( 'sp_video_and_gallery_slider', 'registered' ) ) {
			wp_register_script(
				'sp_video_and_gallery_slider',
				$plugin_url . 'blocks/assets/js/video-and-gallery-slider.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Smart search script.
		if ( ! wp_script_is( 'sp_smart_post_smart_search_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_smart_search_script',
				$plugin_url . 'blocks/assets/js/smart-search.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Table of contents script.
		if ( ! wp_script_is( 'sp_smart_post_smart_toc_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_smart_toc_script',
				$plugin_url . 'blocks/assets/js/table-of-content.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Main builder scripts - THE KEY SCRIPT.
		if ( ! wp_script_is( 'sp_smart_post_builder_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_builder_script',
				$plugin_url . 'blocks/assets/js/builder-scripts.js',
				array( 'jquery' ),
				$version,
				true
			);

			// Localize script with necessary data (CRITICAL for AJAX).
			wp_localize_script(
				'sp_smart_post_builder_script',
				'sp_smart_post_block_localize',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'ajaxNonce' => wp_create_nonce( 'sp_smart_post_block_nonce' ),
					'pluginUrl'  => $plugin_url,
				)
			);
		}

		// ==========================================
		// ENQUEUE STYLES
		// ==========================================

		if ( wp_style_is( 'sp_smart_post_blocks_social_icons', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_social_icons' );
		}
		if ( wp_style_is( 'sp_smart_post_blocks_editor_style', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_editor_style' );
		}
		if ( wp_style_is( 'sp_smart_post_blocks_css', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_css' );
		}
		if ( wp_style_is( 'sp_smart_post_swiper_css', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_swiper_css' );
		}

		// ==========================================
		// ENQUEUE SCRIPTS
		// ==========================================

		// Swiper JS MUST be enqueued first (other scripts depend on PCPSwiper).
		if ( wp_script_is( 'sp_smart_post_swiper_js', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_swiper_js' );
		}

		if ( wp_script_is( 'sp_smart_post_news_ticker_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_news_ticker_script' );
		}
		if ( wp_script_is( 'sp_video_and_gallery_slider', 'registered' ) ) {
			wp_enqueue_script( 'sp_video_and_gallery_slider' );
		}
		if ( wp_script_is( 'sp_smart_post_smart_search_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_smart_search_script' );
		}
		if ( wp_script_is( 'sp_smart_post_smart_toc_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_smart_toc_script' );
		}
		if ( wp_script_is( 'sp_smart_post_builder_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_builder_script' );
		}

		// Add re-initialization script for Divi 5 visual builder.
		if ( wp_script_is( 'sp_smart_post_builder_script', 'enqueued' ) ) {
			wp_add_inline_script(
				'sp_smart_post_builder_script',
				'jQuery(document).ready(function($) {
					// Re-initialize scripts when Divi updates content
					function reinitSmartPostScripts() {
						if (typeof window.init === "function") {
							window.init();
						}
					}

					// Observe DOM changes - watch for .spsp_divi5_smart_post_show
					var observer = new MutationObserver(function(mutations) {
						mutations.forEach(function(mutation) {
							if (mutation.addedNodes.length) {
								for (var i = 0; i < mutation.addedNodes.length; i++) {
									var node = mutation.addedNodes[i];
									if (node.nodeType === 1) {
										if ($(node).hasClass("spsp_divi5_smart_post_show") || $(node).find(".spsp_divi5_smart_post_show").length) {
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

		// Hook to add localized data after scripts are enqueued.
		add_action( 'divi_visual_builder_assets_after_enqueue_scripts', array( __CLASS__, 'localize_script_data' ), 999 );
	}

	/**
	 * Localize script data for visual builder.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public static function localize_script_data() {
		$data = array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'spsp-divi5-nonce' ),
			'pluginUrl' => SP_PC_URL,
		);

		printf(
			'<script type="text/javascript">window.spspDivi5Data = %s;</script>',
			wp_json_encode( $data )
		);
	}

	/**
	 * Enqueue frontend assets for Divi 5 module.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public static function enqueue_frontend_assets() {
		// Only load if NOT in builder context (builder loads via enqueue_visual_builder_assets).
		if ( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() ) {
			return;
		}

		// Check if Divi 5 is active.
		if ( ! self::is_divi_5_active() ) {
			return;
		}

		$version = SMART_POST_SHOW_VERSION;

		// ==========================================
		// REGISTER SCRIPTS
		// ==========================================

		// Swiper JS (CRITICAL - must be loaded before builder-scripts.js).
		if ( ! wp_script_is( 'sp_smart_post_swiper_js', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_swiper_js',
				SP_PC_URL . 'public/assets/js/swiper-bundle.min.js',
				array(),
				$version,
				true
			);
		}

		// News ticker script.
		if ( ! wp_script_is( 'sp_smart_post_news_ticker_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_news_ticker_script',
				SP_PC_URL . 'blocks/assets/js/news-ticker.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Video and gallery slider script.
		if ( ! wp_script_is( 'sp_video_and_gallery_slider', 'registered' ) ) {
			wp_register_script(
				'sp_video_and_gallery_slider',
				SP_PC_URL . 'blocks/assets/js/video-and-gallery-slider.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Smart search script.
		if ( ! wp_script_is( 'sp_smart_post_smart_search_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_smart_search_script',
				SP_PC_URL . 'blocks/assets/js/smart-search.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Table of contents script.
		if ( ! wp_script_is( 'sp_smart_post_smart_toc_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_smart_toc_script',
				SP_PC_URL . 'blocks/assets/js/table-of-content.min.js',
				array( 'jquery' ),
				$version,
				true
			);
		}

		// Main builder scripts - THE KEY SCRIPT.
		if ( ! wp_script_is( 'sp_smart_post_builder_script', 'registered' ) ) {
			wp_register_script(
				'sp_smart_post_builder_script',
				SP_PC_URL . 'blocks/assets/js/builder-scripts.js',
				array( 'jquery' ),
				$version,
				true
			);

			// Localize script with necessary data.
			wp_localize_script(
				'sp_smart_post_builder_script',
				'sp_smart_post_block_localize',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'ajaxNonce' => wp_create_nonce( 'sp_smart_post_block_nonce' ),
					'pluginUrl'  => SP_PC_URL,
				)
			);
		}

		// ==========================================
		// ENQUEUE SCRIPTS
		// ==========================================

		if ( wp_script_is( 'sp_smart_post_news_ticker_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_news_ticker_script' );
		}
		// Swiper JS MUST be enqueued first.
		if ( wp_script_is( 'sp_smart_post_swiper_js', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_swiper_js' );
		}
		if ( wp_script_is( 'sp_video_and_gallery_slider', 'registered' ) ) {
			wp_enqueue_script( 'sp_video_and_gallery_slider' );
		}
		if ( wp_script_is( 'sp_smart_post_smart_search_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_smart_search_script' );
		}
		if ( wp_script_is( 'sp_smart_post_smart_toc_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_smart_toc_script' );
		}
		if ( wp_script_is( 'sp_smart_post_builder_script', 'registered' ) ) {
			wp_enqueue_script( 'sp_smart_post_builder_script' );
		}

		// ==========================================
		// REGISTER STYLES
		// ==========================================

		// Social icons CSS.
		if ( ! wp_style_is( 'sp_smart_post_blocks_social_icons', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_social_icons',
				SP_PC_URL . 'blocks/assets/css/icons.min.css',
				array(),
				$version,
				'all'
			);
		}

		// Editor styles.
		if ( ! wp_style_is( 'sp_smart_post_blocks_editor_style', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_editor_style',
				SP_PC_URL . 'blocks/build/editor/index.css',
				array(),
				$version,
				'all'
			);
		}

		// Main blocks CSS.
		if ( ! wp_style_is( 'sp_smart_post_blocks_css', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_blocks_css',
				SP_PC_URL . 'blocks/build/editor/style-index.css',
				array(),
				$version,
				'all'
			);
		}

		// Swiper CSS (for carousel/slider functionality).
		if ( ! wp_style_is( 'sp_smart_post_swiper_css', 'registered' ) ) {
			wp_register_style(
				'sp_smart_post_swiper_css',
				SP_PC_URL . 'public/assets/css/swiper-bundle.min.css',
				array(),
				$version,
				'all'
			);
		}

		// ==========================================
		// ENQUEUE STYLES
		// ==========================================

		if ( wp_style_is( 'sp_smart_post_blocks_social_icons', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_social_icons' );
		}
		if ( wp_style_is( 'sp_smart_post_blocks_editor_style', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_editor_style' );
		}
		if ( wp_style_is( 'sp_smart_post_blocks_css', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_blocks_css' );
		}
		if ( wp_style_is( 'sp_smart_post_swiper_css', 'registered' ) ) {
			wp_enqueue_style( 'sp_smart_post_swiper_css' );
		}

		// Add re-initialization script.
		wp_add_inline_script(
			'sp_smart_post_builder_script',
			'jQuery(document).ready(function($) {
				if (typeof window.init === "function") {
					window.init();
				}
			});'
		);
	}
}
