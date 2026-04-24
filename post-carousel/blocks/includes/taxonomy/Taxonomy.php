<?php
/**
 * Taxonomy Block Class for Smart Post Show Pro
 *
 * @package    Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

defined( 'ABSPATH' ) || exit;

/**
 * Handles rendering of the Taxonomy block
 */
class Taxonomy extends Block_Base {


	/**
	 * Sets block properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'taxonomy';

		$this->styles = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_google_fonts', 'sp_smart_post_blocks_social_icons_style' );
	}

	/**
	 * Renders the Taxonomy block (consolidated single-method version)
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Existing block content.
	 * @param array  $blocks   array.
	 * @return string            Rendered HTML
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		// Get settings with fallbacks.
		$attributes['page_id'] = get_the_ID();
		unset( $attributes['dynamicCss'], $attributes['fontListsEditPage'], $attributes['fontLists'] );
		$unique_id                        = $attributes['uniqueId'] ?? '';
		$block_name                       = sanitize_html_class( $attributes['blockName'] ?? '' );
		$layout                           = $attributes['layout'] ?? 'taxonomy-layout-one';
		$no_result_found_text             = $attributes['noResultFoundText'] ?? 'No Data Found';
		$taxonomy_type                    = $attributes['taxonomyType'] ?? 'category';
		$empty_category                   = $attributes['emptyCategory'] ?? true;
		$all_taxonomy_term                = $attributes['allTaxonomyTerm'] ?? true;
		$include_terms                    = $attributes['SelectTerms'] ?? array();
		$exclude_terms                    = $attributes['excludeTerms'] ?? array();
		$limit                            = $attributes['limit'] ?? 6;
		$is_layout_five_six               = in_array( $layout, array( 'taxonomy-layout-five', 'taxonomy-layout-six' ) );
		$align_class                      = ! empty( $attributes['align'] ) ? 'align' . $attributes['align'] : '';
		$title_enable                     = $attributes['titleEnable'] ?? true;
		$display_overly_thum              = $attributes['displayOverlyThum'] ?? true;
		$display_overly_hover_thum        = $attributes['displayOverlyHoverThum'] ?? true;
		$after_count                      = $attributes['afterCount'] ?? ')';
		$before_count                     = $attributes['beforeCount'] ?? '(';
		$count_enable                     = $attributes['countEnable'] ?? true;
		$content_multi_color_bg           = $attributes['contentMultiColorBg'] ?? true;
		$icon                             = $attributes['icon'] ?? true;
		$show_hide_divider                = $attributes['showHideDivider'] ?? true;
		$show_excerpt                     = $attributes['excerptShow'] ?? false;
		$taxonomy_icon_style              = $attributes['taxonomyIconStyle'] ?? '';
		$counter_multi_color_bg           = $attributes['counterMultiColorBg'] ?? '';
		$excerpt_length                   = $attributes['excerptLength'] ?? 7;
		$post_card_bg                     = $attributes['postCardBg'] ?? array();
		$image_overlay_color              = $attributes['imageOverlayColor'] ?? '';
		$image_overlay_hover_color        = $attributes['imageOverlayHoverColor'] ?? '';
		$image_overlay_custom_color       = $attributes['imageOverlayCustomColor'] ?? '';
		$image_overlay_custom_hover_color = $attributes['imageOverlayCustomHoverColor'] ?? '';
		$image_enable                     = $attributes['imageEnable'] ?? true;
		$hover_effect                     = $attributes['hoverEffect'] ?? 'normal';
		$image_overlay                    = $attributes['imageOverlay'] ?? '';
		$hover_animation                  = $attributes['hoverAnimation'] ?? '';
		$title_global_typography_class    = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$excerpt_global_typography_class  = isset( $attributes['excerptGlobalTypography']['class'] ) ? $attributes['excerptGlobalTypography']['class'] : '';
		$counter_global_typography_class  = isset( $attributes['counterGlobalTypography']['class'] ) ? $attributes['counterGlobalTypography']['class'] : '';

		$base_args = array(
			'layout'                          => $layout,
			'title_enable'                    => $title_enable,
			'after_count'                     => $after_count,
			'before_count'                    => $before_count,
			'count_enable'                    => $count_enable,
			'show_excerpt'                    => $show_excerpt,
			'excerpt_length'                  => $excerpt_length,
			'title_global_typography_class'   => $title_global_typography_class,
			'excerpt_global_typography_class' => $excerpt_global_typography_class,
			'counter_global_typography_class' => $counter_global_typography_class,
		);

		$args_five_six = array_merge(
			$base_args,
			array(
				'image_overlay' => $image_overlay,
				'hover_effect'  => $hover_effect,
				'image_enable'  => $image_enable,
			)
		);

		$args_default = array_merge(
			$base_args,
			array(
				'display_overly_thum'              => $display_overly_thum,
				'display_overly_hover_thum'        => $display_overly_hover_thum,
				'content_multi_color_bg'           => $content_multi_color_bg,
				'icon'                             => $icon,
				'show_hide_divider'                => $show_hide_divider,
				'taxonomy_icon_style'              => $taxonomy_icon_style,
				'counter_multi_color_bg'           => $counter_multi_color_bg,
				'hover_animation'                  => $hover_animation,
				'post_card_bg'                     => $post_card_bg,
				'image_overlay_color'              => $image_overlay_color,
				'image_overlay_hover_color'        => $image_overlay_hover_color,
				'image_overlay_custom_color'       => $image_overlay_custom_color,
				'image_overlay_custom_hover_color' => $image_overlay_custom_hover_color,

			)
		);

		// Loader markup before fetching terms.
		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>" class="sp-smart-post-<?php echo esc_attr( $block_name ); ?> <?php echo esc_attr( $align_class ); ?> ">

			<!-- Loader (Visible on load) -->
			<div class="sp-taxonomy-loader" id="sp-loader-<?php echo esc_attr( $unique_id ); ?>">
				<img src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . '../../../public/assets/img/preloader.svg' ); ?>" alt="Loading..." />
			</div>
			<?php

			$terms = Helper::get_custom_terms_by_type( $taxonomy_type, $empty_category, $include_terms, $limit, $exclude_terms, $all_taxonomy_term );

			?>
			<!-- Rendered Terms -->
			<div class="sp-smart-post-taxonomy-render" id="sp-content-<?php echo esc_attr( $unique_id ); ?>">
				<?php if ( ! empty( $terms ) ) : ?>
					<?php foreach ( $terms as $term ) : ?>
						<?php if ( $is_layout_five_six ) : ?>
							<?php echo wp_kses_post( $this->render_five_six_layout( $term, $args_five_six ) ); ?>
						<?php else : ?>
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
							echo $this->render_default_layout( $term, $args_default );
							?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else : ?>
					<p class="sp-taxonomy-no-results">
						<?php
						echo esc_html( ! empty( $no_result_found_text ) ? $no_result_found_text : 'No result found.' );
						?>

					</p>
				<?php endif; ?>

			</div>

			<!-- Inline style and loader logic -->
			<style>
				.sp-taxonomy-loader {
					text-align: center;
					padding: 40px 0;
				}

				.sp-loader-svg {
					width: 50px;
					height: 50px;
				}
			</style>
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					const loader = document.getElementById('sp-loader-<?php echo esc_js( $unique_id ); ?>');
					const content = document.getElementById('sp-content-<?php echo esc_js( $unique_id ); ?>');

					if (loader && content) {
						loader.style.display = 'none';
						content.style.display = 'grid';
					}
				});
			</script>

		</div>
		<?php

		return $content . ob_get_clean();
	}
	/**
	 * Renders the default_layout.
	 *
	 * @param object $term item data.
	 * @param array  $args of the attributes.
	 * @return string            Rendered HTML
	 */
	private function render_default_layout( $term, $args = array() ) {

		$layout                           = $args['layout'] ?? '';
		$title_enable                     = $args['title_enable'] ?? false;
		$display_overly_thum              = $args['display_overly_thum'] ?? '';
		$display_overly_hover_thum        = $args['display_overly_hover_thum'] ?? '';
		$after_count                      = $args['after_count'] ?? 0;
		$before_count                     = $args['before_count'] ?? 0;
		$count_enable                     = $args['count_enable'] ?? false;
		$content_multi_color_bg           = $args['content_multi_color_bg'] ?? '';
		$icon                             = $args['icon'] ?? '';
		$show_hide_divider                = $args['show_hide_divider'] ?? false;
		$show_excerpt                     = $args['show_excerpt'] ?? false;
		$taxonomy_icon_style              = $args['taxonomy_icon_style'] ?? '';
		$counter_multi_color_bg           = $args['counter_multi_color_bg'] ?? '';
		$excerpt_length                   = $args['excerpt_length'] ?? 0;
		$hover_animation                  = $args['hover_animation'] ?? '';
		$post_card_bg                     = $args['post_card_bg'] ?? '';
		$image_overlay_color              = $args['image_overlay_color'] ?? '';
		$image_overlay_hover_color        = $args['image_overlay_hover_color'] ?? '';
		$image_overlay_custom_color       = $args['image_overlay_custom_color'] ?? '';
		$image_overlay_custom_hover_color = $args['image_overlay_custom_hover_color'] ?? '';
		$should_show_count_in_name        = $count_enable && in_array( $layout, array( 'taxonomy-layout-four', 'taxonomy-layout-eight' ), true );
		$should_show_before_after_count   = in_array( $layout, array( 'taxonomy-layout-seven', 'taxonomy-layout-eight' ), true );
		$placeholder_img                  = apply_filters( 'pcp_no_thumb_placeholder', SP_PC_URL . 'public/assets/img/placeholder.png' );
		$title_global_typography_class    = $args['title_global_typography_class'] ?? '';
		$excerpt_global_typography_class  = $args['excerpt_global_typography_class'] ?? '';
		$counter_global_typography_class  = $args['counter_global_typography_class'] ?? '';

		$args = array(
			'term'                             => $term,
			'placeholder_img'                  => $placeholder_img,
			'display_overly_thum'              => $display_overly_thum,
			'display_overly_hover_thum'        => $display_overly_hover_thum,
			'post_card_bg'                     => $post_card_bg,
			'image_overlay_color'              => $image_overlay_color,
			'image_overlay_hover_color'        => $image_overlay_hover_color,
			'image_overlay_custom_color'       => $image_overlay_custom_color,
			'image_overlay_custom_hover_color' => $image_overlay_custom_hover_color,
			'layout'                           => $layout,
		);

		$hover = $this->hover_animate( $hover_animation ?? '', $layout );

		// --- Inline style variables (overlay effects) ---
		$style_array = ( 'taxonomy-layout-three' !== $layout )
			? $this->get_style( $args )
			: array();

		$style_array['--transformValue'] = $hover['transformValue'] ?? '';
		$style_array['--initialValue']   = $hover['initialValue'] ?? '';

		$inline_style = '';
		foreach ( $style_array as $key => $value ) {
			if ( ! empty( $value ) ) {
				$inline_style .= esc_attr( $key ) . ':' . esc_attr( $value ) . ';';
			}
		}

		// --- Counter style for inline badge ---
		$counter_style_attr = '';
		if ( $should_show_count_in_name && $counter_multi_color_bg && ! empty( $term->category_color ) ) {
			$counter_style_attr = 'background:' . esc_attr( $term->category_color ) . ';';
		}

		// --- Main wrapper background for layout-8 and layout-3 ---
		$style = array();

		$layout_four_eight = array( 'taxonomy-layout-four', 'taxonomy-layout-eight' );

		if ( in_array( $layout, $layout_four_eight, true ) ) {
			$style['background'] = ! empty( $term->category_color ) ? $term->category_color : '#FFFFFF';
		}

		if ( 'taxonomy-layout-three' === $layout ) {
			$style = array_merge( $style, $this->get_style( $args ) );
		}

		$style_attr = '';
		foreach ( $style as $key => $value ) {
			if ( ! empty( $value ) ) {
				$style_attr .= esc_attr( $key ) . ':' . esc_attr( $value ) . ';';
			}
		}

		$should_show_excerpt = $show_excerpt && in_array(
			$layout,
			array(
				'taxonomy-layout-one',
				'taxonomy-layout-two',
				'taxonomy-layout-three',
				'taxonomy-layout-five',
				'taxonomy-layout-six',
			),
			true
		);

		ob_start();
		?>
		<div style="<?php echo esc_attr( $inline_style ); ?>"


			class="<?php echo esc_attr( $this->get_taxonomy_class( $layout, $display_overly_thum, $display_overly_hover_thum, $show_hide_divider ) ); ?>">
			<div style="<?php echo esc_attr( $style_attr ); ?>"
				class="
				<?php
				echo esc_attr(
					implode(
						' ',
						array_filter(
							array(
								'sp-smart-post-taxonomy-name',
								( 'taxonomy-layout-three' === $layout ) ? 'sp-smart-post-taxonomy-name-layout-three' : '',
								( $display_overly_thum && 'taxonomy-layout-three' === $layout ) ? 'sp-taxonomy-overlay-three' : '',
								( $display_overly_hover_thum && 'taxonomy-layout-three' === $layout ) ? 'sp-taxonomy-hover-overlay-three' : '',
							)
						)
					)
				);
				?>
				">
				<?php if ( $title_enable ) : ?>

					<div class="sps-taxonomy-title-wrapper">
						<?php if ( ! empty( $icon ) ) : ?>
							<span style="z-index: 2;" class="sp-smart-post-taxonomy-icon">
								<i class="sp-icon-left-<?php echo esc_attr( $taxonomy_icon_style ); ?>"></i>
							</span>
						<?php endif; ?>
						<a href="<?php echo esc_url( $term->term_link ); ?>" class="sps-taxonomy-terms-link">
							<span class="sps-taxonomy-title-name <?php echo esc_attr( $title_global_typography_class ); ?>"><?php echo esc_html( $term->name ?? '' ); ?></span>
						</a>
					</div>

				<?php endif; ?>

				<?php if ( $should_show_count_in_name ) : ?>
					<div class="sp-smart-post-taxonomy-count" style="<?php echo esc_attr( $counter_style_attr ); ?>">
						<span class="<?php echo esc_attr( $counter_global_typography_class ); ?>">
							<?php echo esc_html( $should_show_before_after_count ? $before_count : '' ); ?>
							<?php echo esc_html( $term->count ?? '' ); ?>
							<?php echo esc_html( 'taxonomy-layout-eight' === $layout ? $after_count : '' ); ?>
						</span>
					</div>
				<?php endif; ?>


				<?php if ( ! empty( $term->description ) && $should_show_excerpt ) : ?>
					<p class="taxonomy-excerpt <?php echo esc_attr( $excerpt_global_typography_class ); ?>">
						<?php echo esc_html( Helper::sp_string_trim( $term->description ?? '', $excerpt_length ) ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( $count_enable && ! $should_show_count_in_name ) : ?>

				<div class="sp-smart-post-taxonomy-count"
					style="
					<?php
					echo esc_attr(
						$counter_multi_color_bg && ! empty( $term->category_color )
							? 'background:' . esc_attr( $term->category_color ) . ';'
							: ''
					);
					?>
							">

					<span class="<?php echo esc_attr( $counter_global_typography_class ); ?>">
						<?php
						if ( $should_show_before_after_count ) {
							echo esc_html( $before_count );
						}
						echo esc_html( $term->count );
						if ( $should_show_before_after_count ) {
							echo esc_html( $after_count );
						}
						echo ' ';
						if ( 'taxonomy-layout-three' === $layout ) {
							$post_label = ( $term->count <= 1 ) ? 'Post' : 'Posts';
							echo '<span class="taxonomy-hide-post-text">' . esc_html( $post_label ) . '</span>';
						}
						?>
					</span>
				</div>

			<?php endif; ?>
		</div>
		<?php

		return ob_get_clean();
	}

	/**
	 * Renders the five six layout.
	 *
	 * @param object $term item data.
	 * @param array  $args of the attributes.
	 * @return string            Rendered HTML
	 */
	private function render_five_six_layout( $term, $args = array() ) {

		$title_enable                    = $args['title_enable'] ?? false;
		$after_count                     = $args['after_count'] ?? 0;
		$before_count                    = $args['before_count'] ?? 0;
		$count_enable                    = $args['count_enable'] ?? false;
		$show_excerpt                    = $args['show_excerpt'] ?? false;
		$excerpt_length                  = $args['excerpt_length'] ?? 0;
		$layout                          = $args['layout'] ?? '';
		$image_overlay                   = $args['image_overlay'] ?? '';
		$hover_effect                    = $args['hover_effect'] ?? '';
		$image_enable                    = $args['image_enable'] ?? false;
		$title_global_typography_class   = $args['title_global_typography_class'] ?? '';
		$excerpt_global_typography_class = $args['excerpt_global_typography_class'] ?? '';
		$counter_global_typography_class = $args['counter_global_typography_class'] ?? '';

		$placeholder_img = SP_PC_URL . 'public/assets/img/placeholder.png';
		$placeholder_img = apply_filters( 'pcp_no_thumb_placeholder', $placeholder_img );
		$thumbnail_url   = $term->category_thumbnail;
		if ( empty( $thumbnail_url ) ) {
			$thumbnail_url = $placeholder_img;
		}

		$should_show_excerpt = $show_excerpt && in_array(
			$layout,
			array(
				'taxonomy-layout-one',
				'taxonomy-layout-two',
				'taxonomy-layout-three',
				'taxonomy-layout-five',
				'taxonomy-layout-six',
			),
			true
		);

		ob_start();
		?>

		<div class="sp-smart-post-taxonomy-info taxonomy-layout-five-six sp-smart-post-card">

			<div
				class="taxonomy-layout-five-six-img-div sp-smart-post-card-image img-<?php echo esc_attr( $hover_effect ); ?>"
				style="
					--bg-url: url(<?php echo esc_url( $thumbnail_url ); ?>);
					--hover-bg-url: url(<?php echo esc_url( $thumbnail_url ); ?>);
				">
				<?php if ( $image_enable ) : ?>
					<img
						class="taxonomy-layout-five-six-img"
						src="<?php echo esc_url( $thumbnail_url ); ?>"
						alt="<?php echo esc_attr( $thumbnail_url ); ?>" />
					<?php if ( 'noOverlay' !== $image_overlay ) : ?>
						<div
							class="taxonomy-image-overlay overlay-<?php echo esc_attr( $image_overlay ); ?> pointer-none"
							style="background: <?php echo esc_attr( $this->overlay_random_solid_color( $image_overlay ) ); ?>;"></div>
					<?php endif; ?>
				<?php endif; ?>


			</div>

			<div class="sp-smart-post-taxonomy-name">
				<div>

					<span class="sp-smart-post-taxonomy-icon"></span>

					<?php if ( $title_enable ) : ?>
						<a href="<?php echo esc_url( $term->term_link ); ?>" class="sps-taxonomy-terms-link">
							<span class="sps-taxonomy-title-name <?php echo esc_attr( $title_global_typography_class ); ?>"><?php echo esc_html( $term->name ?? '' ); ?></span>
						</a>
					<?php endif; ?>

					<?php if ( $count_enable ) : ?>
						<span class="sp-smart-post-taxonomy-count">
							<span class="<?php echo esc_attr( $counter_global_typography_class ); ?>">
								<?php echo esc_html( $before_count ?? '' ); ?>
								<?php echo esc_html( $term->count ?? 0 ); ?>
								<?php echo esc_html( $after_count ?? '' ); ?>
							</span>
						</span>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $term->description ) && $should_show_excerpt ) : ?>
					<p class="taxonomy-excerpt <?php echo esc_attr( $excerpt_global_typography_class ); ?>">
						<?php echo esc_html( Helper::sp_string_trim( $term->description ?? '', $excerpt_length ) ); ?>
					</p>
				<?php endif; ?>
			</div>



		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Renders the five six layout.
	 *
	 * @param string $layout                    Layout name.
	 * @param bool   $display_overly_thum       Whether to show overlay thumbnail.
	 * @param bool   $display_overly_hover_thum Whether to show hover overlay thumbnail.
	 * @param bool   $show_hide_divider Whether hide or show.
	 *
	 * @return string HTML class names.
	 */
	protected function get_taxonomy_class( $layout, $display_overly_thum, $display_overly_hover_thum, $show_hide_divider ) {
		$classes = array(
			'sp-smart-post-taxonomy-info',
			( 'taxonomy-layout-one' !== $layout ) ? 'sp-smart-post-taxonomy-info-overlay' : '',
			$display_overly_thum ? 'sp-taxonomy-overlay' : '',
			$display_overly_hover_thum ? 'sp-taxonomy-hover-overlay' : '',
			( 'taxonomy-layout-one' === $layout && $show_hide_divider ) ? 'sp-smart-post-taxonomy-info-layout-one' : '',
		);

		// Filter out empty values and join with spaces.
		return implode( ' ', array_filter( $classes ) );
	}

