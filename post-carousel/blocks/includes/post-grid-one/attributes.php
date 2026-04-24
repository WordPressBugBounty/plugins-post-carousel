<?php
/**
 * Post grid block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_grid_one_attributes = array(
	'paginationEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postGridLayout'           => array(
		'type'    => 'string',
		'default' => 'grid-one-layout-one',
	),
	'blockLocation'            => array(
		'type'    => 'string',
		'default' => '',
	),
	'gridOneColumns'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 2,
				'Mobile'  => 1,
			),
		),
	),
	'gridOneHorizontalGap'     => $this->ranger_attribute( 24 ),
	'gridLargeContentPosition' => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'gridOneVerticalGap'       => $this->ranger_attribute( 24 ),
);

return array_merge( $post_grid_one_attributes, $shared_attributes );
