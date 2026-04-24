<?php
/**
 * Smart parent block class for Smart Post Show Blocks.
 *
 * @package Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

use SmartPostShow\Blocks\Block_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pagination block for Smart Post Show.
 *
 * Handles the pagination logic for Smart Post Show blocks.
 */
class Smart_Post_Parent extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'smart-post-parent';
	}

	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  array  $blocks  blocks.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		return $content;
	}
}
