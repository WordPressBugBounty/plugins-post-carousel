<?php
/**
 * The file that defines the query filter class.
 *
 * A class definition that includes attributes and functions used to filter posts.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks
 */

namespace SmartPostShow\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to handle WordPress post queries with advanced filtering.
 */
class PostQueryHandler {

	/**
	 * Get current date components for filtering.
	 *
	 * @return array Current date components (day, month, year, week).
	 */
	private static function get_current_date_components(): array {
		$now = new \DateTime( 'now' );
		return array(
			'day'   => $now->format( 'j' ),
			'month' => $now->format( 'n' ),
			'year'  => $now->format( 'Y' ),
			'week'  => $now->format( 'W' ),
		);
	}

	/**
	 * Parse a date string into components.
	 *
	 * @param string $date Date string.
	 * @return array Parsed date components (year, month, day).
	 */
	private static function parse_date( string $date ): array {
		return date_parse( gmdate( 'Y-m-d', strtotime( $date ) ) );
	}

	/**
	 * Build date query for specific date filters.
	 *
	 * @param string $filter_type Type of date filter.
	 * @param array  $params Additional parameters for specific filters.
	 * @return array Date query array.
	 */
	private static function build_date_query( string $filter_type, array $params ): array {
		$current = self::get_current_date_components();
		$query   = array();
		switch ( $filter_type ) {
			case 'yesterday':
				$yesterday = self::parse_date( 'yesterday' );
				$query     = array(
					'year'  => $yesterday['year'],
					'month' => $yesterday['month'],
					'day'   => $yesterday['day'],
				);
				break;
			case 'today_only':
				$query = array(
					'year'  => $current['year'],
					'month' => $current['month'],
					'day'   => $current['day'],
				);
				break;
			case 'today_onwards':
				$query = array( 'after' => gmdate( 'Y-m-d', strtotime( 'yesterday' ) ) );
				break;
			case 'this_week':
				$query = array(
					'year' => $current['year'],
					'week' => $current['week'],
				);
				break;
			case 'this_month':
				$query = array(
					'year'  => $current['year'],
					'month' => $current['month'],
				);
				break;
			case 'this_year':
				$query = array( 'year' => $current['year'] );
				break;
			case 'week_ago':
			case 'month_ago':
			case 'year_ago':
				$query = array(
					'column' => 'post_date',
					'after'  => sprintf( '1 %s ago', str_replace( '_ago', '', $filter_type ) ),
				);
				break;
			case 'specific_date_before':
				$date  = self::parse_date( $params['specific_date_before'] ?? '' );
				$query = array(
					'before'    => array(
						'year'  => $date['year'],
						'month' => $date['month'],
						'day'   => $date['day'],
					),
					'inclusive' => true,
				);
				break;
			case 'specific_date_after':
				$date  = self::parse_date( $params['specific_date_after'] ?? '' );
				$query = array(
					'after'     => array(
						'year'  => $date['year'],
						'month' => $date['month'],
						'day'   => $date['day'],
					),
					'inclusive' => true,
				);
				break;

			case 'specific_date':
				$date  = self::parse_date( $params['specific_date'] ?? '' );
				$query = array(
					'year'  => $date['year'],
					'month' => $date['month'],
					'day'   => $date['day'],
				);
				break;
			case 'past_quarter':
				$query = array(
					'after'     => '3 months ago',
					'inclusive' => false,
				);
				break;
			case 'specific_month':
				$query = array( 'month' => $params['specific_month'] ?? 1 );
				break;
			case 'specific_year':
				$query = array( 'year' => $params['specific_year'] ?? 2024 );
				break;

			case 'specific_period':
				$after  = self::parse_date( $params['specific_period_after'] ?? '' );
				$before = self::parse_date( $params['specific_period_before'] ?? '' );
				if ( $after && $before ) {
					$query = array(
						'after'     => array(
							'year'  => $after['year'],
							'month' => $after['month'],
							'day'   => $after['day'],
						),
						'before'    => array(
							'year'  => $before['year'],
							'month' => $before['month'],
							'day'   => $before['day'],
						),
						'inclusive' => true,
					);
				}
				break;
		}

		return $query;
	}

