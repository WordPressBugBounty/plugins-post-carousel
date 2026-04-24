<?php
/**
 * The plugin gutenberg block query Initializer.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sp_Smart_Post_Blocks_Query' ) ) {
	/**
	 * Sp_Smart_Post_Blocks_Query class.
	 */
	class Sp_Smart_Post_Blocks_Query {

		/**
		 * This plugin's instance.
		 *
		 * @var Query
		 */
		private static $instance;

		/**
		 * Main Query Instance.
		 *
		 * Insures that only one instance of Blocks exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @static
		 * @return object|Query The one true Blocks
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new Sp_Smart_Post_Blocks_Query();
				self::$instance->init();
			}
			return self::$instance;
		}

		/**
		 * Initialize function
		 *
		 * @return void
		 */
		public function init() {
			add_action( 'wp_ajax_sp_smart_post_block_post_query', array( $this, 'sp_smart_post_block_post_query' ) );
			add_action( 'wp_ajax_nopriv_sp_smart_post_block_post_query', array( $this, 'sp_smart_post_block_post_query' ) );
			// query functions for get all post.
			if ( is_admin() ) {
				add_action( 'wp_ajax_sp_smart_post_block_all_post_query', array( $this, 'sp_smart_post_block_all_post_query' ) );
				add_action( 'wp_ajax_nopriv_sp_smart_post_block_all_post_query', array( $this, 'sp_smart_post_block_all_post_query' ) );
			}

			// metadata query.
			add_action( 'wp_ajax_sp_smart_post_block_meta_data_query', array( $this, 'sp_smart_post_block_meta_data_query' ) );
			add_action( 'wp_ajax_nopriv_sp_smart_post_block_meta_data_query', array( $this, 'sp_smart_post_block_meta_data_query' ) );
		}

		/**
		 * Handles the frontend post query for the Smart Post Block.
		 *
		 * @param array  $query_data The query data for fetching posts.
		 * @param string $block_id   Optional. The block ID.
		 * @return array             An array containing post data and total pages.
		 */
		public static function post_query_frontend( $query_data, $block_id = '' ) {
			$config = self::prepare_query_config( $query_data, $block_id );

			self::setup_image_filters( $config['image_srcset'] );

			$post_query   = \SmartPostShow\Blocks\PostQueryHandler::query( $query_data, 'normal', $block_id );
			$the_query    = $post_query['the_query'];
			$total_pages  = $post_query['total_pages'] ?? 1;
			$all_post_ids = $post_query['post_ids'] ?? array();

			$post_data = self::process_query_posts( $the_query, $config );

			self::cleanup_image_filters( $config['image_srcset'] );

			return array( $post_data, $total_pages, $all_post_ids );
		}

		/**
		 * Prepare configuration data from query parameters.
		 *
		 * @param array  $query_data The query data.
		 * @param string $block_id   The block ID.
		 * @return array Configuration array.
		 */
		private static function prepare_query_config( $query_data, $block_id = '' ) {
			$config = array(
				'post_type'                  => $query_data['postType'] ?? 'post',
				'date_format_type'           => $query_data['metaDateFormat'] ?? 'default',
				'custom_date_format'         => $query_data['metaDateCustomDateFormat'] ?? '',
				'image_size'                 => $query_data['imageSize'] ?? '',
				'unique_id'                  => $query_data['uniqueId'] ?? '',
				'enable_seo_description'     => $query_data['seoMetaShow'] ?? false,
				'active_seo_plugin'          => $query_data['activeSeoPlugin'] ?? '',
				'exclude_post_without_image' => $query_data['excludePostWithoutImagePosts'] ?? false,
				'image_srcset'               => ! empty( $query_data['imageSrcset'] ) ? (bool) $query_data['imageSrcset'] : false,
				'image_lazy_enable'          => $query_data['imageLazyLoad'] ?? false,
				'taxonomy_type'              => $query_data['catTabCategoryType'] ?? '',
			);

			$config['date_format']        = self::get_date_format( $config['date_format_type'], $config['custom_date_format'] );
			$config['image_lazy_load']    = $config['image_lazy_enable'] ? 'lazy' : 'eager';
			$config['multiple_post_type'] = self::prepare_multiple_post_types( $config['post_type'], $query_data );

			// Handle pagination.
			if ( $query_data['paginationEnable'] ?? false ) {
				$paged_var                 = 'paged_' . $block_id;
				$query_data['currentPage'] = isset( $_GET[ $paged_var ] ) ? intval( $_GET[ $paged_var ] ) : $query_data['currentPage'] ?? 1;
			}

			return $config;
		}

		/**
		 * Get the appropriate date format.
		 *
		 * @param string $date_format_type The date format type.
		 * @param string $custom_format    Custom date format.
		 * @return string The date format.
		 */
		private static function get_date_format( $date_format_type, $custom_format ) {
			switch ( $date_format_type ) {
				case 'F j, Y':
				case 'M j, Y':
					$date_format = $date_format_type;
					break;
				case 'custom':
					$date_format = $custom_format;
					break;
				default:
					$date_format = get_option( 'date_format' );
					break;
			}
			return $date_format;
		}

		/**
		 * Prepare multiple post types array.
		 *
		 * @param string $current_post_type Current post type.
		 * @param array  $query_data        Query data.
		 * @return array Multiple post types.
		 */
		private static function prepare_multiple_post_types( $current_post_type, $query_data ) {
			if ( 'multiple_post_type' !== $current_post_type || empty( $query_data['multiplePostType'] ) ) {
				return array( 'post' );
			}

			return array_map(
				function ( $multi_type ) {
					return is_array( $multi_type ) && isset( $multi_type['value'] ) ? $multi_type['value'] : $multi_type->value;
				},
				$query_data['multiplePostType']
			);
		}

		/**
		 * Setup image-related filters.
		 *
		 * @param bool $image_srcset Whether srcset is enabled.
		 */
		private static function setup_image_filters( $image_srcset ) {
			if ( ! $image_srcset ) {
				add_filter( 'wp_get_attachment_image_attributes', array( self::class, 'remove_image_srcset' ), 10, 3 );
			}
		}

		/**
		 * Cleanup image-related filters.
		 *
		 * @param bool $image_srcset Whether srcset is enabled.
		 */
		private static function cleanup_image_filters( $image_srcset ) {
			if ( ! $image_srcset ) {
				remove_filter( 'wp_get_attachment_image_attributes', array( self::class, 'remove_image_srcset' ), 10, 3 );
			}
		}

		/**
		 * Process posts from the query.
		 *
		 * @param WP_Query $the_query The WordPress query object.
		 * @param array    $config    Configuration array.
		 * @return array Post data array.
		 */
		private static function process_query_posts( $the_query, $config ) {
			$post_data = array();

			if ( ! $the_query->have_posts() ) {
				return $post_data;
			}

			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$single_post_data = self::prepare_single_post_data( $config );
				$post_data[]      = $single_post_data;
			}
			wp_reset_postdata();
			return $post_data;
		}

		/**
		 * Prepare data for a single post.
		 *
		 * @param array $config   Configuration array.
		 * @return array Single post data.
		 */
		private static function prepare_single_post_data( $config ) {
			$post_id        = get_the_ID();
			$image_id       = get_post_thumbnail_id();
			$author_meta_id = get_the_author_meta( 'ID' );
			$current_date   = get_the_date( 'c' );

			$post_data = self::get_basic_post_data( $post_id, $image_id, $author_meta_id, $current_date, $config );

			// Add WooCommerce product data if applicable.
			if ( 'product' === $config['post_type'] && function_exists( 'wc_get_product' ) ) {
				$post_data = array_merge( $post_data, self::get_product_data( $post_id ) );
			}

			return $post_data;
		}

		/**
		 * Get basic post data.
		 *
		 * @param int    $post_id        Post ID.
		 * @param int    $image_id       Image ID.
		 * @param int    $author_meta_id Author ID.
		 * @param string $current_date   Current date.
		 * @param array  $config         Configuration array.
		 * @return array Basic post data.
		 */
		private static function get_basic_post_data( $post_id, $image_id, $author_meta_id, $current_date, $config ) {
			$archive_year  = get_the_time( 'Y' );
			$archive_month = get_the_time( 'm' );
			$archive_day   = get_the_time( 'd' );
			$taxonomy_type = $config['taxonomy_type'] ?? '';

			return array(
				'post_id'             => $post_id,
				'title'               => get_the_title(),
				'link'                => get_the_permalink(),
				'content'             => strip_shortcodes( get_the_content() ),
				'excerpt'             => get_the_excerpt(),
				'post_thumbnail'      => get_the_post_thumbnail(),

				'post_thumbnail_url'  => get_the_post_thumbnail_url( $post_id, $config['image_size'] ?? 'thumbnail' ),
				'image_size'          => $config['image_size'],

				'attachment_srcset'   => wp_get_attachment_image_srcset( $image_id ),
				'attachment_metadata' => wp_get_attachment_metadata( $image_id ),
				'attachment_url'      => wp_get_attachment_url( $image_id ),
				'post_thumbnail_id'   => $image_id,
				'author'              => get_the_author(),
				'author_id'           => $author_meta_id,
				'author_avatar_url'   => get_avatar_url( $author_meta_id ),
				'author_url'          => get_author_posts_url( $author_meta_id ),
				'category_list'       => get_the_category_list( '' ),
				'tag_list'            => get_the_tag_list( '' ),
				'post_list'           => get_post_format( '' ),
				'category'            => get_the_category(),
				'date'                => $current_date,
				'date_archive_url'    => get_day_link( $archive_year, $archive_month, $archive_day ),
				'comment_count'       => get_comment_count( $post_id ),
				'view_count'          => get_post_meta( $post_id, '_post_views_count', true ),
				'like_count'          => get_post_meta( $post_id, '_post_like_count', true ),
				'image_title'         => get_the_title( $image_id ),
				'image_alt'           => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
				'post_date'           => self::format_post_dates( $current_date, $config['date_format'] ),
				'badges_list'         => get_the_terms( $post_id, 'sp_smart_badges' ),
				'all_term_list'       => self::get_all_terms( $post_id, $taxonomy_type ),
			);
		}

		/**
		 * Format post dates in various formats.
		 *
		 * @param string $current_date Current date.
		 * @param string $date_format  Date format.
		 * @return array Formatted dates.
		 */
		private static function format_post_dates( $current_date, $date_format ) {
			return array(
				'default' => date_i18n( $date_format, strtotime( $current_date ) ),
				'day'     => date_i18n( 'j', strtotime( $current_date ) ),
				'month'   => date_i18n( 'F', strtotime( $current_date ) ),
				'year'    => date_i18n( 'Y', strtotime( $current_date ) ),
			);
		}

		/**
		 * Get all terms of a single post.
		 *
		 * @param int    $post_id        Post ID..
		 * @param string $taxonomy_type  Taxonomy Type.
		 * @return string Terms markup.
		 */
		private static function get_all_terms( $post_id, $taxonomy_type ) {
			if ( empty( $taxonomy_type ) ) {
				return '';
			}
			$all_taxonomies = '';
			$terms          = get_the_terms( $post_id, $taxonomy_type );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$all_taxonomies .= '<ul class="post-categories">';
				foreach ( $terms as $term ) {
					if ( empty( $term ) || is_wp_error( get_term_link( $term ) ) ) {
						continue; }
					$all_taxonomies .= '<li><a href="' . esc_url( get_term_link( $term ) ) . '" rel="noreferrer noopener" data-slug="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</a></li>';
				}
				$all_taxonomies .= '</ul>';
			}
			return $all_taxonomies;
		}

		/**
		 * Get WooCommerce product data.
		 *
		 * @param int $post_id Post ID.
		 * @return array Product data.
		 */
		private static function get_product_data( $post_id ) {
			$product = wc_get_product( $post_id );

			if ( ! $product ) {
				return array();
			}

			return array(
				'product_price'  => $product->get_price_html(),
				'add_to_cart'    => do_shortcode( '[add_to_cart id="' . $post_id . '" show_price="false" style="none"]' ),
				'average_rating' => $product->get_average_rating(),
				'review_count'   => $product->get_review_count(),
				'on_sale'        => $product->is_on_sale(),
			);
		}

		/**
		 * Ajax query function - refactored version.
		 *
		 * @return void
		 */
		public function sp_smart_post_block_post_query() {
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp_smart_post_block_nonce' ) ) {
				return;
			}

			$query_data = isset( $_POST['queryData'] ) ? sanitize_text_field( wp_unslash( $_POST['queryData'] ) ) : '';
			$query_data = (array) json_decode( $query_data );

			$config     = self::prepare_ajax_config( $query_data );
			$post_query = \SmartPostShow\Blocks\PostQueryHandler::query( $query_data );

			$the_query = $post_query['the_query'];

			$post_data  = self::process_query_posts( $the_query, $config );
			$post_count = self::calculate_post_count( $config, $post_query );

			wp_send_json(
				array(
					'posts'        => $post_data,
					'posts_status' => count( $post_data ) > 0,
					'post_count'   => $post_count,
				)
			);
		}

		/**
		 * Prepare configuration for AJAX request.
		 *
		 * @param array $query_data Query data.
		 * @return array Configuration array.
		 */
		private static function prepare_ajax_config( $query_data ) {
			$config = array(
				'post_type'                  => $query_data['postType'] ?? 'post',
				'date_format_type'           => $query_data['metaDateFormat'] ?? 'default',
				'image_size'                 => $query_data['imageSize'] ?? '',
				'custom_date_format'         => $query_data['metaDateCustomDateFormat'] ?? '',
				'enable_seo_description'     => $query_data['seoMetaShow'] ?? false,
				'active_seo_plugin'          => $query_data['activeSeoPlugin'] ?? '',
				'exclude_post_without_image' => $query_data['excludePostWithoutImagePosts'] ?? false,
				'taxonomy_type'              => $query_data['catTabCategoryType'] ?? '',
			);

			$config['date_format']        = self::get_date_format( $config['date_format_type'], $config['custom_date_format'] );
			$config['multiple_post_type'] = self::prepare_ajax_multiple_post_types( $config['post_type'], $query_data );

			return $config;
		}

		/**
		 * Prepare multiple post types for AJAX request.
		 *
		 * @param string $current_post_type Current post type.
		 * @param array  $query_data        Query data.
		 * @return array Multiple post types.
		 */
		private static function prepare_ajax_multiple_post_types( $current_post_type, $query_data ) {
			if ( 'multiple_post_type' !== $current_post_type || empty( $query_data['multiplePostType'] ) ) {
				return array( 'post' );
			}

			return array_map(
				function ( $multi_type ) {
					return $multi_type->value;
				},
				$query_data['multiplePostType']
			);
		}

		/**
		 * Calculate total post count.
		 *
		 * @param array $config     Configuration array.
		 * @param array $post_query Post query results.
		 * @return int Post count.
		 */
		private static function calculate_post_count( $config, $post_query ) {
			if ( isset( $post_query['post_count'] ) && $post_query['post_count'] ) {
				return $post_query['post_count'];
			}

			if ( 'multiple_post_type' === $config['post_type'] && ! empty( $config['multiple_post_type'] ) ) {
				$post_count = 0;
				foreach ( $config['multiple_post_type'] as $post_type ) {
					$counts      = wp_count_posts( $post_type );
					$post_count += isset( $counts->publish ) ? (int) $counts->publish : 0;
				}
				return $post_count;
			}

			$counts = wp_count_posts( $config['post_type'] );
			return isset( $counts->publish ) ? (int) $counts->publish : 0;
		}

		/**
		 * Method sp_smart_post_block_all_post_query
		 *
		 * @return void
		 */
		public function sp_smart_post_block_all_post_query() {
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp_smart_post_block_nonce' ) ) {
				return;
			}

			$query_data = isset( $_POST['postQueryData'] ) ? sanitize_text_field( wp_unslash( $_POST['postQueryData'] ) ) : '';

			$query_data = (array) json_decode( $query_data );
			// queries.
			$post_type   = isset( $query_data['postType'] ) ? $query_data['postType'] : 'post';
			$search_text = isset( $query_data['liveSearchText'] ) ? $query_data['liveSearchText'] : '';

			$multiple_post_type = ( 'multiple_post_type' === $post_type && isset( $query_data['multiplePostType'] ) ) ? $query_data['multiplePostType'] : array();
			$multiple_post_type = ( 'multiple_post_type' === $post_type && ! empty( $multiple_post_type ) ) ? array_map(
				function ( $multi_type ) {
					return $multi_type->value;
				},
				$multiple_post_type
			) : array( 'post' );

			$post_query_args                   = \SmartPostShow\Blocks\PostQueryHandler::query( $query_data, 'args' )['args'];
			$post_query_args['fields']         = 'ids';
			$post_query_args['posts_per_page'] = 99999;

			$post_lists = get_posts( $post_query_args );

			$the_search_query = new \WP_Query(
				array(
					'post_type'      => ( 'multiple_post_type' === $post_type && ! empty( $multiple_post_type ) ) ? $multiple_post_type : $post_type,
					'posts_per_page' => 20,
					's'              => $search_text,
					'post__in'       => $post_lists,
				)
			);

			wp_send_json(
				array(
					'posts' => count( $post_lists ) > 0 ? $the_search_query->posts : array(),
				)
			);
		}

		/**
		 * Method sp_smart_post_block_meta_data_query
		 *
		 * @return void
		 */
		public function sp_smart_post_block_meta_data_query() {
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp_smart_post_block_nonce' ) ) {
				return;
			}

			$query_data = isset( $_POST['metaQueryData'] ) ? sanitize_text_field( wp_unslash( $_POST['metaQueryData'] ) ) : '';
			$query_data = (array) json_decode( $query_data );
			// query data.
			$post_type = isset( $query_data['postType'] ) ? $query_data['postType'] : 'post';

			$ajax_live_filter = isset( $query_data['ajaxLiveFilter'] ) ? (array) $query_data['ajaxLiveFilter'] : array();

			$current_page = isset( $query_data['currentPage'] ) ? $query_data['currentPage'] : 1;

			$edit_site = isset( $query_data['editSite'] ) ? $query_data['editSite'] : '';

			$block_name = isset( $query_data['blockName'] ) ? $query_data['blockName'] : 'post-carousel';

			$keyword_search = isset( $query_data['keywordSearch'] ) ? $query_data['keywordSearch'] : '';

			$taxonomies_live_filter = isset( $query_data['taxonomiesLiveFilter'] ) ? $query_data['taxonomiesLiveFilter'] : array();
			$author_live_filter     = isset( $query_data['authorLiveFilter'] ) ? $query_data['authorLiveFilter'] : array();

			$multiple_post_type = ( 'multiple_post_type' === $post_type && isset( $query_data['multiplePostType'] ) ) ? $query_data
			['multiplePostType'] : array();

			$multiple_post_type = ( 'multiple_post_type' === $post_type && ! empty( $multiple_post_type ) ) ? array_map(
				function ( $multi_type ) {
					return $multi_type->value;
				},
				$multiple_post_type
			) : array( 'post' );

			$multiple_post_type = ( 'multiple_post_type' === $post_type && ! empty( $multiple_post_type ) ) ? $multiple_post_type : $post_type;

			if ( ! empty( $taxonomies_live_filter ) || ! empty( $author_live_filter ) ) {
				$post_query_args = self::query( $query_data, 'args' );

				$post_limit = $post_query_args['post_limit'];
				$post_in    = $post_query_args['include_posts'];

				$post_query_args                   = $post_query_args['args'];
				$post_query_args['posts_per_page'] = $post_limit;
				$post_query_args['fields']         = 'ids';

				if ( ! empty( $keyword_search ) ) {
					$post_query_args['s'] = $keyword_search;
				}

				$post_query_args['offset'] = 0;

				$term_query_args   = $post_query_args;
				$author_query_args = $post_query_args;
				$post_lists        = get_posts( $post_query_args );
				$all_post_ids      = $post_in ? $post_in : $post_lists;

				$ajax_live_filter_keys = array();

				foreach ( $ajax_live_filter as $key => $value ) {
					switch ( $value->type ) {
						case 'taxonomy':
							if ( 'all' !== $value->id ) {
								$ajax_live_filter_keys[] = $value->taxonomy_type;
							}
							break;
						case 'author':
							if ( 'all' !== $value->id ) {
								$ajax_live_filter_keys[] = $key;
							}
							break;
					}
				}
			}

			// taxonomy.
			$all_taxonomies = get_object_taxonomies( $multiple_post_type, 'objects' );
			$taxonomy_list  = array();

			foreach ( $all_taxonomies as $taxonomy ) {
				$terms = get_terms(
					array(
						'taxonomy'   => $taxonomy->name,
						'hide_empty' => false,
					)
				);

				// Prepare the list of terms for this taxonomy.
				$term_ajax_filter = array();
				$term_items       = array();
				$index            = 0;

				foreach ( $terms as $term ) {

					$get_term_posts_ids = array(
						array(
							'taxonomy' => $term->taxonomy,
							'field'    => 'term_id',
							'terms'    => array( $term->term_id ),
						),
					);

					if ( ! empty( $taxonomies_live_filter ) ) {
						$term_query_args['tax_query'] = $get_term_posts_ids;

						$term_query_args['posts_per_page'] = 9999;

						$term_ids = get_posts( $term_query_args );

						$term_ids = array_intersect( $all_post_ids, $term_ids );

						if ( ( ! empty( $ajax_live_filter_keys ) && $ajax_live_filter_keys[0] !== $term->taxonomy ) || count( $ajax_live_filter_keys ) > 1 ) {
							$term_ids = array_intersect( $post_lists, $term_ids );
						}

						$child_terms = get_term_children( $term->term_id, $taxonomy->name );

						$total_post_count = count( $term_ids );

						if ( is_wp_error( $child_terms ) && count( $child_terms ) > 0 ) {
							foreach ( $child_terms as $child_term_id ) {
								$child_term        = get_term( $child_term_id, $taxonomy->name );
								$total_post_count += $child_term->count;
							}
						}
					}

					$term_args = array(
						'id'            => $index,
						'label'         => $term->name,
						'slug'          => $term->slug,
						'value'         => $term->term_id,
						'type'          => 'taxonomy',
						'taxonomy_type' => $term->taxonomy,
					);

					$term_items[] = $term_args;

					if ( ! empty( $taxonomies_live_filter ) && $total_post_count ) {
						$term_args['post_count'] = $total_post_count;
						$term_ajax_filter[]      = $term_args;
					}
					++$index;
				}

				$taxonomy_list[] = array(
					'label'       => $taxonomy->label,
					'name'        => $taxonomy->name,
					'terms'       => $term_ajax_filter,
					'terms_items' => $term_items,
				);
			}

			// authors details.
			$authors = get_users( array( 'role__in' => array( 'author', 'administrator', 'editor' ) ) );

			$filtered_authors = array();
			$author_list      = array();
			$author_post_ids  = array();

			foreach ( $authors as $author ) {

				if ( ! empty( $author_live_filter ) && ! empty( $author_query_args ) ) {
					unset( $author_query_args['author__not_in'] );
					$author_query_args['author__in'] = array( $author->ID );
					$author_query_args['fields']     = 'ids';
					$author_post_ids                 = get_posts( $author_query_args );
					$author_post_ids                 = array_intersect( $all_post_ids, $author_post_ids );
				}

				$author_args = array(
					'id'    => $author->ID,
					'role'  => $author->roles,
					'type'  => 'author',
					'value' => $author->ID,
					'label' => $author->display_name,
				);

				$author_list[] = $author_args;

				if ( ! empty( $author_live_filter ) && count( $author_post_ids ) > 0 ) {
					$author_args['post_count'] = count( $author_post_ids );
					$filtered_authors[]        = $author_args;
				}
			}

			// all post type list.
			$all_post_type_list = get_post_types(
				array(
					'public' => true,
				)
			);

			// query all meta fields.
			$meta_field_list = array();
			if ( 'editSite' === $edit_site ) {
				global $wpdb;
				$keys = $wpdb->get_col(
					"SELECT meta_key
				FROM $wpdb->postmeta
				GROUP BY meta_key
				ORDER BY meta_key"
				);
				if ( $keys ) {
					natcasesort( $keys );
				}
				// Remove empty custom field.
				$keys = array_filter( $keys );
				foreach ( $keys as $key ) {
					/**
					 * Don't hide protected meta fields, to able to select data of The Events Calendar...
					 *
					 * @since 2.0.0
					 * if ( is_protected_meta( $key, 'post' ) ) {
					 * continue;
					 * }
					 */
					$meta_field_list[ esc_attr( $key ) ] = esc_html( $key );
				}
			}

			$post_count = 0;
			if ( 'multiple_post_type' === $post_type && ! is_string( $multiple_post_type ) ) {
				foreach ( $multiple_post_type as $value ) {
					$post_count += isset( wp_count_posts( $value )->publish ) ? (int) wp_count_posts( $value )->publish : 0;
				}
			} else {
				$post_count = isset( wp_count_posts( $post_type )->publish ) ? (int) wp_count_posts( $post_type )->publish : 0;
			}

			wp_send_json(
				array(
					'taxonomies'          => $taxonomy_list,
					'authors'             => $filtered_authors,
					'author_list'         => $author_list,
					'post_count'          => $post_count,
					'image_sizes'         => get_intermediate_image_sizes(),
					'all_post_type_list'  => $all_post_type_list,
					'all_meta_field_list' => $meta_field_list,
				)
			);
		}

		/**
		 * Remove srcset attribute from image attributes.
		 *
		 * @param array   $attr       Image attributes.
		 * @param WP_Post $attachment Attachment post object.
		 * @param string  $size       Image size.
		 * @return array Modified image attributes.
		 */
		public static function remove_image_srcset( $attr, $attachment, $size ) {
			unset( $attr['srcset'] );
			return $attr;
		}
	}
}
