<?php
/**
 * Post carousel block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

$post_carousel_two_attributes = array(
	'contentOnHover'       => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'titleOnHover'         => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'taxonomyOnHover'      => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'metaOnHover'          => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'excerptOnHover'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'readMoreOnHover'      => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'socialShareOnHover'   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentHoverAnimate'  => array(
		'type'    => 'string',
		'default' => 'none',
	),

	'titleEffect'          => array(
		'type'    => 'string',
		'default' => 'none',
	),

	'titleUnderlineEffect' => array(
		'type'    => 'string',
		'default' => 'leftToRight',
	),
	'titleEffectColor'     => array(
		'type'    => 'string',
		'default' => '#fff',
	),
	'partialViewSlide'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'authorPrefix'         => array(
		'type'    => 'string',
		'default' => 'By',
	),


);

return array_merge( $post_carousel_attributes, $post_carousel_two_attributes, $carousel_attributes, $shared_attributes );
