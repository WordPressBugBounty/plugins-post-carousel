<?php
/**
 * The file that defines the block helper class.
 *
 * A class definition that includes attributes and functions used across all blocks.
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.0
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks
 */

namespace SmartPostShow\Blocks;

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Block Helper Class.
 */
class Helper {


	/**
	 * Get block version.
	 *
	 * @return string
	 */
	public static function get_block_version() {
		return '1.0.0';
	}
	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	public static $block_namespace = 'sp-smart-post-show';

	/**
	 * Check modules show hide.
	 *
	 * @var string
	 */
	public static $modules_show_hide = array();

	/**
	 * Check integrations show hide.
	 *
	 * @var string
	 */
	public static $integration_options = array();

	/**
	 * Icons List.
	 *
	 * @var string
	 */
	public static $icons_list = array();

	/**
	 * Set modules show hide.
	 *
	 * @return void
	 */
	public static function set_modules_show_hide() {
		$modules = self::object_to_array( get_option( 'sp-pcp-blocks-modules-options', array() ) );

		$module_show_hide = array();
		if ( ! empty( $modules ) ) {
			foreach ( $modules as $module ) {
				if ( isset( $module['module_name'] ) ) {
					$module_show_hide[ $module['module_name'] ] = (bool) $module['show'];
				}
			}
		}

		self::$modules_show_hide = $module_show_hide;
	}

	/**
	 * Get modules show hide.
	 *
	 * @return array
	 */
	public static function get_modules_show_hide() {
		return self::$modules_show_hide;
	}

	/**
	 * Set modules show hide.
	 *
	 * @return void
	 */
	public static function set_integration_options() {
		$integrations = self::object_to_array( get_option( 'sp-pcp-integration-options', array() ) );

		$integration_options = array();
		if ( ! empty( $integrations ) ) {
			foreach ( $integrations as $integration ) {
				if ( isset( $integration['name'] ) ) {
					$integration_options[ $integration['name'] ] = (bool) $integration['show'];
				}
			}
		}

		self::$integration_options = $integration_options;
	}

	/**
	 * Get modules show hide.
	 *
	 * @return array
	 */
	public static function get_integration_options() {
		return self::$integration_options;
	}

	/**
	 * Block slug array.
	 *
	 * @var array
	 */
	public static function get_block_slugs() {
		return array(
			'post-carousel',
			'post-slider',
			'post-slider-two',
			'thumbnail-slider',
			'thumbnail-slider-two',
			'news-ticker',
			'post-grid-one',
			'post-grid-two',
			'post-grid-three',
			'post-grid-four',
			'post-grid-five',
			'post-grid-six',
			'post-list-one',
			'post-list-two',
			'post-list-three',
			'post-timeline-one',
			'post-timeline-two',
			'post-timeline-three',
			'shortcode',
			'section-heading',
			'container',
			'column',
			'buttons',
			'button',
			'taxonomy',
			'social-profiles',
			'social-profile-item',
			'pagination',
			'smart-image',
			'taxonomy-filter',
			'sort-filter',
			'date-filter',
			'clear-filter',
			'live-filter',
			'author-filter',
			'search-filter',
			'smart-post-parent',
			'table-of-content',
			'post-carousel-two',
			'smart-search',
			'smart-info-box',
			'smart-list',
			'smart-lists',
			'smart-post-tag',
			'archive-title',
			'post-title',
			'post-content',
			'post-excerpt',
			'post-reading-time',
			'post-like-count',
			'post-view-count',
			'post-author-meta',
			'post-featured-image',
			'post-next-previous',
			'post-comment-count',
			'post-category',
			'post-meta',
			'post-author-box',
			'post-date-meta',
			'post-breadcrumbs',
			'post-social-share',
			'post-comment',
			'post-tab',
			'subscribe-to-newsletter',
		);
	}

	/**
	 * Get "time ago" without minutes/seconds.
	 *
	 * @param string $publish_date MySQL format date (Y-m-d H:i:s).
	 * @return string
	 */
	public static function simple_time_ago( $publish_date ) {
		$publish = new \DateTime( $publish_date );
		$now     = new \DateTime();
		$diff    = $publish->diff( $now );

		if ( $diff->y > 0 ) {
			return $diff->y . ' year' . ( $diff->y > 1 ? 's' : '' ) . ' ago';
		} elseif ( $diff->m > 0 ) {
			return $diff->m . ' month' . ( $diff->m > 1 ? 's' : '' ) . ' ago';
		} elseif ( $diff->d > 0 ) {
			return $diff->d . ' day' . ( $diff->d > 1 ? 's' : '' ) . ' ago';
		} else {
			return 'Today';
		}
	}

	/**
	 * Retrieves the SVG icon for the author.
	 *
	 * @param array $icon_type Icon type.
	 * @return string The SVG icon HTML.
	 */
	public static function get_author_icon( $icon_type ) {
		$author_icon_list = array(
			'outline'       => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" xml:space="preserve" fill="currentColor"><g><path d="M12,11.8c-2.6,0-4.8-2.1-4.8-4.8S9.4,2.2,12,2.2s4.8,2.1,4.8,4.8S14.6,11.8,12,11.8z M12,3.8c-1.8,0-3.2,1.5-3.2,3.2   s1.5,3.2,3.2,3.2s3.2-1.5,3.2-3.2S13.8,3.8,12,3.8z"></path></g><g><path d="M17,21.8H7c-1.5,0-2.8-1.2-2.8-2.8c0-3.2,2.6-5.8,5.8-5.8h4c3.2,0,5.8,2.6,5.8,5.8C19.8,20.5,18.5,21.8,17,21.8z M10,14.8   c-2.3,0-4.2,1.9-4.2,4.2c0,0.7,0.6,1.2,1.2,1.2h10c0.7,0,1.2-0.6,1.2-1.2c0-2.3-1.9-4.2-4.2-4.2H10z"></path></g></svg>',
			'basic-outline' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill="#000" d="M20.485 15.515C19.178 14.208 17.622 13.24 15.925 12.654c1.818-1.252 3.012-3.347 3.012-5.717 0-3.825-3.112-6.937-6.937-6.937S5.063 3.112 5.063 6.937c0 2.37 1.194 4.465 3.012 5.717-2.697.586-4.253 1.554-5.56 2.861C.248 17.781 0 20.795 0 24h1.875c0-5.583 4.542-10.125 10.125-10.125S22.125 18.417 22.125 24H24c0-3.205-1.248-6.219-3.515-8.485zM12 12c-2.791 0-5.062-2.271-5.062-5.062S9.209 1.875 12 1.875s5.063 2.271 5.063 5.063S14.791 12 12 12z"/></svg>',
			'rounded'       => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g clip-path="url(#a)" fill="#000"><path d="M16.8 24H7.2A7.2 7.2 0 0 1 0 16.8V7.2A7.2 7.2 0 0 1 7.2 0h9.6A7.2 7.2 0 0 1 24 7.2v9.6a7.2 7.2 0 0 1-7.2 7.2M7.2 1.6a5.6 5.6 0 0 0-5.6 5.6v9.6a5.6 5.6 0 0 0 5.6 5.6h9.6a5.6 5.6 0 0 0 5.6-5.6V7.2a5.6 5.6 0 0 0-5.6-5.6z"/><path d="M12 13.6A4.8 4.8 0 1 1 12 4a4.8 4.8 0 0 1 0 9.6m0-8a3.2 3.2 0 1 0 0 6.4 3.2 3.2 0 0 0 0-6.4m5.61 12.9a.8.8 0 0 1-.54-.21 5.6 5.6 0 0 0-3.8-1.5h-2.54c-1.4 0-2.76.53-3.8 1.5a.8.8 0 1 1-1.07-1.19 7.2 7.2 0 0 1 4.87-1.9h2.54c1.8 0 3.55.69 4.88 1.91a.8.8 0 0 1-.54 1.4z"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h24v24H0z"/></clipPath></defs></svg>',
			'female'        => '<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 1C18.075 1 23 5.925 23 12s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1zm9.5 11a9.5 9.5 0 0 0-9.5-9.5A9.5 9.5 0 0 0 2.5 12a9.5 9.5 0 0 0 9.5 9.5 9.5 9.5 0 0 0 9.5-9.5zm-15.435 7.419A9.5 9.5 0 0 1 6.066 19.42c.196-.38.518-.707.969-.915l.124-.057 1.61-.867c.212-.115.415-.245.607-.39.216-.162.392-.363.524-.589l-2.859-.286c-1.072-.107-1.484-1.403-.754-2.132.363-.362.594-.841.65-1.347l.306-2.754c.065-.588.283-1.15.631-1.629 2.07-2.846 6.314-2.846 8.384 0 .348.479.566 1.041.631 1.63l.306 2.753c.056.506.287.985.65 1.347.73.73.318 2.025-.754 2.132l-2.859.286c.132.226.309.427.524.589.192.145.395.275.607.39l1.61.867.124.057c.451.208.773.535.969.915A9.5 9.5 0 0 1 6.065 19.42z" fill="#000"/></svg>',
			'user-solid'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24" fill="currentColor"><path d="M224 256a128 128 0 1 0 0-256 128 128 0 0 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3 0 498.7 13.3 512 29.7 512h388.6c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3h-91.4z"/></svg>',
			'circle'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="currentColor"><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320l-64 0c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3l64 0c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"></path></svg>',
			'author'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill="#000" d="M18.75 21H5.25c-.45 0-.75-.3-.75-.75v-1.5c0-4.125 3.375-7.5 7.5-7.5.9 0 1.875.15 2.7.525.375.15.6.6.45.975-.15.375-.6.6-.975.45-.675-.3-1.425-.45-2.175-.45-3.3 0-6 2.7-6 6v.75h12.75c.45 0 .75.3.75.75s-.3.75-.75.75zM12 10.5c-2.1 0-3.75-1.65-3.75-3.75S9.9 3 12 3s3.75 1.65 3.75 3.75S14.1 10.5 12 10.5zm0-6c-1.275 0-2.25.975-2.25 2.25S10.725 9 12 9s2.25-.975 2.25-2.25S13.275 4.5 12 4.5z"/><path fill="#000" d="M15.75 18.9c-.375 0-.75-.3-.75-.675l-.15-2.7c0-.15 0-.3.075-.45l3.45-5.85c.225-.375.675-.45 1.05-.3l2.55 1.5c.375.225.45.675.3 1.05l-3.45 5.85c-.075.15-.15.225-.3.3l-2.4 1.2c-.15 0-.3.075-.375.075zm.6-3.3l.075 1.35 1.2-.6 3.075-5.25-1.275-.75-3.075 5.25z"/></svg>',
			'minimal'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24" fill="currentColor"><path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"></path></svg>',
		);

		return $author_icon_list[ $icon_type ] ?? $author_icon_list['outline'];
	}

