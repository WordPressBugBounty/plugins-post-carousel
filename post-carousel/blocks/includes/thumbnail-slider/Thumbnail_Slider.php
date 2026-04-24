<?php
/**
 * Thumbnail slider class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Container
 */
class Thumbnail_Slider extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'thumbnail-slider';
		$this->scripts        = array( 'pcp_swiper', 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'pcp_swiper', 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Slider', 'Thumbnails Slider' );
	}

	/**
	 * Render Thumbnail Slider block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content Block content.
	 * @param array  $blocks Inner blocks.
	 * @return  $content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		// Setup and sanitize attributes.
		$attributes['page_id'] = get_the_ID();
		$unique_id             = $attributes['uniqueId'] ?? '';
		$sp_block_id           = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$block_name            = $attributes['blockName'] ?? '';
		$align                 = $attributes['align'] ?? '';
		$additional_class      = $attributes['additionalCssClass'] ?? '';
		$animation_effect      = $attributes['postThumbnailAnimationEffect'] ?? '';
		$layout                = $attributes['thumbnailSliderLayout'] ?? '';
		$carousel_data         = $attributes['carouselData'] ?? '';
		$thumbnails_data       = $attributes['thumbnailsData'] ?? '';
		$arrow_on_hover        = $attributes['navArrowVisibilityOnHover'] ?? '';
		$arrow_style           = $attributes['carouselArrowStyle'] ?? '';
		$pagination_style      = $attributes['carouselPaginationStyle'] ?? '';
		$show_pagination       = $attributes['carouselPaginationDot'] ?? false;
		$post_thumbnail_pos    = $attributes['postThumbnailPosition'] ?? '';
		$category_position     = $attributes['catTabCategoryPosition'] ?? '';
		$preloader_enable      = $attributes['preloaderEnable'] ?? false;
		$post_not_found        = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';
		$preloader_svg         = SP_PC_URL . 'public/assets/img/preloader.svg';

		// Clean up unnecessary attributes.
		unset( $attributes['dynamicCss'], $attributes['fontListsEditPage'], $attributes['fontLists'] );

		// Fetch posts.
		$query_attr = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;

		$post_query = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$post_query = $post_query[0];

		// Layout class condition.
		$background_layout_class = ! in_array( $layout, array( 'thumbnail-slider-layout-three', 'thumbnail-slider-layout-four' ), true )
			? 'sp-smart-post-background-layout'
			: '';
		$align_class             = isset( $align ) ? 'align' . $align : '';

		// Start output buffering.
		ob_start();
		?>

		<div class="<?php echo esc_attr( $align_class ); ?>">
		<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper sp-smart-<?php echo esc_attr( $block_name ); ?> <?php echo esc_attr( $additional_class ); ?>" data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>">
			<div class="sp-smart-post-show-pro-pre-query">
				<?php
				if ( empty( $post_query ) ) {
					Template_Part::no_posts_found_text( $post_not_found );}
				Template_Part::preloader_front( $preloader_enable, $preloader_svg );
				?>
			</div>
			<div class="sp-smart-post-block-wrapper sp-smart-post-thumbnail-slider sp-smart-post-slider sp-smart-md-10px sp-thumbnail-<?php echo esc_attr( $post_thumbnail_pos ); ?> <?php echo esc_attr( $layout ); ?>">

				<!-- Main Slide -->
				<div class="sp-smart-post-thumbnail-slide sp-cat-position-<?php echo esc_attr( $category_position ); ?>">
					<div class="swiper swiper-container thumbnail-slider-layout-one sp-swiper-<?php echo esc_attr( $animation_effect ); ?> sp-smart-post-swiper sp-smart-post-background-layout <?php echo esc_attr( $layout ); ?>" data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>'>
						<div class="swiper-wrapper">
							<?php foreach ( $post_query as $data ) : ?>
								<div class="swiper-slide sp-slide-item">
									<?php Template::template_one( $attributes, $data ); ?>
								</div>
							<?php endforeach; ?>
						</div>
						<?php
						if ( ! empty( $attributes['carouselNavArrow'] ) ) {
							Template_part::swiper_nav_arrow( $arrow_on_hover, $arrow_style );
						}
						?>
					</div>

				</div>

				<!-- Thumbnail Navigation -->
				<div class="sp-smart-post-thumbnail-thumb">
					<div class="sp-smart-post-swiper2 swiper swiper-container <?php echo esc_attr( $background_layout_class ); ?>" data-swiper-options='<?php echo esc_attr( $thumbnails_data ); ?>'>
						<div class="swiper-wrapper">
							<?php foreach ( $post_query as $data ) : ?>
								<div class="swiper-slide sp-slide-item-thumb">
									<?php
									Template::thumb_template( $attributes, $data );
									?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<!-- Pagination -->
				<?php
				if ( $show_pagination && 'scrollbar' !== $pagination_style ) {
					Template_part::pagination( $pagination_style );
				}
				?>
			</div>
			<?php
			// Moved modal rendering to footer.
				add_action(
					'wp_footer',
					function () use ( $attributes, $post_query ) {
						Template_Part::modal_lightbox( $attributes, $post_query );
					},
					20
				);
			?>
		</div>
		</div>
		<?php

		return ob_get_clean();
	}
}
