<?php
/**
 * Timeline three block class for Smart Post Show Blocks.
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
 * Post_Timeline_Three
 */
class Post_Timeline_Three extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-timeline-three';
		$this->scripts        = array( 'pcp_swiper', 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'pcp_swiper', 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Ticker', 'Carousel' );
	}
	/**
	 * Renders the Post Timeline Three block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block content.
	 * @param array  $blocks     Inner blocks.
	 * @return string            Rendered HTML output.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$attributes['page_id'] = get_the_ID();
		unset(
			$attributes['dynamicCss'],
			$attributes['fontListsEditPage'],
			$attributes['fontLists']
		);

		$unique_id                  = $attributes['uniqueId'] ?? '';
		$sp_block_id                = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$align                      = $attributes['align'] ?? '';
		$sp_user_additional_class   = $attributes['additionalCssClass'] ?? '';
		$layout                     = $attributes['timelineLayout'] ?? '';
		$block_name                 = $attributes['blockName'] ?? '';
		$orientation                = $attributes['contentOrientation'] ?? 'orientation_one';
		$image_position             = $attributes['imagePosition'] ?? 'top';
		$nav_arrow_visibility_hover = $attributes['navArrowVisibilityOnHover'] ?? '';
		$category_position          = $attributes['catTabCategoryPosition'] ?? '';
		$pagination_style           = $attributes['carouselPaginationStyle'] ?? '';
		$preloader_enable           = $attributes['preloaderEnable'] ?? false;
		$block_location             = $attributes['blockLocation'] ?? '';
		$post_not_found             = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';
		$preloader_svg              = SP_PC_URL . 'public/assets/img/preloader.svg';
		$query_attr                 = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;

		$category_position = $attributes['catTabCategoryPosition'] ?? false;

		$category_position = $category_position ? ' sp-cat-position-' . $category_position : '';

		$post_query = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$post_query = $post_query[0];

		$carousel_data  = $attributes['carouselData'] ?? '';
		$carousel_style = $attributes['carouselStyle'] ?? '';
		$align_class    = isset( $align ) ? 'align' . $align : '';
		$equal_height   = $attributes['equalHeightEnable'] ?? false;

		$equal_height_class = $equal_height ? 'sp-equal-height-wrapper' : '';
		ob_start();
		?>
		<div class="<?php echo esc_attr( $align_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper smart-post-timeline-three sp-smart-<?php echo esc_attr( $block_name . $category_position ); ?> <?php echo esc_attr( $sp_user_additional_class ); ?>"  data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>" data-location="<?php echo esc_attr( $block_location ); ?>">
				<div class="sp-smart-post-show-pro-pre-query">
				<?php
				if ( empty( $post_query ) ) {
					Template_Part::no_posts_found_text( $post_not_found );}
				Template_Part::preloader_front( $preloader_enable, $preloader_svg );
				?>
			</div>
			<div class="post-timeline-three  smart-post-timeline-three <?php echo esc_attr( $layout ); ?>">
				<div class="sp-smart-post-timeline-three-container sp-smart-post-swiper <?php echo esc_attr( $equal_height_class ); ?> <?php echo esc_attr( $layout ); ?>" data-equal-height="<?php echo esc_attr( $equal_height ); ?>">
					<div class="sp-smart-post-timeline-border"></div>
					<?php
					if ( 'ticker' === $carousel_style ) {
						?>

						<div class="sp_marquee-container sp-smart-post-ticker" data-options='<?php echo esc_attr( $carousel_data ); ?>'>
							<div class="sp_marquee-content">
									<?php
									foreach ( $post_query as $data ) {
										?>
										<div class="sp-smart-post-timeline-three-post-container sp_marquee-item ">
												<div class="sp-smart-indicator">
													<div class="sp-smart-indicator-circle"></div>
													<div class="sp-smart-indicator-arrow"></div>
												</div>
												<?php Template::template_one( $attributes, $data ); ?>
											</div>
										<?php
									}
									?>
							</div>
						</div>
								<?php
					} else {
						?>
						<div class="swiper swiper-container" data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>'>
							<div class="swiper-wrapper">
								<?php
								foreach ( $post_query as $data ) {
									?>
									<div class="sp-smart-post-timeline-three-post-container swiper-slide ">
										<div class="sp-smart-indicator">
											<div class="sp-smart-indicator-circle"></div>
											<div class="sp-smart-indicator-arrow"></div>
										</div>
										<?php Template::template_one( $attributes, $data ); ?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				$attributes['carouselNavArrow'] && 'ticker' !== $carousel_style ? Template_part::swiper_nav_arrow( $nav_arrow_visibility_hover, $attributes['carouselArrowStyle'] ) : '';
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
