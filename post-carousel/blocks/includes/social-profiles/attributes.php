<?php
/**
 * Social profiles block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                           => array(
		'type'    => 'string',
		'default' => '',
	),

	'dynamicCss'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockName'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'templateItems'                      => array(
		'type'    => 'array',
		'default' => array( 'facebook', 'x (twitter)', 'linkedin', 'digg', 'reddit' ),
	),
	'layout'                             => array(
		'type'    => 'string',
		'default' => 'social-profiles-layout-one',
	),
	'socialListViewEnable'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columns'                            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'socialHorizontalGap'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 24,
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
	'socialVerticalGap'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 24,
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
	'socialHoverEffect'                  => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'socialAlignment'                    => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'socialIconEnable'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'socialIconSize'                     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 18,
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
	'socialIconBGSize'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 36,
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
	'socialIconDivider'                  => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'socialIconCustomColorEnable'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialIconDividerColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#DDDDDD',
			'hover' => '',
		),
	),
	'socialIconColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#FFFFFF',
			'hover' => '',
		),
	),
	'socialIconBg'                       => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'socialIconBorder'                   => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '',
		),
	),
	'socialIconBorderWidth'              => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'socialIconBorderRadius'             => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialIconBorderHover'              => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialIconBorderWidthHover'         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialIconBorderRadiusHover'        => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialIconBoxShadowEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialIconBoxShadowValue'           => array(
		'type'    => 'object',
		'default' => array(
			'value'         => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'          => 'outset',
			'color'         => '#ddd',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'socialIconBoxShadowHoverEnable'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialIconBoxShadowHoverValue'      => array(
		'type'    => 'object',
		'default' => array(
			'value'         => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'          => 'outset',
			'color'         => '#ddd',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'socialIconMargin'                   => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialLabelEnable'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialLabelPosition'                => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'socialLabelGap'                     => array(
		'type'    => 'object',
		'default' => array(
			'value' => 8,
			'unit'  => 'px',
		),
	),
	'socialSubTextEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialSubTextGap'                   => array(
		'type'    => 'object',
		'default' => array(
			'value' => 8,
			'unit'  => 'px',
		),
	),
	'socialLabelTypography'              => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'socialLabelGlobalTypography'        => array(
		'type'    => 'object',
		'default' => array(),
	),
	'socialLabelFontSize'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialLabelLetterSpacing'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialLabelWordSpacing'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialLabelLineHeight'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'socialSubTextTypography'            => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'socialSubTextGlobalTypography'      => array(
		'type'    => 'object',
		'default' => array(),
	),
	'socialSubTextFontSize'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialSubTextLetterSpacing'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialSubTextWordSpacing'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'socialSubTextLineHeight'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'socialLabelColor'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'socialSubTextColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'socialContentAreaBG'                => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'socialContentAreaBorder'            => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#E0E0E0',
		),
	),
	'socialContentAreaBorderWidth'       => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'socialContentAreaBorderRadius'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialContentAreaBorderHover'       => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'socialContentAreaBorderWidthHover'  => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialContentAreaBorderRadiusHover' => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialContentAreaShadowEnable'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialContentAreaShadow'            => array(
		'type'    => 'object',
		'default' => array(
			'value'         => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'          => 'outset',
			'color'         => '#ddd',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'socialContentAreaShadowHoverEnable' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialContentAreaShadowHover'       => array(
		'type'    => 'object',
		'default' => array(
			'value'         => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'          => 'outset',
			'color'         => '#ddd',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'socialContentAreaPadding'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialContentAreaMargin'            => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fontLists'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontListsEditPage'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'socialContentAreaBgBlur'            => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => '%',
		),
	),
	'isPreview'                          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'additionalCssClass'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'globalBreakPointData'               => array(
		'type'    => 'object',
		'default' => array(),
	),
);
