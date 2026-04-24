<?php
/**
 * Timeline block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_timeline_attributes = array(
	'paginationEnable'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'timelineLayout'                => array(
		'type'    => 'string',
		'default' => '',
	),
	'largeItemHeight'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'gapBetweenPosts'               => $this->ranger_attribute( 32 ),
	'timelineIconSource'            => array(
		'type'    => 'string',
		'default' => 'icon-font',
	),
	'timelineSize'                  => $this->ranger_attribute( 16 ),
	'timelineWidth'                 => $this->ranger_attribute( 32 ),
	'timelineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'timelineConnectorWidth'        => $this->ranger_attribute( 2 ),
	'timelineConnectorColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'  => '#E0E0E0',
			'active' => 'var(--smart-post-secondary)',
		),
	),
	'timelineIndicatorColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'  => '#E0E0E0',
			'active' => 'var(--smart-post-secondary)',
		),
	),
	'timelineCircleBgColor'         => array(
		'type'    => 'object',
		'default' => array(
			'color'  => '#FFFFFF',
			'active' => '#FFFFFF',
		),
	),
	'timelineIconColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'  => '#333333',
			'active' => '#ffffff',
		),
	),
	'timelineIconBgColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color'  => '#333333',
			'active' => '#ffffff',
		),
	),
	'timelineConnectorBorder'       => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'solid',
			'color'       => '#E0E0E0',
			'activeColor' => 'var(--smart-post-secondary)',
		),
	),
	'timelineConnectorBorderWidth'  => $this->spacing_attribute( 4, 4, 4, 4, 'px', true ),
	'timelineConnectorBorderRadius' => $this->spacing_attribute( 50, 50, 50, 50, 'px', true ),
	'postTimelineSubheadingLabel'   => array(
		'type'    => 'string',
		'default' => 'About Post Timeline',
	),
);
return array_merge( $post_timeline_attributes, $shared_attributes );
