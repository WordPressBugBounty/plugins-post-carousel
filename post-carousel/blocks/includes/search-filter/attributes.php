<?php
/**
 * Search Filter attributes file.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'blockName'              => array(
		'type' => 'string',
	),
	'uniqueId'               => array(
		'type' => 'string',
	),
	'dynamicCss'             => array( 'type' => 'string' ),

	'showSearchLabel'        => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchLabel'            => array(
		'type'    => 'string',
		'default' => 'Search',
	),
	'placeholderText'        => array(
		'type'    => 'string',
		'default' => 'Search posts',
	),

	// style.
	'fieldLabelColor'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'fieldBg'                => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'fieldBorder'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'style' => '',
		),
	),
	'fieldBorderHover'       => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'style' => '',
		),
	),
	'fieldBorderWidth'       => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldBorderRadius'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldBorderWidthHover'  => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'fieldBorderRadiusHover' => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'fieldPadding'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'additionalCssClass'     => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'              => array(
		'type'    => 'string',
		'default' => '',
	),
	'titleGlobalTypography'  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'globalBreakPointData'   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'filterWidth'            => $this->ranger_attribute( '', '', '', 'px' ),
	'enableSearchIcon'       => array(
		'type'    => 'boolean',
		'default' => true,
	),
);
