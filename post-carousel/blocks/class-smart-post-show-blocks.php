<?php
/**
 * The plugin gutenberg block Initializer.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

use SmartPostShow\Blocks\Helper;
use SmartPostShow\Blocks\Template;
use SmartPostShow\Blocks\Template_Part;
use SmartPostShow\Blocks\Premade_Design_Library;
use SmartPostShow\Blocks\SPS_Table_Of_Contents;
use SmartPostShow\Blocks\Assets_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sp_Smart_Post_Blocks_Init' ) ) {
	/**
	 * Smart_Post_Show_Blocks_Init class.
	 */
	class Sp_Smart_Post_Blocks_Init {

		/**
		 * This plugin's instance.
		 *
		 * @var Blocks
		 */
		private static $instance;
		/**
		 * Block slugs.
		 *
		 * @var array
		 */
		private $block_slugs = array();

		/**
		 * Modules Attributes.
		 *
		 * @var array
		 */
		private $modules_default = array(
			array(
				'module_name' => 'taxonomy',
				'show'        => true,
			),
			array(
				'module_name' => 'post-badges',
				'show'        => true,
			),
			array(
				'module_name' => 'image-gallery',
				'show'        => true,
			),
			array(
				'module_name' => 'featured-video',
				'show'        => true,
			),
			array(
				'module_name' => 'back-to-top',
				'show'        => false,
			),
			array(
				'module_name' => 'saved-template',
				'show'        => true,
			),
			array(
				'module_name' => 'template-library',
				'show'        => true,
			),
		);

		/**
		 * Integration Attributes.
		 *
		 * @var array
		 */
		private $integration_default = array(
			array(
				'name' => 'elementor',
				'show' => true,
			),
			array(
				'name' => 'divi',
				'show' => true,
			),
			array(
				'name' => 'wpbakery',
				'show' => true,
			),
			array(
				'name' => 'oxygen',
				'show' => true,
			),
			array(
				'name' => 'beaver',
				'show' => true,
			),
			array(
				'name' => 'bricks',
				'show' => true,
			),
		);

		/**
		 * Block full name.
		 *
		 * @var array
		 */
		private $block_full_name = array();

		/**
		 * Icon list.
		 *
		 * @var array
		 */
		private $icon_list = array();

		/**
		 * Modules list.
		 *
		 * @var array
		 */
		private $modules_list = array();

		/**
		 * Main Blocks Instance.
		 *
		 * Insures that only one instance of Blocks exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @static
		 * @return object|Blocks The one true Blocks
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Sp_Smart_Post_Blocks_Init();
				self::$instance->init();
			}
			return self::$instance;
		}

		/**
		 * Load actions.
		 *
		 * @return void
		 */
		private function init() {
			$this->load_core_files();
			$this->block_slugs = Helper::get_block_slugs();
			$this->load_block_classes();
			$this->register_block_settings_option();
			$this->register_blocks();
			Helper::set_icon_list();
			Helper::set_modules_show_hide();
			Helper::set_integration_options();

			$this->icon_list    = Helper::get_icon_list();
			$this->modules_list = Helper::get_modules_show_hide();
			Sp_Smart_Post_Blocks_Query::instance();

			new Premade_Design_Library();
			new Assets_Manager( $this->block_slugs );
			new SPS_Table_Of_Contents();
			// Create Block category.
			if ( version_compare( $GLOBALS['wp_version'], '5.7', '<' ) ) {
				add_filter( 'block_categories', array( $this, 'register_block_category' ), 999999999, 2 );
			} else {
				add_filter( 'block_categories_all', array( $this, 'register_block_category' ), 999999999, 2 );
			}
			add_action( 'save_post', array( $this, 'clear_cache' ), 10, 1 );
			add_action( 'deleted_post', array( $this, 'clear_cache' ), 10, 1 );
			// For Full Site Editor templates.
			add_action( 'save_post_wp_template', array( $this, 'clear_cache_site_editor' ), 10, 1 );
			add_action( 'save_post_wp_template_part', array( $this, 'clear_cache_site_editor' ), 10, 1 );
			// Modal Popup Ajax.
			add_action( 'wp_ajax_sp_handle_post_id', array( $this, 'sp_handle_post_id_callback' ) );
			add_action( 'wp_ajax_nopriv_sp_handle_post_id', array( $this, 'sp_handle_post_id_callback' ) );

			add_action( 'rest_api_init', array( $this, 'rest_api_register' ) );

			// Back to Top Button.
			$enable_back_to_top = $this->modules_list['back-to-top'] || false;

			if ( $enable_back_to_top ) {
				$back_to_top_btn = new Smart_Post_Show_Back_To_Top();
				add_action( 'wp_footer', array( $back_to_top_btn, 'back_to_top_init' ), 10 );
			}

			add_action( 'after_setup_theme', array( $this, 'sp_register_custom_image_sizes' ) );
		}


		/**
		 * Register custom image sizes for Smart Post Show blocks.
		 *
		 * @return void
		 */
		public function sp_register_custom_image_sizes() {

			add_image_size( 'smart-post-landscape', 870, 570, true );
			add_image_size( 'smart-post-portrait', 600, 900, true );
		}

		/**
		 * Register api function
		 *
		 * @return void
		 */
		public function rest_api_register() {
			register_rest_route(
				'sps-blocks/v2',
				'/filter',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'ajax_live_filter' ),
					'permission_callback' => '__return_true',
				)
			);
			register_rest_route(
				'sps-blocks/v2',
				'/smart-search',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'smart_search' ),
					'permission_callback' => '__return_true',
				)
			);

			// Register GET endpoint.
			register_rest_route(
				'smart-post/v2',
				'/get-global-settings',
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'get_global_settings' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);
			// Register POST endpoint.
			register_rest_route(
				'smart-post/v2',
				'/global-settings',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'smart_post_save_global_settings' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);

			// Register POST endpoint.
			register_rest_route(
				'smart-post/v2',
				'/icon-list',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'sp_smart_icon_list' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);
		}
		/**
		 * Get icon list.
		 *
		 * @return array
		 */
		public function sp_smart_icon_list() {
			return rest_ensure_response( wp_json_encode( $this->icon_list ) );
		}
		/**
		 * Load core files.
		 *
		 * @return array
		 */
		public function get_global_settings() {
			$settings = get_option( 'sp_smart_post_global_settings', array() );
			return rest_ensure_response( $settings );
		}

		/**
		 * Save global settings via REST API.
		 *
		 * @param WP_REST_Request $request The REST request.
		 * @return WP_REST_Response|WP_Error
		 */
		public function smart_post_save_global_settings( $request ) {
			$settings = $request->get_json_params();
			// Basic validation (optional but recommended).
			if ( ! is_array( $settings ) ) {
				return new WP_Error( 'invalid_data', 'Settings must be an array', array( 'status' => 400 ) );
			}
			update_option( 'sp_smart_post_global_settings', $settings );
			return $settings;
		}

		/**
		 * Undocumented function
		 *
		 * @param string $unique_id Block unique id.
		 * @param array  $block_location_data Block location data.
		 * @return statement
		 */
		public function get_template_block( $unique_id, $block_location_data = array() ) {
			// Validate input.
			if ( ! is_array( $block_location_data ) || empty( $block_location_data['location'] ) ) {
				return null;
			}

			$location    = $block_location_data['location'] ?? '';
			$template_id = $block_location_data['templateId'] ?? '';
			$area_name   = $block_location_data['areaName'] ?? '';
			$post_type   = $block_location_data['postType'] ?? '';

			$template_content = '';

			switch ( $location ) {
				case 'wp_template':
					if ( 'wp_block' === $post_type && $template_id ) {
						// For wp_block.
						$post             = get_post( $template_id );
						$template_content = $post->post_content ?? '';
					}
					if ( $template_id && 'wp_block' !== $post_type ) {
						$template         = get_block_template( $template_id, 'wp_template' );
						$template_content = $template->content ?? '';
					}
					break;

				case 'wp_template_part':
					if ( $area_name ) {
						// Try to get template part by area name (header, footer, etc.).
						$template = get_block_template( get_stylesheet() . '//' . $area_name, 'wp_template_part' );
						if ( ! $template || empty( $template->content ) ) {
							// Fallback: try by slug if area name doesn't work.
							$template = get_block_template( $area_name, 'wp_template_part' );
						}
						$template_content = $template->content ?? '';
					}
					if ( 'wp_block' === $post_type && $template_id ) {
						// For wp_block.
						$post             = get_post( $template_id );
						$template_content = $post->post_content ?? '';
					}
					break;
				case 'widget-area':
					// Widget areas are handled differently - might need to get sidebar content.
					if ( $area_name ) {
						$sidebar_content  = $this->get_widget_area_content( $area_name );
						$template_content = $sidebar_content;
					}
					break;
				case 'post-content':
					if ( $post_type && $template_id ) {
						// For regular posts/pages.
						$post             = get_post( $template_id );
						$template_content = $post->post_content ?? '';
					}
					break;

				default:
					return null;
			}
			// Parse blocks and find the specific block.
			if ( 'widget-area' === $location ) {
				$blocks = $template_content; // Already parsed blocks from widget area.
			} else {
				$blocks = parse_blocks( $template_content );
			}
			$block = $this->get_block_by_unique_id( $blocks, $unique_id );
			if ( ! $block ) {
				$reusable_block_ids = $this->get_reusable_ids( $template_content, $blocks );
				if ( ! empty( $reusable_block_ids ) ) {
					foreach ( $reusable_block_ids as $ref_id ) {
						$ref_post = get_post( $ref_id );
						if ( $ref_post && isset( $ref_post->post_content ) ) {
							$ref_blocks = parse_blocks( $ref_post->post_content );
							$block      = $this->get_block_by_unique_id( $ref_blocks, $unique_id );
							if ( $block ) {
								break;
							}
						}
					}
				}
				$shortcode_block_ids = $this->get_shortcode_ids( $template_content, $blocks );
				if ( ! empty( $shortcode_block_ids ) ) {
					foreach ( $shortcode_block_ids as $ref_id ) {
						$ref_post = get_post( $ref_id );
						if ( $ref_post && isset( $ref_post->post_content ) ) {
							$ref_blocks = parse_blocks( $ref_post->post_content );
							$block      = $this->get_block_by_unique_id( $ref_blocks, $unique_id );
							if ( $block ) {
								break;
							}
						}
					}
				}
			}
			return $block;
		}

		/**
		 * Object to array.
		 *
		 * @param object $data meta data.
		 * @return array
		 */
		public static function object_to_array( $data ) {
			if ( is_array( $data ) || is_object( $data ) ) {
				$result = array();
				foreach ( $data as $key => $value ) {
					$result[ $key ] = ( is_array( $value ) || is_object( $value ) ) ? self::object_to_array( $value ) : $value;
				}
				return $result;
			}
			return $data;
		}

		/**
		 * Recursively searches for a block with a specific unique ID within a set of blocks.
		 *
		 * @param array  $blocks    Array of blocks to search.
		 * @param string $unique_id The unique ID to find.
		 * @return array|null       The block if found, or null if not found.
		 */
		public function get_block_by_unique_id( $blocks, $unique_id ) {
			foreach ( $blocks as $block ) {
				if ( isset( $block[0] ) && is_array( $block[0] ) && isset( $block[0]['blockName'] ) ) {
					$block = $block[0];
				}
				if ( isset( $block['attrs']['spBlockId'] ) && $block['attrs']['spBlockId'] === $unique_id ) {
					return $block;
				}
				if ( ! empty( $block['innerBlocks'] ) ) {
					$found = $this->get_block_by_unique_id( $block['innerBlocks'], $unique_id );
					if ( $found ) {
						return $found;
					}
				}
			}
			return null;
		}
		/**
		 * Get term counts from post IDs for one or multiple taxonomies.
		 *
		 * @param array        $post_ids   Array of post IDs.
		 * @param string|array $taxonomies Single taxonomy or array of taxonomies.
		 *
		 * @return array Associative array: taxonomy => [ term_id, slug, count ].
		 */
		public function get_term_counts_from_post_ids( $post_ids, $taxonomies ) {
			global $wpdb;

			if ( empty( $post_ids ) || ! is_array( $post_ids ) ) {
				return array();
			}

			$post_ids     = array_map( 'absint', $post_ids );
			$placeholders = implode( ',', array_fill( 0, count( $post_ids ), '%d' ) );
			$terms_count  = array();

			// Normalize taxonomy input.
			$taxonomies = (array) $taxonomies;

			foreach ( $taxonomies as $taxonomy ) {
				$args = array_merge( $post_ids, array( $taxonomy ) );
				$sql  = $wpdb->prepare(
					"SELECT tt.term_id, t.slug, COUNT(*) as count
			 FROM {$wpdb->term_relationships} tr
			 INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id WHERE tr.object_id IN ($placeholders)
			 AND tt.taxonomy = %s
			 GROUP BY tt.term_id",
					...$args
				);

				// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table and column names cannot be prepared; they are trusted values from $wpdb.
				$results = $wpdb->get_results( $sql );

				$term_counts = array_map(
					function ( $row ) {
						return array(
							'term_id' => (int) $row->term_id,
							'slug'    => $row->slug,
							'count'   => (int) $row->count,
						);
					},
					$results
				);

				$terms_count[ $taxonomy ] = $term_counts;
			}

			// Return flat list if only one taxonomy was passed.
			return $terms_count;
		}
		/**
		 * Get authors with post count from given post IDs.
		 *
		 * @param array $post_ids Array of post IDs.
		 * @return array Array of authors with ID, name, and post count.
		 */
		public function get_authors_from_post_ids( $post_ids ) {
			global $wpdb;

			if ( empty( $post_ids ) || ! is_array( $post_ids ) ) {
				return array();
			}
			// Ensure all IDs are integers.
			$post_ids = array_map( 'absint', $post_ids );
			// Create placeholders for each ID.
			$placeholders = implode( ', ', array_fill( 0, count( $post_ids ), '%d' ) );
			// Prepare SQL safely.

			// phpcs:ignore
			$query = $wpdb->prepare(
				" SELECT p.post_author AS author_id, u.display_name, COUNT(*) as post_count
		FROM {$wpdb->posts} p
		INNER JOIN {$wpdb->users} u ON p.post_author = u.ID
		WHERE p.ID IN ($placeholders)
		GROUP BY p.post_author ",
				...$post_ids
			);

			// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table and column names cannot be prepared; they are trusted values from $wpdb.
			$results = $wpdb->get_results( $query );

			$authors = array();
			foreach ( $results as $row ) {
				$authors[] = array(
					'slug'  => (int) $row->author_id,
					'count' => (int) $row->post_count,
				);
			}

			return $authors;
		}
		/**
		 * Get All Reusable IDs content.
		 *
		 * @param string $post_content post content.
		 * @param string $blocks post blocks.
		 * @return array
		 */
		public function get_reusable_ids( $post_content, $blocks ) {
			$reusable_id = array();
			if ( ! empty( $post_content ) ) {
				if (
					has_blocks( $post_content ) &&
					strpos( $post_content, 'wp:block' ) &&
					strpos( $post_content, '"ref"' ) !== false
				) {
					foreach ( $blocks as $key => $value ) {
						if ( isset( $value['attrs']['ref'] ) ) {
							$reusable_id[] = $value['attrs']['ref'];
						}
					}
				}
			}
			return $reusable_id;
		}
		/**
		 * Get All Shortcode IDs content.
		 *
		 * @param string $post_content post content.
		 * @param string $blocks Blocks content.
		 * @return array
		 */
		public function get_shortcode_ids( $post_content, $blocks ) {
			$ref_ids              = array();
			$saved_template_count = wp_count_posts( 'sp_post_template' );
			$total_saved_template = $saved_template_count->publish;

			if ( empty( $post_content ) || 0 === $total_saved_template ) {
				return $ref_ids;
			}

			// --- Step 1: Find reusable block IDs ---
			if (
				has_blocks( $post_content ) && ! empty( $post_content )
			) {
				foreach ( $blocks as $block ) {
					if ( isset( $block['attrs']['ref'] ) ) {
						$ref_ids[] = $block['attrs']['ref'];
					}
				}
			}
			// --- Step 2: Find shortcode IDs like [smart_post_show id="7476"] or id=7476 ---
			preg_match_all( '/\[smart_post\s+id=["\']?(\d+)["\']?\]/', $post_content, $matches );
			if ( ! empty( $matches[1] ) ) {
				$ref_ids = array_merge( $ref_ids, $matches[1] );
			}
			// Remove duplicates just in case.
			$ref_ids = array_unique( $ref_ids );

			return $ref_ids;
		}

		/**
		 * Retrieves a block by its unique ID from a given page.
		 *
		 * @param WP_REST_Request $request The REST request containing page_id and unique_id.
		 * @return WP_Error|WP_REST_Response|null Returns the block data or an error if not found.
		 */
		public function ajax_live_filter( WP_REST_Request $request ) {
			if ( ! ( $request instanceof \WP_REST_Request ) ) {
				return;
			}
			$query_params             = $request->get_params();
			$page_id                  = ! empty( $query_params['page_id'] ) ? absint( $query_params['page_id'] ) : '';
			$unique_id                = ! empty( $query_params['block'] ) ? sanitize_text_field( $query_params['block'] ) : '';
			$block_location           = ! empty( $query_params['block_location'] ) ? sanitize_text_field( $query_params['block_location'] ) : '';
			$block_location           = ! empty( $block_location ) ? json_decode( $block_location, true ) : array();
			$block_editor_type        = isset( $block_location['editor'] ) ? $block_location['editor'] : '';
			$block_editor_location    = isset( $block_location['location'] ) ? $block_location['location'] : '';
			$block_template_slug      = isset( $block_location['templateSlug'] ) ? $block_location['templateSlug'] : '';
			$block_template_type      = isset( $block_location['templateType'] ) ? $block_location['templateType'] : '';
			$block_template_post_type = isset( $block_location['postType'] ) ? $block_location['postType'] : 'wp_template';
			$block_area_name          = isset( $block_location['areaName'] ) ? $block_location['areaName'] : '';
			if ( 'wp_template_part' === $block_editor_location ) {
				$block_template_post_type = 'wp_template_part';
			}
			if ( 'site-editor' === $block_editor_type || 'widget-area' === $block_editor_location ) {
				$block = $this->get_template_block( $unique_id, $block_location );
			} else {
				$content = get_post_field( 'post_content', $page_id );
				if ( ! $content ) {
					return new WP_Error( 'not_found', 'Page not found or has no content.', array( 'status' => 404 ) );
				}
				$blocks = parse_blocks( $content );
				$block  = $this->get_block_by_unique_id( $blocks, $unique_id );
				if ( ! $block ) {
					$reusable_block_ids = $this->get_reusable_ids( $content, $blocks );
					if ( ! empty( $reusable_block_ids ) ) {
						foreach ( $reusable_block_ids as $ref_id ) {
							$ref_post = get_post( $ref_id );
							if ( $ref_post && isset( $ref_post->post_content ) ) {
								$ref_blocks = parse_blocks( $ref_post->post_content );
								$block      = $this->get_block_by_unique_id( $ref_blocks, $unique_id );
								if ( $block ) {
									break;
								}
							}
						}
					}
					$shortcode_block_ids = $this->get_shortcode_ids( $content, $blocks );
					if ( ! empty( $shortcode_block_ids ) ) {
						foreach ( $shortcode_block_ids as $ref_id ) {
							$ref_post = get_post( $ref_id );
							if ( $ref_post && isset( $ref_post->post_content ) ) {
								$ref_blocks = parse_blocks( $ref_post->post_content );
								$block      = $this->get_block_by_unique_id( $ref_blocks, $unique_id );
								if ( $block ) {
									break;
								}
							}
						}
					}
				}
			}
			if ( ! $block ) {
				return new WP_Error( 'not_found', 'Block with this uniqueId not found.', array( 'status' => 404 ) );
			}

			if ( $block['attrs'] ) {
				$attrs      = $block['attrs'];
				$block_name = $attrs['blockName'];

				$block_full_name = 'sp-smart-post-show/' . $block_name;
				$block_type      = \WP_Block_Type_Registry::get_instance()->get_registered( $block_full_name );

				$default_attrs = array_map(
					function ( $attr ) {
						return isset( $attr['default'] ) ? $attr['default'] : null;
					},
					$block_type->attributes
				);
				$attrs         = array_merge( $default_attrs, $attrs ?? array() );
				unset( $attrs['dynamicCss'] );
				$query_data = json_decode( $attrs['postQuery'], true );
				// Apply extra filters.
				if ( ! empty( $query_params['relation'] ) ) {
					$query_data['relation'] = sanitize_key( $query_params['relation'] );
				}
				if ( ! empty( $query_params['sps_search'] ) ) {
					$query_data['s'] = sanitize_text_field( $query_params['sps_search'] );
				}
				$no_result_found = isset( $attrs['noResultFoundResult'] ) ? $attrs['noResultFoundResult'] : 'No post found';
				// Sorting logic.
				if ( ! empty( $query_params['sps_sort'] ) ) {
					$sps_sort = $query_params['sps_sort'];
					if ( preg_match( '/^([a-zA-Z0-9_]+)_(asc|des)$/i', $sps_sort, $matches ) ) {
						$query_data['fl_orderBy']        = sanitize_key( $matches[1] );
						$query_data['fl_orderDirection'] = strtoupper( $matches[2] ) === 'ASC' ? 'ASC' : 'DESC';
					} elseif ( in_array( strtoupper( $sps_sort ), array( 'ASC', 'DESC' ), true ) ) {
						$query_data['fl_orderDirection'] = strtoupper( $sps_sort );
					} else {
						$query_data['fl_orderBy'] = sanitize_key( $sps_sort );
					}
					$query_data['ajax_order'] = true;
				}

				// Taxonomies & Author filters.
				$taxonomies             = array();
				$author_filter          = array();
				$is_author_filter_exist = false;
				$count_taxonomies       = array();
				$all_tax_type           = array();
				foreach ( $query_params as $key => $value ) {
					$key = sanitize_key( $key );
					if ( strpos( $key, 'tx_' ) === 0 ) {
						$tax_type         = str_replace( 'tx_', '', $key );
						$all_tax_type[]   = $tax_type;
						$current_taxonomy = array(
							'id'          => time() + wp_rand( 1, 999 ),
							'type'        => sanitize_key( $tax_type ),
							'value'       => is_array( $value ) ? array_map( 'sanitize_text_field', $value ) : array( sanitize_text_field( $value ) ),
							'operator'    => 'IN',
							'initialOpen' => true,
						);
						if ( ! empty( $value ) ) {
							$taxonomies[] = $current_taxonomy;
						}
					}
					if ( 'sps_author' === $key ) {
						if ( ! empty( $value ) ) {
							$author_filter[] = array(
								'id'    => time() + wp_rand( 1, 999 ),
								'type'  => 'author',
								'value' => sanitize_text_field( $value ),
							);
						}
						$is_author_filter_exist = true;
					}
				}

				if ( ! empty( $author_filter ) ) {
					$query_data['filterByAuthor'] = $author_filter;
				}
				$count_data                   = array();
				$query_data['ajaxLiveFilter'] = true;
				// Generate count data for each taxonomy.
				if ( ! empty( $taxonomies ) ) {
					foreach ( $all_tax_type as $taxonomy ) {
						$filtered_taxonomies                = array_filter(
							$taxonomies,
							function ( $tax ) use ( $taxonomy ) {
								return $tax['type'] !== $taxonomy;
							}
						);
						$query_data_for_count               = $query_data;
						$query_data_for_count['taxonomies'] = array_values( $filtered_taxonomies );
						if ( ! empty( array_values( $filtered_taxonomies ) ) ) {
							$query_data_for_count['tax_type'] = 'slug';
						}
						$count_query_data = \SmartPostShow\Blocks\PostQueryHandler::query( $query_data_for_count, 'args' );
						$all_post_ids     = $count_query_data['post_ids'];
						$count_data       = array_merge(
							$count_data,
							$this->get_term_counts_from_post_ids( $all_post_ids, $taxonomy )
						);
					}
					$query_data['tax_type']   = 'slug';
					$query_data['taxonomies'] = $taxonomies;
				}

				// Author count data if filter active.
				if ( ! empty( $author_filter ) ) {
					$author_query_data = $query_data;
					unset( $author_query_data['filterByAuthor'] );
					$author_count_query_data = \SmartPostShow\Blocks\PostQueryHandler::query( $author_query_data, 'args' );
					$all_post_ids            = $author_count_query_data['post_ids'];
					$count_data['author']    = $this->get_authors_from_post_ids( $all_post_ids );
				}
				// Pagination support.
				$current_page    = 1;
				$pagination_type = '';
				if ( ! empty( $query_params['sps_page'] ) && $query_params['sps_page'] > 1 ) {
					$query_data['currentPage'] = absint( $query_params['sps_page'] );
					$current_page              = absint( $query_params['sps_page'] );
					$pagination_type           = ! empty( $query_params['pagination_type'] ) ? sanitize_text_field( $query_params['pagination_type'] ) : '';
				}

				$post_query   = \Sp_Smart_Post_Blocks_Query::post_query_frontend( $query_data );
				$all_post_ids = $post_query[2] ?? array();
				$total_pages  = $post_query[1] ?? '';

				$count_data['pagination'] = array(
					'total_pages'  => $total_pages,
					'current_page' => $current_page,
				);

				// Fallback count calculation if filters are missing.
				if ( empty( $taxonomies ) && ! empty( $all_tax_type ) ) {
					$count_data = array_merge( $count_data, $this->get_term_counts_from_post_ids( $all_post_ids, $all_tax_type ) );
				}

				if ( empty( $author_filter ) && $is_author_filter_exist ) {
					$count_data['author'] = $this->get_authors_from_post_ids( $all_post_ids );
				}

				$post_query      = $post_query[0] ?? array();
				$html            = '';
				$full_class_name = '';
				if ( ! isset( $query_params['html'] ) ) {
					// Render block content.
					ob_start();
					$method_name     = str_replace( '-', '_', $block_name );
					$full_class_name = 'SmartPostShow\\Blocks\\Template';

					if ( method_exists( $full_class_name, $method_name ) ) {

						call_user_func( array( $full_class_name, $method_name ), $attrs, $post_query, $pagination_type );
					}
					$html = ob_get_clean();
					if ( empty( $post_query ) ) {
						$html = $no_result_found;
					}
				}
				return rest_ensure_response(
					array(
						'success'         => true,
						'html'            => $html,
						'count_data'      => $count_data,
						'post_query'      => $post_query,
						'full_class_name' => $full_class_name,
					)
				);
			}

			wp_die();
		}
		/**
		 * Process smart search query data.
		 *
		 * @param array $search_settings Search settings including post types, search term, taxonomy filters etc.
		 * @return array Array of post data matching the search criteria.
		 */
		public function smart_search_query_data( $search_settings ) {
			// Extract settings.
			$post_type   = $search_settings['postType'] ?? 'post';
			$search_term = sanitize_text_field( $search_settings['s'] ?? '' );
			$taxonomy    = sanitize_text_field( $search_settings['taxonomyType'] ?? '' );
			$term        = sanitize_text_field( $search_settings['term'] ?? array() );
			$post_limit  = isset( $search_settings['postLimit'] ) ? absint( $search_settings['postLimit'] ) : 4;
			$load_more   = filter_var( $search_settings['loadMore'] ?? false, FILTER_VALIDATE_BOOLEAN );

			// Base query args.
			$args = array(
				'post_type'   => $post_type,
				'post_status' => 'publish',
				's'           => $search_term,
			);

			// if load more is true → show all remaining posts .
			if ( $load_more ) {
				$args['posts_per_page'] = -1;
			} else {
				$args['posts_per_page'] = $post_limit;
			}

			// Taxonomy filter.
			if ( ! empty( $search_settings['isTaxonomyEnabled'] ) && ! empty( $taxonomy ) && ! empty( $term ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $term,
					),
				);
			}

			// Run query.
			$query      = new WP_Query( $args );
			$post_query = array();

			// Total available posts count.
			$total_posts = $query->found_posts;

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id       = get_the_ID();
					$thumbnail_id  = get_post_thumbnail_id( $post_id );
					$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium' ) : '';
					$thumbnail_alt = $thumbnail_id ? get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) : '';
					$category_list = array();
					if ( 'product' === $post_type ) {
						$product_terms = wp_get_object_terms( $post_id, $taxonomy );
						if ( ! empty( $product_terms ) && ! is_wp_error( $product_terms ) ) {
							foreach ( $product_terms as $term ) {
								$category_list[] = $term->name;
							}
						}
					} else {
						$category_list = wp_get_post_terms( $post_id, 'category', array( 'fields' => 'names' ) );
					}

					$post_query[] = array(
						'id'                 => $post_id,
						'title'              => get_the_title(),
						'link'               => get_permalink(),
						'post_thumbnail_url' => $thumbnail_url,
						'image_alt'          => $thumbnail_alt,
						'excerpt'            => get_the_excerpt(),
						'author'             => get_the_author(),
						'date'               => get_the_date(),
						'categories'         => $category_list,
					);
				}
				wp_reset_postdata();
			}

			// Remaining post count.
			$remaining_posts = max( 0, $total_posts - count( $post_query ) );

			return array(
				'post_query'      => $post_query,
				'total_posts'     => $total_posts,
				'remaining_posts' => $remaining_posts,
			);
		}

		/**
		 * Handle smart search REST API endpoint.
		 *
		 * @param WP_REST_Request $request Request data.
		 * @return void
		 */
		public function smart_search( WP_REST_Request $request ) {
			if ( ! ( $request instanceof \WP_REST_Request ) ) {
				return;
			}
			$query_params = $request->get_params();
			$page         = isset( $query_params['page'] ) ? $query_params['page'] : 'frontend';

			$response = $this->smart_search_query_data( $query_params );

			$post_query      = $response['post_query'];
			$total_posts     = $response['total_posts'];
			$remaining_posts = $response['remaining_posts'];

			if ( 'editor' === $page ) {
				return rest_ensure_response(
					array(
						'success'         => true,
						'posts'           => $post_query,
						'total_posts'     => $total_posts,
						'remaining_posts' => $remaining_posts,
					)
				);
			}

			$html = '';
			if ( ! isset( $query_params['html'] ) ) {
				ob_start();
				$method_name     = 'smart_search';
				$full_class_name = 'SmartPostShow\\Blocks\\Template';

				if ( method_exists( $full_class_name, $method_name ) ) {
					call_user_func( array( $full_class_name, $method_name ), $query_params, $post_query );
				}

				$html = ob_get_clean();
				if ( empty( $post_query ) ) {
					$no_result_found_text = isset( $query_params['noResultFoundResult'] ) ? $query_params['noResultFoundResult'] : 'No post found';
					$html                 = '<span class="sp-search-not-found">' . esc_html( $no_result_found_text ) . '</span>';
				}
			}

			return rest_ensure_response(
				array(
					'success'         => true,
					'html'            => $html,
					'total_posts'     => $total_posts,
					'remaining_posts' => $remaining_posts,
				)
			);
		}

		/**
		 * Get current block attributes.
		 *
		 * @param array  $blocks     Array of blocks.
		 * @param string $block_id   Block ID.
		 * @param string $block_name Block name.
		 */
		public static function current_block_attr( $blocks, $block_id, $block_name ) {

			foreach ( $blocks as $key => $value ) {
				if ( $block_name == $value['blockName'] ) {
					if ( isset( $value['attrs']['uniqueId'] ) && $value['attrs']['uniqueId'] == $block_id ) {
						// $objectBlock = '\\SmartPostShow\\Blocks\\' . Helper::to_studly_case( $block_name );
						// if ( class_exists( $objectBlock ) ) {
						$attr              = $value['attrs'];
						$attr['blockName'] = $block_name;
						$attr['blockId']   = $block_id;
						return $attr;
						// } else {
						// return array();
						// }
					} else {
						return array();
					}
				}
			}
		}


		/**
		 * Loads the core files required for the plugin blocks.
		 *
		 * @return void
		 */
		private function load_core_files() {
			$core_files = array(
				// 'class-block-helper.php',
				'class-assets-manager.php',
				'class-smart-post-block-query.php',
				'class-premed-design-library.php',
				'class-smart-block-abstract.php',
				'class-template-part.php',
				'class-query-filter.php',
				'class-toc-manager.php',
				'template.php',
			);
			foreach ( $core_files as $file ) {
				require_once SP_PC_PATH . 'blocks/includes/' . $file;
			}
			require_once SP_PC_PATH . 'blocks/modules/class-smart-post-show-back-to-top.php';
		}

		/**
		 * Loads block classes for each block slug.
		 *
		 * @return void
		 */
		public function load_block_classes() {
			foreach ( $this->block_slugs as $slug ) {
				$class_name = Helper::to_studly_case( $slug );
				$class_file = SP_PC_PATH . "blocks/includes/{$slug}/{$class_name}.php";
				if ( file_exists( $class_file ) ) {
					require_once $class_file;
				}
			}
		}

		/**
		 * Register block settings option.
		 *
		 * @return void
		 */
		public function register_block_settings_option() {
			add_option(
				'sp-pcp-blocks-setting-options',
				array_map(
					function ( $slug ) {
						return array(
							'block_name' => $slug,
							'show'       => true,
						);
					},
					$this->block_slugs
				)
			);

			add_option(
				'sp-pcp-blocks-modules-options',
				array_map(
					function ( $item ) {
						return array(
							'module_name' => $item['module_name'],
							'show'        => true,
						);
					},
					$this->modules_default
				)
			);

			add_option(
				'sp-pcp-integration-options',
				array_map(
					function ( $item ) {
						return array(
							'name' => $item['name'],
							'show' => true,
						);
					},
					$this->integration_default
				)
			);
		}
		/**
		 * Purge all the transients associated with our plugin.
		 *
		 * @return void
		 */
		public function clear_cache_site_editor() {
			global $wpdb;

			if ( is_multisite() ) {
				$table  = $wpdb->sitemeta;
				$column = 'meta_key';
				$like   = $wpdb->esc_like( '_site_transient_sp_smart_' ) . '%';
			} else {
				$table  = $wpdb->options;
				$column = 'option_name';
				$like   = $wpdb->esc_like( '_transient_sp_smart_' ) . '%';
			}

			$sql = "DELETE FROM {$table} WHERE {$column} LIKE %s";

			// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Table and column names cannot be prepared; they are trusted values from $wpdb.
			$wpdb->query( $wpdb->prepare( $sql, $like ) );
		}

		/**
		 * Purge all the transients associated with our plugin.
		 *
		 * @param int $post_id Post id.
		 * @return void
		 */
		public function clear_cache( $post_id ) {
			// Avoid running during autosave or revisions.
			if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
				return;
			}
			$keys = get_option( 'sp_smart_post_transients', array() );
			foreach ( $keys as $key ) {
				delete_transient( $key ); // Delete query cache.
			}
			delete_option( 'sp_smart_post_transients' );
			// Build transient key for this post.
			$transient_key = 'sp_smart_post_dynamic_css_' . $post_id;
			// Delete it.
			delete_transient( $transient_key );
		}


		/**
		 * Register category function
		 *
		 * @param array  $categories Categories list.
		 * @param object $post Post.
		 * @return array
		 */
		public function register_block_category( $categories, $post ) {
			return array_merge(
				array(
					array(
						'slug'  => 'sp-smart-post-show',
						'title' => __( 'SMART POST', 'post-carousel' ),
					),
				),
				$categories
			);
		}

		/**
		 * Register blocks.
		 *
		 * This function registers all the blocks defined in the plugin.
		 * It loads attributes from files and applies filters to allow customization.
		 *
		 * @return void
		 */
		public function register_blocks() {
			$attribute_files = $this->block_slugs;
			require_once SP_PC_PATH . 'blocks/includes/attributes/pagination.php';
			require_once SP_PC_PATH . 'blocks/includes/attributes/shared.php';
			$blocks = array();
			foreach ( $attribute_files as $file ) {
				$block_name          = "sp-smart-post-show/{$file}";
				$attribute_file_path = SP_PC_PATH . "blocks/includes/{$file}/attributes.php";
				if ( file_exists( $attribute_file_path ) ) {
					$blocks[ $block_name ] = require $attribute_file_path;
				}
			}
			$all_blocks_attributes = apply_filters( 'sp_smart_post_show_blocks', $blocks );
			$block_options         = array();
			$actives_blocks        = Helper::object_to_array( get_option( 'sp-pcp-blocks-setting-options' ) );
			$always_active_blocks  = array(
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
			$actives_blocks        = array_merge( $actives_blocks, $always_active_blocks );
			foreach ( $actives_blocks as $value ) {
				$block_options[ $value['block_name'] ] = $value['show'];
			}
			// Register block type.
			foreach ( $this->block_slugs as $slug ) {
				$full_block_name = "sp-smart-post-show/{$slug}";
				$full_class      = '\\SmartPostShow\\Blocks\\' . Helper::to_studly_case( $slug );
				if ( class_exists( $full_class ) && ! empty( $block_options[ $slug ] ) ) {
					new $full_class( $all_blocks_attributes[ $full_block_name ] );
				}
			}
		}

		/**
		 * Returns the default spacing attribute structure for blocks.
		 *
		 * @param string $top        Top spacing value.
		 * @param string $right      Right spacing value.
		 * @param string $bottom     Bottom spacing value.
		 * @param string $left       Left spacing value.
		 * @param string $unit       Unit for spacing (default: 'px').
		 * @param bool   $all_change Whether all sides change together.
		 * @return array             The spacing attribute array.
		 */
		public function spacing_attribute( $top = '', $right = '', $bottom = '', $left = '', $unit = 'px', $all_change = false ) {
			return array(
				'type'    => 'object',
				'default' => array(
					'device'    => array(
						'Desktop' => array(
							'top'    => $top,
							'right'  => $right,
							'bottom' => $bottom,
							'left'   => $left,
						),
						'Tablet'  => array(
							'top'    => '',
							'right'  => '',
							'bottom' => '',
							'left'   => '',
						),
						'Mobile'  => array(
							'top'    => '',
							'right'  => '',
							'bottom' => '',
							'left'   => '',
						),
					),
					'unit'      => array(
						'Desktop' => $unit,
						'Tablet'  => $unit,
						'Mobile'  => $unit,
					),
					'allChange' => $all_change,
				),
			);
		}

		/**
		 * Returns the default range attribute structure for blocks.
		 *
		 * @param string      $desktop Value for Desktop device.
		 * @param string      $tablet  Value for Tablet device.
		 * @param string      $mobile  Value for Mobile device.
		 * @param string|bool $unit    Unit for the value (default: 'px'). If false, unit is not included.
		 * @return array         The range attribute array.
		 */
		public function ranger_attribute( $desktop = '', $tablet = '', $mobile = '', $unit = 'px' ) {
			if ( false === $unit ) {
				return array(
					'type'    => 'object',
					'default' => array(
						'device' => array(
							'Desktop' => $desktop,
							'Tablet'  => $tablet,
							'Mobile'  => $mobile,
						),
					),
				);
			}
			return array(
				'type'    => 'object',
				'default' => array(
					'device' => array(
						'Desktop' => $desktop,
						'Tablet'  => $tablet,
						'Mobile'  => $mobile,
					),
					'unit'   => array(
						'Desktop' => $unit,
						'Tablet'  => $unit,
						'Mobile'  => $unit,
					),
				),
			);
		}

		/**
		 * Updates parent attribute data with new values, supporting responsive and object types.
		 *
		 * @param array $parent_attr The original parent attribute array.
		 * @param array $attr        The array of attribute changes to apply.
		 * @return array             The updated attribute array.
		 */
		public function change_attribute_data( $parent_attr, $attr ) {
			$new_data = $parent_attr;
			if ( ! is_array( $attr ) ) {
				return $new_data;
			}
			foreach ( $attr as $data ) {
				$attr_name   = $data['attrName'] ?? null;
				$value       = $data['value'] ?? null;
				$device_type = $data['deviceType'] ?? 'Desktop';

				if ( ! $attr_name || ! isset( $parent_attr[ $attr_name ] ) ) {
					continue;
				}
				$data_type = $parent_attr[ $attr_name ]['type'] ?? null;
				switch ( $data_type ) {
					case 'string':
					case 'boolean':
						$new_data[ $attr_name ] = array_merge(
							$parent_attr[ $attr_name ],
							array( 'default' => $value )
						);
						break;
					case 'object':
						$default_value = $parent_attr[ $attr_name ]['default'] ?? array();
						if ( isset( $default_value['device'] ) ) {
							// It's a responsive value.
							$device                 = $default_value['device'];
							$device[ $device_type ] = $value;
							$merged_default         = array_merge( $default_value, array( 'device' => $device ) );
						} else {
							// It's a single object value.
							$merged_default = array_merge( $default_value, array( 'value' => $value ) );
						}
						$new_data[ $attr_name ] = array_merge(
							$parent_attr[ $attr_name ],
							array( 'default' => $merged_default )
						);
						break;
				}
			}
			return $new_data;
		}
		/**
		 * Get Ajax data function
		 *
		 * @return void
		 */
		public static function sp_handle_post_id_callback() {
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp_smart_post_block_nonce' ) ) {
				return;
			}

			$post_id    = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
			$image_size = isset( $_POST['image_size'] ) ? sanitize_text_field( wp_unslash( $_POST['image_size'] ) ) : 'original';

			if ( ! $post_id || get_post_status( $post_id ) !== 'publish' ) {
				wp_send_json_error( 'Invalid or unpublished post.' );
			}
			$image_id = get_post_thumbnail_id( $post_id );

			$post          = get_post( $post_id );
			$post_author   = ucwords( get_the_author_meta( 'display_name', $post->post_author ) );
			$post_date     = get_the_date( 'F j, Y', $post_id );
			$categories    = get_the_terms( $post_id, 'category' );
			$category_list = '';
			if ( ! empty( $categories ) ) {
				foreach ( $categories as $category ) {
					$category_list .= ' ' . ucwords( $category->name );
				}
			}
			$meta_taxonomy    = $category_list;
			$post_views_count = get_post_meta( $post_id, '_post_views_count', true );
			$post_like_count  = get_post_meta( $post_id, '_post_like_count', true );
			// $like_button_option = array(
			// 'like_options' => SP_PCP_User_Like::get_pcp_likes_block_button( $post_id ),
			// 'post_id'      => $post_id,
			// );
			// $like_button        = Template_Part::like( $like_button_option );

			$data = array(
				'title'         => get_the_title( $post ),
				'content'       => apply_filters( 'the_content', $post->post_content ),
				'post_data'     => $post,
				// 'post_thumbnail'      => get_the_post_thumbnail( $post ),
				'meta_taxonomy' => $meta_taxonomy,
				'date_time'     => $post_date,
				'author_name'   => $post_author,
				'post_views'    => $post_views_count,
				// 'like_button'      => $like_button,
				'post_image'    => wp_get_attachment_image( $image_id, $image_size ),
				// 'post_badges_list' => get_the_terms( $post_id, 'sp_smart_badges' ),
			);
			wp_send_json_success( $data );
		}
	}
}
