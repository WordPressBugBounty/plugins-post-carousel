<?php
/**
 * Thumbnail slider block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_thumbnail_two_attributes = array(
	'thumbnailSliderTwoLayout'      => array(
		'type'    => 'string',
		'default' => 'thumbnail-slider-two-layout-one',
	),
	'thumbnailTwoAlignment'         => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'thumbnailTwoPosition'          => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'thumbnailSliderTwoHeight'      => $this->ranger_attribute( 620 ),
	'thumbnailTwoItemsHeight'       => $this->ranger_attribute( 132, 132, 0, 'px' ),
	'thumbnailItemsToShow'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 3,
				'Mobile'  => '',
			),
		),
	),
	'thumbnailTwoSlideToScroll'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => 1,
				'Mobile'  => 1,
			),
		),
	),
	'thumbnailTwoAnimationEffect'   => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'thumbnailTwoAdaptiveHeight'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'thumbnailTwoTabKeyNavigation'  => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'thumbnailTwoMouseWheelControl' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'thumbnailTwoFreeScrollMode'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'thumbnailTwoNavArrow'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'thumbnailProgressPosition'     => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'thumbnailProgressBarWidth'     => $this->ranger_attribute( 100, 100, 100, '%' ),
	'thumbnailProgressThickness'    => $this->ranger_attribute( 2, 2, 2 ),
	'thumbnailProgressColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'translate'  => '',
				'solidColor' => 'rgba(255, 255, 255, 0.6)',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'gradient',
				'translate'  => '',
				'solidColor' => 'var(--sp-smart-primary-2-600)',
				'gradient'   => 'linear-gradient(90deg, var(--sp-smart-primary-2-600) 0%, var(--sp-smart-primary-2-400) 65.02%);',
			),
		),
	),
	'thumbnailTwoGeneralPreloader'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'thumbnailTwoThumbBGColor'      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'translate'  => '',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'translate'  => '',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.68) 100%)',
			),
		),
	),
	'thumbnailThumbBGColor'         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'translate'  => '',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'translate'  => '',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.68) 100%)',
			),
		),
	),
	'carouselData'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'thumbnailsData'                => array(
		'type'    => 'string',
		'default' => '',
	),

	'titleEffect'                   => array(
		'type'    => 'string',
		'default' => 'none',
	),


	'titleUnderlineEffect'          => array(
		'type'    => 'string',
		'default' => 'leftToRight',
	),
	'titleEffectColor'              => array(
		'type'    => 'string',
		'default' => '#fff',
	),

);
return array_merge( $post_thumbnail_two_attributes, $shared_attributes, $carousel_attributes );
