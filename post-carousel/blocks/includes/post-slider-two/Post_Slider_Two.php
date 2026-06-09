<?php
/**
 * Post slider block class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Post Slider Two Block Class.
 */
class Post_Slider_Two extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-slider-two';
		$this->category       = 'sp-smart-post-show-pro-blocks';
		$this->scripts        = array( 'sp_smart_post_blocks_script_js', 'pcp_swiper' );
		$this->styles         = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'pcp_swiper', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Slider', 'Live Filter', 'Pagination', 'Ajax Live Filter' );
	}
	/**
	 * Render block
	 *
	 * @param  array $attributes attributes.
	 * @param  mixed $content content.
	 * @param  array $blocks blocks.
	 * @return string
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}
		return '';
	}
}