	/**
	 * Retrieves the svg icon for taxonomy
	 *
	 * @param string $icon_type Icon type.
	 * @return string
	 */
	public static function get_svg_icon( $icon_type ) {
		$svg_icon_list = array(
			'taxonomy'       => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve" fill="currentColor"><g><path d="M2,19.8c-0.4,0-0.8-0.3-0.8-0.8V7.5c0-1.5,0-2.3,0.3-3c0.4-0.9,1.1-1.6,2-2c0.7-0.3,1.5-0.3,3-0.3H7c0.8,0,1.6,0.4,2.1,1   l1.6,2H16c1.5,0,2.3,0,3,0.4c0.6,0.3,1.1,0.8,1.4,1.4c0.4,0.7,0.4,1.5,0.4,3v1c0,0.4-0.3,0.8-0.8,0.8s-0.8-0.3-0.8-0.8v-1   c0-1.2,0-1.9-0.2-2.3c-0.2-0.3-0.4-0.6-0.8-0.8c-0.4-0.2-1.1-0.2-2.3-0.2h-5.6c0,0,0,0,0,0H7C6.6,6.8,6.2,6.4,6.2,6S6.6,5.2,7,5.2   h1.9L8,4.2C7.8,3.9,7.4,3.8,7,3.8H6.5c-1.3,0-2,0-2.4,0.2c-0.5,0.2-1,0.6-1.2,1.2C2.8,5.5,2.8,6.2,2.8,7.5V19   C2.8,19.4,2.4,19.8,2,19.8z"></path></g><g><path d="M14.9,21.8H6.9c-2.9,0-4.4,0-5.3-1.2c-0.8-1.2-0.2-2.7,0.8-5.3l0.7,0.3l-0.7-0.3l0.3-0.7c0.8-1.9,1.2-3,2.1-3.6   c1-0.6,2.1-0.6,4.1-0.6h8.1c2.9,0,4.4,0,5.2,1.2c0.8,1.2,0.2,2.7-0.8,5.3l-0.3,0.7c-0.8,1.9-1.2,3-2.1,3.6   C18.1,21.8,17,21.8,14.9,21.8z M9.1,11.8c-1.8,0-2.7,0-3.3,0.4c-0.6,0.4-0.9,1.2-1.6,2.9l-0.3,0.7l0,0l0,0c-0.8,2.1-1.3,3.4-1,3.9   c0.4,0.6,1.7,0.6,4,0.6h8.1c1.8,0,2.7,0,3.3-0.4c0.6-0.4,0.9-1.2,1.6-2.9l0.3-0.7c0.8-2.1,1.3-3.4,1-3.9c-0.4-0.6-1.7-0.6-4-0.6   H9.1z"></path></g></svg>',
			'meta-date'      => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18 4.8c-.4 0-.8-.3-.8-.8V2c0-.4.3-.8.8-.8s.8.3.8.8v2c0 .4-.4.8-.8.8zM6 4.8c-.4 0-.8-.4-.8-.8V2c0-.4.3-.8.8-.8s.8.3.8.8v2c0 .4-.4.8-.8.8z"/><path d="M12 18c-.6 0-1-.4-1-1s.4-1 1-1h0c.6 0 1 .4 1 1s-.4 1-1 1zM8 18c-.6 0-1-.4-1-1s.4-1 1-1h0c.6 0 1 .4 1 1s-.4 1-1 1zM16 14c-.6 0-1-.4-1-1 0-.6.4-1 1-1h0c.6 0 1 .4 1 1 0 .6-.4 1-1 1zM12 14c-.6 0-1-.4-1-1 0-.6.4-1 1-1h0c.6 0 1 .4 1 1 0 .6-.4 1-1 1zM8 14c-.6 0-1-.4-1-1 0-.6.4-1 1-1h0c.6 0 1 .4 1 1 0 .6-.4 1-1 1z"/><path d="M20.5 8.8h-17c-.4 0-.8-.3-.8-.8s.3-.8.8-.8h17c.4 0 .8.3.8.8s-.3.8-.8.8z"/><path d="M13 22.8H11c-4.2 0-6.4 0-7.8-1.6-1.5-1.6-1.5-3.9-1.5-8.4v-.5c0-4.5 0-6.8 1.5-8.4C4.7 2.2 6.8 2.2 11 2.2H13c4.2 0 6.4 0 7.8 1.6 1.5 1.6 1.5 3.9 1.5 8.4v.5c0 4.5 0 6.8-1.5 8.4-1.4 1.6-3.6 1.6-7.8 1.6zM11 3.8c-3.8 0-5.7 0-6.7 1.1C3.2 6 3.2 8.1 3.2 12.2v.5c0 4.2 0 6.2 1.1 7.4 1 1.1 2.9 1.1 6.7 1.1H13c3.8 0 5.7 0 6.7-1.1 1.1-1.1 1.1-3.2 1.1-7.4v-.5c0-4.2 0-6.2-1.1-7.4-1-1.1-2.9-1.1-6.7-1.1H11z"/><path d="M21 8.8H3c-.4 0-.8-.3-.8-.8S2.6 7.2 3 7.2h18c.4 0 .8.3.8.8s-.4.8-.8.8z"/></svg>',
			'comments-count' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 26" fill="currentColor"><path d="M5.31 22.75c-.44 0-.87-.04-1.3-.12a.754.754 0 0 1-.57-.48.764.764 0 0 1 .12-.73c.47-.57.79-1.27.93-2.01.04-.23-.08-.51-.32-.75-1.89-1.92-2.93-4.44-2.93-7.08C1.25 5.88 6.07 1.25 12 1.25s10.75 4.63 10.75 10.32S17.93 21.89 12 21.89h-.02c-.69 0-1.38-.06-2.06-.19a16.8 16.8 0 0 0-.61-.1c-.04.02-.3.15-.58.3a7.23 7.23 0 0 1-3.42.86Zm6.69-20c-5.1 0-9.25 3.96-9.25 8.82 0 2.25.89 4.39 2.5 6.03.59.6.86 1.37.72 2.09-.1.55-.28 1.07-.52 1.56.89-.02 1.77-.25 2.57-.67.53-.28.8-.42 1.08-.47.29-.04.56 0 1.1.11.59.11 1.16.2 1.8.17 5.1 0 9.25-3.96 9.25-8.82S17.1 2.75 12 2.75Z"/><path d="M16 13c-.55 0-1-.45-1-1s.44-1 1-1c.55 0 1 .45 1 1s-.45 1-1 1Zm-4 0c-.55 0-1-.45-1-1s.44-1 1-1c.55 0 1 .45 1 1s-.45 1-1 1Zm-3.99 0c-.55 0-1-.45-1-1s.44-1 1-1c.55 0 1 .45 1 1s-.45 1-1 1Z"/></svg>',
			'view-count'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 19.8c-5.1 0-8.8-4.4-10.2-6.4-.3-.5-.6-.8-.6-1.4s.3-.9.6-1.4C3.2 8.7 6.9 4.2 12 4.2s8.8 4.4 10.2 6.4v0L21.5 11l.6-.4c.3.5.6.8.6 1.4s-.2.9-.6 1.4C20.8 15.3 17.1 19.8 12 19.8zM12 5.8c-4.4 0-7.7 4-8.9 5.7-.2.3-.3.4-.3.5s.1.2.3.5c1.2 1.7 4.6 5.7 8.9 5.7s7.7-4 8.9-5.7c.2-.3.3-.4.3-.5s-.1-.2-.3-.5l.6-.4-.6.4C19.7 9.8 16.4 5.8 12 5.8z"/><path d="M12 15.8c-2.1 0-3.8-1.7-3.8-3.8 0-2.1 1.7-3.8 3.8-3.8 2.1 0 3.8 1.7 3.8 3.8 0 2.1-1.7 3.8-3.8 3.8zM12 9.8c-1.2 0-2.2 1-2.2 2.2 0 1.2 1 2.2 2.2 2.2 1.2 0 2.2-1 2.2-2.2 0-1.2-1-2.2-2.2-2.2z"/></svg>',
			'read-time'      => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22.8C6.1 22.8 1.2 17.9 1.2 12S6.1 1.2 12 1.2S22.8 6.1 22.8 12S17.9 22.8 12 22.8zm0-20c-5.1 0-9.2 4.1-9.2 9.2s4.1 9.2 9.2 9.2 9.2-4.1 9.2-9.2S17.1 2.8 12 2.8z"/><path d="M14 14.8c-.2 0-.4-.1-.5-.2l-2-2c-.1-.1-.2-.3-.2-.5V8c0-.4.3-.8.8-.8s.8.3.8.8v3.7l1.8 1.8c.3.3.3.8 0 1.1-.1.1-.3.2-.5.2z"/></svg>',
			'arrow-down'     => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 9L12 15L18 9" stroke="#023047" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
			'preloader'      => '<svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" stroke="currentColor" fill="none" stroke-width="2" xmlns:v="https://vecta.io/nano"><circle cx="22" cy="22" r="1"><animate attributeName="r" begin="0s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/><animate attributeName="stroke-opacity" begin="0s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/></circle><circle cx="22" cy="22" r="1"><animate attributeName="r" begin="-0.9s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite"/><animate attributeName="stroke-opacity" begin="-0.9s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/></circle></svg>',
			'popup-share'    => '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none"><g clip-path="url(#clip0_8796_101699)"><path d="M14.2731 6.87728C14.2732 6.86524 14.2734 6.8069 14.1296 6.64388C14.054 6.55825 13.9567 6.46396 13.8327 6.35091L13.3737 5.94564L12.2087 4.9349C11.7576 4.54319 11.5099 4.30214 11.2936 4.14974C11.1543 4.05161 11.1011 4.04396 11.0768 4.04818C11.0748 4.05179 11.0713 4.05683 11.068 4.0638C11.0437 4.11567 11.0206 4.20956 11.0104 4.35286C11.0006 4.49091 11.0051 4.64188 11.0133 4.79232C11.0205 4.92231 11.0339 5.09643 11.0339 5.20638C11.0337 5.48236 10.8099 5.70638 10.5339 5.70638C9.71804 5.70637 8.97538 5.65562 8.25651 5.73177L7.94889 5.77279C6.6316 5.98702 5.81893 6.5496 5.32389 7.26595C4.97517 7.77061 4.76774 8.3787 4.67155 9.04818C5.24381 8.70842 5.87585 8.38151 6.58756 8.21322L6.83756 8.15951C7.42278 8.04713 8.02247 8.01841 8.60319 8.01693C8.93575 8.01608 9.26839 8.0242 9.5905 8.03255C9.91488 8.04096 10.2281 8.04915 10.5339 8.04915C10.8099 8.04915 11.0338 8.27309 11.0339 8.54915C11.0339 8.65911 11.0205 8.83322 11.0133 8.96322C11.0051 9.11366 11.0006 9.26463 11.0104 9.40267C11.0206 9.54608 11.0437 9.63988 11.068 9.69173C11.0707 9.69738 11.073 9.70201 11.0749 9.7054C11.1167 9.71641 11.1342 9.71403 11.1452 9.71126C11.1676 9.70564 11.2155 9.68703 11.3073 9.61947C11.4008 9.55056 11.5106 9.45312 11.6637 9.31283C11.8115 9.17747 11.9924 9.0084 12.2087 8.82064L13.3737 7.8099L13.8327 7.40462C13.9569 7.29135 14.0539 7.19645 14.1296 7.11068C14.2751 6.94571 14.2731 6.88836 14.2731 6.87728ZM15.2731 6.87728C15.2731 7.24504 15.0912 7.53288 14.8796 7.77279C14.7768 7.88929 14.6509 8.01191 14.5075 8.1429L14.029 8.56478L12.8649 9.57552C12.6617 9.75203 12.4941 9.90853 12.3395 10.0501C12.1903 10.1868 12.0428 10.319 11.9001 10.4242C11.7556 10.5305 11.5872 10.6311 11.3883 10.681C11.2317 10.7203 11.0766 10.7229 10.9225 10.6956L10.7682 10.6585C10.4586 10.564 10.2695 10.3423 10.1637 10.1175C10.0638 9.9049 10.0273 9.67053 10.0133 9.47396C10.0027 9.32357 10.0044 9.17336 10.0094 9.03939C9.86067 9.03627 9.71157 9.03638 9.56413 9.03255C9.24069 9.02416 8.92217 9.01613 8.60612 9.01693C8.05141 9.01834 7.52255 9.04708 7.02799 9.14193L6.81803 9.18685C5.94067 9.39424 5.21237 9.89082 4.36784 10.4085C4.21355 10.5031 4.01989 10.5067 3.86198 10.4183C3.70406 10.3299 3.60612 10.1628 3.60612 9.98177C3.60618 8.82247 3.84208 7.652 4.50163 6.69759C5.17136 5.72845 6.23969 5.03733 7.78874 4.78548L8.13737 4.73958C8.76558 4.67288 9.41334 4.68752 10.0085 4.69857C10.004 4.56909 10.0031 4.42547 10.0133 4.28158C10.0273 4.08498 10.0637 3.85069 10.1637 3.63802C10.2695 3.41316 10.4585 3.19153 10.7682 3.09701L10.9294 3.0599C11.2961 3.00307 11.6041 3.14504 11.8688 3.33138C12.1403 3.52253 12.4771 3.84226 12.8649 4.17904L14.029 5.19076L14.5075 5.61165C14.6511 5.74282 14.7766 5.86611 14.8796 5.98275C15.0911 6.22256 15.273 6.50972 15.2731 6.87728Z" fill="#2F2F2F"></path><path d="M0.939453 8.54688C0.939453 7.06846 0.938877 5.90928 1.06055 5.00586C1.18422 4.08789 1.44237 3.35921 2.01563 2.78711L2.2207 2.60059C2.71473 2.19412 3.31453 1.98017 4.03809 1.86328C4.85051 1.73205 5.87188 1.71617 7.15039 1.71387C7.42646 1.71343 7.65083 1.93682 7.65137 2.21289C7.65186 2.48895 7.42837 2.71323 7.15234 2.71387C5.85735 2.7162 4.91732 2.73427 4.19727 2.85059C3.58026 2.9503 3.16673 3.11611 2.85156 3.37695L2.72168 3.49512C2.36575 3.85047 2.15944 4.33232 2.05078 5.13867C1.94015 5.95986 1.93945 7.03996 1.93945 8.54688C1.93945 10.0539 1.94015 11.1339 2.05078 11.9551C2.15942 12.7615 2.3658 13.2432 2.72168 13.5986L2.8623 13.7256C3.20446 14.0045 3.66277 14.1736 4.37012 14.2686C5.19323 14.379 6.27619 14.3809 7.78613 14.3809C9.29593 14.3809 10.3781 14.379 11.2012 14.2686C12.01 14.16 12.4933 13.9542 12.8496 13.5986L12.9395 13.5029C13.3724 13.0064 13.5506 12.2693 13.6064 10.8604C13.6176 10.5846 13.8502 10.3699 14.126 10.3809C14.4019 10.3918 14.6164 10.6245 14.6055 10.9004C14.5493 12.3169 14.3753 13.3735 13.6982 14.1543L13.5557 14.3066C12.9825 14.8786 12.2533 15.1364 11.334 15.2598C10.429 15.3812 9.26766 15.3809 7.78613 15.3809C6.3044 15.3809 5.14238 15.3812 4.2373 15.2598C3.37543 15.1441 2.68071 14.9103 2.125 14.4102L2.01563 14.3066C1.44254 13.7346 1.18422 13.0066 1.06055 12.0889C0.938829 11.1854 0.939453 10.0255 0.939453 8.54688Z" fill="#2F2F2F"></path></g><defs><clipPath id="clip0_8796_101699"><rect width="16" height="16" fill="white" transform="translate(0.105469 0.213867)"></rect></clipPath></defs></svg>',
		);
		return $svg_icon_list[ $icon_type ] ?? '';
	}

