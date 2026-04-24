<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpsmartpost.com/
 * @since      3.0.12
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Smart_Post_Show_Cron
 */
class Smart_Post_Show_Cron {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    3.0.12
	 */
	public function __construct() {
		add_filter( 'cron_schedules', array( $this, 'add_schedules' ) );
		add_action( 'wp', array( $this, 'schedule_events' ) );
	}

	/**
	 * Registers new cron schedules
	 *
	 * @since 3.0.12
	 *
	 * @param array $schedules time schedule.
	 * @return array
	 */
	public function add_schedules( $schedules = array() ) {
		// Adds once weekly to the existing schedules.
		$schedules['weekly'] = array(
			'interval' => WEEK_IN_SECONDS,
			'display'  => __( 'Once Weekly', 'post-carousel' ),
		);

		return $schedules;
	}

	/**
	 * Schedules our events
	 *
	 * @since 3.0.12
	 * @return void
	 */
	public function schedule_events() {
		$this->weekly_events();
	}

	/**
	 * Schedule weekly events
	 *
	 * @access private
	 * @since 3.0.12
	 * @return void
	 */
	private function weekly_events() {
		if ( ! wp_next_scheduled( 'smart_post_show_weekly_scheduled_events' ) ) {
			wp_schedule_event( time(), 'weekly', 'smart_post_show_weekly_scheduled_events' );
		}
	}
}

new Smart_Post_Show_Cron();
