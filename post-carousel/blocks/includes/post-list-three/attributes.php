<?php
/**
 * Post list block attributes file class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_list_three_attributes = array(
	'largeItemPadding'      => $this->spacing_attribute( 30, 30, 30, 30 ),
	'paginationEnable'      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'readMoreTextColor'     => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => 'var(--smart-post-secondary)',
		),
	),
	'postListLayout'        => array(
		'type'    => 'string',
		'default' => 'sp-smart-post-list-three-layout-one',
	),
	'verticalGap'           => $this->ranger_attribute( 24 ),
	'dividerBorderStyle'    => array(
		'type'    => 'string',
		'default' => 'solid',
	),
	'showHideDivider'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'dividerAlignment'      => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'dividerBg'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#E0E0E0',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'dividerWidth'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 100,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'dividerHeight'         => $this->ranger_attribute( 1 ),
	'spaceBetweenListItems' => $this->ranger_attribute( 5 ),
	'contentAreaPadding'    => $this->spacing_attribute(),
	'horizontalGap'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'largeItemAlignment'    => array(
		'type'    => 'string',
		'default' => 'left',
	),
);

$post_list_three_attributes_updated_attr = $this->change_attribute_data(
	$shared_attributes,
	array(
		array(
			'attrName' => 'excerptShow',
			'value'    => true,
		),
		array(
			'attrName' => 'showReadMoreButton',
			'value'    => true,
		),
		array(
			'attrName' => 'imageSpace',
			'value'    => '',
		),
	)
);
return array_merge(
	$post_list_three_attributes_updated_attr,
	$post_list_three_attributes,
	array(
		'paginationType' => array(
			'type'    => 'string',
			'default' => 'none',
		),
	)
);