	/**
	 * Retrieves the svg icon for arrow icons
	 *
	 * @param string $icon_type Icon type.
	 * @return string
	 */
	public static function get_arrow_icon( $icon_type ) {
		$arrow_icons = array(
			'chevron-solid'          => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 8 14"><path d="M7.5 6.4 1.9.7C1.5.3.9.3.5.7s-.4 1 0 1.4L5.4 7 .5 11.9c-.2.2-.3.4-.3.7 0 .6.4 1 1 1 .3 0 .5-.1.7-.3l5.7-5.7c.3-.2.3-.8-.1-1.2"/></svg>',
			'chevron-outline'        => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 10 18"><path d="M1.25 17.25a.748.748 0 0 1-.5302-.2198.7495.7495 0 0 1 0-1.0605L7.6896 9 .7197 2.0302a.7495.7495 0 0 1 0-1.0605.7497.7497 0 0 1 1.0605 0l7.5 7.5a.7495.7495 0 0 1 0 1.0605l-7.5 7.5a.748.748 0 0 1-.5302.2198"/></svg>',
			'chevron-bold'           => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 10 15"><path d="m9.354 8.2992-6.375 6.375c-.4407.4406-1.1532.4406-1.5892 0L.3305 13.6148c-.4407-.4406-.4407-1.1531 0-1.589L4.8492 7.507.3305 2.9883c-.4407-.4406-.4407-1.1531 0-1.589L1.3852.3304c.4406-.4407 1.153-.4407 1.589 0l6.375 6.375a1.122 1.122 0 0 1 .0047 1.5937"/></svg>',
			'double-chevron'         => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 14 14"><path d="M6.34 13.32a.93.93 0 0 1 0-1.33l4.99-4.98-4.99-4.99a.93.93 0 0 1 0-1.32.93.93 0 0 1 1.33 0l5.64 5.65c.37.36.37.95 0 1.32l-5.64 5.65a.95.95 0 0 1-1.33 0"/><path d="M.69 13.32a.93.93 0 0 1 0-1.33l4.98-4.98L.7 2A.93.93 0 0 1 .69.7.93.93 0 0 1 2 .7l5.65 5.65c.37.37.37.95 0 1.32L2 13.31a.94.94 0 0 1-1.32 0"/></svg>',
			'arrow-solid'            => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path d="M1.54 9.51h9.48l-3.19 3.46a1.5 1.5 0 0 0 2.23 2.05l5.52-6q.4-.45.4-1.02t-.4-1.02l-5.52-6a1.51 1.51 0 0 0-2.23 2.05l3.19 3.46H1.54a1.5 1.5 0 1 0 0 3.02"/></svg>',
			'arrow-outline'          => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 16"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.49 9.73H2.05c-2.03 0-2.03-3.45 0-3.45h9.44L8.6 3.4C7.2 2 9.62-.5 11.04.97l5.99 6c.62.56.62 1.52 0 2.14-1.98 1.98-4.02 3.95-6 5.99-1.4 1.41-3.9-1.02-2.42-2.49zm2.15-.9-4.41 4.46c-.62.56.56 1.75 1.19 1.13 1.97-1.98 4-3.96 5.98-5.99a.6.6 0 0 0 0-.85L10.42 1.6c-.57-.62-1.76.57-1.2 1.2l4.42 4.4H2.05c-.84 0-.84 1.64 0 1.64z"/></svg>',
			'arrow-minimal'          => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 20"><path d="M14.5 19.5a.5.5 0 0 1-.35-.85L22.79 10l-8.64-8.65a.5.5 0 0 1 .7-.7l9 9c.2.2.2.5 0 .7l-9 9a.5.5 0 0 1-.35.15"/><path d="M23.5 10.5H.5a.5.5 0 0 1 0-1h23a.5.5 0 0 1 0 1"/></svg>',
			'chevron-border-line'    => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 10 16"><path d="M9.1 6.802 3.295.996A1.693 1.693 0 1 0 .9 3.391L5.508 8 .9 12.609a1.69 1.69 0 0 0 0 2.394c.66.66 1.732.664 2.395 0l5.807-5.806c.32-.32.496-.744.496-1.197A1.68 1.68 0 0 0 9.1 6.802m-.683 1.711L2.61 14.32a.726.726 0 0 1-1.027-1.027L6.877 8 1.583 2.707A.726.726 0 1 1 2.61 1.68l5.807 5.806a.727.727 0 0 1 0 1.027"/></svg>',
			'double-chevron-outline' => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path d="M4.69 7.33c.27.41.27.94 0 1.34l-3.8 5.7a.73.73 0 0 0 .61 1.13h2.2c.6 0 1.16-.3 1.49-.8l3.83-5.75c.38-.58.38-1.32 0-1.9L5.19 1.3C4.86.8 4.3.5 3.69.5H1.5a.73.73 0 0 0-.6 1.13zM1.3 1.13a.2.2 0 0 1 .2-.12h2.2c.43 0 .83.21 1.07.57l3.82 5.75c.27.41.27.94 0 1.34l-3.82 5.75c-.24.36-.64.57-1.07.57H1.5a.2.2 0 0 1-.19-.11.2.2 0 0 1 .01-.23l3.8-5.7c.38-.58.38-1.32 0-1.9l-3.8-5.7a.2.2 0 0 1 0-.22"/><path d="M10.62 7.33c.27.41.27.94 0 1.34l-3.8 5.7a.73.73 0 0 0 .61 1.13h2.2c.6 0 1.16-.3 1.5-.8l3.82-5.75c.38-.58.38-1.32 0-1.9L11.12 1.3c-.33-.5-.89-.8-1.5-.8H7.44a.73.73 0 0 0-.6 1.13zm-3.38-6.2a.2.2 0 0 1 .2-.12h2.19c.43 0 .83.21 1.07.57l3.82 5.75c.27.41.27.94 0 1.34l-3.82 5.75c-.24.36-.64.57-1.07.57h-2.2a.2.2 0 0 1-.19-.11.2.2 0 0 1 .01-.23l3.8-5.7c.38-.58.38-1.32 0-1.9l-3.8-5.7a.2.2 0 0 1 0-.22"/></svg>',
			'triangle-outline'       => '<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 10 12"><path d="M9.5 5.56 1.14.34a.52.52 0 0 0-.8.44v10.44a.52.52 0 0 0 .8.44l8.34-5.22a.52.52 0 0 0 0-.88m-8.1 4.72V1.72L8.22 6z"/></svg>',
		);

		return $arrow_icons[ $icon_type ] ?? $arrow_icons['chevron-solid'];
	}

