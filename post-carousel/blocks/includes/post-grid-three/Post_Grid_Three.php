<?php
/**
 * Post grid class for Smart Post Show Blocks.
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
 * Post Grid Three Block Class.
 */
class Post_Grid_Three extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-grid-three';
		$this->scripts        = array( 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Grid', 'Live Filter', 'Pagination', ' Ajax Live Filter' );
	}

	/**
	 * Renders the Post Grid Three block.
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

		$attributes['page_id']    = get_the_ID();
		$sp_user_additional_class = $attributes['additionalCssClass'] ?? '';
		$sp_block_unique_id       = $attributes['uniqueId'] ?? '';
		$sp_block_name            = $attributes['blockName'] ?? '';
		$align                    = $attributes['align'] ?? '';
		unset(
			$attributes['dynamicCss'],
			$attributes['fontListsEditPage'],
			$attributes['fontLists']
		);
		$unique_id        = $attributes['uniqueId'] ?? '';
		$block_name       = $attributes['blockName'] ?? '';
		$sp_block_id      = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$layout           = $attributes['blockLayoutName'] ?? '';
		$preloader_enable = $attributes['preloaderEnable'] ?? false;
		$preloader_svg    = SP_PC_URL . 'public/assets/img/preloader.svg';
		$post_not_found   = ! empty( $attributes['noResultFoundResult'] ) ? $attributes['noResultFoundResult'] : 'No post found';

		$category_position = $attributes['catTabCategoryPosition'] ?? false;

		$category_position = $category_position ? ' sp-cat-position-' . $category_position : '';

		$query_attr     = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;
		$post_query     = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$total_pages    = $post_query[1];
		$post_query     = $post_query[0];
		$align_class    = isset( $align ) ? 'align' . $align : '';
		$query_attr     = wp_json_encode( $query_attr );
		$block_location = $attributes['blockLocation'] ?? '';

		$pagination_type     = $attributes['paginationTypeParent'] ?? '';
		$pagination_position = $attributes['paginationPosition'] ?? 'bottom';

		$pagination_class = 'sp-smart-post-block-with-pagination pagination-' . ( 'navigation' === $pagination_type ? $pagination_position : 'bottom' );

		ob_start();
		?>

			<div class="<?php echo esc_attr( $align_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-wrapper sp-smart-<?php echo esc_attr( $block_name . $category_position ); ?> <?php echo esc_attr( $sp_user_additional_class ); ?> <?php echo esc_attr( $pagination_class ); ?>" data-query='<?php echo esc_attr( $query_attr ); ?>' data-blockid="<?php echo esc_attr( $sp_block_id ); ?>" data-pageid="<?php echo esc_attr( $attributes['page_id'] ); ?>" data-location="<?php echo esc_attr( $block_location ); ?>">
			<div class="sp-smart-post-show-pro-pre-query">
				<?php
				if ( empty( $post_query ) ) {
					Template_Part::no_posts_found_text( $post_not_found );}
					Template_Part::preloader_front( $preloader_enable, $preloader_svg );
				?>
			</div>
				<div class="sp-smart-show-pro grid-three-container">
					<div class="sp-smart-post-grid-three-contents sp-smart-post-items <?php echo esc_attr( $layout ); ?>">
						<?php Template::post_grid_three( $attributes, $post_query ); ?>
					</div>
				</div>
				<?php
				// Pagination.
				if ( $attributes['paginationEnable'] && $total_pages > 1 && ! empty( $blocks->inner_blocks ) ) {
					$pagination_attributes = Template::pagination_attributes( $blocks );
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
					echo Template_Part::pagination_html( $pagination_attributes, $query_attr, $total_pages, $unique_id );
				}
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
