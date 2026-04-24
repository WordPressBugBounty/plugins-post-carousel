<?php
/**
 * News ticker block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$news_ticker_attributes = array(
	'icon'                                => array(
		'type'    => 'string',
		'default' => 'p',
	),
	'postQuery'                           => array(
		'type'    => 'string',
		'default' => '',
	),

	'newsCarouselArrowSpaceBetween'       => $this->ranger_attribute( 0, 0, 0 ),

	'newsTickerCarouselArrowWidth'        => $this->ranger_attribute( 25, 25, 25 ),
	'queryData'                           => array(
		'type'    => 'array',
		'default' => array(),
	),
	'headingStyle'                        => array(
		'type'    => 'string',
		'default' => 'one',
	),
	'carouselHeight'                      => array(
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
	'tickerHeight'                        => array(
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
	'tickerStickyTopPosition'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '48',
				'Tablet'  => '48',
				'Mobile'  => '48',
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'slideToScroll'                       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'carouselAnimationEffect'             => array(
		'type'    => 'string',
		'default' => 'slide',
	),
	'carouselAdaptiveHeight'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselTabKeyNav'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselMouseWheelControl'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselFreeScrollMode'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselLayoutAttributes'            => array(
		'type'    => 'string',
		'default' => '',
	),
	'carouselSubheadingLabel'             => array(
		'type'    => 'string',
		'default' => 'About Post Carousel',
	),
	'carouselTickerSpeed'                 => array(
		'type'    => 'object',
		'default' => array(
			'value' => 3000,
			'unit'  => 'ms',
		),
	),
	'displayStyle'                        => array(
		'type'    => 'string',
		'default' => 'ticker',
	),
	'newsTitleHTMLTag'                    => array(
		'type'    => 'string',
		'default' => 'h3',
	),
	'newsTitleLength'                     => array(
		'type'    => 'object',
		'default' => array(
			'value' => 7,
			'unit'  => 'words',
		),
	),
	'newsTitleTypography'                 => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '',
				'style'      => '',
				'transform'  => '',
				'decoration' => '',
			),
		),
	),
	'newsTitleFontSize'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 22,
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
	'newsTitleLatterSpacing'              => array(
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
	'newsTitleWordSpacing'                => array(
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
	'newsTitleLineHeight'                 => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.3,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'newsTitleColor'                      => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#333333',
			'hoverColor' => '#EF5D30',
		),
	),
	'newsTitleMargin'                     => array(
		'type'    => 'object',
		'default' => array(
			'device'    => array(
				'Desktop' => array(
					'top'    => 6,
					'right'  => 0,
					'bottom' => 0,
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
			'unit'      => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
			'allChange' => false,
		),
	),

	'ContentBorder'                       => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'solid',
			'color'      => '#4E4F52',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'ContentBorderWidth'                  => array(
		'type'    => 'object',
		'default' => array(
			'device'    => array(
				'Desktop' => array(
					'top'    => '1',
					'right'  => '1',
					'bottom' => '1',
					'left'   => '1',
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
			'unit'      => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
			'allChange' => true,
		),
	),
	'ContentBorderRadius'                 => array(
		'type'    => 'object',
		'default' => array(
			'device'    => array(
				'Desktop' => array(
					'top'    => '5',
					'right'  => '5',
					'bottom' => '5',
					'left'   => '5',
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
			'unit'      => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
			'allChange' => true,
		),
	),
	'contentBg'                           => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#FFFFFF',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => 'var(--smart-post-secondary)',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
		),
	),
	'gapBetweenHeadingContent'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 5,
				'Tablet'  => 5,
				'Mobile'  => 5,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'newsTickerShadowEnable'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'newsTickerBoxShadow'                 => array(
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
			'color'         => '#89898B',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'HeadingLabel'                        => array(
		'type'    => 'string',
		'default' => 'Latest News',
	),
	'HeadingPosition'                     => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'headingTypography'                   => array(
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
	'headingGlobalTypography'             => array(
		'type'    => 'object',
		'default' => array(),
	),
	'headingFontSize'                     => array(
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
	'headingLatterSpacing'                => array(
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
	'headingWordSpacing'                  => array(
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
	'headingLineHeight'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'headingColor'                        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FEFEFE',
			'hoverColor' => '#EF5D30',
		),
	),
	'tickerHeadingBg'                     => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#023047',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => 'var(--smart-post-secondary)',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
		),
	),
	'tickerTitleGap'                      => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 24,
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
	'tickerTitleTypography'               => array(
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
	'tickerTitleGlobalTypography'         => array(
		'type'    => 'object',
		'default' => array(),
	),
	'tickerTitleFontSize'                 => array(
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
	'tickerTitleLatterSpacing'            => array(
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
	'tickerTitleWordSpacing'              => array(
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
	'tickerTitleLineHeight'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'tickerTitleColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FEFEFE',
			'hoverColor' => '#EF5D30',
		),
	),

	'tickerIconEnabled'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),

	'tickerIconSource'                    => array(
		'type'    => 'string',
		'default' => 'newsIcon',
	),

	'tickerIconColor'                     => array(
		'type'    => 'string',
		'default' => '#FEFEFE',
	),

	'tickerIconPosition'                  => array(
		'type'    => 'string',
		'default' => 'left',
	),

	'tickertitleColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4E4F52',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),

	'tickerSeparatorEnable'               => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerTitleListStyleEnble'           => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerListStyle'                     => array(
		'type'    => 'string',
		'default' => 'list1',
	),

	'tickerListStyleColor'                => array(
		'type'    => 'string',
		'default' => '#023047',
	),
	'tickerDate'                          => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerDateType'                      => array(
		'type'    => 'string',
		'default' => 'date',
	),

	'tickerDateStyle'                     => array(
		'type'    => 'string',
		'default' => 'text',
	),

	'tickerDateColor'                     => array(
		'type'    => 'string',
		'default' => '#989595',
	),

	'tickerDateBgColor'                   => array(
		'type'    => 'string',
		'default' => '#E1E1E1',
	),

	'tickerDateTypography'                => array(
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
	'tickerDateGlobalTypography'          => array(
		'type'    => 'object',
		'default' => array(),
	),
	'tickerDateFontSize'                  => array(
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

	'tickerDateLatterSpacing'             => array(
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
	'tickerDateWordSpacing'               => array(
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

	'tickerDateLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),

	'tickerImagePosition'                 => array(
		'type'    => 'string',
		'default' => 'left',
	),

	'tickerImageWidth'                    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 20,
				'Tablet'  => 20,
				'Mobile'  => 20,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'tickerImageHeight'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 20,
				'Tablet'  => 20,
				'Mobile'  => 20,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),

	'tickerImg'                           => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerImgSize'                       => array(
		'type'    => 'string',
		'default' => 'custom',
	),

	'tickerImgShape'                      => array(
		'type'    => 'string',
		'default' => 'circle',
	),

	'tickerNavigation'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerPause'                         => array(
		'type'    => 'boolean',
		'default' => false,
	),

	'tickerDivider'                       => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'tickerOpenNewTab'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'tickerDisplaySticky'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'newsTickerArrowBgColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FFFFFF',
			'hoverColor' => '#FFFFFF',
		),
	),
	'newsTickerCarouselArrowColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#023047',
			'hoverColor' => '#023047',
		),
	),
	'newsTickerCarouselArrowBorderRadius' => $this->spacing_attribute( 5, 5, 5, 5, '%', true ),

	'newsTickerCarouselArrowBorder'       => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#4E4F52',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'newsTickerIconSize'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 24,
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
	'newsTickerHeadingPadding'            => $this->spacing_attribute( 15, 24, 15, 24, 'px', false ),
	'titleListStyleIconSize'              => array(
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
	'carouselArrowHeight'                 => $this->ranger_attribute( 40 ),
	'titleListStyleIconGap'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 4,
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
	'newsTickerImageRadius'               => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'newsTickerCarouselDividerColor'      => array(
		'type'    => 'string',
		'default' => '#999',
	),
	'newsTickerItemToDisplay'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'additionalCssClass'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                           => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'globalBreakPointData'                => array(
		'type'    => 'object',
		'default' => array(),
	),
);


return array_merge( $news_ticker_attributes, $shared_attributes, $carousel_attributes );
