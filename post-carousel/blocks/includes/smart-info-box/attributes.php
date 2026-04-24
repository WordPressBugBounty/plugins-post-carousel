<?php
/**
 * Smart info box block attributes file for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

return array(

	'uniqueId'                       => array(
		'type' => 'string',
	),
	'blockName'                      => array(
		'type' => 'string',
	),
	'infoBoxLayout'                  => array(
		'type'    => 'string',
		'default' => 'smart-info-box-layout-one',
	),
	'fontLists'                      => array(
		'type'    => 'string',
		'default' => '',
	),
	'additionalCssClass'             => array(
		'type'    => 'string',
		'default' => '',
	),
	'isPreview'                      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'contentAlignment'               => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'customCss'                      => array(
		'type' => 'string',
	),

	'iconSource'                     => array(
		'type'    => 'string',
		'default' => 'library',
	),
	'verticalAlignment'              => array(
		'type'    => 'string',
		'default' => 'flex-start',
	),
	'iconHorizontalAlignment'        => array(
		'type'    => 'string',
		'default' => 'center',
	),
	'iconVerticalAlignment'          => array(
		'type'    => 'string',
		'default' => 'center',
	),

	'cAIconSource'                   => array(
		'type'    => 'string',
		'default' => 'library',
	),
	'infoBoxBg'                      => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'       => 'transparent',
				'transparent' => '',
				'solidColor'  => '#ffffff',
				'gradient'    => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
			'hover' => array(
				'style'       => 'bgColor',
				'transparent' => '',
				'solidColor'  => '',
				'gradient'    => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
		),
	),
	'titleGlobalTypography'          => array(
		'type'    => 'object',
		'default' => array(),
	),
	'subTitleGlobalTypography'       => array(
		'type'    => 'object',
		'default' => array(),
	),
	'desGlobalTypography'            => array(
		'type'    => 'object',
		'default' => array(),
	),
	'callToActionGlobalTypography'   => array(
		'type'    => 'object',
		'default' => array(),
	),
	'ratingGlobalTypography'         => array(
		'type'    => 'object',
		'default' => array(),
	),
	'badgeGlobalTypography'          => array(
		'type'    => 'object',
		'default' => array(),
	),
	'borderStyle'                    => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'borderHoverStyle'               => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'solid',
			'color' => '#cccccc',
		),
	),
	'borderStyleWidth'               => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderRadius'                   => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'boxShadow'                      => array(
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

	'infoBoxHoverBg'                 => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#E9F4FFF2',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
		),
	),

	'borderHoverStyleWidth'          => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'borderHoverRadius'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'boxShadowHoverEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'boxShadowHover'                 => array(
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
	'margin'                         => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'padding'                        => $this->spacing_attribute( 32, 24, 32, 24, 'px', false ),
	'iconEnable'                     => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'ratingEnable'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'callActionEnable'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'separatorEnable'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'openNewTab'                     => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'fullWidthButton'                => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'overlayOnHover'                 => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'externalLinkIcon'               => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'buttonIconEnable'               => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'ratingValueEnable'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'titleEnable'                    => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'subTitleEnable'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'descriptionEnable'              => array(
		'type'    => 'boolean',
		'default' => true,
	),
	'dropCapsEnable'                 => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnDesktop'                  => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnTablet'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'hideOnMobile'                   => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'badgeEnable'                    => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'titleTag'                       => array(
		'type'    => 'string',
		'default' => 'h2',
	),
	'titleText'                      => array(
		'type'    => 'string',
		'default' => 'Your Info Box Title',
	),
	'subTitleText'                   => array(
		'type'    => 'string',
		'default' => 'Sub Title',
	),
	'caButtonText'                   => array(
		'type'    => 'string',
		'default' => 'Learn More',
	),
	'descText'                       => array(
		'type'    => 'string',
		'default' => 'Write a short description here to explain this feature, service, or highlight. Keep it clear and engaging for visitors.',
	),
	'infoBoxRadialShape'             => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'badgeRadialShape'               => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'iconRadialShape'                => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'iconHoverRadialShape'           => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'badgeHoverRadialShape'          => array(
		'type'    => 'string',
		'default' => 'circle',
	),

	'advancedAdditionalClass'        => array(
		'type'    => 'string',
		'default' => '',
	),
	'caRadialShape'                  => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'caHoverRadialShape'             => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'infoBoxHoverRadialShape'        => array(
		'type'    => 'string',
		'default' => 'circle',
	),
	'infoBoxRadialPosition'          => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'badgeRadialPosition'            => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'iconRadialPosition'             => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'iconHoverRadialPosition'        => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'badgeHoverRadialPosition'       => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'caRadialPosition'               => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'caHoverRadialPosition'          => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'infoBoxHoverRadialPosition'     => array(
		'type'    => 'string',
		'default' => 'center center',
	),
	'subTitleTag'                    => array(
		'type'    => 'string',
		'default' => 'span',
	),
	'badgePosition'                  => array(
		'type'    => 'string',
		'default' => 'top-right',
	),
	'separatorPosition'              => array(
		'type'    => 'string',
		'default' => 'after-title',
	),
	'separatorStyle'                 => array(
		'type'    => 'string',
		'default' => 'solid ',
	),
	'badgeLabel'                     => array(
		'type'    => 'string',
		'default' => 'Featured',
	),
	'buttonLink'                     => array(
		'type' => 'string',
	),
	'iconSize'                       => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 32,
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

	'ratingIconSize'                 => array(
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
	'iconCustomWidth'                => array(
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
	'iconName'                       => array(
		'type'    => 'string',
		'default' => 'star',
	),
	'ratingIconCustomWidth'          => array(
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
	'cAIconCustomWidth'              => array(
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
	'iconCustomHeight'               => array(
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
	'ratingIconCustomHeight'         => array(
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
	'cAIconCustomHeight'             => array(
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
	'iconTextGap'                    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 8,
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
	'cAIconSize'                     => array(
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
	'separatorWidth'                 => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 60,
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
	'separatorThinkness'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 3,
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
	'ratingGap'                      => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 8,
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
	'scale'                          => array(
		'type'    => 'number',
		'default' => 5,
	),
	'imageOverlayOpacity'            => array(
		'type'    => 'number',
		'default' => 0.5,
	),
	'iconHoverEffectOpacity'         => array(
		'type'    => 'number',
		'default' => 0.5,
	),
	'imageHoverOverlayOpacity'       => array(
		'type'    => 'number',
		'default' => 0.5,
	),
	'cAOverlayOpacity'               => array(
		'type'    => 'number',
		'default' => 0.8,
	),
	'subTitleGap'                    => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 8,
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
	'iconPosition'                   => array(
		'type'    => 'string',
		'default' => 'above-title',
	),
	'iconPositionLayoutFive'         => array(
		'type'    => 'string',
		'default' => 'top-content',
	),

	'infoBoxStyleType'               => array(
		'type'    => 'string',
		'default' => 'color',
	),
	'subTitlePosition'               => array(
		'type'    => 'string',
		'default' => 'below-title',
	),
	'iconHoverEffects'               => array(
		'type'    => 'string',
		'default' => 'normal',
	),
	'titleHoverEffects'              => array(
		'type'    => 'string',
		'default' => 'none',
	),
	'iconBg'                         => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#2F2F2F',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '#2F2F2F',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
		),
	),
	'cABg'                           => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#E0E0E0',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '#E0E0E0',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
		),
	),

	'badgeBg'                        => array(
		'type'    => 'object',
		'default' => array(
			'color' => array(
				'style'      => 'bgColor',
				'solidColor' => '#E0E0E0',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
			'hover' => array(
				'style'      => 'bgColor',
				'solidColor' => '#E0E0E0',
				'gradient'   => 'linear-gradient(90deg,rgb(161,196,253) 0%,rgb(194,233,251) 50%,rgb(224,234,252) 100%)',
			),
		),
	),
	'iconOverlayColor'               => array(
		'type'    => 'string',
		'default' => '#000000ff',
	),
	'separatorColor'                 => array(
		'type'    => 'string',
		'default' => '#ddd',
	),
	'iconOverlayEnable'              => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'iconOverlayOpacity'             => array(
		'type'    => 'string',
		'default' => 0.5,
	),
	'iconColor'                      => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#ffffff',
			'hoverColor' => '#ffffff',
		),
	),
	'caIconColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '#2F2F2F',
		),
	),
	'cAOverlayColor'                 => array(
		'type'    => 'string',
		'default' => '#2F2F2F',
	),
	'externalLinkIconColor'          => array(
		'type'    => 'string',
		'default' => '#fff',
	),
	'hoverEffectsColor'              => array(
		'type'    => 'string',
		'default' => '#2F2F2F',
	),
	'titleColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '#878787ff',
		),
	),
	'imageOverlayColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => 'var(--smart-post-secondary)',
			'hoverColor' => '#012B60',
		),
	),
	'badgeColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#2F2F2F',
			'hoverColor' => '#2F2F2F',
		),
	),
	'filledColor'                    => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#F0B849',
			'hoverColor' => '#e79a00ff',
		),
	),
	'emptyColor'                     => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#dddddd',
			'hoverColor' => '#8f8e8eff',
		),
	),
	'ratingNumberColor'              => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '#757575',
		),
	),
	'subTitleColor'                  => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '#757575',
		),
	),
	'descriptionColor'               => array(
		'type'    => 'object',
		'default' => array(
			'color'      => '#757575',
			'hoverColor' => '#757575',
		),
	),

	'dropCapsColor'                  => array(
		'type'    => 'string',
		'default' => '#2F2F2F',
	),


	'iconBorderStyle'                => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'caBorderStyle'                  => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'caHoverBorderStyle'             => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'iconBorderStyleWidth'           => $this->spacing_attribute( '', '', '', '', 'px', true ),
	'caBorderStyleWidth'             => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'caHoverBorderStyleWidth'        => $this->spacing_attribute( 1, 1, 1, 1, 'px', true ),
	'iconBorderRadius'               => $this->spacing_attribute( 6, 6, 6, 6, 'px', true ),
	'caBorderRadius'                 => $this->spacing_attribute( 6, 6, 6, 6, 'px', true ),
	'caHoverBorderRadius'            => $this->spacing_attribute( 6, 6, 6, 6, 'px', true ),
	'iconBoxShadowEnable'            => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageOverlayEnable'             => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'imageOverlayHoverEnable'        => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'iconBoxShadow'                  => array(
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
			'color'         => '#4E4F5257',
			'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
		),
	),
	'badgeBorderStyle'               => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'badgeBorderStyleWidth'          => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'badgeBorderRadius'              => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'badgeBoxShadowEnable'           => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'badgeBoxShadow'                 => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),


	'iconBorderHoverStyle'           => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'iconBorderStyleHoverWidth'      => $this->spacing_attribute( 0, 0, 0, 0, 'px', false ),
	'iconBorderHoverRadius'          => $this->spacing_attribute( 6, 6, 6, 6, 'px', true ),
	'iconBoxShadowHoverEnable'       => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'iconBoxShadowHover'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F5257',
		),
	),
	'badgeBorderHoverStyle'          => array(
		'type'    => 'object',
		'default' => array(
			'style' => 'none',
			'color' => '#cccccc',
		),
	),
	'badgeBorderStyleHoverWidth'     => $this->spacing_attribute( 2, 2, 2, 2, 'px', true ),
	'badgeBorderHoverRadius'         => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'badgeBoxShadowHoverEnable'      => array(
		'type'    => 'boolean',
		'default' => false,
	),
	'badgeBoxShadowHover'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
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
			'unit'   => array(
				'Desktop' => 'outset',
				'Tablet'  => 'outset',
				'Mobile'  => 'outset',
			),
			'color'  => '#4E4F521A',
		),
	),
	'iconMargin'                     => $this->spacing_attribute( 0, 0, 24, 0, 'px', false ),
	'gapBetweenDescription'          => $this->spacing_attribute( 0, 0, 18, 0, 'px', false ),
	'descriptionMargin'              => $this->spacing_attribute( 0, 0, 24, 0, 'px', false ),
	'iconPadding'                    => $this->spacing_attribute( 14, 14, 14, 14, 'px', true ),
	'caPadding'                      => $this->spacing_attribute( 12, 22, 12, 22, 'px', false ),
	'badgeMargin'                    => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'caMargin'                       => $this->spacing_attribute( 0, 0, 0, 0, 'px', true ),
	'ratingMargin'                   => $this->spacing_attribute( 0, 0, 18, 0, 'px', false ),
	'separatorMargin'                => $this->spacing_attribute( 8, 0, 8, 0, 'px', false ),
	'titleMargin'                    => $this->spacing_attribute( 0, 0, 8, 0, 'px', false ),
	'badgePadding'                   => $this->spacing_attribute( 6, 12, 6, 12, 'px', false ),
	'titleTypography'                => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '500',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'titleLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.2,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'titleFontSize'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 20,
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
	'titleLatterSpacing'             => array(
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
	'titleWordSpacing'               => array(
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
	'subTitleTypography'             => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '500',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'subTitleLineHeight'             => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.20,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'subTitleFontSize'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 14,
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
	'subTitleLatterSpacing'          => array(
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
	'subTitleWordSpacing'            => array(
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
	'descriptionTypography'          => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '400',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'descriptionLineHeight'          => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.6,
				'Tablet'  => '',
				'Mobile'  => '',
			),
		),
	),
	'descriptionFontSize'            => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 14,
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
	'descriptionLatterSpacing'       => array(
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
	'descriptionWordSpacing'         => array(
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
	'badgeTypography'                => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '400',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'badgeLineHeight'                => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.2,
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
	'badgeFontSize'                  => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 13,
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
	'badgeLatterSpacing'             => array(
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
	'badgeWordSpacing'               => array(
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
	'ratingTypography'               => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '600',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'ratingLineHeight'               => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.2,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'ratingFontSize'                 => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 14,
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
	'ratingLatterSpacing'            => array(
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
	'ratingWordSpacing'              => array(
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
	'cATypography'                   => array(
		'type'    => 'object',
		'default' => array(
			'googleFont' => array(
				'family'   => '',
				'variants' => array( '300', '400', '500', '600', '700', '800' ),
			),
			'typography' => array(
				'family'     => '',
				'fontWeight' => '600',
				'style'      => 'normal',
				'transform'  => 'none',
				'decoration' => 'none',
			),
		),
	),
	'cALineHeight'                   => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 1.20,
				'Tablet'  => '',
				'Mobile'  => '',
			),
			// 'unit'   => array(
			// 'Desktop' => '%',
			// 'Tablet'  => 'px',
			// 'Mobile'  => 'px',
			// ),
		),
	),
	'cAFontSize'                     => array(
		'type'    => 'object',
		'default' => array(
			'device' => array(
				'Desktop' => 14,
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
	'cALatterSpacing'                => array(
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
	'cAWordSpacing'                  => array(
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
	'ratingValuePosition'            => array(
		'type'    => 'string',
		'default' => 'right',
	),
	'linkingType'                    => array(
		'type'    => 'string',
		'default' => 'text',
	),
	'cAIconPosition'                 => array(
		'type'    => 'string',
		'default' => 'afterText',
	),
	'infoBoxBgImage'                 => array(
		'type' => 'object',
	),
	'infoBoxHoverBgImage'            => array(
		'type' => 'object',
	),
	'imageScale'                     => array(
		'type'    => 'string',
		'default' => 'cover',
	),
	'imageHoverScale'                => array(
		'type'    => 'string',
		'default' => 'cover',
	),
	'iconSourceLibrary'              => array(
		'type'    => 'string',
		'default' => 'x',
	),
	'ratingIconSourceLibrary'        => array(
		'type'    => 'string',
		'default' => 'star',
	),
	'cAIconSourceLibrary'            => array(
		'type'    => 'string',
		'default' => 'long-arrow-alt-right',
	),
	'iconSourceCustom'               => array(
		'type' => 'object',
	),

	'cAIconSourceCustom'             => array(
		'type' => 'object',
	),
	'currentIcon'                    => array(
		'type' => 'object',
	),
	'currentCAIcon'                  => array(
		'type' => 'object',
	),
	'currentRatingIconSourceLibrary' => array(
		'type' => 'object',
	),
);
