<?php
/**
 * Divi 5 Module - Server Side Rendering
 *
 * @package     Smart_Post_Show_Pro
 * @subpackage  Smart_Post_Show_Pro/admin/PageBuilders/Divi5
 * @since       4.0.0
 */

namespace SmartPostShow\Admin\PageBuilders\Divi5;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Cannot access directly.
}

use ET\Builder\Framework\DependencyManagement\Interfaces\DependencyInterface;
use ET\Builder\Packages\ModuleLibrary\ModuleRegistration;
use ET\Builder\Packages\Module\Module;
use ET\Builder\Packages\Module\Layout\Components\ModuleElements\ModuleElements;


/**
 * Smart Post Show Pro Divi 5 Module - Server Side.
 *
 * @since 4.0.0
 */
class D5SmartPostShowProModule implements DependencyInterface {

	/**
	 * Module instance for singleton pattern.
	 *
	 * @var D5SmartPostShowProModule
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @since 4.0.0
	 *
	 * @return D5SmartPostShowProModule
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Loads the module and registers render callback.
	 * Called by Divi 5's dependency tree system.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function load() {
		$module_json_folder_path = SP_PC_PATH . 'blocks/build/divi5/';

		// Register module immediately - don't hook into init.
		ModuleRegistration::register_module(
			$module_json_folder_path,
			array(
				'render_callback' => array( __CLASS__, 'render_callback' ),
			)
		);
	}

	/**
	 * Render callback for the module.
	 *
	 * @since 4.0.0
	 *
	 * @param array          $attrs    Module attributes.
	 * @param string         $content  Module content.
	 * @param \WP_Block      $block    Block object.
	 * @param ModuleElements $elements ModuleElements instance.
	 * @return string Rendered HTML.
	 */
	public static function render_callback( $attrs, $content, $block, $elements ) {
		// Extract template_id from nested attrs structure.
		$template_id = '0';
		if ( isset( $attrs['templateId']['innerContent']['desktop']['value'] ) ) {
			$template_id = $attrs['templateId']['innerContent']['desktop']['value'];
		}

		// Convert to integer for comparison.
		$template_id = absint( $template_id );

		if ( empty( $template_id ) || 0 === $template_id ) {
			$template_html = self::error_message( esc_html__( 'Please Select a Saved Template', 'post-carousel' ) );
		} else {
			// Check if template exists and is published.
			$template_post = get_post( $template_id );
			if ( ! $template_post || 'publish' !== $template_post->post_status ) {
				$template_html = self::error_message( esc_html__( 'Template not found or not published.', 'post-carousel' ) );
			} elseif ( empty( $template_post->post_content ) ) {
				$template_html = self::error_message( esc_html__( 'Template content is empty.', 'post-carousel' ) );
			} else {
				// Render the shortcode.
				$template_html = do_shortcode( '[smart_post id="' . absint( $template_id ) . '"]' );
			}
		}

		// Check if in Divi 5 editor mode for CSS.
		$is_editor = self::is_divi5_builder_editor();
		if ( $is_editor && $template_id > 0 ) {
			// Enqueue CSS for the template in builder mode.
			self::enqueue_template_dynamic_css( $template_id );
		}

		// Use Module::render() for proper Divi 5 rendering in both frontend and visual builder.
		return Module::render(
			array(
				// Frontend only params.
				'orderIndex'         => $block->parsed_block['orderIndex'] ?? 0,
				'storeInstance'      => $block->parsed_block['storeInstance'] ?? '',

				// Visual builder params.
				'attrs'              => $attrs,
				'elements'           => $elements,
				'id'                 => $block->parsed_block['id'] ?? '',
				'moduleClassName'    => 'spsp_divi5_smart_post_show',
				'name'               => $block->block_type->name ?? 'spsp/divi5-smart-post-show',
				'classnamesFunction' => array( __CLASS__, 'module_classnames' ),
				'moduleCategory'     => $block->block_type->category ?? 'module',
				'children'           => self::render_module_inner( $template_html, $template_id ),
			)
		);
	}

