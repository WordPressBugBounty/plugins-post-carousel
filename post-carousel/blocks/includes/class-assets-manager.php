<?php
/**
 * Handles all asset loading for the Smart Post Show plugin.
 *
 * @package Smart_Post_Show
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Assets_Manager class.
 */
class Assets_Manager {

	/**
	 * Preview transient expiration time.
	 */
	const PREVIEW_TRANSIENT_EXPIRATION = HOUR_IN_SECONDS;

	/**
	 * CSS file prefix.
	 */
	const CSS_FILE_PREFIX = 'sp-post-';

	/**
	 * Static CSS directory.
	 */
	const STATIC_CSS_DIR = 'static/';

	/**
	 * Registered styles.
	 *
	 * @var array
	 */
	private $styles = array();

	/**
	 * Registered scripts.
	 *
	 * @var array
	 */
	private $scripts = array();

	/**
	 * Block slugs
	 *
	 * @var array
	 */
	private $block_slugs = array();

	/**
	 * Block slugs
	 *
	 * @var array
	 */
	private $google_fonts = array();

	/**
	 * CSS directory path
	 *
	 * @var string
	 */
	private $css_dir;

	/**
	 * CSS directory URL
	 *
	 * @var string
	 */
	private $css_url;

	/**
	 * Debug mode flag.
	 *
	 * @var bool
	 */
	private $sps_debug = false;

	/**
	 * File system instance.
	 *
	 * @var \WP_Filesystem_Base
	 */
	private $wp_filesystem;