	/**
	 * Renders the five six layout.
	 *
	 * @param array $args item data.
	 * @return object.
	 */
	protected function get_style( $args ) {

		$term                             = $args['term'];
		$placeholder_img                  = $args['placeholder_img'];
		$display_overly_thum              = $args['display_overly_thum'];
		$display_overly_hover_thum        = $args['display_overly_hover_thum'];
		$post_card_bg                     = $args['post_card_bg'];
		$image_overlay_color              = $args['image_overlay_color'];
		$image_overlay_hover_color        = $args['image_overlay_hover_color'];
		$image_overlay_custom_color       = $args['image_overlay_custom_color'];
		$image_overlay_custom_hover_color = $args['image_overlay_custom_hover_color'];
		$layout                           = $args['layout'];
		$get_overlay_colors               = $this->get_overlay_colors( $image_overlay_color, $image_overlay_hover_color, $image_overlay_custom_color, $image_overlay_custom_hover_color, $layout );
		$style                            = array();

		// Make sure the thumbnail is a valid URL string.
		$thumbnail_url = '';
		if ( ! empty( $term->category_thumbnail ) ) {
			if ( is_array( $term->category_thumbnail ) && isset( $term->category_thumbnail['url'] ) ) {
				$thumbnail_url = $term->category_thumbnail['url'];
			} elseif ( is_string( $term->category_thumbnail ) ) {
				$thumbnail_url = $term->category_thumbnail;
			}
		}
		if ( empty( $thumbnail_url ) ) {
			$thumbnail_url = $placeholder_img;
		}

		$style['--bg-url'] = $display_overly_thum
			? 'url(' . esc_url( $thumbnail_url ) . ')'
			: 'none';

		$style['--hover-bg-url'] = $display_overly_hover_thum
			? 'url(' . esc_url( $thumbnail_url ) . ')'
			: $this->color_controls(
				$post_card_bg['hover']['style'] ?? '',
				$post_card_bg['hover']['solidColor'] ?? '',
				$post_card_bg['hover']['gradient'] ?? ''
			);

		$style['--overlay-color']       = $get_overlay_colors['overlayColor'] ?? '';
		$style['--overlay-hover-color'] = $get_overlay_colors['overlayHoverColor'] ?? '';

		return $style;
	}


