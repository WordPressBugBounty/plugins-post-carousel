<?php
/**
 * Smart Search Block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	'uniqueId'                          => array(
		'type'    => 'string',
		'default' => '',
	),

	'dynamicCss'                        => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockName'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	// General.
	'searchFormPreset'                  => array(
		'type'    => 'string',
		'default' => 'smart-search-form-preset-one',
	),
	'displayType'                       => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'placeholderEnable'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'placeholder'                       => array(
		'type'    => 'string',
		'default' => 'Search',
	),
	'searchIconDivider'                 => array(
		'type'    => 'string',
		'default' => 'Search',
	),

	'searchFormAlignment'               => array(
		'type'    => 'string',
		'default' => 'flex-start',
	),
	'inputPlaceholderTypography'        => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'inputPlaceHolderGlobalTypography'  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'inputPlaceholderFontSize'          => array(
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
	'inputPlaceholderLineHeight'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'inputPlaceholderLatterSpacing'     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'inputPlaceholderWordSpacing'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'inputPlaceholderColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#CCCCCC',
			'hoverColor' => '',
		),
	),
	'searchFormBgColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'searchFormBorder'                  => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#CCCCCC',
		),
	),
	'searchIconDividerColor'            => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#BBBBBB',
		),
	),
	'searchFormBorderWidth'             => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'searchFormHoverBorder'             => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#CCCCCC',
		),
	),
	'searchFormHoverBorderWidth'        => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'searchFormBorderRadius'            => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchFormHoverBorderRadius'       => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchFormPadding'                 => $this->spacing_attribute( 10, 12, 10, 12, 'px', true ),
	'searchFormWidth'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 100,
				'Tablet'  => 100,
				'Mobile'  => 100,
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => '%',
				'Mobile'  => '%',
			),
		),
	),
	'searchFormHeight'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 44,
				'Tablet'  => 44,
				'Mobile'  => 44,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	// search button.
	'searchBtnLabelTypography'          => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'searchBtnLabelFontSize'            => $this->ranger_attribute( 14, 13, 12, 'px' ),
	'searchBtnLabelLineHeight'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'searchIcon'                        => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchButtonIconSize'              => $this->ranger_attribute( 20, 20, 20, 'px' ),
	'searchButtonPosition'              => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'searchButtonNewTabEnable'          => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchButtonIconColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '',
		),
	),
	'searchBtnLabelTextColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffff',
			'hoverColor' => '',
		),
	),
	'searchBtnBgColor'                  => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#2F2F2F',
				'gradient'    => 'linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 50%, #E0EAFC 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 50%, #E0EAFC 100%)',
			),
		),
	),
	'searchButtonBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#2F2F2F',
		),
	),
	'searchButtonHoverBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#2F2F2F',
		),
	),
	'searchButtonBorderWidth'           => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'searchButtonHoverBorderWidth'      => $this->spacing_attribute( '1', '1', '1', '1', 'px', true ),
	'searchButtonBorderRadius'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchButtonPadding'               => $this->spacing_attribute( 12, 12, 12, 12, 'px', true ),
	'gapWithIcon'                       => $this->ranger_attribute( 6, 6, 6, 'px' ),
	'gapWithSearchField'                => $this->ranger_attribute( 6, 6, 6, 'px' ),
	'searchBtnLabel'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchBtnLabelText'                => array(
		'type'    => 'string',
		'default' => 'Search',
	),
	'searchBtnReverse'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	// Search Result General.
	'ajaxSearch'                        => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchResultDisplayType'           => array(
		'type'    => 'string',
		'default' => 'smart-search-result-layout-one',
	),
	'searchResultNotFoundText'          => array(
		'type'    => 'string',
		'default' => 'No Result Found',
	),
	'searchResultColumns'               => $this->ranger_attribute( 1 ),
	'searchResultColumnGap'             => $this->ranger_attribute( 5, 5, 5, 'px' ),
	'searchResultBoxWidth'              => $this->ranger_attribute( 100, 100, 100, '%' ),
	'searchResultBoxHeight'             => $this->ranger_attribute( 552, 552, 552, 'px' ),
	'searchResultShowImage'             => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchResultImageSize'             => $this->ranger_attribute( 55, 55, 55, 'px' ),
	'searchResultImageContentGap'       => $this->ranger_attribute( 15, 15, 15, 'px' ),
	'searchResultShowExcerpt'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'searchResultExcerptLimit'          => array(
		'type'    => 'object',
		'default' => array(
			'value' => 10,
			'unit'  => 'words',
		),
	),
	'searchResultShowTaxonomy'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'searchResultShowAuthor'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'searchResultShowDate'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchResultSpaceBetweenMeta'      => $this->ranger_attribute( '', '', '', 'px' ),
	'hightLightSearchTerm'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchResultItemSeparator'         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'searchResultHorizontalPosition'    => $this->ranger_attribute( 0, 0, 0, 'px' ),
	'searchResultVerticalPosition'      => $this->ranger_attribute( 100, 100, 100, '%' ),
	// Search Result Style.
	'searchResultTitleTypography'       => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'searchResultTitleGlobalTypography' => array(
		'type'    => 'object',
		'default' => array(),
	),
	'searchResultTitleFontSize'         => $this->ranger_attribute( '', '', '', 'px' ),
	'searchResultTitleLineHeight'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'searchResultMetaTypography'        => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'searchResultMetaGlobalTypography'  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'searchResultMetaFontSize'          => $this->ranger_attribute( '', '', '', 'px' ),
	'searchResultMetaLineHeight'        => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'searchResultTitleColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '',
		),
	),
	'searchResultMetaColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '',
		),
	),
	'searchResultHighlightColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#641DD7',
			'hoverColor' => '',
		),
	),
	'searchResultItemSeparatorColor'    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#DDDDDD',
			'hoverColor' => '',
		),
	),
	'searchResultBoxBackground'         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => '',
			),
		),
	),
	'searchResultBoxBorder'             => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#CCCCCC',
		),
	),
	'searchResultHoverBoxBorder'        => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#CCCCCC',
		),
	),
	'searchResultBoxBorderWidth'        => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchResultHoverBoxBorderWidth'   => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchResultBoxBorderRadius'       => $this->spacing_attribute( 4, 4, 4, 4, 'px', true ),
	'searchResultBoxHoverBorderRadius'  => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'searchResultBoxPadding'            => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'searchResultImgBorderRadius'       => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	// Query & Filter.
	'postType'                          => array(
		'type'    => 'string',
		'default' => 'post',
	),
	'taxonomyFilterEnable'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'selectedTaxonomy'                  => array(
		'type'    => 'string',
		'default' => 'category',
	),
	'selectedTerms'                     => array(
		'type'    => 'array',
		'default' => array(),
	),
	'filterLabelText'                   => array(
		'type'    => 'string',
		'default' => 'All Categories',
	),
	// More results.
	'moreResultsEnable'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'showResultsCount'                  => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'initialPostDisplay'                => array(
		'type'    => 'object',
		'default' => array(
			'value' => 4,
			'unit'  => '',
		),
	),
	'moreResultLabelText'               => array(
		'type'    => 'string',
		'default' => 'View More',
	),
	'moreResultClickAction'             => array(
		'type'    => 'string',
		'default' => 'expanded',
	),
	'moreResultTypography'              => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'moreResultGlobalTypography'        => array(
		'type'    => 'object',
		'default' => array(),
	),
	'moreResultFontSize'                => $this->ranger_attribute( '', '', '', 'px' ),
	'moreResultLineHeight'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'moreResultLatterSpacing'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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

	'moreResultWordSpacing'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'moreResultColor'                   => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '',
		),
	),
	// Popup Canvas.
	'popupCanvasWidth'                  => $this->ranger_attribute( 500, 500, 500, 'px' ),
	'enablePopupHeading'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'popupHeadingText'                  => array(
		'type'    => 'string',
		'default' => 'Search & Discover',
	),
	'popupHeadingGap'                   => $this->ranger_attribute( 15, 10, 5, 'px' ),
	'enablePopupCloseButton'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'popupCloseBtnIconSize'             => $this->ranger_attribute( 10, 10, 10, 'px' ),
	'popupHeadingAlignment'             => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'popupHeadingTypography'            => array(
		'type'    => 'object',
		'default' => array(
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'popupHeadingGlobalTypography'      => array(
		'type'    => 'object',
		'default' => array(),
	),
	'popupHeadingFontSize'              => array(
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
	'popupHeadingLineHeight'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'popupHeadingLatterSpacing'         => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'popupHeadingWordSpacing'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 0,
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
	'popupHeadingColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '',
		),
	),
	'popupCloseIconColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '',
		),
	),
	'popupCanvasBgColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 50%, #E0EAFC 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 50%, #E0EAFC 100%)',
			),
		),
	),
	'popupCanvasBorder'                 => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '#2F2F2F',
		),
	),
	'popupCanvasHoverBorder'            => array(
		'type'    => 'object',
		'default' => array(
			'style' => '',
			'color' => '#2F2F2F',
		),
	),
	'popupCanvasBorderWidth'            => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'popupCanvasHoverBorderWidth'       => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'popupCanvasBorderRadius'           => $this->spacing_attribute( 4, 4, 4, 4, 'px', true ),
	'popupCanvasPadding'                => $this->spacing_attribute( 24, 24, 24, 24, 'px', true ),
	'popupCanvasMargin'                 => $this->spacing_attribute( 15, 0, 0, 0, 'px', true ),
	'popupCanvasBoxShadowEnable'        => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'popupCanvasBoxShadowValue'         => array(
		'type'    => 'object',
		'default' => array(
			'value'         => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'          => 'outset',
			'color'         => '#ddd',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),

	// advanced.
	'isPreview'                         => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'additionalCssClass'                => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'fontLists'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontListsEditPage'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'globalBreakPointData'              => array(
		'type'    => 'object',
		'default' => array(),
	),
);
