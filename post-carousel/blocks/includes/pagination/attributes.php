<?php
/**
 * Pagination block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'paginationEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'uniqueId'                   => array( 'type' => 'string' ),
	'dynamicCss'                 => array( 'type' => 'string' ),
	'paginationType'             => array(
		'type'    => 'string',
		'default' => 'load-more',
	),
	'fontLists'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'loadMoreInfiniteScroll'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'paginationPosition'         => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'loadPerClick'               => array(
		'type'    => 'number',
		'default' => 9,
	),
	'loadMoreBtnLabel'           => array(
		'type'    => 'string',
		'default' => 'Load More',
	),
	'loadMoreEndMessage'         => array(
		'type'    => 'string',
		'default' => 'No more posts available',
	),
	'paginationAlign'            => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'paginationTypography'       => array(
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
	'paginationGlobalTypography' => array(
		'type'    => 'object',
		'default' => array(),
	),
	'paginationFontSize'         => $this->ranger_attribute( '' ),
	'paginationLetterSpacing'    => array(
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
	'paginationWordSpacing'      => array(
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
	'paginationLineHeight'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'paginationColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'paginationBGColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'paginationBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'style'      => '',
			'hoverColor' => '',
		),
	),
	'paginationBorderWidth'      => $this->spacing_attribute( '' ),
	'paginationSpaceBetween'     => $this->ranger_attribute( 4 ),
	'paginationBorderRadius'     => $this->spacing_attribute( '' ),
	'paginationPadding'          => $this->spacing_attribute( '' ),
	'paginationMargin'           => $this->spacing_attribute( '' ),
	'paginationStyle'            => array(
		'type'    => 'string',
		'default' => 'number-arrow',
	),
	'paginationPageLimit'        => array(
		'type'    => 'number',
		'default' => 8,
	),
	'paginationShorten'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'paginationPrevLabel'        => array(
		'type'    => 'string',
		'default' => 'Prev',
	),
	'paginationNextLabel'        => array(
		'type'    => 'string',
		'default' => 'Next',
	),
	'navigationArrowSize'        => $this->ranger_attribute( 20 ),
	'navigationArrowWidth'       => $this->ranger_attribute( 40 ),
	'navigationArrowHeight'      => $this->ranger_attribute( 40 ),
	'navigationArrowPosition'    => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'navigationArrowStyle'       => array(
		'type'    => 'string',
		'default' => 'chevron-solid',
	),
	'additionalCssClass'         => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                  => array(
		'type'    => 'string',
		'default' => '',
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
	'globalBreakPointData'       => array(
		'type'    => 'object',
		'default' => array(),
	),
);