	/**
	 * Renders the five six layout.
	 *
	 * @param object $color_type item data.
	 * @param object $normal_color image url.
	 * @param string $gradient_color of the method.
	 * @param string $type of the method.
	 * @return object.
	 */
	protected function color_controls( $color_type, $normal_color, $gradient_color, $type = 'normal' ) {
		if ( 'normal' === $type ) {
			$color_type_object = array(
				'transparent' => 'transparent',
				'color'       => $normal_color,
				'gradient'    => $gradient_color,
			);
			return $color_type_object[ $color_type ] ?? $normal_color;
		} else {
			$hover_color_type_object = array(
				'transparentHover' => 'transparent',
				'colorHover'       => $normal_color,
				'gradientHover'    => $gradient_color,
			);
			return $hover_color_type_object[ $color_type ] ?? $normal_color;
		}
	}


	/**
	 * Renders the five six layout.
	 *
	 * @param object $hover_animation item data.
	 * @param object $layout image url.
	 * @return object.
	 */
	protected function hover_animate( $hover_animation, $layout ) {
		$transform_value = '';
		$initial_value   = '';

		switch ( $hover_animation ) {
			case 'zoomIn':
				$transform_value = 'scale(1.05)';
				$initial_value   = 'scale(1)';
				break;
			case 'zoomOut':
				$transform_value = 'scale(1)';
				$initial_value   = 'scale(1.05)';
				break;
			case 'slideLeft':
				$transform_value = 'scale(1.10) translateX(-10px)';
				$initial_value   = 'scale(1.10) translateX(3%)';
				break;
			case 'slideRight':
				$transform_value = 'scale(1.10) translateX(10px)';
				$initial_value   = 'scale(1.10) translateX(-3%)';
				break;
			default:
				$transform_value = 'scale(1)';
				$initial_value   = 'scale(1)';
		}

		if ( 'taxonomy-layout-one' === $layout ) {
			return array();
		}

		return array(
			'transformValue' => $transform_value,
			'initialValue'   => $initial_value,
		);
	}

