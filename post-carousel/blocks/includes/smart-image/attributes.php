<?php
/**
 * Smart image block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

return array(
	'isPreview'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'blockName'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'uniqueId'                        => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontLists'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'fontListsEditPage'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'customCss'                       => array(
		'type'    => 'string',
		'default' => '',
	),
	'selectImageSizes'                => array(
		'type'    => 'array',
		'default' => array(),
	),
	'selectImage'                     => array(
		'type'    => 'object',
		'default' => array(),
	),
	'selectImageId'                   => array(
		'type'    => 'number',
		'default' => '',
	),
	'imageSize'                       => array(
		'type'    => 'string',
		'default' => 'full',
	),
	'aspectRatio'                     => array(
		'type'    => 'string',
		'default' => 'original',
	),
	'maxWidth'                        => $this->ranger_attribute( '', '', '', '%' ),
	'smartImageWidth'                 => $this->ranger_attribute( '', '', '', 'px' ),
	'smartImageHeight'                => $this->ranger_attribute( '', '', '', 'px' ),
	'imageZoom'                       => $this->ranger_attribute( 1.1, '', '', false ),
	'imageFocalPoint'                 => array(
		'type'    => 'object',
		'default' => array(
			'x' => 0.5,
			'y' => 0.5,
		),
	),
	'enableLink'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'linkType'                        => array(
		'type'    => 'string',
		'default' => 'full-img',
	),
	'linkUrl'                         => array(
		'type'    => 'string',
		'default' => '',
	),
	'openInTab'                       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'buttonLabel'                     => array(
		'type'    => 'string',
		'default' => 'View Details',
	),
	'buttonPosition'                  => array(
		'type'    => 'string',
		'default' => 'center-center',
	),
	'imageAltText'                    => array(
		'type'    => 'string',
		'default' => '',
	),
	'doubleResolutionRetina'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'lazyLoad'                        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageBorder'                     => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#ddd',
			'hoverColor' => '#ddd',
		),
	),
	'imageBorderWidth'                => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'imageBorderRadius'               => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'imageBoxShadowEnable'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageBoxShadow'                  => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
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
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '#F2F2F2',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'imageFilter'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageBlur'                       => $this->ranger_attribute( '', '', '', false ),
	'imageBrightness'                 => $this->ranger_attribute( '', '', '', false ),
	'imageContrast'                   => $this->ranger_attribute( '', '', '', false ),
	'imageSaturation'                 => $this->ranger_attribute( '', '', '', false ),
	'imageHue'                        => $this->ranger_attribute( '', '', '', false ),
	'linkBtnTypography'               => array(
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
				'transform'  => 'capitalize',
				'decoration' => 'none',
			),
		),
	),
	'linkBtnFontSize'                 => $this->ranger_attribute( 19, '', '', 'px' ),
	'linkBtnLineHeight'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'linkBtnLetterSpacing'            => $this->ranger_attribute( 0, '', '', 'px' ),
	'linkBtnWordSpacing'              => $this->ranger_attribute( '', '', '', 'px' ),
	'linkButtonColor'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => '#FFFFFF',
			'hover' => '',
		),
	),
	'linkButtonBg'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '#1A74E4',
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
	'linkButtonBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#ddd',
			'hoverColor' => '#ddd',
		),
	),
	'linkBtnBorderWidth'              => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'linkBtnBorderWidthHover'         => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'linkBtnBorderRadius'             => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'linkBtnBorderRadiusHover'        => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'linkBtnBoxShadowEnable'          => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'linkBtnBoxShadow'                => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
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
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '#F2F2F2',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'linkBtnBoxShadowEnableHover'     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'linkBtnBoxShadowHover'           => array(
		'type'    => 'object',
		'default' => array(
			'device'        => array(
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
			'unit'          => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'         => '#F2F2F2',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'linkBtnPadding'                  => $this->spacing_attribute( 12, 22, 12, 22, 'px', false ),
	'imgMaskingEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageShapeSet'                   => array(
		'type'    => 'string',
		'default' => 'shape-set',
	),
	'selectImageShape'                => array(
		'type'    => 'string',
		'default' => 'original',
	),
	'maskingShapedUpload'             => array(
		'type'    => 'object',
		'default' => array(),
	),
	'maskSize'                        => array(
		'type'    => 'string',
		'default' => 'contain',
	),
	'smartImgBgEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'smartImgBg'                      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'      => '',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	// 'smartImgBgType'                      => array(
	// 'type'    => 'string',
	// 'default' => 'image',
	// ),
	'smartImageBgImage'               => array(
		'type'    => 'object',
		'default' => array(),
	),
	'smartImgOverlayType'             => array(
		'type'    => 'string',
		'default' => 'custom',
	),
	'smartImgOverlayColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'smartBgImgOverlayBlandMode'      => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'smartBgImgBlur'                  => $this->ranger_attribute( 2.5, '', '', false ),
	'smartBgImgOverlayBlandModeHover' => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'smartBgImgBlurHover'             => $this->ranger_attribute( 5, '', '', false ),
	'smartBgImgBorder'                => array(
		'type'    => 'object',
		'default' => array(
			'style'      => 'none',
			'color'      => '#ddd',
			'hoverColor' => '#ddd',
		),
	),
	'smartBgImgBorderWidth'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	// 'smartBgImgBorderRadius'             => array(
	// 'type'    => 'object',
	// 'default' => array(
	// 'top'       => '',
	// 'right'     => '',
	// 'bottom'    => '',
	// 'left'      => '',
	// 'unit'      => 'px',
	// 'allChange' => true,
	// ),
	// ),
	'smartBgImgBorderRadius'          => array(
		'type'    => 'object',
		'default' => array(
			'value'     => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'unit'      => 'px',
			'allChange' => true,
		),
	),
	'smartBgFixImage'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'smartBgImgInnerPadding'          => $this->spacing_attribute( 0, 0, 0, 0, 'px', false ),
	'imgTitleEnable'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imgTitleLabel'                   => array(
		'type'    => 'string',
		'default' => '',
	),
	'imgTitleTypography'              => array(
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
				'transform'  => 'capitalize',
				'decoration' => 'none',
			),
		),
	),
	'imgTitleFontSize'                => $this->ranger_attribute( 16, '', '', 'px' ),
	'imgTitleLineHeight'              => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'imgTitleLetterSpacing'           => $this->ranger_attribute( 0, '', '', 'px' ),
	'imgTitleWordSpacing'             => $this->ranger_attribute( 4, '', '', 'px' ),
	'imgCaptionEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imgCaptionLabel'                 => array(
		'type'    => 'string',
		'default' => '',
	),
	'imgCaptionTypography'            => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => 'Default',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '400',
				'style'      => 'normal',
				'transform'  => 'capitalize',
				'decoration' => 'none',
			),
		),
	),
	'imgCapFontSize'                  => $this->ranger_attribute( 16, '', '', 'px' ),
	'imgCapLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => '',
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'imgCapLetterSpacing'             => $this->ranger_attribute( 0, '', '', 'px' ),
	'imgCapWordSpacing'               => $this->ranger_attribute( 4, '', '', 'px' ),
	'imgTextVisibility'               => array(
		'type'    => 'string',
		'default' => 'show-always',
	),
	'imgTextColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color' => '',
			'hover' => '',
		),
	),
	'imgTextPosition'                 => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'imgTextHorizontal'               => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'imgTextVertical'                 => array(
		'type'    => 'string',
		'default' => 'bottom',
	),
	'imgTextPadding'                  => $this->spacing_attribute( 20, 20, 20, 20, 'px', false ),
	'imgAnimationEffect'              => array(
		'type'    => 'string',
		'default' => '',
	),
	'imgAnimationSpeed'               => $this->ranger_attribute( 0.5, '', '', 's' ),
	'imgAnimationLineWidth'           => $this->ranger_attribute( 2, '', '', 'px' ),
	'imgAnimationNormal'              => array(
		'type'    => 'string',
		'default' => 'zoom-in',
	),
	'imgHoverOverlayEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imgHoverOverlayColor'            => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
			'hover' => array(
				'style'      => '',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(162deg, rgba(128, 128, 214, 0.2) 0%, rgba(136, 169, 231, 0.2) 51%, rgba(144, 234, 228, 0.2) 100%)',
			),
		),
	),
	'additionalCssClass'              => array(
		'type'    => 'string',
		'default' => '',
	),
	'hideOnDesktop'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'generateImgPrompt'               => array(
		'type'    => 'string',
		'default' => '',
	),
	'imgHoverEffectOpacity'           => array(
		'type'    => 'number',
		'default' => 0.6,
	),
	'imgAlignment'                    => array(
		'type'    => 'string',
		'default' => 'left',
	),
);
