<?php
/**
 * Post carousel block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_carousel_attributes = array(
	'icon'                                   => array(
		'type'    => 'string',
		'default' => 'p',
	),
	'queryData'                              => array(
		'type'    => 'array',
		'default' => array(),
	),
	'carouselHeight'                         => $this->ranger_attribute(),
	'slideToScroll'                          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'carouselPaginationStyle'                => array(
		'type'    => 'string',
		'default' => 'dots',
	),
	'carouselDotsWidth'                      => $this->ranger_attribute( 8 ),
	'carouselDotsHeight'                     => $this->ranger_attribute( 8 ),
	'carouselDotsSpaceBetween'               => $this->ranger_attribute( 4 ),
	'carouselDotsHorizontalPosition'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 50,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'carouselDotsVerticalPosition'           => $this->ranger_attribute( 0 ),
	'carouselNavArrowStyle'                  => array(
		'type'    => 'string',
		'default' => 'open',
	),
	'carouselPaginationDotsColor'            => array(
		'type'    => 'object',
		'default' => array(
			'normal'         => '#949494',
			'activeAndHover' => 'var( --sp-smart-primary-2-600 )',
		),
	),
	'carouselPaginationDotsTextColor'        => array(
		'type'    => 'object',
		'default' => array(
			'normal'         => '#FFFFFF',
			'activeAndHover' => '#FFFFFF',
		),
	),
	'carouselPaginationDotsBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => 'solid',
			'color'      => '#000000',
			'hoverColor' => 'var(--sp-smart-primary-2-600)',
		),
	),
	'carouselPaginationDotsBorderWidth'      => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'carouselPaginationDotsBorderWidthHover' => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'carouselAnimationEffect'                => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'showPartialView'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselAdaptiveHeight'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselTabKeyNav'                      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselMouseWheelControl'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselFreeScrollMode'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselLayoutAttributes'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'carouselSubheadingLabel'                => array(
		'type'    => 'string',
		'default' => 'About Post Carousel',
	),
	'carouselData'                           => array(
		'type'    => 'string',
		'default' => '',
	),
	'carouselTickerSpeed'                    => array(
		'type'    => 'object',
		'default' => array( 'value' => 3000 ),
	),
);

return array_merge( $post_carousel_attributes, $carousel_attributes, $shared_attributes );
