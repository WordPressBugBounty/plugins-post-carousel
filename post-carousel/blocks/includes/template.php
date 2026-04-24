<?php
/**
 * Table of Contents block for Smart Post Show.
 *
 * @package    Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Post Content render Class.
 */
class Template {



	/**
	 * Renders the post carousel template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_carousel( $attributes, $post_query, $pagination_type = '' ) {
		$carousel_style = $attributes['carouselStyle'] ?? '';

		ob_start();
		foreach ( $post_query as $data ) {
			if ( 'ticker' == $carousel_style ) {
				?>
				<div class="sp_marquee-item sp-slide-item">
					<?php self::template_one( $attributes, $data ); ?>
				</div>
				<?php
			} else {
				?>
				<div class="swiper-slide sp-slide-item">
					<?php self::template_one( $attributes, $data ); ?>
				</div>
				<?php
			}
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}



	/**
	 * Renders the carousel two template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_carousel_two( $attributes, $post_query, $pagination_type = '' ) {
			$carousel_style = $attributes['carouselStyle'] ?? '';

		ob_start();
		foreach ( $post_query as $data ) {
			if ( 'ticker' == $carousel_style ) {
				?>
				<div class="sp_marquee-item sp-slide-item">
					<?php self::template_one( $attributes, $data ); ?>
				</div>
				<?php
			} else {
				?>
				<div class="swiper-slide sp-slide-item">
					<?php self::template_one( $attributes, $data ); ?>
				</div>
				<?php
			}
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}


	/**
	 * Renders the post slider template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_slider( $attributes, $post_query, $pagination_type = '' ) {
		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<div class="swiper-slide sp-slide-item">
				<?php self::template_one( $attributes, $data ); ?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Renders the post slider two template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_slider_two( $attributes, $post_query, $pagination_type = '' ) {
		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<div class="swiper-slide sp-slide-item">
				<?php self::template_one( $attributes, $data ); ?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render grid one template.
	 *
	 * @param array  $attributes      Block attributes.
	 * @param array  $post_query      Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_grid_one( $attributes, $post_query, $pagination_type = '' ) {
		$layout                          = $attributes['blockLayoutName'] ?? '';
		$skip_items_for_grid_top_section = array(
			'grid-one-layout-one'         => 0,
			'grid-one-layout-three'       => 1,
			'grid-one-layout-four'        => 1,
			'grid-one-layout-five'        => 0,
			'grid-one-layout-six'         => 2,
			'grid-one-layout-six-updated' => 4,
			'grid-one-layout-seven'       => 4,
			'grid-one-layout-eight'       => 3,
			'grid-one-layout-nine'        => 3,
		);

		$large_item_part_one = array_slice( $post_query, 0, 1 );
		$large_item_part_two = array_slice( $post_query, 1, $skip_items_for_grid_top_section[ $layout ] );

		$skip_items = ( 'grid-one-layout-one' === $layout || 'grid-one-layout-five' === $layout ) || wp_is_mobile() ? 0 : $skip_items_for_grid_top_section[ $layout ] + 1;

		$hide_part             = array( 'readMoreButton', 'taxonomy', 'excerpt' );
		$hide_part_small_items = array();

		switch ( $layout ) {
			case 'grid-one-layout-six':
			case 'grid-one-layout-six-updated':
			case 'grid-one-layout-seven':
			case 'grid-one-layout-eight':
			case 'grid-one-layout-nine':
				$hide_part_small_items = array( 'excerpt', 'taxonomy', 'readMoreButton' );
				break;
			case 'grid-one-layout-three':
			case 'grid-one-layout-four':
				$hide_part = array();
				break;
		}
		ob_start();
		if ( 'load-more' === $pagination_type ) { // When data load by ajax and pagination type is load more.
			foreach ( $post_query as $data ) {
				self::template_one( $attributes, $data, $hide_part_small_items );
			}
		} else {
			if ( ! wp_is_mobile() && ! in_array(
				$layout,
				array(
					'grid-one-layout-one',
					'grid-one-layout-five',
				),
				true
			) ) {
				?>
				<div class="sp-smart-post-static-grid-contents">
					<div class="sp-smart-post-large-item-part-one">
						<?php
						foreach ( $large_item_part_one as $data ) {
							self::template_one( $attributes, $data );
						}
						?>
					</div>
					<div class="sp-smart-post-large-item-part-two">
						<?php
						foreach ( $large_item_part_two as $data ) {
							self::template_one( $attributes, $data, $hide_part );
						}
						?>
					</div>
				</div>
			<?php } ?>
			<div class="sp-smart-post-dynamic-grid-contents">
				<?php
				foreach ( array_slice( $post_query, $skip_items ) as $data ) {
					self::template_one( $attributes, $data, $hide_part_small_items );
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Renders the grid two template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_grid_two( $attributes, $post_query, $pagination_type = '' ) {
		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<?php self::template_one( $attributes, $data ); ?>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Renders the grid three template.
	 *
	 * @param array  $attributes      The block attributes.
	 * @param array  $post_query      The post query data.
	 * @param string $pagination_type Optional. The pagination type. Default is empty string.
	 * @return void
	 */
	public static function post_grid_three( $attributes, $post_query, $pagination_type = '' ) {
		$layout                          = $attributes['blockLayoutName'] ?? '';
		$skip_items_for_grid_top_section = array(
			'grid-three-layout-one'   => 2,
			'grid-three-layout-two'   => 2,
			'grid-three-layout-three' => 1,
			'grid-three-layout-four'  => 0,
			'grid-three-layout-five'  => 3,
		);
		$large_item_part_one             = array_slice( $post_query, 0, $skip_items_for_grid_top_section[ $layout ] );
		$large_item_part_two             = array_slice( $post_query, $skip_items_for_grid_top_section[ $layout ] );
		ob_start();
		if ( 'load-more' === $pagination_type ) { // When data load by ajax and pagination type is load more.
			foreach ( $post_query as $data ) {
				self::template_one( $attributes, $data );
			}
		} else {
			?>
			<div class="sp-smart-post-static-grid-contents sp-smart-post-background-layout <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_one as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<div class="sp-smart-post-dynamic-grid-contents sp-smart-post-background-layout <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_two as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Render grid four template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_grid_four( $attributes, $post_query, $pagination_type = '' ) {
		$layout = $attributes['postGridLayout'] ?? '';

		$skip_items_for_grid_top_section = array(
			'grid-four-layout-one'   => 5,
			'grid-four-layout-two'   => 5,
			'grid-four-layout-three' => 5,
			'grid-four-layout-four'  => 4,
			'grid-four-layout-five'  => 4,
			'grid-four-layout-six'   => 3,
		);

		$large_item_part_one = array_slice( $post_query, 0, $skip_items_for_grid_top_section[ $layout ] );

		$skip_post = $skip_items_for_grid_top_section[ $layout ];

		$large_item_part_two = array_slice( $post_query, $skip_post );

		ob_start();

		if ( 'load-more' === $pagination_type ) {
			foreach ( $post_query as $data ) {
				self::template_one( $attributes, $data );
			}
		} else {
			?>
			<div class="sp-smart-show-pro grid-four-container <?php echo esc_attr( $layout ); ?>">
				<div class="sp-smart-post-grid-four-static-contents sp-smart-post-background-layout">
					<?php
					foreach ( $large_item_part_one as $data ) {
						self::template_one( $attributes, $data );
					}
					?>
				</div>
				<div class="sp-smart-post-dynamic-grid-contents sp-smart-post-background-layout">
					<?php
					foreach ( $large_item_part_two as $data ) {
						self::template_one( $attributes, $data );
					}
					?>
				</div>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Render grid five template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_grid_five( $attributes, $post_query, $pagination_type = '' ) {
		$layout = $attributes['postGridLayout'] ?? '';

		$skip_items_for_grid_top_section = in_array( $layout, array( 'grid-five-layout-one', 'grid-five-layout-two', 'grid-five-layout-three' ), true ) ? 3 : 4;

		$large_item_part_one = array_slice( $post_query, 0, $skip_items_for_grid_top_section );
		$skip_post           = $skip_items_for_grid_top_section;
		$large_item_part_two = array_slice( $post_query, $skip_post );

		ob_start();

		if ( 'load-more' === $pagination_type ) {
			foreach ( $post_query as $data ) {
				self::template_one( $attributes, $data );
			}
		} else {
			?>

			<div class="sp-smart-post-grid-five-dynamic-contents sp-smart-post-background-layout <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_one as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<div class="sp-smart-post-grid-five-static-contents sp-smart-post-background-layout <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_two as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render grid six template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_grid_six( $attributes, $post_query, $pagination_type = '' ) {
		$layout = $attributes['postGridLayout'] ?? '';
		// Define the number of items to skip for the top section based on the layout.
		$skip_items_for_grid_top_section = in_array( $layout, array( 'grid-six-layout-one', 'grid-six-layout-two' ), true ) ? 1 : 2;
		$large_item_part_one             = array_slice( $post_query, 0, $skip_items_for_grid_top_section );

		$skip_post = $skip_items_for_grid_top_section;

		$large_item_part_two = array_slice( $post_query, $skip_post );

		ob_start();

		if ( 'load-more' === $pagination_type ) {
			foreach ( $post_query as $data ) {
				self::template_one( $attributes, $data );
			}
		} else {
			?>
			<div class="sp-smart-post-grid-six-large-contents <?php echo 'grid-six-layout-four' === $layout ? 'sp-smart-post-background-layout' : ''; ?> <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_one as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<div class="sp-smart-post-grid-six-dynamic-contents <?php echo 'grid-six-layout-one' === $layout ? 'sp-smart-post-background-layout' : ''; ?> <?php echo esc_attr( $layout ); ?>">
				<?php
				foreach ( $large_item_part_two as $data ) {
					self::template_one( $attributes, $data );
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render timeline one template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_timeline_one( $attributes, $post_query, $pagination_type = '' ) {
		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<div class="sp-smart-post-timeline-one-post-container">
				<div class="sp-smart-indicator">
					<div class="sp-smart-indicator-circle"></div>
					<div class="sp-smart-indicator-arrow"></div>
				</div>
				<?php self::template_one( $attributes, $data ); ?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render timeline one template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_list_three( $attributes, $post_query, $pagination_type = '' ) {
		$show_hide_divider    = $attributes['showHideDivider'] ?? false;
		$layout               = $attributes['postListLayout'] ?? '';
		$overlay_type         = isset( $attributes['imageOverlayColor'] ) ? $attributes['imageOverlayColor'] : 'no-overlay';
		$attributes['layout'] = $layout;
		$bg_class             = in_array( $layout, array( 'sp-smart-post-list-three-layout-three', 'sp-smart-post-list-three-layout-four' ), true ) ? ' sp-smart-post-background-layout' : '';

		$image_overlay_class = in_array( $layout, array( 'sp-smart-post-list-three-layout-three', 'sp-smart-post-list-three-layout-four' ), true ) ? $overlay_type : '';

		$large_item_length =
			'sp-smart-post-list-three-layout-six' === $layout ? 4 : 2;

		// Some content part hide (title part, meta data part).
		$hide_part = array();
		switch ( $layout ) {
			case 'sp-smart-post-list-three-layout-one':
			case 'sp-smart-post-list-three-layout-three':
				$hide_part = array( 'excerpt', 'readMoreButton' );
				break;
			case 'sp-smart-post-list-three-layout-two':
			case 'sp-smart-post-list-three-layout-four':
			case 'sp-smart-post-list-three-layout-five':
			case 'sp-smart-post-list-three-layout-six':
				$hide_part = array( 'taxonomy', 'excerpt', 'readMoreButton', 'feature_image' );
				break;
		}

		ob_start();
		if ( 'load-more' === $pagination_type ) { // When data load by ajax and pagination type is load more.
			foreach ( $post_query as $data ) {
				?>
				<div class="sp-smart-post-list-item">
					<?php if ( $show_hide_divider ) { ?>
						<div class="sp-smart-post-list-divider"></div>
					<?php } ?>
					<?php self::template_one( $attributes, $data, $hide_part ); ?>
				</div>
				<?php
			}
		} else {
			?>
			<div class='sp-smart-post-large-items<?php echo esc_attr( $bg_class ); ?>'>
				<?php
				foreach ( array_slice( $post_query, 0, $large_item_length ) as $data ) {
					?>
					<div class="sp-smart-post-list-item">
						<?php self::template_one( $attributes, $data ); ?>
					</div>
					<?php
				}
				?>
			</div>
			<div class='sp-smart-post-small-items'>
				<?php
				foreach ( array_slice( $post_query, $large_item_length ) as $data ) {
					?>
					<div class="sp-smart-post-list-item">
						<?php if ( $show_hide_divider ) { ?>
							<div class="sp-smart-post-list-divider"></div>
						<?php } ?>
						<?php self::template_one( $attributes, $data, $hide_part ); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Render timeline one template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_timeline_two( $attributes, $post_query, $pagination_type = '' ) {
		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<div class="sp-smart-post-timeline-one-post-container">
				<div class="sp-smart-indicator">
					<div class="sp-smart-indicator-circle"></div>
					<div class="sp-smart-indicator-arrow"></div>
				</div>
				<?php self::template_one( $attributes, $data ); ?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render list one template.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $post_query Post query data.
	 */
	public static function post_list_one( $attributes, $post_query ) {
		$layout = $attributes['postListLayout'] ?? '';

		$show_hide_divider = $attributes['showHideDivider'] ?? false;

		$hide_part = array();
		if ( 'list-one-layout-five' === $layout || 'list-one-layout-six' === $layout ) {
			$hide_part = 'list-one-layout-five' === $layout ? array( 'title', 'metadata' ) : array( 'title' );
		}

		ob_start();
		foreach ( $post_query as $data ) {
			?>
			<div class="sp-smart-post-show-list-one-card-wrapper">
				<?php self::template_one( $attributes, $data, $hide_part ); ?>
			</div>
			<?php if ( $show_hide_divider ) { ?>
				<div class="sp-smart-post-list-divider"></div>
			<?php } ?>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render list two template.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $post_query Post query data.
	 * @param string $pagination_type Pagination type (optional).
	 */
	public static function post_list_two( $attributes, $post_query, $pagination_type = '' ) {
		$layout = $attributes['postListLayout'] ?? '';

		$bg_class          = in_array( $layout, array( 'sp-smart-post-list-two-layout-one', 'sp-smart-post-list-two-layout-two', 'sp-smart-post-list-two-layout-five', 'sp-smart-post-list-two-layout-six' ), true ) ? ' sp-smart-post-background-layout' : '';
		$show_hide_divider = $attributes['showHideDivider'] ?? false;
		// Some content part hide (title part, meta data part).
		$hide_part = array();
		switch ( $layout ) {
			case 'sp-smart-post-list-two-layout-two':
			case 'sp-smart-post-list-two-layout-four':
				$hide_part = array( 'excerpt', 'readMoreButton' );
				break;
			case 'sp-smart-post-list-two-layout-five':
			case 'sp-smart-post-list-two-layout-six':
			case 'sp-smart-post-list-two-layout-eight':
				$hide_part = array( 'taxonomy', 'excerpt', 'readMoreButton', 'feature_image' );
				break;
			case 'sp-smart-post-list-two-layout-seven':
				$hide_part = array( 'taxonomy', 'readMoreButton', 'feature_image' );
				break;
		}
		ob_start();
		if ( 'load-more' === $pagination_type ) { // When data load by ajax and pagination type is load more.
			foreach ( $post_query as $data ) {
				?>
				<div class="sp-smart-post-list-item">
					<?php self::template_one( $attributes, $data, $hide_part ); ?>
				</div>
				<?php if ( $show_hide_divider ) { ?>
					<div class="sp-smart-post-list-divider"></div>
				<?php } ?>
				<?php
			}
		} else {
			?>
			<div class='sp-smart-post-large-items<?php echo esc_attr( $bg_class ); ?>'>
				<?php
				foreach ( array_slice( $post_query, 0, 1 ) as $data ) {
					?>
					<div class="sp-smart-post-list-item">
						<?php self::template_one( $attributes, $data ); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php if ( $show_hide_divider ) { ?>
				<div class="sp-smart-post-list-divider"></div>
			<?php } ?>
			<div class='sp-smart-post-small-items'>
				<?php
				foreach ( array_slice( $post_query, 1 ) as $data ) {
					?>
					<div class="sp-smart-post-list-item">
						<?php self::template_one( $attributes, $data, $hide_part ); ?>
					</div>
					<?php if ( $show_hide_divider ) { ?>
						<div class="sp-smart-post-list-divider"></div>
					<?php } ?>
					<?php
				}
				?>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Retrieves pagination block attributes from inner blocks.
	 *
	 * @param object $blocks The blocks object containing inner blocks.
	 */
	public static function pagination_attributes( $blocks ) {
		$attributes = array();
		if ( ! isset( $blocks->inner_blocks ) ) {
			return;
		}
		// Check how many inner blocks are available.
		$item_count = $blocks->inner_blocks->count();

		for ( $index = 1; $index <= $item_count; $index++ ) {
			// Get the inner block data.
			$inner_block = $blocks->inner_blocks->current();
			// If the inner block is a pagination block, get its attributes.
			if ( 'sp-smart-post-show/pagination' === $inner_block->name ) {
				$attributes = $inner_block->attributes;
				break;
			}
		}
		return $attributes;
	}

	/**
	 * Renders the loop template for a single post item.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $data       Post data for the current item.
	 * @param array $hide_part  Parts to hide in the template.
	 */
	public static function loop_template( $attributes, $data, $hide_part ) {
		$content_part_array = isset( $attributes['contentPartArray'] ) ? $attributes['contentPartArray'] : array();

		$orientation       = $attributes['contentOrientation'] ?? 'orientation_one';
		$category_position = $attributes['catTabCategoryPosition'] ?? '';

		$social_share_icon_position = isset( $attributes['socialShareIconPosition'] ) ? $attributes['socialShareIconPosition'] : '';

		$social_icon_display_type = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : 'inline-icon';

		$show_social_share = ( 'inline-icon' === $social_icon_display_type || '' === $social_share_icon_position ) ? true : false;

		$content_part = array(
			'taxonomy'       => ( empty( $category_position ) && 'orientation_three' !== $orientation && 'orientation_four' !== $orientation ) ? Template_Part::category( $attributes, $data ) : null,
			'title'          => Template_Part::title( $attributes, $data ),
			'metadata'       => Template_Part::meta_data( $attributes, $data ),
			'excerpt'        => Template_Part::excerpt( $attributes, $data ),
			'readMoreButton' => Template_Part::read_more_button( $attributes, $data ),
			'socialShare'    => $show_social_share ? Template_Part::social_share( $attributes, $data ) : null,
			'starRating'     => Template_Part::star_rating( $attributes, $data ),
			'price'          => Template_Part::price( $attributes, $data ),
			'addToCart'      => Template_Part::add_to_cart( $attributes, $data ),
		);

		ob_start();

		if ( ! in_array( 'feature_image', $hide_part, true ) ) {
			Template_Part::feature_image( $attributes, $data );
		}
		?>

		<div class="sp-smart-post-template-one-content">
			<div class="sp-smart-post-card-content">
				<?php
				foreach ( $content_part_array as $part ) {
					if ( ! in_array( $part['value'], $hide_part, true ) ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $content_part[ $part['value'] ];
					}
				}
				?>
			</div>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Template one function.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $data       Post data for the current item.
	 * @param array $hide_part  Parts to hide in the template.
	 */
	public static function template_one( $attributes, $data, $hide_part = array() ) {
		$layout            = $attributes['layout'] ?? '';
		$content_align_h   = isset( $attributes['contentHorizontalPosition'] ) ? $attributes['contentHorizontalPosition'] : 'left';
		$image_position    = isset( $attributes['imagePosition'] ) ? $attributes['imagePosition'] : '';
		$img_overlay_type  = isset( $attributes['imageOverlayType'] ) ? $attributes['imageOverlayType'] : '';
		$img_overlay_class = 'background' === $image_position ? ' overlay-type-' . $img_overlay_type : '';
		$post_card_class   = 'content-' . $content_align_h . $img_overlay_class;
		ob_start();
		?>
		<div class="sp-smart-post-card <?php echo esc_attr( $post_card_class ); ?>">
			<?php
			if ( 'list-one-layout-five' === $layout || 'list-one-layout-six' === $layout ) {
				echo '<div class="sp-smart-post-list-one-layout-top">';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo Template_Part::title( $attributes, $data );
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo 'list-one-layout-five' === $layout ? Template_Part::meta_data( $attributes, $data ) : '';
				echo '</div>';
			}
			?>
			<?php echo ( 'list-one-layout-five' === $layout || 'list-one-layout-six' === $layout ) ? '<div class="sp-smart-post-list-one-layout-bottom">' : ''; ?>

			<?php self::loop_template( $attributes, $data, $hide_part ); ?>

			<?php echo ( 'list-one-layout-five' === $layout || 'list-one-layout-six' === $layout ) ? '</div>' : ''; ?>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Thumbnail Template function.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $data       Post data for the current item.
	 * @param array $hide_part  Parts to hide in the template.
	 */
	public static function thumb_template( $attributes, $data, $hide_part = array() ) {

		$layout       = $attributes['thumbnailSliderTwoLayout'] ?? '';
		$progress_bar = 'thumbnail-slider-two-layout-two' === $layout;

		ob_start();
		?>
		<div class="sp-smart-post-card sp-smart-post-thumbs-template">
			<?php ( ! in_array( 'feature_image', $hide_part, true ) ) ? Template_Part::feature_image( $attributes, $data, false ) : null; ?>
			<div class='sp-smart-post-template-one-content'>
				<div class="sp-smart-post-card-content">
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo ( ! in_array( 'taxonomy', $hide_part, true ) ) ? Template_Part::category( $attributes, $data ) : null;
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo ( ! in_array( 'title', $hide_part, true ) ) ? Template_Part::title( $attributes, $data, $progress_bar ) : null;
					?>

				</div>
			</div>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Smart search Template function.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $post_query       Post data for the current item.
	 * @param array $pagination_type  Pagination type (optional).
	 */
	public static function smart_search( $attributes, $post_query, $pagination_type = '' ) {
		$show_date                  = isset( $attributes['showDate'] ) ? $attributes['showDate'] : false;
		$show_author                = isset( $attributes['showAuthor'] ) ? $attributes['showAuthor'] : false;
		$show_excerpt               = isset( $attributes['showExcerpt'] ) ? $attributes['showExcerpt'] : false;
		$excerpt_limit              = isset( $attributes['excerptLimit'] ) ? $attributes['excerptLimit'] : 20;
		$title_global_typo_class    = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$meta_global_typo           = isset( $attributes['searchResultMetaGlobalTypography'] ) ? $attributes['searchResultMetaGlobalTypography'] : '';
		$meta_global_typo_class     = isset( $attributes['searchResultMetaGlobalTypography']['class'] ) ? $attributes['searchResultMetaGlobalTypography']['class'] : '';
		$show_taxonomy              = isset( $attributes['showTaxonomy'] ) ? $attributes['showTaxonomy'] : false;
		$search_result_display_type = $attributes['searchResultDisplayType'] ?? '';
		$show_image                 = isset( $attributes['showImage'] ) ? $attributes['showImage'] : false;

		$excerpt_attr = array(
			'excerptShow'             => $show_excerpt,
			'excerptType'             => 'limited',
			'excerpt_ending_points'   => '...',
			'excerptLength'           => $excerpt_limit,
			'excerptGlobalTypography' => $meta_global_typo,
		);

		$placeholder_img = SP_PC_URL . 'public/assets/img/placeholder.png';
		ob_start();
		foreach ( $post_query as $data ) {
			$permalink          = isset( $data['link'] ) ? $data['link'] : '';
			$image_alt_text     = 'alt="' . ( ! empty( $data['image_alt'] ) ? esc_attr( $data['image_alt'] ) : esc_attr( $data['title'] ) ) . '"';
			$post_thumbnail_url = isset( $data['post_thumbnail_url'] ) ? $data['post_thumbnail_url'] : false;
			$feature_image      = $post_thumbnail_url ? '<img src="' . esc_url( $post_thumbnail_url ) . '" ' . $image_alt_text . ' loading="lazy" />' : '';
			$feature_image      = ! empty( $feature_image ) ? $feature_image : '<img src="' . $placeholder_img . '" ' . $image_alt_text . ' />';
			$title              = isset( $data['title'] ) ? $data['title'] : '';
			?>
			<div class="sp-smart-post-search-item">
				<?php if ( 'smart-search-result-layout-two' !== $search_result_display_type && $show_image ) { ?>
					<div class="sp-smart-post-search-item-img">
						<a href="<?php echo esc_attr( $permalink ); ?>">
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo $feature_image;
							?>
						</a>
					</div>
				<?php } ?>

				<div class="sp-smart-post-search-item-desc">
					<?php
					if ( $show_taxonomy && ! empty( $data['categories'] ) ) {
						?>
						<div class="sp-smart-post-categories 
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $meta_global_typo_class;
						?>
						">
							<?php
							foreach ( $data['categories'] as $category ) {
								?>
								<span class="sp-smart-post-category">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $category;
								?>
								</span>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>

					<a href="<?php echo esc_attr( $permalink ); ?>" class="sp-smart-post-search-item-title 
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $title_global_typo_class;
					?>
					">
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $title;
					?>
					</a>

					<?php
					if ( $show_excerpt ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo Template_Part::excerpt( $excerpt_attr, $data );
					}
					if ( $show_author || $show_date ) {
						?>
						<div class="sp-smart-post-meta-list 
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $meta_global_typo_class;
						?>
						">
							<?php
							if ( $show_author ) {
								?>
								<span class='sp-smart-post-meta'> 
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $data['author'] ?? '';
								?>
								, </span>
								<?php
							}
							?>
							<?php
							if ( $show_date ) {
								?>
								<span class='sp-smart-post-meta'> 
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $data['date'] ?? '';
								?>
								</span>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
}
