<?php
/**
 * The plugin block menu page for admin.
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Smart_Post_Show_Pro
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sp_Smart_Post_Block_Admin_Menu_Page' ) ) {

	/**
	 * Sp_Smart_Post_Block_Admin_Menu_Page Class.
	 */
	class Sp_Smart_Post_Block_Admin_Menu_Page {

		/**
		 * Default Modules variable
		 *
		 * @var array
		 */
		private $default_modules = array(
			array(
				'module_name' => 'post-badges',
				'options'     => array(
					'post_type' => 'post',
				),
			),
			array(
				'module_name' => 'back-to-top',
				'options'     => array(
					'display_position'        => 'button-right',
					'horizontal_position'     => array(
						'value' => 30,
						'unit'  => 'px',
					),
					'vertical_position'       => array(
						'value' => 30,
						'unit'  => 'px',
					),
					'back_to_top_icon'        => true,
					'top_icon_source'         => 'top-arrow-one',
					'icon_size'               => array(
						'value' => 24,
						'unit'  => 'px',
					),
					'back_top_label'          => '',
					'display_on'              => 'all-pages',
					'exclude_page'            => array(),
					'include_only'            => array(),
					'smooth_scroll'           => true,
					'transition_delay'        => array(
						'value' => 0.3,
						'unit'  => 's',
					),
					'entrance_animation'      => 'fade-in',
					'go_to_bottom'            => false,
					'back_bottom_label'       => '',
					'typography'              => array(
						'googleFont' => array(
							'family'   => 'Default',
							'variants' => array( '300', '400', '500', '600', '700', '800', '900' ),
						),
						'typography' => array(
							'family'     => '',
							'fontWeight' => '',
							'style'      => '',
							'transform'  => '',
							'decoration' => '',
						),
					),
					'font_size'               => array(
						'value' => 16,
						'unit'  => 'px',
					),
					'line_height'             => array(
						'value' => 1,
					),
					'letter_spacing'          => array(
						'value' => '',
						'unit'  => 'px',
					),
					'word_spacing'            => array(
						'value' => '',
						'unit'  => 'px',
					),
					'color'                   => array(
						'color'      => '#FFF',
						'hoverColor' => '#FFF',
					),
					'background_color'        => array(
						'color' => array(
							'style'       => 'bgColor',
							'transparent' => '',
							'solidColor'  => 'var(--smart-post-secondary)',
							'gradient'    => 'linear-gradient(135deg,rgb(181, 51, 97) 0%,rgb(226, 87, 44) 100%)',
						),
						'hover' => array(
							'style'       => 'bgColor',
							'transparent' => '',
							'solidColor'  => 'var(--smart-post-secondary)',
							'gradient'    => 'linear-gradient(135deg,rgb(181, 51, 97) 0%,rgb(226, 87, 44) 100%)',
						),
					),
					'border'                  => array(
						'style'      => 'none',
						'color'      => '#DDD',
						'hoverColor' => '#DDD',
					),
					'border_width'            => array(
						'value'     => array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						),
						'unit'      => 'px',
						'allChange' => true,
					),
					'border_radius'           => array(
						'value'     => array(
							'top'    => 4,
							'right'  => 4,
							'bottom' => 4,
							'left'   => 4,
						),
						'unit'      => 'px',
						'allChange' => true,
					),
					'box_shadow_enable'       => false,
					'box_shadow'              => array(
						'value'         => array(
							'top'    => 0,
							'right'  => 4,
							'bottom' => 8,
							'left'   => 0,
						),
						'unit'          => 'outset',
						'color'         => '#4E4F521A',
						'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
					),
					'box_shadow_enable_hover' => false,
					'box_shadow_hover'        => array(
						'value'         => array(
							'top'    => 0,
							'right'  => 4,
							'bottom' => 8,
							'left'   => 0,
						),
						'unit'          => 'outset',
						'color'         => '#3434361a',
						'selectDefault' => 'var(--smart-post-shadow-medium-4dp)',
					),
					'padding'                 => array(
						'value'     => array(
							'top'    => 8,
							'right'  => 8,
							'bottom' => 8,
							'left'   => 8,
						),
						'unit'      => 'px',
						'allChange' => true,
					),
					'fontListsEditPage'       => '',
					'dynamic_style'           => '',
				),
			),
		);

		/**
		 * Block constructor.
		 */
		public function __construct() {
			$this->default_modules;
			$this->register_module_settings_option();
			// update block show/hide option.
			add_action( 'wp_ajax_sp_smart_post_block_option', array( $this, 'sp_smart_post_block_option' ) );

			// Get plugin changelog data.
			add_action( 'wp_ajax_sp_smart_post_block_changelog', array( $this, 'sp_smart_post_block_changelog' ) );

			// Script file enqueue for block settings page.
			add_action( 'admin_enqueue_scripts', array( $this, 'sp_smart_block_settings_enqueue' ) );

			add_action( 'rest_api_init', array( $this, 'sp_smart_post_rest_module_settings' ) );

			// Update setup wizard data.
			add_action( 'wp_ajax_sp_smart_post_get_user_consent', array( $this, 'sp_smart_post_get_user_consent' ) );

			// Update settings options.
			add_action( 'wp_ajax_sp_pcp_update_setting_options', array( $this, 'sp_pcp_update_setting_options' ) );

			// Weekly schedules events.
			add_action( 'smart_post_show_weekly_scheduled_events', array( $this, 'send_usage_data_weekly' ) );

			add_action( 'init', array( $this, 'sp_pcp_submit_user_consent' ) );

			add_action( 'load-post-new.php', array( $this, 'restrict_new_template_creation' ) );

			add_action( 'admin_notices', array( $this, 'maybe_show_user_consent_notice' ) );
		}

		/**
		 * Send user data weekly.
		 *
		 * @access  public
		 * @return  void
		 */
		public function send_usage_data_weekly() {
			$user_consent = get_option( 'sp_pcp_allow_anonymous_data', false );
			if ( $user_consent ) {
				$website_type = get_option( 'sp_ua_site_type', '' );
				$this->sp_pc_collect_and_send_usage_data( $website_type );
			}
		}

		/**
		 * Restrict New Template Creation
		 *
		 * This method checks the total posts (all statuses)
		 * of the `sp_post_template` post type.
		 * If the count is 2 or more, it blocks the
		 * new post creation page.
		 *
		 * @return void
		 */
		public function restrict_new_template_creation() {

			// Check if the request is for our custom post type.
			if ( isset( $_GET['post_type'] ) && 'sp_post_template' === $_GET['post_type'] ) {

				// Get all posts count (all statuses).
				$args = array(
					'post_type'      => 'sp_post_template',
					'post_status'    => 'any',
					'posts_per_page' => -1,
					'fields'         => 'ids',
				);

				$posts = get_posts( $args );
				$count = count( $posts );

				// Prevent creating more than 2 templates.
				if ( $count >= 2 ) {

					$redirect_url = admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help&show_pro_modal=1#savedTemplate' );
					wp_safe_redirect( $redirect_url );
					exit;
				}
			}
		}

		/**
		 * Blocks settings option update function
		 *
		 * @return void
		 */
		public function sp_smart_post_block_option() {
				// Check user capability.
			if ( ! current_user_can( apply_filters( 'sp_pc_dashboard_capability', 'manage_options' ) ) ) {
				wp_send_json_error( __( 'Unauthorized access.', 'post-carousel' ), 403 );
			}

				$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp-update-block-settings-nonce' ) ) {
				wp_send_json_error( __( 'Invalid nonce.', 'post-carousel' ), 403 );
			}

				// Process options data.
			if ( isset( $_POST['optionData'] ) ) {
				$options_json = wp_unslash( $_POST['optionData'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

				// Validate and decode JSON.
				$options = json_decode( $options_json, true );

				if ( json_last_error() !== JSON_ERROR_NONE ) {
					wp_send_json_error( __( 'Invalid JSON in options data.', 'post-carousel' ), 400 );
				}

				// Validate it's an array and sanitize.
				if ( ! is_array( $options ) ) {
					$options = array();
				}

				$options = $this->sanitize_array_recursive( $options );

				update_option( 'sp-pcp-blocks-setting-options', $options );
			}

				// Process modules data.
			if ( isset( $_POST['modulesData'] ) ) {
				$modules_json = wp_unslash( $_POST['modulesData'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

				// Validate and decode JSON.
				$modules = json_decode( $modules_json, true );

				if ( json_last_error() !== JSON_ERROR_NONE ) {
					wp_send_json_error( __( 'Invalid JSON in modules data.', 'post-carousel' ), 400 );
				}

				// Validate it's an array and sanitize.
				if ( ! is_array( $modules ) ) {
					$modules = array();
				}

				$modules = $this->sanitize_array_recursive( $modules );

				update_option( 'sp-pcp-blocks-modules-options', $modules );
			}

				// Process integrations data.
			if ( isset( $_POST['integrations'] ) ) {
				$integrations_json = wp_unslash( $_POST['integrations'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

				// Validate and decode JSON.
				$integrations = json_decode( $integrations_json, true );

				if ( json_last_error() !== JSON_ERROR_NONE ) {
					wp_send_json_error( __( 'Invalid JSON in integrations data.', 'post-carousel' ), 400 );
				}

				// Validate it's an array and sanitize.
				if ( ! is_array( $integrations ) ) {
					$integrations = array();
				}

				$integrations = $this->sanitize_array_recursive( $integrations );

				update_option( 'sp-pcp-integration-options', $integrations );
			}

			// Send success response.
			wp_send_json_success(
				array(
					'message' => __( 'Settings updated successfully.', 'post-carousel' ),
				)
			);
		}


		/**
		 * Blocks settings option update function
		 *
		 * @return void
		 */
		public function sp_smart_post_block_changelog() {
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'sp-update-block-settings-nonce' ) ) {
				return;
			}

			$changelog = get_transient( 'sp_smart_post_changelogs' );

			if ( empty( $changelog ) ) {
				$changelog = $this->fetch_changelog_from_api();
			}

			wp_send_json(
				array(
					'changelog' => $changelog,
				)
			);
		}

		/**
		 * Fetches changelog from the remote API.
		 *
		 * @return string The changelog content or empty string on failure.
		 */
		protected function fetch_changelog_from_api() {
			$api_url  = 'https://api.wordpress.org/plugins/info/1.0/post-carousel.json';
			$response = wp_safe_remote_get(
				esc_url_raw( $api_url ),
				array(
					'timeout' => 15,
				)
			);

			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				return '';
			}

			$api_data = json_decode( wp_remote_retrieve_body( $response ), true );
			if ( ! isset( $api_data['sections']['changelog'] ) ) {
				return '';
			}

			$changelog = wp_kses_post( $api_data['sections']['changelog'] );
			set_transient( 'sp_smart_post_changelogs', $changelog, 1 * DAY_IN_SECONDS );

			return $changelog;
		}

		/**
		 * Sanitize array recursively.
		 *
		 * @since 4.0.0
		 * @param mixed $data The data to sanitize.
		 * @return mixed Sanitized data.
		 */
		private function sanitize_array_recursive( $data ) {
			if ( ! is_array( $data ) ) {
				return $data;
			}

			$sanitized = array();
			foreach ( $data as $key => $value ) {
				if ( is_array( $value ) ) {
					$sanitized[ $key ] = $this->sanitize_array_recursive( $value );
				} elseif ( is_string( $value ) ) {
					$sanitized[ $key ] = sanitize_text_field( $value );
				} elseif ( is_int( $value ) ) {
					$sanitized[ $key ] = intval( $value );
				} elseif ( is_float( $value ) ) {
					$sanitized[ $key ] = floatval( $value );
				} elseif ( is_bool( $value ) ) {
					$sanitized[ $key ] = (bool) $value;
				} else {
					$sanitized[ $key ] = $value;
				}
			}

			return $sanitized;
		}

		/**
		 * Duplicates a post & its meta and returns the new duplicated Post ID.
		 *
		 * @param int $post_id The Post ID you want to clone.
		 * @return int The duplicated Post ID.
		 */
		public function duplicate_post( int $post_id ): int {
			$old_post = get_post( $post_id );
			if ( ! $old_post ) {
				// Invalid post ID, return early.
				return 0;
			}

			$title   = $old_post->post_title;
			$content = $old_post->post_content;

			// Create new post array.
			$new_post = array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'draft',
				'post_type'    => $old_post->post_type,
			);

			// Insert new post.
			$new_post_id = wp_insert_post( $new_post );

			// Copy post meta.
			$post_meta = get_post_custom( $post_id );
			foreach ( $post_meta as $key => $values ) {
				foreach ( $values as $value ) {
					add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );
				}
			}

			// Copy post taxonomies.
			$taxonomies = get_post_taxonomies( $post_id );
			foreach ( $taxonomies as $taxonomy ) {
				$term_ids = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
				wp_set_object_terms( $new_post_id, $term_ids, $taxonomy );
			}

			// Return new post ID.
			return $new_post_id;
		}

		/**
		 * Css and Js file enqueue for admin block settings page.
		 *
		 * @return void
		 */
		public function sp_smart_block_settings_enqueue() {
			$global_style = get_option( 'sp_smart_post_global_settings', array() );
			$shadow_css   = $global_style['shadow']['shadowRootCSS'] ?? ':root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12);  --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14);  --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16);  --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18);  --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
			$root_css     = ! empty( $global_style['rootcss'] ) ? $global_style['rootcss'] : ':root{  --sp-smart-breakpoint-tablet: 1023px; --sp-smart-breakpoint-mobile: 767px; --smart-post-light-text: #FAFAFA; --smart-post-background: #FFFFFF; --smart-post-primary-light: #EBEBEB; --smart-post-primary: #999999; --smart-post-primary-dark: #1D1D1D; --smart-post-secondary: #0054FB; --smart-post-dark-2-text: #3E3E3E; --smart-post-dark-text: #0A0A0A; --smart-post-black: #000000;} :root {  --smart-post-shadow-subtle-1dp: 0px 1px 2px 0px rgba(0, 0, 0, 0.12); --smart-post-shadow-light-2dp: 0px 2px 4px 0px rgba(0, 0, 0, 0.14); --smart-post-shadow-medium-4dp: 0px 4px 6px 0px rgba(0, 0, 0, 0.16); --smart-post-shadow-strong-8dp: 0px 8px 18px 0px rgba(0, 0, 0, 0.18); --smart-post-shadow-deep-12dp: 0px 12px 17px 0px rgba(0, 0, 0, 0.20);  --smart-post-shadow-sharp-4dp: 4px 4px 0px 0px rgba(0, 0, 0, 0.25);}';
			$inline_css   = wp_strip_all_tags( $shadow_css . $root_css );

			wp_register_style( 'sp-smart-post-global-root', false, array(), SMART_POST_SHOW_VERSION );
			wp_add_inline_style( 'sp-smart-post-global-root', $inline_css );
			wp_enqueue_style( 'sp-smart-post-global-root' );

			$current_screen = get_current_screen();

			$the_current_page_id = $current_screen->id;

			if ( 'sp_post_carousel_page_pcp_help' === $the_current_page_id ) {

				// css file.
				wp_enqueue_style( 'sp-pcp-block-setting-page', SP_PC_URL . 'blocks/build/dashboard/style-index.css', array(), SP_PC_VERSION, 'all' );
				wp_enqueue_style( 'sp-pcp-block-setting-page-editor', SP_PC_URL . 'blocks/build/dashboard/index.css', array( 'wp-components' ), SP_PC_VERSION, 'all' );

				wp_enqueue_style( 'sp-post-carousel-help', SP_PC_URL . 'admin/help-page/css/help-page.min.css', array(), SP_PC_VERSION );

				// WordPress version check.
				global $wp_version;
				if ( version_compare( $wp_version, '6.6', '<' ) ) {
					// Enqueue react-jsx-runtime.js for lower versions of WordPress.
					wp_enqueue_script( 'sp-jsx-runtime', SP_PC_URL . 'public/assets/js/react-jsx-runtime.min.js', array( 'react', 'react-dom' ), SP_PC_VERSION, true );
				}

				// Js file.
				wp_enqueue_script( 'sp-pcp-block-setting-page', SP_PC_URL . 'blocks/build/dashboard/index.js', array( 'wp-plugins', 'wp-element', 'wp-components', 'wp-core-data' ), SP_PC_VERSION, true );

				remove_all_actions( 'admin_notices' );

				$current_user = wp_get_current_user();

				wp_localize_script(
					'sp-pcp-block-setting-page',
					'sp_pcp_block_settings',
					array(
						'homeUrl'               => home_url( '/' ),
						'pluginUrl'             => SP_PC_URL,
						'getOptions'            => get_option( 'sp-pcp-blocks-setting-options' ),
						'userName'              => $current_user->display_name,
						'modulesOptions'        => get_option( 'sp-pcp-blocks-modules-options' ),
						'integrationOptions'    => get_option( 'sp-pcp-integration-options' ),
						'pluginVersion'         => SP_PC_VERSION,
						'nonce'                 => wp_create_nonce( 'sp-update-block-settings-nonce' ),
						'adminUrl'              => admin_url(),
						'settings'              => get_option( 'sp_post_carousel_settings', array() ),
						'restNonce'             => wp_create_nonce( 'wp_rest' ),
						'restUrl'               => get_rest_url(),
						'wizardImages'          => SP_PC_URL . 'admin/img/wizard/',
						'sp_pcp_user_consent'   => get_option( 'sp_pcp_allow_anonymous_data', 'undefined' ),
						'sp_ua_site_type'       => get_option( 'sp_ua_site_type' ) ?? '',
						'pcp_editor_preference' => get_option( 'spsp_blocks_promo_modal_choice', '' ),
						'savedTemplatesUrl'     => admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help#savedTemplate' ),
					)
				);
			}
		}

		/**
		 * Register block Modules Settings Option.
		 *
		 * @return void
		 */
		public function register_module_settings_option() {
			foreach ( $this->default_modules as $module ) {
				// Build the data you want to save.
				$data = array(
					'module_name' => $module['module_name'],
					'options'     => $module['options'],
				);

				// Save it in wp_options.
				add_option(
					'sp_smart_post_module_' . $module['module_name'],
					$data
				);
			}
		}

		/**
		 * Modules Settings for Your Plugin
		 * Add this to your main plugin file or create a separate
		 * REST API Endpoints - Super Easy Setup.
		 *
		 * @return void
		 */
		public function sp_smart_post_rest_module_settings() {
			// Register GET endpoint.
			register_rest_route(
				'sp-smart-post/v2',
				'/get-module-settings',
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'get_module_settings' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);
			// Register POST endpoint.
			register_rest_route(
				'sp-smart-post/v2',
				'/set-module-settings',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'smart_post_save_module_settings' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);
			// Get total save template.
			register_rest_route(
				'sp-smart-post/v2',
				'/get-total-save-template',
				array(
					'methods'             => 'get',
					'callback'            => array( $this, 'sp_get_save_total_template' ),
					'permission_callback' => function () {
						return current_user_can( 'manage_options' );
					},
				)
			);
		}


		/**
		 * Get all save template function
		 *
		 * @return int
		 */
		public function sp_get_save_total_template() {
			$args = array(
				'post_type'      => 'sp_post_template',
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			);

			$ids = get_posts( $args );

			return count( $ids );
		}

		/**
		 * Get Modules Settings function
		 *
		 * @return rest_response
		 */
		public function get_module_settings() {
			$settings['post-badges'] = get_option( 'sp_smart_post_module_post-badges', array() );
			$settings['back-to-top'] = get_option( 'sp_smart_post_module_back-to-top', array() );
			return rest_ensure_response( $settings );
		}

		/**
		 * Update Modules Settings function
		 *
		 * @param rest_response $request update module options.
		 *
		 * @return rest_response
		 */
		public function smart_post_save_module_settings( $request ) {
			$settings = $request->get_json_params();
			// Basic validation( optional but recommended ) .
			if ( ! is_array( $settings ) ) {
				return new WP_Error( 'invalid_data', 'Settings must be an array', array( 'status' => 400 ) );
			}

			update_option(
				'sp_smart_post_module_' . sanitize_key( $settings['module_name'] ),
				$settings
			);

			return rest_ensure_response( $settings );
		}

		/**
		 * Handle AJAX request to update block settings.
		 */
		public function sp_pcp_update_setting_options() {
			// Check user capability.
			if ( ! current_user_can( apply_filters( 'sp_pc_dashboard_capability', 'manage_options' ) ) ) {
				wp_send_json_error( __( 'Unauthorized access.', 'post-carousel' ), 403 );
			}

			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
			if ( ! wp_verify_nonce( $nonce, 'sp-update-block-settings-nonce' ) ) {
				wp_send_json_error( __( 'Invalid nonce.', 'post-carousel' ) );
			}

			$options_json = isset( $_POST['optionData'] ) ? wp_unslash( $_POST['optionData'] ) : '';// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- JSON validated via json_decode() and json_last_error().
			$options      = (array) json_decode( $options_json, true );

			// Validate JSON was properly decoded.
			if ( json_last_error() !== JSON_ERROR_NONE ) {
				wp_send_json_error( __( 'Invalid JSON data.', 'post-carousel' ) );
			}

			if ( isset( $_POST['shareData'] ) ) {
				$share_data = wp_unslash( $_POST['shareData'] );// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- JSON validated via json_decode() and json_last_error().
				$consent    = filter_var( $share_data, FILTER_VALIDATE_BOOLEAN );
				update_option( 'sp_pcp_allow_anonymous_data', $consent );
			}

			if ( is_array( $options ) ) {

				// Get existing settings.
				$existing_options = get_option( 'sp_post_carousel_settings', array() );

				// Safety check.
				if ( ! is_array( $existing_options ) ) {
					$existing_options = array();
				}

				// Merge new values over old ones.
				$merged_options = array_merge( $existing_options, $options );

				// Save merged result.
				update_option( 'sp_post_carousel_settings', $merged_options );
			}

			// Handle editor preference for promo modal.
			if ( isset( $_POST['editorPreference'] ) ) {
				$editor_preference = sanitize_key( wp_unslash( $_POST['editorPreference'] ) );
				$allowed_editors   = array( 'block_editor', 'classic_shortcode' );
				if ( in_array( $editor_preference, $allowed_editors, true ) ) {
					update_option( 'spsp_blocks_promo_modal_choice', $editor_preference, false );
				} else {
					delete_option( 'spsp_blocks_promo_modal_choice' );
				}
			}
			wp_send_json_success(
				array(
					'options' => get_option( 'sp_post_carousel_settings' ),
				)
			);
		}

		/**
		 * Find blocks by name recursively in a parsed block structure.
		 *
		 * @param array $blocks The array of blocks to search.
		 * @param array $used_blocks The array to store the found block names.
		 * @return void
		 */
		private function sp_pcp_find_blocks_recursive( $blocks, &$used_blocks ) {
			foreach ( $blocks as $block ) {
				if ( ! empty( $block['blockName'] ) && strpos( $block['blockName'], 'sp-smart-post-show/' ) === 0 ) {
					$used_blocks[] = $block['blockName'];
				}
				if ( ! empty( $block['innerBlocks'] ) ) {
					$this->sp_pcp_find_blocks_recursive( $block['innerBlocks'], $used_blocks );
				}
			}
		}

		/**
		 * Collect and send site usage data to the ShapedPlugin SDR endpoint.
		 *
		 * This function gathers non-sensitive site information such as
		 * WordPress version, PHP version, active plugins, used blocks,
		 * and basic site metadata, then sends it to a remote API endpoint
		 * for analytics purposes.
		 *
		 * Data collection is skipped for local and development environments.
		 *
		 * @param string $website_type Type of the website (e.g. blog, business, portfolio).
		 *
		 * @return void
		 */
		public function sp_pc_collect_and_send_usage_data( $website_type ) {
			// ---- Prevent sending data from local/dev sites ----
			$site_url = home_url();
			$host     = wp_parse_url( $site_url, PHP_URL_HOST );

			// Check for local sites.
			if (
			'localhost' === $host ||
			'127.0.0.1' === $host ||
			'::1' === $host ||
			str_ends_with( $host, '.local' ) ||
			str_ends_with( $host, '.test' ) ||
			str_ends_with( $host, '.dev' ) ||
			1 === preg_match( '/^192\.168\./', $host ) ||
			1 === preg_match( '/^10\./', $host ) ||
			1 === preg_match( '/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $host )
			) {
				return; // Stop here, do not collect or send data.
			}

			$theme = wp_get_theme();
			// PHP version.
			$php_version = phpversion();

			// Database version.
			$db_version = get_option( 'smart_post_show_db_version' );

			$site_language = get_locale();

			// Active plugins list.
			$active_plugins = array();
			$plugins        = get_plugins();

			foreach ( (array) get_option( 'active_plugins', array() ) as $plugin_path ) {
				if ( isset( $plugins[ $plugin_path ] ) ) {
					$active_plugins[] = array(
						'name'    => $plugins[ $plugin_path ]['Name'],
						'version' => $plugins[ $plugin_path ]['Version'],
					);
				}
			}

			// Get used blocks.
			$used_blocks = array();
			global $wpdb;

			// Search in posts, pages, custom post types, templates, etc.
			$post_contents = $wpdb->get_col( $wpdb->prepare( "SELECT post_content FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_content LIKE %s", '%<!-- wp:sp-smart-post-show/%' ) );
			foreach ( $post_contents as $post_content ) {
				if ( has_blocks( $post_content ) ) {
					$blocks = parse_blocks( $post_content );
					$this->sp_pcp_find_blocks_recursive( $blocks, $used_blocks );
				}
			}

			// Search in widgets.
			$widget_blocks = get_option( 'widget_block' );
			if ( ! empty( $widget_blocks ) && is_array( $widget_blocks ) ) {
				foreach ( $widget_blocks as $widget_block ) {
					if ( is_array( $widget_block ) && isset( $widget_block['content'] ) ) {
						if ( has_blocks( $widget_block['content'] ) ) {
							$blocks = parse_blocks( $widget_block['content'] );
							$this->sp_pcp_find_blocks_recursive( $blocks, $used_blocks );
						}
					}
				}
			}

			$used_blocks = array_values( $used_blocks );

			// Collect data.
			$data = array(
				'user_email'     => get_option( 'admin_email' ),
				'site_url'       => get_option( 'siteurl' ),
				'site_type'      => $website_type,
				'site_language'  => $site_language,
				'theme_name'     => $theme->get( 'Name' ),
				'plugin_version' => SP_PC_VERSION,
				'wp_version'     => get_bloginfo( 'version' ),
				'php_version'    => $php_version,
				'db_version'     => $db_version,
				'active_plugins' => $active_plugins,
				'used_blocks'    => $used_blocks,
			);

			wp_remote_post(
				'https://api.shapedplugin.com/wp-json/spda/v1/smart-post-collect',
				array(
					'headers' => array(
						'Content-Type' => 'application/json',
						'x-api-key'    => '2g7f3a67fd72fasdf645h45adsf3bidsec9309sfd',
						'User-Agent'   => 'sp-smart-post-data-collector/' . home_url(),
					),
					'body'    => wp_json_encode( $data ),
				)
			);
		}

		/**
		 * Handle user consent submission for anonymous data collection.
		 *
		 * Processes the admin notice form submission, verifies the nonce,
		 * stores the user’s consent choice, and prevents form resubmission
		 * on page refresh.
		 *
		 * @return void
		 */
		public function sp_pcp_submit_user_consent() {
			// Handle POST action for the notice buttons.
			if (
				isset( $_POST['sp_pcp_anonymous_data_action'] ) && check_admin_referer( 'sp_pcp_anonymous_data_action', 'sp_pcp_anonymous_data_nonce' )
				) {
				if ( 'allow' === $_POST['sp_pcp_anonymous_data_action'] ) {
					update_option( 'sp_pcp_allow_anonymous_data', true );
				} elseif ( 'deny' === $_POST['sp_pcp_anonymous_data_action'] ) {
					update_option( 'sp_pcp_ignored_consent_notice', true );
				}

				// Avoid resubmission on refresh.
				echo '<script>window.location = window.location.href;</script>';
				exit;
			}
		}


		/**
		 * Handle AJAX request to get and save user consent.
		 *
		 * This function processes user consent preferences for anonymous data sharing.
		 * It requires user authentication and nonce verification for security.
		 * Updates options for setup wizard visit status, anonymous data sharing preference,
		 * and website type. If consent is granted, it sends collected site data to the
		 * Smart Post SDR service.
		 *
		 * @return void Sends JSON response with success or error message.
		 */
		public function sp_smart_post_get_user_consent() {
			// Check user capability.
			if ( ! current_user_can( apply_filters( 'sp_pc_dashboard_capability', 'manage_options' ) ) ) {
				wp_send_json_error( __( 'Unauthorized access.', 'post-carousel' ), 403 );
			}

			// Verify nonce.
			$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
			if ( ! wp_verify_nonce( $nonce, 'sp-update-block-settings-nonce' ) ) {
				wp_send_json_error( __( 'Invalid nonce.', 'post-carousel' ) );
			}

			update_option( 'sp_smart_post_setup_wizard_visited', true );
			// Get consent.
			$consent      = isset( $_POST['shareData'] ) ? json_decode( wp_unslash( $_POST['shareData'] ), true ) : false;// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- JSON validated via json_decode() and json_last_error().
			$website_type = isset( $_POST['website_type'] ) ? sanitize_text_field( wp_unslash( $_POST['website_type'] ) ) : '';
			update_option( 'sp_ua_site_type', $website_type );

			if ( $consent ) {
				update_option( 'sp_pcp_allow_anonymous_data', true );
				$this->sp_pc_collect_and_send_usage_data( $website_type );
			} else {
				update_option( 'sp_pcp_allow_anonymous_data', false );
			}

			wp_send_json_success(
				array(
					'message' => 'Successfully done',
				)
			);
		}

		/**
		 * Check whether the consent notice delay period has passed.
		 *
		 * Compares the stored notice start time with the current time
		 * to determine if the specified delay duration has elapsed.
		 *
		 * @param int $days Number of days to wait before showing the notice.
		 * @return bool True if the delay has passed, false otherwise.
		 */
		private function has_notice_delay_passed( $days = 7 ) {
			$start_time = get_option( 'sp_pcp_consent_notice_start_time' );

			if ( ! $start_time ) {
				return false;
			}

			return ( time() - $start_time ) >= ( DAY_IN_SECONDS * $days );
		}

		/**
		 * Set the consent notice start time if it does not already exist.
		 *
		 * Stores the current timestamp to track when the consent notice
		 * delay period begins.
		 *
		 * @return void
		 */
		private function maybe_set_notice_start_time() {
			if ( ! get_option( 'sp_pcp_consent_notice_start_time' ) ) {
				update_option( 'sp_pcp_consent_notice_start_time', time() );
			}
		}

		/**
		 * Conditionally display the anonymous data consent notice.
		 *
		 * Ensures the current user has sufficient permissions, the notice
		 * has not been ignored, a valid license is active, and the delay
		 * period has passed before showing the notice.
		 *
		 * @return void
		 */
		public function maybe_show_user_consent_notice() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$ignored_consent_notice = get_option( 'sp_pcp_ignored_consent_notice', false );
			$allow_anonymous_data   = get_option( 'sp_pcp_allow_anonymous_data', false );

			// Do not show if already allowed or ignored.
			if ( $allow_anonymous_data || $ignored_consent_notice ) {
				return;
			}

			// delay logic (7 days).
			$this->maybe_set_notice_start_time();

			if ( ! $this->has_notice_delay_passed( 7 ) ) {
				return;
			}

			// Finally show notice.
			$this->sp_pcp_notice_for_user_consent();
		}

		/**
		 * Render the anonymous data consent admin notice.
		 *
		 * Displays an admin notice prompting the user to allow or deny
		 * anonymous data collection if consent has not yet been given.
		 *
		 * @return void
		 */
		public function sp_pcp_notice_for_user_consent() {
			$plugin_logo_image = 'https://ps.w.org/post-carousel/assets/icon-256x256.gif';
			?>
				<style>
					.sp_pcp-anonymous-data-notice {
						background-color: #ffffff;
						border: none;
						border: 1px solid rgba(204, 204, 204, 1);
						border-left: 4px solid #5715c3;
						margin-bottom: 20px;
						display: flex;
						padding: 14px;
						align-items: flex-start;
						gap: 16px;
						box-shadow: 0 16px 32px -4px rgba(12, 12, 13, 0.05), 0 4px 4px -4px rgba(12, 12, 13, 0.02);
						position: relative;
						border-radius: 4px;
						}

					button.sp_pcp_anonymous_data_cross {
						border: none;
						background: transparent;
						position: absolute;
						top: 0;
						right: 7px;
						cursor: pointer;
						color: #b6b6b6;
						font-size: 16px;
						}

					.sp_pcp-anonymous-data-notice-wrapper {
						display: flex;
						gap: 26px;
						}

					.sp_pcp-anonymous-data-notice img {
						width: 52px;
						border-radius: 4px;
						}
					.sp_pcp-anonymous-data-notice h3 {
						font-weight: 600;
						font-size: 18px;
						color: #2C2D2F;
						margin: 0 0 8px 0;
						}
					.sp_pcp-anonymous-data-notice p, .sp_pcp-anonymous-data-notice a {
						color: #6E6F72;
						font-size: 14px;
						margin: 0 0 2px 0;
						}
					.sp_pcp-anonymous-data-notice a {
						text-decoration: underline;
						}
					.sp_pcp-anonymous-data-notice .button {
						font-size: 14px;
						font-weight: 500;
						}
					.sp_pcp-anonymous-data-notice .button {
						font-size: 14px;
						font-weight: 500;
						background-color: #ffffff;
						color: #6E6F72;
						border: 1px solid #ECEDF0;
						transition: all 0.2s ease;
						margin-top: 8px;
						}
					.sp_pcp-anonymous-data-notice .button:hover {
						border: 1px solid #b7b8bb;
						color: #6E6F72;
						background-color: #ffffff;
						}
					.sp_pcp-anonymous-data-notice .sp_pcp_anonymous_data_connect {
						background-color: rgba(30, 30, 30, 1);
						color: #ffffff;
						line-height: 14px;
						border-radius: 4px;
						font-size: 13px;
						}
					.sp_pcp-anonymous-data-notice .sp_pcp_anonymous_data_connect:hover {
						background-color: rgb(46, 46, 46);
						color: #ffffff;
						}
					.sp_pcp-anonymous-data-notice .sp_pcp_anonymous_data_connect:focus {
						border: none;
						box-shadow: none;
						out-line: none;
						}
				</style>

				<div class="notice notice-info sp_pcp-anonymous-data-notice">
					<img src="<?php echo esc_url( $plugin_logo_image ); ?>" alt="Smart Post"/>
					<div class="sp_pcp-anonymous-data-notice-wrapper">
						<div>
							<h3>
							<?php esc_html_e( 'Help us make Smart Post even more awesome?', 'post-carousel' ); ?>
							</h3>
							<p>
							<?php
							esc_html_e(
								'Allow us to collect non-sensitive diagnostic data to resolve problems faster and improve performance.',
								'post-carousel'
							);
							?>
							<a href="https://wpsmartpost.com/information-we-collect/" target="_blank"><?php esc_html_e( 'Learn More', 'post-carousel' ); ?></a>
							</p>
						</div>
						<div style="display:flex; gap:10px;">
							<form method="post" style="display:inline;">
							<?php wp_nonce_field( 'sp_pcp_anonymous_data_action', 'sp_pcp_anonymous_data_nonce' ); ?>
								<input type="hidden" name="sp_pcp_anonymous_data_action" value="allow" />
								<button type="submit" class="sp_pcp_anonymous_data_connect button">
								<?php esc_html_e( 'Accept & Close', 'post-carousel' ); ?>
								</button>
							</form>

							<form method="post" style="display:inline;">
							<?php wp_nonce_field( 'sp_pcp_anonymous_data_action', 'sp_pcp_anonymous_data_nonce' ); ?>
								<input type="hidden" name="sp_pcp_anonymous_data_action" value="deny" />
								<button type="submit" class="sp_pcp_anonymous_data_cross dashicons dashicons-dismiss">
								</button>
							</form>
						</div>
					</div>
				</div>
			<?php
		}
	}
}
