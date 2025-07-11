<?php
/**
 * The License setting configurations.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access pages directly.

/**
 * The Layout building class.
 */
class SPS_License {

	/**
	 * Advanced setting section.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section( $prefix ) {
		SP_PC::createSection(
			$prefix,
			array(
				'title'  => __( 'License Key', 'post-carousel' ),
				'icon'   => 'fa sps-icon-key-01',
				'fields' => array(
					array(
						'id'   => 'license_key',
						'type' => 'license',
					),
				),
			)
		);
	}
}
