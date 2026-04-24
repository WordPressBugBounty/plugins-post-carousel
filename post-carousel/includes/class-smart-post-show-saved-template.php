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
use SmartPostShow\Blocks\Assets_Manager;
/**
 * Custom post class to register the carousel.
 */
class Smart_Post_Show_Saved_Template {

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
	 */
	public function register_template_shortcode() {
		$this->smart_post_saved_template_post_type();
		add_filter( 'manage_sp_post_template_posts_columns', array( $this, 'filter_saved_template_column' ) );
		add_action( 'manage_sp_post_template_posts_custom_column', array( $this, 'templates_table_content' ), 10, 2 );
		add_shortcode( 'smart_post', array( $this, 'smart_template_callback' ) );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'smart_post_force_block_editor_for_save_template' ), 100, 2 );
		add_action( 'admin_init', array( $this, 'redirect_saved_template_edit_page' ) );
		add_action( 'rest_api_init', array( $this, 'smart_saved_template_rest' ) );
	}

	/**
	 * Add saved template admin columns.
	 *
	 * @since 2.0.0
	 * @return statement
	 */
	public function filter_saved_template_column() {
		$saved_columns              = array();
		$saved_columns['cb']        = '<input type="checkbox" />';
		$saved_columns['title']     = __( 'Title', 'post-carousel' );
		$saved_columns['shortcode'] = __( 'Shortcode', 'post-carousel' );
		$saved_columns['date']      = __( 'Date', 'post-carousel' );
		// $saved_columns['sps_action'] = __( 'Layout', 'post-carousel' );

		return $saved_columns;
	}

	/**
	 * Saved Template Column content
	 *
	 * @param string $column_name table column name.
	 * @param init   $post_id post id.
	 * @return void
	 */
	public function templates_table_content( $column_name, $post_id ) {
		echo '<code class="sp-smart-post-shortcode-copy">[smart_post id="' . esc_attr( $post_id ) . '"]</code>';
	}

	/**
	 * Smart Post Saved Template post type
	 */
	public function smart_post_saved_template_post_type() {
		if ( post_type_exists( 'sp_post_template' ) ) {
			return;
		}
		$capability = apply_filters( 'pcp_user_role_permission', 'manage_options' );
		$show_ui    = current_user_can( $capability ) ? true : false;
		// Set the Smart Post Saved Template post type labels.
		$labels =
			array(
				'name'                     => __( 'Saved Templates', 'post-carousel' ),
				'singular_name'            => __( 'Saved Template', 'post-carousel' ),
				'menu_name'                => __( 'Saved Templates', 'post-carousel' ),
				'all_items'                => __( 'Saved Templates', 'post-carousel' ),
				'add_new'                  => __( 'Add New Template', 'post-carousel' ),
				'add_new_item'             => __( 'Add New Template', 'post-carousel' ),
				'edit'                     => __( 'Edit', 'post-carousel' ),
				'edit_item'                => __( 'Edit Template', 'post-carousel' ),
				'view_item'                => __( 'View Template', 'post-carousel' ),
				'new_item'                 => __( 'New Templates', 'post-carousel' ),
				'search_items'             => __( 'Search Template', 'post-carousel' ),
				'not_found'                => __( 'No Template found', 'post-carousel' ),
				'not_found_in_trash'       => __( 'No Template found in Trash', 'post-carousel' ),
				'item_published'           => __( 'Template Published', 'post-carousel' ),
				'item_published_privately' => __( 'Template published privately.', 'post-carousel' ),
				'item_reverted_to_draft'   => __( 'Template reverted to draft.', 'post-carousel' ),
				'item_scheduled'           => __( 'Template scheduled.', 'post-carousel' ),
				'item_updated'             => __( 'Template updated.', 'post-carousel' ),
			);
		// Set the Smart Post Saved Template post type arguments.
		$args =
			array(
				'labels'              => $labels,
				'public'              => false,
				'supports'            => array( 'title', 'editor', 'revisions' ),
				'show_in_rest'        => true,
				'hierarchical'        => false,
				'rewrite'             => false,
				'show_ui'             => $show_ui,
				'show_in_menu'        => false,
				'show_in_nav_menu'    => false,
				'exclude_from_search' => true,
				'capability_type'     => 'page',
			);

		register_post_type( 'sp_post_template', $args );
	}

	/**
	 * Undocumented function
	 *
	 * @param array $attributes shortcode attributes array.
	 * @return string
	 */
	public function smart_template_callback( $attributes ) {
		$saved_template_modules = Helper::get_modules_show_hide();
		$saved_template_enabled = $saved_template_modules['saved-template'];

		$attributes = shortcode_atts(
			array(
				'id' => '',
			),
			$attributes
		);

		$id = $attributes['id'];
		$id = is_numeric( $id ) ? (float) $id : false;

		$content = '';
		if ( $id ) {
			if ( ! $saved_template_enabled ) {
				return '<p>[smart_post id="' . $id . '"]</p>';
			}

			$content_post = get_post( $id );
			$post_status  = isset( $content_post ) ? $content_post->post_status : '';

			if ( 'publish' === $post_status ) {
				$style_url = $this->saved_template_style( $id );
				$this->saved_template_static_style( $id );
				$content .= $content_post ? $content_post->post_content : null;
				$content  = do_blocks( $content );
				$content  = do_shortcode( $content );
				$content  = str_replace( ']]>', ']]&gt;', $content );
				$content  = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content );
				$content  = preg_replace( '/^(?:<br\s*\/?>\s*)+/', '', $content );
				$content  = preg_replace( '#<p>\s*</p>#', '', $content );
				$content  = preg_replace( '#<p>\s*<a[^>]*>\s*</a>\s*</p>#', '', $content );
				return $content;
			}
		}
		return '';
	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $use_block_editor
	 * @param [type] $post_type
	 * @return boolean $use_block_editor block editor true/false.
	 */
	public function smart_post_force_block_editor_for_save_template( $use_block_editor, $post_type ) {
		if ( 'sp_post_template' === $post_type ) {
			return true;
		}
		return $use_block_editor;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function redirect_saved_template_edit_page() {

		// If we are on post.php and editing a post.
		if ( isset( $_GET['post'] ) && isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {

			$post_id   = intval( $_GET['post'] );
			$post_type = get_post_type( $post_id );

			// If this is YOUR custom post type.
			if ( 'sp_post_template' === $post_type ) {
				return;
			}
		}

		// When creating a new post (post-new.php).
		if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( wp_unslash( $_SERVER['REQUEST_URI'] ), 'post-new.php' ) !== false ) {
			return; // DO NOT redirect.
		}

		// Redirect default list table edit.php?post_type=my_cpt.
		if ( isset( $_GET['post_type'] ) && 'sp_post_template' === $_GET['post_type'] ) {

			// avoid redirect loop from your own React page.
			if ( ! isset( $_GET['page'] ) || 'pcp_blocks#savedTemplate' !== $_GET['page'] ) {
				wp_safe_redirect( admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help#savedTemplate' ) );
				exit;
			}
		}
	}

	/**
	 * Undocumented function
	 */
	public function smart_saved_template_rest() {
		register_rest_route(
			'sp-smart-post/v2',
			'/saved-templates-duplicate/(?P<id>\d+)',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'duplicate_smart_saved_templates' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
	/**
	 * Undocumented function
	 *
	 * @param WP_REST_Request $request request.
	 * @return WP_REST_Response
	 */
	public function duplicate_smart_saved_templates( WP_REST_Request $request ) {
		$post_id = (int) $request->get_param( 'id' );

		$post = get_post( $post_id );
		if ( ! $post ) {
			return new WP_Error( 'not_found', 'Post not found', array( 'status' => 404 ) );
		}

		$args        = array(
			'post_title'   => $post->post_title . ' (Copy)',
			'post_content' => $post->post_content,
			'post_type'    => $post->post_type,
			'post_status'  => 'draft',
		);
		$new_post_id = wp_insert_post( $args );
		if ( is_wp_error( $new_post_id ) ) {
			return new WP_Error( 'insert_failed', 'Failed to insert post', array( 'status' => 500 ) );
		}

		// Copy post meta.
		$meta = get_post_meta( $post_id );
		foreach ( $meta as $key => $values ) {
			foreach ( $values as $value ) {
				add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );
			}
		}

		return rest_ensure_response(
			array(
				'new_post_id' => $new_post_id,
				'shortcode'   => sprintf( '[smart_post id="%d"]', $new_post_id ),
			)
		);
	}

	public function saved_template_style( $post_id ) {
		if ( ! $post_id ) {
			return '';
		}

		$upload_dir = wp_upload_dir();

		$css_file_path = trailingslashit( $upload_dir['basedir'] ) .
		"smart-post-show/sp-post-{$post_id}.css";

		$css_file_url = trailingslashit(
			set_url_scheme( $upload_dir['baseurl'] )
		) . "smart-post-show/sp-post-{$post_id}.css";

		if ( ! file_exists( $css_file_path ) ) {
			$css_from_meta = get_post_meta( $post_id, '_sp_smart_css', true );

			wp_register_style( "sp-smart-post-$post_id-css", false, array(), SMART_POST_SHOW_VERSION );
			wp_add_inline_style( "sp-smart-post-$post_id-css", $css_from_meta );
			wp_enqueue_style( "sp-smart-post-$post_id-css" );
		}

		wp_register_style( "sp-smart-post-$post_id-css", $css_file_url, array(), SMART_POST_SHOW_VERSION );
		wp_enqueue_style( "sp-smart-post-$post_id-css" );
	}

	public function saved_template_static_style( $post_id ) {
		$our_blocks_slug   = Helper::get_block_slugs();
		$our_blocks_list   = array();
		$our_blocks_list   = array_map(
			function ( $block ) {
				return "sp-smart-post-show/{$block}";
			},
			$our_blocks_slug
		);
		$active_block_name = Assets_Manager::get_active_blocks( $post_id, $our_blocks_list );
		// $content           = get_post_field( 'post_content', $post_id );

		$active_block_array = self::block_name_ids_array( $active_block_name, $post_id );
		$assets_manager     = new Assets_Manager( $our_blocks_slug );
		$assets_manager->enqueue_combined_block_css( $active_block_array, $post_id );
	}

	public static function block_name_ids_array( $active_block_name, $post_id ) {
		$prefix = 'sp-smart-post-show/';
		$result = array();

		foreach ( $active_block_name as $block ) {
			$result[] = str_replace( $prefix, '', $block );
		}

		return array(
			$post_id => $result,
		);
	}
}