	/**
	 * Breadcrumb block icons
	 *
	 * @param string $icon_type Icon type.
	 * @return string
	 */
	public static function get_post_breadcrumb_icons( $icon_type ) {
		$arrow_icons = array(
			'classic'  => '	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
  <path d="M2.80006 7.56351V19.5635C2.80006 20.1158 3.24778 20.5635 3.80006 20.5635H9.30006M20.8001 3.56351V19.5635C20.8001 20.1158 20.3523 20.5635 19.8001 20.5635H14.3001" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
  <path d="M0.800064 8.56351L11.2119 0.991269C11.5625 0.73625 12.0376 0.73625 12.3882 0.991268L22.8001 8.56351" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M14.3001 20.5635V16.0635C14.3001 14.6828 13.1808 13.5635 11.8001 13.5635C10.4194 13.5635 9.30006 14.6828 9.30006 16.0635V20.5635" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
</svg>    
      ',
			'modern'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
  <path d="M8.80006 21.5793H2.80006C2.24778 21.5793 1.80006 21.1316 1.80006 20.5793V11.1145C1.80006 10.7802 1.96717 10.4679 2.24536 10.2825L10.2454 4.94915C10.5813 4.72521 11.0189 4.72521 11.3548 4.94915L19.3548 10.2825C19.633 10.4679 19.8001 10.7802 19.8001 11.1145V20.5793C19.8001 21.1316 19.3523 21.5793 18.8001 21.5793H12.8001" stroke="#2F2F2F" stroke-width="1.6"/>
  <path d="M0.800064 7.57935L10.2266 0.98077C10.5709 0.739746 11.0292 0.739745 11.3735 0.980769L20.8001 7.57935" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M12.8001 21.5793V16.5793C12.8001 15.4748 11.9046 14.5793 10.8001 14.5793C9.69549 14.5793 8.80006 15.4748 8.80006 16.5793V21.5793" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round"/>
</svg>',
			'minimal'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M2.80006 11.5635V21.5635C2.80006 22.1158 3.24778 22.5635 3.80006 22.5635H9.30006M20.8001 11.5635V21.5635C20.8001 22.1158 20.3523 22.5635 19.8001 22.5635H14.3001" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round"/>
  <path d="M0.800064 8.56351L11.2119 0.991269C11.5625 0.73625 12.0376 0.73625 12.3882 0.991268L22.8001 8.56351" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M14.3001 22.5635V18.0635C14.3001 16.6828 13.1808 15.5635 11.8001 15.5635C10.4194 15.5635 9.30006 16.6828 9.30006 18.0635V22.5635" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round"/>
</svg>',
			'tiny'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
  <path d="M22.8 9.50793H19.3V15.0079V19.5079C19.3 20.0602 18.8523 20.5079 18.3 20.5079H5.30002C4.74773 20.5079 4.30002 20.0602 4.30002 19.5079V9.50793H0.800018" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M0.800018 9.50793L11.1668 1.02604C11.5351 0.724648 12.0649 0.724648 12.4333 1.02604L22.8 9.50793" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round"/>
  <path d="M14.3 20.0079V15.5079C14.3 14.1272 13.1807 13.0079 11.8 13.0079C10.4193 13.0079 9.30002 14.1272 9.30002 15.5079V20.0079H14.3Z" stroke="#2F2F2F" stroke-width="1.6" stroke-linecap="round"/>
</svg>',
			'flip'     => '<svg
    xmlns="http://www.w3.org/2000/svg"
    width={22}
    height={22}
    viewBox="0 0 22 22"
    fill="none"
   
  >
    <path
      d="M6.19981 11.1998C6.19981 11.6969 5.79687 12.0998 5.29981 12.0998C4.80275 12.0998 4.39981 11.6969 4.39981 11.1998C4.39981 10.7027 4.80275 10.2998 5.29981 10.2998C5.79687 10.2998 6.19981 10.7027 6.19981 11.1998Z"
      fill="currentColor"
    />
    <path
      d="M10.1498 11.1998C10.1498 11.6969 9.74687 12.0998 9.24981 12.0998C8.75275 12.0998 8.34981 11.6969 8.34981 11.1998C8.34981 10.7027 8.75275 10.2998 9.24981 10.2998C9.74687 10.2998 10.1498 10.7027 10.1498 11.1998Z"
      fill="currentColor"
    />
    <path
      d="M14.0998 11.1998C14.0998 11.6969 13.6969 12.0998 13.1998 12.0998C12.7028 12.0998 12.2998 11.6969 12.2998 11.1998C12.2998 10.7027 12.7028 10.2998 13.1998 10.2998C13.6969 10.2998 14.0998 10.7027 14.0998 11.1998Z"
      fill="currentColor"
    />
    <path
      d="M6.19991 15.4998C6.19991 15.9969 5.79696 16.3998 5.29991 16.3998C4.80285 16.3998 4.39991 15.9969 4.39991 15.4998C4.39991 15.0027 4.80285 14.5998 5.29991 14.5998C5.79696 14.5998 6.19991 15.0027 6.19991 15.4998Z"
      fill="currentColor"
    />
    <path
      d="M10.1499 15.4998C10.1499 15.9969 9.74692 16.3998 9.24986 16.3998C8.7528 16.3998 8.34986 15.9969 8.34986 15.4998C8.34986 15.0027 8.7528 14.5998 9.24986 14.5998C9.74692 14.5998 10.1499 15.0027 10.1499 15.4998Z"
      fill="currentColor"
    />
    <path
      d="M14.0998 15.4998C14.0998 15.9969 13.6969 16.3998 13.1998 16.3998C12.7028 16.3998 12.2998 15.9969 12.2998 15.4998C12.2998 15.0027 12.7028 14.5998 13.1998 14.5998C13.6969 14.5998 14.0998 15.0027 14.0998 15.4998Z"
      fill="currentColor"
    />
    <path
      d="M4.5 3.7998V0.799805C4.5 0.357977 4.85798 0 5.2998 0C5.74163 0 6.09961 0.357977 6.09961 0.799805V3.7998C6.09961 4.24163 5.74163 4.59961 5.2998 4.59961C4.85798 4.59961 4.5 4.24163 4.5 3.7998ZM12.5 3.7998V0.799805C12.5 0.357977 12.858 0 13.2998 0C13.7416 0 14.0996 0.357977 14.0996 0.799805V3.7998C14.0996 4.24163 13.7416 4.59961 13.2998 4.59961C12.858 4.59961 12.5 4.24163 12.5 3.7998Z"
      fill="currentColor"
    />
    <path
      d="M17.0039 1.5C18.4338 1.5 19.6344 2.57739 19.7881 3.99902L21.3555 18.499C21.5344 20.1547 20.2376 21.5994 18.5723 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.2998C0 2.75341 1.25341 1.5 2.7998 1.5H17.0039ZM1.59961 18.7998C1.59961 19.421 2.07184 19.9315 2.67676 19.9932L2.7998 20H15.7998C16.4625 20 17 19.4625 17 18.7998V7.59961H1.59961V18.7998ZM18.5996 18.7998C18.5996 19.2298 18.5003 19.6359 18.3271 20H18.5723C19.2859 19.9998 19.8413 19.3804 19.7646 18.6709L18.5996 7.89258V18.7998ZM1.59961 6H17V4.2998C17 3.63706 16.4625 3.09961 15.7998 3.09961H2.7998C2.13706 3.09961 1.59961 3.63706 1.59961 4.2998V6Z"
      fill="currentColor"
    />
  </svg>',
			'grid'     => '<svg
    xmlns="http://www.w3.org/2000/svg"
    width={22}
    height={22}
    viewBox="0 0 22 22"
    fill="none"
    
  >
    <path
      d="M20 4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
      fill="currentColor"
    />
    <path d="M0.799805 3.4998H20.7998V8.4998H0.799805V3.4998Z" fill="currentColor" />
    <path
      d="M5 4.7998V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998ZM15 4.7998V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998Z"
      fill="currentColor"
    />
    <path d="M4.7998 10.7998H6.7998V12.7998H4.7998V10.7998Z" fill="currentColor" />
    <path d="M4.7998 15.7998H6.7998V17.7998H4.7998V15.7998Z" fill="currentColor" />
    <path d="M9.7998 10.7998H11.7998V12.7998H9.7998V10.7998Z" fill="currentColor" />
    <path d="M9.7998 15.7998H11.7998V17.7998H9.7998V15.7998Z" fill="currentColor" />
    <path
      d="M14.7998 10.7998H16.7998V12.7998H14.7998V10.7998Z"
      fill="currentColor"
    />
    <path
      d="M14.7998 15.7998H16.7998V17.7998H14.7998V15.7998Z"
      fill="currentColor"
    />
  </svg>',
			'outline'  => '<svg
    xmlns="http://www.w3.org/2000/svg"
    width={22}
    height={22}
    viewBox="0 0 22 22"
    fill="none"
   
  >
    <path
      d="M15 4.7998V3.59961H6.59961V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998V3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H16.5996V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H5V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V2H15V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
      fill="currentColor"
    />
    <path d="M20.7998 7V8.59961H0.799805V7H20.7998Z" fill="currentColor" />
  </svg>',
			'bold'     => '<svg
    xmlns="http://www.w3.org/2000/svg"
    width={22}
    height={22}
    viewBox="0 0 22 22"
    fill="none"    
  >
    <path
      d="M20 4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
      fill="currentColor"
    />
    <path d="M0.799805 3.4998H20.7998V8.4998H0.799805V3.4998Z" fill="currentColor" />
    <path
      d="M5 4.7998V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998ZM15 4.7998V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998Z"
      fill="currentColor"
    />
  </svg>',
			'fill'     => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
  <path d="M2 8H20V19C20 19.5523 19.5523 20 19 20H3C2.44772 20 2 19.5523 2 19V8Z" fill="#2F2F2F"/>
  <path d="M10.4118 0.427762L0.497402 7.63825C0.340753 7.75218 0.421341 8 0.615037 8H21.385C21.5787 8 21.6592 7.75218 21.5026 7.63825L11.5882 0.427761C11.2375 0.172743 10.7625 0.172743 10.4118 0.427762Z" fill="#2F2F2F"/>
  <path d="M13.5 20V16.5C13.5 15.1193 12.3807 14 11 14C9.61929 14 8.5 15.1193 8.5 16.5V20H13.5Z" fill="white"/>
</svg>',
			'fill-two' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
  <path d="M11 3.53418L3.15381 10.0026C3.15381 10.0117 3.15152 10.0251 3.14693 10.0434C3.14244 10.0616 3.14005 10.0748 3.14005 10.0841V18.8341C3.14005 19.0705 3.22651 19.2755 3.39938 19.4481C3.57221 19.6208 3.77687 19.7077 4.01341 19.7077H9.25319V14.4676H12.7469V19.7078H17.9866C18.2231 19.7078 18.428 19.6211 18.6006 19.4481C18.7735 19.2757 18.8603 19.0706 18.8603 18.8341V10.0841C18.8603 10.0478 18.8553 10.0204 18.8465 10.0026L11 3.53418Z" fill="#2F2F2F"/>
  <path d="M21.8482 8.52878L18.86 6.04524V0.477714C18.86 0.350435 18.8191 0.245763 18.737 0.163842C18.6555 0.0820168 18.5509 0.041104 18.4233 0.041104H15.8034C15.6759 0.041104 15.5713 0.0820168 15.4893 0.163842C15.4076 0.245763 15.3667 0.350483 15.3667 0.477714V3.13862L12.0372 0.354784C11.7464 0.118246 11.4007 0 11.0003 0C10.6 0 10.2543 0.118246 9.96326 0.354784L0.151633 8.52878C0.0606787 8.60143 0.0108284 8.69922 0.00155609 8.82205C-0.00766838 8.94479 0.0241154 9.052 0.097003 9.1429L0.943025 10.1527C1.01591 10.2345 1.11131 10.2846 1.22961 10.3029C1.33882 10.3121 1.44803 10.2801 1.55724 10.2074L11 2.33351L20.4429 10.2074C20.5159 10.2708 20.6112 10.3025 20.7295 10.3025H20.7705C20.8886 10.2845 20.9838 10.2342 21.0571 10.1525L21.9032 9.14286C21.976 9.05176 22.0078 8.94475 21.9984 8.82186C21.9891 8.69936 21.939 8.60157 21.8482 8.52878Z" fill="#2F2F2F"/>
</svg>',
		);

		return $arrow_icons[ $icon_type ] ?? $arrow_icons['chevron-solid'];
	}

