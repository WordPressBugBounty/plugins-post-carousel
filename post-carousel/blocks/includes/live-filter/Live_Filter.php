<?php
/**
 * Live filter class for Smart Post Show Blocks.
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
 * Pagination block for Smart Post Show.
 *
 * Handles the pagination logic for Smart Post Show blocks.
 */
class Live_Filter extends Block_Base {


	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'live-filter';
		$this->styles     = array( 'sp_smart_post_blocks_google_fonts' );
	}

	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  string $blocks  Nested blocks.
	 * @return string            Rendered HTML
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$unique_id            = $attributes['uniqueId'] ?? '';
		$field_alignment      = $attributes['fieldAlignment'] ?? '';
		$relation             = $attributes['multipleFilterRelation'] ?? '';
		$inner_block_length   = $attributes['innerBlockLength'] ?? '';
		$additional_css_class = $attributes['additionalCssClass'] ?? '';
		$layout               = $attributes['layout'] ?? 'layoutOne';

		$inner_block_width = ( 'full' === $field_alignment && $inner_block_length > 3 ) ? ' sp-width-33' : '';
		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $layout ); ?> sp-smart-post-wrapper sp-smart-<?php echo esc_attr( $field_alignment . $inner_block_width ); ?> <?php echo esc_attr( $additional_css_class ); ?>">
			<div class="sp-smart-post-live-filter-parent" data-relation="<?php echo esc_attr( $relation ); ?>">
				<?php
				switch ( $layout ) {
					case 'layoutOne':
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $content;
						break;

					case 'layoutTwo':
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
						echo $this->render_layout_two( $attributes );

						break;
				}
				?>

			</div>

		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Block render function for layout two.
	 *
	 * @param  array $attributes Block attributes.
	 * @return string            Rendered HTML
	 */
	private function render_layout_two( $attributes ) {
		// Extract attributes.
		$selected_terms    = $attributes['selectedTerms'] ?? array();
		$taxonomy_limit    = $attributes['taxonomyLimit']['device']['Desktop'] ?? 3;
		$item_limit        = $attributes['taxonomyLimit'] ?? array();
		$taxonomy_style    = $attributes['taxonomyStyle'] ?? 'navigation';
		$all_text_label    = $attributes['allTextLabel'] ?? 'All';
		$filter_type       = $attributes['filterType'] ?? 'button';
		$heading_label     = $attributes['headingLabel'] ?? 'Latest Posts';
		$heading_tag       = $attributes['headingTag'] ?? 'h2';
		$heading_style     = $attributes['headingStyle'] ?? '';
		$taxonomy_type     = $attributes['taxonomyType'] ?? '';
		$unique_id         = $attributes['uniqueId'] ?? '';
		$select_terms_type = $attributes['selectTermsType'] ?? '';
		$exclude_terms     = $attributes['excludeTerms'] ?? '';

		$all_taxonomies = get_terms(
			array(
				'taxonomy'   => $taxonomy_type,
				'hide_empty' => false,
			)
		);

		$attributes_data = array(
			'taxonomyLimit' => $item_limit,
			'taxonomyStyle' => $taxonomy_style,
			'filterType'    => $filter_type,
			'uniqueId'      => $unique_id,
		);

		$all_item = array(
			'id'    => 'all',
			'label' => $all_text_label,
			'value' => 'all',
			'slug'  => '',
			'count' => '',
		);

		$all_terms = array();
		if ( ! empty( $all_taxonomies ) && is_array( $all_taxonomies ) ) {
			foreach ( $all_taxonomies as $key => $taxonomy ) {
				$all_terms[] = array(
					'id'    => $key,
					'label' => $taxonomy->name,
					'value' => $taxonomy->term_id,
					'slug'  => $taxonomy->slug,
					'count' => $taxonomy->count,
				);
			}
		}

		$updated_selected_terms = array(
			'specific' => ( ! empty( $selected_terms ) ? $selected_terms : $all_terms ),
			'exclude'  => array_values(
				array_filter(
					$all_terms,
					function ( $term ) use ( $exclude_terms ) {
						foreach ( $exclude_terms as $ex ) {
							if ( $ex['id'] === $term['id'] ) {
								return false;
							}
						}
						return true;
					}
				)
			),
			'all'      => $all_terms,
		);

		$terms_with_all = array_merge( array( $all_item ), $updated_selected_terms[ $select_terms_type ] );

		// Split the array into chunks (pagination).
		$paginated_terms = array_chunk( $terms_with_all, $taxonomy_limit );
		$total_pages     = count( $paginated_terms );

		// Determine display taxonomies.

		$more_taxonomies = array();

		if ( 'button' === $filter_type ) {
			$display_taxonomies = $paginated_terms[0] ?? array();
			$more_taxonomies    = array_slice( $terms_with_all, $taxonomy_limit );
		} else {
			$display_taxonomies = array();
			$more_taxonomies    = $updated_selected_terms[ $select_terms_type ];
		}

		$dropdown_markup = '';
		foreach ( $more_taxonomies as $taxonomy ) {
			$label            = esc_html( $taxonomy['label'] );
			$dropdown_markup .= '<a class="sps-live-filter-nav-link" href="#" data-value="' . $label . '" data-label="' . $label . '">' . $label . '</a>';
		}

		ob_start();
		?>
		<div class="sps-live-filter-layout-two sp-smart-post-live-filter-wrapper"
			data-style="<?php echo esc_attr( $taxonomy_style ); ?>"
			data-current-page="0"
			data-is-dropdown-open="false"
			data-total-pages="<?php echo esc_attr( $total_pages ); ?>">

			<select
				class="sp-d-hidden"
				id="filter-<?php echo esc_attr( $taxonomy_type ); ?>"
				name="tx_<?php echo esc_attr( $taxonomy_type ); ?>"
				data-att="<?php echo esc_attr( wp_json_encode( $attributes_data ) ); ?>">
				<?php

				foreach ( $terms_with_all as $item ) {
					?>

					<option value="<?php echo esc_attr( $item['slug'] ); ?>" data-label="<?php echo esc_html( $item['label'] ); ?>">
						<?php echo esc_html( $item['label'] ); ?>
					</option>
				<?php } ?>
			</select>


			<nav class="sps-live-filter-navbar sp-smart-post-taxonomy-filter ">
				<<?php echo tag_escape( $heading_tag ); ?> class="sps-live-filter-latest-post-btn <?php echo esc_attr( $heading_style ); ?>">
					<?php echo esc_html( $heading_label ); ?>
				</<?php echo tag_escape( $heading_tag ); ?>>

				<div class="sps-live-filter-nav-container ">
					<ul class="sps-live-filter-nav-menu sp-smart-post-live-filter-<?php echo esc_html( $filter_type ); ?>">
						<?php
						if ( ! empty( $display_taxonomies ) ) {
							foreach ( $display_taxonomies as $taxonomy ) :
								$count = $taxonomy['count'] ?? 0;
								$label = $taxonomy['label'] ?? '';
								$slug  = $taxonomy['slug'] ?? '';
								?>
								
								<li class="sps-live-filter-nav-item">
									<a
										class="sps-live-filter-nav-link<?php echo esc_attr( ( 0 === $count ) ? ' disabled' : '' ); ?>"
										href="#"
										data-value="<?php echo esc_html( $slug ); ?>"
										data-label="<?php echo esc_html( $label ); ?>"
										data-default-count="<?php echo esc_html( $count ); ?>"
										aria-disabled="<?php echo esc_attr( ( 0 === $count ) ? 'true' : 'false' ); ?>"
									>
										<?php echo esc_html( $label ); ?>
									</a>
								</li>
								<?php
						endforeach;
						}
						?>
					</ul>

					<ul class="sps-live-filter-nav-menu sp-smart-post-live-filter-buttons sp-smart-post-live-filter-button">
						<?php if ( ! empty( $more_taxonomies ) ) : ?>
							<li class="sps-live-filter-nav-item sps-live-filter-dropdown<?php echo 'navigation' === $taxonomy_style ? ' sps-navigation-style' : ''; ?>">
								<a href="#" class="sps-live-filter-nav-link">
									<?php if ( 'kebabMenu' === $taxonomy_style ) : ?>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
											<path d="M8 8H8.006" stroke="#4E4F52" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M8 12H8.006" stroke="#4E4F52" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M8 4H8.006" stroke="#4E4F52" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									<?php endif; ?>

									<?php if ( 'more' === $taxonomy_style ) : ?>
										<?php echo esc_html( 'button' === $filter_type ? 'More' : $all_text_label ); ?>
										<span class="sps-live-filter-dropdown-arrow">
											<svg
												xmlns="http://www.w3.org/2000/svg"
												width="16"
												height="16"
												viewBox="0 0 24 24"
												fill="none"
												style="vertical-align: middle;">
												<path
													d="M6 9L12 15L18 9"
													stroke="#757575"
													stroke-width="2"
													stroke-linecap="butt"
													stroke-linejoin="miter" />
											</svg>
										</span>
									<?php endif; ?>

									<?php if ( 'navigation' === $taxonomy_style ) : ?>
										<span class="sps-pagination-prev" data-page="0">
											<span class="sps-left-arrow">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="11" viewBox="0 0 6 10" fill="none">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M4.54883 0L-3.76701e-05 5.00373L4.54883 10.0075L5.47375 9.16665L1.68929 5.00374L5.47375 0.840843L4.54883 0Z" fill="#757575" />
												</svg> </span>
										</span>
										<span class="sps-pagination-next" data-page="1">
											<span class="sps-right-arrow">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="11" viewBox="0 0 6 10" fill="none">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M0.924924 0L5.47379 5.00373L0.924925 10.0075L0 9.16665L3.78446 5.00374L6.95387e-07 0.840843L0.924924 0Z" fill="#757575" />
												</svg> </span>
										</span>
									<?php endif; ?>
								</a>

								<?php if ( 'more' === $taxonomy_style || 'kebabMenu' === $taxonomy_style ) : ?>
									<div class="sps-live-filter-dropdown-menu">
										<?php echo wp_kses_post( $dropdown_markup ); ?>
									</div>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					</ul>

				</div>
			</nav>
		</div>

		<?php
		return ob_get_clean();
	}
}