	/**
	 * Assets_Manager constructor.
	 *
	 * @param array $slugs Blocks slugs.
	 */
	public function __construct( $slugs ) {
		$this->block_slugs = $slugs;
		$upload_dir        = wp_upload_dir();
		$this->css_dir     = trailingslashit( $upload_dir['basedir'] ) . 'smart-post-show/';
		$this->css_url     = trailingslashit( $upload_dir['baseurl'] ) . 'smart-post-show/';

		// Initialize file system.
		$this->init_filesystem();

		add_action( 'after_delete_post', array( $this, 'delete_block_css' ), 10, 2 );
		add_action( 'enqueue_block_assets', array( $this, 'enqueue_assets' ) );

		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'sp-smart-post/v2',
					'/smart-save-block-css',
					array(
						array(
							'methods'             => 'POST',
							'callback'            => array( $this, 'save_block_content_css' ),
							'permission_callback' => function () {
								return current_user_can( 'publish_posts' );
							},
							'args'                => array(),
						),
					)
				);
			}
		);
		add_filter( 'render_block', array( $this, 'render_block_callback' ), 10, 2 );
		add_filter(
			'dynamic_sidebar_params',
			function ( $params ) {
				global $sp_current_page_widgets;
				$widget_id = $params[0]['widget_id'] ?? '';
				if ( strpos( $widget_id, 'block-' ) === 0 ) {
					$sp_current_page_widgets[] = array(
						'sidebar_id'  => $params[0]['id'],
						'widget_id'   => $params[0]['widget_id'],
						'widget_name' => $params[0]['widget_name'],
					);
				}
				return $params;
			}
		);
		add_action( 'dynamic_sidebar_after', array( $this, 'generate_widget_dynamic_css' ) );
	}
	/**
	 * Generates dynamic CSS for widgets in non-block themes.
	 *
	 * @return void
	 */
	public function generate_widget_dynamic_css() {
		// Only for classic themes.
		if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
			return;
		}
		global $sp_current_page_widgets, $wp_registered_sidebars;
		if ( empty( $wp_registered_sidebars ) || empty( $sp_current_page_widgets ) ) {
			return;
		}
		$widget_blocks     = get_option( 'widget_block', array() );
		$google_fonts_list = array();
		$css               = '';
		$block_names       = array();
		foreach ( $sp_current_page_widgets as $widget ) {
			// Ensure widget ID exists.
			if ( empty( $widget['widget_id'] ) ) {
				continue;
			}
			$widget_id = $widget['widget_id'];
			// Only block widgets (block-*).
			if ( strpos( $widget_id, 'block-' ) !== 0 ) {
				continue;
			}
			// Extract instance number from widget ID.
			if ( ! preg_match( '/-(\d+)$/', $widget_id, $matches ) ) {
				continue;
			}
			$instance = (int) $matches[1];
			// Validate widget content exists.
			if ( empty( $widget_blocks[ $instance ]['content'] ) ) {
				continue;
			}
			$current_block_name = get_option( '_sp_smart_widget_block_name' . $widget_id, array() );

			if ( empty( $current_block_name ) ) {
				continue;
			}
			$this->merge_assets(
				get_option( '_sp_smart_widget_' . $widget_id, '' ),
				get_option( '_sp_smart_fonts_widget_' . $widget_id, array() ),
				$css,
				$google_fonts_list
			);
			$block_names[] = $current_block_name;

		}
		// Output inline CSS.
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'sp_smart_post_blocks_css', wp_strip_all_tags( $css ) );
		}
		$this->enqueue_widget_block_css( $block_names );
		if ( ! empty( $google_fonts_list ) ) {
			$font_families = array();
			foreach ( array_unique( $google_fonts_list ) as $font ) {
				if ( ! is_string( $font ) || '' === $font ) {
					continue;
				}
				$font_parts   = explode( ':', $font );
				$font_name    = str_replace( ' ', '+', $font_parts[0] );
				$font_weights = $font_parts[1] ?? '400';
				if ( empty( $font_name ) ) {
					continue;
				}
				$font_families[] = $font_name . ':' . $font_weights;
			}
			// $google_fonts_list = array_unique( $google_fonts_list );
			wp_enqueue_style( 'sp_smart_post-widget_google-fonts', 'https://fonts.googleapis.com/css?family=' . implode( '|', $font_families ), array(), SMART_POST_SHOW_VERSION, 'all' );
		}
	}
	/**
	 * Enqueue combined CSS for widget blocks.
	 *
	 * @param array $block_names Block names array.
	 * @return void
	 */
	protected function enqueue_widget_block_css( $block_names ) {

		$cssfilepath_static = $this->css_dir . self::STATIC_CSS_DIR;

		// Ensure static directory exists.
		if ( ! $this->handle_file_operation( 'exists', $cssfilepath_static ) ) {
			$this->handle_file_operation( 'mkdir', $cssfilepath_static );
		}
		$filename    = self::CSS_FILE_PREFIX . 'widget.css';
		$cssfilepath = $cssfilepath_static . $filename;
		$cssfileurl  = $this->css_url . self::STATIC_CSS_DIR . $filename;
		$file_exists = $this->handle_file_operation( 'exists', $cssfilepath );
		if ( empty( $block_names ) ) {
			if ( $file_exists ) {
				// If CSS is empty and file exists, delete it.
				$this->handle_file_operation( 'delete', $cssfilepath );
				delete_option( '_sp_smart_widget_static_css_hash' );
			}
			return;
		}
		$block_names = $this->flatten_fonts( $block_names );
		$block_names = array_unique( $block_names );
		// Normalize block names (apply same transformations as during CSS generation).
		$normalized_blocks = $this->normalize_widget_blocks( $block_names );
		sort( $normalized_blocks ); // Sort for consistent comparison.
		$normalized_blocks_hash = md5( wp_json_encode( $normalized_blocks ) );

		// Get stored block hash for comparison.
		$stored_blocks_hash = get_option( '_sp_smart_widget_static_css_hash', '' );

		// Regenerate CSS if file doesn't exist or blocks have changed.
		$needs_regeneration = ! $file_exists || $normalized_blocks_hash !== $stored_blocks_hash;

		if ( $needs_regeneration ) {
			$loaded_blocks = array();
			$css           = '';

			foreach ( $block_names as $block ) {
				if ( empty( $block ) ) {
					continue;
				}

				$targets            = array(
					'post-slider',
					'post-slider-two',
					'post-timeline-three',
					'thumbnail-slider',
					'thumbnail-slider-two',
				);
				$list_block_targets = array(
					'post-list-two',
					'post-list-three',
				);

				if ( in_array( $block, $targets ) ) {
					$block = 'post-carousel';
				}
				if ( 'post-timeline-two' == $block ) {
					$block = 'post-timeline-one';
				}
				if ( in_array( $block, $list_block_targets ) ) {
					$block = 'post-list-one';
				}
				if ( in_array( $block, $loaded_blocks, true ) ) {
					continue;
				}
				$loaded_blocks[] = $block;
				$style_file      = SP_PC_PATH . "blocks/includes/$block/style.css";
				if ( $this->handle_file_operation( 'exists', $style_file ) ) {
					$this->init_filesystem();
					if ( $this->wp_filesystem ) {
						$file_content = $this->wp_filesystem->get_contents( $style_file );
						if ( false !== $file_content ) {
							$css .= $file_content;
						}
					}
				}
			}
			// Write CSS file if we have content, or delete if empty.
			if ( ! empty( $css ) ) {
				$this->handle_file_operation( 'write', $cssfilepath, $css );
				// Store the hash of blocks used to generate this CSS.
				update_option( '_sp_smart_widget_static_css_hash', $normalized_blocks_hash );
			} elseif ( $file_exists ) {
				// If CSS is empty and file exists, delete it.
				$this->handle_file_operation( 'delete', $cssfilepath );
				delete_option( '_sp_smart_widget_static_css_hash' );
			}
		}

		// Enqueue combined CSS if file exists.
		if ( $this->handle_file_operation( 'exists', $cssfilepath ) ) {
			$file_time = file_exists( $cssfilepath ) ? filemtime( $cssfilepath ) : SMART_POST_SHOW_VERSION;
			wp_enqueue_style(
				'sp-smart-blocks-combined-widget',
				$cssfileurl,
				array(),
				$file_time
			);
		}
	}

	/**
	 * Normalize widget block names by applying the same transformations used during CSS generation.
	 *
	 * @param array $block_names Array of block names.
	 * @return array Normalized block names.
	 */
	private function normalize_widget_blocks( $block_names ) {
		$normalized         = array();
		$targets            = array(
			'post-slider',
			'post-slider-two',
			'post-timeline-three',
			'thumbnail-slider',
			'thumbnail-slider-two',
		);
		$list_block_targets = array(
			'post-list-two',
			'post-list-three',
		);

		foreach ( $block_names as $block ) {
			if ( empty( $block ) ) {
				continue;
			}

			$normalized_block = $block;

			if ( in_array( $block, $targets ) ) {
				$normalized_block = 'post-carousel';
			} elseif ( 'post-timeline-two' == $block ) {
				$normalized_block = 'post-timeline-one';
			} elseif ( in_array( $block, $list_block_targets ) ) {
				$normalized_block = 'post-list-one';
			}

			if ( ! in_array( $normalized_block, $normalized, true ) ) {
				$normalized[] = $normalized_block;
			}
		}

		return $normalized;
	}
	/**
	 * Render block callback to enqueue block-specific CSS and fonts.
	 *
	 * @param string $block_content The rendered block content.
	 * @param array  $block         The block data array.
	 * @return string The rendered block content.
	 */
	public function render_block_callback( $block_content, $block ) {
		if ( is_singular() ) {
			return $block_content;
		}
		if ( ! is_admin() && isset( $block['blockName'] ) && strpos( $block['blockName'], 'sp-smart-post-show/' ) === 0 ) {
			// Get post ID - works for both singular and archive/blog pages.
			global $post;
			$current_post_id = get_the_ID();
			// Fallback to global $post for archive/blog contexts.
			if ( ! $current_post_id && ! empty( $post->ID ) ) {
				$current_post_id = $post->ID;
			}
			// Skip if no valid post ID found.
			if ( ! $current_post_id || ! is_numeric( $current_post_id ) ) {
				return $block_content;
			}
			$current_post_id    = absint( $current_post_id );
			$cssfilepath_static = $this->css_dir . self::STATIC_CSS_DIR;
			$static_filename    = self::CSS_FILE_PREFIX . "{$current_post_id}.css";
			$static_cssfilepath = $cssfilepath_static . $static_filename;
			$static_cssfileurl  = $this->css_url . self::STATIC_CSS_DIR . $static_filename;
			// Enqueue combined CSS if file exists.
			if ( $this->handle_file_operation( 'exists', $static_cssfilepath ) ) {
				$file_time = file_exists( $static_cssfilepath ) ? filemtime( $static_cssfilepath ) : SMART_POST_SHOW_VERSION;
				wp_enqueue_style(
					'sp-smart-blocks-combined-' . $current_post_id,
					$static_cssfileurl,
					array( 'sp_smart_post_blocks_css' ),
					$file_time
				);
			}
			$filename    = self::CSS_FILE_PREFIX . "{$current_post_id}.css";
			$cssfilepath = $this->css_dir . $filename;
			$cssfileurl  = $this->css_url . $filename;
			$css         = '';
			$fonts       = array();
			$block_names = array();
			if ( $this->handle_file_operation( 'exists', $cssfilepath ) ) {
				if ( wp_style_is( "sp-post-style-{$current_post_id}", 'enqueued' ) ) {
					return $block_content;
				}
				$file_time = file_exists( $cssfilepath ) ? filemtime( $cssfilepath ) : SMART_POST_SHOW_VERSION;
				wp_enqueue_style(
					"sp-post-style-{$current_post_id}",
					$cssfileurl,
					array(),
					$file_time
				);
				$this->merge_assets( '', get_post_meta( $current_post_id, '_sp_smart_fonts', true ), $css, $fonts );
			} else {
				$current_block_name = get_post_meta( $current_post_id, '_sp_smart_block_names', true );
				if ( ! empty( $current_block_name ) ) {
					$block_names[ $current_post_id ] = $current_block_name;
					$css                             = get_post_meta( $current_post_id, '_sp_smart_css', true );
					if ( ! empty( $css ) ) {
						wp_add_inline_style( 'sp_smart_post_blocks_css', wp_strip_all_tags( $css ) );
					}
				}
			}
		}
		return $block_content;
	}
	/**
	 * Initialize WordPress file system.
	 *
	 * @return void
	 */
	private function init_filesystem() {
		if ( ! $this->wp_filesystem ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
			global $wp_filesystem;
			$this->wp_filesystem = $wp_filesystem;
		}
	}

	/**
	 * Log asset operations for debugging.
	 *
	 * @param string $operation Operation type.
	 * @param string $context   Context information.
	 * @param array  $details   Additional details.
	 * @return void
	 */
	private function log_asset_operation( $operation, $context, $details = array() ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG && $this->sps_debug ) {
			error_log(
				sprintf(
					'Smart Post Show Assets: %s - %s - %s',
					$operation,
					$context,
					wp_json_encode( $details )
				)
			);
		}
	}

	/**
	 * Handle file system operations with error handling.
	 *
	 * @param string $operation Operation type (write, delete, exists).
	 * @param string $filepath  File path.
	 * @param string $content   Content for write operations.
	 * @return mixed
	 *
	 * @throws \InvalidArgumentException If the operation type is invalid.
	 */
	private function handle_file_operation( $operation, $filepath, $content = '' ) {
		try {
			$this->init_filesystem();

			switch ( $operation ) {
				case 'write':
					$result = $this->wp_filesystem->put_contents( $filepath, $content );
					$this->log_asset_operation(
						'write',
						'css_file',
						array(
							'path'    => $filepath,
							'success' => $result,
						)
					);
					return $result;

				case 'delete':
					$result = $this->wp_filesystem->delete( $filepath );
					$this->log_asset_operation(
						'delete',
						'css_file',
						array(
							'path'    => $filepath,
							'success' => $result,
						)
					);
					return $result;

				case 'exists':
					return $this->wp_filesystem->exists( $filepath );

				case 'mkdir':
					return $this->wp_filesystem->mkdir( $filepath );

				default:
					throw new \InvalidArgumentException( 'Invalid file operation: ' . $operation );
			}
		} catch ( \Exception $e ) {
			$this->log_asset_operation(
				'error',
				'file_operation',
				array(
					'operation' => $operation,
					'error'     => $e->getMessage(),
				)
			);
			return false;
		}
	}

	/**
	 * Validate CSS file path for security.
	 *
	 * @param string $filename Filename to validate.
	 * @return bool
	 */
	private function validate_css_path( $filename ) {
		$filename = sanitize_file_name( $filename );
		return preg_match( '/^' . self::CSS_FILE_PREFIX . '\d+\.css$/', $filename );
	}

	/**
	 * Sanitize block parameters for security.
	 *
	 * @param array $params Raw parameters.
	 * @return array Sanitized parameters.
	 */
	private function sanitize_block_params( $params ) {
		return array(
			'post_id'            => sanitize_text_field( $params['post_id'] ?? 0 ),
			'slug'               => sanitize_text_field( $params['slug'] ?? '' ),
			'widget_id'          => sanitize_text_field( $params['widget_id'] ?? '' ),
			'theme'              => sanitize_text_field( $params['theme'] ?? '' ),
			'block_css'          => wp_strip_all_tags( $params['block_css'] ?? '' ),
			'fonts'              => array_map( 'sanitize_text_field', (array) ( $params['fonts'] ?? array() ) ),
			'is_preview'         => rest_sanitize_boolean( $params['preview'] ?? false ),
			'has_refs'           => rest_sanitize_boolean( $params['has_refs'] ?? false ),
			'has_block'          => rest_sanitize_boolean( $params['has_block'] ?? false ),
			'block_ref_id'       => sanitize_text_field( $params['ref_id'] ?? 0 ),
			'block_type'         => sanitize_text_field( $params['block_type'] ?? '' ),
			'block_names'        => array_map( 'sanitize_text_field', (array) ( $params['block_names'] ?? array() ) ),
			'reusable_block_ids' => array_map( 'sanitize_text_field', (array) ( $params['reusable_block_ids'] ?? array() ) ),
		);
	}

	/**
	 * Enqueue script and style for the blocks.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		$this->add_global_css();
		$this->register_styles();
		$this->register_scripts();
		$this->localize_scripts();
		if ( ! is_admin() ) {
			$this->handle_frontend_assets();
		}
	}

	/**
	 * Register all styles.
	 *
	 * @return void
	 */
	protected function register_styles() {
		$styles = array(
			'sp_smart_post_blocks_editor_style'       => 'blocks/build/editor/index.css',
			'sp_smart_post_blocks_social_icons_style' => 'blocks/assets/css/icons.min.css',
			'sp_smart_post_blocks_css'                => 'blocks/build/editor/style-index.css',
			// 'sp_smart_post_blocks_style'              => 'blocks/assets/css/style.css',
			// 'sp_smart_post_builder_style'             => 'blocks/assets/css/builder.css',
		);

		foreach ( $styles as $handle => $path ) {
			wp_register_style(
				$handle,
				SP_PC_URL . $path,
				array(),
				SMART_POST_SHOW_VERSION,
				'all'
			);
		}
	}

	/**
	 * Register all scripts.
	 *
	 * @return void
	 */
	protected function register_scripts() {
		$asset_file = SP_PC_PATH . 'blocks/build/editor/index.asset.php';
		$asset      = file_exists( $asset_file )
		? require $asset_file
		: array(
			'dependencies' => array(),
			'version'      => SMART_POST_SHOW_VERSION,
		);

		if ( is_admin() ) {
			wp_register_script(
				'sp_smart_post_blocks_index_js',
				SP_PC_URL . 'blocks/build/editor/index.js',
				array(),
				SMART_POST_SHOW_VERSION,
				true
			);
		}

		$scripts = array(
			'sp_smart_post_blocks_script_js'   => 'blocks/assets/js/script.min.js',
			'sp_smart_post_news_ticker_script' => 'blocks/assets/js/news-ticker.min.js',
			'sp_video_and_gallery_slider'      => 'blocks/assets/js/video-and-gallery-slider.min.js',
			'sp-smart-post-back-to-top'        => 'blocks/assets/js/back-to-top.min.js',
			'sp_smart_post_smart_toc_script'   => 'blocks/assets/js/table-of-content.min.js',
			'sp_smart_post_build_script'       => 'blocks/assets/js/builder-scripts.js',
		);

		foreach ( $scripts as $handle => $path ) {
			wp_register_script(
				$handle,
				SP_PC_URL . $path,
				array(),
				SMART_POST_SHOW_VERSION,
				true
			);
		}
	}

	/**
	 * Adds global CSS styles to the page.
	 *
	 * @return void
	 */
	private function add_global_css() {
		$global_style       = get_option( 'sp_smart_post_global_settings', array() );
		$custom_css         = $global_style['customCss'] ?? '';
		$typography_css     = ! empty( $global_style['typography']['typographyCss'] ) ? $global_style['typography']['typographyCss'] : ':root { --sp-smart-font-size-heading-1: 44px;  --sp-smart-font-size-heading-2: 32px;  --sp-smart-font-size-heading-3: 24px;  --sp-smart-font-size-heading-4: 22px;  --sp-smart-font-size-heading-5: 20px;  --sp-smart-font-size-heading-6: 18px;  --sp-smart-font-size-body-1: 18px;  --sp-smart-font-size-body-2: 16px;  --sp-smart-font-size-body-3: 14px;  --sp-smart-font-size-body-4: 12px;  --sp-smart-font-size-button-1: 18px;  --sp-smart-font-size-button-2: 16px;}';
		$this->google_fonts = $global_style['typography']['fontList'] ?? '';
		$root_css           = ! empty( $global_style['rootcss'] ) ? $global_style['rootcss'] : ':root{  --sp-smart-breakpoint-tablet: 1023px; --sp-smart-breakpoint-mobile: 767px; --smart-post-light-text: #FAFAFA; --smart-post-background: #FFFFFF; --smart-post-primary-light: #EBEBEB; --smart-post-primary: #999999; --smart-post-primary-dark: #1D1D1D; --smart-post-secondary: #0054FB; --smart-post-dark-2-text: #3E3E3E; --smart-post-dark-text: #0A0A0A; --smart-post-black: #000000;} :root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12); --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14); --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16); --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18); --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
		$shadow_css         = $global_style['shadow']['shadowRootCSS'] ?? ':root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12);  --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14);  --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16);  --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18);  --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
		$inline_css         = wp_strip_all_tags( $typography_css . $root_css . $shadow_css . $custom_css );

		wp_register_style( 'sp-smart-post-global-root', false, array(), SMART_POST_SHOW_VERSION );
		wp_add_inline_style( 'sp-smart-post-global-root', $inline_css );
		wp_enqueue_style( 'sp-smart-post-global-root' );
	}

	/**
	 * Localize scripts with common data.
	 *
	 * @return void
	 */
	protected function localize_scripts() {

		$ajax_url = is_admin() ? 'sp_smart_post_blocks_index_js' : 'sp_smart_post_blocks_script_js';
		global $wp;
		$current_url              = is_home() ? home_url() : get_the_permalink();
		$actives_blocks           = Helper::object_to_array( get_option( 'sp-pcp-blocks-setting-options' ) );
			$always_active_blocks = array(
				array(
					'block_name' => 'smart-post-parent',
					'show'       => true,
				),
				array(
					'block_name' => 'live-filter',
					'show'       => true,
				),
				array(
					'block_name' => 'search-filter',
					'show'       => true,
				),
				array(
					'block_name' => 'sort-filter',
					'show'       => true,
				),
				array(
					'block_name' => 'taxonomy-filter',
					'show'       => true,
				),
				array(
					'block_name' => 'pagination',
					'show'       => true,
				),
			);
			$actives_blocks       = array_merge( $actives_blocks, $always_active_blocks );
			wp_localize_script(
				$ajax_url,
				'sp_smart_post_block_localize',
				array(
					'ajaxUrl'             => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
					'restUrl'             => esc_url_raw( rest_url( 'sps-blocks/v2/filter' ) ),
					'searchRestUrl'       => esc_url_raw( rest_url( 'sps-blocks/v2/smart-search' ) ),
					'ajaxNonce'           => wp_create_nonce( 'sp_smart_post_block_nonce' ),
					'permalink_structure' => $current_url,
					'pluginUrl'           => SP_PC_URL,
					'uploadFile'          => wp_upload_dir(),
					'integrationOptions'  => Helper::get_integration_options(),
					'placeholderImg'      => SP_PC_URL,
					'getBlockOptions'     => $actives_blocks,
					'cssPath'             => $this->css_url,
					'adminUrl'            => admin_url(),
					'isPro'               => true,
					'modulesOptions'      => Helper::get_modules_show_hide(),
					'savedTemplatesUrl'   => admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help#savedTemplate' ),
				)
			);
			wp_localize_script(
				'sp_smart_post_smart_search_script',
				'sp_smart_search_block_localize',
				array(
					'searchRestUrl' => esc_url_raw( rest_url( 'sps-blocks/v2/smart-search' ) ),
				)
			);
	}

	/**
	 * Enqueue combined Google Fonts for better performance.
	 *
	 * @param array $fonts Array of font strings.
	 * @return void
	 */
	private function enqueue_combined_fonts( $fonts ) {
		if ( empty( $fonts ) ) {
			return;
		}

		// Flatten nested arrays and keep only strings.
		$fonts = array_filter( array_map( 'strval', (array) $this->flatten_fonts( $fonts ) ) );

		if ( empty( $fonts ) ) {
			return;
		}

		$font_families = array();
		foreach ( array_unique( $fonts ) as $font ) {
			if ( ! is_string( $font ) || '' === $font ) {
				continue;
			}

			$font_parts   = explode( ':', $font );
			$font_name    = str_replace( ' ', '+', $font_parts[0] );
			$font_weights = $font_parts[1] ?? '400';
			if ( empty( $font_name ) ) {
				continue;
			}
			$font_families[] = $font_name . ':' . $font_weights;
		}

		if ( ! empty( $font_families ) ) {
			$font_url = '//fonts.googleapis.com/css?family=' . implode( '|', $font_families );
			wp_enqueue_style(
				'sp-smart-post-google-fonts',
				$font_url,
				array(),
				SMART_POST_SHOW_VERSION
			);

			$this->log_asset_operation( 'enqueue', 'google_fonts', array( 'count' => count( $font_families ) ) );
		}
	}

	/**
	 * Get All Reusable IDs content.
	 *
	 * @param int $post_id Post ids.
	 * @return array
	 */
	public function get_reusable_ids( $post_id ) {
		$reusable_id = array();
		if ( $post_id ) {
			$post = get_post( $post_id );
			if ( isset( $post->post_content ) ) {
				if ( has_blocks( $post->post_content ) &&
				strpos( $post->post_content, 'wp:block' ) &&
				strpos( $post->post_content, '"ref"' ) !== false
				) {
					$blocks = parse_blocks( $post->post_content );
					foreach ( $blocks as $key => $value ) {
						if ( isset( $value['attrs']['ref'] ) ) {
							$reusable_id[] = $value['attrs']['ref'];
						}
					}
				}
			}
		}
		return $reusable_id;
	}

	/**
	 * Get All Shortcode IDs content.
	 *
	 * @param int $post_id post id.
	 * @return array
	 */
	public function get_shortcode_ids( $post_id ) {
		$shortcode_ids = array();

		$saved_template_count = wp_count_posts( 'sp_post_template' );
		$total_saved_template = $saved_template_count->publish ?? 0;

		if ( $post_id && 0 !== $total_saved_template ) {
			$post = get_post( $post_id );

			if ( isset( $post->post_content ) && ! empty( $post->post_content ) ) {
				// Regular expression to find [smart_post id="1234"].
				preg_match_all( '/\[smart_post\s+id=["\'](\d+)["\']\]/', $post->post_content, $matches );

				if ( ! empty( $matches[1] ) ) {
					$shortcode_ids = $matches[1]; // all captured IDs.
				}
			}
		}

		return $shortcode_ids;
	}

	/**
	 * Get WordPress options starting with a given key prefix,
	 * including the exact match of the prefix itself.
	 *
	 * @param string $prefix The option_name prefix to search for.
	 * @return array Array of options (option_name => option_value).
	 */
	public function get_options_by_prefix( $prefix ) {
		global $wpdb;

		// Add % for SQL LIKE, but also allow exact match.
		$like_key = $wpdb->esc_like( $prefix ) . '%';
		$results  = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT option_name, option_value
             FROM {$wpdb->options}
             WHERE option_name = %s OR option_name LIKE %s",
				$prefix,
				$like_key
			)
		);
		$options  = array();
		if ( $results ) {
			foreach ( $results as $row ) {
				$options[ $row->option_name ] = $row->option_value;
			}
		}

		return $options;
	}

	/**
	 * Load frontend dynamic CSS and fonts for widgets, templates, posts, and reusable blocks.
	 */
	protected function handle_frontend_assets() {
		global $post, $wp_registered_sidebars;
		$current_post_id = ! empty( $post->ID ) ? $post->ID : 0;
		$css             = '';
		$fonts           = array();
		$block_names     = array();

		// Handle different asset sources.
		$this->handle_template_assets( $current_post_id, $css, $fonts, $block_names );
		$this->handle_post_assets( $current_post_id, $css, $fonts, $block_names );
		$this->handle_preview_assets( $current_post_id, $css, $fonts, $block_names );
		// Enqueue collected assets.
		$this->enqueue_collected_assets( $css, $fonts, $block_names, $current_post_id );
	}

	/**
	 * Handle template assets.
	 *
	 * @param int    $current_post_id Current post ID.
	 * @param string $css             CSS accumulator.
	 * @param array  $fonts           Fonts accumulator.
	 * @param array  $block_names     Block names accumulator.
	 * @return void
	 */
	private function handle_template_assets( $current_post_id, &$css, &$fonts, &$block_names ) {
		$theme_slug        = wp_get_theme()->get_stylesheet();
		$template_contexts = array( 'header', 'footer' );

		// Determine current context.
		if ( is_home() ) {
			$template_contexts[] = 'home';
		} elseif ( is_archive() ) {
			$template_contexts[] = 'archive';
		} elseif ( is_single() ) {
			$template_contexts[] = 'single';
		} elseif ( is_page() ) {
			$template_contexts[] = 'page';
		}

		global $_wp_current_template_content;
		$template_parts = array();
		// Ensure variable exists and not empty.
		if ( ! empty( $_wp_current_template_content ) ) {
			// Define the parts we want to detect dynamically.
			$template_parts = array( 'footer' );
			foreach ( $template_parts as $part ) {
				if ( strpos( $_wp_current_template_content, '"slug":"' . $part . '"' ) !== false ) {
					$template_contexts[] = $part;
				}
			}
			if ( ! empty( $_wp_current_template_content ) ) {
				// Match all occurrences of "slug":"something".
				preg_match_all( '/"slug":"([^"]+)"/', $_wp_current_template_content, $matches );

				if ( ! empty( $matches[1] ) ) {
					$template_parts = array_unique( $matches[1] ); // unique parts only.
				}
			}
		}

		// Remove duplicates just in case.
		$template_contexts = array_merge( $template_contexts, $template_parts );
		$template_contexts = array_unique( $template_contexts );
		// Handle custom template.
		$custom_template_slug = get_page_template_slug( $current_post_id );
		if ( ! empty( $custom_template_slug ) ) {
			$this->handle_template_context( $theme_slug, $custom_template_slug, $css, $fonts, $block_names );
		}

		// Handle standard template contexts.
		foreach ( $template_contexts as $context ) {
			$this->handle_template_context( $theme_slug, $context, $css, $fonts, $block_names );
		}
	}

	/**
	 * Handle a specific template context.
	 *
	 * @param string $theme_slug Theme slug.
	 * @param string $context    Template context.
	 * @param string $css        CSS accumulator.
	 * @param array  $fonts      Fonts accumulator.
	 * @param array  $block_names Block names accumulator.
	 * @return void
	 */
	private function handle_template_context( $theme_slug, $context, &$css, &$fonts, &$block_names ) {
		$current_block_name = get_option( "_sp_smart_template_block_names{$theme_slug}{$context}", array() );
		if ( ! empty( $current_block_name ) ) {
			$block_names[ $context ] = $current_block_name;
			$this->merge_assets(
				get_option( "_sp_smart_template_{$theme_slug}{$context}", '' ),
				get_option( "_sp_smart_fonts_template_{$theme_slug}{$context}", array() ),
				$css,
				$fonts
			);
		}

		// Handle reusable blocks in templates.
		$reused_ids = (array) get_option( "_sp_smart_template_reused_blocks_{$theme_slug}{$context}", array() );
		foreach ( $reused_ids as $id ) {
			$this->handle_reusable_block_assets( $id, $css, $fonts, $block_names );
		}
	}

	/**
	 * Handle post assets.
	 *
	 * @param int    $current_post_id Current post ID.
	 * @param string $css             CSS accumulator.
	 * @param array  $fonts           Fonts accumulator.
	 * @param array  $block_names     Block names accumulator.
	 * @return void
	 */
	private function handle_post_assets( $current_post_id, &$css, &$fonts, &$block_names ) {
		if ( ! is_singular() || ! $current_post_id ) {
			return;
		}
		$filename    = self::CSS_FILE_PREFIX . "{$current_post_id}.css";
		$cssfilepath = $this->css_dir . $filename;
		$cssfileurl  = $this->css_url . $filename;

		if ( $this->handle_file_operation( 'exists', $cssfilepath ) ) {
			$file_time = file_exists( $cssfilepath ) ? filemtime( $cssfilepath ) : SMART_POST_SHOW_VERSION;
			wp_enqueue_style(
				"sp-post-style-{$current_post_id}",
				$cssfileurl,
				array(),
				$file_time
			);
			$this->merge_assets( '', get_post_meta( $current_post_id, '_sp_smart_fonts', true ), $css, $fonts );
			$current_block_name = get_post_meta( $current_post_id, '_sp_smart_block_names', true );
			if ( ! empty( $current_block_name ) ) {
				$block_names[ $current_post_id ] = $current_block_name;
			}
		} else {
			$current_block_name = get_post_meta( $current_post_id, '_sp_smart_block_names', true );
			if ( ! empty( $current_block_name ) ) {
				$block_names[ $current_post_id ] = $current_block_name;
				$this->merge_assets(
					get_post_meta( $current_post_id, '_sp_smart_css', true ),
					get_post_meta( $current_post_id, '_sp_smart_fonts', true ),
					$css,
					$fonts
				);
			}
		}

		// Handle reusable blocks in post.
		foreach ( $this->get_reusable_ids( $current_post_id ) as $ref_id ) {
			$this->handle_reusable_block_assets( $ref_id, $css, $fonts, $block_names );
		}

		// Handle reusable blocks in post.
		foreach ( $this->get_shortcode_ids( $current_post_id ) as $ref_id ) {
			$this->handle_reusable_block_assets( $ref_id, $css, $fonts, $block_names );
		}
	}

	/**
	 * Handle reusable block assets.
	 *
	 * @param int    $ref_id      Reusable block ID.
	 * @param string $css         CSS accumulator.
	 * @param array  $fonts       Fonts accumulator.
	 * @param array  $block_names Block names accumulator.
	 * @return void
	 */
	private function handle_reusable_block_assets( $ref_id, &$css, &$fonts, &$block_names ) {
		$current_block_name = get_post_meta( $ref_id, '_sp_smart_block_names', true );
		if ( empty( $current_block_name ) ) {
			return;
		}

		$this->merge_assets(
			get_post_meta( $ref_id, '_sp_smart_css', true ),
			get_post_meta( $ref_id, '_sp_smart_fonts', true ),
			$css,
			$fonts
		);
		$block_names[ $ref_id ] = $current_block_name;
	}

	/**
	 * Handle preview assets.
	 *
	 * @param int    $current_post_id Current post ID.
	 * @param string $css             CSS accumulator.
	 * @param array  $fonts           Fonts accumulator.
	 * @param array  $block_names     Block names accumulator.
	 * @return void
	 */
	private function handle_preview_assets( $current_post_id, &$css, &$fonts, &$block_names ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['preview_id'] ) && isset( $_GET['preview_nonce'] ) ) {
			$preview_id    = absint( $_GET['preview_id'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$preview_nonce = sanitize_text_field( wp_unslash( $_GET['preview_nonce'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			// Verify nonce for security.
			if ( ! wp_verify_nonce( $preview_nonce, 'post_preview_' . $preview_id ) ) {
				return;
			}
			$this->merge_assets(
				get_transient( '_sps_preview_' . $current_post_id ),
				get_transient( '_sps_preview_fonts_' . $current_post_id ),
				$css,
				$fonts
			);
			$block_names['preview'] = get_transient( '_sps_preview_block_name' . $current_post_id );
		}
	}

	/**
	 * Enqueue collected assets.
	 *
	 * @param string $css             CSS content.
	 * @param array  $fonts           Fonts array.
	 * @param array  $block_names     Block names.
	 * @param int    $current_post_id Current post ID.
	 * @return void
	 */
	private function enqueue_collected_assets( $css, $fonts, $block_names, $current_post_id ) {
		// Enqueue inline CSS.
		if ( ! empty( $css ) ) {
			wp_add_inline_style( 'sp_smart_post_blocks_css', wp_strip_all_tags( $css ) );
		}
		// Merge with global Google Fonts.
		if ( ! empty( $this->google_fonts ) ) {
			$fonts = ! empty( $fonts ) ? array_merge( (array) $fonts, (array) $this->google_fonts ) : $this->google_fonts;
		}
		// Enqueue Google Fonts.
		$this->enqueue_combined_fonts( $fonts );
		// Enqueue combined block CSS.
		$this->enqueue_combined_block_css( $block_names, $current_post_id );
	}

	/**
	 * Merge CSS and fonts into accumulators.
	 *
	 * @param string $css_source   CSS source.
	 * @param array  $fonts_source Fonts source.
	 * @param string $css          CSS accumulator.
	 * @param array  $fonts        Fonts accumulator.
	 * @return void
	 */
	private function merge_assets( $css_source, $fonts_source, &$css, &$fonts ) {
		if ( ! empty( $css_source ) ) {
			$css .= $css_source;
		}
		if ( ! empty( $fonts_source ) && is_array( $fonts_source ) ) {
			$fonts = array_merge( $fonts, $fonts_source );
		}
	}

	/**
	 * Enqueue combined block CSS.
	 *
	 * @param array $block_names Block names.
	 * @param int   $current_post_id Current post ID.
	 * @return void
	 */
	public function enqueue_combined_block_css( $block_names, $current_post_id = 0 ) {
		if ( empty( $block_names ) ) {
			return;
		}

		$cssfilepath_static = $this->css_dir . self::STATIC_CSS_DIR;

		// Ensure static directory exists.
		if ( ! $this->handle_file_operation( 'exists', $cssfilepath_static ) ) {
			$this->handle_file_operation( 'mkdir', $cssfilepath_static );
		}

		$loaded_blocks = array();
		foreach ( $block_names as $key => $block_part ) {
			if ( empty( $block_part ) ) {
				continue;
			}

			$filename    = self::CSS_FILE_PREFIX . "{$key}.css";
			$cssfilepath = $cssfilepath_static . $filename;
			$cssfileurl  = $this->css_url . self::STATIC_CSS_DIR . $filename;

			if ( ! $this->handle_file_operation( 'exists', $cssfilepath ) ) {
				$css                = '';
				$block_part         = $this->flatten_fonts( $block_part );
				$targets            = array(
					'post-slider',
					'post-slider-two',
					'post-timeline-three',
					'thumbnail-slider',
					'thumbnail-slider-two',
				);
				$list_block_targets = array(
					'post-list-two',
					'post-list-three',
				);

				if ( array_intersect( $targets, $block_part ) ) {
					$block_part[] = 'post-carousel';
				}
				if ( in_array( 'post-timeline-two', $block_part, true ) ) {
					$block_part[] = 'post-timeline-one';
				}
				if ( array_intersect( $list_block_targets, $block_part ) ) {
					$block_part[] = 'post-list-one';
				}

				foreach ( $block_part as $block ) {
					if ( in_array( $block, $loaded_blocks, true ) ) {
						continue;
					}

					$loaded_blocks[] = $block;
					$style_file      = SP_PC_PATH . "blocks/includes/$block/style.css";
					if ( $this->handle_file_operation( 'exists', $style_file ) ) {
						$this->init_filesystem();
						if ( $this->wp_filesystem ) {
							$file_content = $this->wp_filesystem->get_contents( $style_file );
							if ( false !== $file_content ) {
								$css .= $file_content;
							}
						}
					}
				}

				if ( ! empty( $css ) ) {
					$this->handle_file_operation( 'write', $cssfilepath, $css );
				}
			}

			// Enqueue combined CSS if file exists.
			if ( $this->handle_file_operation( 'exists', $cssfilepath ) ) {
				$file_time = file_exists( $cssfilepath ) ? filemtime( $cssfilepath ) : SMART_POST_SHOW_VERSION;
				wp_enqueue_style(
					'sp-smart-blocks-combined-' . $key,
					$cssfileurl,
					array(),
					$file_time
				);
			}
		}
	}

	/**
	 * Helper: Flatten nested font arrays.
	 */
	/**
	 * Flatten nested font values (arrays, nested arrays, scalar values) into a flat array of strings.
	 *
	 * @param array $fonts Nested font values.
	 * @return string[]
	 */
	private function flatten_fonts( $fonts ) {
		$result = array();
		$stack  = (array) $fonts;

		while ( ! empty( $stack ) ) {
			$item = array_shift( $stack );

			if ( is_array( $item ) ) {
				// push each element back onto stack for processing.
				foreach ( $item as $v ) {
					$stack[] = $v;
				}
				continue;
			}

			// Keep scalars (string / number) only.
			if ( is_scalar( $item ) ) {
				$result[] = (string) $item;
			}
		}

		return $result;
	}

	/**
	 * Get active blocks for the current post.
	 *
	 * @param int   $post_id Current post ID.
	 * @param array $our_blocks Registered blocks.
	 * @return array
	 */
	public static function get_active_blocks( $post_id, $our_blocks ) {
		$active_blocks = array();
		$content       = get_post_field( 'post_content', $post_id );
		foreach ( $our_blocks as $block ) {
			if ( has_block( $block, $content ) ) {
				$active_blocks[] = $block;
			}
		}

		return $active_blocks;
	}

	/**
	 * Save block CSS to a file.
	 *
	 * @param int    $post_id Post ID.
	 * @param string $css CSS content.
	 * @return bool
	 */
	public function save_block_css( $post_id, $css ) {
		// Validate post ID.
		if ( ! is_numeric( $post_id ) || $post_id <= 0 ) {
			$this->log_asset_operation(
				'error',
				'save_css',
				array(
					'post_id' => $post_id,
					'error'   => 'Invalid post ID',
				)
			);
			return false;
		}

		// Ensure CSS directory exists.
		if ( ! $this->handle_file_operation( 'exists', $this->css_dir ) ) {
			$this->handle_file_operation( 'mkdir', $this->css_dir );
		}

		$filename = self::CSS_FILE_PREFIX . "{$post_id}.css";
		$filepath = $this->css_dir . $filename;

		// Validate filename for security.
		if ( ! $this->validate_css_path( $filename ) ) {
			$this->log_asset_operation(
				'error',
				'save_css',
				array(
					'filename' => $filename,
					'error'    => 'Invalid filename',
				)
			);
			return false;
		}

		// Save CSS to file.
		$result = $this->handle_file_operation( 'write', $filepath, $css );
		$this->log_asset_operation(
			'save',
			'css_file',
			array(
				'post_id' => $post_id,
				'success' => $result,
			)
		);

		return $result;
	}

	/**
	 * Delete block CSS file.
	 *
	 * @param int      $post_id Post ID.
	 * @param \WP_Post $post    Post object (optional, for hook compatibility).
	 * @return void
	 */
	public function delete_block_css( $post_id, $post = null ) {
		$filename = self::CSS_FILE_PREFIX . "{$post_id}.css";
		$filepath = $this->css_dir . $filename;

		// Validate filename for security.
		if ( $this->handle_file_operation( 'exists', $filepath ) ) {
			$this->handle_file_operation( 'delete', $filepath );
			$this->log_asset_operation( 'delete', 'css_file', array( 'post_id' => $post_id ) );
		}
		$this->delete_block_static_css( $filename );
		delete_post_meta( $post_id, '_sp_smart_post_google_fonts' );
	}
	/**
	 * Delete static block CSS file.
	 *
	 * @param string $filename File name.
	 * @return void
	 */
	public function delete_block_static_css( $filename ) {
		$filepath = $this->css_dir . self::STATIC_CSS_DIR . $filename;

		// Validate filename for security.
		if ( $this->handle_file_operation( 'exists', $filepath ) ) {
			$this->handle_file_operation( 'delete', $filepath );
			$this->log_asset_operation( 'delete', 'static_css_file', array( 'filename' => $filename ) );
		}
	}
	/**
	 * Check permission.
	 *
	 * @param mixed $post_id Post ID.
	 * @param mixed $cap Capability.
	 * @return bool
	 */
	public function permission_check( $post_id = false, $cap = '' ) {
		$cap       = $cap ? $cap : 'edit_others_posts';
		$is_passed = false;
		if ( $post_id ) {
			$post_author = (int) get_post_field( 'post_author', $post_id );
			$is_passed   = (int) get_current_user_id() === $post_author;
		}
		return $is_passed || current_user_can( $cap );
	}
	/**
	 * Save block CSS via REST API.
	 *
	 * @param \WP_REST_Request $request Full data about the request.
	 * @return \WP_REST_Response
	 *
	 * @throws \Exception If CSS file saving fails due to file permission issues.
	 */
	public function save_block_content_css( $request ) {
		$params = $request->get_params();
		// Sanitize all parameters.
		$sanitized_params = $this->sanitize_block_params( $params );
		extract( $sanitized_params ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

		$capability = 'publish_posts';
		if ( ! $this->permission_check( is_numeric( $post_id ) ? $post_id : false, $capability ) ) {
			$this->log_asset_operation(
				'error',
				'permission_check',
				array(
					'post_id'    => $post_id,
					'capability' => $capability,
				)
			);
			return new \WP_REST_Response(
				array(
					'success' => false,
					'message' => __( 'Insufficient permissions.', 'post-carousel' ),
				),
				403
			);
		}
		// Handle widget CSS storage.
		if ( ! empty( $widget_id ) ) {
			$storage_key     = '_sp_smart_widget_' . $widget_id;
			$font_key        = '_sp_smart_fonts_widget_' . $widget_id;
			$block_names_key = '_sp_smart_widget_block_name' . $widget_id;
			$this->delete_block_static_css( self::CSS_FILE_PREFIX . "{$widget_id}.css" );
			if ( $has_block ) {
				update_option( $storage_key, $block_css );
				update_option( $font_key, $fonts );
				update_option( $block_names_key, $block_names );
				$this->log_asset_operation( 'save', 'widget_css', array( 'widget_id' => $widget_id ) );
			} else {
				delete_option( $storage_key );
				delete_option( $font_key );
				delete_option( $block_names_key );
				$this->log_asset_operation( 'delete', 'widget_css', array( 'widget_id' => $widget_id ) );
			}
			return new \WP_REST_Response(
				array(
					'success' => true,
					'message' => __( 'Widget CSS saved successfully.', 'post-carousel' ),
				)
			);
		}
		// Handle template and template part CSS storage.
		if ( ( 'wp_template' === $post_id || 'wp_template_part' === $post_id ) && 'wp_block' !== $block_type ) {
			$storage_key     = '_sp_smart_template_' . $theme . $slug;
			$font_key        = '_sp_smart_fonts_template_' . $theme . $slug;
			$block_names_key = '_sp_smart_template_block_names' . $theme . $slug;
			$this->delete_block_static_css( self::CSS_FILE_PREFIX . "{$slug}.css" );
			if ( ! $has_refs ) {
				delete_option( '_sp_smart_template_reused_blocks_' . $theme . $slug );
			}
			if ( $has_block ) {
				update_option( $storage_key, $block_css );
				update_option( $font_key, $fonts );
				update_option( $block_names_key, $block_names );
				$this->log_asset_operation(
					'save',
					'template_css',
					array(
						'theme' => $theme,
						'slug'  => $slug,
					)
				);
			} else {
				delete_option( $storage_key );
				delete_option( $font_key );
				delete_option( $block_names_key );
				$this->log_asset_operation(
					'delete',
					'template_css',
					array(
						'theme' => $theme,
						'slug'  => $slug,
					)
				);
			}
			return new \WP_REST_Response(
				array(
					'success' => $block_type,
					'message' => __( 'Template CSS saved successfully.', 'post-carousel' ),
				)
			);
		}

		// Handle regular posts and custom post types.
		if ( ! empty( $block_css ) ) {
			// Handle preview mode.
			if ( $is_preview ) {
				set_transient( '_sps_preview_' . $post_id, $block_css, self::PREVIEW_TRANSIENT_EXPIRATION );
				set_transient( '_sps_preview_fonts_' . $post_id, $fonts, self::PREVIEW_TRANSIENT_EXPIRATION );
				set_transient( '_sps_preview_block_name' . $post_id, $block_names, self::PREVIEW_TRANSIENT_EXPIRATION );
				$this->log_asset_operation( 'preview', 'css_saved', array( 'post_id' => $post_id ) );
				return new \WP_REST_Response(
					array(
						'success' => true,
						'message' => __( 'Preview CSS saved temporarily.', 'post-carousel' ),
					)
				);
			}
			if ( 'wp_block' === $block_type ) {
				if ( 'wp_template' === $post_id || 'wp_template_part' === $post_id ) {
					$wp_block_used_key = '_sp_smart_template_reused_blocks_' . $theme . $slug;
					// Always cast to array when reading.
					$old_reuseable_block = get_option( $wp_block_used_key, array() );
					if ( ! is_array( $old_reuseable_block ) ) {
						$old_reuseable_block = array();
					}

					// Add the new ID.
					$old_reuseable_block[] = $block_ref_id;

					// Keep only items that exist in $reusable_block_ids.
					$old_reuseable_block = array_intersect( $reusable_block_ids, $old_reuseable_block );

					// Remove duplicates and reindex.
					$old_reuseable_block = array_values( array_unique( $old_reuseable_block ) );

					// Always update as array.
					update_option( $wp_block_used_key, $old_reuseable_block );
				}
				$post_id = $block_ref_id;
			}
			// Validate post ID.
			if ( ! is_numeric( $post_id ) ) {
				return new \WP_REST_Response(
					array(
						'success' => false,
						'message' => __( 'Invalid post ID.', 'post-carousel' ),
					),
					400
				);
			}

			// Save CSS to file.
			try {
				if ( 'wp_block' === $block_type ) {
					// Handle reusable blocks - save meta data only.
					update_post_meta( $block_ref_id, '_sps_smart_active', 'yes' );
					update_post_meta( $block_ref_id, '_sp_smart_css', $block_css );
					update_post_meta( $block_ref_id, '_sp_smart_fonts', $fonts );
					update_post_meta( $block_ref_id, '_sp_smart_block_names', $block_names );
					$this->log_asset_operation( 'save', 'reusable_block', array( 'block_ref_id' => $block_ref_id ) );
					$result = true;
				} else {
					$result = $this->save_block_css( $post_id, $block_css );
					$this->delete_block_static_css( self::CSS_FILE_PREFIX . "{$post_id}.css" );
					if ( $result ) {
						update_post_meta( $post_id, '_sps_smart_active', 'yes' );
						update_post_meta( $post_id, '_sp_smart_css', $block_css );
						update_post_meta( $post_id, '_sp_smart_fonts', $fonts );
						update_post_meta( $post_id, '_sp_smart_block_names', $block_names );
						$this->log_asset_operation( 'save', 'post_css', array( 'post_id' => $post_id ) );
						return new \WP_REST_Response(
							array(
								'success' => true,
								'message' => __( 'CSS file saved successfully.', 'post-carousel' ),
							)
						);
					} else {
						throw new \Exception( __( 'CSS could not be saved due to file permission issues.', 'post-carousel' ) );
					}
				}
			} catch ( \Exception $e ) {
				return new \WP_REST_Response(
					array(
						'success' => false,
						'message' => $e->getMessage(),
					),
					500
				);
			}
		} else {
			if ( 'wp_block' === $block_type ) {
				$post_id = $block_ref_id;
			}
			try {
				delete_post_meta( $post_id, '_sps_smart_active' );
				delete_post_meta( $post_id, '_sp_smart_css' );
				delete_post_meta( $post_id, '_sp_smart_fonts' );
				delete_post_meta( $post_id, '_sp_smart_block_names' );
				$this->delete_block_static_css( self::CSS_FILE_PREFIX . "{$post_id}.css" );
				$filename = self::CSS_FILE_PREFIX . "{$post_id}.css";
				$filepath = $this->css_dir . $filename;
				if ( $this->handle_file_operation( 'exists', $filepath ) ) {
					$this->handle_file_operation( 'delete', $filepath );
				}
				$this->log_asset_operation( 'delete', 'post_css', array( 'post_id' => $post_id ) );
				return new \WP_REST_Response(
					array(
						'success' => true,
						'message' => __( 'CSS file deleted successfully.', 'post-carousel' ),
					)
				);
			} catch ( \Exception $e ) {
				return new \WP_REST_Response(
					array(
						'success' => false,
						'message' => $e->getMessage(),
					),
					500
				);
			}
		}
	}

	/*
	---------------------------------------------------------------------------------
	| Bulk CSS Operations
	-------------------------------------------------------------------------------
	* This section handles bulk operations for CSS files associated with Smart Post blocks.
	* It includes functions to regenerate, clear, and export CSS files for multiple posts.
	*/
	/**
	 * Regenerate CSS files for all posts with Smart Post blocks.
	 *
	 * @param array $post_ids Optional array of specific post IDs to regenerate.
	 * @return array Results array with success/failure counts.
	 */
	public function regenerate_all_css_files( $post_ids = array() ) {
		$this->log_asset_operation( 'start', 'bulk_regeneration', array( 'post_count' => count( $post_ids ) ) );

		$results = array(
			'success' => 0,
			'failed'  => 0,
			'errors'  => array(),
		);

		// If no specific post IDs provided, get all posts with Smart Post blocks.
		if ( empty( $post_ids ) ) {
			$post_ids = $this->get_posts_with_smart_blocks();
		}

		foreach ( $post_ids as $post_id ) {
			try {
				$css_content = get_post_meta( $post_id, '_sp_smart_css', true );
				if ( ! empty( $css_content ) ) {
					$success = $this->save_block_css( $post_id, $css_content );
					if ( $success ) {
						++$results['success'];
						$this->log_asset_operation(
							'regenerate',
							'css_file',
							array(
								'post_id' => $post_id,
								'success' => true,
							)
						);
					} else {
						++$results['failed'];
						$results['errors'][] = sprintf( 'Failed to regenerate CSS for post ID: %d', $post_id );
					}
				}
			} catch ( \Exception $e ) {
				++$results['failed'];
				$results['errors'][] = sprintf( 'Error regenerating CSS for post ID %d: %s', $post_id, $e->getMessage() );
				$this->log_asset_operation(
					'error',
					'css_regeneration',
					array(
						'post_id' => $post_id,
						'error'   => $e->getMessage(),
					)
				);
			}
		}

		$this->log_asset_operation( 'complete', 'bulk_regeneration', $results );
		return $results;
	}

	/**
	 * Get all posts that have Smart Post blocks.
	 *
	 * @return array Array of post IDs.
	 */
	public function get_posts_with_smart_blocks() {
		global $wpdb;

		$post_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT post_id
				FROM {$wpdb->postmeta}
				WHERE meta_key = %s AND meta_value = %s",
				'_sps_smart_active',
				'yes'
			)
		);

		return array_map( 'absint', $post_ids );
	}

	/**
	 * Clear all generated CSS files.
	 *
	 * @param bool $include_static Whether to include static CSS files.
	 * @return array Results array.
	 */
	public function clear_all_css_files( $include_static = true ) {
		$this->log_asset_operation( 'start', 'bulk_cleanup', array( 'include_static' => $include_static ) );

		$results = array(
			'deleted' => 0,
			'failed'  => 0,
			'errors'  => array(),
		);

		// Clear main CSS files.
		$css_files = glob( $this->css_dir . self::CSS_FILE_PREFIX . '*.css' );
		if ( $css_files ) {
			foreach ( $css_files as $file ) {
				if ( $this->handle_file_operation( 'delete', $file ) ) {
					++$results['deleted'];
				} else {
					++$results['failed'];
					$results['errors'][] = sprintf( 'Failed to delete: %s', basename( $file ) );
				}
			}
		}

		// Clear static CSS files if requested.
		if ( $include_static ) {
			$static_dir = $this->css_dir . self::STATIC_CSS_DIR;
			if ( $this->handle_file_operation( 'exists', $static_dir ) ) {
				$static_files = glob( $static_dir . self::CSS_FILE_PREFIX . '*.css' );
				if ( $static_files ) {
					foreach ( $static_files as $file ) {
						if ( $this->handle_file_operation( 'delete', $file ) ) {
							++$results['deleted'];
						} else {
							++$results['failed'];
							$results['errors'][] = sprintf( 'Failed to delete static file: %s', basename( $file ) );
						}
					}
				}
			}
		}

		$this->log_asset_operation( 'complete', 'bulk_cleanup', $results );
		return $results;
	}

	/**
	 * Export CSS data for backup/migration.
	 *
	 * @param array $post_ids Optional array of specific post IDs to export.
	 * @return array Export data array.
	 */
	public function export_css_data( $post_ids = array() ) {
		$this->log_asset_operation( 'start', 'css_export', array( 'post_count' => count( $post_ids ) ) );

		$export_data = array(
			'version'     => SMART_POST_SHOW_VERSION,
			'export_date' => current_time( 'mysql' ),
			'posts'       => array(),
			'widgets'     => array(),
			'templates'   => array(),
		);

		// Export post CSS data.
		if ( empty( $post_ids ) ) {
			$post_ids = $this->get_posts_with_smart_blocks();
		}

		foreach ( $post_ids as $post_id ) {
			$post_data              = array(
				'post_id'     => $post_id,
				'css'         => get_post_meta( $post_id, '_sp_smart_css', true ),
				'fonts'       => get_post_meta( $post_id, '_sp_smart_fonts', true ),
				'block_names' => get_post_meta( $post_id, '_sp_smart_block_names', true ),
				'is_active'   => get_post_meta( $post_id, '_sps_smart_active', true ),
			);
			$export_data['posts'][] = $post_data;
		}

		// Export widget CSS data.
		$widget_options = $this->get_options_by_prefix( '_sp_smart_widget_' );
		foreach ( $widget_options as $option_name => $option_value ) {
			$export_data['widgets'][ $option_name ] = $option_value;
		}

		// Export template CSS data.
		$template_options = $this->get_options_by_prefix( '_sp_smart_template_' );
		foreach ( $template_options as $option_name => $option_value ) {
			$export_data['templates'][ $option_name ] = $option_value;
		}

		$this->log_asset_operation( 'complete', 'css_export', array( 'posts' => count( $export_data['posts'] ) ) );
		return $export_data;
	}

	/**
	 * Import CSS data from backup/migration.
	 *
	 * @param array $import_data Import data array.
	 * @param bool  $regenerate_files Whether to regenerate CSS files.
	 * @return array Import results.
	 */
	public function import_css_data( $import_data, $regenerate_files = true ) {
		$this->log_asset_operation( 'start', 'css_import', array( 'regenerate_files' => $regenerate_files ) );

		$results = array(
			'posts_imported'     => 0,
			'widgets_imported'   => 0,
			'templates_imported' => 0,
			'files_regenerated'  => 0,
			'errors'             => array(),
		);

		try {
			// Import post data.
			if ( isset( $import_data['posts'] ) && is_array( $import_data['posts'] ) ) {
				foreach ( $import_data['posts'] as $post_data ) {
					if ( isset( $post_data['post_id'] ) ) {
						update_post_meta( $post_data['post_id'], '_sp_smart_css', $post_data['css'] ?? '' );
						update_post_meta( $post_data['post_id'], '_sp_smart_fonts', $post_data['fonts'] ?? array() );
						update_post_meta( $post_data['post_id'], '_sp_smart_block_names', $post_data['block_names'] ?? array() );
						update_post_meta( $post_data['post_id'], '_sps_smart_active', $post_data['is_active'] ?? 'yes' );

						if ( $regenerate_files && ! empty( $post_data['css'] ) ) {
							$this->save_block_css( $post_data['post_id'], $post_data['css'] );
							++$results['files_regenerated'];
						}
						++$results['posts_imported'];
					}
				}
			}

			// Import widget data.
			if ( isset( $import_data['widgets'] ) && is_array( $import_data['widgets'] ) ) {
				foreach ( $import_data['widgets'] as $option_name => $option_value ) {
					update_option( $option_name, $option_value );
					++$results['widgets_imported'];
				}
			}

			// Import template data.
			if ( isset( $import_data['templates'] ) && is_array( $import_data['templates'] ) ) {
				foreach ( $import_data['templates'] as $option_name => $option_value ) {
					update_option( $option_name, $option_value );
					++$results['templates_imported'];
				}
			}
		} catch ( \Exception $e ) {
			$results['errors'][] = $e->getMessage();
			$this->log_asset_operation( 'error', 'css_import', array( 'error' => $e->getMessage() ) );
		}

		$this->log_asset_operation( 'complete', 'css_import', $results );
		return $results;
	}

	/**
	 * Handle plugin update/migration.
	 *
	 * @param string $old_version Previous version.
	 * @param string $new_version New version.
	 * @return array Migration results.
	 */
	public function handle_plugin_update( $old_version, $new_version ) {
		$this->log_asset_operation(
			'start',
			'plugin_update',
			array(
				'old_version' => $old_version,
				'new_version' => $new_version,
			)
		);

		$results = array(
			'css_files_regenerated' => 0,
			'static_files_cleared'  => 0,
			'errors'                => array(),
		);

		try {
			// Clear old static CSS files to force regeneration.
			$static_dir = $this->css_dir . self::STATIC_CSS_DIR;
			if ( $this->handle_file_operation( 'exists', $static_dir ) ) {
				$static_files = glob( $static_dir . '*.css' );
				if ( $static_files ) {
					foreach ( $static_files as $file ) {
						$this->handle_file_operation( 'delete', $file );
						++$results['static_files_cleared'];
					}
				}
			}

			// Regenerate CSS files for all active posts.
			$regeneration_results             = $this->regenerate_all_css_files();
			$results['css_files_regenerated'] = $regeneration_results['success'];

		} catch ( \Exception $e ) {
			$results['errors'][] = $e->getMessage();
			$this->log_asset_operation( 'error', 'plugin_update', array( 'error' => $e->getMessage() ) );
		}

		$this->log_asset_operation( 'complete', 'plugin_update', $results );
		return $results;
	}

	/**
	 * Get CSS file statistics.
	 *
	 * @return array Statistics array.
	 */
	public function get_css_statistics() {
		$stats = array(
			'total_css_files'    => 0,
			'total_static_files' => 0,
			'total_size'         => 0,
			'oldest_file'        => null,
			'newest_file'        => null,
		);

		// Count main CSS files.
		$css_files = glob( $this->css_dir . self::CSS_FILE_PREFIX . '*.css' );
		if ( $css_files ) {
			$stats['total_css_files'] = count( $css_files );
			foreach ( $css_files as $file ) {
				$file_size            = filesize( $file );
				$stats['total_size'] += $file_size;

				$file_time = filemtime( $file );
				if ( ! $stats['oldest_file'] || $file_time < $stats['oldest_file'] ) {
					$stats['oldest_file'] = $file_time;
				}
				if ( ! $stats['newest_file'] || $file_time > $stats['newest_file'] ) {
					$stats['newest_file'] = $file_time;
				}
			}
		}

		// Count static CSS files.
		$static_dir = $this->css_dir . self::STATIC_CSS_DIR;
		if ( $this->handle_file_operation( 'exists', $static_dir ) ) {
			$static_files = glob( $static_dir . '*.css' );
			if ( $static_files ) {
				$stats['total_static_files'] = count( $static_files );
			}
		}

		return $stats;
	}
}
