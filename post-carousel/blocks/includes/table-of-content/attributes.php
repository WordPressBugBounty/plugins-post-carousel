<?php
/**
 * Table of content block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

return array(
	'blockName'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'uniqueId'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                 => array(
		'type'    => 'object',
		'default' => array(),
	),

	'isPreview'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'customCss'                  => array( 'type' => 'string' ),
	'additionalCssClass'         => array( 'type' => 'string' ),
	'preset'                     => array(
		'type'    => 'string',
		'default' => 'presetOne',
	),

	'listStyle'                  => array(
		'type'    => 'string',
		'default' => 'bullet',
	),
	'supportedHeadingTag'        => array(
		'type'    => 'array',
		'default' => array(
			array(
				'label' => 'H1',
				'value' => 'h1',
			),
			array(
				'label' => 'H2',
				'value' => 'h2',
			),
			array(
				'label' => 'H3',
				'value' => 'h3',
			),

			array(
				'label' => 'H4',
				'value' => 'h4',
			),
			array(
				'label' => 'H5',
				'value' => 'h5',
			),
			array(
				'label' => 'H6',
				'value' => 'h6',
			),
		),
		'items'   => array(
			'type' => 'object',
		),
	),

	'displayControl'             => array(
		'type'    => 'string',
		'default' => 'static',
	),

	'tocAlignment'               => array(
		'type'    => 'string',
		'default' => 'left',
	),

	'tocBg'                      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),

	'tocBorder'                  => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'tocBorderWidth'             => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'tocPadding'                 => $this->spacing_attribute( 25, 25, 25, 25, 'px', true ),
	'TOCBorderRadius'            => $this->spacing_attribute( '5', '5', '5', '5', 'px', true ),
	'tocBoxShadowEnable'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'tocBoxShadow'               => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 5,
					'right'  => 5,
					'bottom' => 10,
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
			'selectDefault' => 'custom',
		),
	),


	'contentBg'                  => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),

	'contentBorder'              => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'contentBorderWidth'         => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'contentPadding'             => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),


	'contentColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#333333',
			'hoverColor' => '#EF5D30',
		),
	),

	'contentChildColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#333333',
			'hoverColor' => '#EF5D30',
		),
	),



	'contentBoxShadowEnable'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentBoxShadow'           => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 5,
					'right'  => 5,
					'bottom' => 10,
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
			'selectDefault' => 'custom',
		),
	),



	'contentTypography'          => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
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

	'contentGlobalTypography'    => array(
		'type'    => 'object',
		'default' => array(),
	),
	'contentFontSize'            => $this->ranger_attribute( 12 ),
	'contentLetterSpacing'       => $this->ranger_attribute( 0 ),
	'contentWordSpacing'         => $this->ranger_attribute( 0 ),
	'contentAlignment'           => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'contentLineHeight'          => array(
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

	'tocHeading'                 => array(
		'type'    => 'string',
		'default' => 'Table of Contents',
	),

	'headingTypography'          => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => 'none',
			),
		),
	),

	'headingGlobalTypography'    => array(
		'type'    => 'object',
		'default' => array(),
	),
	'headingFontSize'            => $this->ranger_attribute( 24 ),
	'headingLetterSpacing'       => $this->ranger_attribute( 0 ),
	'headingWordSpacing'         => $this->ranger_attribute( 0 ),
	'headingLineHeight'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.3,
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

	'headingColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#333333',
			'hoverColor' => '#EF5D30',
		),
	),

	'headingBg'                  => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),

	'headingBorder'              => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'headingBorderWidth'         => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'headingPadding'             => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'headingBorderRadius'        => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),

	'bottomGap'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => 16,
				'Mobile'  => 16,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'stickyOffsetTop'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 50,
				'Tablet'  => 50,
				'Mobile'  => 50,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'headingHashUrl'             => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'headingAlignment'           => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'listHierarchy'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'hierarchyDistance'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => 16,
				'Mobile'  => 16,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'copyLink'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'gapBetweenListItems'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => 16,
				'Mobile'  => 16,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'childItemGap'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => 16,
				'Mobile'  => 16,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'separator'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'separatorStyle'             => array(
		'type'    => 'string',
		'default' => 'solid',
	),

	'separatorColor'             => array(
		'type'    => 'string',
		'default' => '#414040ff',
	),

	'activeLineColor'            => array(
		'type'    => 'string',
		'default' => '#1A74E4',
	),

	'separatorThickness'         => array(
		'type'    => 'number',
		'default' => 1,
	),

	'listTypography'             => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
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


	'listGlobalTypography'       => array(
		'type'    => 'object',
		'default' => array(),
	),



	'listFontSize'               => $this->ranger_attribute( 18 ),
	'listLetterSpacing'          => $this->ranger_attribute( 0 ),
	'listWordSpacing'            => $this->ranger_attribute( 0 ),
	'listLineHeight'             => array(
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


	'collapsedInitially'         => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'childItemCollapsible'       => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'CollapsibleButtonType'      => array(
		'type'    => 'string',
		'default' => 'icon',
	),

	'CollapsibleIconSource'      => array(
		'type'    => 'string',
		'default' => 'three',
	),
	'childCollapsibleIconSource' => array(
		'type'    => 'string',
		'default' => 'three',
	),

	'collapsibleIconPosition'    => array(
		'type'    => 'string',
		'default' => 'right',
	),

	'floatingPosition'           => array(
		'type'    => 'string',
		'default' => 'top-left',
	),

	'collapsibleColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#333333',
		),
	),

	'collapsibleBg'              => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),

	'itemBg'                     => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#dddddd',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),

	'collapsibleBorder'          => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'collapsibleBorderWidth'     => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'collapsiblePadding'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'contentBorderRadius'        => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'collapsibleBorderRadius'    => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'smoothScroll'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'backToTop'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'offsetTop'                  => array(
		'type'    => 'number',
		'default' => 50,

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

	'headings'                   => array(
		'type'    => 'array',
		'default' => array(),
	),

	'tocCollapsed'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'expandText'                 => array(
		'type'    => 'string',
		'default' => 'Open',
	),
	'collapseText'               => array(
		'type'    => 'string',
		'default' => 'Close',
	),


	'collapseTypography'         => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
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

	'collapseGlobalTypography'   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'collapseFontSize'           => $this->ranger_attribute( 18 ),
	'collapseLetterSpacing'      => $this->ranger_attribute( 0 ),
	'collapseWordSpacing'        => $this->ranger_attribute( 0 ),
	'collapseLineHeight'         => array(
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
	'fontListsEditPage'          => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontLists'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'tocWidth'                   => $this->ranger_attribute( '', '', '', 'px' ),

);
