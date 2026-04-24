<?php
/**
 * Social profiles class for Smart Post Show Blocks.
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
class Social_Profiles extends Block_Base {


	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'social-profiles';
		$this->styles     = array( 'sp_smart_post_blocks_google_fonts' );
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

		$attributes['page_id']  = get_the_ID();
		$sp_block_name          = $attributes['blockName'] ?? '';
		$sp_unique_id           = $attributes['uniqueId'] ?? '';
		$sp_layout              = $attributes['layout'] ?? '';
		$sp_social_alignment    = $attributes['socialAlignment'] ?? '';
		$sp_social_hover_effect = $attributes['socialHoverEffect'] ?? '';
		$additional_css_class   = $attributes['additionalCssClass'] ?? '';
		$show_divider_icon      = ! empty( $attributes['socialIconDivider'] ) ? $attributes['socialIconDivider'] : false;

		unset(
			$attributes['dynamicCss'],
			$attributes['fontListsEditPage'],
			$attributes['fontLists']
		);

		// const dividerClass =
		// layout === "social-profiles-layout-three" && socialIconDivider ? "sp-icon-divider" : "sp-icon-divider-none";
		$divider_class = ( 'social-profiles-layout-three' === $sp_layout && $show_divider_icon ) ? 'sp-icon-divider' : 'sp-icon-divider-none';

		$sp_profiles_wrapper_class = 'sp-social-profile-wrapper ' . $sp_layout . ' sp-align-' . $sp_social_alignment . ' sp-icon-hover-effect-' . $sp_social_hover_effect . ' ' . $divider_class;
		$align_class               = isset( $attributes['align'] ) ? 'align' . $attributes['align'] : '';
		$container_class           = 'sp-smart-post-wrapper' . $align_class . ( $additional_css_class === '' ? '' : ' ' . $additional_css_class );

		ob_start();
		?>
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<div id="<?php echo esc_attr( $sp_unique_id ); ?>" class="sp-smart-post-wrapper">
				<div class="<?php echo esc_attr( $sp_profiles_wrapper_class ); ?>">
					<div class="sp-social-profile-wrapper-grid-class">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
