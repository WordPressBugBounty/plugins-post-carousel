<?php
/**
 * Smart list block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                  => array(
		'type' => 'string',
	),
	'blockName'                 => array(
		'type' => 'string',
	),
	'fontLists'                 => array(
		'type'    => 'string',
		'default' => '',
	),

	// SmartListGeneralTab

	'linkURL'                   => array(
		'type'    => 'string',
		'default' => 'https://',
	),
	'openInNewTab'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'noFollowLink'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	// SmartListStyleTab
	'smartListBg'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(135deg, #D70067, #D76700, #F59E0B)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'borderStyle'               => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#686868',
		),
	),
	'borderStyleWidth'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'borderRadius'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'listBoxShadow'             => array(
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

	'borderHoverStyle'          => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#686868',
		),
	),
	'borderHoverStyleWidth'     => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'borderHoverRadius'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowHoverEnable'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'boxShadowHover'            => array(
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

	'padding'                   => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'listPadding'               => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),

	// IconImageGeneralTab
	'iconEnable'                => array(
		'type' => 'boolean',
	),
	'iconEnableParent'          => array(
		'type' => 'boolean',
	),
	'iconSource'                => array(
		'type' => 'string',
	),
	'svgIconName'               => array(
		'type' => 'string',
	),
	'iconName'                  => array(
		'type' => 'string',
	),
	'iconSize'                  => array(
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
	'iconSourceCustom'          => array(
		'type' => 'object',
	),
	'iconCustomWidth'           => array(
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

	'iconCustomHeight'          => array(
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

	'parentListsLayout'         => array(
		'type'    => 'string',
		'default' => 'layout-one',
	),
	'iconPosition'              => array(
		'type' => 'string',
	),
	'iconAlignment'             => array(
		'type' => 'string',
	),


	// IconImageStyleTab
	'iconBackgroundEnable'      => array(
		'type' => 'boolean',
	),
	'backgroundShape'           => array(
		'type' => 'string',
	),
	'iconColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'iconBg'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#dddddd',
				'gradient'   => 'linear-gradient(135deg, #D70067, #D76700, #F59E0B)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '#dddddd',
				'gradient'   => 'linear-gradient(135deg, #D70067, #D76700, #F59E0B)',
			),
		),
	),
	'iconBgRadialShape'         => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'iconBgRadialPosition'      => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'iconBorderStyle'           => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'iconBorderStyleWidth'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'iconBorderRadius'          => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'iconBgHoverRadialShape'    => array(
		'type' => 'string',
	),
	'iconBgHoverRadialPosition' => array(
		'type' => 'string',
	),
	'iconHoverBorderStyle'      => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'iconHoverBorderStyleWidth' => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'iconHoverBorderRadius'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'iconPadding'               => $this->spacing_attribute( '', '', '', '', 'px', true ),

	// ContentGeneralTab
	'listTitleEnable'           => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'descriptionEnable'         => array(
		'type' => 'boolean',
	),
	'titleDescriptionGap'       => array(
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
	'descriptionColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),


	// ContentStyleTab
	'titleTypography'           => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
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

	'titleFontSize'             => array(
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
	'titleLatterSpacing'        => array(
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
	'titleLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
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
	'titleWordSpacing'          => array(
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
	'descriptionTypography'     => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
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
	'descriptionFontSize'       => array(
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
	'descriptionLatterSpacing'  => array(
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
	'descriptionLineHeight'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),

	'descriptionWordSpacing'    => array(
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

	'titleColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),

	// BadgeGeneralTab

	'badgeEnable'               => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'badgeLabel'                => array(
		'type'    => 'string',
		'default' => 'HOT',
	),

	// BadgeStyleTab
	'badgeTypography'           => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '400',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'badgeFontSize'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 11,
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
	'badgeLatterSpacing'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'badgeLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.2,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),

	'badgeWordSpacing'          => array(
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
	'badgeColor'                => array(
		'type'    => 'string',
		'default' => '#0255A7',
	),
	'badgeBgColor'              => array(
		'type'    => 'string',
		'default' => '#DFECFF',
	),
	'badgeBorderStyle'          => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#fff',
		),
	),
	'badgeBorderStyleWidth'     => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'badgeBorderRadius'         => $this->spacing_attribute( 10, 10, 10, 10, 'px', true ),
	'badgePadding'              => $this->spacing_attribute( 2, 8, 2, 8, 'px', false ),
	'badgeMargin'               => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),

	'titleText'                 => array(
		'type'    => 'string',
		'default' => 'List Item Text',
	),
	'descriptionText'           => array(
		'type'    => 'string',
		'default' => 'List Description Here',
	),
	'smartListRadialShape'      => array(
		'type'    => 'string',
		'default' => 'circle',
	),

	'listsAlignment'            => array(
		'type'    => 'string',
		'default' => 'start',
	),
	'iconSourceParent'          => array(
		'type' => 'string',
	),
	'isPreview'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'parentSvgIconName'         => array(
		'type'    => 'string',
		'default' => 'Dot',
	),
	'parentIconName'            => array(
		'type' => 'string',
	),
	'parentIconSourceCustom'    => array(
		'type' => 'object',
	),
	'parentListTitleEnable'     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'parentDescriptionEnable'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'currentIcon'               => array(
		'type' => 'object',
	),
	// AdvancedTab
	'additionalCssClass'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'             => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
);
