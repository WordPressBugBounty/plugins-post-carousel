<?php
/**
 * Buttons block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
return array(
	'uniqueId'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'innerBlockId'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                 => array( 'type' => 'string' ),
	'fullWidthBtnEnable'         => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'buttonGap'                  => array(
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
	'buttonsMargin'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'buttonsHorizontalAlignment' => array(
		'type'    => 'string',
		'default' => 'flex-start',
	),
	'buttonsVerticalAlignment'   => array(
		'type'    => 'string',
		'default' => 'flex-start',
	),
	'buttonsAlignment'           => array(
		'type'    => 'string',
		'default' => 'horizontal',
	),
	'isPreview'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'additionalCssClass'         => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'globalBreakPointData'       => array(
		'type'    => 'object',
		'default' => array(),
	),
);
