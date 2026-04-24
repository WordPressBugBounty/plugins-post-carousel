<?php
/**
 * Pagination class for Smart Post Show Blocks.
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
class Pagination extends Block_Base {
	/**
	 * Set_block_properties
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'pagination';
		$this->styles     = array( 'sp_smart_post_blocks_google_fonts' );
	}
	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  string $blocks  Nested blocks.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		ob_start();
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
			echo Template_Part::pagination_block_html( $attributes );
		return ob_get_clean();
	}
}
