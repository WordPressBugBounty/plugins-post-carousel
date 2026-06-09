<?php
/**
 * Abstract base class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SP_Smart_Block_Base' ) ) {

	/**
	 * Abstract Smart Post Block Base Class.
	 */
	abstract class Block_Base {

		/**
		 * Block name.
		 *
		 * @var string
		 */
		protected $block_name;

		/**
		 * Script handles.
		 *
		 * @var array
		 */
		protected $scripts = array();

		/**
		 * Style handles.
		 *
		 * @var array
		 */
		protected $styles = array();

		/**
		 * Check admin/editor page.
		 *
		 * @var boolean
		 */
		protected $is_editor_page = false;

		/**
		 * Editor script handles.
		 *
		 * @var array
		 */
		protected $editor_scripts = array();

		/**
		 * Editor style handles.
		 *
		 * @var array
		 */
		protected $editor_styles = array();
		/**
		 * Block keywords.
		 *
		 * @var array
		 */
		protected $keywords = array( 'Smart post' );

		/**
		 * Block category.
		 *
		 * @var string
		 */
		protected $category = 'sp-smart-post-show';

		/**
		 * Attributes
		 *
		 * @var array
		 */
		protected $attributes = array(); // Add this property to hold block attributes.

		/**
		 * Constructor function.
		 *
		 * @param array $block_attributes Block attributes.
		 */
		public function __construct( $block_attributes = array() ) {
			$this->attributes = $block_attributes;
			$this->init();
		}

		/**
		 * Initialize block.
		 */
		protected function init() {
			$this->set_block_properties();
			$this->register_block();
		}

		/**
		 * Set block-specific properties.
		 *
		 * Must be defined in child classes.
		 */
		abstract protected function set_block_properties();

		/**
		 * Get render callback for the block.
		 *
		 * Can be overridden in child classes.
		 *
		 * @return callable|null
		 */
		protected function get_render_callback() {
			return array( $this, 'render_block' );
		}

		/**
		 * Get cached post query result
		 *
		 * @param  mixed $attributes Array of block attributes.
		 * @param  mixed $unique_id  Unique identifier for the block instance.
		 * @param  mixed $block_id  Block id.
		 * @return data
		 */
		public function get_cached_post_query_result( $attributes, $unique_id = '', $block_id = '' ) {
			$block              = isset( $_GET['block'] ) ? sanitize_text_field( wp_unslash( $_GET['block'] ) ) : '';
			$skip_cache_orderby = array( 'rand', 'most_viewed', 'most_liked', 'comment_count' );
			if ( ( isset( $attributes['orderBy'] ) && in_array( $attributes['orderBy'], $skip_cache_orderby, true ) ) || ( ( ! empty( $block ) && $block == $block_id ) ) ) {
				return \Sp_Smart_Post_Blocks_Query::post_query_frontend( $attributes, $block_id );
			}

			$transient_key = 'sp_smart_post_query_' . $block_id;

			// Track transient key.
			$keys = get_option( 'sp_smart_post_transients', array() );
			if ( ! in_array( $transient_key, $keys, true ) ) {
				$keys[] = $transient_key;
				update_option( 'sp_smart_post_transients', $keys, false );
			}
			$data = Helper::get_transient( $transient_key );
			if ( false === $data ) {
				$data = \Sp_Smart_Post_Blocks_Query::post_query_frontend( $attributes, $block_id );
				Helper::set_transient( $transient_key, $data, DAY_IN_SECONDS );
			}
			return $data;
		}

		/**
		 * Block render logic.
		 *
		 * Should be overridden if the block is dynamic.
		 *
		 * @param array  $attributes Block attributes.
		 * @param string $content Inner block content.
		 * @param string $blocks Inner blocks.
		 * @return string
		 */
		public function render_block( $attributes, $content = '', $blocks = array() ) {
			return $content;
		}

		/**
		 * Register the block with WordPress.
		 */
		protected function register_block() {
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}
			$args = array(
				'editor_script' => $this->editor_scripts,
				'editor_style'  => $this->editor_styles,
				'script'        => is_admin() ? '' : $this->scripts,
				'style'         => $this->styles,
			);
			if ( ! empty( $this->attributes ) ) {
				$args['$schema']    = 'https://schemas.wp.org/trunk/block.json';
				$args['attributes'] = $this->attributes;
				$args['keywords']   = $this->keywords;
				$args['apiVersion'] = 3;
				$args['category']   = $this->category;
				$args['blockName']  = "sp-smart-post-show/{$this->block_name}";
			}
			$render_callback = $this->get_render_callback();
			if ( is_callable( $render_callback ) ) {
				$args['render_callback'] = $render_callback;
			}

			register_block_type( "sp-smart-post-show/{$this->block_name}", $args );
		}
	}
}
