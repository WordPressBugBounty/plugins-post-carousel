<?php
/**
 * Fired during plugin init
 *
 * @link        https://wpsmartpost.com/
 * @since      2.0.0
 *
 * @package    Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use SmartPostShow\Blocks\Helper;

/**
 * Custom post class to register the carousel.
 */
class Smart_Post_Show_Back_To_Top {

	/**
	 * Smart Post Show Pro single instance of the class
	 *
	 * @var null The instance of the class.
	 * @since 2.0
	 *
	 * @return void
	 */
	protected static $instance = null;

	/**
	 * Smart Post Show Pro single instance of the class
	 *
	 * @var null The instance of the class.
	 * @since 2.0
	 *
	 * @return void
	 */
	private static $icon_list = array(
		'top-arrow-one'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19 15.5L12 8.5L5 15.5" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
		'top-arrow-two'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M20 16L12 8L4 16" fill="currentColor"></path><path d="M20 16L12 8L4 16H20Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
		'top-arrow-three' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18 11L12 5L6 11" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 5V18" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>',
		'top-arrow-four'  => '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M11.7236 6.58594C12.0521 6.25748 12.0521 5.73474 11.7236 5.40625L6.58203 0.264649C6.25357 -0.0637597 5.73082 -0.0637918 5.40234 0.264649L0.260742 5.40625C-0.0402652 5.71433 -0.0585722 6.19314 0.205078 6.52246L0.260742 6.58594C0.589197 6.91439 1.11194 6.91439 1.44043 6.58594L5.99219 2.03418L10.5439 6.58594C10.8724 6.91439 11.3951 6.91439 11.7236 6.58594Z" fill="currentColor" stroke="currentColor" stroke-width="0.0368089"></path><path d="M0.24811 11.7483C0.583752 12.0839 1.11775 12.0839 1.45343 11.7483L5.99244 7.20925L10.539 11.7483C10.8747 12.0839 11.4087 12.0839 11.7443 11.7483C12.08 11.4126 12.08 10.8786 11.7443 10.543L6.60273 5.40126C6.26708 5.06562 5.73308 5.06562 5.39741 5.40126L0.255752 10.543C-0.0799246 10.871 -0.0799246 11.4126 0.24811 11.7483Z" fill="currentColor"></path></svg>',
		'top-arrow-five'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none"><path d="M0.800781 1.5998C0.800781 1.15798 1.15895 0.799805 1.60078 0.799805H16.0008C16.4426 0.799805 16.8008 1.15798 16.8008 1.5998V15.305C16.8008 15.9439 16.0807 16.3401 15.5269 16.0213C13.882 15.0741 10.9728 13.5998 8.80078 13.5998C6.62875 13.5998 3.71957 15.0741 2.07462 16.0213C1.52091 16.3401 0.800781 15.9439 0.800781 15.305V1.5998Z" stroke="currentColor" stroke-width="1.6"></path><path d="M13.4858 8.47534L8.80151 3.79102L4.11719 8.47534" stroke="currentColor" stroke-width="1.6" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.80078 3.84766V12.9905" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path></svg>',
	);

