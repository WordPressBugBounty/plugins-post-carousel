<?php
/**
 * Table of Contents block for Smart Post Show.
 *
 * @package    Smart_Post_Show_Pro
 * @subpackage Smart_Post_Show_Pro/blocks/includes
 */

namespace SmartPostShow\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TOC class.
 */
class SPS_Table_Of_Contents {

	/**
	 * Table of content block constructor function
	 */
	public function __construct() {
		add_filter( 'the_content', array( $this, 'add_ids_to_post_headings' ), 9 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_heading_copy_assets' ) );
	}

	/**
	 * Add id to heading fallback function
	 *
	 * @param string $content Post content.
	 * @param string $permalink Post permalink.
	 * @return string $content HTML markup.
	 */
	private function add_ids_to_headings_fallback( $content, $permalink ) {
		$used_ids = array();

		return preg_replace_callback(
			'/<(h[1-6])(.*?)>(.*?)<\/\1>/is',
			function ( $matches ) use ( &$used_ids, $permalink ) {
				$tag   = $matches[1];
				$attrs = $matches[2];
				$text  = wp_strip_all_tags( $matches[3] );

				// Skip if ID already exists.
				if ( preg_match( '/id=["\'].*?["\']/', $attrs ) ) {
					return $matches[0];
				}

				$id = sanitize_title( $text );

				while ( in_array( $id, $used_ids, true ) ) {
					$id .= '-' . wp_rand( 10, 99 );
				}

				$used_ids[] = $id;

				return sprintf(
					'<%1$s%2$s><span id="%3$s"></span>%4$s<a href="#%3$s" class="sps-toc-heading-copy-link" data-url="%5$s#%3$s" title="Copy link to this heading">#</a></%1$s>',
					$tag,
					$attrs,
					esc_attr( $id ),
					$matches[3],
					esc_url( $permalink )
				);
			},
			$content
		);
	}

	/**
	 * Add id to heading function
	 *
	 * @param string $content Post content.
	 * @param string $permalink Post permalink.
	 * @return string $content HTML markup.
	 */
	private function add_ids_to_headings( $content, $permalink ) {
		if ( empty( $content ) ) {
			return $content;
		}

		return $this->add_ids_to_headings_fallback( $content, $permalink );
	}

	/**
	 * Check table of content function
	 *
	 * @param string $content Post content.
	 * @return boolean
	 */
	private function has_toc_block( $content ) {
		return preg_match( '/<!--\s*wp:sp-smart-post-show\/table-of-content/', $content )
		|| strpos( $content, 'sps-toc' ) !== false
		|| preg_match( '/"blockName":"sp-smart-post-show\/table-of-content"/', $content );
	}

	/**
	 * Add_ids_to_post_headings function
	 *
	 * @param string $content Post content.
	 * @return string
	 */
	public function add_ids_to_post_headings( $content ) {
		if ( ! is_singular() || is_admin() || wp_doing_ajax() ) {
			return $content;
		}

		// Check if we're in the main query and it's the final output.
		if ( ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		$permalink = get_permalink();
		if ( is_single() && $this->has_toc_block( $content ) ) {
			$content = $this->add_ids_to_headings( $content, $permalink );
		} elseif ( is_page() && $this->has_toc_block( $content ) ) {
			$content = $this->add_ids_to_headings( $content, $permalink );
		}

		return $content;
	}

	/**
	 * Enqueue_heading_copy_assets function
	 *
	 * @return void
	 */
	public function enqueue_heading_copy_assets() {
		if ( ! is_singular() || is_admin() || wp_doing_ajax() ) {
			return;
		}

		global $post;

		if ( ! apply_filters( 'enable_heading_copy_link', true ) ) {
			return;
		}

		$css = <<<'CSS'
body .sps-toc-heading-copy-link {
	display: inline-block !important;
	margin-left: 8px !important;
	text-decoration: none !important;
	color: #0073aa !important;
	font-weight: normal !important;
	opacity: 0 !important;
	transition: opacity 0.2s ease !important;
	font-size: 0.8em !important;
	border: none !important;
	background: none !important;
	box-shadow: none !important;
	padding: 0 !important;
	cursor: pointer !important;
}

body .sps-toc-heading-copy-link:hover {
	color: #005a87 !important;
	text-decoration: underline !important;
}

h1, h2, h3, h4, h5, h6 {
	position: relative !important;
}
CSS;

		wp_add_inline_style( 'wp-block-library', $css );
	}
}
