<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                            => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockName'                           => array(
		'type'    => 'string',
		'default' => '',
	),
	'socialSingleProfile'                 => array(
		'type'    => 'string',
		'default' => 'facebook',
	),
	'socialSingleLink'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'socialSingleLinkOpen'                => array(
		'type'    => 'string',
		'default' => '_blank',
	),
	'socialSingleLinkRelation'            => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'socialSingleIconType'                => array(
		'type'    => 'string',
		'default' => 'icon',
	),
	'iconEnableParent'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'labelEnableParent'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'subTextEnableParent'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'layoutParent'                        => array(
		'type'    => 'string',
		'default' => 'social-profiles-layout-one',
	),
	'socialLabelGlobalTypographyParent'   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'socialSubTextGlobalTypographyParent' => array(
		'type'    => 'object',
		'default' => array(),
	),
	'socialSingleIcon'                    => array(
		'type'    => 'string',
		'default' => 'facebook',
	),
	'socialSingleImage'                   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'socialSingleColor'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'socialSingleBG'                      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => '',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'socialSingleBorder'                  => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialSingleBorderWidth'             => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleBorderRadius'            => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleBorderHover'             => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialSingleBorderWidthHover'        => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleBorderRadiusHover'       => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleLabel'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'socialSingleSubText'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'socialSingleLabelColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'socialSingleSubTextColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'socialSingleAreaBG'                  => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => '',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'socialSingleAreaBorder'              => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialSingleAreaBorderWidth'         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleAreaBorderRadius'        => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleAreaBorderHover'         => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialSingleAreaBorderWidthHover'    => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleAreaBorderRadiusHover'   => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSinglePadding'                 => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleMargin'                  => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialSingleContentAreaBgBlur'       => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => '%',
		),
	),
	'additionalCssClass'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                           => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'blockClientId'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'globalBreakPointData'                => array(
		'type'    => 'object',
		'default' => array(),
	),
);
