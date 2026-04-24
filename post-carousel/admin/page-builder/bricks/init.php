<?php
defined( 'ABSPATH' ) || exit;

/**
 * Smart Post Bricks Builder integration function.
 *
 * Registers the Bricks builder integration element if Bricks is active.
 *
 * @since 4.0.0
 * @return void
 */
function sp_smart_post_bricks_builder() {
	if ( defined( 'BRICKS_VERSION' ) ) {
		\Bricks\Elements::register_element( SP_PC_PATH . 'admin/page-builder/bricks/bricksbuilder.php' );
	}
}
add_action( 'init', 'sp_smart_post_bricks_builder', 11 );
