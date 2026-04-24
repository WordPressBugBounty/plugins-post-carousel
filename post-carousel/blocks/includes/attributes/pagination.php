<?php
/**
 * Pagination block attributes class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pagination_attributes = array(
	'paginationEnable'        => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'uniqueId'                => array( 'type' => 'string' ),
	'dynamicCss'              => array( 'type' => 'string' ),
	'paginationType'          => array(
		'type'    => 'string',
		'default' => 'load-more',
	),
	'loadMoreInfiniteScroll'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'loadPerClick'            => array(
		'type'    => 'number',
		'default' => 9,
	),
	'loadMoreBtnLabel'        => array(
		'type'    => 'string',
		'default' => 'Load More',
	),
	'loadMoreEndMessage'      => array(
		'type'    => 'string',
		'default' => '',
	),
	'paginationAlign'         => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'paginationTypography'    => array(
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
	'paginationFontSize'      => $this->ranger_attribute( '' ),
	'paginationLetterSpacing' => array(
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
	'paginationWordSpacing'   => array(
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
	'paginationLineHeight'    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'paginationColor'         => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'paginationBGColor'       => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '',
			'hoverColor'  => '',
			'activeColor' => '',
		),
	),
	'paginationBorder'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'style'      => '',
			'hoverColor' => '',
		),
	),
	'paginationBorderWidth'   => $this->spacing_attribute( '' ),
	'paginationSpaceBetween'  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 4,
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
	'paginationBorderRadius'  => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'paginationPadding'       => $this->spacing_attribute( 0, 8, 0, 8, 'px', false ),
	'paginationMargin'        => $this->spacing_attribute( 48, 0, 0, 0, 'px', false ),
	'paginationStyle'         => array(
		'type'    => 'string',
		'default' => 'number-arrow',
	),
	'paginationPageLimit'     => array(
		'type'    => 'number',
		'default' => 8,
	),
	'paginationShorten'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'paginationPrevLabel'     => array(
		'type'    => 'string',
		'default' => 'Previous',
	),
	'paginationNextLabel'     => array(
		'type'    => 'string',
		'default' => 'Next',
	),
	'navigationArrowSize'     => $this->ranger_attribute( 16 ),
	'navigationArrowWidth'    => $this->ranger_attribute( 40 ),
	'navigationArrowHeight'   => $this->ranger_attribute( 40 ),
	'navigationArrowPosition' => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'navigationArrowStyle'    => array(
		'type'    => 'string',
		'default' => 'chevron-solid',
	),
);
