<?php
/**
 * Post slider block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_slider_attributes = array(
	'postSliderLayout'                     => array(
		'type'    => 'string',
		'default' => 'post-slider-layout-one',
	),
	'postSliderColumns'                    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 2,
				'Mobile'  => 1,
			),
		),
	),
	'postSliderHeight'                     => $this->ranger_attribute( 620, 350, 250 ),
	'postSliderSlideScroll'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => 1,
				'Mobile'  => 1,
			),
		),
	),
	'postSliderHoverPause'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postSliderAnimationEffect'            => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'postSliderTabKeyNav'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderMouseWheel'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderFreeScroll'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderNavArrow'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postSliderPaginationDots'             => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postSliderArrowStyle'                 => array(
		'type'    => 'string',
		'default' => 'open',
	),
	'postSliderArrowSize'                  => $this->ranger_attribute( 20 ),
	'postSliderArrowWidth'                 => $this->ranger_attribute( 40 ),
	'postSliderArrowHeight'                => $this->ranger_attribute( 32 ),
	'postSliderArrowSpaceBetween'          => $this->ranger_attribute(),
	'postSliderArrowHorizontal'            => $this->ranger_attribute(),
	'postSliderArrowVertical'              => $this->ranger_attribute(),
	'postSliderArrowColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffff',
			'hoverColor' => '#4e4f52',
		),
	),
	'postSliderArrowBgColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4e4f52',
			'hoverColor' => '#ffffff',
		),
	),
	'postSliderArrowBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#4e4f52',
			'hoverColor' => '#4E4F52',
		),
	),
	'postSliderArrowBorderWidth'           => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'postSliderArrowBorderRadius'          => $this->spacing_attribute( 50, 50, 50, 50, '%', true ),
	'postSliderBoxShadowEnable'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderBoxShadow'                  => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
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
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'postSliderPaginationStyle'            => array(
		'type'    => 'string',
		'default' => 'dots',
	),
	'postSliderPaginationWidth'            => $this->ranger_attribute( 8 ),
	'postSliderPaginationHeight'           => $this->ranger_attribute( 8 ),
	'postSliderPaginationSpaceBetween'     => $this->ranger_attribute( 4 ),
	'postSliderPaginationHorizontal'       => $this->ranger_attribute(),
	'postSliderPaginationVertical'         => $this->ranger_attribute(),
	'postSliderPaginationTextColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '#ffffff',
			'activeColor' => '#4e4f52',
		),
	),
	'postSliderPaginationColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#dddddd',
			'hoverColor' => '#4e4f52',
		),
	),
	'postSliderPaginationBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#4e4f52',
			'hoverColor' => '#4E4F52',
		),
	),
	'postSliderPaginationBorderWidth'      => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'postSliderPaginationBorderWidthHover' => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'postSliderGeneralContentAlign'        => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'postSliderGeneralOpenIn'              => array(
		'type'    => 'string',
		'default' => 'new-tab',
	),
	'postSliderGeneralPreloader'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderGeneralEqualHeight'         => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderSubheadingLabel'            => array(
		'type'    => 'string',
		'default' => 'About Post Slider',
	),
	'carouselData'                         => array(
		'type'    => 'string',
		'default' => '',
	),

	'titleEffect'                          => array(
		'type'    => 'string',
		'default' => 'none',
	),


	'titleUnderlineEffect'                 => array(
		'type'    => 'string',
		'default' => 'leftToRight',
	),
	'titleEffectColor'                     => array(
		'type'    => 'string',
		'default' => '#fff',
	),


);
return array_merge( $post_slider_attributes, $shared_attributes, $carousel_attributes );
