<?php
/**
 *  Elementor Template widget file.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/admin/ElementAddons
 */

use SmartPostShow\Blocks\Helper;

/**
 * Elementor smart post show pro Template Widget.
 *
 * @since 2.4.1
 */
class Smart_Post_Show_Template_Widget extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 2.4.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'smart_post_show_pro_template';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.4.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Saved Templates', 'post-carousel' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.2.5
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'sps-icon-elementor';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.2.5
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Enqueue scripts for editor preview.
	 *
	 * @return array Script handles.
	 */
	public function get_script_depends() {
		return array( 'sp_smart_post_blocks_script_js' );
	}

	/**
	 * Enqueue styles for editor preview.
	 *
	 * @return array Style handles.
	 */
	public function get_style_depends() {
		return array(
			'sp_smart_post_blocks_css',
			'sp_smart_post_blocks_social_icons_style',
			'sp_smart_post_blocks_google_fonts',
		);
	}

	/**
	 * Controls register.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'post-carousel' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sp_smart_post_show_pro_template',
			array(
				'label'       => __( 'Smart Post Templates', 'post-carousel' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => '0',
				'options'     => Helper::get_save_template_list(),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the template content by querying the sp_post_template post
	 * and applying the_content filter so Gutenberg blocks render properly.
	 *
	 * @since 2.4.1
	 * @param int $template_id Template post ID.
	 * @return void
	 */
	protected function render_template_content( $template_id ) {
		$args      = array(
			'p'              => $template_id,
			'post_type'      => 'sp_post_template',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		);
		$the_query = new \WP_Query( $args );

		$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true ); // phpcs:ignore WordPress.WP.DeprecatedParameters.Get_post_meta_param2

		if ( $the_query->have_posts() ) {
			echo '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="sp-smart-post-wrapper" data-postid="' . esc_attr( $template_id ) . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<div style="text-align: center; padding: 10px;">'
			. esc_html__( 'Template not found.', 'post-carousel' )
			. '</div>';
		}
	}

	/**
	 * Render smart post show pro shortcode widget output on the frontend.
	 *
	 * @since 2.4.1
	 * @access protected
	 */
	protected function render() {

		$settings        = $this->get_settings_for_display();
		$sp_pcp_template = $settings['sp_smart_post_show_pro_template'] ?? '';
		$template_id     = (int) $sp_pcp_template;

		if ( empty( $template_id ) ) {
			echo '<div style="
				text-align: center;
				padding: 20px;
				border: 2px dashed #ccc;
				color: #999;
				font-size: 14px;
			">
				Please select a Smart Post Saved Templates
			</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}

		if ( $template_id ) {

			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {

				$upload_dir = wp_upload_dir();
				$css_file   = $upload_dir['basedir'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';
				$css_url    = $upload_dir['baseurl'] . '/smart-post-show/static/sp-post-' . $template_id . '.css';

				if ( file_exists( $css_file ) ) {
					echo '<link rel="stylesheet" href="' . esc_url( $css_url ) . '?v=' . filemtime( $css_file ) . '">'; // phpcs:ignore
				}

				$dynamic_css = get_post_meta( $template_id, '_sp_smart_css', true ); // phpcs:ignore WordPress.WP.DeprecatedParameters.Get_post_meta_param2

				echo '<style>' . $dynamic_css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				echo do_shortcode( '[smart_post id="' . $template_id . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				?>

				<?php

			} else {
				echo '<div class="sp-smart-post-builder-wrap" data-builderTemplateId="' . esc_attr( $template_id ) . '">';
				echo do_shortcode( '[smart_post id="' . $template_id . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</div>';
			}
		}
	}
}
