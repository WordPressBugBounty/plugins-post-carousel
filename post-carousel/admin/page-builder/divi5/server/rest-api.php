<?php
/**
 * Divi 5 REST API Endpoint
 *
 * @package     Smart_Post_Show_Pro
 * @subpackage  Smart_Post_Show_Pro/admin/PageBuilders/Divi5
 * @since       4.0.0
 */

namespace SmartPostShow\Admin\PageBuilders\Divi5;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Cannot access directly.
}

use SmartPostShow\Blocks\Helper;

/**
 * Register REST API endpoints for Divi 5 module.
 *
 * @since 4.0.0
 *
 * @return void
 */
function spsp_divi5_register_rest_routes() {
	// Get template HTML endpoint.
	register_rest_route(
		'spsp/divi5/v1',
		'/template-html',
		array(
			array(
				'methods'             => 'GET',
				'callback'            => __NAMESPACE__ . '\\spsp_divi5_get_template_html',
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
				'args'                => array(
					'template_id' => array(
						'required'          => true,
						'sanitize_callback' => 'absint',
						'description'       => 'Template ID',
					),
				),
			),
		)
	);

	// Get saved templates list endpoint.
	register_rest_route(
		'spsp/divi5/v1',
		'/saved-templates',
		array(
			array(
				'methods'             => 'GET',
				'callback'            => __NAMESPACE__ . '\\spsp_divi5_get_saved_templates',
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			),
		)
	);
}

/**
 * Get global CSS from plugin settings.
 * Reusable function that matches Assets_Manager::add_global_css() logic.
 *
 * @since 4.0.0
 *
 * @return array Array with 'css' and 'fonts' keys.
 */
function spsp_divi5_get_global_css() {
	$global_style   = get_option( 'sp_smart_post_global_settings', array() );
	$custom_css     = $global_style['customCss'] ?? '';
	$typography_css = ! empty( $global_style['typography']['typographyCss'] ) ? $global_style['typography']['typographyCss'] : ':root { --sp-smart-font-size-heading-1: 44px;  --sp-smart-font-size-heading-2: 32px;  --sp-smart-font-size-heading-3: 24px;  --sp-smart-font-size-heading-4: 22px;  --sp-smart-font-size-heading-5: 20px;  --sp-smart-font-size-heading-6: 18px;  --sp-smart-font-size-body-1: 18px;  --sp-smart-font-size-body-2: 16px;  --sp-smart-font-size-body-3: 14px;  --sp-smart-font-size-body-4: 12px;  --sp-smart-font-size-button-1: 18px;  --sp-smart-font-size-button-2: 16px;}';
	$root_css       = ! empty( $global_style['rootcss'] ) ? $global_style['rootcss'] : ':root{  --sp-smart-breakpoint-tablet: 1023px; --sp-smart-breakpoint-mobile: 767px; --smart-post-light-text: #FAFAFA; --smart-post-background: #FFFFFF; --smart-post-primary-light: #EBEBEB; --smart-post-primary: #999999; --smart-post-primary-dark: #1D1D1D; --smart-post-secondary: #0054FB; --smart-post-dark-2-text: #3E3E3E; --smart-post-dark-text: #0A0A0A; --smart-post-black: #000000;} :root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12); --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14); --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16); --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18); --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
	$shadow_css     = $global_style['shadow']['shadowRootCSS'] ?? ':root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12);  --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14);  --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16);  --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18);  --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
	$global_fonts   = $global_style['typography']['fontList'] ?? '';

	$css = wp_strip_all_tags( $typography_css . $root_css . $shadow_css . $custom_css );

	return array(
		'css'   => $css,
		'fonts' => is_array( $global_fonts ) ? $global_fonts : ( ! empty( $global_fonts ) ? array( $global_fonts ) : array() ),
	);
}

/**
 * Get template HTML for visual builder.
 *
 * @since 4.0.0
 *
 * @param \WP_REST_Request $request REST request object.
 * @return \WP_REST_Response REST response with HTML.
 */
function spsp_divi5_get_template_html( $request ) {
	$template_id = $request->get_param( 'template_id' );

	// Validate template ID.
	if ( empty( $template_id ) || 0 === $template_id ) {
		return new \WP_REST_Response(
			array(
				'success' => false,
				'html'    => '<div style="padding:20px;text-align:center;color:#999;">Invalid template ID</div>',
			),
			400
		);
	}

	// Check if template exists and is published.
	$template_post = get_post( $template_id );
	if ( ! $template_post || 'publish' !== $template_post->post_status ) {
		return new \WP_REST_Response(
			array(
				'success' => false,
				'html'    => '<div style="padding:20px;text-align:center;color:#999;">Template not found or not published</div>',
			),
			404
		);
	}

	// Build CSS output.
	$css_output = '';

	// 1. Template static CSS file.
	$upload_dir = wp_upload_dir();
	$css_file   = trailingslashit( $upload_dir['basedir'] ) . 'smart-post-show/static/sp-post-' . $template_id . '.css';
	if ( file_exists( $css_file ) ) {
		$css_file_content = file_get_contents( $css_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		if ( ! empty( $css_file_content ) ) {
			$css_output .= '<style id="spsp-static-css-' . esc_attr( $template_id ) . '">' . $css_file_content . '</style>';
		}
	}

	// 2. Template inline dynamic CSS from meta.
	$inline_css = get_post_meta( $template_id, '_sp_smart_css', true );
	if ( ! empty( $inline_css ) ) {
		$css_output .= '<style id="spsp-dynamic-css-' . esc_attr( $template_id ) . '">' . $inline_css . '</style>';
	}

	// 3. Template-specific Google Fonts.
	$font_lists = get_post_meta( $template_id, '_sp_smart_fonts', true );
	if ( ! empty( $font_lists ) && is_array( $font_lists ) ) {
		$font_lists = array_unique( $font_lists );
		foreach ( $font_lists as $font ) {
			if ( ! empty( $font ) ) {
				$css_output .= '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . $font ) . '">'; // phpcs:ignore
			}
		}
	}

	// 4. Global CSS (includes --smart-show-secondary and other root variables).
	$global_css_data = spsp_divi5_get_global_css();
	if ( ! empty( $global_css_data['css'] ) ) {
		$css_output .= '<style id="spsp-global-root-css">' . $global_css_data['css'] . '</style>';
	}

	// 5. Global Google Fonts.
	if ( ! empty( $global_css_data['fonts'] ) ) {
		$font_array = array_unique( $global_css_data['fonts'] );
		foreach ( $font_array as $g_font ) {
			if ( ! empty( $g_font ) ) {
				$css_output .= '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . $g_font ) . '">'; // phpcs:ignore
			}
		}
	}

	// Render the shortcode - this is server-side rendering.
	$template_html = do_shortcode( '[smart_post id="' . absint( $template_id ) . '"]' );
	// Prepend all CSS and fonts to HTML.
	$template_html = $css_output . $template_html;

	// Return HTML with CSS and fonts (all included inline).
	return new \WP_REST_Response(
		array(
			'success' => true,
			'html'    => $template_html,
		),
		200
	);
}

/**
 * Get saved templates list for settings dropdown.
 *
 * @since 4.0.0
 *
 * @param \WP_REST_Request $request REST request object.
 * @return \WP_REST_Response REST response with templates list.
 */
function spsp_divi5_get_saved_templates( $request ) {
	$templates = Helper::get_save_template_list();

	$result      = array();
	$result['0'] = __( '- Select Template -', 'post-carousel' );

	foreach ( $templates as $id => $title ) {
		$result[ $id ] = $title;
	}

	return new \WP_REST_Response( $result, 200 );
}
