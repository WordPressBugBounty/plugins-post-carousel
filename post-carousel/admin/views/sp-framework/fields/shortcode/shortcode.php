<?php
/**
 * The framework shortcode fields file.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_PC_Field_shortcode' ) ) {
	/**
	 * SP_PC_Field_shortcode
	 */
	class SP_PC_Field_shortcode extends SP_PC_Fields {
		/**
		 * Field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		/**
		 * Render method.
		 *
		 * @return void
		 */
		public function render() {
			// Get the Post ID.
			$post_id = get_the_ID();
			if ( ! empty( $this->field['shortcode'] ) && 'manage_view' === $this->field['shortcode'] ) {
				echo ( ! empty( $post_id ) ) ? '<div class="pcp-scode-wrap-side"><p>To display your show or view, add the following shortcode into your post, custom post types, page, widget or block editor. If adding the show to your theme files, additionally include the surrounding PHP code, <a href="https://docs.shapedplugin.com/docs/post-carousel/create-your-first-post-show/add-new-post-show/#faq" target="_blank">see how</a>.</p><span class="pcp-shortcode-selectable">[smart_post_show id="' . esc_attr( $post_id ) . '"]</span></div> <div class="pcp-live-editor-promo"><h4 class="pcp-live-editor-promo__title">Want a Live Visual Editor?</h4><p class="pcp-live-editor-promo__desc">Design visually and see every change instantly. <a class="pcp-live-editor-promo__link" href="' . esc_url( admin_url( 'post-new.php?post_type=sp_post_template&spblock_inserter=true' ) ) . '">Try Block Editor ↗</a></p></div><div class="pcp-after-copy-text"><i class="fa fa-check-circle"></i> Shortcode Copied to Clipboard! </div>' : '';
			} elseif ( ! empty( $this->field['shortcode'] ) && 'pro_notice' === $this->field['shortcode'] ) {
				if ( ! empty( $post_id ) ) {

					$features = array(
						array(
							'label' => __( 'Advanced Posts Query Builder', 'post-carousel' ),
						),
						array(
							'label' => __( 'Smart Frontend Live Filter & Search', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/#demoId3647',
						),
						array(
							'label' => __( 'Custom Archive & Single Post Builder', 'post-carousel' ),
						),
						array(
							'label' => __( 'Saved Templates for Post, Page, Builders', 'post-carousel' ),
						),
						array(
							'label' => __( '250+ Ready Designs/Patterns Library', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/patterns/',
						),
						array(
							'label' => __( '60+ Gutenberg Blocks', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/',
						),
						array(
							'label' => __( 'Modern Post Grid, List & Slider Layouts', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/#demoId3511',
						),
						array(
							'label' => __( 'Post Featured Video & Gallery Images', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/#demoId3514',
						),
						array(
							'label' => __( 'Post Highlights & Badges', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/#demoId3514',
						),
						array(
							'label' => __( 'Custom Taxonomy Image & Color', 'post-carousel' ),
							'url'   => 'https://wpsmartpost.com/blocks/#demoId3604',
						),
						array(
							'label' => __( 'Post Content Drag & Drop Sorting', 'post-carousel' ),
						),
					);

					echo '<div class="sp_wpcp_shortcode-area pcp-pro-notice-wrapper">';

					echo '<div class="pcp-pro-notice-heading">' . sprintf(
					/* translators: 1: start span tag wrapping the product name, 2: close tag. */
						esc_html__( 'Go Pro & Unlock More! 🚀', 'post-carousel' ),
					) . '</div>';

					echo '<p>Unlock the full potential of Smart Post Pro and build beautiful blog & news layouts in minutes.</p>';

					echo '<ul class="pcp-pro-notice-features">';
					foreach ( $features as $feature ) {
						echo '<li>';
						echo '<span class="pcp-pro-feature__icon">';
						echo '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.47461 1.24707C6.85097 3.76847 8.83144 5.7481 11.3525 6.125L12.5225 6.2998L11.3525 6.47461C8.83157 6.85179 6.85112 8.83112 6.47461 11.3525L6.2998 12.5225L6.125 11.3525C5.74845 8.83092 3.76819 6.85166 1.24707 6.47461L0.0761719 6.2998L1.24707 6.125C3.76832 5.74824 5.7486 3.76856 6.125 1.24707L6.2998 0.0761719L6.47461 1.24707Z" fill="#641DD7" stroke="#641DD7" stroke-width="0.0224423"/></svg>'; // phpcs:ignore -- No user input.
						echo '</span>';

						if ( ! empty( $feature['url'] ) ) {
							echo '<a class="pcp-pro-feature__link" href="' . esc_url( $feature['url'] ) . '" target="_blank" rel="noopener">';
							echo esc_html( $feature['label'] );
							echo '<svg class="pcp-pro-feature__arrow" width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M.75 7.417 7.417.75m0 5.128V.75H2.288" stroke="#2f2f2f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
							echo '</a>';
						} else {
							echo '<span class="pcp-pro-feature__label">' . esc_html( $feature['label'] ) . '</span>';
						}
						echo '</li>';
					}
					echo '</ul>';

					echo '<div class="pcp-pro-notice-button">';
					echo '<a class="pcp-open-live-demo" href="https://wpsmartpost.com/pricing/?ref=1" target="_blank" rel="noopener">';
					echo '<span class="sp-go-pro-icon"></span>';
					echo '<span>' . esc_html__( 'Upgrade to Pro Now', 'post-carousel' ) . '</span>';
					echo '</a>';
					echo '</div>';

					echo '</div>';
				}
			} else {
				echo ( ! empty( $post_id ) ) ? '<div class="pcp-scode-wrap-side"><p>Smart Post Show has seamless integration with Gutenberg, Classic Editor, <strong>Elementor,</strong> Divi, Bricks, Beaver, Oxygen, WPBakery Builder, etc.</p></div>' : '';
			}
		}
	}
}
