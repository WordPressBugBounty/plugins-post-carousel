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

$post_thumbnail_attributes = array(
	'thumbnailSliderLayout'          => array(
		'type'    => 'string',
		'default' => 'thumbnail-slider-layout-one',
	),
	'postThumbSubheadingLabel'       => array(
		'type'    => 'string',
		'default' => 'About Post Carousel',
	),
	'postThumbnailPosition'          => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'postThumbnailHeight'            => $this->ranger_attribute( 620, 350, 220 ),
	'postThumbnailVerticalGap'       => $this->ranger_attribute( 12 ),
	'postThumbnailGap'               => $this->ranger_attribute( 10 ),
	'postThumbnailItemsPerSlide'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 5,
				'Tablet'  => 3,
				'Mobile'  => 2,
			),
		),
	),
	'postThumbnailSlideToScroll'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => 1,
				'Mobile'  => 1,
			),
		),
	),
	'postThumbnailAnimationEffect'   => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'postThumbnailAdaptiveHeight'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postThumbnailTabKeyNavigation'  => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postThumbnailMouseWheelControl' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postThumbnailFreeScrollMode'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postThumbnailNavigationArrow'   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'postThumbnailPaginationDot'     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'thumbnailItemsHeight'           => $this->ranger_attribute( 140, 100, 80 ),
	'thumbnailItemsTitleColor'       => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#DDDDDD',
			'hoverColor' => '#FFFFFF',
		),
	),
	'thumbnailItemsCateColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#DDDDDD',
			'hoverColor' => '#FFFFFF',
		),
	),
	'layoutSixPostCardBg'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#333333',
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
	'thumbnailThumbBGColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#333',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => 'var(--smart-post-secondary)',
				'gradient'    => '',
			),
		),
	),
	'postThumbnailLoop'              => array(
		'type'    => 'Boolean',
		'default' => true,
	),
	'carouselData'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'thumbnailsData'                 => array(
		'type'    => 'string',
		'default' => '',
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
		'default' => '#fff',
	),

);
return array_merge( $post_thumbnail_attributes, $shared_attributes, $carousel_attributes );