	/**
	 * Converts a slug string to StudlyCase format with underscores.
	 *
	 * @param string $slug The slug string to convert.
	 * @return string The converted string in StudlyCase format with underscores.
	 */
	public static function to_studly_case( $slug ) {
		$parts = explode( '-', $slug );
		$parts = array_map( 'ucfirst', $parts );
		return implode( '_', $parts );
	}
	/**
	 * Object to array convert function.
	 *
	 * @param array|object $data object data to array.
	 * @return array
	 */
	public static function object_to_array( $data ) {
		$result = array();
		if ( ! empty( $data ) ) {
			foreach ( $data as $key => $value ) {
				$result[ $key ] = ( is_array( $value ) || is_object( $value ) ) ? self::object_to_array( $value ) : $value;
			}
		}
		return $result;
	}

	/**
	 * Extracts image, video, and audio URLs from HTML content.
	 *
	 * Supports:
	 * - <img src="">
	 * - <video src=""> and <source src=""> inside <video>
	 * - <audio src=""> and <source src=""> inside <audio>
	 */

	/**
	 * Extracts image, video, and audio URLs from HTML content.
	 *
	 * @param array  $attributes Block attributes.
	 * @param array  $data Current image data.
	 * @param string $type Media type.
	 * @return string
	 */
	public static function get_media_from_content( $attributes, $data, $type = '' ) {
		$content = $data['content'] ?? '';

		$thumbnail_image = $data['thumbnail_image'] ?? '';

		$image_replace_with = $attributes['imageReplaceWith'] ?? array();

		// Step 2: Use regex to extract media.
		$medias = array(
			'img'          => '',
			'video'        => '',
			'audio'        => '',
			'image_source' => array(),
		);

		// Match <img> for images.
		if ( preg_match_all( '/<img[^>]+src=["\']([^"\']+)["\']/', $content, $matches ) ) {
			$medias['image_source'] = $matches[1];
		}

		// Match <img> for images.
		if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', $content, $match ) ) {
			$medias['img'] = '<img src="' . $match[1] . '" />';
		}

		// Match video <source> or <video>.
		if ( preg_match( '/<(video|source)[^>]+src=["\']([^"\']+\.(mp4|webm|mov))["\']/', $content, $match ) ) {
			$medias['video'] = '<video controls><source src=' . $match[2] . ' type="video/mp4" /></video>';
		}

		// Match YouTube/Vimeo iframe.
		if ( preg_match( '/<iframe[^>]+src=["\']([^"\']*(youtube|vimeo)\.com[^"\']*)["\']/', $content, $match ) ) {
			$medias['video'] = '<video controls><source src=' . $match[1] . ' type="video/mp4" /></video>';
		}

		// Match audio <source> or <audio>.
		if ( preg_match( '/<(audio|source)[^>]+src=["\']([^"\']+\.(mp3|ogg|wav))["\']/', $content, $match ) ) {
			$medias['audio'] = '<audio controls > <source src="' . $match[2] . '" type ="audio/mpeg" /></audio>';
		}

		if ( ! empty( $medias['image_source'] ) && 'image_source' === $type ) {
			return $medias['image_source'];
		}

		if ( empty( $thumbnail_image ) && empty( $image_replace_with ) ) {
			foreach ( $medias as $media ) {
				if ( ! empty( $media ) ) {
					return $media;
				}
			}
		}

