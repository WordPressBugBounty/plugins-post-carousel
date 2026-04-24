<?php
/**
 * Post carousel class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Carousel Block Class.
 */
class Post_Carousel extends Block_Base {

	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-carousel';
		$this->scripts        = array( 'pcp_swiper', 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'pcp_swiper', 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Carousel', 'Live Filter', 'pagination', 'ticker', 'multi row', ' Ajax Live Filter' );
	}
	/**
	 * Render_block
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}
		$attributes['page_id']      = get_the_ID();
		$sp_user_additional_class   = ! empty( $attributes['additionalCssClass'] ) ? $attributes['additionalCssClass'] : '';
		$unique_id                  = $attributes['uniqueId'] ?? '';
		$sp_block_id                = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$align                      = $attributes['align'] ?? '';
		$layout                     = $attributes['blockLayoutName'] ?? '';
		$block_name                 = $attributes['blockName'] ?? '';
		$orientation                = $attributes['contentOrientation'] ?? 'orientation_one';
		$image_position             = $attributes['imagePosition'] ?? 'top';
		$category_position          = $attributes['catTabCategoryPosition'] ?? '';
		$carousel_style             = $attributes['carouselStyle'] ?? '';
		$carousel_animation_effect  = $attributes['carouselAnimationEffect'] ?? '';
		$carousel_pagination_style  = $attributes['carouselPaginationStyle'] ?? '';
		$carousel_data              = $attributes['carouselData'] ?? '';
		$nav_arrow_visibility_hover = $attributes['navArrowVisibilityOnHover'] ?? '';
		$pagination_style           = $attributes['carouselPaginationStyle'] ?? '';
		$align_class                = isset( $align ) ? 'align' . $align : '';
		unset(
			$attributes['dynamicCss'],
			$attributes['fontListsEditPage'],
			$attributes['fontLists']
		);

		$query_attr         = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;
		$post_query         = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$post_query         = $post_query[0];
		$hide_part          = array( 'readMoreButton', 'taxonomy', 'excerpt' );
		$current_id         = '';
		$equal_height       = $attributes['equalHeightEnable'] ?? false;
		$equal_height_class = $equal_height ? 'sp-equal-height-wrapper' : '';
		$preloader_enable   = $attributes['preloaderEnable'] ?? false;
		$preloader_svg      = SP_PC_URL . 'public/assets/img/preloader.svg';
		$post_not_found     = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';
		$block_location     = $attributes['blockLocation'] ?? '';
		$center_extra_class = 'center' === $carousel_style ? ' sp-v-p-20' : '';
		ob_start();
		?>
		<div class="<?php echo esc_attr( $align_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper <?php echo esc_attr( $sp_user_additional_class ); ?> sp-smart-<?php echo esc_attr( $block_name ); ?>" data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>" data-location="<?php echo esc_attr( $block_location ); ?>">
			<div class="sp-smart-post-show-pro-pre-query">
				<?php
				if ( empty( $post_query ) ) {
					Template_Part::no_posts_found_text( $post_not_found );}
					Template_Part::preloader_front( $preloader_enable, $preloader_svg );
				?>
			</div>
				<div class="sp-smart-post-carousel sp-smart-post-block-wrapper sp-smart-post-carousel-<?php echo esc_attr( $carousel_style ); ?> img-position-<?php echo esc_attr( $image_position ); ?>  <?php echo esc_attr( $orientation . ' ' . $layout ); ?> sp-cat-position-<?php echo esc_attr( $category_position ); ?> <?php echo ( 'background' === $image_position ) ? 'sp-smart-post-background-layout' : ''; ?>">
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
					<div class="swiper-container sp-smart-post-swiper-slider swiper pagination-<?php echo esc_attr( $carousel_pagination_style ); ?> layout-<?php echo esc_attr( $carousel_style ); ?><?php echo esc_attr( $center_extra_class ); ?>" data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>'>
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
			<?php
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
