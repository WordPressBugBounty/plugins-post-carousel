<?php
/**
 * Author filter block class for Smart Post Show Blocks.
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
 * Taxonomy Filter Block Class
 */
class Author_Filter extends Block_Base {
	/**
	 * Set block properties.
	 *
	 * @return void
	 */
	protected function set_block_properties() {
		$this->block_name = 'author-filter';
	}

	/**
	 * Block render function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  string $content  Content to be rendered.
	 * @param  string $blocks  Nested block.
	 * @return   string Rendered HTML content.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		ob_start();
		Template_Part::author_filter( $attributes );
		return ob_get_clean();
	}
}
