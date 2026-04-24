<?php
/**
 * Container column block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                     => array(
		'type'    => 'string',
		'default' => '',
	),
	'innerBlockId'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockClientId'                => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                   => array(
		'type' => 'string',
	),
	'columnWidth'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => '%',
				'Mobile'  => '%',
			),
		),
	),
	'columnBg'                     => array(
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
	'columnBgImage'                => array(
		'type'    => 'object',
		'default' => array(),
	),
	'columnBgImageHover'           => array(
		'type'    => 'object',
		'default' => array(),
	),
	'columnBgVideo'                => array(
		'type'    => 'object',
		'default' => array(),
	),
	'columnOverlayType'            => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'columnOverlayBg'              => array(
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
	'columnOverlayOpacity'         => $this->ranger_attribute( 50, 50, 50, '%' ),
	'columnOverlayBlandMode'       => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'columnOverlayTypeHover'       => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'columnOverlayOpacityHover'    => $this->ranger_attribute( 50, 50, 50, '%' ),
	'columnOverlayBlandModeHover'  => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'columnBorder'                 => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '#E0E0E0',
			'hoverColor' => '',
		),
	),
	'columnBorderWidth'            => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'columnBorderWidthHover'       => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'columnBorderRadius'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'columnBorderRadiusHover'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'columnBoxShadowEnable'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnBoxShadow'              => array(
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
	'columnBoxShadowEnableHover'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnBoxShadowHover'         => array(
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
	'columnPadding'                => $this->spacing_attribute( 0, 0, 0, 0, 'px', false ),
	'columnMargin'                 => $this->spacing_attribute( 0, 0, 0, 0, 'px', false ),
	'columnZIndex'                 => array(
		'type'    => 'number',
		'default' => '',
	),
	'columnWrapperLink'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnWrapperLinkUrl'         => array(
		'type'    => 'string',
		'default' => '',
	),
	'columnWrapperLinkNewTab'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnVisibilityHideDesktop'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnVisibilityHideTablet'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnVisibilityHideMobile'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'columnAdditionalID'           => array(
		'type'    => 'string',
		'default' => '',
	),
	'columnAdditionalClass'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'tempColumnWidth'              => array(
		'type'    => 'object',
		'default' => array(
			'px'  => 0,
			'pct' => 0,
		),
	),
	'parentTempResizeWidth'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	// 'lock'                        => array(
	// 'type'    => 'object',
	// 'default' => array(
	// 'remove' => true,
	// 'move'   => false,
	// ),
	// ),
	'globalBreakPointData'         => array(
		'type'    => 'object',
		'default' => array(),
	),
	'parentColumnGap'              => array(
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
	'reduceColWidth'               => array(
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
	'parentContainerFlexDirection' => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
);
