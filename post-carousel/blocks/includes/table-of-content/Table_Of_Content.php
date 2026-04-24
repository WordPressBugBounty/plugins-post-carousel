<?php
/**
 * Table of Contents block for Smart Post Show.
 *
 * @package    Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Table of Contents block class.
 */
class Table_Of_Content extends Block_Base {

	/**
	 * Set block properties.
	 */
	protected function set_block_properties() {
		$this->block_name = 'table-of-content';
		$this->scripts    = array( 'sp_smart_post_smart_toc_script' );
		$this->styles     = array(
			'sp_smart_post_blocks_css',
			'sp_smart_post_blocks_style',
			'sp_smart_post_blocks_social_icons_style',
		);

		$this->keywords = array( 'TOC', 'contents', 'post contents', 'table of contents', 'headings' );
	}



	/**
	 * Render the block content.
	 *
	 * @param  array  $attributes Block attributes.
	 * @param  string $content    Block content.
	 * @param  array  $blocks     Block instances.
	 * @return string
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}
		if ( ! is_singular() ) {
			return '';
		}

		// Extract attributes.
		$align_class            = ! empty( $attributes['align'] ) ? 'align' . $attributes['align'] : '';
		$unique_id              = $attributes['uniqueId'] ?? '';
		$supported_heading_tag  = $attributes['supportedHeadingTag'] ?? array();
		$block_name             = isset( $attributes['blockName'] ) ? $attributes['blockName'] : '';
		$title                  = isset( $attributes['tocHeading'] ) ? $attributes['tocHeading'] : 'Table of Contents';
		$offset_top             = isset( $attributes['offsetTop'] ) ? $attributes['offsetTop'] : 50;
		$list_style             = isset( $attributes['listStyle'] ) ? $attributes['listStyle'] : 'bullet';
		$content_alignment      = isset( $attributes['tocAlignment'] ) ? $attributes['tocAlignment'] : 'left';
		$copy_link              = isset( $attributes['copyLink'] ) ? $attributes['copyLink'] : true;
		$smooth_scroll          = $attributes['smoothScroll'] ?? true;
		$toc_collapsed          = isset( $attributes['tocCollapsed'] ) ? $attributes['tocCollapsed'] : false;
		$collapsed_initially    = isset( $attributes['collapsedInitially'] ) ? $attributes['collapsedInitially'] : false;
		$child_item_collapsible = isset( $attributes['childItemCollapsible'] ) ? $attributes['childItemCollapsible'] : false;
		$list_hierarchy         = isset( $attributes['listHierarchy'] ) ? $attributes['listHierarchy'] : true;
		$display_control        = isset( $attributes['displayControl'] ) ? $attributes['displayControl'] : 'static';
		$floating_position      = isset( $attributes['floatingPosition'] ) ? $attributes['floatingPosition'] : 'top-left';

		// New attributes for collapsible icons.
		$collapsible_icon_source       = isset( $attributes['CollapsibleIconSource'] ) ? $attributes['CollapsibleIconSource'] : 'four';
		$collapsible_button_type       = isset( $attributes['CollapsibleButtonType'] ) ? $attributes['CollapsibleButtonType'] : 'icon';
		$collapse_text                 = isset( $attributes['collapseText'] ) ? $attributes['collapseText'] : 'Collapse';
		$expand_text                   = isset( $attributes['expandText'] ) ? $attributes['expandText'] : 'Expand';
		$collapsible_color             = isset( $attributes['collapsibleColor'] ) ? $attributes['collapsibleColor'] : '';
		$collapsible_icon_position     = isset( $attributes['collapsibleIconPosition'] ) ? $attributes['collapsibleIconPosition'] : 'right';
		$child_collapsible_icon_source = isset( $attributes['childCollapsibleIconSource'] ) ? $attributes['childCollapsibleIconSource'] : 'four';
		$heading_hash_url              = isset( $attributes['headingHashUrl'] ) ? $attributes['headingHashUrl'] : false;
		$preset                        = isset( $attributes['preset'] ) ? $attributes['preset'] : 'presetOne';
		$headings                      = $this->sps_get_headings_with_id( $supported_heading_tag );

		// Flatten headings if hierarchy is not enabled.
		if ( ! $list_hierarchy ) {
			$headings = $this->flatten_toc( $headings );
		}

		if ( empty( $headings ) ) {
			if ( current_user_can( 'edit_posts' ) ) {
				// Show message to admin/editor.
				return '<div class="sps-toc-empty">No headings found in this post for table of content.</div>';
			} else {
				return '';
			}
		}
		$floating_position_class = '';
		if ( 'floating' === $display_control ) {
			$floating_position_class = 'sp-toc-floating-' . $floating_position;
		}

		// Define icon SVGs.
		$icon_svgs = array(
			'one'             => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9"     stroke="' . $collapsible_color['color'] . '"  stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'two'             => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none"><path d="M1 1L7 7L13 1"  stroke="' . $collapsible_color['color'] . '"  stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'three'           => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M11.325 16.325L4.225 9.225C3.925 8.925 3.925 8.325 4.225 8.025L5.02499 7.225C5.32499 6.925 5.925 6.925 6.225 7.225L11.925 12.825L17.625 7.225C17.925 6.925 18.525 6.925 18.825 7.225L19.625 8.025C19.925 8.325 19.925 8.925 19.625 9.225L12.525 16.325C12.225 16.725 11.625 16.725 11.325 16.325Z"  fill="' . $collapsible_color['color'] . '" /></svg>',
			'four_collapsed'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M11.75 4C12.1642 4 12.5 4.33579 12.5 4.75V11H18.75C19.1642 11 19.5 11.3358 19.5 11.75C19.5 12.1642 19.1642 12.5 18.75 12.5H12.5V18.75C12.5 19.1642 12.1642 19.5 11.75 19.5C11.3358 19.5 11 19.1642 11 18.75V12.5H4.75C4.33579 12.5 4 12.1642 4 11.75C4 11.3358 4.33579 11 4.75 11H11V4.75C11 4.33579 11.3358 4 11.75 4Z"  fill="' . $collapsible_color['color'] . '"/></svg>',
			'four_expanded'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18.75 11C19.1642 11 19.5 11.3358 19.5 11.75C19.5 12.1642 19.1642 12.5 18.75 12.5H4.75C4.33579 12.5 4 12.1642 4 11.75C4 11.3358 4.33579 11 4.75 11H18.75Z" fill="' . $collapsible_color['color'] . '"/></svg>',
			'five_collapsed'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 4C12.5523 4 13 4.44772 13 5V10.5H18.5C19.0523 10.5 19.5 10.9477 19.5 11.5V12C19.5 12.5523 19.0523 13 18.5 13H13V18.5C13 19.0523 12.5523 19.5 12 19.5H11.5C10.9477 19.5 10.5 19.0523 10.5 18.5V13H5C4.44772 13 4 12.5523 4 12V11.5C4 10.9477 4.44772 10.5 5 10.5H10.5V5C10.5 4.44772 10.9477 4 11.5 4H12Z"  fill="' . $collapsible_color['color'] . '"/></svg>',
			'five_expanded'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18.5625 10.675C19.1148 10.675 19.5625 11.1228 19.5625 11.675V12.175C19.5625 12.7273 19.1148 13.175 18.5625 13.175H5.0625C4.51022 13.175 4.0625 12.7273 4.0625 12.175V11.675C4.0625 11.1228 4.51022 10.675 5.0625 10.675H18.5625Z" fill="' . $collapsible_color['color'] . '"/></svg>',
			'six'             => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M16.925 11.1L17.5249 11.7C17.8249 12 17.8249 12.4 17.5249 12.6L12.325 17.8C12.025 18.1 11.625 18.1 11.425 17.8L6.225 12.6C5.925 12.3 5.925 11.9 6.225 11.7L6.82498 11.1C7.12498 10.8 7.525 10.9 7.725 11.1L10.825 14.3V6.6C10.825 6.2 11.125 6 11.425 6H12.325C12.725 6 12.925 6.3 12.925 6.6V14.3L16.0249 11.1C16.2249 10.9 16.625 10.9 16.925 11.1Z"  fill="' . $collapsible_color['color'] . '"/></svg>',
			'seven_collapsed' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M18.2002 10C18.2002 5.47126 14.5287 1.7998 10 1.7998C5.47126 1.7998 1.7998 5.47126 1.7998 10C1.7998 14.5287 5.47126 18.2002 10 18.2002V20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20V18.2002C14.5287 18.2002 18.2002 14.5287 18.2002 10Z" fill="' . $collapsible_color['color'] . '"/><path d="M14.2994 8.94904H11.051V5.70064C11.051 5.31847 10.7325 5 10.3503 5H9.64968C9.26752 5 8.94904 5.31847 8.94904 5.70064V8.94904H5.70064C5.31847 8.94904 5 9.26752 5 9.64968V10.3503C5 10.7325 5.31847 11.051 5.70064 11.051H8.94904V14.2994C8.94904 14.6815 9.26752 15 9.64968 15H10.3503C10.7325 15 11.051 14.6815 11.051 14.2994V11.051H14.2994C14.6815 11.051 15 10.7325 15 10.3503V9.64968C15 9.26752 14.6815 8.94904 14.2994 8.94904Z" fill="' . $collapsible_color['color'] . '"/></svg>',
			'seven_expanded'  => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M18.2002 10C18.2002 5.47126 14.5287 1.7998 10 1.7998C5.47126 1.7998 1.7998 5.47126 1.7998 10C1.7998 14.5287 5.47126 18.2002 10 18.2002V20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20V18.2002C14.5287 18.2002 18.2002 14.5287 18.2002 10Z" fill="' . $collapsible_color['color'] . '"/><path d="M14.3082 9H5.69182C5.31446 9 5 9.30303 5 9.66667V10.3333C5 10.697 5.31446 11 5.69182 11H14.3082C14.6855 11 15 10.697 15 10.3333V9.66667C15 9.30303 14.6855 9 14.3082 9Z" fill="' . $collapsible_color['color'] . '"/></svg>',
			'eight'           => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 20C7.32891 20 4.8177 18.9598 2.92891 17.0711C1.0402 15.1823 0 12.6711 0 10C0 7.32891 1.0402 4.8177 2.92891 2.92891C4.8177 1.0402 7.32891 0 10 0C12.6711 0 15.1823 1.0402 17.0711 2.92891C18.9598 4.81766 20 7.32891 20 10C20 12.6711 18.9598 15.1823 17.0711 17.0711C15.1823 18.9598 12.6711 20 10 20ZM10 1.5625C7.74625 1.5625 5.62742 2.44016 4.03379 4.03379C2.44016 5.62742 1.5625 7.74629 1.5625 10C1.5625 12.2537 2.44016 14.3726 4.03379 15.9662C5.62742 17.5598 7.74629 18.4375 10 18.4375C12.2537 18.4375 14.3726 17.5598 15.9662 15.9662C17.5598 14.3726 18.4375 12.2537 18.4375 10C18.4375 7.74629 17.5598 5.62742 15.9662 4.03379C14.3726 2.44016 12.2537 1.5625 10 1.5625Z" fill="' . $collapsible_color['color'] . '"/><path d="M14.9308 6.79996C14.7309 6.79996 14.5309 6.87625 14.3784 7.02879L10.001 11.4061L5.62371 7.02879C5.31859 6.72367 4.82394 6.72367 4.51886 7.02879C4.21378 7.33391 4.21375 7.82855 4.51886 8.13363L9.44863 13.0634C9.75375 13.3685 10.2484 13.3685 10.5535 13.0634L15.4832 8.13363C15.7884 7.82852 15.7884 7.33387 15.4832 7.02879C15.3307 6.87625 15.1308 6.79996 14.9308 6.79996Z" fill="' . $collapsible_color['color'] . '"/></svg>',
		);

		// Get the appropriate icon based on source and expanded state.
		$get_collapsible_icon = function ( $is_expanded ) use ( $collapsible_icon_source, $icon_svgs ) {
			switch ( $collapsible_icon_source ) {
				case 'one':
					return $icon_svgs['one'];
				case 'two':
					return $icon_svgs['two'];
				case 'three':
					return $icon_svgs['three'];
				case 'four':
					return $is_expanded ? $icon_svgs['four_expanded'] : $icon_svgs['four_collapsed'];
				case 'five':
					return $is_expanded ? $icon_svgs['five_expanded'] : $icon_svgs['five_collapsed'];
				case 'six':
					return $icon_svgs['six'];
				case 'seven':
					return $is_expanded ? $icon_svgs['seven_expanded'] : $icon_svgs['seven_collapsed'];
				case 'eight':
					return $icon_svgs['eight'];
				default:
					return $is_expanded ? $icon_svgs['four_expanded'] : $icon_svgs['four_collapsed'];
			}
		};

		// Get the appropriate child icon based on source and expanded state.
		$get_child_collapsible_icon = function ( $is_expanded ) use ( $child_collapsible_icon_source, $icon_svgs ) {
			switch ( $child_collapsible_icon_source ) {
				case 'one':
					return $icon_svgs['one'];
				case 'two':
					return $icon_svgs['two'];
				case 'three':
					return $icon_svgs['three'];
				case 'four':
					return $is_expanded ? $icon_svgs['four_expanded'] : $icon_svgs['four_collapsed'];
				case 'five':
					return $is_expanded ? $icon_svgs['five_expanded'] : $icon_svgs['five_collapsed'];
				case 'six':
					return $icon_svgs['six'];
				case 'seven':
					return $is_expanded ? $icon_svgs['seven_expanded'] : $icon_svgs['seven_collapsed'];
				case 'eight':
					return $icon_svgs['eight'];
				default:
					return $is_expanded ? $icon_svgs['four_expanded'] : $icon_svgs['four_collapsed'];
			}
		};

		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>"
			class="sp-table-of-content-toc sp-smart-post-<?php echo esc_attr( $block_name ); ?> <?php echo esc_attr( $align_class ); ?> sp-toc-position-<?php echo esc_attr( $display_control ); ?> <?php echo esc_attr( $floating_position_class ); ?>"
			data-smooth-scroll="<?php echo esc_attr( $smooth_scroll ? 'true' : 'false' ); ?>"
			data-offset-top="<?php echo esc_attr( $offset_top ); ?>"
			data-button-type="<?php echo esc_attr( $collapsible_button_type ); ?>"
			data-collapse-text="<?php echo esc_attr( $collapse_text ); ?>"
			data-expand-text="<?php echo esc_attr( $expand_text ); ?>"
			data-icon-source="<?php echo esc_attr( $collapsible_icon_source ); ?>"
			data-child-icon-source="<?php echo esc_attr( $child_collapsible_icon_source ); ?>"
			data-preset="<?php echo esc_attr( $preset ); ?>"
			data-hash-url="<?php echo esc_attr( $heading_hash_url ); ?>">
			<div class="sps-toc-wrapper"
				data-icons='<?php echo esc_attr( wp_json_encode( $icon_svgs ) ); ?>'>
				
				
				<div class="sps-toc-header-row">
					<div class="sps-toc-header">
						<strong class="sps-toc-title"><?php echo esc_html( $title ); ?></strong>

						<?php if ( 'icon' === $collapsible_button_type && 'besideTitle' === $collapsible_icon_position && $toc_collapsed ) : ?>
							<button
								class="sps-toc-main-toggle <?php echo ! $collapsed_initially ? 'expanded' : ''; ?>"
								aria-label="<?php echo $collapsed_initially ? esc_html( $expand_text ) : esc_html( $collapse_text ); ?>"
								aria-expanded="<?php echo ! $collapsed_initially ? 'true' : 'false'; ?>">

								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $get_collapsible_icon( ! $collapsed_initially );
								?>

							</button>
						<?php endif; ?>

					</div>
					<?php if ( $toc_collapsed ) : ?>
						<div class="sp-main-collapse-toggle">

							<?php if ( 'right' === $collapsible_icon_position || 'icon' !== $collapsible_button_type ) : ?>
								<button
									class="sps-toc-main-toggle <?php echo ! $collapsed_initially ? 'expanded' : ''; ?>"
									aria-label="<?php echo $collapsed_initially ? esc_html( $expand_text ) : esc_html( $collapse_text ); ?>"
									aria-expanded="<?php echo ! $collapsed_initially ? 'true' : 'false'; ?>">

									<?php if ( 'icon' === $collapsible_button_type ) : ?>
										<?php
											// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											echo $get_collapsible_icon( ! $collapsed_initially );
										?>

									<?php elseif ( 'text' === $collapsible_button_type ) : ?>
										<?php echo $collapsed_initially ? esc_html( $expand_text ) : esc_html( $collapse_text ); ?>
									<?php endif; ?>

								</button>
							<?php endif; ?>

						</div>

					<?php endif; ?>
				</div>

				<!-- Always render the container but hide it with CSS when initially collapsed -->
				<div class="sps-toc-container <?php echo esc_attr( $preset ); ?><?php echo ( $toc_collapsed && $collapsed_initially ) ? ' sps-toc-hidden' : ''; ?>">
					<?php if ( in_array( $preset, array( 'presetThree', 'presetFour', 'presetFive' ) ) ) : ?>
						<div class="sps-toc-indicator"></div>
					<?php endif; ?>
					<ul class="sps-toc-list sps-toc-style-<?php echo esc_attr( $list_style ); ?>">
						<?php $this->render_toc_items( $headings, $list_style, 0, $content_alignment, $copy_link, $child_item_collapsible, $get_child_collapsible_icon, $heading_hash_url, $preset ); ?>
					</ul>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Flatten TOC structure if hierarchy is disabled.
	 *
	 * @param array $items TOC items.
	 * @return array Flattened TOC items.
	 */
	private function flatten_toc( $items ) {
		$result = array();

		foreach ( $items as $item ) {
			// Add current item.
			$result[] = array(
				'id'    => $item['id'],
				'text'  => $item['text'],
				'level' => $item['level'],
			);

			// Recursively add children.
			if ( ! empty( $item['children'] ) ) {
				$children = $this->flatten_toc( $item['children'] );
				$result   = array_merge( $result, $children );
			}
		}

		return $result;
	}

