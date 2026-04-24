<?php
/**
 * Post slider block attributes file class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_slider_two_attributes = array(
	'postSliderTwoLayout'            => array(
		'type'    => 'string',
		'default' => 'post-slider-two-layout-one',
	),
	'postSliderTwoHeight'            => $this->ranger_attribute( 620 ),
	'postSliderTwoNavArrow'          => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postSliderTwoPagination'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderTwoCarouselSpeed'     => $this->ranger_attribute( 1000, '', '', 'ms' ),
	'postSliderTwoSlideToScroll'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => 1,
				'Mobile'  => 1,
			),
		),
	),
	'postSliderTwoAnimationEffect'   => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'postSliderTwoContentAreaArray'  => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'    => 1,
				'label' => 'Title',
				'value' => 'title',
			),
			array(
				'id'    => 2,
				'label' => 'Taxonomy/Category',
				'value' => 'taxonomy',
			),
			array(
				'id'    => 3,
				'label' => 'Meta Data',
				'value' => 'metadata',
			),
			array(
				'id'    => 4,
				'label' => 'Excerpt',
				'value' => 'excerpt',
			),
			array(
				'id'    => 5,
				'label' => 'Read More',
				'value' => 'read-more',
			),
			array(
				'id'    => 6,
				'label' => 'Social Share',
				'value' => 'social-share',
			),
		),
	),
	'postSliderTwoAdaptiveHeight'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderTwoTabKeyNavigation'  => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postSliderTwoMouseWheelControl' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderTwoFreeScrollMode'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postSliderTwoPaginationDot'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselData'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'postSliderGeneralPreloader'     => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'titleEffect'                    => array(
		'type'    => 'string',
		'default' => 'none',
	),


	'titleUnderlineEffect'           => array(
		'type'    => 'string',
		'default' => 'leftToRight',
	),
	'titleEffectColor'               => array(
		'type'    => 'string',
		'default' => '#0054FB',
	),

);
return array_merge( $post_slider_two_attributes, $shared_attributes, $carousel_attributes );