	/**
	 * Renders the five six layout.
	 *
	 * @param string $image_overlay_color item data.
	 * @param string $image_overlay_hover_color item data.
	 * @param string $image_overlay_custom_color item data.
	 * @param string $image_overlay_custom_hover_color item data.
	 * @param string $layout item data.

	 * @return object.
	 */
	protected function get_overlay_colors( $image_overlay_color, $image_overlay_hover_color, $image_overlay_custom_color, $image_overlay_custom_hover_color, $layout ) {
		if ( 'taxonomy-layout-one' === $layout ) {
			return array();
		}

		$gradient_map = array(
			'warm-sunset'      => 'linear-gradient(2deg, rgba(244, 66, 70, 0.4) 33.02%, rgba(221, 36, 118, 0.4) 98.51%)',
			'ocean-breeze'     => 'linear-gradient(1deg, rgba(43, 88, 118, 0.4) 0.5%, rgba(78, 67, 118, 0.4) 99.51%)',
			'royal-gold'       => 'linear-gradient(1deg, rgba(255, 215, 0, 0.4) 0.5%, rgba(184, 134, 11, 0.4) 99.51%)',
			'cool-blues'       => 'linear-gradient(1deg, rgba(30, 60, 114, 0.4) 0.5%, rgba(42, 82, 152, 0.4) 99.51%)',
			'soft-pastel'      => 'linear-gradient(1deg, rgba(252, 227, 138, 0.4) 0.5%, rgba(243, 129, 129, 0.4) 99.51%)',
			'elegant-purple'   => 'linear-gradient(180deg, rgba(65, 41, 90, 0.4) 0%, rgba(47, 7, 67, 0.4) 100%)',
			'energetic-orange' => 'linear-gradient(180deg, rgba(255, 81, 47, 0.4) 0%, rgba(240, 152, 25, 0.4) 100%)',
		);

		$random_color       = $this->overlay_random_solid_color( $image_overlay_color );
		$random_hover_color = $this->overlay_random_solid_color( $image_overlay_hover_color );

		if ( in_array( $image_overlay_color, array( 'multi-gradient', 'multi-solid' ), true ) ) {
			$overlay_color = $random_color;
		} elseif ( 'custom' === $image_overlay_color ) {
			$overlay_color = $image_overlay_custom_color;
		} else {
			$overlay_color = $gradient_map[ $image_overlay_color ] ?? 'transparent';
		}

		if ( in_array( $image_overlay_hover_color, array( 'multi-gradient', 'multi-solid' ), true ) ) {
			$overlay_hover_color = $random_hover_color;
		} elseif ( 'custom' === $image_overlay_hover_color ) {
			$overlay_hover_color = $image_overlay_custom_hover_color;
		} else {
			$overlay_hover_color = $gradient_map[ $image_overlay_hover_color ] ?? 'transparent';
		}

		return array(
			'overlayColor'      => $overlay_color,
			'overlayHoverColor' => $overlay_hover_color,
		);
	}