	/**
	 * Recursive function to render TOC items.
	 *
	 * @param array    $items Array of TOC items to render.
	 * @param string   $list_style The list style to apply.
	 * @param int      $depth Current depth level.
	 * @param string   $content_alignment for content alignment.
	 * @param string   $copy_link to copy link.
	 * @param bool     $child_item_collapsible Whether child items can be collapsed.
	 * @param callable $get_child_collapsible_icon Function to get child icon.
	 * @param string   $heading_hash_url toggle.
	 * @param string   $preset The current preset.
	 */
	private function render_toc_items( $items, $list_style = '', $depth = 0, $content_alignment = 'left', $copy_link = true, $child_item_collapsible = false, $get_child_collapsible_icon = null, $heading_hash_url = true, $preset = 'presetOne' ) {
		foreach ( $items as $item ) {
			if ( empty( $item['id'] ) || empty( $item['text'] ) ) {
				continue;
			}

			$has_children = ! empty( $item['children'] ) && is_array( $item['children'] );
			$is_selected  = false; // This will be handled in JavaScript.
			?>
			<li class="sps-toc-item <?php echo $has_children ? 'has-children' : ''; ?> sps-toc-level-<?php echo esc_attr( $item['level'] ); ?>"
				data-depth="<?php echo esc_attr( $depth ); ?>"
				data-item-id="<?php echo esc_attr( $item['id'] ); ?>">
				<div class="sps-toc-link-wrapper sps-toc-<?php echo esc_attr( $content_alignment ); ?>  ">
					<a href="#<?php echo esc_attr( $item['id'] ); ?>" class="sps-toc-link">
						<?php if ( 'none' !== $list_style && 'bullet' !== $list_style ) : ?>
							<span class="sps-toc-number"></span>
						<?php endif; ?>
						<span class="sps-toc-text"><?php echo esc_html( $item['text'] ); ?></span>
					</a>

					<div class="sps-toc-actions">
						<?php if ( $copy_link ) : ?>
							<button class="sps-toc-copy"
								data-clipboard-text="<?php echo esc_url( get_permalink() . '#' . $item['id'] ); ?>"
								title="Copy link"
								aria-label="Copy link to this section">
								#
							</button>
						<?php endif; ?>

						<?php if ( $has_children && $child_item_collapsible && is_callable( $get_child_collapsible_icon ) ) : ?>
							<button
								class="sps-toc-toggle expanded"
								aria-label="<?php echo esc_attr__( 'Collapse section', 'post-carousel' ); ?>"
								aria-expanded="true">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $get_child_collapsible_icon( true );
								?>
							</button>

						<?php endif; ?>
					</div>
				</div>

				<?php if ( $has_children ) : ?>
					<ul class="sps-toc-sublist">
						<?php $this->render_toc_items( $item['children'], $list_style, $depth + 1, $content_alignment, $copy_link, $child_item_collapsible, $get_child_collapsible_icon, $heading_hash_url, $preset ); ?>
					</ul>
				<?php endif; ?>
			</li>
			<?php
		}
	}


