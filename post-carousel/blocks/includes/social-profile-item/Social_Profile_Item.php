<?php
/**
 * Social profile class for Smart Post Show Blocks.
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
 * Social Profile Item Block Class.
 */
class Social_Profile_Item extends Block_Base {


	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'social-profile-item';
		$this->styles     = array( 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
	}


	/**
	 * Render Social Profile Item block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content Block content.
	 * @param array  $blocks Inner blocks.
	 * @return  $content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}
		$attributes['page_id'] = get_the_ID();

		// Attributes for Social Profile Item.
		$sp_block_name        = $attributes['blockName'] ?? '';
		$sp_unique_id         = $attributes['uniqueId'] ?? '';
		$social_link_relation = isset( $attributes['socialSingleLinkRelation'] ) ? $attributes['socialSingleLinkRelation'] : '';
		$social_icon_type     = isset( $attributes['socialSingleIconType'] ) ? $attributes['socialSingleIconType'] : '';
		$icon_enable          = isset( $attributes['iconEnableParent'] ) ? $attributes['iconEnableParent'] : false;
		$social_icon          = isset( $attributes['socialSingleIcon'] ) ? $attributes['socialSingleIcon'] : '';
		$social_image         = isset( $attributes['socialSingleImage'] ) ? $attributes['socialSingleImage'] : '';
		$layout               = isset( $attributes['layoutParent'] ) ? $attributes['layoutParent'] : '';
		$social_label         = isset( $attributes['socialSingleLabel'] ) ? $attributes['socialSingleLabel'] : '';
		$social_sub_text      = isset( $attributes['socialSingleSubText'] ) ? $attributes['socialSingleSubText'] : '';
		$label_enable         = isset( $attributes['labelEnableParent'] ) ? $attributes['labelEnableParent'] : false;
		$sub_text_enable      = isset( $attributes['subTextEnableParent'] ) ? $attributes['subTextEnableParent'] : false;
		$sp_social_link       = isset( $attributes['socialSingleLink'] ) ? $attributes['socialSingleLink'] : '';
		$sp_link_target       = isset( $attributes['socialSingleLinkOpen'] ) ? $attributes['socialSingleLinkOpen'] : '';
		$align_class          = isset( $attributes['align'] ) ? 'align' . $attributes['align'] : '';

		$additional_css_class = $attributes['additionalCssClass'] ?? '';
		$container_class      = $align_class . ( $additional_css_class === '' ? '' : ' ' . $additional_css_class );

		$label_class = 'sp-social-profile-item-label ' . (
			$attributes['socialLabelGlobalTypographyParent']['class'] ?? ''
		);

		$sub_text_class = 'sp-social-profile-item-sub-text ' . (
			$attributes['socialSubTextGlobalTypographyParent']['class'] ?? ''
		);

		ob_start();
		?>
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<div
				id="<?php echo esc_attr( $sp_unique_id ); ?>" class="sp-social-profile-item-container">
				<a class="sp-social-profile-item-wrapper" href="<?php echo esc_url( $sp_social_link ); ?>" target="<?php echo esc_attr( $sp_link_target ); ?>" rel="<?php echo esc_attr( $social_link_relation ); ?>">
					<div class="sp-social-profile-item">
						<!-- Social Profile Single Item Icon/Image -->
						<?php if ( 'none' !== $social_icon_type && $icon_enable ) : ?>
							<div class="sp-social-profile-item-icon-wrapper">
								<?php if ( 'icon' === $social_icon_type ) : ?>
									<div class="sp-social-profile-item-icon sp-social-icon-<?php echo esc_attr( $social_icon ); ?>">
										<i class="sp-icon-<?php echo esc_attr( $social_icon ); ?> sp-social-profile-item-icon-class"></i>
									</div>
								<?php endif; ?>
								<?php if ( 'image' === $social_icon_type && ! empty( $social_image ) ) : ?>
									<div class="sp-social-profile-item-image">
										<img
											src="<?php echo esc_url( $social_image['url'] ); ?>"
											alt="<?php echo esc_attr( $social_image['alt'] ); ?>"
											class="sp-social-image wp-image" />
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( 'social-profiles-layout-three' === $layout ) : ?>
							<span class="sp-social-profile-icon-divider"></span>
						<?php endif; ?>

						<?php if ( ! empty( trim( $social_label ) ) || ! empty( trim( $social_sub_text ) ) ) : ?>
							<div class="sp-social-profile-item-text">
								<?php if ( ! empty( trim( $social_label ) ) && $label_enable ) : ?>
									<span class="<?php echo esc_attr( $label_class ); ?>">
										<?php echo wp_kses_post( $social_label ); ?>
									</span>
								<?php endif; ?>
								<?php if ( ! empty( trim( $social_sub_text ) ) && $sub_text_enable ) : ?>
									<span class="<?php echo esc_attr( $sub_text_class ); ?>">
										<?php echo wp_kses_post( $social_sub_text ); ?>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</a>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
