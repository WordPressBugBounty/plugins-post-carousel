<?php
/**
 * Post carousel class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Carousel Block Class.
 */
class Post_Carousel_Two extends Block_Base {



	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-carousel-two';
		$this->scripts        = array( 'pcp_swiper', 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'pcp_swiper', 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_style', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_social_icons_style', 'pcp-font-awesome', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Carousel', 'Live Filter', 'pagination', 'ticker', 'multi row', ' Ajax Live Filter' );
	}
	/**
	 * Render_block
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  string $blocks  Nested blocks.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {

		$attributes['page_id']      = get_the_ID();
		$unique_id                  = isset( $attributes['uniqueId'] ) ? $attributes['uniqueId'] : '';
		$sp_block_id                = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$align                      = isset( $attributes['align'] ) ? $attributes['align'] : '';
		$layout                     = isset( $attributes['blockLayoutName'] ) ? $attributes['blockLayoutName'] : '';
		$block_name                 = isset( $attributes['blockName'] ) ? $attributes['blockName'] : '';
		$orientation                = isset( $attributes['contentOrientation'] ) ? $attributes['contentOrientation'] : 'orientation_one';
		$image_position             = isset( $attributes['imagePosition'] ) ? $attributes['imagePosition'] : 'top';
		$category_position          = isset( $attributes['catTabCategoryPosition'] ) ? $attributes['catTabCategoryPosition'] : '';
		$carousel_style             = isset( $attributes['carouselStyle'] ) ? $attributes['carouselStyle'] : '';
		$carousel_pagination_style  = isset( $attributes['carouselPaginationStyle'] ) ? $attributes['carouselPaginationStyle'] : '';
		$carousel_data              = isset( $attributes['carouselData'] ) ? $attributes['carouselData'] : '';
		$nav_arrow_visibility_hover = isset( $attributes['navArrowVisibilityOnHover'] ) ? $attributes['navArrowVisibilityOnHover'] : '';
		$pagination_style           = isset( $attributes['carouselPaginationStyle'] ) ? $attributes['carouselPaginationStyle'] : '';
		$additional_css_class       = isset( $attributes['additionalCssClass'] ) ? $attributes['additionalCssClass'] : '';
		$align_class                = isset( $align ) ? 'align' . $align : '';
		unset( $attributes['dynamicCss'] );
		unset( $attributes['fontListsEditPage'] );
		unset( $attributes['fontLists'] );

		$query_attr = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;

		$post_query = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$post_query = $post_query[0];

		$equal_height = isset( $attributes['equalHeightEnable'] ) ? $attributes['equalHeightEnable'] : false;

		$equal_height_class = $equal_height ? 'sp-equal-height-wrapper' : '';

		$preloader_enable = $attributes['preloaderEnable'] ?? false;
		$post_not_found   = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';
		$preloader_svg    = SP_PC_URL . 'public/assets/img/preloader.svg';

		ob_start();
		?>
		<?php if ( empty( $post_query ) ) : ?>
			<div class="sp-smart-post-show-pro-pre-query">
				<?php if ( $preloader_enable ) : ?>
					<div class="sp-smart-post-preloader sp-d-block">
						<img src="<?php echo esc_url( $preloader_svg ); ?>" alt="smart post preloader" />
					</div>
				<?php endif; ?>
				<div class="sp-smart-post-no-post sp-d-hidden">
					<h4>
					<?php
					echo esc_html( $post_not_found );
					?>
					</h4>
				</div>
			</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr( $align_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper sp-smart-<?php echo esc_attr( $block_name ); ?> <?php echo esc_attr( $additional_css_class ); ?>" data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>">

				<div class="sp-smart-post-show-pro-pre-query">
					<?php
					if ( empty( $post_query ) ) {
						Template_Part::no_posts_found_text( $post_not_found );
					}
					Template_Part::preloader_front( $preloader_enable, $preloader_svg );
					?>
				</div>
				<div class="sp-smart-post-carousel-two  sp-smart-post-block-wrapper sp-smart-post-carousel-<?php echo esc_attr( $carousel_style ); ?> img-position-<?php echo esc_attr( $image_position ); ?>  <?php echo esc_attr( $orientation . ' ' . $layout ); ?> sp-cat-position-<?php echo esc_attr( $category_position ); ?> <?php echo ( 'background' === $image_position ) ? 'sp-smart-post-background-layout' : ''; ?>">
					<div class="sp-smart-post-swiper sp-relative <?php echo esc_attr( $equal_height_class ); ?>" data-equal-height="<?php echo esc_attr( $equal_height ); ?>">
						<?php
						if ( 'ticker' === $carousel_style ) {
							?>
							<div class="sp_marquee-container sp-smart-post-ticker" data-options='<?php echo esc_attr( $carousel_data ); ?>'>
								<div class="sp_marquee-content">
									<?php
									foreach ( $post_query as $data ) {
										?>
										<div class="sp_marquee-item sp-slide-item">
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
						} else {
							?>
							<div class="swiper-container swiper pagination-<?php echo esc_attr( $carousel_pagination_style ); ?> layout-<?php echo esc_attr( $carousel_style ); ?>" data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>'>
								<div class="swiper-wrapper">
									<?php
									foreach ( $post_query as $data ) {
										?>
										<div class="swiper-slide sp-slide-item">
											<?php Template::template_one( $attributes, $data ); ?>
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
						<?php } ?>
					</div>
				</div>
				<?php Template_Part::modal_lightbox( $attributes, $post_query ); ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