		if ( empty( $thumbnail_image ) && ! empty( $image_replace_with ) ) {
			foreach ( $image_replace_with as $type ) {
				if ( ! empty( $medias[ $type ] ) ) {
					return $medias[ $type ];
				}
			}
		}
	}

	/**
	 * Get social sharing links for various platforms.
	 *
	 * @param string $permalink The post permalink to share.
	 * @param string $data Block data.
	 * @return array Array of social platform names and their sharing URLs.
	 */
	public static function social_share_link( $permalink, $data = '' ) {
		$thumbnail_url = $data['post_thumbnail_url'] ?? '';

		$social_sharing_links = array(
			'clone'     => '',
			'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink,
			'twitter'   => 'https://twitter.com/intent/tweet?url=' . $permalink,
			'x'         => 'https://twitter.com/intent/tweet?url=' . $permalink,
			'linkedin'  => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $permalink,
			'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $thumbnail_url,
			'instagram' => 'https://www.instagram.com/?url=' . $permalink,
			'vkontakte' => 'https://vk.com/share.php?url=' . $permalink,
			'digg'      => 'https://digg.com/submit?url=' . $permalink,
			'tumblr'    => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $permalink,
			'reddit'    => 'https://www.reddit.com/submit?url=' . $permalink,
			'whatsapp'  => 'https://api.whatsapp.com/send?text=' . $permalink,
			'pocket'    => 'https://getpocket.com/save?url=' . $permalink,
			'xing'      => 'https://www.xing.com/spi/shares/new?url=' . $permalink,
			'mail'      => 'mailto:?subject=&body=' . $permalink,
		);

		return $social_sharing_links;
	}

	/**
	 * Custom set transient
	 *
	 * @param  mixed $cache_key Key.
	 * @param  mixed $cache_data data.
	 * @param  mixed $expiration Time expiration.
	 * @return void
	 */
	public static function set_transient( $cache_key, $cache_data, $expiration = 0 ) {
		if ( ! is_admin() ) {
			if ( is_multisite() ) {
				set_site_transient( $cache_key, $cache_data, $expiration );
			} else {
				set_transient( $cache_key, $cache_data, $expiration );
			}
		}
	}

	/**
	 * Custom get transient.
	 *
	 * @param  mixed $cache_key Cache key.
	 * @return content
	 */
	public static function get_transient( $cache_key ) {
		if ( is_admin() ) {
			return false;
		}
		if ( is_multisite() ) {
			$cached_data = get_site_transient( $cache_key );
		} else {
			$cached_data = get_transient( $cache_key );
		}
		return $cached_data;
	}

	/**
	 * Trims the string by word limit.
	 *
	 * @param string $content     The content to trim.
	 * @param int    $excerpt_length  Number of words to keep.
	 *
	 * @return string
	 */
	public static function sp_string_trim($content, $excerpt_length = array(
		'value' => 20,
		'unit'  => 'words',
	)) {
		if ( empty( $content ) ) {
			return '';
		}

		$value = isset( $excerpt_length['value'] ) ? (int) $excerpt_length['value'] : 20;
		$unit  = isset( $excerpt_length['unit'] ) ? $excerpt_length['unit'] : 'words';

		$cleaned = wp_strip_all_tags( $content );

		if ( 'characters' === $unit ) {
			$trimmed = mb_substr( trim( $cleaned ), 0, $value );
			return $trimmed . '...';
		}

		$cleaned = preg_replace( '/\s+/', ' ', $cleaned );
		$words   = explode( ' ', trim( $cleaned ) );

		if ( count( $words ) <= $value ) {
			return implode( ' ', $words );
		}

		$trimmed = array_slice( $words, 0, $value );
		return implode( ' ', $trimmed ) . '...';
	}


	/**
	 * Return terms.
	 *
	 * @param object  $taxonomy_type terms list.
	 * @param object  $hide_empty hide option.
	 * @param object  $include_terms .
	 * @param string  $limit .
	 * @param object  $exclude_terms terms name list.
	 * @param boolean $all_taxonomy_term true or false.

	 * @return object.
	 */
	public static function get_custom_terms_by_type( $taxonomy_type, $hide_empty, $include_terms, $limit, $exclude_terms, $all_taxonomy_term ) {
		$args = array(
			'taxonomy'   => $taxonomy_type,
			'hide_empty' => ! $hide_empty,
			'orderby'    => 'name',
			'order'      => 'ASC',
		);

		// Parse include_terms: get array of IDs from object or scalar input.
		if ( is_array( $include_terms ) ) {
			$include_ids = array_map(
				function ( $item ) {
					return is_array( $item ) && isset( $item['value'] ) ? intval( $item['value'] ) : intval( $item );
				},
				$include_terms
			);
			// Remove duplicates while preserving order.
			$include_ids = array_intersect_key( $include_ids, array_unique( $include_ids ) );
		} else {
			$include_ids = array();
		}

		// Parse exclude_terms: get array of IDs from object or scalar input.
		if ( is_array( $exclude_terms ) ) {
			$exclude_ids = array_map(
				function ( $item ) {
					return is_array( $item ) && isset( $item['value'] ) ? intval( $item['value'] ) : intval( $item );
				},
				$exclude_terms
			);
			$exclude_ids = array_unique( $exclude_ids );
		} else {
			$exclude_ids = array();
		}

		// If not using all terms, include only selected terms.
		if ( ! $all_taxonomy_term && ! empty( $include_ids ) ) {
			$args['include'] = $include_ids;
		}

		// ADD THIS CHECK.
		if ( ! $all_taxonomy_term && empty( $include_ids ) ) {
			return array();
		}

		// If using all terms, optionally exclude terms.
		if ( $all_taxonomy_term ) {
			if ( ! empty( $exclude_ids ) ) {
				$args['exclude'] = $exclude_ids;
			}
			if ( ! empty( $limit ) && is_numeric( $limit ) && $limit > 0 ) {
				$args['number'] = intval( $limit );
			}
		}

		// Fetch terms.
		$terms = get_terms( $args );

		// Add thumbnail, color, and link.
		foreach ( $terms as &$term ) {
			if ( is_array( $term ) && isset( $term['term_id'] ) ) {
				$term['category_thumbnail'] = get_term_meta( $term['term_id'], 'category_thumbnail', true );
				$term['category_color']     = get_term_meta( $term['term_id'], 'category_color', true );
				$term['term_link']          = get_term_link( (int) $term['term_id'] );
			} elseif ( is_object( $term ) && isset( $term->term_id ) ) {
				$term->category_thumbnail = get_term_meta( $term->term_id, 'category_thumbnail', true );
				$term->category_color     = get_term_meta( $term->term_id, 'category_color', true );
				$term->term_link          = get_term_link( $term );
			}
		}
		unset( $term );

		// MAINTAIN ORDER OF INCLUDE_TERMS.
		if ( ! $all_taxonomy_term && ! empty( $include_ids ) ) {
			// Create a map of term_id to term object.
			$terms_map = array();
			foreach ( $terms as $term ) {
				if ( is_object( $term ) && isset( $term->term_id ) ) {
					$terms_map[ $term->term_id ] = $term;
				} elseif ( is_array( $term ) && isset( $term['term_id'] ) ) {
					$terms_map[ $term['term_id'] ] = $term;
				}
			}

			// Reorder terms according to include_ids sequence.
			$ordered_terms = array();
			foreach ( $include_ids as $id ) {
				if ( isset( $terms_map[ $id ] ) ) {
					$ordered_terms[] = $terms_map[ $id ];
				}
			}

			// Replace original terms with ordered terms.
			$terms = $ordered_terms;
		}

		return $terms;
	}

	/**
	 * Calculates the estimated reading time for a given content.
	 *
	 * @param string $content      The content to calculate reading time for.
	 * @param int    $per_minutes  Words per minute.
	 * @return int                 Estimated reading time in minutes.
	 */
	public static function get_reading_time( $content, $per_minutes = 30 ) {
		$words = wp_strip_all_tags( $content );

		$total_worlds = str_word_count( $words );
		$per_minutes  = max( 1, (int) $per_minutes );
		$time         = $total_worlds / $per_minutes;
		return ceil( $time );
	}

	/**
	 * Get icon list for icon library.
	 *
	 * @return void
	 */
	public static function set_icon_list() {
		self::$icons_list = require_once SP_PC_PATH . 'blocks/includes/icons/icon-list.php';
	}

	/**
	 * Get icon list for icon library.
	 *
	 * @param string $icon_name The content to calculate reading time for.
	 * @return string
	 */
	public static function get_icon_list( $icon_name = '' ) {
		if ( $icon_name ) {
			return self::$icons_list[ $icon_name ] ?? '';
		} else {
			return self::$icons_list ?? '';
		}
	}

	/**
	 * Get meta data icons function
	 *
	 * @param string $icon_type Icon type.
	 * @return string
	 */
	public static function get_date_meta_icon( $icon_type ) {
		$arrow_icons = array(
			'classic' => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="21"
			height="22"
			viewBox="0 0 21 22"
			fill="none"
			
		>
			<path
			d="M19 11.2432C19 9.87305 18.9993 8.74504 18.9629 7.7998H1.63672C1.6003 8.74504 1.59961 9.87305 1.59961 11.2432V11.7568C1.59961 13.9563 1.60106 15.5319 1.75 16.7295C1.89684 17.9098 2.17562 18.6009 2.63965 19.1025C3.09553 19.5954 3.71094 19.8845 4.77442 20.0391C5.86762 20.1979 7.31031 20.2002 9.34961 20.2002H11.25C13.2893 20.2002 14.732 20.1979 15.8252 20.0391C16.8887 19.8845 17.5041 19.5954 17.96 19.1025C18.424 18.6009 18.7028 17.9098 18.8496 16.7295C18.9985 15.5319 19 13.9563 19 11.7568V11.2432ZM6.30859 15.2002C6.75042 15.2002 7.1084 15.5582 7.1084 16C7.10829 16.4417 6.75036 16.7998 6.30859 16.7998H6.29981C5.85804 16.7998 5.50011 16.4417 5.5 16C5.5 15.5582 5.85798 15.2002 6.29981 15.2002H6.30859ZM10.3047 15.2002C10.7463 15.2004 11.1045 15.5583 11.1045 16C11.1044 16.4416 10.7463 16.7996 10.3047 16.7998H10.2949C9.85334 16.7996 9.49522 16.4416 9.49512 16C9.49512 15.5583 9.85327 15.2004 10.2949 15.2002H10.3047ZM6.30859 11.2002C6.75042 11.2002 7.1084 11.5582 7.1084 12C7.10829 12.4417 6.75036 12.7998 6.30859 12.7998H6.29981C5.85804 12.7998 5.50011 12.4417 5.5 12C5.5 11.5582 5.85798 11.2002 6.29981 11.2002H6.30859ZM10.3047 11.2002C10.7463 11.2004 11.1045 11.5583 11.1045 12C11.1044 12.4416 10.7463 12.7996 10.3047 12.7998H10.2949C9.85334 12.7996 9.49522 12.4416 9.49512 12C9.49512 11.5583 9.85327 11.2004 10.2949 11.2002H10.3047ZM14.2998 11.2002C14.7416 11.2002 15.0996 11.5582 15.0996 12C15.0995 12.4417 14.7416 12.7998 14.2998 12.7998H14.291C13.8493 12.7998 13.4913 12.4417 13.4912 12C13.4912 11.5582 13.8492 11.2002 14.291 11.2002H14.2998ZM9.34961 2.7998C7.50629 2.7998 6.15053 2.8023 5.09961 2.91992V3.2002C5.0994 3.64184 4.7415 4 4.29981 4C3.88882 4 3.55015 3.6899 3.50488 3.29102C3.14877 3.44568 2.87321 3.64407 2.63965 3.89648C2.18489 4.38811 1.90981 5.06247 1.76074 6.2002H18.8389C18.6898 5.06247 18.4147 4.38811 17.96 3.89648C17.7262 3.64388 17.4503 3.44573 17.0938 3.29102C17.0484 3.68984 16.7108 4 16.2998 4C15.8581 4 15.5002 3.64184 15.5 3.2002V2.91992C14.4491 2.8023 13.0933 2.7998 11.25 2.7998H9.34961ZM20.5996 11.7568C20.5996 13.9144 20.6016 15.6074 20.4375 16.9268C20.2713 18.2631 19.9227 19.3376 19.1348 20.1895C18.3386 21.0502 17.3204 21.4382 16.0557 21.6221C14.8207 21.8016 13.2408 21.7998 11.25 21.7998H9.34961C7.35885 21.7998 5.7789 21.8016 4.54395 21.6221C3.27918 21.4382 2.26107 21.0502 1.46484 20.1895C0.676868 19.3376 0.328328 18.2631 0.16211 16.9268C-0.00197196 15.6074 9.91046e-07 13.9144 1.0952e-06 11.7568V11.2432C1.0952e-06 9.08557 -0.00195985 7.39264 0.16211 6.07324C0.328311 4.73683 0.676863 3.66246 1.46484 2.81055C2.02891 2.20075 2.70438 1.82849 3.5 1.59766V0.799805C3.5 0.357977 3.85798 0 4.29981 0C4.74163 0 5.09961 0.357977 5.09961 0.799805V1.31152C6.24288 1.1994 7.64573 1.2002 9.34961 1.2002H11.25C12.9539 1.2002 14.3567 1.1994 15.5 1.31152V0.799805C15.5 0.357977 15.858 0 16.2998 0C16.7416 0 17.0996 0.357977 17.0996 0.799805V1.59766C17.8952 1.82849 18.5707 2.20074 19.1348 2.81055C19.9227 3.66246 20.2713 4.73683 20.4375 6.07324C20.6016 7.39264 20.5996 9.08557 20.5996 11.2432V11.7568Z"
			fill="currentColor"
			/>
		</svg>',
			'minimal' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
		<path d="M6.7998 9.2998C6.7998 9.85209 6.35209 10.2998 5.7998 10.2998C5.24752 10.2998 4.7998 9.85209 4.7998 9.2998C4.7998 8.74752 5.24752 8.2998 5.7998 8.2998C6.35209 8.2998 6.7998 8.74752 6.7998 9.2998Z" fill="currentColor"/>
		<path d="M6.7998 13.2998C6.7998 13.8521 6.35209 14.2998 5.7998 14.2998C5.24752 14.2998 4.7998 13.8521 4.7998 13.2998C4.7998 12.7475 5.24752 12.2998 5.7998 12.2998C6.35209 12.2998 6.7998 12.7475 6.7998 13.2998Z" fill="currentColor"/>
		<path d="M10.7998 9.2998C10.7998 9.85209 10.3521 10.2998 9.7998 10.2998C9.24752 10.2998 8.7998 9.85209 8.7998 9.2998C8.7998 8.74752 9.24752 8.2998 9.7998 8.2998C10.3521 8.2998 10.7998 8.74752 10.7998 9.2998Z" fill="currentColor"/>
		<path d="M10.7998 13.2998C10.7998 13.8521 10.3521 14.2998 9.7998 14.2998C9.24752 14.2998 8.7998 13.8521 8.7998 13.2998C8.7998 12.7475 9.24752 12.2998 9.7998 12.2998C10.3521 12.2998 10.7998 12.7475 10.7998 13.2998Z" fill="currentColor"/>
		<path d="M14.7998 9.2998C14.7998 9.85209 14.3521 10.2998 13.7998 10.2998C13.2475 10.2998 12.7998 9.85209 12.7998 9.2998C12.7998 8.74752 13.2475 8.2998 13.7998 8.2998C14.3521 8.2998 14.7998 8.74752 14.7998 9.2998Z" fill="currentColor"/>
		<path d="M13 3.7998V3.09961H6.59961V3.7998C6.59961 4.24163 6.24163 4.59961 5.7998 4.59961C5.35798 4.59961 5 4.24163 5 3.7998V3.09961H2.7998C2.13706 3.09961 1.59961 3.63706 1.59961 4.2998V16.7998C1.59961 17.4625 2.13706 18 2.7998 18H16.7998C17.4625 18 18 17.4625 18 16.7998V4.2998C18 3.63706 17.4625 3.09961 16.7998 3.09961H14.5996V3.7998C14.5996 4.24163 14.2416 4.59961 13.7998 4.59961C13.358 4.59961 13 4.24163 13 3.7998ZM19.5996 16.7998C19.5996 18.3462 18.3462 19.5996 16.7998 19.5996H2.7998C1.25341 19.5996 0 18.3462 0 16.7998V4.2998C0 2.75341 1.25341 1.5 2.7998 1.5H5V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V1.5H13V0.799805C13 0.357977 13.358 0 13.7998 0C14.2416 0 14.5996 0.357977 14.5996 0.799805V1.5H16.7998C18.3462 1.5 19.5996 2.75341 19.5996 4.2998V16.7998Z" fill="currentColor"/>
		</svg>',
			'flip'    => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="22"
			height="22"
			viewBox="0 0 22 22"
			fill="none"
		
		>
			<path
			d="M6.19981 11.1998C6.19981 11.6969 5.79687 12.0998 5.29981 12.0998C4.80275 12.0998 4.39981 11.6969 4.39981 11.1998C4.39981 10.7027 4.80275 10.2998 5.29981 10.2998C5.79687 10.2998 6.19981 10.7027 6.19981 11.1998Z"
			fill="currentColor"
			/>
			<path
			d="M10.1498 11.1998C10.1498 11.6969 9.74687 12.0998 9.24981 12.0998C8.75275 12.0998 8.34981 11.6969 8.34981 11.1998C8.34981 10.7027 8.75275 10.2998 9.24981 10.2998C9.74687 10.2998 10.1498 10.7027 10.1498 11.1998Z"
			fill="currentColor"
			/>
			<path
			d="M14.0998 11.1998C14.0998 11.6969 13.6969 12.0998 13.1998 12.0998C12.7028 12.0998 12.2998 11.6969 12.2998 11.1998C12.2998 10.7027 12.7028 10.2998 13.1998 10.2998C13.6969 10.2998 14.0998 10.7027 14.0998 11.1998Z"
			fill="currentColor"
			/>
			<path
			d="M6.19991 15.4998C6.19991 15.9969 5.79696 16.3998 5.29991 16.3998C4.80285 16.3998 4.39991 15.9969 4.39991 15.4998C4.39991 15.0027 4.80285 14.5998 5.29991 14.5998C5.79696 14.5998 6.19991 15.0027 6.19991 15.4998Z"
			fill="currentColor"
			/>
			<path
			d="M10.1499 15.4998C10.1499 15.9969 9.74692 16.3998 9.24986 16.3998C8.7528 16.3998 8.34986 15.9969 8.34986 15.4998C8.34986 15.0027 8.7528 14.5998 9.24986 14.5998C9.74692 14.5998 10.1499 15.0027 10.1499 15.4998Z"
			fill="currentColor"
			/>
			<path
			d="M14.0998 15.4998C14.0998 15.9969 13.6969 16.3998 13.1998 16.3998C12.7028 16.3998 12.2998 15.9969 12.2998 15.4998C12.2998 15.0027 12.7028 14.5998 13.1998 14.5998C13.6969 14.5998 14.0998 15.0027 14.0998 15.4998Z"
			fill="currentColor"
			/>
			<path
			d="M4.5 3.7998V0.799805C4.5 0.357977 4.85798 0 5.2998 0C5.74163 0 6.09961 0.357977 6.09961 0.799805V3.7998C6.09961 4.24163 5.74163 4.59961 5.2998 4.59961C4.85798 4.59961 4.5 4.24163 4.5 3.7998ZM12.5 3.7998V0.799805C12.5 0.357977 12.858 0 13.2998 0C13.7416 0 14.0996 0.357977 14.0996 0.799805V3.7998C14.0996 4.24163 13.7416 4.59961 13.2998 4.59961C12.858 4.59961 12.5 4.24163 12.5 3.7998Z"
			fill="currentColor"
			/>
			<path
			d="M17.0039 1.5C18.4338 1.5 19.6344 2.57739 19.7881 3.99902L21.3555 18.499C21.5344 20.1547 20.2376 21.5994 18.5723 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.2998C0 2.75341 1.25341 1.5 2.7998 1.5H17.0039ZM1.59961 18.7998C1.59961 19.421 2.07184 19.9315 2.67676 19.9932L2.7998 20H15.7998C16.4625 20 17 19.4625 17 18.7998V7.59961H1.59961V18.7998ZM18.5996 18.7998C18.5996 19.2298 18.5003 19.6359 18.3271 20H18.5723C19.2859 19.9998 19.8413 19.3804 19.7646 18.6709L18.5996 7.89258V18.7998ZM1.59961 6H17V4.2998C17 3.63706 16.4625 3.09961 15.7998 3.09961H2.7998C2.13706 3.09961 1.59961 3.63706 1.59961 4.2998V6Z"
			fill="currentColor"
			/>
		</svg>',
			'grid'    => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="22"
			height="22"
			viewBox="0 0 22 22"
			fill="none"
			
		>
			<path
			d="M20 4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
			fill="currentColor"
			/>
			<path d="M0.799805 3.4998H20.7998V8.4998H0.799805V3.4998Z" fill="currentColor" />
			<path
			d="M5 4.7998V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998ZM15 4.7998V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998Z"
			fill="currentColor"
			/>
			<path d="M4.7998 10.7998H6.7998V12.7998H4.7998V10.7998Z" fill="currentColor" />
			<path d="M4.7998 15.7998H6.7998V17.7998H4.7998V15.7998Z" fill="currentColor" />
			<path d="M9.7998 10.7998H11.7998V12.7998H9.7998V10.7998Z" fill="currentColor" />
			<path d="M9.7998 15.7998H11.7998V17.7998H9.7998V15.7998Z" fill="currentColor" />
			<path
			d="M14.7998 10.7998H16.7998V12.7998H14.7998V10.7998Z"
			fill="currentColor"
			/>
			<path
			d="M14.7998 15.7998H16.7998V17.7998H14.7998V15.7998Z"
			fill="currentColor"
			/>
		</svg>',
			'outline' => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="22"
			height="22"
			viewBox="0 0 22 22"
			fill="none"
		
		>
			<path
			d="M15 4.7998V3.59961H6.59961V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998V3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H16.5996V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H5V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V2H15V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
			fill="currentColor"
			/>
			<path d="M20.7998 7V8.59961H0.799805V7H20.7998Z" fill="currentColor" />
		</svg>',
			'bold'    => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="22"
			height="22"
			viewBox="0 0 22 22"
			fill="none"    
		>
			<path
			d="M20 4.7998C20 4.13706 19.4625 3.59961 18.7998 3.59961H2.7998C2.13706 3.59961 1.59961 4.13706 1.59961 4.7998V18.7998C1.59961 19.4625 2.13706 20 2.7998 20H18.7998C19.4625 20 20 19.4625 20 18.7998V4.7998ZM21.5996 18.7998C21.5996 20.3462 20.3462 21.5996 18.7998 21.5996H2.7998C1.25341 21.5996 0 20.3462 0 18.7998V4.7998C0 3.25341 1.25341 2 2.7998 2H18.7998C20.3462 2 21.5996 3.25341 21.5996 4.7998V18.7998Z"
			fill="currentColor"
			/>
			<path d="M0.799805 3.4998H20.7998V8.4998H0.799805V3.4998Z" fill="currentColor" />
			<path
			d="M5 4.7998V0.799805C5 0.357977 5.35798 0 5.7998 0C6.24163 0 6.59961 0.357977 6.59961 0.799805V4.7998C6.59961 5.24163 6.24163 5.59961 5.7998 5.59961C5.35798 5.59961 5 5.24163 5 4.7998ZM15 4.7998V0.799805C15 0.357977 15.358 0 15.7998 0C16.2416 0 16.5996 0.357977 16.5996 0.799805V4.7998C16.5996 5.24163 16.2416 5.59961 15.7998 5.59961C15.358 5.59961 15 5.24163 15 4.7998Z"
			fill="currentColor"
			/>
		</svg>',
			'fill'    => '<svg
			xmlns="http://www.w3.org/2000/svg"
			width="21"
			height="21"
			viewBox="0 0 21 21"
			fill="none"
			
		>
			<path
			d="M18.75 2.25H17.25V0.75C17.25 0.551088 17.171 0.360322 17.0303 0.21967C16.8897 0.0790176 16.6989 0 16.5 0C16.3011 0 16.1103 0.0790176 15.9697 0.21967C15.829 0.360322 15.75 0.551088 15.75 0.75V2.25H11.25V0.75C11.25 0.551088 11.171 0.360322 11.0303 0.21967C10.8897 0.0790176 10.6989 0 10.5 0C10.3011 0 10.1103 0.0790176 9.96967 0.21967C9.82902 0.360322 9.75 0.551088 9.75 0.75V2.25H5.25V0.75C5.25 0.551088 5.17098 0.360322 5.03033 0.21967C4.88968 0.0790176 4.69891 0 4.5 0C4.30109 0 4.11032 0.0790176 3.96967 0.21967C3.82902 0.360322 3.75 0.551088 3.75 0.75V2.25H2.25C1.65326 2.25 1.08097 2.48705 0.65901 2.90901C0.237053 3.33097 0 3.90326 0 4.5V6H21V4.5C21 3.90326 20.7629 3.33097 20.341 2.90901C19.919 2.48705 19.3467 2.25 18.75 2.25Z"
			fill="currentColor"
			/>
			<path
			d="M0 18.75C0 19.3467 0.237053 19.919 0.65901 20.341C1.08097 20.7629 1.65326 21 2.25 21H18.75C19.3467 21 19.919 20.7629 20.341 20.341C20.7629 19.919 21 19.3467 21 18.75V7.5H0V18.75ZM15 11.25H16.5C16.6989 11.25 16.8897 11.329 17.0303 11.4697C17.171 11.6103 17.25 11.8011 17.25 12C17.25 12.1989 17.171 12.3897 17.0303 12.5303C16.8897 12.671 16.6989 12.75 16.5 12.75H15C14.8011 12.75 14.6103 12.671 14.4697 12.5303C14.329 12.3897 14.25 12.1989 14.25 12C14.25 11.8011 14.329 11.6103 14.4697 11.4697C14.6103 11.329 14.8011 11.25 15 11.25ZM9.75 11.25H11.25C11.4489 11.25 11.6397 11.329 11.7803 11.4697C11.921 11.6103 12 11.8011 12 12C12 12.1989 11.921 12.3897 11.7803 12.5303C11.6397 12.671 11.4489 12.75 11.25 12.75H9.75C9.55109 12.75 9.36032 12.671 9.21967 12.5303C9.07902 12.3897 9 12.1989 9 12C9 11.8011 9.07902 11.6103 9.21967 11.4697C9.36032 11.329 9.55109 11.25 9.75 11.25ZM9.75 15H11.25C11.4489 15 11.6397 15.079 11.7803 15.2197C11.921 15.3603 12 15.5511 12 15.75C12 15.9489 11.921 16.1397 11.7803 16.2803C11.6397 16.421 11.4489 16.5 11.25 16.5H9.75C9.55109 16.5 9.36032 16.421 9.21967 16.2803C9.07902 16.1397 9 15.9489 9 15.75C9 15.5511 9.07902 15.3603 9.21967 15.2197C9.36032 15.079 9.55109 15 9.75 15ZM4.5 11.25H6C6.19891 11.25 6.38968 11.329 6.53033 11.4697C6.67098 11.6103 6.75 11.8011 6.75 12C6.75 12.1989 6.67098 12.3897 6.53033 12.5303C6.38968 12.671 6.19891 12.75 6 12.75H4.5C4.30109 12.75 4.11032 12.671 3.96967 12.5303C3.82902 12.3897 3.75 12.1989 3.75 12C3.75 11.8011 3.82902 11.6103 3.96967 11.4697C4.11032 11.329 4.30109 11.25 4.5 11.25ZM4.5 15H6C6.19891 15 6.38968 15.079 6.53033 15.2197C6.67098 15.3603 6.75 15.5511 6.75 15.75C6.75 15.9489 6.67098 16.1397 6.53033 16.2803C6.38968 16.421 6.19891 16.5 6 16.5H4.5C4.30109 16.5 4.11032 16.421 3.96967 16.2803C3.82902 16.1397 3.75 15.9489 3.75 15.75C3.75 15.5511 3.82902 15.3603 3.96967 15.2197C4.11032 15.079 4.30109 15 4.5 15Z"
			fill="currentColor"
			/>
		</svg>',
		);

		return $arrow_icons[ $icon_type ] ?? $arrow_icons['default'];
	}

	/**
	 * Is_editor_page function.
	 *
	 * @return boolean
	 */
	public static function is_editor_page() {
		$is_editor_page = is_admin();
		if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$is_editor_page = false;
		}
		// Divi editor check - Visual Builder and AJAX rendering.
		if ( ( isset( $_GET['et_fb'] ) && '1' === $_GET['et_fb'] ) ||
			( isset( $_POST['action'] ) && 'et_fb_ajax_render_shortcode' === $_POST['action'] ) ) {
			$is_editor_page = false;
		}

		return $is_editor_page;
	}

	/**
	 * Is_page_builder_editor function.
	 *
	 * Detects if current page is any page builder editor (Elementor, Divi, Beaver Builder, Oxygen, Bricks, WPBakery).
	 *
	 * @since 3.0.14
	 * @return boolean True if on any page builder editor page, false otherwise.
	 */
	public static function is_page_builder_editor() {
		$is_builder_editor = false;

		// Elementor editor check.
		if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$is_builder_editor = true;
		}

		// Divi editor check - Visual Builder and AJAX rendering.
		if ( ( isset( $_GET['et_fb'] ) && '1' === $_GET['et_fb'] ) ||
			( isset( $_POST['action'] ) && 'et_fb_ajax_render_shortcode' === $_POST['action'] ) ) {
			$is_builder_editor = true;
		}

		// Beaver Builder editor check.
		if ( class_exists( 'FLBuilder' ) && ( isset( $_GET['fl_builder'] ) || isset( $_POST['fl_builder_data'] ) ) ) {
			$is_builder_editor = true;
		}

		// Oxygen editor check.
		if ( class_exists( 'Oxygen_VSB_Dependencies' ) && isset( $_GET['ct_builder'] ) ) {
			$is_builder_editor = true;
		}

		// Bricks editor check.
		if ( class_exists( '\Bricks\Assets' ) && isset( $_GET['bricks'] ) ) {
			$is_builder_editor = true;
		}

		// WPBakery editor check.
		if ( class_exists( 'Vc_Manager' ) && ( isset( $_GET['vc_editable'] ) || isset( $_GET['vcv-editor'] ) ) ) {
			$is_builder_editor = true;
		}

		return $is_builder_editor;
	}

	/**
	 * Get saved template list.
	 *
	 * Retrieves all published Smart Post Templates.
	 *
	 * @since 2.0.0
	 * @return array Template list with placeholder.
	 */
	public static function get_save_template_list() {
		// Default placeholder option.
		$options = array( '0' => esc_html__( 'Select Template', 'post-carousel' ) );

		$query = new \WP_Query(
			array(
				'post_type'      => 'sp_post_template',
				'post_status'    => 'publish',
				'posts_per_page' => 10000,
			)
		);

		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}

			// Sort by ID descending so the latest template appears first.
			krsort( $options );
		}

		// Merge placeholder with templates (placeholder first).
		return $options;
	}
}
