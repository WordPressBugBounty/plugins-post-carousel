<?php
/**
 * Post grid class for Smart Post Show Blocks.
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
 * Post Grid Four Block Class.
 */
class Post_Grid_Four extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-grid-four';
		$this->scripts        = array( 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'Grid', 'Live Filter', 'Pagination', ' Ajax Live Filter' );
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
