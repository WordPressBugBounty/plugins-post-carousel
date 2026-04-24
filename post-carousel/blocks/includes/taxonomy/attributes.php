<?php
/**
 * Taxonomy block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'blockName'                     => array(
		'type' => 'string',
	),
	'uniqueId'                      => array(
		'type' => 'string',
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
	'customCss'                     => array( 'type' => 'string' ),
	'additionalCssClass'            => array(
		'type'    => 'string',
		'default' => '',
	),
	'contentVerticalPosition'       => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'contentHorizontalPosition'     => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'contentAreaWidth'              => $this->ranger_attribute( 80, 85, 85, '%' ),
	'contentAreaHeight'             => $this->ranger_attribute( '', '', '', '%' ),
	'contentAreaBg'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '023047',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'contentAreaBorder'             => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'color'       => '#cccccc',
			'hoverColor'  => '',
			'activeColor' => '#000000',
		),
	),
	'contentAreaBorderWidth'        => $this->spacing_attribute( 0, 1, 1, 1, 'px', true ),
	'catRadius'                     => $this->spacing_attribute( '30', '30', '30', '30', 'px', true ),
	'contentAreaEnableBoxShadow'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentAreaBoxShadow'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => array(
					'top'    => 3,
					'right'  => 3,
					'bottom' => 6,
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'contentAreaPadding'            => $this->spacing_attribute(),
	'largeContentAreaPadding'       => $this->spacing_attribute(),
	'contentAreaMargin'             => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'contentAreaHoverBorderWidth'   => $this->spacing_attribute( 0, 0, 0, 0, 'px', false ),
	'contentAreaHoverBorderRadius'  => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'contentAreaInnerWidth'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 85,
				'Tablet'  => '',
				'Mobile'  => 100,
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => '%',
				'Mobile'  => '%',
			),
		),
	),
	'contentAreaThumbsBorder'       => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'solid',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'isPreview'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentAreaThumbsBorderWidth'  => $this->spacing_attribute( '', ' ', '', '', 'px', true ),
	'contentAreaThumbsBorderRadius' => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'postCardBg'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#1C1C1C00',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'postCardBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'hoverStyle'  => '',
			'color'       => '#4E4F5242',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),

	'postCardHoverBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'hoverStyle'  => '',
			'color'       => '#4E4F52',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'postCardBorderWidth'           => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'postCardHoverBorderWidth'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'postCardBorderRadius'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'postCardHoverBorderRadius'     => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'postCardBoxShadowEnable'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postCardHoverBoxShadowEnable'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postCardBoxShadow'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'postCardHoverBoxShadow'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'postCardPadding'               => $this->spacing_attribute( 0, 15, 0, 0, 'px', false ),
	'titleShow'                     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'titleHTMLTag'                  => array(
		'type'    => 'string',
		'default' => 'h3',
	),
	'titleLength'                   => array(
		'type'    => 'object',
		'default' => array(
			'value' => 7,
			'unit'  => 'words',
		),
	),
	'titleTypography'               => array(
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
	'titleGlobalTypography'         => array(
		'type'    => 'object',
		'default' => array(),
	),
	'titleFontSize'                 => $this->ranger_attribute(),
	'titleLatterSpacing'            => $this->ranger_attribute(),
	'titleWordSpacing'              => $this->ranger_attribute(),
	'titleLineHeight'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'titleColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#023047',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'titleMargin'                   => $this->spacing_attribute( 0, 0, 0, 15, 'px', false ),


	'excerptShow'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'excerptLength'                 => array(
		'type'    => 'object',
		'default' => array(
			'value' => 10,
			'unit'  => 'words',
		),
	),
	'excerptTypography'             => array(
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
	'excerptGlobalTypography'       => array(
		'type'    => 'object',
		'default' => array(),
	),
	'excerptFontSize'               => $this->ranger_attribute(),
	'excerptLatterSpacing'          => $this->ranger_attribute(),
	'excerptWordSpacing'            => $this->ranger_attribute(),
	'excerptLineHeight'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'excerptColor'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575;',
			'hoverColor' => '#EF5D30',
		),
	),
	'excerptMargin'                 => $this->spacing_attribute( 4, 0, 0, 0, 'px', false ),
	'largeItemTitleColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#000000',
			'hoverColor' => '#EF5D30',
		),
	),
	'largeItemTitleLineHeight'      => array(
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
	'largeItemTitleTypography'      => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array(
					'300',
					'400',
					'500',
					'600',
					'700',
					'800',
				),
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
	'largeItemTitleFontSize'        => $this->ranger_attribute( 26 ),

	'largeItemTitleLatterSpacing'   => $this->ranger_attribute( 0 ),
	'layout'                        => array(
		'type'    => 'string',
		'default' => 'taxonomy-layout-one',
	),
	'height'                        => $this->ranger_attribute( 80, 80, 80, 'px' ),

	'columns'                       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => 1,
				'Mobile'  => 1,
			),
		),
	),
	'columnGap'                     => $this->ranger_attribute( 10, 10, 10, 'px' ),
	'rowGap'                        => $this->ranger_attribute( 10, 10, 10, 'px' ),
	'icon'                          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'emptyCategory'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'noResultFoundText'             => array(
		'type'    => 'string',
		'default' => '',
	),
	'postType'                      => array(
		'type'    => 'string',
		'default' => 'post',
	),
	'queryType'                     => array(
		'type'    => 'string',
		'default' => 'alltaxonomy',
	),
	'taxonomyType'                  => array(
		'type'    => 'string',
		'default' => 'category',
	),

	'childOf'                       => array(
		'type'    => 'string',
		'default' => null,
	),
	'limit'                         => array(
		'type'    => 'number',
		'default' => 6,
	),
	'showHideDivider'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'dividerBorderStyle'            => array(
		'type'    => 'string',
		'default' => 'solid',
	),
	'dividerWidth'                  => $this->ranger_attribute( 100, 100, 100, '%' ),
	'dividerThickness'              => $this->ranger_attribute( 1, 1, 1 ),
	'dividerHeight'                 => $this->ranger_attribute(),
	'dividerAlignment'              => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'dividerBg'                     => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#E0E0E0',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),


	'contentAnimation'              => array(
		'type'    => 'string',
		'default' => 'no-animation',
	),
	'imageEnable'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'imageSize'                     => array(
		'type'    => 'string',
		'default' => 'Original Size',
	),


	'taxonomyImageWidth'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 100,
				'Tablet'  => 100,
				'Mobile'  => 100,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'taxonomyImageHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 100,
				'Tablet'  => 100,
				'Mobile'  => 100,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'imageOverlay'                  => array(
		'type'    => 'string',
		'default' => 'noOverlay',
	),

	'imageOverlayCustom'            => array(
		'type'    => 'string',
		'default' => '#f8b4b47e',

	),
	'hoverEffect'                   => array(
		'type'    => 'string',
		'default' => 'zoom-in',
	),
	'hoverOpacityEffect'            => array(
		'type'    => 'number',
		'default' => 1,
	),
	'grayscaleMode'                 => array(
		'type'    => 'string',
		'default' => 'original',
	),
	'grayscaleOnHover'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'originalOnHover'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'blurEffect'                    => $this->ranger_attribute( 0, 0, 0 ),
	'blurEffectHover'               => $this->ranger_attribute( 0, 0, 0 ),
	'brightnessEffect'              => $this->ranger_attribute( 1, 1, 1 ),
	'brightnessEffectHover'         => $this->ranger_attribute( 1, 1, 1 ),
	'imageBorderWidth'              => $this->spacing_attribute( 1, 1, 1, 1, 'px' ),
	'imageBorderWidthHover'         => $this->spacing_attribute( 1, 1, 1, 1, 'px' ),
	'imageBorderRadius'             => $this->spacing_attribute(),
	'imageBorderRadiusHover'        => $this->spacing_attribute(),
	'imageBorder'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#000',
			'style'      => 'none',
			'hoverColor' => '#fff',
		),
	),
	'imageBorderHover'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#000',
			'style'      => 'none',
			'hoverColor' => '#fff',
		),
	),

	'taxonomyIconStyle'             => array(
		'type'    => 'string',
		'default' => 'open',
	),
	'hoverAnimation'                => array(
		'type'    => 'string',
		'default' => 'zoomIn',
	),
	'titleEnable'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'countEnable'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'counterHeight'                 => $this->ranger_attribute( 24, 24, 24, 'px' ),
	'counterWidth'                  => $this->ranger_attribute( 24, 24, 24, 'px' ),
	'counterTypography'             => array(
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
	'counterGlobalTypography'       => array(
		'type'    => 'object',
		'default' => array(),
	),
	'counterFontSize'               => $this->ranger_attribute(),
	'counterLatterSpacing'          => $this->ranger_attribute(),
	'counterLineHeight'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),

	'counterColor'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#023047',
			'hoverColor' => '',
		),
	),

	'counterMultiColorBg'           => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'contentMultiColorBg'           => array(
		'type'    => 'boolean',
		'default' => false,
	),


	'counterCardBg'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#fff',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'counterBorder'                 => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'hoverStyle'  => '',
			'color'       => '#4E4F52',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),

	'counterHoverBorder'            => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'hoverStyle'  => '',
			'color'       => '#4E4F52',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'counterBorderWidth'            => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'counterHoverBorderWidth'       => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'counterBorderRadius'           => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'counterHoverBorderRadius'      => $this->spacing_attribute(),
	'counterBoxShadowEnable'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'counterHoverBoxShadowEnable'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'counterBoxShadow'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'counterHoverBoxShadow'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'SelectTerms'                   => array(
		'type'    => 'array',
		'default' => array(),
	),
	'excludeTerms'                  => array(
		'type'    => 'array',
		'default' => array(),
	),
	'displayOverlyThum'             => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'displayOverlyHoverThum'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageOverlayHoverColor'        => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'imageOverlayColor'             => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),

	'imageOverlayCustomColor'       => array(
		'type'    => 'string',
		'default' => '#f8b4b47e',

	),

	'imageOverlayCustomHoverColor'  => array(
		'type'    => 'string',
		'default' => '#f8b4b47e',

	),
	'beforeCount'                   => array(
		'type'    => 'string',
		'default' => '(',

	),

	'afterCount'                    => array(
		'type'    => 'string',
		'default' => ')',

	),
	'titleCounterGap'               => $this->ranger_attribute( 0, 0, 0, 'px' ),
	'dynamicCss'                    => array(
		'type'    => 'string',
		'default' => '',

	),
	'allTaxonomyTerm'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'globalBreakPointData'          => array(
		'type'    => 'object',
		'default' => array(),
	),

);
