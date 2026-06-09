<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link        https://wpsmartpost.com/
 * @since      2.2.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Smart_Post_Show_Admin {

	/**
	 * Script and style suffix
	 *
	 * @since 2.2.0
	 * @access protected
	 * @var string
	 */
	protected $suffix;

	/**
	 * Plugin plugin name
	 *
	 * @access protected
	 * @var string
	 */
	protected $plugin_name;

	/**
	 * Plugin version
	 *
	 * @access protected
	 * @var string
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.2.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Autoload system.
		spl_autoload_register( array( $this, 'autoload' ) );

		// Register options.
		add_action( 'after_setup_theme', array( $this, 'register_options' ) );

		// Plugin action link Button.
		add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
	}

	/**
	 * Registers various options and settings for the post carousel plugin.
	 *
	 * This function sets up metaboxes for preview, layout, options, and shortcodes.
	 * It also initializes settings, layout replacement, and tools for the plugin.
	 *
	 * @since 2.2.0
	 */
	public function register_options() {
		SPS_Metaboxes::preview_metabox( 'sp_pcp_display' );
		SPS_Metaboxes::layout_metabox( 'sp_pcp_layouts' );
		SPS_Metaboxes::option_metabox( 'sp_pcp_view_options' );
		SPS_Metaboxes::shortcode_metabox( 'sp_pcp_display_shortcode' );
		SPS_Metaboxes::page_builders_metabox( 'sp_pcp_page_builder_notice' );
		SPS_Metaboxes::promotional_metabox( 'sp_pcp_promotional_notice' );
		SPS_Settings::settings( 'sp_post_carousel_settings' );
		SPS_ReplaceLayout::Replace_Layout( 'sp_post_carousel_rpl' );
		// SPS_Tools::tools( 'sp_post_carousel_tools' );
	}

	/**
	 * Add plugin action menu
	 *
	 * @param array $links The action link.
	 * @param array $file The file link.
	 *
	 * @return array
	 */
	public function add_plugin_action_links( $links, $file ) {
		if ( SMART_POST_SHOW_BASENAME === $file ) {
			$new_links       = array(
				sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=sp_post_template&spblock_inserter=true' ), __( 'Add Post Layout', 'post-carousel' ) ),
			);
			$links['go_pro'] = sprintf( '<a href="%s" target="_blank" style="%s">%s</a>', 'https://wpsmartpost.com/', 'color:#1dab87;font-weight:bold', __( 'Go Pro!', 'post-carousel' ) );
			return array_merge( $new_links, $links );
		}
		return $links;
	}

	/**
	 *  Add plugin row meta link
	 *
	 * @param [array] $plugin_meta Add plugin row meta link.
	 * @param [url]   $file plugin row meta link.
	 * @return array
	 */
	public function after_pcp_row_meta( $plugin_meta, $file ) {
		if ( SMART_POST_SHOW_BASENAME == $file ) {
			$plugin_meta[] = '<a href="https://wpsmartpost.com/patterns/" target="_blank">' . __( 'Ready Patterns', 'post-carousel' ) . '</a>';
			$plugin_meta[] = '<a href="https://wpsmartpost.com/docs/" target="_blank">' . __( 'Docs', 'post-carousel' ) . '</a>';
			$plugin_meta[] = '<a href="https://www.youtube.com/watch?v=_WxI7oyxdPA&list=PLoUb-7uG-5jMKaIryd6B0d41Lafvx4UF5" target="_blank">' . __( 'Video Tutorials', 'post-carousel' ) . '</a>';
		}
		return $plugin_meta;
	}
	/**
	 * Autoload class files on demand
	 *
	 * @param string $class requested class name.
	 * @since 2.2.0
	 */
	private function autoload( $class ) {
		$name = explode( '_', $class );
		if ( isset( $name[1] ) ) {
			$class_name       = strtolower( $name[1] );
			$pcp_config_paths = array( 'views/', 'views/configs/settings/', 'views/configs/generator/', 'help-page/' );
			foreach ( $pcp_config_paths as $sp_ppc_path ) {
				$filename = plugin_dir_path( __FILE__ ) . '/' . $sp_ppc_path . 'class-sps-' . $class_name . '.php';
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.2.0
	 */
	public function enqueue_styles() {
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		$pcp_page_base         = 'sp_post_carousel_page_pcp_settings' === $current_screen->base || 'sp_post_carousel_page_pcp_tools' === $current_screen->base || 'sp_post_carousel_page_pcp_replace_layout' === $current_screen->base || 'sp_post_carousel_page_pcp_help' === $current_screen->base;

		if ( 'sp_post_carousel' === $the_current_post_type || $pcp_page_base ) {
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'pcp_swiper' );
			wp_enqueue_style( 'pcp_fonttello_icon' );
			wp_enqueue_style( 'pcp-style' );
		}
		wp_enqueue_style( 'sp-' . SP_PC_PLUGIN_NAME, SP_PC_URL . 'admin/assets/css/post-carousel-admin.min.css', array(), SP_PC_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.2.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Smart_Post_Show_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Smart_Post_Show_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( 'sp_post_carousel' === $the_current_post_type ) {
			wp_enqueue_script( SP_PC_PLUGIN_NAME, SP_PC_URL . 'admin/assets/js/post-carousel-admin.min.js', array( 'jquery' ), SP_PC_VERSION, true );
			wp_enqueue_script( 'pcp_swiper' );
			wp_enqueue_script( 'pcp_script' );

			// Fix the plugin ui interaction conflict along with EasyTimeTable plugin.
			wp_dequeue_script( 'jQuery-ui' );
		}
	}

	/**
	 * Add carousel admin columns.
	 *
	 * @since 2.2.0
	 * @return statement
	 */
	public function filter_carousel_admin_column() {
		$admin_columns['cb']         = '<input type="checkbox" />';
		$admin_columns['title']      = __( 'Title', 'post-carousel' );
		$admin_columns['shortcode']  = __( 'Shortcode', 'post-carousel' );
		$admin_columns['pcp_layout'] = __( 'Layout', 'post-carousel' );
		$admin_columns['date']       = __( 'Date', 'post-carousel' );

		return $admin_columns;
	}

	/**
	 * Display admin columns for the carousels.
	 *
	 * @param mix    $column The columns.
	 * @param string $post_id The post ID.
	 * @return void
	 */
	public function display_carousel_admin_fields( $column, $post_id ) {
		$pcp_layouts     = get_post_meta( $post_id, 'sp_pcp_layouts', true );
		$carousels_types = isset( $pcp_layouts['pcp_layout_preset'] ) ? $pcp_layouts['pcp_layout_preset'] : '';
		switch ( $column ) {
			case 'shortcode':
				?>
				<input  class="sp_pcp_input" style="width: 230px;padding: 4px 8px;cursor: pointer;" type="text" onClick="this.select();" readonly="readonly" value="[smart_post_show id=&quot;<?php echo esc_attr( $post_id ); ?>&quot;]"/> <div class="pcp-after-copy-text"><i class="fa fa-check-circle"></i> <?php esc_html_e( 'Shortcode Copied to Clipboard!', 'post-carousel' ); ?></div>
				<?php
				break;
			case 'pcp_layout':
				$layout = ucwords( str_replace( '_layout', ' ', $carousels_types ) );
				echo esc_html( $layout );
		} // end switch.
	}

	/**
	 *  Sp_post_carousel post type Save and update alert in Admin Dashboard created by Post carousel Pro
	 *
	 * @param array $messages alert messages.
	 */
	public function sppcp_update( $messages ) {
		global $post, $post_ID;
		$messages['sp_post_carousel'][1] = __( 'Shortcode Updated', 'post-carousel' );
		$messages['sp_post_carousel'][6] = __( 'Shortcode Published', 'post-carousel' );
		return $messages;
	}

	/**
	 * Redirect after active
	 *
	 * @param string $plugin The plugin help page.
	 */
	public function redirect_help_page( $plugin ) {
		if ( SMART_POST_SHOW_BASENAME === $plugin && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) ) {

			$is_visited_setup_wizard = get_option( 'sp_smart_post_setup_wizard_visited', false );

			if ( ! $is_visited_setup_wizard ) {
				wp_redirect( admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help#setupwizard' ) );
			} elseif ( $is_visited_setup_wizard ) {
				wp_redirect( admin_url( 'edit.php?post_type=sp_post_carousel&page=pcp_help' ) );
			}
			exit();
		}
	}
	/**
	 * If it is the plugins page.
	 *
	 * @since 2.2.0
	 * @access private
	 */
	private function is_plugins_screen() {
		return in_array( get_current_screen()->id, array( 'plugins', 'plugins-network' ), true );
	}

	/**
	 * Bottom review notice.
	 *
	 * @param string $text The review notice.
	 * @return string
	 */
	public function sp_spc_footer_text( $text ) {
		$screen = get_current_screen();
		if ( 'sp_post_carousel_page_pcp_help' === $screen->id || 'sp_post_carousel' === $screen->post_type || 'toplevel_page_sp_post_carousel_settings' === $screen->id ) {
			$heart_icon = '<svg class="spspc-footer-heart" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#E25555"/>
			</svg>';

			$social_icons = array(
				'linkedin'  => array(
					'url'  => 'https://www.linkedin.com/company/shapedplugin',
					'icon' => '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 0c.563 0 1 .469 1 1v12c0 .563-.437 1-1 1H1c-.562 0-1-.437-1-1V1c0-.531.438-1 1-1zM4.219 12h.031V5.313H2.156V12zM3.187 2C2.532 2 2 2.531 2 3.219c0 .656.531 1.187 1.188 1.187s1.218-.531 1.218-1.187A1.22 1.22 0 0 0 3.188 2M12 12V8.344c0-1.813-.375-3.188-2.469-3.188-1.031 0-1.687.563-1.969 1.063h-.03v-.907h-2V12h2.093V8.688c0-.876.156-1.72 1.219-1.72 1.062 0 1.094 1 1.094 1.782V12z" fill="#757575"/></svg>',
				),
				'twitter'   => array(
					'url'  => 'https://www.x.com/shapedplugin/',
					'icon' => '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 0h10c1.094 0 2 .906 2 2v10c0 1.094-.906 2-2 2H2c-1.094 0-2-.906-2-2V2C0 .906.906 0 2 0m9.281 2.625H9.812L7.345 5.438 5.25 2.625H2.188l3.656 4.781-3.469 3.969h1.469L6.53 8.313l2.344 3.062h2.969L8.03 6.344zM10.094 10.5H9.28L3.906 3.469h.875z" fill="#757575"/></svg>',
				),
				'wordpress' => array(
					'url'  => 'https://profiles.wordpress.org/shapedplugin/#content-plugins',
					'icon' => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.688 5.031a6.6 6.6 0 0 0-.594 2.719 6.62 6.62 0 0 0 3.75 5.969zM12.25 7.406c0 .594-.219 1.25-.5 2.157l-.687 2.218-2.376-7.156c.376 0 .75-.062.75-.062.344-.032.313-.563-.062-.532 0 0-1.062.063-1.75.063-.656 0-1.75-.063-1.75-.063-.375-.031-.406.532-.062.532 0 0 .343.062.718.062l1.032 2.844-1.47 4.375-2.405-7.219c.406 0 .75-.062.75-.062.343-.032.312-.563-.032-.532 0 0-1.093.063-1.781.063h-.437a6.65 6.65 0 0 1 5.562-3c1.719 0 3.313.656 4.5 1.75h-.094c-.656 0-1.125.562-1.125 1.187 0 .532.313 1 .656 1.563.25.437.563 1 .563 1.812m-4.375.938 2.031 5.594c.031.03.031.062.063.093a6.5 6.5 0 0 1-2.219.375 6.2 6.2 0 0 1-1.875-.281zm5.719-3.781c.5.937.812 2.03.812 3.187 0 2.469-1.344 4.594-3.312 5.75l2.031-5.875c.375-.937.5-1.719.5-2.375 0-.25 0-.469-.031-.687M0 7.75a7.75 7.75 0 0 0 7.75 7.75 7.75 7.75 0 0 0 7.75-7.75A7.75 7.75 0 0 0 7.75 0 7.75 7.75 0 0 0 0 7.75m15.156 0a7.4 7.4 0 0 1-7.406 7.406A7.4 7.4 0 0 1 .344 7.75 7.4 7.4 0 0 1 7.75.344a7.4 7.4 0 0 1 7.406 7.406" fill="#757575"/></svg>',
				),
				'facebook'  => array(
					'url'  => 'https://www.facebook.com/shapedplugin/',
					'icon' => '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 0h10c1.094 0 2 .906 2 2v10c0 1.094-.906 2-2 2H7.969V9.438h2.156L10.594 7H7.969v-.875c0-1.281.5-1.781 1.812-1.781.406 0 .75 0 .938.031V2.156c-.375-.094-1.25-.187-1.75-.187-2.656 0-3.906 1.25-3.906 3.968V7H3.406v2.438h1.656V14H2c-1.094 0-2-.906-2-2V2C0 .906.906 0 2 0" fill="#757575"/></svg>',
				),
				'youtube'   => array(
					'url'  => 'https://www.youtube.com/@shapedplugin',
					'icon' => '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m8.813 7-2.97 1.688V5.312zM12 0c1.094 0 2 .906 2 2v10c0 1.094-.906 2-2 2H2c-1.094 0-2-.906-2-2V2C0 .906.906 0 2 0zm.438 4.25c-.126-.5-.5-.875-1-1C10.562 3 7 3 7 3s-3.562 0-4.437.25c-.5.125-.876.5-1 1-.25.906-.25 2.75-.25 2.75s0 1.875.25 2.781c.125.469.5.844 1 .969C3.437 11 7 11 7 11s3.563 0 4.438-.25c.5-.125.874-.5 1-1 .25-.875.25-2.75.25-2.75s0-1.844-.25-2.75" fill="#757575"/></svg>',
				),
			);

			$social_html = '';
			foreach ( $social_icons as $platform => $data ) {
				$social_html .= sprintf(
					'<a href="%s" target="_blank" rel="noopener noreferrer" class="spspc-footer-social-link" title="%s">%s</a>',
					esc_url( $data['url'] ),
					esc_attr( ucfirst( $platform ) ),
					$data['icon']
				);
			}

			$text = sprintf(
				'<div class="spspc-footer-container">
					<div class="spspc-footer-left">
						<span class="spspc-footer-made-with">%s</span>
						%s
						<span class="spspc-footer-by">%s</span>
						<a href="https://shapedplugin.com/about-us/" target="_blank" rel="noopener noreferrer" class="spspc-footer-team-link">ShapedPlugin LLC Team</a>
					</div>
					<div class="spspc-footer-social">Get Connected with %s</div>
				</div>',
				esc_html__( 'Made with', 'post-carousel' ),
				$heart_icon,
				esc_html__( 'by the', 'post-carousel' ),
				$social_html
			);
		}
		return $text;
	}

	/**
	 * Bottom version notice.
	 *
	 * @param string $text The version notice.
	 * @return string
	 */
	public function sp_spc_version_text( $text ) {
		$screen = get_current_screen();
		if ( 'sp_post_carousel_page_pcp_help' === $screen->id || 'sp_post_carousel' === $screen->post_type || 'toplevel_page_sp_post_carousel_settings' === $screen->id ) {
			$text = sprintf( 'Enjoyed <b>Smart Post?</b> <a class="spspc-footer-text" href="https://wordpress.org/support/plugin/post-carousel/reviews/" target="_blank"> Rate us! ★★★★★ </a>' );
		}
		return $text;
	}
}

/**
 * Smart Post Show dashboard capability.
 *
 * @return string
 */
function sp_pc_dashboard_capability() {
	return apply_filters( 'sp_pc_dashboard_capability', 'manage_options' );
}
