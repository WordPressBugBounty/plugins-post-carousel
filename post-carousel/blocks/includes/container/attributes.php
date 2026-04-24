<?php
/**
 * Container block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'containerLayer'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'layerLayoutNo'                  => array(
		'type'    => 'number',
		'default' => '',
	),
	'uniqueId'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockName'                      => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                     => array(
		'type' => 'string',
	),
	'customCss'                      => array(
		'type' => 'string',
	),
	// 'columns'                        => $this->ranger_attribute( '', '', '', false ),
	'columns'                        => array(
		'type'    => 'number',
		'default' => '',
	),
	'columnsTablet'                  => array(
		'type'    => 'number',
		'default' => '',
	),
	'columnsMobile'                  => array(
		'type'    => 'number',
		'default' => 1,
	),
	'layout'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'containerWidth'                 => array(
		'type'    => 'string',
		'default' => 'full-width',
	),
	'containerCustomWidth'           => $this->ranger_attribute( '', '', '', 'px' ),
	'contentWidth'                   => $this->ranger_attribute( '', '', '', 'px' ),
	'contentHeightType'              => array(
		'type'    => 'string',
		'default' => 'default',
	),
	'containerMinHeight'             => $this->ranger_attribute( '', '', '', 'px' ),
	'columnsGap'                     => $this->ranger_attribute( 16, '', '', 'px' ),
	'rowGap'                         => $this->ranger_attribute( 16, '', '', 'px' ),
	'equalHeight'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'htmlTag'                        => array(
		'type'    => 'string',
		'default' => 'div',
	),
	'containerOverflow'              => array(
		'type'    => 'string',
		'default' => 'visible',
	),
	'containerBG'                    => array(
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
	'containerBGImage'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'containerBGImageHover'          => array(
		'type'    => 'object',
		'default' => array(),
	),
	'containerBGVideo'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'containerOverlayType'           => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'containerOverlayBg'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#1E1E1E',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'containerOverlayOpacity'        => $this->ranger_attribute( 50, 50, 50, '%' ),
	'containerOverlayBlandMode'      => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'containerOverlayTypeHover'      => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'containerOverlayOpacityHover'   => $this->ranger_attribute( 50, 50, 50, '%' ),
	'containerOverlayBlandModeHover' => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'containerBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '#E0E0E0',
			'hoverColor' => '',
		),
	),
	'containerBorderWidth'           => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'containerBorderWidthHover'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'containerBorderRadius'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'containerBorderRadiusHover'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'containerBoxShadowEnable'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'containerBoxShadow'             => array(
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
	'containerBoxShadowEnableHover'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'containerBoxShadowHover'        => array(
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
	'containerPadding'               => $this->spacing_attribute( 15, 15, 15, 15, 'px', true ),
	'containerMargin'                => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'containerFlexDirection'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 'row',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'containerJustifyContent'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 'flex-start',
				'Tablet'  => 'flex-start',
				'Mobile'  => 'flex-start',
			),
		),
	),
	'containerFlexWrap'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 'wrap',
				'Tablet'  => 'wrap',
				'Mobile'  => 'wrap',
			),
		),
	),
	'containerAlignItem'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 'flex-start',
				'Tablet'  => 'flex-start',
				'Mobile'  => 'flex-start',
			),
		),
	),
	'containerShapeDivider'          => array(
		'type'    => 'string',
		'default' => 'top',
	),
	'containerTopDividerType'        => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'containerBottomDividerType'     => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'shapeDividerBgColorTop'         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => 'var(--smart-post-secondary)',
				'gradient'   => '',
			),
		),
	),
	'shapeDividerWidthTop'           => $this->ranger_attribute( 100, 100, 100, '%' ),
	'shapeDividerHeightTop'          => $this->ranger_attribute( 100, 100, 100, 'px' ),
	'shapeDividerFlipTop'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'shapeDividerBringToFrontTop'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'shapeDividerBgColorBottom'      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => 'var(--smart-post-secondary)',
				'gradient'   => '',
			),
		),
	),
	'shapeDividerWidthBottom'        => $this->ranger_attribute( 100, 100, 100, '%' ),
	'shapeDividerHeightBottom'       => $this->ranger_attribute( 100, 100, 100, 'px' ),
	'shapeDividerFlipBottom'         => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'shapeDividerBringToFrontBottom' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advanceZIndex'                  => array(
		'type'    => 'number',
		'default' => '',
	),
	'advanceWrapperLink'             => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advanceWrapperLinkUrl'          => array(
		'type'    => 'string',
		'default' => '',
	),
	'advanceWrapperLinkNewTab'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advanceVisibilityHideDesktop'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advanceVisibilityHideTablet'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advanceVisibilityHideMobile'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advancedAdditionalID'           => array(
		'type'    => 'string',
		'default' => '',
	),
	'advancedAdditionalClass'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'currentScreen'                  => array(
		'type'    => 'string',
		'default' => 'Desktop',
	),
	'isPreview'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'globalBreakPointData'           => array(
		'type'    => 'object',
		'default' => array(),
	),
	'blockClientId'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'containerColumnRoot'            => array(
		'type'    => 'object',
		'default' => array(),
	),
	'align'                          => array(
		'type'    => 'string',
		'default' => 'full',
	),
);
