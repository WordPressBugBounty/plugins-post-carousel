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

$post_grid_two_attributes = array(
	'paginationEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'gridTwoColumns'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'gridTwoHorizontalGap'     => $this->ranger_attribute( 20 ),
	'gridLargeContentPosition' => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'gridTwoVerticalGap'       => $this->ranger_attribute( 20 ),
	'contentOnHover'           => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'titleOnHover'             => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'taxonomyOnHover'          => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'metaOnHover'              => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'excerptOnHover'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'readMoreOnHover'          => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'socialShareOnHover'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentHoverAnimate'      => array(
		'type'    => 'string',
		'default' => 'none',
	),

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
return array_merge( $post_grid_two_attributes, $shared_attributes );
