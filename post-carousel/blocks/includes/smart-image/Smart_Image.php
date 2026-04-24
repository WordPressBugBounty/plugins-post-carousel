<?php
/**
 * Smart image block class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Block_Base;
use WP_Error;
use WP_REST_Request;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Smart Image Block class
 */
class Smart_Image extends Block_Base {

	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'smart-image';
		$this->styles     = array(
			'sp_smart_post_blocks_social_icons_style',
			'pcp-font-awesome',
			// 'sp_smart_post_blocks_css',
			'pcp-likes',
			'sp_smart_post_blocks_google_fonts',
			// 'sp_smart_post_blocks_style',
		);
	}

	/**
	 * Render Smart_Image block.
	 *
	 * @param array  $attributes  array $attributes - Block attributes.
	 * @param string $content    string $content - Block content.
	 * @param array  $blocks bocks.
	 *
	 * @return $content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		$attributes['page_id']    = get_the_ID();
		$sp_block_name            = isset( $attributes['blockName'] ) ? $attributes['blockName'] : '';
		$align                    = isset( $attributes['align'] ) ? $attributes['align'] : '';
		$unique_id                = isset( $attributes['uniqueId'] ) ? $attributes['uniqueId'] : '';
		$hide_on_desktop          = isset( $attributes['hideOnDesktop'] ) ? $attributes['hideOnDesktop'] : false;
		$hide_on_tablet           = isset( $attributes['hideOnTablet'] ) ? $attributes['hideOnTablet'] : false;
		$hide_on_mobile           = isset( $attributes['hideOnMobile'] ) ? $attributes['hideOnMobile'] : false;
		$img_text_position        = isset( $attributes['imgTextPosition'] ) ? $attributes['imgTextPosition'] : '';
		$img_mask_enable          = isset( $attributes['imgMaskingEnable'] ) ? $attributes['imgMaskingEnable'] : false;
		$mask_shape_set           = isset( $attributes['imageShapeSet'] ) ? $attributes['imageShapeSet'] : 'shape-set';
		$select_mask_shape        = isset( $attributes['selectImageShape'] ) ? $attributes['selectImageShape'] : 'original';
		$select_image             = isset( $attributes['selectImage'] ) ? $attributes['selectImage'] : array();
		$select_img_size          = isset( $attributes['imageSize'] ) ? $attributes['imageSize'] : 'full';
		$lazy_load                = isset( $attributes['lazyLoad'] ) ? $attributes['lazyLoad'] : false;
		$aspect_ratio             = isset( $attributes['aspectRatio'] ) ? $attributes['aspectRatio'] : 'original';
		$img_animation            = isset( $attributes['imgAnimationNormal'] ) ? $attributes['imgAnimationNormal'] : 'zoom-in';
		$double_resolution_retina = isset( $attributes['doubleResolutionRetina'] ) ? $attributes['doubleResolutionRetina'] : false;
		$enable_link              = isset( $attributes['enableLink'] ) ? $attributes['enableLink'] : false;
		$link_type                = isset( $attributes['linkType'] ) ? $attributes['linkType'] : 'full-img';
		$img_hover_overlay        = isset( $attributes['imgHoverOverlayEnable'] ) ? $attributes['imgHoverOverlayEnable'] : false;
		$link_btn_position        = isset( $attributes['buttonPosition'] ) ? $attributes['buttonPosition'] : 'center-center';
		$link_btn_label           = isset( $attributes['buttonLabel'] ) ? $attributes['buttonLabel'] : '';
		$btn_link_url             = isset( $attributes['linkUrl'] ) ? $attributes['linkUrl'] : '';
		$open_in_tab              = ! empty( $attributes['openInTab'] ) ? '_blank' : '_self';
		$img_alt_text             = isset( $attributes['imageAltText'] ) ? $attributes['imageAltText'] : '';
		$img_bg_enable            = isset( $attributes['smartImgBgEnable'] ) ? $attributes['smartImgBgEnable'] : false;
		$additional_class         = isset( $attributes['additionalCssClass'] ) ? $attributes['additionalCssClass'] : false;
		$img_alignment            = isset( $attributes['imgAlignment'] ) ? $attributes['imgAlignment'] : 'left';

		if ( empty( $select_image['url'] ) && empty( $select_image['insertUrl'] ) ) {
			return;
		}
		$external_url = isset( $select_image['insertUrl'] ) ? $select_image['insertUrl'] : false;

		unset( $attributes['dynamicCss'] );
		unset( $attributes['fontListsEditPage'] );
		unset( $attributes['fontLists'] );

		$img_size_array = $select_image['media_details']['sizes'][ $select_img_size ] ?? array();

		if ( ! isset( $img_size_array['source_url'] ) && ! isset( $select_image['url'] ) ) {
			return '';
		}

		$visibility_class = ( $hide_on_desktop ? ' sp-hide-on-desktop ' : '' ) . ( $hide_on_tablet ? ' sp-hide-on-tablet ' : '' ) . ( $hide_on_mobile ? ' sp-hide-on-mobile' : '' );
		$img_mask_class   = $img_mask_enable ? ( 'custom' !== $mask_shape_set ? ' sp-' . $select_mask_shape : '  sp-custom-mask' ) : '';

		$img_srcset_retina = null;

		if ( ! empty( $select_image['srcset'] ) ) {
			if ( ! $double_resolution_retina ) {
				$img_srcset_retina = $select_image['srcset'];
			} else {
				// split into an array by commas.
				$src_array = array_map( 'trim', explode( ',', $select_image['srcset'] ) );

				// filter only sizes >= 600w.
				$filtered = array_filter(
					$src_array,
					function ( $src ) {
						preg_match( '/(\d+)w$/', $src, $matches );
						$size = isset( $matches[1] ) ? (int) $matches[1] : 0;
						return $size >= 600;
					}
				);

				// join back into a string.
				$img_srcset_retina = implode( ', ', $filtered );
			}
		}

		$image_id         = $select_image['id'] ?? '';
		$image_width      = $img_size_array['width'] ?? '';
		$image_height     = $img_size_array['height'] ?? '';
		$image_source_url = $img_size_array['source_url'] ?? '';
		$image_url        = $select_image['url'] ?? '';

		$img_wp_class   = ! $external_url && count( $select_image ) > 0 ? 'wp-image-' . $image_id : '';
		$img_class      = 'sp-smart-image sp-image-ratio-' . $aspect_ratio . ' sp-' . $img_animation . ' ' . $img_wp_class;
		$img_sizes_attr = ! $external_url ? '(max-width: ' . $image_width . 'px) 100vw, ' . $image_width . 'px' : '';

		// Render the block content.
		ob_start();
		?>
		<div
			id="<?php echo esc_attr( $unique_id ); ?>"
			class="sp-smart-post-block-wrapper align<?php echo esc_attr( $align ); ?><?php echo esc_attr( $visibility_class ); ?> <?php echo esc_attr( $additional_class ); ?>"
			>
				<div class="sp-smart-post-smart-image">
					<figure
						class="sp-smart-image-wrapper sp-text-position-<?php echo esc_attr( $img_text_position ); ?>"
					>
						<div class="sp-smart-image-button sp-d-flex sp-justify-<?php echo esc_attr( $img_alignment ); ?>">
							<div
								class="sp-smart-post sp-smart-image-area<?php echo esc_attr( $img_bg_enable ? ' sp-has-bg' : '' ); ?> <?php echo esc_attr( $img_mask_class ); ?>"
							>
								<div class="sp-smart-image-wrapper sp-overflow-hidden">
								<?php
								if ( $enable_link && 'full-img' === $link_type ) {
									echo '<a href="' . esc_url( $btn_link_url ) . '" rel="nofollow noreferrer" target="' . esc_attr( $open_in_tab ) . '">';
								}
								?>
									<img
										fetchpriority="high"
										decoding="async"
										width="<?php echo ! $external_url ? esc_attr( $image_width ) : ''; ?>"
										height="<?php echo ! $external_url ? esc_attr( $image_height ) : ''; ?>"
										class="<?php echo esc_attr( $img_class ); ?>"
										src="<?php echo esc_url( $image_source_url ?? $image_url ?? null ); ?>"
										alt="<?php echo esc_attr( $img_alt_text ); ?>"
										srcSet="<?php echo esc_attr( $img_srcset_retina ); ?>"
										loading="<?php echo esc_attr( $lazy_load ? 'lazy' : 'eager' ); ?>"
										sizes="<?php echo esc_attr( $img_sizes_attr ); ?>"
									/>
									<?php if ( $img_hover_overlay ) : ?>
										<div class="sp-hover-img-overlay sp-<?php echo esc_attr( $img_animation ); ?>"></div>
									<?php endif; ?>
								<?php
								if ( $enable_link && 'full-img' === $link_type ) {
									echo '</a>'; }
								?>
								<?php if ( $enable_link && 'button' === $link_type ) : ?>
									<div
										class="sp-smart-image-link-btn-wrapper sp-position-<?php echo esc_attr( $link_btn_position ); ?>"
									>
										<a class="sp-smart-image-link-btn" rel="nofollow noreferrer" href="<?php echo esc_url( $btn_link_url ); ?>" target="<?php echo esc_attr( $open_in_tab ); ?>">
											<?php echo esc_html( $link_btn_label ); ?>
										</a>
									</div>
								<?php endif; ?>
								<?php
								if ( 'over-img' === $img_text_position ) {
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo self::image_caption( $attributes );
								}
								?>
								</div>
							</div>
						</div>
						<?php
						if ( 'over-img' !== $img_text_position ) {
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo self::image_caption( $attributes );
						}
						?>
					</figure>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Render Smart Image Caption.
	 *
	 * @param array $attributes  array $attributes - Block attributes.
	 *
	 * @return string caption markup.
	 */
	public function image_caption( $attributes ) {

		$text_vertical_position   = isset( $attributes['imgTextVertical'] ) ? $attributes['imgTextVertical'] : 'bottom';
		$text_horizontal_position = isset( $attributes['imgTextHorizontal'] ) ? $attributes['imgTextHorizontal'] : 'center';
		$img_text_position        = isset( $attributes['imgTextPosition'] ) ? $attributes['imgTextPosition'] : 'over-img';
		$img_text_visibility      = isset( $attributes['imgTextVisibility'] ) ? $attributes['imgTextVisibility'] : '';
		$img_title_enable         = isset( $attributes['imgTitleEnable'] ) ? $attributes['imgTitleEnable'] : false;
		$img_title_label          = isset( $attributes['imgTitleLabel'] ) ? $attributes['imgTitleLabel'] : '';
		$img_caption_enable       = isset( $attributes['imgCaptionEnable'] ) ? $attributes['imgCaptionEnable'] : false;
		$img_caption_label        = isset( $attributes['imgCaptionLabel'] ) ? $attributes['imgCaptionLabel'] : '';

		$text_position   = 'over-img' === $img_text_position ? 'sp-position-' . $text_vertical_position . '-' . $text_horizontal_position : '';
		$container_class = 'sp-visibility-' . $img_text_visibility . ' ' . $text_position . ' sp-text-' . $text_horizontal_position;

		if ( ! $img_title_enable && ! $img_caption_enable ) {
			return null;
		}

		ob_start();
		?>
		<figcaption
			class="sp-smart-image-text-container <?php echo esc_attr( $container_class ); ?>"
		>
			<?php if ( $img_title_enable ) : ?>
				<div class="sp-smart-post sp-text sp-smart-image-title-area">
					<h4 class="sp-smart-image-title"><?php echo esc_html( $img_title_label ); ?></h4>
				</div>
			<?php endif; ?>
			<?php if ( $img_caption_enable ) : ?>
				<div class="sp-smart-post sp-text sp-smart-image-caption-area">
					<p class="sp-smart-image-caption"><?php echo esc_html( $img_caption_label ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
}
