<?php
/**
 * Smart list block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

return array(
	'isPreview'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'uniqueId'                      => array(
		'type' => 'string',
	),
	'blockName'                     => array(
		'type' => 'string',
	),
	'dynamicCss'                    => array( 'type' => 'string' ),
	'fontLists'                     => array(
		'type'    => 'string',
		'default' => '',
	),
	// SmartListsGeneralTab.
	'smartListsLayout'              => array(
		'type'    => 'string',
		'default' => 'layout-one',
	),
	'listOrientation'               => array(
		'type'    => 'string',
		'default' => 'vertical',
	),
	'listsAlignment'                => array(
		'type'    => 'string',
		'default' => 'start',
	),
	'spaceBetweenLists'             => $this->ranger_attribute( 8 ),
	'iconContentGap'                => $this->ranger_attribute( 10 ),

	'dividerEnable'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'dividerStyle'                  => array(
		'type'    => 'string',
		'default' => 'solid',
	),
	'dividerWidth'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
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
	'dividerColor'                  => array(
		'type'    => 'string',
		'default' => '#D9D9D9',
	),
	'connectionLineEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),

	// SmartListsStyleTab.
		'smartListsBg'              => array(
			'type'    => 'object',
			'default' => array(
				'color' => array(
					'style'      => 'bgColor',
					'solidColor' => 'transparent',
					'gradient'   => '',
				),
				'hover' => array(
					'style'      => 'bgColor',
					'solidColor' => '',
					'gradient'   => '',
				),
			),
		),

	'smartListsBgImage'             => array(
		'type' => 'object',
	),
	'smartListsRadialShape'         => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'smartListsRadialPosition'      => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'smartListsBgImageScale'        => array(
		'type'    => 'string',
		'default' => 'cover',
	),
	'bgImageOverlayEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'borderStyle'                   => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'borderStyleWidth'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'borderRadius'                  => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowEnable'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'boxShadow'                     => array(
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
	'smartListsHoverBgImage'        => array(
		'type' => 'object',
	),
	'smartListsHoverRadialShape'    => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'smartListsHoverRadialPosition' => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'smartListsBgHoverImageScale'   => array(
		'type'    => 'string',
		'default' => 'cover',
	),
	'bgImageOverlayHoverEnable'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'bgImageHoverOverlayOpacity'    => array(
		'type'    => 'number',
		'default' => 0.5,
	),
	'borderHoverStyle'              => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'borderHoverStyleWidth'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'borderHoverRadius'             => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowHoverEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'boxShadowHover'                => array(
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

	'padding'                       => $this->spacing_attribute( 12, 12, 12, 12, 'px', true ),
	'margin'                        => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'bgImageOverlayColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => 'var(--smart-post-secondary)',
			'hoverColor' => '#012B60',
		),
	),
	'bgImageOverlayOpacity'         => array(
		'type'    => 'number',
		'default' => 0.5,
	),
	// IconImageGeneralTab.
	'iconEnable'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'iconSource'                    => array(
		'type'    => 'string',
		'default' => 'iconSet',
	),
	'svgIconName'                   => array(
		'type'    => 'string',
		'default' => 'FillStar',
	),
	'iconName'                      => array(
		'type'    => 'string',
		'default' => 'fas fa-asterisk',
	),
	'iconSize'                      => array(
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
	'iconSourceCustom'              => array(
		'type' => 'object',
	),
	'iconCustomWidth'               => array(
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

	'iconCustomHeight'              => array(
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
	'iconPosition'                  => array(
		'type'    => 'string',
		'default' => '0',
	),
	'iconAlignment'                 => array(
		'type'    => 'string',
		'default' => 'center',
	),
	// IconImageStyleTab.
	'iconBackgroundEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'backgroundShape'               => array(
		'type'    => 'string',
		'default' => 'backgroundShapeSquare',
	),
	'iconColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '#757575',
		),
	),
	'iconBg'                        => array(
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
	'iconBgRadialShape'             => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'iconBgRadialPosition'          => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'iconBorderStyle'               => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'iconBorderStyleWidth'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'iconBorderRadius'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'iconBgHoverRadialShape'        => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'iconBgHoverRadialPosition'     => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'iconHoverBorderStyle'          => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'iconHoverBorderStyleWidth'     => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'iconHoverBorderRadius'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'iconPadding'                   => $this->spacing_attribute( 6, 6, 6, 6, 'px', true ),

	// ContentGeneralTab.
	'listTitleEnable'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'descriptionEnable'             => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'titleDescriptionGap'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 6,
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
	'contentAlignment'              => array(
		'type'    => 'string',
		'default' => 'left',
	),
	// ContentStyleTab.
	'titleTypography'               => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '500',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'titleFontSize'                 => array(
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
	'titleLatterSpacing'            => array(
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
	'titleLineHeight'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.3,
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
	'titleWordSpacing'              => array(
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
	'descriptionTypography'         => array(
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
	'descriptionFontSize'           => array(
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
	'descriptionLatterSpacing'      => array(
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

	'descriptionLineHeight'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.2,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'descriptionWordSpacing'        => array(
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
	'titleColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '#2F2F2F',
		),
	),
	'descriptionColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '#757575',
		),
	),

	// AdvancedTab.
	'additionalCssClass'            => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'listItemsWidth'                => array(
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
);
