<?php
/**
 * Smart Post Show
 *
 * @link              https://wpsmartpost.com/
 * @since             2.2.0
 * @package           Smart_Post_Show
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Post
 * Plugin URI:        https://wpsmartpost.com/
 * Description:       <a href="https://wpsmartpost.com/" target="_blank">Smart Post</a> is an Advanced Gutenberg Blocks Library plugin with <a href="https://wpsmartpost.com/blocks/" target="_blank"><strong>60+ Post Layout and Builder blocks</strong></a> and <a href="https://wpsmartpost.com/patterns/" target="_blank"><strong>250+ Ready Patterns Library</strong></a> to showcase your content beautifully. Create stunning layouts like post grid, post list, post slider, post thumbnail slider, post carousel, news ticker, post timeline, and additional page builder blocks and modules—all with just a few clicks. <br> Perfect for blogs, news, magazines, portfolios, and personal websites. Smart Post is also an excellent choice for niche sites like personal blogs, travel blogs, fashion blogs, food blogs, recipe blogs, and more.
 * Version:           4.0.5
 * Author:            ShapedPlugin LLC
 * Author URI:        https://shapedplugin.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       post-carousel
 * Domain Path:       /languages
 * Requires at least: 5.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 * Start at version 2.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SMART_POST_SHOW_VERSION', '4.0.5' );
define( 'SMART_POST_SHOW_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smart-post-show-activator.php
 */
function activate_smart_post_show() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-post-show-activator.php';
	Smart_Post_Show_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smart-post-show-deactivator.php
 */
function deactivate_smart_post_show() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-post-show-deactivator.php';
	Smart_Post_Show_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smart_post_show' );
register_deactivation_hook( __FILE__, 'deactivate_smart_post_show' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smart-post-show.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_smart_post_show() {
	$plugin = new Smart_Post_Show();
	$plugin->run();

	if ( ! defined( 'SHAPEDPLIUGIN_OFFER_BANNER_LOADED' ) ) {
		define( 'SHAPEDPLIUGIN_OFFER_BANNER_LOADED', true );

		/**
		 * The file is responsible for generating admin offer banner.
		 */
		require_once SP_PC_PATH . 'admin/views/notices/offer-banner.php';
	}
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( ! ( is_plugin_active( 'smart-post-show-pro/smart-post-show-pro.php' ) || is_plugin_active_for_network( 'smart-post-show-pro/smart-post-show-pro.php' ) ) ) {
	run_smart_post_show();
}
