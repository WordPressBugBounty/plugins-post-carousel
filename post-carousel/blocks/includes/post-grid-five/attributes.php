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

$post_grid_five_attributes = array(
	'paginationEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postGridLayout'           => array(
		'type'    => 'string',
		'default' => 'grid-five-layout-one',
	),
	'gridFiveColumns'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 2,
				'Mobile'  => 1,
			),
		),
	),
	'gridFiveHorizontalGap'    => $this->ranger_attribute( 16 ),
	'gridLargeContentPosition' => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'gridFiveVerticalGap'      => $this->ranger_attribute( 16, '', 16 ),

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

return array_merge( $post_grid_five_attributes, $shared_attributes );