	/**
	 * Build exclude date query.
	 *
	 * @param string $exclude_date_before Date to exclude before.
	 * @param string $exclude_date_after Date to exclude after.
	 * @return array Exclude date query array.
	 */
	private static function build_exclude_date_query( string $exclude_date_before, string $exclude_date_after ): array {
		$query  = array();
		$after  = self::parse_date( $exclude_date_after );
		$before = self::parse_date( $exclude_date_before );

		if ( $after && $before ) {
			$query = array(
				'after'     => array(
					'year'  => $after['year'],
					'month' => $after['month'],
					'day'   => $after['day'],
				),
				'before'    => array(
					'year'  => $before['year'],
					'month' => $before['month'],
					'day'   => $before['day'],
				),
				'inclusive' => true,
			);
		}

		return $query;
	}

	/**
	 * Date filter query.
	 *
	 * @param string $filter_by_taxonomy_date Taxonomy date filter.
	 * @param string $specific_date Specific date.
	 * @param string $specific_month Specific month.
	 * @param string $specific_year Specific year.
	 * @param string $specific_period_after Specific period after.
	 * @param string $specific_period_before Specific period before.
	 * @param string $specific_date_before Specific date before.
	 * @param string $specific_date_after Specific date after.
	 * @param string $exclude_date_before Exclude date before.
	 * @param string $exclude_date_after Exclude date after.
	 * @return array Date query array.
	 */
	public static function date_filter_query(
		string $filter_by_taxonomy_date,
		string $specific_date,
		string $specific_month,
		string $specific_year,
		string $specific_period_after,
		string $specific_period_before,
		string $specific_date_before,
		string $specific_date_after,
		string $exclude_date_before,
		string $exclude_date_after
	): array {
		if ( empty( $filter_by_taxonomy_date ) ) {
			return array();
		}

		$params = compact(
			'specific_date',
			'specific_month',
			'specific_year',
			'specific_period_after',
			'specific_period_before',
			'specific_date_before',
			'specific_date_after'
		);

		$default_query = self::build_date_query( $filter_by_taxonomy_date, $params );
		$exclude_query = 'exclude_specific_date' === $filter_by_taxonomy_date
			? self::build_exclude_date_query( $exclude_date_before, $exclude_date_after )
			: array();

		return array(
			'default_query' => $default_query ? array( $default_query ) : array(),
			'exclude_query' => $exclude_query ? array( $exclude_query ) : array(),
		);
	}
	/**
	 * Calculate posts per page and offset, considering pagination and advertisements.
	 *
	 * This method determines how many posts should be displayed on the current page
	 * and calculates the correct offset for the query. It accounts for:
	 * - Pagination
	 * - Advertisements inserted between posts (which reduce available post slots)
	 * - Special slider blocks where pagination is usually disabled
	 *
	 * @param array  $query_data     Query data, usually passed from the block's frontend request.
	 * @param string $block_name     The name of the block (e.g., 'post-carousel').
	 * @param int    $all_post_limit The total number of posts available in the query.
	 * @return array {
	 *     @type int $post_per_page Number of posts to show on the current page.
	 *     @type int $offset        Number of posts to skip before fetching.
	 * }
	 */
	private static function calculate_posts_per_page( array $query_data, string $block_name, int $all_post_limit ): array {
		// The total post limit allowed for the query.
		$post_limit = (int) ( $query_data['postLimit'] ?? 20 );

		// Current page number for pagination (defaults to page 1).
		$current_page = (int) ( $query_data['currentPage'] ?? 1 );

		// Any manual offset to start from (defaults to 0).
		$offset = (int) ( $query_data['offset'] ?? 0 );

		// Whether advertisements are displayed between posts.
		$display_advertisement = $query_data['displayAdvertisement'] ?? false;

		// The post position where the first advertisement appears.
		$ads_number = (int) ( $query_data['adsNumber'] ?? 0 );

		// How many advertisements to insert.
		$ads_count = (int) ( $query_data['adsCount'] ?? 0 );

		// Whether pagination is enabled for this block.
		$pagination_enable = $query_data['paginationEnable'] ?? true;

		// Block names that are sliders (usually show all posts without pagination).
		$slider_block_names = array(
			'post-carousel',
			'post-slider',
			'post-slider-two',
			'thumbnail-slider',
			'thumbnail-slider-two',
			'post-timeline-three',
		);

		// By default, set posts per page equal to the post limit.
		// For sliders, pagination is ignored, so they also use $post_limit.
		$post_per_page = $post_limit;

		// Advertisement adjustment logic.
		if ( $display_advertisement ) {
			// Check if current page contains the ad position.
			if (
			$post_per_page * $current_page >= $ads_number &&
			$ads_number > $post_per_page * ( $current_page - 1 )
			) {
				// Reduce available post slots if ads are inserted into the current page.
				$post_per_page = $post_per_page > $ads_count ? $post_per_page - $ads_count : $post_per_page;

				// Adjust offset if ads exactly match available slots.
				if ( $ads_count === $post_per_page ) {
					$offset -= $ads_count;
				}
			} elseif ( $post_per_page * $current_page > $ads_number ) {
				$offset -= $ads_count;
			}
		}

		// Calculate total pages based on all posts and posts per page.
		$total_pages = (int) ceil( $all_post_limit / max( 1, (int) $post_per_page ) );

		// Calculate final offset for the query.
		$offset = ( ( $current_page - 1 ) * $post_per_page ) + $offset;

		return array(
			'post_per_page' => $post_per_page,
			'offset'        => $offset,
		);
	}