	/**
	 * Renders the five six layout.
	 *
	 * @param object $color_type item data.
	 * @return object.
	 */
	protected function overlay_random_solid_color( $color_type = '' ) {
		if ( 'multi-solid' === $color_type ) {
			$r = wp_rand( 0, 255 );
			$g = wp_rand( 0, 255 );
			$b = wp_rand( 0, 255 );
			return "rgba($r, $g, $b, 0.7)";
		}

		if ( 'multi-gradient' === $color_type ) {
			$color_list = array(
				'linear-gradient(293deg, rgba(251, 218, 97, .7) -0.37%, rgba(255, 90, 205, .7) 100%)',
				'linear-gradient(90deg, rgba(203, 173, 109, .7) 0%, rgba(213, 51, 105, .7) 100%)',
				'linear-gradient(90deg, rgba(36, 198, 220, .7) 0%, rgba(81, 74, 157, .7) 100%)',
				'linear-gradient(90deg, rgba(255, 224, 0, .7) 0%, rgba(255, 75, 31, .7) 100%)',
				'linear-gradient(90deg, rgba(28, 216, 210, .7) 0%, rgba(147, 237, 199, .7) 100%)',
				'linear-gradient(90deg, rgba(255, 212, 82, .7) 0%, rgba(84, 74, 125, .7) 100%)',
				'linear-gradient(90deg, rgba(91, 134, 229, .7) 0%, rgba(54, 209, 220, .7) 100%)',
				'linear-gradient(90deg, rgba(253, 185, 155, .7) 0%, rgba(167, 112, 239, .7) 100%)',
			);
			return $color_list[ array_rand( $color_list ) ];
		}

		return '';
	}
}
