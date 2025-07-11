<?php
/**
 * Framework license fields file.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SP_PC_Field_license' ) ) {
	/**
	 *
	 * Field: license
	 *
	 * @since 3.3.16
	 * @version 3.3.16
	 */
	class SP_PC_Field_license extends SP_PC_Fields {

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
		 * Render
		 *
		 * @return void
		 */
		public function render() {
			echo wp_kses_post( $this->field_before() );
			?>
				<div class="sp-pcp-license text-center">
					<h3><?php esc_html_e( 'You\'re using Smart Post Show Lite - No License Needed. Enjoy', 'post-carousel' ); ?>! 🙂</h3>
					<p><?php esc_html_e( 'Upgrade to Smart Post Show Pro and unlock all the features.', 'post-carousel' ); ?></p>
					<div class="sp-pcp-license-area">
						<div class="sp-pcp-license-key">
							<div class="pcp-upgrade-button"><a href="https://smartpostshow.com/pricing/?ref=1" target="_blank"><?php esc_html_e( 'Upgrade To Pro Now', 'post-carousel' ); ?></a></div>
						</div>
					</div>
				</div>
				<?php
				echo wp_kses_post( $this->field_after() );
		}
	}
}