	/**
	 * Render module inner content.
	 *
	 * @since 4.0.0
	 *
	 * @param string $template_html Rendered template HTML.
	 * @param int    $template_id   Template ID.
	 * @return string Module inner HTML.
	 */
	private static function render_module_inner( $template_html, $template_id ) {
		// Module inner container.
		return sprintf(
			'<div class="et_pb_module_inner spsp-divi5-testimonial-wrapper" data-builder-template-id="%s">%s</div>',
			esc_attr( $template_id ),
			$template_html
		);
	}

	/**
	 * Module classnames callback.
	 *
	 * @since 4.0.0
	 *
	 * @param array $args Callback arguments.
	 * @return void
	 */
	public static function module_classnames( $args ) {
		$classnames_instance = $args['classnamesInstance'] ?? null;
		$attrs               = $args['attrs'] ?? array();

		if ( $classnames_instance && method_exists( $classnames_instance, 'add' ) ) {
			// Add element classnames.
			$classnames_instance->add( 'spsp_divi5_smart_post_show' );
		}
	}

	/**
	 * Check if the current request is for Divi 5 Builder.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if in Divi 5 builder context.
	 */
	protected static function is_divi5_builder_editor() {
		// Check Divi Frontend Builder.
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce not required for builder context check.
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- isset() check only, value not used.
		if ( isset( $_GET['et_fb'] ) ) {
			return true;
		}

		// Check if Divi is enabled.
		if ( function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled() ) {
			return true;
		}

		// Check Divi AJAX requests.
		if ( wp_doing_ajax() && isset( $_REQUEST['action'] ) && 0 === strpos( sanitize_key( wp_unslash( $_REQUEST['action'] ) ), 'et_' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Enqueue CSS for template in Divi 5 builder.
	 * Follows the same pattern as Elementor and Oxygen integrations.
	 *
	 * @since 4.0.0
	 *
	 * @param int $template_id Template post ID.
	 * @return void
	 */
	protected static function enqueue_template_dynamic_css( $template_id ) {
		// Prevent duplicate CSS generation for the same template in current request.
		static $generated_templates = array();
		if ( isset( $generated_templates[ $template_id ] ) ) {
			return;
		}

		// Mark this template as processed.
		$generated_templates[ $template_id ] = true;

		$upload_dir = wp_upload_dir();
		$css_file   = $upload_dir['basedir'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';
		$css_url    = $upload_dir['baseurl'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';

		// Enqueue CSS file if exists (same pattern as Elementor/Oxygen).
		if ( file_exists( $css_file ) ) {
			echo '<link rel="stylesheet" href="' . esc_url( $css_url . '?v=' . filemtime( $css_file ) ) . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		// Get and output dynamic CSS from meta (same pattern as Elementor/Oxygen).
		$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true );
		if ( ! empty( $dynamic_css ) ) {
			echo '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		// Echo Google Fonts directly.
		$font_lists = get_post_meta( $template_id, '_sp_smart_fonts', true );
		if ( ! empty( $font_lists ) && is_array( $font_lists ) ) {
			$font_lists = array_unique( $font_lists );
			foreach ( $font_lists as $font ) {
				if ( ! empty( $font ) ) {
					echo '<link rel="stylesheet" href="' . esc_url( 'https://fonts.googleapis.com/css?family=' . $font ) . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	}

	/**
	 * Generate error message HTML.
	 *
	 * @since 4.0.0
	 *
	 * @param string $message Error message.
	 * @return string Error HTML.
	 */
	protected static function error_message( $message ) {
		return sprintf(
			'<div style="text-align:center;padding:20px;border:2px dashed #ccc;color:#999;font-size:14px;">%s</div>',
			esc_html( $message )
		);
	}
}

D5SmartPostShowProModule::get_instance()->load();
