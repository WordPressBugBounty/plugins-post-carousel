<?php
/**
 * Sort filter block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'blockName'                 => array(
		'type' => 'string',
	),
	'uniqueId'                  => array(
		'type' => 'string',
	),
	'spBlockId'                 => array( 'type' => 'string' ),
	'dynamicCss'                => array( 'type' => 'string' ),
	'filterType'                => array(
		'type'    => 'string',
		'default' => 'dropdown',
	),
	'postQuery'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'sortType'                  => array(
		'type'    => 'string',
		'default' => 'both',
	),
	'showSortLabel'             => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'chooseOrderBy'             => array(
		'type'    => 'array',
		'default' => array(),
	),
	'orderByLabel'              => array(
		'type'    => 'array',
		'default' => array(
			'title' => array(
				'asc' => 'Title Asc',
				'des' => 'Title des',
			),
		),
	),
	'sortByLabel'               => array(
		'type'    => 'string',
		'default' => 'Sort By',
	),
	'placeholderLabel'          => array(
		'type'    => 'string',
		'default' => 'None',
	),

	'alignment'                 => array(
		'type'    => 'string',
		'default' => 'center',
	),

	// style.
	'fieldLabelColor'           => array(
		'type'    => 'string',
		'default' => '',
	),
	'fieldOptionColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'fieldBg'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'fieldBorder'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'style' => '',
		),
	),
	'fieldBorderHover'          => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'style' => '',
		),
	),
	'fieldBorderWidth'          => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldBorderRadius'         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldBorderWidthHover'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldBorderRadiusHover'    => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'fieldPadding'              => $this->spacing_attribute( '', '', '', '', 'px', true ),
	// Dropdown.
	'dropdownOptionColor'       => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'dropdownOptionBg'          => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'dropdownOptionBorder'      => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#CCCCCC',
		),
	),

	'dropdownOptionBorderWidth' => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'dropdownBorderRadius'      => $this->spacing_attribute( '4', '4', '4', '4', 'px', true ),
	'dropdownGap'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 16,
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
	'dropdownShadowEnable'      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'dropdownShadow'            => array(
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
			'color'         => '#4E4F521A',
			'selectDefault' => 'button-shadow-4dp',
		),
	),
	'dropdownShadowEnableHover' => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'dropdownShadowHover'       => array(
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
			'color'         => '#4E4F521A',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'dropdownPadding'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'dropdownMargin'            => $this->spacing_attribute( 8, '', '', '', 'px', false ),
	// Search.
	'searchPlaceholderText'     => array(
		'type'    => 'string',
		'default' => 'Search...',
	),
	'searchColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'searchPlaceholderColor'    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'searchBG'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => 'var(--sp-smart-primary-2-600)',
			'hoverColor' => '',
		),
	),
	'searchBorder'              => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#4e4f52',
		),
	),
	'searchBorderWidth'         => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'searchBorderRadius'        => $this->spacing_attribute( 5, 5, 5, 5, 'px', true ),
	'searchPadding'             => $this->spacing_attribute( 5, 10, 5, 10, 'px', false ),

	// button style.
	'buttonColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'buttonBg'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'buttonBorder'              => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'buttonBorderWidth'         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'buttonBorderRadius'        => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'buttonBorderHover'         => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '',
		),
	),
	'buttonGap'                 => $this->ranger_attribute( 10 ),
	'buttonBorderWidthHover'    => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'buttonBorderRadiusHover'   => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'buttonPadding'             => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'additionalCssClass'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'titleGlobalTypography'     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'globalBreakPointData'      => array(
		'type'    => 'object',
		'default' => array(),
	),
	'filterWidth'               => $this->ranger_attribute( '', '', '', 'px' ),
);
