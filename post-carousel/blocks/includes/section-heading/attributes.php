<?php
/**
 * Section Heading block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'blockName'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'uniqueId'                           => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontLists'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'dynamicCss'                         => array(
		'type'    => 'object',
		'default' => array(),
	),
	'sectionHeadingHTMLTag'              => array(
		'type'    => 'string',
		'default' => 'h2',
	),
	'sectionHeadingLabel'                => array(
		'type'    => 'string',
		'default' => '',
	),
	'sectionHeading'                     => array(
		'type'    => 'string',
		'default' => 'heading',
	),
	'showSectionHeading'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'showSubHeading'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'sectionHeadingClassNames'           => array(
		'type'    => 'object',
		'default' => array(),
	),
	'sectionHeadingStyle'                => array(
		'type'    => 'string',
		'default' => 'section-heading-one',
	),
	'sectionHeadingStyleBackgroundColor' => array(
		'type'    => 'object',
		'default' => array(
			'color' => 'var(--smart-post-secondary)',
			'hover' => '',
		),
	),
	'sectionHeadingStyleColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#2271B1',
			'hover' => '',
		),
	),
	'sectionHeadingAliment'              => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'sectionHeadingBorderRadius'         => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => 'px',
		),
	),
	'subHeadingLabel'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'sectionSubHeadingAliment'           => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'sectionHeadingLinkUrl'              => array(
		'type'    => 'string',
		'default' => '',
	),
	'sectionHeadingTypography'           => array(
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
	'sectionHeadingStyleLineHeight'      => $this->ranger_attribute( 4 ),
	'sectionHeadingFontSize'             => $this->ranger_attribute(),
	'sectionHeadingLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'sectionHeadingGlobalTypo'           => array(
		'type'    => 'object',
		'default' => array(),
	),
	'sectionHeadingFontSpacing'          => $this->ranger_attribute( 0 ),
	'sectionHeadingWordSpacing'          => $this->ranger_attribute( 0 ),
	'sectionHeadingColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'sectionHeadingMargin'               => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'sectionHeadingPadding'              => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'sectionSubHeadingTypography'        => array(
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
	'sectionSubHeadingGlobalTypography'  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'sectionSubHeadingFontSize'          => $this->ranger_attribute(),
	'sectionSubHeadingFontSpacing'       => $this->ranger_attribute( 0 ),
	'sectionSubHeadingWordSpacing'       => $this->ranger_attribute( 0 ),
	'sectionSubHeadingLineHeight'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'sectionSubHeadingColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#1A261F',
			'hover' => '',
		),
	),
	'sectionSubHeadingMargin'            => $this->spacing_attribute( 0, 0, 0, 0, 'px' ),
	'sectionHeadingWidth'                => array(
		'type'    => 'string',
		'default' => '100%',
	),
	'isPreview'                          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'customCss'                          => array( 'type' => 'string' ),
	'additionalCssClass'                 => array( 'type' => 'string' ),
	'globalBreakPointData'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'headingLineThickness'               => $this->ranger_attribute( 2 ),
);
