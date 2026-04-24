<?php
/**
 * Sort filter class for Smart Post Show Blocks.
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
class Sort_Filter extends Block_Base {

	/**
	 * Set block properties.
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'sort-filter';
	}

	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  array  $blocks  blocks.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$unique_id         = $attributes['uniqueId'] ?? '';
		$show_sort_label   = $attributes['showSortLabel'] ?? '';
		$sort_by_label     = $attributes['sortByLabel'] ?? '';
		$filter_type       = $attributes['filterType'] ?? '';
		$option_label      = $attributes['optionLabel'] ?? '';
		$placeholder_label = $attributes['placeholderLabel'] ?? '';
		$choose_order_by   = $attributes['chooseOrderBy'] ?? '';
		$sort_type         = $attributes['sortType'] ?? '';

		$title_global_typo_class  = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$option_global_typo_class = isset( $attributes['optionGlobalTypography']['class'] ) ? $attributes['optionGlobalTypography']['class'] : '';
		$additional_css_class     = $attributes['additionalCssClass'] ?? '';
		ob_start(); ?>

		<div class="sp-smart-post-sort-filter <?php echo esc_attr( $additional_css_class ); ?>">
			<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-live-filter-wrapper">
				<div class='sp-smart-post-sort-filter sp-smart-post-live-filter'>

					<select class='sp-d-hidden' id="filter-sort" name="sps_sort">
						<option value=""><?php echo esc_html( $placeholder_label ); ?></option>
						<?php

						if ( 'order' === $sort_type ) {
							?>
							<option value="ASC">ASC
							</option>
							<option value="DESC">DESC</option>
							<?php
						} elseif ( ! empty( $choose_order_by ) ) {
							foreach ( $choose_order_by as $order_by ) {
								if ( 'both' === $sort_type ) {
									?>
									<option value="<?php echo esc_attr( $order_by['value'] . '_asc' ); ?>">
										<?php echo esc_html( $order_by['order']['asc']['title'] ); ?>
									</option>
									<option value="<?php echo esc_attr( $order_by['value'] . '_des' ); ?>">
										<?php echo esc_html( $order_by['order']['des']['title'] ); ?>
									</option>
									<?php
								} else {
									?>
									<option data-value="<?php echo esc_attr( $order_by['value'] ); ?>"><?php echo esc_html( $order_by['title'] ); ?> </option>
									<?php

								}
							}
						}
						?>
					</select>
					<?php if ( $show_sort_label ) { ?>
						<span class="sp-smart-post-live-filter-label <?php echo esc_attr( $title_global_typo_class ); ?>"><?php echo esc_html( $sort_by_label ); ?></span>
					<?php } ?>
					<?php if ( 'dropdown' === $filter_type ) { ?>
						<button
							class='sp-smart-post-live-filter-btn <?php echo esc_attr( $option_global_typo_class ); ?>'><span><?php echo $option_label ? esc_html( $option_label ) : esc_html( $placeholder_label ); ?></span>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 9L12 15L18 9" stroke="#023047" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</button>
					<?php } ?>
					<ul class="sp-smart-post-live-filter-<?php echo esc_attr( $filter_type ); ?>">
					</ul>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