	/**
	 * Sps_get_headings_with_id function
	 *
	 * @param array $supported_heading_tag All heading tags.
	 * @return array
	 */
	private function sps_get_headings_with_id( $supported_heading_tag ) {
		$content  = get_the_content();
		$headings = array();

		// Extract allowed heading numbers from $supported_heading_tag.
		$allowed_levels = array_map(
			function ( $item ) {
				return intval( substr( $item['value'], 1 ) ); // 'h2' → 2
			},
			$supported_heading_tag
		);

		$pattern = '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is';

		if ( preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
			$stack = array();

			foreach ( $matches as $m ) {
				$level = intval( $m[1] );

				// Skip headings not in allowed_levels.
				if ( ! in_array( $level, $allowed_levels ) ) {
					continue;
				}

				$attrs = $m[2];
				$inner = $m[3];
				$html  = $m[0];

				if ( preg_match( '/id="([^"]+)"/', $attrs, $id_match ) ) {
					$id = $id_match[1];
				} else {
					$id   = $this->generate_heading_id( wp_strip_all_tags( $inner ) );
					$html = preg_replace(
						'/<h([1-6])([^>]*)>/i',
						'<h$1 id="' . $id . '"$2>',
						$html,
						1
					);
				}

				$item = array(
					'level'    => $level,
					'text'     => wp_strip_all_tags( $inner ),
					'id'       => $id,
					'html'     => $html,
					'children' => array(),
				);

				// Build nested structure.
				while ( ! empty( $stack ) && $level <= end( $stack )['level'] ) {
					array_pop( $stack );
				}

				if ( empty( $stack ) ) {
					$headings[] = $item;
					$stack[]    = &$headings[ count( $headings ) - 1 ];
				} else {
					$parent               = &$stack[ count( $stack ) - 1 ];
					$parent['children'][] = $item;
					$stack[]              = &$parent['children'][ count( $parent['children'] ) - 1 ];
				}

				unset( $item, $parent );
			}
		}

		return $headings;
	}

	/**
	 * Generate heading id function
	 *
	 * @param string $text Heading text.
	 * @return string
	 */
	private function generate_heading_id( $text ) {
		$id = mb_strtolower( $text, 'UTF-8' );
		$id = preg_replace( '/[\s_.,!?;:()\[\]{}"\'`~@#$%^&*+=<>\/\\\\|]+/u', '-', $id );
		$id = preg_replace( '/[^\p{L}\p{N}-]/u', '', $id );
		$id = preg_replace( '/-+/', '-', $id );
		$id = trim( $id, '-' );

		if ( empty( $id ) ) {
			$id = 'heading-' . uniqid();
		}
		return $id;
	}
}
