<?php
defined( 'ABSPATH' ) || exit;

if ( wp_is_block_theme() ) {
	?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php
		wp_head();
		?>
	</head>
	<body <?php body_class(); ?>>
	<?php
	wp_body_open();
} else {
	get_header();
}
	$content_post = get_post( $sp_page_builder_id );
	$content      = $content_post->post_content;

	echo '<div class="sp-smart-post-page-builder">';

	global $wp_embed;
	$content = $wp_embed->autoembed( $content );
	$content = do_blocks( $content );
	$content = do_shortcode( $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content );
	$content = preg_replace( '/^(?:<br\s*\/?>\s*)+/', '', $content );
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
	echo '</div>';

if ( wp_is_block_theme() ) {
	?>
	</body>
	</html>
	<?php
	wp_head();
	wp_footer();
} else {
	get_footer();
}
