<?php
/**
 * Beaver Builder - Smart Post Show Module Frontend Template
 *
 * This file is automatically loaded by Beaver Builder when
 * rendering the module output on the frontend.
 *
 * The $module, $id, and $settings variables are available
 * automatically by Beaver Builder's rendering engine.
 *
 * @since 4.0.0
 * @package Smart_Post_Show
 *
 * @var SPSB_Beaver_Smart_Post_Module $module   The module instance.
 * @var string                         $id       The module's unique node ID.
 * @var object                         $settings The module's saved settings.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Get the selected template ID from module settings.
$template_id = isset( $settings->template_id ) ? (int) $settings->template_id : 0;

// Show a placeholder if no template has been selected.
if ( empty( $template_id ) ) : ?>
	<div style="
		text-align: center;
		padding: 20px;
		border: 2px dashed #ccc;
		color: #999;
		font-size: 14px;
	">
		<?php esc_html_e( 'Please select a Smart Post Show Template', 'post-carousel' ); ?>
	</div>
<?php else : ?>
	<div class="sp-smart-post-builder-wrap" data-builderTemplateId="<?php echo esc_attr( $template_id ); ?>">
		<?php
		// Execute the Smart Post Show shortcode and output the result.
		echo do_shortcode( '[smart_post id="' . $template_id . '"]' );
		?>
	</div>
<?php endif; ?>