	/**
	 * Build taxonomy query.
	 *
	 * @param array  $taxonomies Taxonomy data.
	 * @param string $relation Relation type.
	 * @param string $tax_field_type Taxonomy field type.
	 * @return array Taxonomy query array.
	 */
	private static function build_taxonomy_query( array $taxonomies, string $relation, $tax_field_type = 'term_id' ): array {
		$tax_query = array();
		foreach ( $taxonomies as $taxonomy ) {
			$type     = is_array( $taxonomy ) ? ( $taxonomy['type'] ?? '' ) : ( $taxonomy->type ?? '' );
			$value    = is_array( $taxonomy ) ? ( $taxonomy['value'] ?? '' ) : ( $taxonomy->value ?? '' );
			$operator = is_array( $taxonomy ) ? ( $taxonomy['operator'] ?? 'IN' ) : ( $taxonomy->operator ?? 'IN' );
			if ( ! empty( $type ) && ! empty( $value ) ) {
				$tax_query[] = array(
					'taxonomy' => $type,
					'terms'    => $value,
					'operator' => $operator,
					'field'    => $tax_field_type,
				);
			}
		}
		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = strtolower( $relation );
		}
		return $tax_query;
	}

	/**
	 * Build meta query for custom fields.
	 *
	 * @param array  $custom_fields Custom field data.
	 * @param string $relation Relation type.
	 * @return array Meta query array.
	 */
	private static function build_meta_query( array $custom_fields, string $relation ): array {
		$meta_query = array();
		foreach ( $custom_fields as $field ) {
			$key      = is_array( $field ) ? ( $field['key'] ?? '' ) : ( $field->key ?? '' );
			$value    = is_array( $field ) ? ( $field['value'] ?? '' ) : ( $field->value ?? '' );
			$operator = is_array( $field ) ? ( $field['operator'] ?? '' ) : ( $field->operator ?? '' );
			$type     = is_array( $field ) ? ( $field['type'] ?? 'CHAR' ) : ( $field->type ?? 'CHAR' );
			if ( ! empty( $key ) && ! empty( $value ) && ! empty( $operator ) ) {
				$meta_query[] = array(
					'key'     => $key,
					'value'   => $value,
					'compare' => $operator,
					'type'    => $type,
				);
			}
		}

		return $meta_query;
	}

	/**
	 * Build product-specific query.
	 *
	 * @param string $post_type Post type.
	 * @param string $filter_product Product filter type.
	 * @return array Product query arguments.
	 */
	private static function build_product_query( string $post_type, string $filter_product ) {
		$query = array();
		if ( 'product' !== $post_type || 'none' === $filter_product ) {
			return $query;
		}
		switch ( $filter_product ) {
			case 'recent':
				$query = array(
					'orderby' => 'date',
					'order'   => 'DESC',
				);
				break;
			case 'featured':
				$query['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				);
				break;
			case 'on_sale':
				$query['meta_query'][] = array(
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'numeric',
				);
				break;
			case 'best_selling':
				$query['meta_query'][] = array(
					'key'     => 'total_sales',
					'value'   => 0,
					'compare' => '>',
				);
				$query['orderby']      = 'meta_value_num';
				break;
			case 'top_rated':
				$query['meta_query'][] = array(
					'key'     => '_wc_average_rating',
					'value'   => 0,
					'compare' => '>',
				);
				break;
			case 'out_of_stock':
				$query['meta_query'][] = array(
					'key'   => '_stock_status',
					'value' => 'outofstock',
				);
				break;
		}
		return $query;
	}

	/**
	 * Build AJAX live filter query.
	 *
	 * @param array  $ajax_live_filter AJAX live filter data.
	 * @param string $relation Relation type.
	 * @return array AJAX filter query arguments.
	 */
	private static function build_ajax_filter_query( array $ajax_live_filter, string $relation ): array {
		$query = array( 'tax_query' => array() );
		foreach ( $ajax_live_filter as $filter ) {
			$type          = is_array( $filter ) ? ( $filter['type'] ?? '' ) : ( $filter->type ?? '' );
			$id            = is_array( $filter ) ? ( $filter['id'] ?? '' ) : ( $filter->id ?? '' );
			$taxonomy_type = is_array( $filter ) ? ( $filter['taxonomy_type'] ?? '' ) : ( $filter->taxonomy_type ?? '' );
			switch ( $type ) {
				case 'taxonomy':
					if ( 'all' !== $id ) {
						$query['tax_query'][] = array(
							'taxonomy' => $taxonomy_type,
							'field'    => 'term_id',
							'terms'    => array( $id ),
						);
					}
					break;
				case 'author':
					if ( 'all' !== $id ) {
						$query['author__in'] = $id;
					}
					break;
				case 'order_by':
					if ( 'all' !== $id ) {
						$query['orderby'] = $id;
					}
					break;
				case 'order':
					if ( 'all' !== $id ) {
						$query['order'] = $id;
					}
					break;
			}
		}
		if ( $query['tax_query'] ) {
			$query['tax_query']['relation'] = strtolower( $relation );
		} else {
			unset( $query['tax_query'] );
		}
		return $query;
	}
	/**
	 * Get URL search parameters prefixed with '_'.
	 *
	 * @return array Associative array of URL search parameters.
	 */
	private static function get_url_search_params() {
		$params   = array();
		$prefixes = array( 'sps_', 'tx_' );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		foreach ( $_GET as $key => $val ) {
			if ( ! is_scalar( $val ) ) {
				continue;
			}
			// Check if key starts with either 'sps_' or 'tx_'.
			if ( 0 === strpos( $key, 'sps_' ) || 0 === strpos( $key, 'tx_' ) ) {
				$key = sanitize_key( $key );
			} else {
				continue;
			}
			$clean_key = $key;
			$clean_val = wp_unslash( sanitize_text_field( $val ) );
			if ( ! empty( $clean_key ) && ! empty( $clean_val ) ) {
				$params[ $clean_key ] = $clean_val;
			}
		}

		return $params;
	}

	/**
	 * Post query function.
	 *
	 * @param array       $query_data Query data.
	 * @param string|null $type Query type.
	 * @param string|null $block_id Block id.
	 * @return array Query results or arguments.
	 */
	public static function query( $query_data, $type = null, $block_id = '' ) {
		$ajax_live_filter = $query_data['ajaxLiveFilter'] ?? false;
		$url_params       = array();
		$live_sort        = false;
		$tax_field_type   = 'term_id';
		$relation         = $query_data['relation'] ?? 'and';
		if ( ! $ajax_live_filter ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$block = isset( $_GET['block'] ) ? sanitize_text_field( wp_unslash( $_GET['block'] ) ) : '';
			if ( $block === $block_id ) {
				$taxonomies    = array();
				$author_filter = array();
				$url_params    = self::get_url_search_params();

				foreach ( $url_params as $key => $value ) {
					if ( 0 === strpos( $key, 'tx_' ) ) {
						$tax_type         = str_replace( 'tx_', '', $key );
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
						$tax_field_type = 'slug';
					}
					if ( 'sps_author' === $key ) {
						if ( ! empty( $value ) ) {
							$author_filter[] = array(
								'id'    => time() + wp_rand( 1, 999 ),
								'type'  => 'author',
								'value' => $value,
							);
						}
					}
				}
				if ( ! empty( $url_params['sps_search'] ) ) {
					$query_data['keywordSearch'] = sanitize_text_field( $url_params['sps_search'] );
				}

				if ( ! empty( $url_params['sps_page'] ) ) {
					$query_data['currentPage'] = absint( $url_params['sps_page'] );
				}

				if ( ! empty( $taxonomies ) ) {
					$query_data['taxonomies'] = $taxonomies;
				}
				if ( ! empty( $author_filter ) ) {
					$query_data['filterByAuthor'] = $author_filter;
				}
				if ( ! empty( $url_params['sps_sort'] ) ) {
					$sps_sort = $url_params['sps_sort'];
					// Match format like: title_asc or date_des.
					if ( preg_match( '/^([a-zA-Z0-9_]+)_(asc|des)$/i', $sps_sort, $matches ) ) {
						$query_data['fl_orderBy']        = sanitize_key( $matches[1] );
						$query_data['fl_orderDirection'] = 'ASC' === strtoupper( $matches[2] ) ? 'ASC' : 'DESC';
						// Match values like: ASC or DESC directly.
					} elseif ( in_array( strtoupper( $sps_sort ), array( 'ASC', 'DESC' ), true ) ) {
						$query_data['fl_orderDirection'] = strtoupper( $sps_sort );
					} else {
						$query_data['fl_orderBy'] = sanitize_key( $sps_sort );
					}
					$live_sort = true;
				}
				if ( isset( $query_data['multipleFilterRelation'] ) && ! empty( $query_data['multipleFilterRelation'] ) ) {
					$relation = $query_data['multipleFilterRelation'] ?? 'and';
				}
			}
		}
		// Default query parameters.
		$post_type       = $query_data['postType'] ?? 'post';
		$current_post_id = $query_data['postId'] ?? false;
		$block_name      = $query_data['blockName'] ?? 'post-carousel';
		// $post_limit         = (int) ( $query_data['postLimit'] ?? 20 );
		$post_limit      = (int) ( ! empty( $query_data['postLimit'] ) ? $query_data['postLimit'] : 8 );
		$order_by        = $query_data['orderBy'] ?? 'date';
		$show_pagination = $query_data['paginationEnable'] ?? false;
		$order_direction = $query_data['orderDirection'] ?? 'DESC';

		$is_multiple = ( 'multiple_post_type' === $post_type && ! empty( $query_data['multiplePostType'] ) );

		$multiple_post_type = $is_multiple
		? array_map(
			function ( $type ) {
				return is_array( $type ) ? $type['value']
				: ( is_object( $type ) ? $type->value : $type );
			},
			$query_data['multiplePostType']
		)
		: array( $post_type );

		// Calculate total post limit.
		$all_post_limit = 0;
		foreach ( $multiple_post_type as $value ) {
			$all_post_limit += (int) ( wp_count_posts( $value )->publish ?? 0 );
		}

		// Calculate posts per page and offset.
		$pagination    = self::calculate_posts_per_page( $query_data, $block_name, $all_post_limit );
		$post_per_page = $pagination['post_per_page'];
		$offset        = $pagination['offset'];

		// Base query arguments.
		$args = array(
			'post_type'           => $multiple_post_type,
			'posts_per_page'      => $post_per_page,
			'offset'              => $offset,
			'orderby'             => $order_by,
			'order'               => $order_direction,
			'post_status'         => in_array( 'attachment', $multiple_post_type, true ) ? array( 'publish', 'inherit' ) : 'publish',
			'ignore_sticky_posts' => true,
		);
		if ( ! empty( $query_data['s'] ) ) {
			$args['s'] = $query_data['s'];
		}
		// Date filter.
		$date_query = self::date_filter_query(
			$query_data['filterByDate'] ?? '',
			$query_data['specificDate'] ?? '',
			$query_data['specificMonth'] ?? '1',
			$query_data['specificYear'] ?? '2024',
			$query_data['specificPeriodAfter'] ?? '',
			$query_data['specificPeriodBefore'] ?? '',
			$query_data['specificDateBefore'] ?? '',
			$query_data['specificDateAfter'] ?? '',
			$query_data['excludeDateBefore'] ?? '',
			$query_data['excludeDateAfter'] ?? ''
		);
		if ( ! empty( $date_query['default_query'] ) ) {
			$args['date_query'] = $date_query['default_query'];
		}

		// Exclude settings.
		if ( $query_data['excludeProtectedPosts'] ?? false ) {
			$args['has_password'] = false;
		}
		if ( $query_data['excludeChildrenPosts'] ?? false ) {
			$args['post_parent__in'] = array( 0 );
		}

		// Popular posts.
		$popular_post = $query_data['quickQuery'] ?? '';
		if ( $popular_post ) {
			if ( 'popular_posts' === $popular_post ) {
				$args['meta_key'] = '_post_views_count';
				$args['orderby']  = 'meta_value_num';
			} else {
				$args = array_merge(
					$args,
					array(
						'meta_key'   => '_post_views_count',
						'orderby'    => 'meta_value_num',
						'date_query' => array(
							array(
								'after'     => $popular_post . ' ago',
								'inclusive' => false,
							),
						),
					)
				);
			}
		}

		// Taxonomy filter.
		$taxonomies     = $query_data['taxonomies'] ?? array();
		$tax_field_type = ! empty( $query_data['tax_type'] ) ? $query_data['tax_type'] : $tax_field_type;
		$tax_query      = self::build_taxonomy_query( $taxonomies, $relation, $tax_field_type );
		if ( ! empty( $tax_query ) ) {
			$args['tax_query'] = $tax_query;
		}

		// Custom fields filter.
		$custom_fields         = $query_data['filterByCustomFields'] ?? array();
		$custom_field_relation = $query_data['customFieldRelation'] ?? 'and';
		$meta_query            = self::build_meta_query( $custom_fields, $custom_field_relation );
		// Exclude posts without images.
		if ( $query_data['excludePostWithoutImagePosts'] ?? false ) {
			$meta_query = array_merge(
				$meta_query,
				array(
					array(
						'key'     => '_thumbnail_id',
						'compare' => 'EXISTS',
					),
				)
			);
		}
		if ( $meta_query ) {
			if ( count( $meta_query ) > 1 ) {
				$meta_query['relation'] = strtolower( $custom_field_relation );
			}
			$args['meta_query'] = $meta_query;
		}

		// Author filter.
		$author_id = $query_data['filterByAuthor'] ?? array();
		if ( ! empty( $author_id ) ) {
			$args['author__in'] = array_map(
				function ( $author ) {
					return is_array( $author ) ? $author['value'] : $author->value;
				},
				$author_id
			);
		}

		// Include specific posts.
		if ( ! empty( $query_data['includeOnlyPost'] ?? array() ) ) {
			$args['orderby']  = 'post__in';
			$args['post__in'] = $query_data['includeOnlyPost'];
		}

		// Exclude posts.
		$exclude_posts = array();
		if ( ! empty( $query_data['excludePost'] ?? array() ) ) {
			$exclude_posts = array_merge( $exclude_posts, $query_data['excludePost'] );
		}
		if ( $query_data['excludeStickyPosts'] ?? false ) {
			$exclude_posts = array_merge( $exclude_posts, get_option( 'sticky_posts', array() ) );
		}
		if ( $query_data['excludeCurrentPosts'] ?? true && $current_post_id ) {
			$exclude_posts[] = $current_post_id;
		}
		// TODO:: need to improve Exclude date query.
		if ( ! empty( $date_query['exclude_query'] ) ) {
			$temp_args     = array_merge(
				$args,
				array(
					'date_query'     => $date_query['exclude_query'],
					'fields'         => 'ids',
					'posts_per_page' => 9999,
				)
			);
			$exclude_posts = array_merge( $exclude_posts, get_posts( $temp_args ) );
		}
		if ( $exclude_posts ) {
			$args['post__not_in'] = $exclude_posts;
		}
		// Exclude terms.
		$exclude_term = $query_data['excludeTerm'] ?? array();
		$exclude_cat  = array();
		$exclude_tag  = array();
		foreach ( $exclude_term as $term ) {
			$taxonomy_type = is_array( $term ) ? ( $term['taxonomy_type'] ?? '' ) : ( $term->taxonomy_type ?? '' );
			$value         = is_array( $term ) ? ( $term['value'] ?? '' ) : ( $term->value ?? '' );
			if ( 'category' === $taxonomy_type ) {
				$exclude_cat[] = $value;
			} elseif ( 'post_tag' === $taxonomy_type ) {
				$exclude_tag[] = $value;
			}
		}
		if ( $exclude_cat ) {
			$args['category__not_in'] = $exclude_cat;
		}
		if ( $exclude_tag ) {
			$args['tag__not_in'] = $exclude_tag;
		}

		// Keyword search.
		if ( ! empty( $query_data['filterByKeyword'] ?? '' ) ) {
			$args['s'] = $query_data['filterByKeyword'];
		}
		if ( ! empty( $query_data['keywordSearch'] ) ) {
			$args['s'] = $query_data['keywordSearch'];
		}

		// Exclude authors.
		if ( ! empty( $query_data['excludeAuthor'] ?? array() ) ) {
			$args['author__not_in'] = $query_data['excludeAuthor'];
		}

		// Product filter.
		$filter_product = $query_data['filterProduct'] ?? 'recent';
		$args           = array_merge( $args, self::build_product_query( $post_type, $filter_product ) );

		// AJAX live filter.
		$ajax_live_filter = $query_data['ajaxLiveFilter'] ?? false;

		// Post count for AJAX.
		if ( $ajax_live_filter ) {
			if ( isset( $query_data['ajax_order'] ) ) {
				if ( 'most_view' == $query_data['fl_orderBy'] ) {
					$args['meta_key'] = '_post_views_count';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $query_data['fl_orderDirection'] ?? $order_direction;
				} elseif ( 'most_like' == $query_data['fl_orderBy'] ) {
					$args['meta_key'] = '_post_like_count';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $query_data['fl_orderDirection'] ?? $order_direction;
				} else {
					$args = array_merge(
						$args,
						array(
							'orderby' => $query_data['fl_orderBy'] ?? $order_by,
							'order'   => $query_data['fl_orderDirection'] ?? $order_direction,
						)
					);
				}
			}
		}
		if ( $live_sort ) {
			if ( 'most_view' == $query_data['fl_orderBy'] ) {
					$args['meta_key'] = '_post_views_count';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $query_data['fl_orderDirection'] ?? $order_direction;
			} elseif ( 'most_like' == $query_data['fl_orderBy'] ) {
					$args['meta_key'] = '_post_like_count';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = $query_data['fl_orderDirection'] ?? $order_direction;
			} else {
				$args = array_merge(
					$args,
					array(
						'orderby' => $query_data['fl_orderBy'] ?? $order_by,
						'order'   => $query_data['fl_orderDirection'] ?? $order_direction,
					)
				);
			}
		}

		$modify_args = array(
			'posts_per_page' => 9999,
			'fields'         => 'ids',
		);

		$get_all_post_ids_args = wp_parse_args( $modify_args, $args );
		$all_post_ids          = get_posts( $get_all_post_ids_args );
		$post_count            = count( $all_post_ids );

		$total_pages = 1;
		if ( $post_count ) {
			$post_limit  = min( $post_count, $post_limit );
			$total_pages = (int) ceil( $post_count / $post_limit ?? 8 );
		}

		$total_pages = max( $total_pages, 1 );

		if ( 'args' === $type ) {
			return array(
				'args'          => $args,
				'include_posts' => $args['post__in'] ?? array(),
				'post_limit'    => $post_limit,
				'total_pages'   => $total_pages,
				'post_ids'      => $all_post_ids,
			);
		}
		$wp_query_data = new \WP_Query( $args );

		$result = array(
			'the_query'   => $wp_query_data,
			'post_count'  => $post_count,
			'total_pages' => is_object( $wp_query_data ) && ! empty( $wp_query_data ) ? $total_pages : 1,
			'post_ids'    => $all_post_ids,
		);
		return $result;
	}
}
