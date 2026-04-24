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

$post_grid_three_attributes = array(
	'paginationEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postGridLayout'           => array(
		'type'    => 'string',
		'default' => 'grid-three-layout-one',
	),
	'gridThreeColumns'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'gridThreeHorizontalGap'   => $this->ranger_attribute( 24 ),
	'gridLargeContentPosition' => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'gridThreeVerticalGap'     => $this->ranger_attribute( 24 ),
	'titleEffect'              => array(
		'type'    => 'string',
		'default' => 'none',
	),


	'titleUnderlineEffect'     => array(
		'type'    => 'string',
		'default' => 'leftToRight',
	),
	'titleEffectColor'         => array(
		'type'    => 'string',
		'default' => '#fff',
	),
);
return array_merge( $post_grid_three_attributes, $shared_attributes );
