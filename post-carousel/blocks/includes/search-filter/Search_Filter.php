<?php
/**
 * Search Filter Block Class for Smart Post Show.
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
 * Taxonomy Filter Block Class
 */
class Search_Filter extends Block_Base {

	/**
	 * Set block properties.
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'search-filter';
	}

	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  array  $blocks   Nested blocks.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$unique_id          = $attributes['uniqueId'] ?? '';
		$show_search_label  = $attributes['showSearchLabel'] ?? '';
		$search_label       = $attributes['searchLabel'] ?? '';
		$placeholder_text   = $attributes['placeholderText'] ?? '';
		$enable_search_icon = $attributes['enableSearchIcon'] ?? false;

		$title_global_typo_class  = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$option_global_typo_class = isset( $attributes['optionGlobalTypography']['class'] ) ? $attributes['optionGlobalTypography']['class'] : '';
		$additional_css_class     = $attributes['additionalCssClass'] ?? '';

		ob_start();
		?>
		<div class="sp-smart-post-search-filter sp-smart-post-live-filter <?php echo esc_attr( $additional_css_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>">

				<?php if ( $show_search_label ) { ?>
					<span class="sp-smart-post-live-filter-label <?php echo esc_attr( $title_global_typo_class ); ?>"><?php echo esc_html( $search_label ); ?></span>
				<?php } ?>

				<div class="sp-smart-post-search-field sp-smart-post-live-filter-btn <?php echo esc_attr( $option_global_typo_class ); ?>">
					<?php if ( $enable_search_icon ) : ?>
						<span class="sp-smart-post-search-field-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 100 114" fill="none">
								<path d="M100 99.9729L67.2321 66.8416C71.6964 60.6295 74.3527 52.9924 74.3527 44.7541C74.3527 24.0248 57.6786 7.14748 37.1875 7.14748C16.6741 7.12522 0 24.0026 0 44.7319C0 65.4612 16.6741 82.3385 37.1652 82.3385C46.0491 82.3385 54.1964 79.1768 60.6027 73.8998L93.192 106.875L100 99.9729ZM37.1652 73.6549C21.4062 73.6549 8.57143 60.674 8.57143 44.7319C8.57143 28.7897 21.4062 15.8088 37.1652 15.8088C52.9241 15.8088 65.7589 28.7897 65.7589 44.7319C65.7589 60.674 52.9464 73.6549 37.1652 73.6549Z" fill="black" />
							</svg>
						</span>
					<?php endif; ?>
					<input type="text" id="sp-search-filter" name="sps_search" class="form-control" placeholder="<?php echo esc_attr( $placeholder_text ); ?>" spellcheck="false" data-ms-editor="true">
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
