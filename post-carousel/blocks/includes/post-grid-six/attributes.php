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

$post_grid_six_attributes = array(
	'paginationEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postGridLayout'           => array(
		'type'    => 'string',
		'default' => 'grid-six-layout-one',
	),
	'gridSixColumns'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'gridSixHorizontalGap'     => $this->ranger_attribute( 15 ),
	'gridLargeContentPosition' => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'gridSixVerticalGap'       => $this->ranger_attribute( 15 ),

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

return array_merge( $post_grid_six_attributes, $shared_attributes );
