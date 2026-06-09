<?php
/**
 * Fired during plugin activation
 *
 * @link        https://wpsmartpost.com/
 * @since      2.2.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Custom post class to register the carousel.
 */
class Smart_Post_Show_Post_Type {

	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.2.0
	 */
	private static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.2.0
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.2.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Smart post show post type
	 */
	public function register_carousel_post_type() {
		if ( post_type_exists( 'sp_post_carousel' ) ) {
			return;
		}
		$capability = sp_pc_dashboard_capability();
		$show_ui    = current_user_can( $capability ) ? true : false;

		// Set the Smart post show post type labels.
		$labels = apply_filters(
			'sp_post_carousel_post_type_labels',
			array(
				'name'               => __( 'Manage Shows', 'post-carousel' ),
				'singular_name'      => __( 'Show', 'post-carousel' ),
				'menu_name'          => __( 'Smart Post', 'post-carousel' ),
				'all_items'          => __( 'Manage Shows', 'post-carousel' ),
				'add_new'            => __( 'Add New', 'post-carousel' ),
				'add_new_item'       => __( 'Add New Show', 'post-carousel' ),
				'edit'               => __( 'Edit', 'post-carousel' ),
				'edit_item'          => __( 'Edit Show', 'post-carousel' ),
				'new_item'           => __( 'New Show', 'post-carousel' ),
				'search_items'       => __( 'Search Shows', 'post-carousel' ),
				'not_found'          => __( 'No Shows found', 'post-carousel' ),
				'not_found_in_trash' => __( 'No Shows found in Trash', 'post-carousel' ),
				'parent'             => __( 'Parent Show', 'post-carousel' ),
			)
		);
		// Set the Smart post show post type arguments.
		$menu_icon = 'data:image/svg+xml;base64,' . base64_encode(
			'<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.25 12.2422C1.25 11.4871 1.8621 10.875 2.61715 10.875H7.75765C8.51271 10.875 9.12481 11.4871 9.12481 12.2422V17.3828C9.12481 18.1379 8.51271 18.75 7.75765 18.75H2.61715C1.8621 18.75 1.25 18.1379 1.25 17.3828V12.2422Z" fill="white"/>
				<path d="M10.8748 5.1875C10.8748 3.01288 12.6376 1.25 14.8122 1.25C16.9867 1.25 18.7496 3.01288 18.7496 5.1875C18.7496 7.36212 16.9867 9.125 14.8122 9.125C12.6376 9.125 10.8748 7.36212 10.8748 5.1875Z" fill="white"/>
				<path d="M1.25 2.61719C1.25 1.86211 1.8621 1.25 2.61715 1.25H7.75765C8.51271 1.25 9.12481 1.86211 9.12481 2.61719V7.75781C9.12481 8.51289 8.51271 9.125 7.75765 9.125H2.61715C1.8621 9.125 1.25 8.51289 1.25 7.75781V2.61719Z" fill="white"/>
				<rect x="10.8752" y="16.9999" width="7.87481" height="1.16667" rx="0.583333" fill="white"/>
				<rect x="10.8752" y="11.458" width="7.87481" height="1.16667" rx="0.583333" fill="white"/>
				<rect x="10.8752" y="14.0829" width="7.87481" height="1.16667" rx="0.583333" fill="white"/>
			</svg>'
		);
		$args      = apply_filters(
			'sp_post_carousel_post_type_args',
			array(
				'label'           => __( 'Manage Shows', 'post-carousel' ),
				'description'     => __( 'Manage Shows', 'post-carousel' ),
				'public'          => false,
				'show_ui'         => $show_ui,
				'show_in_menu'    => $show_ui,
				'show_in_rest'    => true,
				'menu_icon'       => $menu_icon,
				'hierarchical'    => false,
				'query_var'       => false,
				'menu_position'   => 5,
				'supports'        => array( 'title' ),
				'capabilities'    => array(
					'publish_posts'       => $capability,
					'edit_posts'          => $capability,
					'edit_others_posts'   => $capability,
					'delete_posts'        => $capability,
					'delete_others_posts' => $capability,
					'read_private_posts'  => $capability,
					'edit_post'           => $capability,
					'delete_post'         => $capability,
					'read_post'           => $capability,
				),
				'capability_type' => 'post',
				'labels'          => $labels,
			)
		);

		register_post_type( 'sp_post_carousel', $args );
	}
}
