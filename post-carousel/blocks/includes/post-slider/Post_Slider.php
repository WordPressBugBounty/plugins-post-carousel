<?php
/**
 * Post slider block class for Smart Post Show Blocks.
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
 * Class Post_Slider
 *
 * Handles the Post Slider block functionality for Smart Post Show Pro.
 */
class Post_Slider extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-slider';
		$this->scripts        = array( 'sp_smart_post_blocks_script_js', 'pcp_swiper' );
		$this->styles         = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'pcp_swiper', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Slider', 'Live Filter', 'Pagination', ' Ajax Live Filter' );
	}

	/**
	 * Render block
	 *
	 * @param  array $attributes attributes.
	 * @param  mixed $content content.
	 * @param  array $blocks blocks.
	 * @return string
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$attributes['page_id']    = get_the_ID();
		$sp_user_additional_class = $attributes['additionalCssClass'] ?? '';
		$unique_id                = $attributes['uniqueId'] ?? '';
		$sp_block_id              = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$align                    = $attributes['align'] ?? '';
		$layout                   = $attributes['blockLayoutName'] ?? '';
		$block_name               = $attributes['blockName'] ?? '';
		$orientation              = $attributes['contentOrientation'] ?? 'orientation_one';
		$image_position           = $attributes['imagePosition'] ?? 'top';

		$category_position            = $attributes['catTabCategoryPosition'] ?? '';
		$carousel_style               = $attributes['carouselStyle'] ?? '';
		$carousel_animation_effect    = $attributes['carouselAnimationEffect'] ?? '';
		$carousel_pagination_style    = $attributes['carouselPaginationStyle'] ?? '';
		$carousel_data                = $attributes['carouselData'] ?? '';
		$nav_arrow_visibility_hover   = $attributes['navArrowVisibilityOnHover'] ?? '';
		$preloader_enable             = $attributes['postSliderGeneralPreloader'] ?? false;
		$post_not_found               = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';
		$preloader_svg                = SP_PC_URL . 'public/assets/img/preloader.svg';
		$pagination_style             = $attributes['carouselPaginationStyle'] ?? '';
		$post_slider_layout           = $attributes['postSliderLayout'] ?? '';
		$post_slider_animation_effect = $attributes['postSliderAnimationEffect'] ?? '';
		unset(
			$attributes['dynamicCss'],
			$attributes['fontListsEditPage'],
			$attributes['fontLists']
		);
		$query_attr = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;

		$post_query = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$post_query = $post_query[0];

		$category_position = $attributes['catTabCategoryPosition'] ?? false;

		$category_position = $category_position ? ' sp-cat-position-' . $category_position : '';

		$hide_part          = array( 'readMoreButton', 'taxonomy', 'excerpt' );
		$align_class        = isset( $align ) ? 'align' . $align : '';
		$content_h_position = isset( $attributes['contentHorizontalPosition'] ) ? $attributes['contentHorizontalPosition'] : '';
		$content_position   = 'post-slider-layout-five' === $post_slider_layout ? 'content-' . $content_h_position : '';
		$block_location     = $attributes['blockLocation'] ?? '';
		ob_start();
		?>
			<div class="<?php echo esc_attr( $align_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper sp-smart-<?php echo esc_attr( $block_name . $category_position ); ?> <?php echo esc_attr( $sp_user_additional_class ); ?>" data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>" data-location="<?php echo esc_attr( $block_location ); ?>">
				<div class="sp-smart-post-show-pro-pre-query">
				<?php
				if ( empty( $post_query ) ) {
					Template_Part::no_posts_found_text( $post_not_found );}
				Template_Part::preloader_front( $preloader_enable, $preloader_svg );
				?>
			</div>
				<div class="sp-smart-post-block-wrapper sp-smart-post-slider  sp-smart-md-10px <?php echo esc_attr( $post_slider_layout ); ?>">
					<div class="swiper  swiper-container sp-swiper-<?php echo esc_attr( $post_slider_animation_effect ); ?> sp-smart-post-swiper <?php echo esc_attr( $post_slider_layout ); ?> sp-smart-post-background-layout <?php echo esc_attr( $content_position ); ?>"  data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>'>
					<div class="swiper-wrapper">
								<?php
								foreach ( $post_query as $data ) {
									?>
								<div class="swiper-slide sp-slide-item">
									<?php
									Template::template_one( $attributes, $data );
									?>
									</div>
									<?php
								}
								?>
							</div>
					</div>
					<?php
					$attributes['carouselNavArrow'] ? Template_part::swiper_nav_arrow( $nav_arrow_visibility_hover, $attributes['carouselArrowStyle'] ) : '';
					?>
					<?php $attributes['carouselPaginationDot'] && 'scrollbar' !== $pagination_style ? Template_part::pagination( $pagination_style ) : ''; ?>
					<?php if ( $attributes['carouselPaginationDot'] && 'scrollbar' === $pagination_style ) { ?>
						<div class="swiper-scrollbar sp-pagination-horizontal swiper-scrollbar-horizontal"></div>
					<?php } ?>
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
