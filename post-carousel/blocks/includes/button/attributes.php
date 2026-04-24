<?php
/**
 * Button block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                        => array(
		'type'    => 'string',
		'default' => '',
	),
	'innerBlockId'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                      => array( 'type' => 'string' ),
	'buttonLabel'                     => array(
		'type'    => 'string',
		'default' => 'Click Here',
	),
	'buttonLabelTypography'           => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'buttonLabelGlobalTypography'     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'buttonLabelLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'buttonLabelFontSize'             => $this->ranger_attribute(),
	'buttonLabelLatterSpacing'        => $this->ranger_attribute(),
	'buttonLabelWordSpacing'          => $this->ranger_attribute(),
	'buttonLabelColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffffff',
			'hoverColor' => '',
		),
	),
	'buttonLabelMargin'               => $this->spacing_attribute( '0', '0', '15', '0', 'px', false ),
	'iconSource'                      => array(
		'type'    => 'string',
		'default' => 'chevron-solid',
	),
	'iconSize'                        => $this->ranger_attribute( 14 ),
	'iconGap'                         => $this->ranger_attribute( 8 ),
	'iconColor'                       => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#fff',
			'hoverColor' => '',
		),
	),
	'iconPosition'                    => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'buttonBgColor'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'buttonBorder'                    => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => 'var(--smart-post-secondary)',
		),
	),
	'buttonBorderWidth'               => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),


	'buttonBorderGradient'            => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => 'var(--smart-post-secondary)',
		),
	),
	'buttonBorderGradientWidth'       => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),


	'buttonBorderGradientHover'       => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => 'var(--smart-post-secondary)',
		),
	),
	'buttonBorderGradientWidthHover'  => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'buttonBorderGradientRadiusHover' => $this->spacing_attribute( 5, 5, 5, 5, 'px', true ),


	'buttonHoverBorder'               => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => 'var(--smart-post-secondary)',
		),
	),
	'buttonHoverBorderWidth'          => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'buttonBorderRadius'              => $this->spacing_attribute( 5, 5, 5, 5, 'px', true ),

	'buttonHoverBorderRadius'         => $this->spacing_attribute( 5, 5, 5, 5, 'px', true ),
	'buttonBoxShadowEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'buttonHoverBoxShadowEnable'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'buttonBoxShadow'                 => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 8,
					'right'  => 8,
					'bottom' => 16,
					'left'   => 0,
				),
				'Tablet'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'Mobile'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
			),
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '#4E4F521A',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'buttonHoverBoxShadow'            => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 8,
					'right'  => 8,
					'bottom' => 16,
					'left'   => 0,
				),
				'Tablet'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'Mobile'  => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
			),
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '#4E4F521A',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'buttonLink'                      => array(
		'type'    => 'string',
		'default' => '#',
	),
	'buttonPadding'                   => $this->spacing_attribute( 14, 28, 14, 28, 'px', false ),
	'buttonStyle'                     => array(
		'type'    => 'string',
		'default' => 'default',
	),
	'hoverEffects'                    => array(
		'type'    => 'string',
		'default' => 'defaultHover',
	),
	'shadowColor'                     => array(
		'type'    => 'string',
		'default' => '#641DD7',
	),
	'buttonGradientBg'                => array(
		'type'    => 'string',
		'default' => 'linear-gradient(81deg, #FF0035 1.03%, #F902CB 45.49%, #5D13FF 97.36%)',
	),
	'buttonGradientHoverBg'           => array(
		'type'    => 'string',
		'default' => 'linear-gradient(81deg, #5D13FF 1.03%, #F902CB 45.49%, #FF0035 97.36%)',
	),

	'openNewTab'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'enableIcon'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'additionalCssClass'              => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'buttonLabelEnable'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'hideOnDesktop'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'smartBtnIconSize'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 14,
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
	'smartBtnIconColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#FFF',
			'hover' => '',
		),
	),
	'globalBreakPointData'            => array(
		'type'    => 'object',
		'default' => array(),
	),
);
