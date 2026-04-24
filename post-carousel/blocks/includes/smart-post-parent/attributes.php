<?php
/**
 * Post parent block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'layout'                 => array(
		'type'    => 'string',
		'default' => 'layoutOne',
	),
	'uniqueId'               => array( 'type' => 'string' ),
	'dynamicCss'             => array( 'type' => 'string' ),
	'alignment'              => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'gap'                    => array(
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
	'multipleFilterRelation' => array(
		'type'    => 'string',
		'default' => 'and',
	),


	// style attr.
	'titleTypography'        => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '500',
				'style'      => 'normal',
				'transform'  => 'uppercase',
				'decoration' => 'none',
			),
		),
	),
	'titleFontSize'          => $this->ranger_attribute( 22 ),
	'titleLatterSpacing'     => $this->ranger_attribute( 0 ),
	'titleWordSpacing'       => $this->ranger_attribute( 0 ),
	'titleLineHeight'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.25,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'optionTypography'       => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '500',
				'style'      => 'normal',
				'transform'  => 'uppercase',
				'decoration' => 'none',
			),
		),
	),
	'optionFontSize'         => $this->ranger_attribute( 22 ),
	'optionLatterSpacing'    => $this->ranger_attribute( 0 ),
	'optionWordSpacing'      => $this->ranger_attribute( 0 ),
	'optionLineHeight'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.25,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'titleColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '#FFFFFF',
			'activeColor' => '#FFFFFF',
		),
	),
	'optionColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '#FFFFFF',
			'activeColor' => '#FFFFFF',
		),
	),
	'iconColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '#FFFFFF',
			'activeColor' => '#FFFFFF',
		),
	),
	'bgColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '#FFFFFF',
			'activeColor' => '#FFFFFF',
		),
	),
	'borderNormal'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4e4f52',
			'style'      => 'solid',
			'hoverColor' => '#EF5D30',
		),
	),
	'borderHover'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4e4f52',
			'style'      => 'solid',
			'hoverColor' => '#EF5D30',
		),
	),
	'borderWidthNormal'      => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderWidthHover'       => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderRadiusNormal'     => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'borderRadiusHover'      => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'padding'                => $this->spacing_attribute( 10, 10, 10, 10, 'px', true ),
	'margin'                 => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
);
