<?php
/**
 * Blocks template parts.
 *
 * @package    Smart_Post_Show
 * @subpackage Smart_Post_Show/blocks/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

namespace SmartPostShow\Blocks;

use SmartPostShow\Blocks\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Post Content render Class.
 */
class Template_Part {
	/**
	 * Preloader
	 *
	 * @param  bool $preloader_enable enable preloader.
	 * @param  url  $preloader_svg svg img url.
	 * @return void
	 */
	public static function preloader_front( $preloader_enable, $preloader_svg ) {
		ob_start();
		if ( $preloader_enable ) { ?>
			<div class="sp-smart-post-preloader sp-d-block">
				<img src="<?php echo esc_url( $preloader_svg ); ?>" alt="smart post preloader" />
			</div>
			<?php
		}
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
	/**
	 * Render "No posts found" message.
	 *
	 * @param string $message The message to display when no posts are found.
	 * @param string $class_name   Optional. Additional CSS classes for the wrapper.
	 *
	 * @return void The HTML output.
	 */
	public static function no_posts_found_text( $message = '', $class_name = '' ) {
		if ( empty( $message ) ) {
			$message = __( 'No posts found.', 'post-carousel' );
		}

		// Merge default and custom classes.
		$wrapper_class = trim( 'sp-smart-post-no-post ' . $class_name );

		ob_start();
		?>
		<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<h4><?php echo esc_html( $message ); ?></h4>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Generates a random color.
	 *
	 * @param string $color_type The type of color to generate.
	 * @return string|false The generated color string or false if type is not matched.
	 */
	public static function random_color( $color_type ) {
		$random_color = false;

		if ( 'multi-solid' === $color_type ) {
			$r = wp_rand( 0, 254 );
			$g = wp_rand( 0, 254 );
			$b = wp_rand( 0, 254 );
			$a = 0.7;

			$random_color = "rgba($r, $g, $b, $a)";
		}

		if ( 'multi-gradient' === $color_type ) {
			$color_list = array(
				'linear-gradient(293deg, rgba(251, 218, 97, .7) -0.37%, rgba(255, 90, 205, .7) 100%)',
				'linear-gradient(90deg,  rgba(203, 173, 109, .7) 0%,  rgba(213, 51, 105,  .7) 100%)',
				'linear-gradient(90deg,  rgba(36, 198, 220, .7)  0%,  rgba(81, 74, 157,  .7) 100%)',
				'linear-gradient(90deg,  rgba(255, 224, 0,  .7)   0%,  rgba(255, 75, 31,  .7) 100%)',
				'linear-gradient(90deg,  rgba(28, 216, 210, .7)  0%,  rgba(147, 237, 199, .7) 100%)',
				'linear-gradient(90deg,  rgba(255, 212, 82, .7)  0%,  rgba(84, 74, 125,  .7) 100%)',
				'linear-gradient(90deg,  rgba(91, 134, 229, .7)  0%,  rgba(54, 209, 220, .7) 100%)',
				'linear-gradient(90deg,  rgba(253, 185, 155, .7) 0%,  rgba(167, 112, 239, .7) 100%)',
			);

			$random_color = $color_list[ array_rand( $color_list ) ];
		}

		return $random_color;
	}

	/**
	 * Renders the featured image HTML for a post.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @param bool  $cat_hide   Optional. Whether to hide the category meta on the image. Default true.
	 * @return void
	 */
	public static function feature_image( $attributes, $data, $cat_hide = true ) {
		$image_gallery_source = $attributes['imageGallerySource'] ?? 'post_gallery';

		$enable_image        = isset( $attributes['imageFeaturedImg'] ) ? $attributes['imageFeaturedImg'] : true;
		$enable_image_srcset = isset( $attributes['imageSrcset'] ) ? $attributes['imageSrcset'] : true;
		$enable_image_lazy   = isset( $attributes['imageLazyLoad'] ) ? $attributes['imageLazyLoad'] : true;

		$orientation  = $attributes['contentOrientation'] ?? 'orientation_one';
		$permalink    = isset( $data['link'] ) ? $data['link'] : '';
		$post_content = isset( $data['content'] ) ? $data['content'] : '';

		$post_thumbnail_url = isset( $data['post_thumbnail_url'] ) ? $data['post_thumbnail_url'] : false;
		$attachment_srcset  = isset( $data['attachment_srcset'] ) ? $data['attachment_srcset'] : false;

		$target = isset( $attributes['generalLinkOpen'] ) ? $attributes['generalLinkOpen'] : '';

		$target_attr = ( 'new-tab' === $target ) ? 'target=_blank' : '';

		$category_position = $attributes['catTabCategoryPosition'] ?? '';

		$thumbnail_image = $data['thumbnail_image'] ?? '';
		$attachment_url  = $data['attachment_url'] ?? '';

		$image_hover_effect = $attributes['imageHoverEffect'] ?? 'normal';

		$color_type                = $attributes['imageOverlayColor'] ?? 'none';
		$image_replace_with        = $attributes['imageReplaceWith'] ?? array();
		$toggle_custom_fallback_bg = $attributes['toggleCustomFallbackBg'] ?? 'img';

		$image_replace_with_image = $attributes['imageReplaceWithImage'] ?? '';
		$image_replace_with_video = $attributes['imageReplaceWithVideo'] ?? '';

		$image_fallback_replace = $attributes['imageFallbackReplace'] ?? 'source';
		$img_fallback_url       = $image_replace_with_image['url'] ?? $image_replace_with_image;

		// Prepare upload directory and placeholder image URL.
		$placeholder_img = SP_PC_URL . 'public/assets/img/placeholder.png';
		$placeholder_img = apply_filters( 'pcp_no_thumb_placeholder', $placeholder_img );

		$image_srcset = $enable_image_srcset && ! empty( $attachment_srcset ) ? 'srcset="' . esc_attr( $attachment_srcset ) . '"' : '';

		$image_lazy     = $enable_image_lazy ? 'loading="lazy"' : '';
		$image_alt_text = 'alt="' . ( ! empty( $data['image_alt'] ) ? esc_attr( $data['image_alt'] ) : esc_attr( $data['title'] ) ) . '"';

		$feature_image = $post_thumbnail_url ? '<img src="' . esc_url( $post_thumbnail_url ) . '" ' . $image_srcset . ' ' . $image_lazy . ' ' . $image_alt_text . ' />' : '';

		// Feature image replace to post content image or video.
		if ( 'source' === $image_fallback_replace && empty( $feature_image ) ) {
			$feature_image = Helper::get_media_from_content( $attributes, $data );
		}

		// Feature image replace to custom image or video.
		if ( 'custom' === $image_fallback_replace && empty( $feature_image ) ) {
			if ( 'img' === $toggle_custom_fallback_bg ) {
				$feature_image = '<img src="' . esc_url( $img_fallback_url ) . '" />';
			}
			if ( 'video' === $toggle_custom_fallback_bg ) {
				$feature_image = '<video controls><source src=' . esc_url( $image_replace_with_video['url'] ) . ' type="video/mp4" /></video>';
			}
		}

		if ( empty( $feature_image ) && $attachment_url ) {
			$feature_image = '<img src="' . esc_url( $attachment_url ) . '" ' . $image_alt_text . ' />';
		}

		$feature_image = ! empty( $feature_image ) ? $feature_image : '<img src="' . $placeholder_img . '" ' . $image_alt_text . ' />';

		preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', $feature_image, $video_feature_image );

		$random_bg_color            = self::random_color( $color_type );
		$show_video_play_icon_class = '';

		// Category hide in feature image area.
		if ( $cat_hide ) {
			$cat_hide = ! in_array( $category_position, array( '', 'beside-other-meta' ), true );

			if ( $cat_hide && ( 'orientation_three' === $orientation || 'orientation_four' === $orientation ) ) {
				$cat_hide = true;
			}
		}

		if ( $enable_image ) {
			ob_start()
			?>
			<div class="sp-smart-post-card-image img-<?php echo esc_attr( $image_hover_effect ); ?> ">
				<a href="<?php echo esc_attr( $permalink ); ?>" <?php echo esc_attr( $target_attr ); ?>>
					<?php
					if ( empty( $image_gallery ) ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
						echo $feature_image;
					}
					?>
				</a>

				<div class="image-overlay overlay-<?php echo esc_attr( $color_type ); ?>" style="background: <?php echo esc_attr( $random_bg_color ); ?>"></div>

				<?php 'orientation_two' === $orientation ? self::date_two( $data ) : null; ?>

				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo $cat_hide ? self::category( $attributes, $data ) : null;
				?>
			</div>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
			echo ob_get_clean();
		}
	}

	/**
	 * Renders the date in the second style.
	 *
	 * @param array $data The post data.
	 * @return void
	 */
	public static function date_two( $data ) {
		$post_date = isset( $data['post_date'] ) ? $data['post_date'] : '';

		ob_start()
		?>
		<div class="sp-smart-post-meta sp-smart-post-date">
			<div class="sp-smart-post-date-orientation-two">
				<span class="sp-smart-post-day">
					<?php echo esc_html( $post_date['day'] ); ?>
				</span>
				<span class="sp-smart-post-month-year">
					<?php echo esc_html( $post_date['month'] ); ?><br>
					<?php echo esc_html( $post_date['year'] ); ?>
				</span>
			</div>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Renders the post title HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @param array $progress   Progress bar.
	 * @return string           The post title HTML.
	 */
	public static function title( $attributes, $data, $progress = false ) {
		$show_title   = isset( $attributes['titleShow'] ) ? $attributes['titleShow'] : true;
		$title_tag    = isset( $attributes['titleHTMLTag'] ) ? $attributes['titleHTMLTag'] : 'h3';
		$title_effect = isset( $attributes['titleEffect'] ) ? $attributes['titleEffect'] : 'none';

		$title_type = isset( $attributes['titleType'] ) ? $attributes['titleType'] : 'limit';

		$title   = isset( $data['title'] ) ? $data['title'] : '';
		$link    = isset( $data['link'] ) ? $data['link'] : '';
		$target  = isset( $attributes['generalLinkOpen'] ) ? $attributes['generalLinkOpen'] : '';
		$layout  = $attributes['layout'] ?? '';
		$post_id = isset( $data['post_id'] ) ? $data['post_id'] : 0;

		$title_icon = in_array( $layout, array( 'sp-smart-post-list-three-layout-two', 'sp-smart-post-list-three-layout-four' ), true ) ? true : false;

		$title_length      = isset( $attributes['titleLength'] ) ? $attributes['titleLength'] : '';
		$title_length_type = isset( $title_length['unit'] ) ? $title_length['unit'] : 'words';
		$title_length_num  = isset( $title_length['value'] ) ? $title_length['value'] : 'words';

		$title_content = $title;

		if ( 'limit' === $title_type ) {
			$title_content = 'chars' === $title_length_type ? substr( $title, 0, $title_length_num ) : implode( ' ', array_slice( explode( ' ', $title ), 0, $title_length_num ) );
		}

		$title_global_typo_class = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';

		$target_attr = ( 'new-tab' === $target ) ? 'target=_blank' : '';
		$thumb_index = ! empty( $attributes['thumbIndex'] ) ? $attributes['thumbIndex'] : null;

		// Title Badges.
		$post_badges_show     = isset( $attributes['postBadgesShow'] ) ? $attributes['postBadgesShow'] : false;
		$post_badges_position = isset( $attributes['postBadgesPosition'] ) ? $attributes['postBadgesPosition'] : 'before-title';
		$badges_global_typo   = isset( $attributes['postBadgesGlobalTypography']['class'] ) ? $attributes['postBadgesGlobalTypography']['class'] : '';
		$badges_list          = isset( $data['badges_list'] ) ? $data['badges_list'] : array();

		// Title Wrapper class.
		$title_wrapper_class = 'sp-smart-post-title-wrapper sp-text-d-none';
		if ( 'none' !== $title_effect ) {
			$title_wrapper_class .= ' sp-title-effect-' . esc_attr( $title_effect );
		}

		if ( ! empty( $title ) && $show_title ) {
			ob_start()
			?>
			<a href="<?php echo esc_attr( $link ); ?>" <?php echo esc_attr( $target_attr ); ?> class="<?php echo esc_attr( $title_wrapper_class ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>">
				<?php if ( $title_icon ) { ?>
					<i class="sp-icon-right-dir sp-smart-post-title-icon"></i>
				<?php } ?>
				<<?php echo esc_html( $title_tag ); ?> class="sp-smart-post-title <?php echo esc_attr( $title_global_typo_class ); ?>">
					<?php if ( $thumb_index ) : ?>
						<span class="sp-thumb-item-page-id"> <?php echo esc_html( $thumb_index ); ?></span>
					<?php endif; ?>
					<span class="sp-smart-post-title-text"><?php echo wp_kses_post( $title_content ); ?></span>
				</<?php echo esc_html( $title_tag ); ?>>
				<?php if ( $progress ) : ?>
					<span class="sp-thumbnail-progress-bar"></span>
				<?php endif; ?>
			</a>


			
			<?php
			return ob_get_clean();
		}
	}

	/**
	 * Renders the post category HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @return string           The post category HTML.
	 */
	public static function category( $attributes, $data ) {
		$show_category = isset( $attributes['catTabCategoryEnable'] ) ? $attributes['catTabCategoryEnable'] : true;
		$category_type = isset( $attributes['catTabCategoryType'] ) ? $attributes['catTabCategoryType'] : 'category';

		$category_list         = isset( $data['category_list'] ) ? $data['category_list'] : '';
		$cat_tab_category_type = isset( $attributes['catTabCategoryType'] ) ? $attributes['catTabCategoryType'] : '';
		$tag_list              = isset( $data['tag_list'] ) ? $data['tag_list'] : '';
		$all_term_list         = isset( $data['all_term_list'] ) ? $data['all_term_list'] : '';

		$social_share_icon_position = isset( $attributes['socialShareIconPosition'] ) ? $attributes['socialShareIconPosition'] : '';

		$social_icon_display_type = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : 'inline-icon';

		$show_social_share = ( 'popup-share' === $social_icon_display_type && ( 'beside-taxonomy' === $social_share_icon_position || 'space-between-taxonomy' === $social_share_icon_position ) ) ? true : false;

		$global_typo_class = isset( $attributes['catTabCategoryGlobalTypography']['class'] ) ? $attributes['catTabCategoryGlobalTypography']['class'] : '';

		$taxonomy_list = array(
			'category' => $category_list,
			'post_tag' => $tag_list,
		);
		if ( '' === $cat_tab_category_type ) {
			$taxonomy_list[ $cat_tab_category_type ] = $all_term_list;
		}

		if ( $show_category ) {
			ob_start()
			?>
			<div class="<?php echo esc_attr( $global_typo_class ); ?> sp-smart-post-category">
				<span class="sp-taxonomy-type-<?php echo esc_attr( $cat_tab_category_type ); ?>">
					<?php echo wp_kses_post( $taxonomy_list[ $cat_tab_category_type ] ); ?>
				</span>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo $show_social_share ? self::social_share( $attributes, $data ) : '';
				?>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	/**
	 * Renders the post category HTML in the second style.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @return string           The post category HTML.
	 */
	public static function category_two( $attributes, $data ) {
		$show_category = isset( $attributes['catTabCategoryEnable'] ) ? $attributes['catTabCategoryEnable'] : true;

		$category_type = isset( $attributes['catTabCategoryType'] ) ? $attributes['catTabCategoryType'] : 'category';

		$category_list = isset( $data['category_list'] ) ? $data['category_list'] : '';
		$tag_list      = isset( $data['tag_list'] ) ? $data['tag_list'] : '';
		$all_term_list = isset( $data['all_term_list'] ) ? $data['all_term_list'] : '';

		$taxonomy_list = array(
			'category' => $category_list,
			'post_tag' => $tag_list,
		);
		if ( '' === $category_type ) {
			$taxonomy_list[ $category_type ] = $all_term_list;
		}

		if ( $show_category ) {
			ob_start()
			?>
			<span class="sp-smart-post-meta sp-metadata-taxonomy">
				<span class="sp-smart-post-meta-icon sp-metadata-taxonomy-icon">
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
					echo Helper::get_svg_icon( 'taxonomy' );
					?>
				</span>
				<span class="sp-smart-post-meta-text">
					<?php echo wp_kses_post( $taxonomy_list[ $category_type ] ); ?>
				</span>
			</span>
			<?php

			return ob_get_clean();
		}
	}


	/**
	 * Renders the post author HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @return string           The post author HTML.
	 */
	public static function author( $attributes, $data ) {
		$author       = isset( $data['author'] ) ? $data['author'] : '';
		$author_url   = isset( $data['author_url'] ) ? $data['author_url'] : '';
		$author_style = isset( $attributes['metaAuthorStyle'] ) ? $attributes['metaAuthorStyle'] : 'name_with_icon';

		$avatar_url = isset( $data['author_avatar_url'] ) ? $data['author_avatar_url'] : '';

		// Author .
		$icon_type = isset( $attributes['metaUserIcon'] ) ? $attributes['metaUserIcon'] : 'outline';

		$user_icon = Helper::get_author_icon( $icon_type );

		ob_start()
		?>
		<span class="sp-smart-post-meta sp-smart-post-author">
			<a href="<?php echo esc_attr( $author_url ); ?>">
				<?php if ( 'name_with_icon' === $author_style ) { ?>
					<span class="sp-smart-post-meta-icon">
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
						echo $user_icon;
						?>
					</span>
				<?php } ?>
				<?php if ( 'show_gravatar' === $author_style || 'name_with_gravatar' === $author_style ) { ?>
						<img src="<?php echo esc_attr( $avatar_url ); ?>" alt="<?php echo esc_attr( $author ); ?>" class="sp-smart-post-meta-icon"/>
				<?php } ?>
				<?php if ( 'show_gravatar' !== $author_style ) { ?>
					<span class="sp-smart-post-meta-text">
						<?php echo esc_html( $author ); ?>
					</span>
				<?php } ?>
			</a>
		</span>
		<?php

		return ob_get_clean();
	}


	/**
	 * Renders the post date HTML.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $data The post data.
	 * @return string The post date HTML.
	 */
	public static function date( $attributes, $data ) {
		$post_date = $data['post_date'] ?? '';

		$date_format = $attributes['metaDateFormat'] ?? 'default';

		$display_date = $post_date['default'] ?? '';

		if ( 'time_ago' === $date_format ) {
			$time         = get_the_date( 'Y-m-d', $data['post_id'] );
			$display_date = Helper::simple_time_ago( $time );
		}

		ob_start()
		?>
		<div class="sp-smart-post-meta sp-smart-post-date">
			<div class="sp-smart-post-meta-icon">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo Helper::get_svg_icon( 'meta-date' );
				?>
			</div>
			<span class="sp-smart-post-meta-text">
				<?php echo esc_html( $display_date ); ?>
			</span>
		</div>
		<?php

		return ob_get_clean();
	}


	/**
	 * Renders the post comment count HTML.
	 *
	 * @param array $data The post data.
	 * @return string The post comment count HTML.
	 */
	public static function comment( $data ) {
		$post_id       = $data['post_id'] ?? 0;
		$comment_count = get_comment_count( $post_id );

		ob_start()
		?>
		<span class="sp-smart-post-meta sp-post-show-comment">
			<span class="sp-smart-post-meta-icon">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo Helper::get_svg_icon( 'comments-count' );
				?>
			</span>
			<span class="sp-smart-post-meta-text">
				<?php echo esc_html( $comment_count['total_comments'] ); ?>
			</span>
		</span>
		<?php
		return ob_get_clean();
	}


	/**
	 * Renders the post view count HTML.
	 *
	 * @param array $data The post data.
	 * @return string The post view count HTML.
	 */
	public static function views( $data ) {
		$post_id    = $data['post_id'] ?? 0;
		$view_count = get_post_meta( $post_id, '_post_views_count', true );

		ob_start()
		?>
		<span class="sp-smart-post-meta sp-smart-post-view">
			<span class="sp-smart-post-meta-icon">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo Helper::get_svg_icon( 'view-count' );
				?>
			</span>
			<span class="sp-smart-post-meta-text">
				<?php echo esc_html( ! empty( $view_count ) ? $view_count : 0 ); ?>
			</span>
		</span>
		<?php
		return ob_get_clean();
	}

	/**
	 * Calculates the estimated reading time for a given content.
	 *
	 * @param string $content      The content to calculate reading time for.
	 * @param int    $per_minutes  Words per minute.
	 * @return int                 Estimated reading time in minutes.
	 */
	public static function get_reading_time( $content, $per_minutes = 30 ) {
		$words = explode( ' ', wp_strip_all_tags( $content ) );

		$total_worlds = count( $words );
		$per_minutes  = max( 1, (int) $per_minutes );
		$time         = $total_worlds / $per_minutes;
		return floor( $time );
	}

	/**
	 * Renders the estimated reading time HTML for a post.
	 *
	 * @param array $data The post data.
	 * @param array $attributes Block attributes.
	 * @return string The estimated reading time HTML.
	 */
	public static function read_time( $data, $attributes ) {

		$excerpt     = isset( $data['excerpt'] ) ? $data['excerpt'] : '';
		$all_content = isset( $data['content'] ) ? $data['content'] : '';
		$per_minutes = isset( $attributes['metaPerMin']['value'] ) ? $attributes['metaPerMin']['value'] : '';

		ob_start()
		?>
		<span class="sp-smart-post-meta sp-smart-post-reading-time">
			<span class="sp-smart-post-meta-icon">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo Helper::get_svg_icon( 'read-time' );
				?>
			</span>
			<span class="sp-smart-post-meta-text">
				<?php echo esc_html( self::get_reading_time( $all_content, $per_minutes ) ); ?> Min Read
			</span>
		</span>
		<?php

		return ob_get_clean();
	}

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	public static $separator = array(
		'normal-space'  => '<span>&nbsp;</span>',
		'full-stop'     => '<span>&#46;</span>',
		'straight-line' => '<span>&#124;</span>',
		'slash'         => '<span>&#47;</span>',
		'back-slash'    => '<span>&#92;</span>',
	);

	/**
	 * Meta Separator Markup function
	 *
	 * @param string $attr meta separator type name.
	 *
	 * @return string html markup.
	 */
	public static function meta_separator( $attr ) {
		if ( empty( $attr ) || 'normal-space' === $attr ) {
			return '';
		}

		ob_start();
		?>
		<span class='sp-smart-post-meta-separator'>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
			echo self::$separator[ $attr ];
			?>
		</span>
		<?php
		return ob_get_clean();
	}

	/**
	 * Renders the post meta data HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @return string           The post meta data HTML.
	 */
	public static function meta_data( $attributes, $data ) {
		$show_meta_data = ! empty( $attributes['enableMetaData'] ) ? $attributes['enableMetaData'] : false;
		$meta_data_attr = isset( $attributes['metaDataAllContentArray'] ) ? $attributes['metaDataAllContentArray'] : array();

		$meta_data_separator = isset( $attributes['metaSeparator'] ) ? $attributes['metaSeparator'] : '';

		$have_meta_item = false;
		foreach ( $meta_data_attr as $item ) {
			if ( $item['show'] ) {
				$have_meta_item = true;
				break;
			}
		}
		if ( ! $show_meta_data || ! $have_meta_item ) {
			return ''; // If metadata has no value to show or metadata show is false.
		}

		$orientation = $attributes['contentOrientation'] ?? 'orientation_one';

		$category_position = $attributes['catTabCategoryPosition'] ?? '';

		$social_share_icon_position = isset( $attributes['socialShareIconPosition'] ) ? $attributes['socialShareIconPosition'] : '';

		$social_icon_display_type = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : 'inline-icon';
		$meta_display_type        = isset( $attributes['metaDisplayType'] ) ? $attributes['metaDisplayType'] : 'inline';

		$show_social_share = ( 'popup-share' === $social_icon_display_type && ( 'beside-meta' === $social_share_icon_position || 'space-between-meta' === $social_share_icon_position ) ) ? true : false;

		$meta_right_array = array( 'comments', 'views', 'likes', 'social-share' );

		$meta_global_typo_class = isset( $attributes['metaGlobalTypography']['class'] ) ? $attributes['metaGlobalTypography']['class'] : '';

		$meat_data = array(
			'author'       => self::author( $attributes, $data ),
			'date'         => 'orientation_two' !== $orientation ? self::date( $attributes, $data ) : null,
			'comments'     => self::comment( $data ),
			'views'        => self::views( $data ),
			// 'likes'        => self::like( $data ),
			'reading-time' => self::read_time( $data, $attributes ),
			'taxonomy'     => 'beside-other-meta' === $category_position ? self::category_two( $attributes, $data ) : null,
		);

		// Social Share popup class.
		$social_enable        = ! empty( $attributes['socialShareEnableSocial'] ) ?? false;
		$social_display_type  = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : '';
		$social_icon_position = isset( $attributes['socialShareIconPosition'] ) ? $attributes['socialShareIconPosition'] : '';

		$social_condition = $social_enable && 'popup-share' === $social_display_type && 'space-between-meta' === $social_icon_position;

		$social_share_classes = $social_condition ? ' sp-space-between' : '';

		ob_start();
		?>
		<div class="sp-meta-data sp-d-flex sp-smart-post-meta-details-<?php echo esc_attr( $meta_display_type ); ?><?php echo esc_attr( $social_share_classes ); ?>">
			<?php if ( 'inline' === $meta_display_type ) : ?>
				<span class="sp-smart-post-details <?php echo esc_attr( $meta_global_typo_class ); ?>">
					<?php
					foreach ( $meta_data_attr as $meta ) {
						if ( $meta['show'] ) {
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
							echo $meat_data[ $meta['value'] ];
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo self::meta_separator( $meta_data_separator );
						}
					}
					?>
				</span>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
				echo ( $show_social_share ) ? self::social_share( $attributes, $data ) : '';
				?>
			<?php endif; ?>
			<?php if ( 'inline' !== $meta_display_type ) : ?>
				<span class="sp-smart-post-details-left">
					<span class="sp-smart-post-details <?php echo esc_attr( $meta_global_typo_class ); ?>">
						<?php
						foreach ( $meta_data_attr as $meta ) {
							if ( $meta['show'] && ! in_array( $meta['value'], $meta_right_array ) ) {
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
								echo $meat_data[ $meta['value'] ];
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo self::meta_separator( $meta_data_separator );
							}
						}
						?>
					</span>
				</span>
				<span class="sp-smart-post-details-right">
					<span class="sp-smart-post-details <?php echo esc_attr( $meta_global_typo_class ); ?>">
						<?php
						foreach ( $meta_data_attr as $meta ) {
							if ( $meta['show'] && in_array( $meta['value'], $meta_right_array, true ) ) {
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
								echo $meat_data[ $meta['value'] ];
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo self::meta_separator( $meta_data_separator );
							}
						}
						?>
					</span>
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
					echo ( $show_social_share ) ? self::social_share( $attributes, $data ) : '';
					?>
				</span>
			<?php endif; ?>
		</div>
		<?php

		return ob_get_clean();
	}

	/**
	 * Outputs the post excerpt HTML.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $data       Post data.
	 * @return string           Excerpt HTML.
	 */
	public static function excerpt( $attributes, $data ) {
		$show_excerpt = isset( $attributes['excerptShow'] ) ? $attributes['excerptShow'] : true;

		$excerpt_type = isset( $attributes['excerptType'] ) ? $attributes['excerptType'] : 'limited';

		$excerpt_ending_points = isset( $attributes['ellipsisPointsEndingExcerpt'] ) ? $attributes['ellipsisPointsEndingExcerpt'] : '';

		$excerpt_ending_points = 'full' !== $excerpt_type ? $excerpt_ending_points : '';

		$excerpt             = isset( $data['excerpt'] )
			? $data['excerpt'] : '';
		$excerpt_length      = isset( $attributes['excerptLength'] )
			? $attributes['excerptLength'] : array();
		$excerpt_length_type = isset( $excerpt_length['unit'] )
			? $excerpt_length['unit'] : '';
		$excerpt_length_num  = isset( $excerpt_length['value'] )
			? $excerpt_length['value'] : '';

		$excerpt_content = 'chars' === $excerpt_length_type ? substr( $excerpt, 0, $excerpt_length_num ) : implode( ' ', array_slice( explode( ' ', $excerpt ), 0, $excerpt_length_num ) );
		$excerpt_display = 'full' === $excerpt_type ? $excerpt : $excerpt_content;

		$excerpt_global_typo_class = isset( $attributes['excerptGlobalTypography']['class'] ) ? $attributes['excerptGlobalTypography']['class'] : '';
		$layout                    = $attributes['layout'] ?? '';

		$excerpt_button = 'sp-smart-post-list-two-layout-seven' === $layout ? self::read_more_button_two( $attributes, $data ) : '';

		if ( ! empty( $excerpt ) && $show_excerpt ) {
			ob_start()
			?>
			<div class="sp-smart-post-excerpt-wrapper">
				<p class="sp-smart-post-excerpt <?php echo esc_attr( $excerpt_global_typo_class ); ?>">
						<?php echo esc_html( $excerpt_display . $excerpt_ending_points ); ?>
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
						echo $excerpt_button;
						?>
				</p>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	/**
	 * Renders the read more button HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string The read more button HTML.
	 */
	public static function read_more_button( $attributes, $data ) {
		$show_read_more_button = isset( $attributes['showReadMoreButton'] ) ? $attributes['showReadMoreButton'] : true;
		$permalink             = isset( $data['link'] ) ? $data['link'] : '';
		$target                = isset( $attributes['generalLinkOpen'] ) ? $attributes['generalLinkOpen'] : '';
		$button_text           = isset( $attributes['readMoreButtonLabel'] ) ? $attributes['readMoreButtonLabel'] : '';
		$button_icon_style     = isset( $attributes['readMoreIconStyle'] ) ? $attributes['readMoreIconStyle'] : '';

		$target_attr = ( 'new-tab' === $target ) ? 'target=_blank' : '';

		$icon_visibility       = isset( $attributes['readMoreIocVisibility'] ) ? $attributes['readMoreIocVisibility'] : '';
		$read_more_button_type = isset( $attributes['readMoreButtonType'] ) ? $attributes['readMoreButtonType'] : '';

		$global_typo_class = isset( $attributes['readMoreButtonGlobalTypography']['class'] ) ? $attributes['readMoreButtonGlobalTypography']['class'] : '';

		$icon_visibility_class = ' sp-read-more-icon-' . $icon_visibility;

		if ( $show_read_more_button ) {
			ob_start()
			?>
			<div class="sp-smart-post-read-more-button">
				<a href="<?php echo esc_attr( $permalink ); ?>"
					class="sp-smart-post-read-more-btn-link type-<?php echo esc_attr( $read_more_button_type ); ?> <?php echo esc_attr( $global_typo_class ); ?>"
					<?php
					echo esc_attr( $target_attr );
					?>
					role="button">
					<?php echo esc_html( $button_text ); ?>
					<i class="sp-icon-<?php echo esc_attr( $button_icon_style . $icon_visibility_class ); ?>"></i>
				</a>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	/**
	 * Renders the read more button HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string The read more button HTML.
	 */
	public static function read_more_button_two( $attributes, $data ) {
		$show_read_more_button = isset( $attributes['showReadMoreButton'] ) ? $attributes['showReadMoreButton'] : true;
		$permalink             = isset( $data['link'] ) ? $data['link'] : '';
		$target                = isset( $attributes['generalLinkOpen'] ) ? $attributes['generalLinkOpen'] : '';
		$button_text           = isset( $attributes['readMoreButtonLabel'] ) ? $attributes['readMoreButtonLabel'] : '';

		$button_icon_style = isset( $attributes['readMoreIconStyle'] ) ? $attributes['readMoreIconStyle'] : '';

		$target_attr = ( 'new-tab' === $target ) ? 'target=_blank' : '';

		if ( $show_read_more_button ) {
			ob_start()
			?>
			<a href="<?php echo esc_attr( $permalink ); ?>" class="sp-smart-post-excerpt-read-more"
				<?php
				echo esc_attr(
					$target_attr
				);
				?>
				role="button">
				<?php echo esc_html( $button_text ); ?>
			</a>
			<?php
			return ob_get_clean();
		}
	}
	/**
	 * Renders the swiper navigation arrows HTML.
	 *
	 * @param  mixed $nav_arrow_visibility_hover Whether the navigation arrow is visible on hover.
	 * @param  mixed $style                     The style of the navigation arrow.
	 * @return void
	 */
	public static function swiper_nav_arrow( $nav_arrow_visibility_hover, $style = 'open' ) {
		ob_start();
		?>
		<div class="sp-smart-post-swiper-nav-arrow <?php echo $nav_arrow_visibility_hover ? ' visible-on-hover' : ''; ?>">
			<span class="sp-smart-post-swiper-nav-arrow-btn btn-prev"><i>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo Helper::get_arrow_icon( $style );
			?>
			</i></span>
			<span class="sp-smart-post-swiper-nav-arrow-btn btn-next"> <i> 
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo Helper::get_arrow_icon( $style );
			?>
			</i></span>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Pagination
	 *
	 * @param  mixed $bullet_style The style of the pagination bullets.
	 * @param  mixed $vertical     Whether the pagination is vertical.
	 * @return void
	 */
	public static function pagination( $bullet_style = 'bullets', $vertical = false ) {
		ob_start();
		?>
		<div class="swiper-pagination sp-smart-post-pagination-<?php echo esc_attr( $bullet_style ); ?>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $vertical ? 'sp-pagination-vertical' : 'sp-pagination-horizontal';
		?>
		sp-mt-10">
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Renders the social sharing links HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data       The post data.
	 * @return void           The social sharing links HTML.
	 */
	public static function social_links( $attributes, $data ) {
		$permalink                = isset( $data['link'] ) ? $data['link'] : '';
		$social_sharing_media     = isset( $attributes['socialSharingMedia'] ) ? $attributes['socialSharingMedia'] : array();
		$social_share_icon_type   = isset( $attributes['socialShareIconType'] ) ? $attributes['socialShareIconType'] : 'original';
		$social_icon_display_type = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : 'inline-icon';

		$social_sharing_links = array(
			'clone'     => '',
			'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink,
			'twitter'   => 'https://twitter.com/intent/tweet?url=' . $permalink,
			'x'         => 'https://twitter.com/intent/tweet?url=' . $permalink,
			'linkedin'  => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $permalink,
			'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $data['post_thumbnail_url'],
			'instagram' => 'https://www.instagram.com/?url=' . $permalink,
			'vkontakte' => 'https://vk.com/share.php?url=' . $permalink,
			'digg'      => 'http://digg.com/submit?url=' . $permalink,
			'tumblr'    => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $permalink,
			'reddit'    => 'https://www.reddit.com/submit?url=' . $permalink,
			'whatsapp'  => 'https://api.whatsapp.com/send?text=' . $permalink,
			'pocket'    => 'https://getpocket.com/save?url=' . $permalink,
			'xing'      => 'https://www.xing.com/spi/shares/new?url=' . $permalink,
			'mail'      => 'mailto:?subject=&body=' . $permalink,
		);
		ob_start();
		?>
		<ul class="sp-smart-post-social-share <?php echo esc_attr( $social_share_icon_type ); ?>-css">
			<?php
			foreach ( $social_sharing_media as $social ) {
				?>
				<li class="sp-smart-post-social-share-icon sp-li-style-none" style="pointer-events: all;">
					<?php
					if ( 'clone' === $social['value'] ) {
						?>
						<span class="sp-copy-url-area">
							<a href="#" title="Copy post URL" class="sp-smart-post-social-share-link sp-smart-post-copy-btn"
								data-url="<?php echo esc_attr( $permalink ); ?>" data-action="copy">
								<i class='sp-icon-clone'></i>
								<div class="sp-post-url-copy-popup sp-d-hidden">
									Copied!
								</div>
							</a>
						</span>
						<?php
					} else {
						?>
						<a href="<?php echo esc_attr( $social_sharing_links[ $social['value'] ] ); ?>" target="_blank"
							rel="noopener noreferrer" class="sp-smart-post-social-share-link"
							title="<?php echo esc_attr( $social['label'] ); ?>" data-action="share">
							<i class="sp-icon-<?php echo esc_attr( $social['value'] ); ?>"></i>
						</a>
						<?php
					}
					?>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}

	/**
	 * Outputs the taxonomy filter HTML for the block.
	 *
	 * @param array $attributes Block attributes.
	 * @return void
	 */
	public static function taxonomy_filter( $attributes ) {
		$unique_id                = $attributes['uniqueId'] ?? '';
		$post_type                = $attributes['postType'] ?? 'post';
		$post_query               = $attributes['postQuery'] ?? '';
		$filter_type              = $attributes['filterType'] ?? 'dropdown';
		$taxonomy_type            = $attributes['taxonomyType'] ?? 'category';
		$select_terms_type        = $attributes['selectTermsType'] ?? 'all';
		$selected_terms           = $attributes['selectedTerms'] ?? array();
		$exclude_terms            = $attributes['excludeTerms'] ?? array();
		$hide_empty_term          = $attributes['hideEmptyTerm'] ?? false;
		$category_label           = $attributes['categoryLabel'] ?? true;
		$override_category_label  = $attributes['overrideCategoryLabel'] ?? '';
		$override_category_text   = $attributes['overrideCategoryText'] ?? '';
		$all_text_label           = $attributes['allTextLabel'] ?? 'All';
		$show_post_counter        = $attributes['showPostCount'] ?? false;
		$search_in_dropdown       = $attributes['searchInDropdown'] ?? false;
		$additional_css_class     = $attributes['additionalCssClass'] ?? '';
		$title_global_typo_class  = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$option_global_typo_class = isset( $attributes['optionGlobalTypography']['class'] ) ? $attributes['optionGlobalTypography']['class'] : '';
		$exclude_terms_ids        = array();
		?>
		<div class="sp-smart-post-taxonomy-filter <?php echo esc_attr( $additional_css_class ); ?>" data-show-count="<?php echo esc_attr( $show_post_counter ); ?>">
			<div id="<?php echo esc_html( $unique_id ); ?>" class="sp-smart-post-live-filter-wrapper">
				<select class='sp-d-hidden' id="filter-<?php echo esc_attr( $taxonomy_type ); ?>" name="tx_<?php echo esc_attr( $taxonomy_type ); ?>">
					<option value=""><?php echo esc_html( $all_text_label ); ?></option>
					<?php
					if ( 'specific' === $select_terms_type && ! empty( $selected_terms ) ) {
						foreach ( $selected_terms as $term ) {
							$term       = get_term( $term['value'], $taxonomy_type );
							$slug       = $term->slug ?? '';
							$post_count = $term->count ?? 0;
							$term_label = $term->name ?? '';
							?>
							<option value="<?php echo esc_attr( $slug ); ?>" data-default-count="<?php echo intval( $post_count ); ?>" data-label="<?php echo esc_html( $term_label ); ?>"><?php echo esc_html( $term_label ); ?>
								<?php echo $show_post_counter ? intval( $post_count ) : ''; ?>
							</option>
							<?php
						}
					} else {
						$taxonomy_terms = get_terms(
							array(
								'taxonomy'   => $taxonomy_type,
								'hide_empty' => $hide_empty_term,
							)
						);
						if ( 'exclude' === $select_terms_type ) {
							$exclude_terms_ids = array_column( $exclude_terms, 'slug' );
						}

						foreach ( $taxonomy_terms as $term ) {
							if ( in_array( $term->slug, $exclude_terms_ids ) ) {
								continue;
							}
							$slug       = $term->slug ?? '';
							$post_count = $term->count ?? 0;
							$term_label = $term->name ?? '';

							?>
							<option value="<?php echo esc_attr( $slug ); ?>" data-default-count="<?php echo intval( $post_count ); ?>" data-label="<?php echo esc_html( $term_label ); ?>">
								<?php echo esc_html( $term_label ); ?> <?php echo $show_post_counter ? intval( $post_count ) : ''; ?>
							</option>
							<?php
						}
					}
					?>
				</select>
				<div class="sp-smart-post-taxonomy-filter sp-smart-post-live-filter" data-show-count="<?php echo esc_attr( $show_post_counter ); ?>">
					<?php if ( $category_label ) : ?>
						<span class="sp-smart-post-live-filter-label <?php echo esc_attr( $title_global_typo_class ); ?>">
							<?php echo esc_html( $override_category_label ? $override_category_label : str_replace( '_', ' ', $taxonomy_type ) ); ?>
						</span>
					<?php endif; ?>
					<?php if ( 'dropdown' === $filter_type ) { ?>
						<button class="sp-smart-post-live-filter-btn <?php echo esc_attr( $option_global_typo_class ); ?>">
							<span><?php echo esc_html( $all_text_label ); ?></span>
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo Helper::get_svg_icon( 'arrow-down' );
							?>
						</button>
					<?php } ?>
					<ul class="sp-smart-post-live-filter-<?php echo esc_html( $filter_type ); ?>">
					</ul>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Renders the HTML for the author filter.
	 *
	 * @param array $attributes The block attributes.
	 * @return void
	 */
	public static function author_filter( $attributes ) {
		$unique_id                  = $attributes['uniqueId'] ?? '';
		$show_author_label          = $attributes['showAuthorLabel'] ?? '';
		$author_label               = $attributes['authorLabel'] ?? '';
		$filter_type                = $attributes['filterType'] ?? '';
		$post_type                  = $attributes['postType'] ?? 'post';
		$taxonomy_type              = $attributes['taxonomyType'] ?? '';
		$search_in_dropdown         = $attributes['searchInDropdown'] ?? '';
		$exclude_author             = $attributes['excludeAuthor'] ?? array();
		$author_type                = $attributes['authorType'] ?? 'All';
		$specific_author            = $attributes['specificAuthor'] ?? array();
		$all_text_label             = $attributes['allTextLabel'] ?? 'All';
		$show_post_count            = $attributes['showPostCount'] ?? false;
		$show_search_field_dropdown = $attributes['showSearchFieldInDropdown'] ?? false;
		$title_global_typo_class    = isset( $attributes['titleGlobalTypography']['class'] ) ? $attributes['titleGlobalTypography']['class'] : '';
		$option_global_typo_class   = isset( $attributes['optionGlobalTypography']['class'] ) ? $attributes['optionGlobalTypography']['class'] : '';
		$additional_css_class       = $attributes['additionalCssClass'] ?? '';
		$exclude_author_ids         = array();
		?>
		<div class="sp-smart-post-taxonomy-filter <?php echo esc_attr( $additional_css_class ); ?>" data-show-count="<?php echo esc_attr( $show_post_count ); ?>">
			<div id="<?php echo esc_html( $unique_id ); ?>" class="sp-smart-post-live-filter-wrapper">
				<select class='sp-d-hidden' id="filter-author" name="sps_author">
					<option value=""><?php echo esc_html( $all_text_label ); ?></option>
					<?php
					if ( 'all' === $author_type || 'exclude' === $author_type ) {
						$authors = get_users(
							array(
								'orderby' => 'display_name',
								'order'   => 'ASC',
							)
						);
						if ( 'exclude' === $author_type ) {
							$exclude_author_ids = array_column( $exclude_author, 'id' );
						}
						foreach ( $authors as $author ) {
							if ( in_array( $author->data->ID, $exclude_author_ids ) ) {
								continue;
							}
							$post_count = count_user_posts( $author->data->ID, $post_type );
							?>
							<option value="<?php echo esc_attr( $author->data->ID ); ?>"
								data-default-count="<?php echo intval( $post_count ); ?>" data-label="<?php echo esc_html( $author->data->display_name ); ?>">
								<?php echo esc_html( $author->data->display_name ); ?>
								(<?php echo intval( $post_count ); ?>)
							</option>
							<?php
						}
					} else {
						foreach ( $specific_author as $author ) {
							$post_count = count_user_posts( $author['id'], $post_type );
							?>
							<option value="<?php echo esc_attr( $author['id'] ); ?>"
								data-default-count="<?php echo intval( $post_count ); ?>" data-label="<?php echo esc_html( $author['label'] ); ?>">
								<?php echo esc_html( $author['label'] ); ?>
								(<?php echo intval( $post_count ); ?>)
							</option>
							<?php
						}
					}
					?>
				</select>

				<div class="sp-smart-post-taxonomy-filter sp-smart-post-live-filter" data-show-count="<?php echo esc_attr( $show_post_count ); ?>">
					<?php if ( $show_author_label ) : ?>
					<span class="sp-smart-post-live-filter-label <?php echo esc_attr( $title_global_typo_class ); ?>">
						<?php echo esc_html( $author_label ); ?>
					</span>
					<?php endif; ?>
					<?php if ( 'dropdown' === $filter_type ) { ?>
						<button class="sp-smart-post-live-filter-btn <?php echo esc_attr( $option_global_typo_class ); ?>">
							<span>All Author</span>
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							echo Helper::get_svg_icon( 'arrow-down' );
							?>
						</button>
					<?php } ?>
					<ul class="sp-smart-post-live-filter-<?php echo esc_html( $filter_type ); ?>">
					</ul>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Live filter html.
	 *
	 * @return void
	 */
	/**
	 * Renders the HTML for the live filter.
	 *
	 * @param array $attributes The block attributes.
	 * @return void
	 */
	public static function live_filter_html( $attributes ) {
		$live_filter_parent = array();
		foreach ( $attributes as $key => $value ) {
			if ( strpos( $key, 'sp-smart-filter-' ) === 0 ) {
				$live_filter_parent[ $key ] = $value;
			}
		}
		$parent_id       = $live_filter_parent['uniqueId'] ?? '';
		$field_alignment = $live_filter_parent['fieldAlignment'] ?? 'full';
		?>
		<div id=<?php echo esc_attr( $parent_id ); ?> class="<?php echo 'full' === $field_alignment ? 'sp-smart-full' : ''; ?>">
			<div class="sp-smart-post-live-filter-parent">
				<?php
				foreach ( $attributes as $key => $attr ) {
					if ( strpos( $key, 'sp-smart-taxonomy-filter-' ) === 0 ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo self::taxonomy_filter( $attr );
					}
					if ( strpos( $key, 'sp-author-filter-' ) === 0 ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo self::author_filter( $attr );
					}
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Pagination HTML function.
	 *
	 * @param  array  $attributes attributes.
	 * @param  array  $query_attr The query attributes.
	 * @param  int    $total_pages The total number of pages.
	 * @param  string $parent_block_id The ID of the parent block.
	 */
	public static function pagination_html( $attributes, $query_attr, $total_pages = 1, $parent_block_id = '' ) {
		$unique_id              = $attributes['uniqueId'] ?? '';
		$pagination_type        = isset( $attributes['paginationType'] ) ? $attributes['paginationType'] : '';
		$infinite_scroll        = isset( $attributes['loadMoreInfiniteScroll'] ) ? $attributes['loadMoreInfiniteScroll'] : '';
		$load_more_btn_label    = isset( $attributes['loadMoreBtnLabel'] ) ? $attributes['loadMoreBtnLabel'] : 'Load More';
		$pagination_shorten     = isset( $attributes['paginationShorten'] ) ? $attributes['paginationShorten'] : false;
		$pagination_style       = isset( $attributes['paginationStyle'] ) ? $attributes['paginationStyle'] : false;
		$navigation_arrow_style = isset( $attributes['navigationArrowStyle'] ) ? $attributes['navigationArrowStyle'] : 'open';
		$pagination_end_message = isset( $attributes['loadMoreEndMessage'] ) ? $attributes['loadMoreEndMessage'] : '';
		$pagination_align       = isset( $attributes['paginationAlign'] ) ? $attributes['paginationAlign'] : 'center';
		$global_typo_class      = isset( $attributes['paginationGlobalTypography']['class'] ) ? $attributes['paginationGlobalTypography']['class'] : '';
		$additional_css_class   = $attributes['additionalCssClass'] ?? '';
		$pages                  = $total_pages;
		$page_current           = 1;
		$big                    = 999999999; // An unlikely integer.
		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>">
			<div class="sp-smart-post-pagination-section sp-justify-<?php echo esc_attr( $pagination_align ); ?> <?php echo esc_attr( $additional_css_class ); ?>" data-pages="<?php echo esc_attr( $pages ); ?>"
				data-current="<?php echo esc_attr( $page_current ); ?>"
				data-paginationtype="<?php echo esc_attr( $pagination_type ); ?>"
				data-endmessage="<?php echo esc_html( $pagination_end_message ); ?>"
				data-paginationstyle="<?php echo esc_attr( $pagination_style ); ?>">
				<?php if ( 'load-more' === $pagination_type ) { ?>
					<div class="sp-smart-post-load-more-button">
						<?php if ( $infinite_scroll ) { ?>
							<div class="sp-smart-post-show-preloading">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo Helper::get_svg_icon( 'preloader' );
								?>
							</div>
						<?php } else { ?>
							<div class="sp-smart-post-show-preloader sp-d-hidden">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo Helper::get_svg_icon( 'preloader' );
								?>
							</div>
							<a href="#" class="<?php echo esc_attr( $global_typo_class ); ?>"> <?php echo esc_html( $load_more_btn_label ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( 'navigation' === $pagination_type ) { ?>
					<div class="sp-smart-post-navigation-buttons">
						<div class="sp-smart-post-grid-nav-arrow sp-d-flex">
							<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center sp-prev <?php echo esc_attr( $global_typo_class ); ?>"><i>
									<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo Helper::get_arrow_icon( $navigation_arrow_style );
									?>
								</i></span>
							<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center sp-next <?php echo esc_attr( $global_typo_class ); ?>"><i>
									<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo Helper::get_arrow_icon( $navigation_arrow_style );
									?>
								</i></span>
						</div>
					</div>
				<?php } ?>
				<?php
				if ( 'pagination' === $pagination_type ) {
					if ( 'prev-next' === $pagination_style ) {
						?>
						<div class="sp-smart-post-navigation-buttons sp-<?php echo esc_attr( $pagination_style ); ?>">
							<div class="sp-smart-post-grid-nav-arrow sp-d-flex">
								<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>"><i
										class="sp-icon-left-open"></i> Prev</span>
								<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>">Next <i
										class="sp-icon-right-open"></i></span>
							</div>
						</div>
						<?php
					} elseif ( 'number-arrow' == $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<a href="#" class="page-numbers prev number-arrow <?php echo $page_current <= 1 ? 'disabled' : ''; ?> <?php echo esc_attr( $global_typo_class ); ?>">
								<i class="sp-icon-left-open"></i>
							</a>
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers <?php echo $page_current == $i ? 'current' : ''; ?>"
									data-page="<?php echo esc_attr( $i ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
							<a href="#" class="page-numbers next number-arrow <?php echo $page_current >= $pages ? 'disabled' : ''; ?>">
								<i class="sp-icon-right-open"></i>
							</a>
						</div>
						<?php
					} elseif ( 'number-prev-next-arrow' == $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<a href="#" class="page-numbers prev <?php echo $page_current <= 1 ? 'disabled' : ''; ?> <?php echo esc_attr( $global_typo_class ); ?>">
								<i class="sp-icon-left-open"></i> Prev
							</a>
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers 
								<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo $page_current == $i ? 'current' : '';
								?>
									"
									data-page="<?php echo esc_attr( $i ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
							<a href="#" class="page-numbers next <?php echo $page_current >= $pages ? 'disabled' : ''; ?>">
								Next <i class="sp-icon-right-open"></i>
							</a>
						</div>
						<?php
					} elseif ( 'number' === $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers <?php echo $page_current == $i ? 'current' : ''; ?>" data-page="<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $global_typo_class ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
						</div>
						<?php
					} else {
						$paged_var    = 'paged_' . $parent_block_id;
						$page_current = ( ! empty( $_GET[ "$paged_var" ] ) ) ? sanitize_text_field( wp_unslash( $_GET[ "$paged_var" ] ) ) : 1;
						$page_links   = paginate_links(
							array(
								'format'    => '?' . $paged_var . '=%#%',
								'current'   => $page_current,
								'total'     => $pages,
								'show_all'  => apply_filters( 'pcp_show_all_normal_pagination', true ),
								'prev_next' => true,
								'end_size'  => 2,
								'mid_size'  => 1,
								'type'      => 'array',
								'prev_text' => '<i class="sp-icon-left-open"></i>Prev',
								'next_text' => 'Next<i class="sp-icon-right-open"></i></span>',
							)
						);
						?>
						<div class="sp-smart-post-pagination-buttons ">
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo implode( $page_links );
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	/**
	 * Pagination HTML function.
	 *
	 * @param  array $attributes attributes.
	 * @param  array $total_pages Total page.
	 * @param  array $parent_block_id Parent block id.
	 */
	public static function pagination_block_html( $attributes, $total_pages = 1, $parent_block_id = '' ) {
		$unique_id              = $attributes['uniqueId'] ?? '';
		$pagination_type        = isset( $attributes['paginationType'] ) ? $attributes['paginationType'] : '';
		$infinite_scroll        = isset( $attributes['loadMoreInfiniteScroll'] ) ? $attributes['loadMoreInfiniteScroll'] : '';
		$load_more_btn_label    = isset( $attributes['loadMoreBtnLabel'] ) ? $attributes['loadMoreBtnLabel'] : 'Load More';
		$pagination_shorten     = isset( $attributes['paginationShorten'] ) ? $attributes['paginationShorten'] : false;
		$pagination_style       = isset( $attributes['paginationStyle'] ) ? $attributes['paginationStyle'] : false;
		$navigation_arrow_style = isset( $attributes['navigationArrowStyle'] ) ? $attributes['navigationArrowStyle'] : 'open';
		$additional_css_class   = $attributes['additionalCssClass'] ?? '';
		$global_typo_class      = isset( $attributes['paginationGlobalTypography']['class'] ) ? $attributes['paginationGlobalTypography']['class'] : '';
		$pages                  = $total_pages;
		$page_current           = 1;
		$big                    = 999999999; // An unlikely integer.
		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>">
			<div class="sp-smart-post-pagination-section <?php echo esc_attr( $additional_css_class ); ?>" data-pages="<?php echo esc_attr( $pages ); ?>"
				data-current="<?php echo esc_attr( $page_current ); ?>"
				data-paginationtype="<?php echo esc_attr( $pagination_type ); ?>"
				data-paginationstyle="<?php echo esc_attr( $pagination_style ); ?>">
				<?php if ( 'load-more' === $pagination_type ) { ?>
					<div class="sp-smart-post-load-more-button">
						<?php if ( $infinite_scroll ) { ?>
							<div class="sp-smart-post-show-preloading">
								<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo Helper::get_svg_icon( 'preloader' );
								?>
							</div>
						<?php } else { ?>
							<a href="#" class="<?php echo esc_attr( $global_typo_class ); ?>">
								<?php echo esc_html( $load_more_btn_label ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( 'navigation' === $pagination_type ) { ?>
					<div class="sp-smart-post-navigation-buttons">
						<div class="sp-smart-post-grid-nav-arrow sp-d-flex">
							<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>"><i
									class="sp-icon-left-<?php echo esc_attr( $navigation_arrow_style ); ?>"></i></span>
							<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>"><i
									class="sp-icon-right-<?php echo esc_attr( $navigation_arrow_style ); ?>"></i></span>
						</div>
					</div>
				<?php } ?>
				<?php
				if ( 'pagination' === $pagination_type ) {
					if ( 'prev-next' === $pagination_style ) {
						?>
						<div class="sp-smart-post-navigation-buttons sp-<?php echo esc_attr( $pagination_style ); ?>">
							<div class="sp-smart-post-grid-nav-arrow sp-d-flex">
								<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>"><i class="sp-icon-left-open"></i> Prev</span>
								<span class="sp-smart-post-grid-nav-arrow-btn sp-d-flex sp-align-i-center sp-justify-center <?php echo esc_attr( $global_typo_class ); ?>">Next <i class="sp-icon-right-open"></i></span>
							</div>
						</div>
						<?php
					} elseif ( 'number-arrow' == $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<a href="#" class="page-numbers prev number-arrow <?php echo $page_current <= 1 ? 'disabled' : ''; ?>">
								<i class="sp-icon-left-open"></i>
							</a>
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers <?php echo $page_current == $i ? 'current' : ''; ?>"
									data-page="<?php echo esc_attr( $i ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
							<a href="#" class="page-numbers next number-arrow <?php echo $page_current >= $pages ? 'disabled' : ''; ?>">
								<i class="sp-icon-right-open"></i>
							</a>
						</div>
						<?php
					} elseif ( 'number-prev-next-arrow' == $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<a href="#" class="page-numbers prev <?php echo $page_current <= 1 ? 'disabled' : ''; ?>">
								<i class="sp-icon-left-open"></i> Prev
							</a>
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers <?php echo $page_current == $i ? 'current' : ''; ?>"
									data-page="<?php echo esc_attr( $i ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
							<a href="#" class="page-numbers next <?php echo $page_current >= $pages ? 'disabled' : ''; ?>">
								Next <i class="sp-icon-right-open"></i>
							</a>
						</div>
						<?php
					} elseif ( 'number' === $pagination_style ) {
						?>
						<div class="sp-smart-post-pagination-buttons">
							<?php for ( $i = 1; $i <= $pages; $i++ ) : ?>
								<a href="#" class="page-numbers <?php echo $page_current == $i ? 'current' : ''; ?>" data-page="<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $global_typo_class ); ?>">
									<?php echo esc_html( $i ); ?>
								</a>
							<?php endfor; ?>
						</div>
						<?php
					} else {
						$paged_var    = 'paged_' . $parent_block_id;
						$page_current = ( ! empty( $_GET[ "$paged_var" ] ) ) ? sanitize_text_field( wp_unslash( $_GET[ "$paged_var" ] ) ) : 1;
						$page_links   = paginate_links(
							array(
								'format'    => '?' . $paged_var . '=%#%',
								'current'   => $page_current,
								'total'     => $pages,
								'show_all'  => apply_filters( 'pcp_show_all_normal_pagination', true ),
								'prev_next' => true,
								'end_size'  => 2,
								'mid_size'  => 1,
								'type'      => 'array',
								'prev_text' => '<i class="sp-icon-left-open"></i>Prev',
								'next_text' => 'Next<i class="sp-icon-right-open"></i></span>',
							)
						);
						?>
						<div class="sp-smart-post-pagination-buttons <?php echo esc_attr( $global_typo_class ); ?>">
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo implode( $page_links );
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Renders the social share HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string|null The social share HTML, or null if not enabled.
	 */
	public static function social_share( $attributes, $data ) {
		$enable_social = isset( $attributes['socialShareEnableSocial'] ) ? $attributes['socialShareEnableSocial'] : false;

		$social_icon_display_type = isset( $attributes['socialIconDisplayType'] ) ? $attributes['socialIconDisplayType'] : 'inline-icon';

		$social_share_display_on_hover = isset( $attributes['socialShareDisplayOnHover'] ) ? $attributes['socialShareDisplayOnHover'] : false;

		$social_share_icon_position = isset( $attributes['socialShareIconPosition'] ) ? $attributes['socialShareIconPosition'] : '';

		$on_hover = $social_share_display_on_hover ? 'on-hover' : '';

		if ( $enable_social ) {
			ob_start();
			if ( 'inline-icon' === $social_icon_display_type ) {
				self::social_links( $attributes, $data );
			}
			return ob_get_clean();
		}
	}
	/**
	 * Renders the star rating HTML for a product.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string The star rating HTML.
	 */
	public static function star_rating( $attributes, $data ) {
		$show_review_count    = isset( $attributes['showReviewCount'] ) ? $attributes['showReviewCount'] : '';
		$review_counter_color = isset( $attributes['reviewCounterColor']['color'] ) ? $attributes['reviewCounterColor']['color'] : '';
		$empty_star_color     = isset( $attributes['emptyStarColor']['color'] ) ? $attributes['emptyStarColor']['color'] : '';
		$star_color           = isset( $attributes['starColor']['color'] ) ? $attributes['starColor']['color'] : '';
		$average_rating       = isset( $data['average_rating'] ) ? $data['average_rating'] : '';
		$star_data            = (int) isset( $data['starRating'] ) ? $data['starRating'] : 0;
		$star_width           = (int) $average_rating / 5 * 100;

		ob_start();
		?>
		<div class="sp-smart-post-product-rating-area">
			<div class="sp-smart-post-product-rating" title="Rated <?php echo esc_attr( $average_rating ); ?> out of 5">
				<div class="sp-smart-post-empty-stars" style="color: <?php echo esc_attr( $empty_star_color ); ?>">
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
				</div>
				<div style="width: <?php echo esc_attr( $star_width ); ?>%; color: <?php echo esc_attr( $star_color ); ?>"
					class="sp-smart-post-filled-stars">
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
					<i class="sp-icon-star"></i>
				</div>
			</div>
			<?php if ( $show_review_count ) : ?>
				<span class="sp-smart-post-product-review-count" style="color: <?php echo esc_attr( $review_counter_color ); ?>"> (
					<?php echo esc_html( $star_data ); ?>)
				</span>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
	/**
	 * Renders the price HTML for a product.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string The price HTML.
	 */
	public static function price( $attributes, $data ) {
		$show_price    = isset( $attributes['showPrice'] ) ? $attributes['showPrice'] : '';
		$product_price = isset( $data['product_price'] ) ? $data['product_price'] : '';

		ob_start();
		if ( $show_price ) :
			?>
			<div class="sp-smart-post-product-price">
				<?php echo wp_kses_post( $product_price ); ?>
			</div>
			<?php
		endif;
		return ob_get_clean();
	}
	/**
	 * Renders the add to cart HTML for a product.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string The add to cart HTML.
	 */
	public static function add_to_cart( $attributes, $data ) {
		$show_add_to_cart = isset( $attributes['showAddToCart'] ) ? $attributes['showAddToCart'] : '';
		$add_to_cart      = isset( $data['add_to_cart'] ) ? $data['add_to_cart'] : '';

		ob_start();
		if ( $show_add_to_cart ) :
			?>
			<div class="sp-smart-post-product-add-to-cart">
				<?php echo wp_kses_post( $add_to_cart ); ?>
			</div>
			<?php
		endif;
		return ob_get_clean();
	}

	/**
	 * Renders the modal lightbox HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $post_query The post query.
	 * @return string|null The modal lightbox HTML, or null if not applicable.
	 */
	public static function modal_lightbox( $attributes, $post_query ) {
		$unique_id        = $attributes['uniqueId'] ?? '';
		$block_name       = $attributes['blockName'] ?? '';
		$open_link_in     = isset( $attributes['generalLinkOpen'] ) ? $attributes['generalLinkOpen'] : '';
		$close_btn_enable = isset( $attributes['popupCloseBtnEnable'] ) ? $attributes['popupCloseBtnEnable'] : true;
		$multi_popup      = 'multi-popup' === $open_link_in ? true : false;

		$image_size = isset( $attributes['popupImageSize'] ) ? $attributes['popupImageSize'] : '';
		// get all necessary attr and data.
		// Show meta data.
		$meta_data_attr = isset( $attributes['metaDataAllContentArray'] ) ? $attributes['metaDataAllContentArray'] : array();
		$flags          = array(
			'author'       => false,
			'date'         => false,
			'comments'     => false,
			'views'        => false,
			'likes'        => false,
			'reading-time' => false,
		);
		foreach ( $meta_data_attr as $item ) {
			if ( isset( $item['value'] ) && array_key_exists( $item['value'], $flags ) ) {
				$flags[ $item['value'] ] = ! empty( $item['show'] ) && 1 == $item['show'];
			}
		}
		// Reading time array.
		$reading_time = json_encode( $attributes['metaPerMin'] );

		// Author.
		$icon_type = isset( $attributes['metaUserIcon'] ) ? $attributes['metaUserIcon'] : 'outline';
		$user_icon = Helper::get_author_icon( $icon_type );

		$modal_popup = array( 'single-popup', 'multi-popup' );

		// Post Badges.
		$post_badges_show     = isset( $attributes['postBadgesShow'] ) ? $attributes['postBadgesShow'] : false;
		$post_badges_position = isset( $attributes['postBadgesPosition'] ) ? $attributes['postBadgesPosition'] : 'before-title';
		$badges_global_typo   = isset( $attributes['postBadgesGlobalTypography']['class'] ) ? $attributes['postBadgesGlobalTypography']['class'] : '';

		if ( ! in_array( $open_link_in, $modal_popup ) ) {
			return null;
		}

		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>-modal"
			class="sp-smart-post-<?php echo esc_attr( $block_name ); ?>-modal sp-smart-post-modal-container">
			<div class="sp-smart-post-modal-content-lightbox sp-smart-post-modal-content">
				<?php if ( $close_btn_enable ) : ?>
					<span class="sp-modal-close-btn cursor"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 98 98" fill="none">
							<path d="M49 0.5625C22.2422 0.5625 0.5625 22.2422 0.5625 49C0.5625 75.7578 22.2422 97.4375 49 97.4375C75.7578 97.4375 97.4375 75.7578 97.4375 49C97.4375 22.2422 75.7578 0.5625 49 0.5625ZM49 88.0625C27.418 88.0625 9.9375 70.582 9.9375 49C9.9375 27.418 27.418 9.9375 49 9.9375C70.582 9.9375 88.0625 27.418 88.0625 49C88.0625 70.582 70.582 88.0625 49 88.0625ZM68.8828 36.8516L56.7344 49L68.8828 61.1484C69.8008 62.0664 69.8008 63.5508 68.8828 64.4688L64.4688 68.8828C63.5508 69.8008 62.0664 69.8008 61.1484 68.8828L49 56.7344L36.8516 68.8828C35.9336 69.8008 34.4492 69.8008 33.5312 68.8828L29.1172 64.4688C28.1992 63.5508 28.1992 62.0664 29.1172 61.1484L41.2656 49L29.1172 36.8516C28.1992 35.9336 28.1992 34.4492 29.1172 33.5312L33.5312 29.1172C34.4492 28.1992 35.9336 28.1992 36.8516 29.1172L49 41.2656L61.1484 29.1172C62.0664 28.1992 63.5508 28.1992 64.4688 29.1172L68.8828 33.5312C69.8008 34.4492 69.8008 35.9336 68.8828 36.8516Z" fill="currentColor" />
						</svg></span>
				<?php endif; ?>
				<div class="sp-smart-post-modal-content-wrapper">
					<div class="sp-smart-post-card-modal sp-smart-post-modal-template">
						<div class="sp-smart-post-card-modal-image sp-d-flex sp-justify-center"
							data-image-size="<?php echo esc_attr( $image_size ); ?>"></div>
						<div class="sp-smart-post-template-one-content">
							<div class="sp-smart-post-card-content-modal">
								<div class="sp-post-modal-title-wrapper">
									<h1 class="sp-post-modal-title"></h1>
								</div>
								<div class="sp-smart-post-modal-meta-data sp-d-flex">
									<?php if ( $flags['author'] ) : ?>
										<!-- Author meta data -->
										<div class="sp-smart-post-meta sp-smart-post-author sp-d-flex sp-align-i-center">
											<div class="sp-smart-post-meta-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo $user_icon;
												?>
											</div>
											<span class="sp-smart-post-meta-text sp-meta-author"></span>
										</div>
									<?php endif; ?>
									<?php if ( $flags['date'] ) : ?>
										<!-- Date meta data -->
										<div class="sp-smart-post-meta sp-align-i-center sp-smart-post-date sp-d-flex">
											<div class="sp-smart-post-meta-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo Helper::get_svg_icon( 'meta-date' );
												?>
											</div>
											<span class="sp-smart-post-meta-text sp-meta-date"></span>
										</div>
									<?php endif; ?>
									<?php if ( $flags['comments'] ) : ?>
										<!-- Comments meta data -->
										<div class="sp-smart-post-meta sp-smart-post-comments sp-d-flex sp-align-i-center">
											<div class="sp-smart-post-meta-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo Helper::get_svg_icon( 'comments-count' );
												?>
											</div>
											<span class="sp-smart-post-meta-text sp-meta-comments"></span>
										</div>
									<?php endif; ?>
									<?php if ( $flags['views'] ) : ?>
										<!-- Views meta data -->
										<div class="sp-smart-post-meta sp-smart-post-views sp-d-flex sp-align-i-center">
											<div class="sp-smart-post-meta-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo Helper::get_svg_icon( 'view-count' );
												?>
											</div>
											<span class="sp-smart-post-meta-text sp-meta-views"></span>
										</div>
									<?php endif; ?>
									<?php if ( $flags['likes'] ) : ?>
										<!-- Likes meta data -->
										<div class="sp-smart-post-meta sp-smart-post-likes sp-d-flex sp-align-i-center">
										</div>
									<?php endif; ?>
									<?php if ( $flags['reading-time'] ) : ?>
										<!-- Reading Time meta data -->
										<div class="sp-smart-post-meta sp-smart-post-reading-time sp-d-flex sp-align-i-center"
											data-read-time="<?php echo esc_attr( $reading_time ); ?>">
											<div class="sp-smart-post-meta-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo Helper::get_svg_icon( 'read-time' );
												?>
											</div>
											<span class="sp-smart-post-meta-text sp-meta-reading-time"></span>
										</div>
									<?php endif; ?>
									<!-- Taxonomy meta data -->
									<div class="sp-smart-post-meta sp-align-i-center sp-smart-post-taxonomy sp-d-flex">
										<span class="sp-smart-post-meta sp-metadata-taxonomy">
											<span class="sp-smart-post-meta-icon sp-metadata-taxonomy-icon">
												<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												echo Helper::get_svg_icon( 'taxonomy' );
												?>
											</span>
											<span class="sp-smart-post-meta-text sp-meta-taxonomy-category">
												category
											</span>
										</span>
									</div>
								</div>
								<div class="sp-post-modal-excerpt"></div>
							</div>
						</div>
					</div>
				</div>
				<?php if ( $multi_popup ) : ?>
				<span class="sp-smart-modal-navigation sp-smart-modal-prev">&#10094;</span>
				<span class="sp-smart-modal-navigation sp-smart-modal-next">&#10095;</span>
				<?php endif; ?>
			</div>
		</div>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
			echo ob_get_clean();
	}

	/**
	 * Renders the preloader HTML.
	 *
	 * @param array $attributes The block attributes.
	 * @param array $data The post data.
	 * @return string|null The preloader HTML, or null if not enabled.
	 */
	public static function preloader( $attributes, $data ) {
		$show_preloader = isset( $attributes['preloaderEnable'] ) ? $attributes['preloaderEnable'] : '';
		if ( ! $show_preloader ) {
			return null;
		}
		$preloader_icon = SP_PC_URL . 'public/assets/img/preloader.svg';
		ob_start();
		?>
		<div class="sp-smart-post-preloader">
			<div class="sp-smart-post-preloader-inner">
				<div class="sp-smart-post-preloader-spinner">
					<div class="sp-smart-post-preloader-spinner-inner">
						<img src="<?php echo esc_attr( $preloader_icon ); ?>" alt="Loading..." />
					</div>
				</div>
			</div>
		</div>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
		echo ob_get_clean();
	}
}
