<?php
/**
 * Post list block class for Smart Post Show Blocks.
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
 * Container
 */
class Post_List_Two extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name     = 'post-list-two';
		$this->scripts        = array( 'sp_smart_post_blocks_script_js' );
		$this->styles         = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->editor_scripts = array( 'sp_smart_post_blocks_index_js' );
		$this->editor_styles  = array( 'sp_smart_post_blocks_editor_style' );
		$this->keywords       = array( 'Smart post', 'List', 'Live Filter', 'Pagination', 'Ajax Live Filter' );
	}

	/**
	 * Render the block output on the frontend.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block content.
	 * @param array  $blocks     Inner blocks.
	 * @return string            Rendered HTML.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}
		return '';
	}
}
