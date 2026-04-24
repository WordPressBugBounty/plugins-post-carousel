<?php
/**
 * Shared attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content_area_attr = array(
	'contentVerticalPosition'       => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'contentHorizontalPosition'     => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'contentAreaWidth'              => $this->ranger_attribute( '80', '85', '85', '%' ),
	'contentAreaHeight'             => $this->ranger_attribute( '', '', '', '%' ),
	'contentAreaBg'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.92) 0%, rgba(136, 169, 231, 0.89) 51%, rgba(144, 234, 228, 0.86) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.9) 0%, rgba(136, 169, 231, 0.75) 51%, rgba(144, 234, 228, 0.7) 100%)',
			),
		),
	),
	'contentAreaBorder'             => array(
		'type'    => 'object',
		'default' => array(
			'style'       => 'none',
			'color'       => '#cccccc',
			'hoverColor'  => '',
			'activeColor' => '#000000',
		),
	),
	'contentAreaBorderWidth'        => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'contentAreaBorderRadius'       => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'contentAreaEnableBoxShadow'    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentAreaBoxShadow'          => array(
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
	'contentAreaPadding'            => $this->spacing_attribute(),
	'largeContentAreaPadding'       => $this->spacing_attribute(),
	'contentAreaMargin'             => $this->spacing_attribute( '' ),
	'contentAreaHoverBorderWidth'   => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'contentAreaHoverBorderRadius'  => $this->spacing_attribute(),
	'contentAreaInnerWidth'         => $this->ranger_attribute( 85, '', 100, '%' ),
	'contentAreaThumbsBorder'       => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'solid',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'contentAreaThumbsBorderWidth'  => $this->spacing_attribute(),
	'contentAreaThumbsBorderRadius' => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'postCardBg'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'postCardBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'postCardBorderWidth'           => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'postCardHoverBorderWidth'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'postCardBorderRadius'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'postCardHoverBorderRadius'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'postCardBoxShadowEnable'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postCardHoverBoxShadowEnable'  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'multipleFilterRelation'        => array(
		'type'    => 'string',
		'default' => 'and',
	),
	'postCardBoxShadow'             => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 5,
					'right'  => 5,
					'bottom' => 10,
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
	'postCardHoverBoxShadow'        => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 5,
					'right'  => 5,
					'bottom' => 10,
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
	'postCardPadding'               => $this->spacing_attribute( '', '', '', '', 'px', true ),
);
$style_title       = array(
	'titleShow'                      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'titleHTMLTag'                   => array(
		'type'    => 'string',
		'default' => 'h3',
	),
	'titleType'                      => array(
		'type'    => 'string',
		'default' => 'full',
	),
	'titleLength'                    => array(
		'type'    => 'object',
		'default' => array(
			'value' => 7,
			'unit'  => 'words',
		),
	),
	'titleTypography'                => array(
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
	'titleGlobalTypography'          => array(
		'type'    => 'object',
		'default' => array(),
	),
	'titleFontSize'                  => $this->ranger_attribute( '', '', '', 'px' ),
	'titleLatterSpacing'             => $this->ranger_attribute( '' ),
	'titleWordSpacing'               => $this->ranger_attribute( '' ),
	'titleLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'titleColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'titleMargin'                    => $this->spacing_attribute( '' ),
	'largeItemTitleColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#000000',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'largeItemTitleLineHeight'       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'largeItemTitleTypography'       => array(
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
	'largeItemTitleGlobalTypography' => array(
		'type'    => 'object',
		'default' => array(),
	),
	'largeItemTitleFontSize'         => $this->ranger_attribute( 26 ),
	'largeItemTitleLatterSpacing'    => array(
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
	'largeItemTitleWordSpacing'      => $this->ranger_attribute( '' ),
	'postBadgesShow'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postBadgesPosition'             => array(
		'type'    => 'string',
		'default' => 'before-title',
	),
	'badgesGap'                      => $this->ranger_attribute( 3, 3, 3, 'px' ),
	'postBadgesTypography'           => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '600',
				'style'      => 'normal',
				'transform'  => 'uppercase',
				'decoration' => '',
			),
		),
	),
	'postBadgesGlobalTypography'     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'postBadgesFontSize'             => $this->ranger_attribute( 12 ),
	'postBadgesLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.3,
				'Tablet'  => 1.3,
				'Mobile'  => 1.3,
			),
		),
	),
	'postBadgesLetterSpacing'        => $this->ranger_attribute( '' ),
	'postBadgesWordSpacing'          => $this->ranger_attribute( '' ),

	'postBadgesEffectColor'          => array(
		'type'    => 'string',
		'default' => '#FFFFFF',
	),
	'badgesLabelColor'               => array(
		'type'    => 'string',
		'default' => '#FFFFFF',
	),
	'badgesBgColor'                  => array(
		'type'    => 'string',
		'default' => '#FF5B2E',
	),
	'badgesBorder'                   => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'badgesBorderWidth'              => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'badgesBorderRadius'             => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'badgesPadding'                  => $this->spacing_attribute( 4, 8, 4, 8, 'px', false ),
);
$shared_attributes = array(
	'liveFilterEnable'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'alignment'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'uniqueId'                           => array( 'type' => 'string' ),
	'spBlockId'                          => array( 'type' => 'string' ),
	'isPreview'                          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'postQuery'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'paginationUniqueId'                 => array( 'type' => 'string' ),
	'dynamicCss'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockLocation'                      => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontLists'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontListsEditPage'                  => array(
		'type'    => 'string',
		'default' => '',
	),
	'blockName'                          => array(
		'type'    => 'string',
		'default' => '',
	),
	'contentOrientation'                 => array(
		'type'    => 'string',
		'default' => 'orientation_one',
	),
	'openedAccordion'                    => array(
		'type'    => 'string',
		'default' => 'general',
	),
	'contentAlignment'                   => array(
		'type'    => 'string',
		'default' => 'left',
	),
	'smallItemContentAlignment'          => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'generalLinkOpen'                    => array(
		'type'    => 'string',
		'default' => 'new-tab',
	),
	'preloaderEnable'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'tabName'                            => array(
		'type'    => 'string',
		'default' => 'general',
	),
	// 'itemsPerPage'                          => array(
	// 'type'    => 'number',
	// 'default' => 6,
	// ),
	'keywordSearchIconSize'              => $this->ranger_attribute( 24 ),
	'keywordSearchInputWidth'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 33,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => '%',
				'Tablet'  => 'px',
				'Mobile'  => 'px',
			),
		),
	),
	'keywordSearchInputHeight'           => $this->ranger_attribute( 40 ),
	'showFeatureVideo'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'showImageGallery'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageGallerySource'                 => array(
		'type'    => 'string',
		'default' => 'post_gallery',
	),
	'showImageGalleryNavArrow'           => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'showImageGalleryNavArrowHover'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageGalleryNavArrowStyle'          => array(
		'type'    => 'string',
		'default' => 'chevron-solid',
	),
	'imageGalleryNavArrowSize'           => $this->ranger_attribute( 12 ),
	'imageFeaturedImg'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'imageGalleryNavArrowColor'          => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'imageGalleryNavArrowBgColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'imageSize'                          => array(
		'type'    => 'string',
		'default' => 'smart-post-landscape',
	),
	'imageWidth'                         => $this->ranger_attribute( '', '', '', '%' ),
	'imageHeight'                        => $this->ranger_attribute( '' ),
	'largeImageSize'                     => array(
		'type'    => 'string',
		'default' => 'custom',
	),
	'largeImageWidth'                    => $this->ranger_attribute( 100, '', '', '%' ),
	'largeImageHeight'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => 210,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => '%',
				'Mobile'  => 'px',
			),
		),
	),
	'imagePosition'                      => array(
		'type'    => 'string',
		'default' => 'top',
	),
	'imageOverlayType'                   => array(
		'type'    => 'string',
		'default' => 'full',
	),
	'imageOverlayColor'                  => array(
		'type'    => 'string',
		'default' => 'no-overlay',
	),
	'imageOverlayCustomColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#000000AD',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 5%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#000000AD',
				'gradient'    => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'imageScale'                         => array(
		'type'    => 'string',
		'default' => 'cover',
	),
	'imageFallbackReplace'               => array(
		'type'    => 'string',
		'default' => 'source',
	),
	'imageSrcset'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageLazyLoad'                      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'imageReplaceWith'                   => array(
		'type'    => 'array',
		'default' => array(),
	),
	'toggleCustomFallbackBg'             => array(
		'type'    => 'string',
		'default' => 'img',
	),
	'imageHoverEffect'                   => array(
		'type'    => 'string',
		'default' => 'zoom-in',
	),
	'imageOpacityEffect'                 => array(
		'type'    => 'number',
		'default' => 1,
	),
	// 'imageMode'                          => array(
	// 'type'    => 'string',
	// 'default' => 'original',
	// ),
	// 'imageGrayscaleHover'                => array(
	// 'type'    => 'boolean',
	// 'default' => false,
	// ),
	// 'imageNormalHover'                   => array(
	// 'type'    => 'boolean',
	// 'default' => false,
	// ),
	'imageGrayscaleLevel'                => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => '%',
		),
	),
	'imageGrayscaleLevelHover'           => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => '%',
		),
	),
	'imageBlurEffect'                    => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => 'px',
		),
	),
	'imageBlurEffectHover'               => array(
		'type'    => 'object',
		'default' => array(
			'value' => 0,
			'unit'  => 'px',
		),
	),
	'imageBrightness'                    => array(
		'type'    => 'number',
		'default' => 1,
	),
	'imageBrightnessHover'               => array(
		'type'    => 'number',
		'default' => 1,
	),
	'imageRadius'                        => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'imageSpace'                         => $this->ranger_attribute( 12, 12, 12, 'px' ),
	'imageReplaceWithCustomBg'           => array(
		'type'    => 'string',
		'default' => 'image',
	),
	'imageReplaceWithImage'              => array(
		'type'    => 'object',
		'default' => array(),
	),
	'imageReplaceWithVideo'              => array(
		'type'    => 'object',
		'default' => array(),
	),
	'metaAuthorShow'                     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaAuthorStyle'                    => array(
		'type'    => 'string',
		'default' => 'name_with_icon',
	),
	'metaUserIcon'                       => array(
		'type'    => 'string',
		'default' => 'outline',
	),
	'metaDateShow'                       => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaDateFormat'                     => array(
		'type'    => 'string',
		'default' => 'default',
	),
	'metaCommentCounter'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaViewCount'                      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaLike'                           => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaReadingTime'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'metaPerMin'                         => array(
		'type'    => 'object',
		'default' => array(
			'value' => 100,
			'unit'  => 'words',
		),
	),
	'metaReadingTimePostfix'             => array(
		'type'    => 'string',
		'default' => 'Read',
	),
	'metaTypography'                     => array(
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
	'metaGlobalTypography'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'metaFontSize'                       => $this->ranger_attribute( '' ),
	'metaFontSpacing'                    => $this->ranger_attribute( '' ),
	'metaWordSpacing'                    => $this->ranger_attribute( '' ),
	'metaLineHeight'                     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'metaLargeTypography'                => array(
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
	'metaLargeFontSize'                  => $this->ranger_attribute( 14 ),
	'metaLargeFontSpacing'               => $this->ranger_attribute( '' ),
	'metaLargeWordSpacing'               => $this->ranger_attribute( '' ),
	'metaLargeLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'advancedBg'                         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'transparent',
				'transparent' => '',
				'solidColor'  => '#E9F4FFF2',
				'gradient'    => 'linear-gradient(135deg,rgba(179,50,95,0.44) 0%,rgba(227,86,43,0.45) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgba(179,50,95,0.44) 0%,rgba(227,86,43,0.45) 100%)',
			),
		),
	),
	'metaColors'                         => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'largeMetaColors'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#d5d5d5',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'metaSeparator'                      => array(
		'type'    => 'string',
		'default' => 'normal-space',
	),
	'metaSeparatorColor'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'metaSpaceBetween'                   => array(
		'type'    => 'number',
		'default' => array( 'value' => 12 ),
	),
	'metaRowGap'                         => array(
		'type'    => 'number',
		'default' => array( 'value' => 4 ),
	),
	'metadataMargin'                     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'excerptShow'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'seoMetaShow'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'activeSeoPlugin'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'excerptType'                        => array(
		'type'    => 'string',
		'default' => 'limited',
	),
	'excerptLength'                      => array(
		'type'    => 'object',
		'default' => array(
			'value' => 14,
			'unit'  => 'words',
		),
	),
	'ellipsisPointsEndingExcerpt'        => array(
		'type'    => 'string',
		'default' => '...',
	),
	'excerptTypography'                  => array(
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
	'excerptGlobalTypography'            => array(
		'type'    => 'object',
		'default' => array(),
	),
	'excerptFontSize'                    => $this->ranger_attribute( '' ),
	'excerptFontSpacing'                 => $this->ranger_attribute( '' ),
	'excerptWordSpacing'                 => $this->ranger_attribute( '' ),
	'excerptLineHeight'                  => array(
		'type'    => 'object',
		'default' => array(
			'device'    => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'      => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
			'allChange' => true,
		),
	),
	'excerptColor'                       => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'largeExcerptColor'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'excerptMargin'                      => array(
		'type'    => 'object',
		'default' => array(
			'device'    => array(
				'Desktop' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
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
	'displayAdvertisement'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advertisementPosition'              => array(
		'type'    => 'string',
		'default' => 'random',
	),
	'repeatAdvertisement'                => array(
		'type'    => 'object',
		'default' => array( 'value' => 1 ),
	),
	'adContents'                         => array(
		'type'    => 'array',
		'default' => array(),
	),
	'advertisementPositionNumber'        => array( 'type' => 'number' ),
	'showReadMoreButton'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'readMoreButtonLabel'                => array(
		'type'    => 'string',
		'default' => 'Read More',
	),
	'readMoreButtonTypography'           => array(
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
	'readMoreButtonGlobalTypography'     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'readMoreButtonFontSize'             => $this->ranger_attribute( '' ),
	'readMoreButtonFontSpacing'          => $this->ranger_attribute( '' ),
	'readMoreButtonWordSpacing'          => $this->ranger_attribute( '' ),
	'readMoreButtonLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'readMoreIocVisibility'              => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'readMoreIconStyle'                  => array(
		'type'    => 'string',
		'default' => 'right-open',
	),
	'readMoreIconGap'                    => $this->ranger_attribute( 4, 4, 4 ),
	'readMoreColor'                      => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'largeItemReadMoreColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'readMoreBg'                         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => '',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
		),
	),
	'largeItemReadMoreBg'                => array(
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
	'readMoreButtonPadding'              => $this->spacing_attribute( '', '', '', '', 'px', false ),
	'readMoreButtonMargin'               => $this->spacing_attribute( '', '', '', '', 'px', false ),
	'readMoreButtonBorder'               => array(
		'type'    => 'object',
		'default' => array(
			'style'      => '',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'readMoreButtonBorderWidth'          => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'readMoreButtonBorderWidthHover'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'largeItemReadMoreButtonBorder'      => array(
		'type'    => 'object',
		'default' => array(
			'style'      => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'largeItemReadMoreButtonBorderWidth' => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'readMoreButtonBorderRadius'         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'readMoreButtonBorderRadiusHover'    => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'socialShareEnableSocial'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialSharingMedia'                 => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'    => 1,
				'label' => 'Facebook',
				'value' => 'facebook',
			),
			array(
				'id'    => 2,
				'label' => 'X',
				'value' => 'x',
			),
			array(
				'id'    => 3,
				'label' => 'LinkedIn',
				'value' => 'linkedin',
			),
		),
	),
	'socialShareIconSize'                => array(
		'type'    => 'object',
		'default' => array(
			'value' => 16,
			'unit'  => 'px',
		),
	),
	'socialShareIconType'                => array(
		'type'    => 'string',
		'default' => 'original',
	),
	'socialIconOnly'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialShareCustomColor'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FFFFFF',
			'hoverColor' => '',
		),
	),
	'socialShareCustomBgColor'           => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4e4f52',
			'hoverColor' => 'var(--smart-post-secondary)',
		),
	),
	'socialShareBorderRadius'            => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'socialShareBorder'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#4e4f52',
			'style'      => 'none',
			'hoverColor' => '#4e4f52',
		),
	),
	'socialShareBorderWidth'             => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'socialShareSpaceBetween'            => array(
		'type'    => 'object',
		'default' => array(
			'value' => 8,
			'unit'  => 'px',
		),
	),
	'socialShareMargin'                  => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'postType'                           => array(
		'type'    => 'string',
		'default' => 'multiple_post_type',
	),
	'multiplePostType'                   => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'    => 1,
				'label' => 'Posts',
				'value' => 'post',
			),
		),
	),
	'filterProduct'                      => array(
		'type'    => 'string',
		'default' => 'recent',
	),
	'quickQuery'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'taxonomyType'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'filterByAuthor'                     => array(
		'type'    => 'array',
		'default' => array(),
	),
	'filterByDate'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'specificDate'                       => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'specificMonth'                      => array(
		'type'    => 'string',
		'default' => '1',
	),
	'specificYear'                       => array(
		'type'    => 'string',
		'default' => '2024',
	),
	'specificPeriodAfter'                => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'specificPeriodBefore'               => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'specificDateBefore'                 => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'specificDateAfter'                  => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'excludeDateBefore'                  => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'excludeDateAfter'                   => array(
		'type'    => 'string',
		'default' => wp_date( 'Y-m-d H:i:s' ),
	),
	'filterByKeyword'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'taxonomies'                         => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'          => 1,
				'type'        => '',
				'value'       => array(),
				'operator'    => 'IN',
				'initialOpen' => true,
			),
		),
	),
	'relation'                           => array(
		'type'    => 'string',
		'default' => 'AND',
	),
	'customFieldRelation'                => array(
		'type'    => 'string',
		'default' => 'AND',
	),
	'filterByCustomFields'               => array(
		'type'    => 'array',
		'default' => array(),
	),
	'orderBy'                            => array(
		'type'    => 'string',
		'default' => 'date',
	),
	'orderDirection'                     => array(
		'type'    => 'string',
		'default' => 'DESC',
	),
	'includeOnlyPost'                    => array(
		'type'    => 'array',
		'default' => array(),
	),
	'excludePost'                        => array(
		'type'    => 'array',
		'default' => array(),
	),
	'excludeTerm'                        => array(
		'type'    => 'array',
		'default' => array(),
	),
	'excludeAuthor'                      => array(
		'type'    => 'array',
		'default' => array(),
	),
	'excludeStickyPosts'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'excludeCurrentPosts'                => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'excludeProtectedPosts'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'excludeChildrenPosts'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'excludePostWithoutImagePosts'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'offset'                             => array(
		'type'    => 'number',
		'default' => 0,
	),
	'postLimit'                          => array(
		'type'    => 'string',
		'default' => '8',
	),
	'noResultFoundResult'                => array(
		'type'    => 'string',
		'default' => 'No post found',
	),
	'liveSearchText'                     => array(
		'type'    => 'string',
		'default' => '',
	),
	'catTabCategoryEnable'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'catTabCategoryType'                 => array(
		'type'    => 'string',
		'default' => 'category',
	),
	'catTabCategoryPosition'             => array(
		'type'    => 'string',
		'default' => '',
	),
	'catTabCategoryTypography'           => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
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
	'catTabCategoryGlobalTypography'     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'catTabCategoryFontSize'             => $this->ranger_attribute( '' ),
	'catTabCategoryLetterSpacing'        => $this->ranger_attribute( '' ),
	'catTabCategoryWordSpacing'          => $this->ranger_attribute( '' ),
	'catTabCategoryLineHeight'           => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'catTabCategoryColor'                => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'catTabCategoryBg'                   => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(181, 51, 97) 0%,rgb(226, 87, 44) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(181, 51, 97) 0%,rgb(226, 87, 44) 56.02%)',
			),
		),
	),
	'catTabCategoryBorder'               => array(
		'type'    => 'object',
		'default' => array(
			'style'      => '',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'catTabCategoryBorderWidth'          => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'catTabCategoryBorderWidthHover'     => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'catTabCategoryBorderRadius'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	// 'catTabCategoryBorderRadius'         => array(
	// 'type'    => 'object',
	// 'default' => array(
	// 'top'       => 0,
	// 'bottom'    => 0,
	// 'right'     => 0,
	// 'left'      => 0,
	// 'unit'      => 'px',
	// 'allChange' => true,
	// ),
	// ),
	'catTabCategoryBorderRadiusHover'    => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	// 'catTabCategoryBorderRadiusHover'    => array(
	// 'type'    => 'object',
	// 'default' => array(
	// 'top'       => 0,
	// 'bottom'    => 0,
	// 'right'     => 0,
	// 'left'      => 0,
	// 'unit'      => 'px',
	// 'allChange' => true,
	// ),
	// ),
	'catTabCategorySpaceBetween'         => array(
		'type'    => 'object',
		'default' => array(
			'value' => 4,
			'unit'  => 'px',
		),
	),
	'catTabCategoryPadding'              => $this->spacing_attribute( '', '', '', '', 'px', false ),
	'catTabCategoryMargin'               => $this->spacing_attribute(),
	'imageBorder'                        => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#4E4F52',
			'hoverColor' => '#4E4F52',
		),
	),
	'imageBorderWidth'                   => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'metaDateCustomDateFormat'           => array(
		'type'    => 'string',
		'default' => 'F j, Y',
	),
	'dynamicClassNames'                  => array(
		'type'    => 'object',
		'default' => array(),
	),
	'hideOnDesktop'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'equalHeightEnable'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advancedBorderStyle'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => '',
			'color'      => '#cccccc',
			'hoverColor' => '#000000',
		),
	),
	'advancedBorderStyleWidth'           => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'advancedBorderStyleWidthHover'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'advancedBorderRadius'               => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'advancedBorderRadiusHover'          => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'advancedMargin'                     => $this->spacing_attribute( 8, 0, 8, 0, 'px', false ),
	'advancedPadding'                    => $this->spacing_attribute( '', '', '', '', 'px', false ),
	'advancedBoxShadowEnable'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'advancedBoxShadow'                  => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 8,
					'right'  => 8,
					'bottom' => 16,
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
	'popupImageSize'                     => array(
		'type'    => 'string',
		'default' => 'large',
	),
	'popupImageWidth'                    => $this->ranger_attribute( 500, '', '', 'px' ),
	'popupImageHeight'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 500,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => '%',
				'Mobile'  => '%',
			),
		),
	),
	'popupCloseBtnEnable'                => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'popupCloseBtnSize'                  => $this->ranger_attribute( 18 ),
	'popupMaxWidth'                      => array(
		'type'    => 'object',
		'default' => array(
			'value' => 1050,
			'unit'  => 'px',
		),
	),
	'popupMaxHeight'                     => array(
		'type'    => 'object',
		'default' => array(
			'value' => 700,
			'unit'  => 'px',
		),
	),
	'popupTitleColor'                    => array(
		'type'    => 'string',
		'default' => '#000',
	),
	'popupMetaFieldsColor'               => array(
		'type'    => 'string',
		'default' => '#575757',
	),
	'popupExcerptColor'                  => array(
		'type'    => 'string',
		'default' => '#000',
	),
	'popupBgColor'                       => array(
		'type'    => 'string',
		'default' => '#fff',
	),
	'popupOverlayColor'                  => array(
		'type'    => 'string',
		'default' => '#0b0b0bcc',
	),
	'popupCloseBtnColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#FF0000',
			'hover' => '',
		),
	),
	'popupNavArrowColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#fff',
			'hover' => '#fff',
		),
	),
	'popupNavArrowBgColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#222222',
			'hover' => 'var(--smart-post-secondary)',
		),
	),
	'additionalCssClass'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'metaDataArray'                      => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'    => 1,
				'label' => 'Author',
				'value' => 'author',
			),
			array(
				'id'    => 2,
				'label' => 'Date',
				'value' => 'date',
			),
		),
	),
	'showPrice'                          => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'priceColor'                         => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#444444',
			'hoverColor' => '',
		),
	),
	'discountColor'                      => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#888888',
			'hoverColor' => '',
		),
	),
	'showRating'                         => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'showReviewCount'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'starColor'                          => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#F4C100',
			'hoverColor' => '',
		),
	),
	'emptyStarColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#C8C8C8',
			'hoverColor' => '',
		),
	),
	'reviewCounterColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#444444',
			'hoverColor' => '',
		),
	),
	'showAddToCart'                      => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'addToCartColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#222222',
			'hoverColor' => '#fff',
		),
	),
	'addToCartBg'                        => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'transparent',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(135deg,rgb(6,147,227) 0%,rgb(133,49,213) 100%)',
			),
		),
	),
	'addToCartBorder'                    => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'solid',
			'color'      => '#4e4f52',
			'hoverColor' => '',
		),
	),
	'addToCartBorderWidth'               => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'blockLayoutName'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'addToCartTypography'                => array(
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
	'addToCartFontSize'                  => $this->ranger_attribute( 16 ),
	'addToCartLatterSpacing'             => $this->ranger_attribute( 0 ),
	'addToCartWordSpacing'               => $this->ranger_attribute( 0 ),
	'addToCartLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => 'px',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'priceTypography'                    => array(
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
	'priceFontSize'                      => $this->ranger_attribute( 16 ),
	'priceLatterSpacing'                 => $this->ranger_attribute( 0 ),
	'priceWordSpacing'                   => $this->ranger_attribute( 0 ),
	'priceLineHeight'                    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'smallItemHeight'                    => $this->ranger_attribute(),
	'largeItemHeight'                    => $this->ranger_attribute(),
	'currentScreen'                      => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                          => array( 'type' => 'string' ),
	'contentPartArray'                   => array(
		'type'    => 'array',
		'default' => array(
			array(
				'id'    => 1,
				'label' => 'Taxonomy (Category)',
				'value' => 'taxonomy',
			),
			array(
				'id'    => 2,
				'label' => 'Title',
				'value' => 'title',
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
				'value' => 'readMoreButton',
			),
			array(
				'id'    => 6,
				'label' => 'Social Share',
				'value' => 'socialShare',
			),
		),
	),
	'metaDataAllContentArray'            => array(
		'type'    => 'array',
		'default' => array(
			array(
				'label' => 'Author',
				'value' => 'author',
				'id'    => 1,
				'show'  => true,
			),
			array(
				'label' => 'Date',
				'value' => 'date',
				'id'    => 2,
				'show'  => true,
			),
			array(
				'label' => 'Comments',
				'value' => 'comments',
				'id'    => 3,
				'show'  => true,
			),
			array(
				'label' => 'Views',
				'value' => 'views',
				'id'    => 4,
				'show'  => false,
				'pro'   => true,
			),
			array(
				'label' => 'Likes',
				'value' => 'likes',
				'id'    => 5,
				'show'  => false,
				'pro'   => true,
			),
			array(
				'label' => 'Reading Time',
				'value' => 'reading-time',
				'id'    => 6,
				'show'  => false,
				'pro'   => true,
			),
		),
	),
	'socialIconDisplayType'              => array(
		'type'    => 'string',
		'default' => 'inline-icon',
	),
	'socialShareDisplayOnHover'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialShareIconPosition'            => array(
		'type'    => 'string',
		'default' => 'beside-meta',
	),
	'socialShareDisplayStyle'            => array(
		'type'    => 'string',
		'default' => 'style-one',
	),
	'socialPopupShareColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffff',
			'hoverColor' => '',
		),
	),
	'socialPopupCountColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#fff',
			'hoverColor' => '#333',
		),
	),
	'socialPopupShareBGColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FFFFFF00',
			'hoverColor' => '#FFFFFF00',
		),
	),
	'socialPopupContainerBGColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffff',
			'hoverColor' => '#fff',
		),
	),
	'socialSharePadding'                 => $this->spacing_attribute( 8, 8, 8, 8, 'px', true ),
	'socialShareCount'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialTotalShareCount'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialSharePopupBorder'             => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#000',
			'style'      => 'none',
			'hoverColor' => '#fff',
		),
	),
	'socialSharePopupBorderWidth'        => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'socialSharePopupBorderRadius'       => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'socialShareBoxShadow'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialShareBoxShadowValue'          => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'Tablet'  => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'Mobile'  => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
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
	'socialPopupBoxShadow'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'socialPopupBoxShadowValue'          => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
				'Desktop' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'Tablet'  => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'Mobile'  => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
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
	'socialPopupPadding'                 => $this->spacing_attribute( 12, 12, 12, 12, 'px', true ),
	'catTabCategoryBarColor'             => array(
		'type'    => 'string',
		'default' => '#FFF',
	),
	'readMoreButtonType'                 => array(
		'type'    => 'string',
		'default' => 'button',
	),
	'metaDisplayType'                    => array(
		'type'    => 'string',
		'default' => 'inline',
	),
	'paginationTypeParent'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'paginationPosition'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'enableMetaData'                     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'globalBreakPointData'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'allTaxonomy'                        => array(
		'type'    => 'array',
		'default' => array(),
	),
);
$shared_attributes   = array_merge( $shared_attributes, $style_title, $content_area_attr );
$carousel_attributes = array(
	'carouselPauseOnHover'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselDirection'                  => array(
		'type'    => 'string',
		'default' => 'right_to_left',
	),
	'carouselAutoPlay'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselAutoPlayDelay'              => array(
		'type'    => 'object',
		'default' => array(
			'value' => 2000,
			'unit'  => 'ms',
		),
	),
	'carouselSpeed'                      => array(
		'type'    => 'object',
		'default' => array(
			'value' => 600,
			'unit'  => 'ms',
		),
	),
	'carouselStyle'                      => array(
		'type'    => 'string',
		'default' => 'standard',
	),
	'carouselGap'                        => $this->ranger_attribute( 24 ),
	'carouselColumn'                     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
				'Tablet'  => 2,
				'Mobile'  => 1,
			),
		),
	),
	'carouselArrowStyle'                 => array(
		'type'    => 'string',
		'default' => 'chevron-solid',
	),
	'carouselArrowSize'                  => $this->ranger_attribute( 16 ),
	'carouselArrowWidth'                 => $this->ranger_attribute( 40, 40, 40 ),
	'carouselArrowHeight'                => $this->ranger_attribute( 40 ),
	'carouselArrowSpaceBetween'          => $this->ranger_attribute( 100, 100, 100, '%' ),
	'carouselArrowHorizontal'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => -22,
				'Tablet'  => 0,
				'Mobile'  => 0,
			),
			'unit'   => array(
				'Desktop' => 'px',
				'Tablet'  => '%',
				'Mobile'  => 'px',
			),
		),
	),
	'carouselArrowVertical'              => $this->ranger_attribute( 50, 50, 50, '%' ),
	'carouselArrowColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#FFFFFF',
			'hoverColor' => '#FFFFFF',
		),
	),
	'carouselArrowBgColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'carouselArrowBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'solid',
			'hoverStyle' => '',
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'carouselArrowBorderWidth'           => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'carouselArrowBorderWidthHover'      => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'carouselArrowBorderRadius'          => $this->spacing_attribute( 50, 50, 50, 50, '%', true ),
	'carouselBoxShadowEnable'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselBoxShadow'                  => array(
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
			'color'         => '#4E4F521A ',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'carouselPaginationStyle'            => array(
		'type'    => 'string',
		'default' => 'dots',
	),
	'infiniteLoop'                       => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselPaginationWidth'            => $this->ranger_attribute( 12 ),
	'carouselPaginationHeight'           => $this->ranger_attribute( 12 ),
	'carouselPaginationSpaceBetween'     => $this->ranger_attribute( 4 ),
	'carouselPaginationHorizontal'       => $this->ranger_attribute( '', '', '', '%' ),
	'carouselPaginationVertical'         => $this->ranger_attribute( -36 ),
	'carouselPaginationTextColor'        => array(
		'type'    => 'object',
		'default' => array(
			'color'       => '',
			'activeColor' => '#FFFFFF',
		),
	),
	'carouselPaginationColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '',
			'hoverColor' => '',
		),
	),
	'carouselPaginationBorder'           => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'hoverStyle' => 'none',
			'color'      => '#4e4f52',
			'hoverColor' => '#4E4F52',
		),
	),
	'carouselPaginationBorderWidth'      => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'carouselPaginationBorderWidthHover' => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'navArrowVisibilityOnHover'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'carouselNavArrow'                   => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselPaginationDot'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'carouselData'                       => array(
		'type'    => 'string',
		'default' => '',
	),
);
