<?php

defined( 'ABSPATH' ) || exit;
/**
 * Smart Post Oxygen Builder integration function.
 *
 * Loads the Oxygen builder integration file if Oxygen is active.
 *
 * @since 4.0.0
 * @return void
 */
function smart_post_oxygen_builder() {
	if ( class_exists( 'OxygenElement' ) ) {
		require_once SP_PC_PATH . 'admin/page-builder/oxygen/oxygen.php';
	}
}
add_action( 'init', 'smart_post_oxygen_builder' );
