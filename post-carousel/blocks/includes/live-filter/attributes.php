<?php
/**
 * Live filter block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'layout'                  => array(
		'type'    => 'string',
		'default' => 'layoutOne',
	),
	'spBlockId'               => array( 'type' => 'string' ),
	'uniqueId'                => array( 'type' => 'string' ),
	'dynamicCss'              => array( 'type' => 'string' ),
	'fontLists'               => array( 'type' => 'string' ),
	'fieldAlignment'          => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'blockName'               => array(
		'type' => 'string',
	),
	'postType'                => array(
		'type'    => 'string',
		'default' => 'multiple_post_type',
	),
	'innerBlockLength'        => array(
		'type' => 'number',
	),
	'multiplePostType'        => array(
		'type'    => 'array',
		'default' => array(),
	),
	'postQuery'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'gap'                     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
				'Tablet'  => 12,
				'Mobile'  => 8,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'multipleFilterRelation'  => array(
		'type'    => 'string',
		'default' => 'and',
	),
	// style attr.
	'titleTypography'         => array(
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
	'titleGlobalTypography'   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'titleFontSize'           => $this->ranger_attribute( '' ),
	'titleLatterSpacing'      => $this->ranger_attribute( '' ),
	'titleWordSpacing'        => $this->ranger_attribute( '' ),
	'titleLineHeight'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),


	'menuTypography'          => array(
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
	'menuGlobalTypography'    => array(
		'type'    => 'object',
		'default' => array(),
	),
	'menuFontSize'            => $this->ranger_attribute( '14', '14', '14' ),
	'menuLatterSpacing'       => $this->ranger_attribute( '' ),
	'menuWordSpacing'         => $this->ranger_attribute( '' ),
	'menuLineHeight'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),

	'menuColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),

	'optionTypography'        => array(
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
	'optionGlobalTypography'  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'optionFontSize'          => $this->ranger_attribute( '' ),
	'optionLatterSpacing'     => $this->ranger_attribute( '' ),
	'optionWordSpacing'       => $this->ranger_attribute( '' ),
	'optionLineHeight'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'titleColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color' => 'var(--smart-post-dark-2-text)',
		),
	),
	'optionColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'bgColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#FFFFFF',
			'hover' => '#e5f0ff',
		),
	),
	'borderNormal'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => 'var(--smart-post-dark-2-text)',
			'style' => 'solid',
		),
	),
	'borderHover'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#838487',
			'style' => 'solid',
		),
	),
	'borderWidthNormal'       => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderWidthHover'        => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderRadiusNormal'      => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'borderRadiusHover'       => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'padding'                 => $this->spacing_attribute( 10, 12, 10, 12, 'px', false ),
	'margin'                  => $this->spacing_attribute( 0, 0, 40, 0, 'px', false ),
	'additionalCssClass'      => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'globalBreakPointData'    => array(
		'type'    => 'object',
		'default' => array(),
	),
	'taxonomyType'            => array(
		'type'    => 'string',
		'default' => 'category',
	),
	'selectedTerms'           => array(
		'type'    => 'array',
		'default' => array(),
	),
	'taxonomyStyle'           => array(
		'type'    => 'string',
		'default' => 'more',
	),
	'allTextLabel'            => array(
		'type'    => 'string',
		'default' => 'All',
	),
	'taxonomyLimit'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 2,
				'Mobile'  => 1,
			),
		),
	),

	'filterType'              => array(
		'type'    => 'string',
		'default' => 'button',
	),
	'activeBottomLine'        => array(
		'type'    => 'boolean',
		'default' => true,
	),

	'headingStyle'            => array(
		'type'    => 'string',
		'default' => 'styleOne',
	),

	'headingLabel'            => array(
		'type'    => 'string',
		'default' => 'Latest Posts',
	),
	'headingTag'              => array(
		'type'    => 'string',
		'default' => 'h3',
	),

	'menuAlignment'           => array(
		'type'    => 'string',
		'default' => 'right',
	),

	'headingTypography'       => array(
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
	'headingGlobalTypography' => array(
		'type'    => 'object',
		'default' => array(),
	),
	'headingFontSize'         => $this->ranger_attribute( '18', '18', '14' ),
	'headingLatterSpacing'    => $this->ranger_attribute( '' ),
	'headingWordSpacing'      => $this->ranger_attribute( '' ),
	'headingLineHeight'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),

	'headingColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'headingBg'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'widthLineThickness'      => array(
		'type'    => 'number',
		'default' => 2,
	),

	'headingBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#838487',
			'style' => 'none',
		),
	),

	'headingBorderWidth'      => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'headingBorderRadius'     => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'headingPadding'          => $this->spacing_attribute( 8, 20, 8, 20, 'px', false ),
	'widthLineColor'          => array(
		'type'    => 'string',
		'default' => '#E0E0E0',

	),
	'selectTermsType'         => array(
		'type'    => 'string',
		'default' => 'all',
	),
	'excludeTerms'            => array(
		'type'    => 'array',
		'default' => array(),
	),
);
