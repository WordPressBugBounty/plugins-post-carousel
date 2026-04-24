<?php
/**
 * Smart list class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Buttons Group Block Class.
 */
class Smart_Lists extends Block_Base {
	/**
	 * Set block properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'smart-lists';
		$this->styles     = array( 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_style', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
	}
}