	/**
	 * Main Smart_Post_Show_Pro_blocks Instance
	 *
	 * @since 2.0
	 * @static
	 *
	 * @return self help instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function back_to_top_init() {
		$this->render_back_to_top_btn();
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function render_back_to_top_btn() {
		$attributes       = $this->get_back_to_top_attributes();
		$render_condition = $this->check_module_conditions();
		if ( ! $render_condition ) {
			return;
		}
		$dynamic_style      = isset( $attributes['dynamic_style'] ) ? $attributes['dynamic_style'] : '';
		$font_lists         = isset( $attributes['fontListsEditPage'] ) ? $attributes['fontListsEditPage'] : '';
		$display_position   = isset( $attributes['display_position'] ) ? $attributes['display_position'] : '';
		$entrance_animation = isset( $attributes['entrance_animation'] ) ? $attributes['entrance_animation'] : '';
		$smooth_scroll      = isset( $attributes['smooth_scroll'] ) ? $attributes['smooth_scroll'] : '';
		$back_to_top_icon   = isset( $attributes['back_to_top_icon'] ) ? $attributes['back_to_top_icon'] : '';
		$back_top_label     = isset( $attributes['back_top_label'] ) ? $attributes['back_top_label'] : '';
		$go_to_bottom       = isset( $attributes['go_to_bottom'] ) ? $attributes['go_to_bottom'] : '';
		$back_bottom_label  = isset( $attributes['back_bottom_label'] ) ? $attributes['back_bottom_label'] : '';
		$top_icon_source    = isset( $attributes['top_icon_source'] ) ? $attributes['top_icon_source'] : '';
		$transition_delay   = isset( $attributes['transition_delay'] ) ? $attributes['transition_delay'] : '';

		$wrapper_class = 'sp-smart-post-back-to-top-wrapper sp-position-' . $display_position . ' sp-animation-' . $entrance_animation;
		if ( $smooth_scroll ) {
			$wrapper_class .= 'sp-scroll-smooth';
		}
		$icon_list                  = $this::$icon_list;
		$transition_delay_condition = $smooth_scroll ? $transition_delay['value'] : '0.3';

		$default_style = '.sp-smart-post-back-to-top-wrapper{cursor:pointer;position:fixed;bottom:30px;top:unset;background-color:var(--smart-post-secondary);color:#fff;display:flex;align-items:center;padding:8px;z-index:999}.sp-smart-post-back-to-top-wrapper.sp-position-button-right{left:unset;right:30px}.sp-smart-post-back-to-top-wrapper.sp-position-button-left{left:30px;right:unset}.sp-smart-post-back-to-top-wrapper .sp-smart-post-back-to-top-button{display:flex;align-items:center;justify-content:center}.sp-smart-post-back-to-top-wrapper .sp-smart-post-back-to-top-icon{width:25px;height:25px}';
		wp_enqueue_script( 'sp-smart-post-back-to-top' );

		ob_start();
		?>
			<style><?php echo esc_html( $default_style ); ?></style>
			<style><?php echo esc_html( $dynamic_style ); ?></style>
			<style><?php echo esc_html( $font_lists ); ?></style>
			<div id="sp-smart-post-back-to-top-btn" class="<?php echo esc_attr( $wrapper_class ); ?>" data-transition="<?php echo esc_attr( $transition_delay_condition ); ?>" data-go-bottom="<?php echo esc_attr( $go_to_bottom ); ?>" data-animation="<?php echo esc_attr( $entrance_animation ); ?>" style="opacity: 0;">
				<div class="sp-smart-post-back-to-top-content">
					<div class="sp-smart-post-back-to-top-button">
						<?php if ( $back_to_top_icon ) : ?>
							<span class="sp-smart-post-back-to-top-icon">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $icon_list[ $top_icon_source ];
							?>
								</span>
						<?php endif; ?>
						<?php if ( $back_top_label || ( $go_to_bottom && $back_bottom_label ) ) : ?>
							<div class="sp-smart-post-back-to-top-btn-text">
						<?php endif; ?>
						<?php if ( $back_top_label ) : ?>
							<span class="sp-smart-post-back-to-top-text sp-back-to-top-text"><?php echo esc_html( $back_top_label ); ?></span>
						<?php endif; ?>
						<?php if ( $go_to_bottom && $back_bottom_label ) : ?>
							<span class="sp-smart-post-back-to-top-text sp-go-to-bottom-text">
								<?php echo esc_html( $back_bottom_label ); ?>
							</span>
						<?php endif; ?>
						<?php if ( $back_top_label || ( $go_to_bottom && $back_bottom_label ) ) : ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Undocumented function
	 *
	 * @return boolean
	 */
	public function check_module_conditions() {

		// Check if the module is enabled.
		$modules = Helper::get_modules_show_hide();
		if ( empty( $modules['back-to-top'] ) ) {
			return false;
		}

		// Get saved display attributes.
		$attributes      = $this->get_back_to_top_attributes();
		$display_on_page = $attributes['display_on'] ?? 'all-pages';
		$exclude_page    = $attributes['exclude_page'] ?? array();
		$include_only    = $attributes['include_only'] ?? array();

		$exclude_page_ids = array();
		if ( is_array( $exclude_page ) ) {
			$exclude_page_ids = array_column( $exclude_page, 'id' );
		}

		$include_only_ids = array_column( $include_only, 'id' );

		// Page logic.
		switch ( $display_on_page ) {
			case 'all-pages':
				// Show everywhere except excluded pages.
				return empty( $exclude_page_ids ) ? true : ! is_page( $exclude_page_ids );

			case 'specific-pages':
				// Show only on specific pages.
				return is_page( $include_only_ids );

			case 'single-pages':
				// Show only on single posts.
				return is_singular();

			case 'only-archive-pages':
				// Show only on archive pages.
				return is_archive();

			default:
				return false;
		}
	}


	/**
	 * Undocumented function
	 *
	 * @return array attributes.
	 */
	public function get_back_to_top_attributes() {
		$modules_attributes = get_option( 'sp_smart_post_module_back-to-top', array() );
		return $modules_attributes['options'];
	}
}
