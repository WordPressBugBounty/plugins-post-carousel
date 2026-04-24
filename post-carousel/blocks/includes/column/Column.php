<?php
/**
 * Container column class for Smart Post Show Blocks.
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
 * Column
 */
class Column extends Block_Base {
	/**
	 * Set block properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'column';
		$this->styles     = array(
			'sp_smart_post_blocks_css',
		);
	}

	/**
	 * Render Column block.
	 *
	 * @param  array $attributes attributes.
	 * @param  mixed $content Content to be rendered.
	 * @param  array $blocks Blocks to be rendered.
	 * @return  string Rendered HTML content.
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
		$column_additional_class    = $attributes['columnAdditionalClass'] ?? '';
		$column_additional_id       = $attributes['columnAdditionalID'] ?? '';
		$column_wrapper_link_enable = isset( $attributes['columnWrapperLink'] ) ? $attributes['columnWrapperLink'] : false;
		$column_wrapper_link_url    = $attributes['columnWrapperLinkUrl'] ?? '';
		$column_wrapper_link_newtab = isset( $attributes['columnWrapperLinkNewTab'] ) && $attributes['columnWrapperLinkNewTab'] ? '_blank' : '_self';
		// Video Background Attributes.
		$background_style     = isset( $attributes['columnBg']['color']['style'] ) ? $attributes['columnBg']['color']['style'] : '';
		$background_video     = $attributes['columnBgVideo'] ?? '';
		$background_video_url = isset( $background_video['url'] ) ? $background_video['url'] : '';

		// Column Class.
		$column_class = array( $unique_id, 'sp-smart-post-container-column' );
		if ( ! empty( $column_additional_class ) ) {
			$column_class[] = $column_additional_class;
		}
		$column_class_output = implode( ' ', $column_class );

		ob_start();
		?>
		<div class="<?php echo esc_attr( $column_class_output ); ?>" id="<?php echo esc_attr( $unique_id ); ?>">
			<div class="sp-smart-post-column-wrapper" id="<?php echo esc_attr( $column_additional_id ); ?>">
				<?php if ( 'video' === $background_style && ! empty( $background_video ) ) : ?>
					<!-- Container Video Background Start -->
					<div class="sp-smart-post-column__video-wrap">
						<video muted loop autoplay>
							<source src="<?php echo esc_url( $background_video_url ); ?>" type="video/mp4">
							Your browser does not support the html5 video tag.
						</video>
					</div>
					<!-- Container Video Background Ends -->
				<?php endif; ?>
				<div class="sp-smart-post-show-column">
					<!-- Container Content div start -->
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
					echo $content;
					?>
					<!-- Container Content div ends -->
					<?php if ( $column_wrapper_link_enable && ! empty( $column_wrapper_link_url ) ) : ?>
						<a class="sp-smart-post-column-block-wrapper-link" rel="noopener" href="<?php echo esc_url( $column_wrapper_link_url ); ?>" target="<?php echo esc_attr( $column_wrapper_link_newtab ); ?>"></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
