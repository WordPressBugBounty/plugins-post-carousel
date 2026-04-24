<?php
/**
 * News Ticker block class.
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
 * Class News_Ticker
 *
 * Handles the News Ticker block functionality for Smart Post Show Pro.
 */
class News_Ticker extends Block_Base {



	/**
	 * Set block properties
	 */
	protected function set_block_properties() {
		$this->block_name = 'news-ticker';
		$this->scripts    = array( 'sp_smart_post_news_ticker_script', 'pcp_swiper' );
		$this->styles     = array( 'pcp_swiper', 'sp_smart_post_blocks_css', 'sp_smart_post_blocks_social_icons_style', 'sp_smart_post_blocks_google_fonts' );
		$this->keywords   = array( 'smart post', 'ticker' );
	}

	/**
	 * Render the News Ticker block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block content.
	 * @param array  $blocks     Nested blocks.
	 * @return string            Rendered HTML output.
	 */
	public function render_block( $attributes, $content = '', $blocks = array() ) {
		if ( Helper::is_editor_page() ) {
			return $content;
		}

		$attributes['page_id'] = get_the_ID();
		unset( $attributes['dynamicCss'], $attributes['fontListsEditPage'], $attributes['fontLists'] );
		$align                            = $attributes['align'] ?? '';
		$unique_id                        = $attributes['uniqueId'] ?? '';
		$sp_block_id                      = $attributes['spBlockId'] ?? ''; // Not changeable id.
		$display                          = $attributes['displayStyle'] ?? 'slide';
		$icon_enable                      = $attributes['tickerIconEnabled'] ?? false;
		$heading                          = $attributes['HeadingLabel'] ?? '';
		$icon_source                      = $attributes['tickerIconSource'] ?? 'newsIcon';
		$ticker_speed                     = $attributes['carouselTickerSpeed']['value'] ?? 3000;
		$ticker_auto_play_delay           = $attributes['carouselAutoPlayDelay']['value'] ?? 4000;
		$direction                        = $attributes['carouselDirection'] ?? 'right_to_left';
		$separator                        = $attributes['tickerSeparatorEnable'] ?? false;
		$pause_onhover                    = $attributes['carouselPauseOnHover'] ?? false;
		$auto_play                        = $attributes['carouselAutoPlay'] ?? false;
		$ticker_navigation                = $attributes['tickerNavigation'] ?? false;
		$ticker_divider                   = $attributes['tickerDivider'] ?? false;
		$ticker_pause                     = $attributes['tickerPause'] ?? false;
		$ticker_heading_position          = $attributes['HeadingPosition'] ?? 'left';
		$heading_style                    = $attributes['headingStyle'] ?? 'six';
		$title_length                     = $attributes['titleLength'] ?? array();
		$ticker_heading_icon_color        = $attributes['tickerIconColor'] ?? '#757575';
		$ticker_slide_effect              = $attributes['carouselAnimationEffect'] ?? 'slide';
		$news_ticker_carousel_arrow_color = $attributes['newsTickerCarouselArrowColor'] ?? array();
		$news_carousel_arrow_style        = $attributes['carouselArrowStyle'] ?? '';
		$align_class                      = isset( $align ) ? 'align' . $align : '';
		$query_attr                       = ( ! empty( $attributes['postQuery'] ) && isset( $attributes['postQuery'] ) ) ? (array) json_decode( $attributes['postQuery'] ) : $attributes;

		$ticker_img       = $attributes['tickerImg'] ?? false;
		$slide_to_display = $attributes['newsTickerItemToDisplay'] ?? '';
		$carousel_speed   = $attributes['carouselTickerSpeed'] ?? 2000;

		$carousel_data        = $attributes['carouselData'] ?? '';
		$additional_css_class = $attributes['additionalCssClass'] ?? '';
		$container_classes    = $align_class . ( '' === $additional_css_class ? '' : ' ' . trim( $additional_css_class ) );

		$label_global_typo_class          = isset( $attributes['headingGlobalTypography']['class'] ) ? $attributes['headingGlobalTypography']['class'] : '';
		$ticker_heading_global_typo_class = isset( $attributes['tickerTitleGlobalTypography']['class'] ) ? $attributes['tickerTitleGlobalTypography']['class'] : '';

		$placeholder_img = SP_PC_URL . 'public/assets/img/placeholder.png';
		$placeholder_img = apply_filters( 'pcp_no_thumb_placeholder', $placeholder_img );
		$thumbnail_image = ! empty( $post['post_thumbnail_url'] ) ? $post['post_thumbnail_url'] : $placeholder_img;

		$posts = $this->get_cached_post_query_result( $query_attr, $unique_id, $sp_block_id );
		$posts = $posts[0];
		if ( empty( $posts ) ) {
			return '';
		}

		$typewriter_data = array_map(
			function ( $post ) use ( $attributes, $title_length ) {
				return array(
					'title'    => $this->sp_string_trim(
						$post['title'],
						$title_length
					),
					'url'      => $post['url'] ?? $post['link'],
					'target'   => ! empty( $attributes['tickerOpenNewTab'] ) ? '_blank' : '_self',
					'thumbUrl' => $post['post_thumbnail_url'],
				);
			},
			$posts
		);

		$heading_class_name = 'ticker-heading sp-ticker-heading-' . $heading_style . '-' . $ticker_heading_position;

		$all_posts = $posts;

		if ( 'fade' === $ticker_slide_effect ) {
			$column_with_device = ! empty( $slide_to_display ) ? $slide_to_display['device']['Desktop'] : 1;
			$all_posts          = array_chunk( $posts, $column_with_device );
		}

		ob_start();
		?>
		<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $container_classes ); ?>">
			<div class="sp-smart-post-news-ticker sp-smart-post-block-wrapper sp-smart-post-carousel-<?php echo esc_attr( $display ); ?>">

				<div class="sp-smart-post-swiper sp-relative">
					<div class="<?php echo esc_attr( $heading_class_name ); ?>">
						<span class="ticker-heading-content">
							<?php if ( $icon_enable ) : ?>
								<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo $this->get_icon_html( $icon_source, $ticker_heading_icon_color );
								?>
							<?php endif; ?>

							<span class="ticker-heading-label <?php echo esc_attr( $label_global_typo_class ); ?>">
								<?php echo wp_kses_post( $heading ); ?>
							</span>
						</span>
					</div>

					<?php if ( 'slide' === $display ) : ?>
						<div class="sps-news-ticker-slider slider-class swiper-container swiper"
							data-swiper-options='<?php echo esc_attr( $carousel_data ); ?>' data-loop="true">

							<div class="sps-news-ticker-wrapper swiper-wrapper">
								<?php foreach ( $all_posts as $post ) : ?>
									<div class="sps-news-ticker-vanilla-slide sp-smart-post-card-content sp-slide-<?php echo esc_attr( $ticker_slide_effect ); ?> swiper-slide sp-slide-item">
										<!-- if animation is Fade go through another loop -->
										<?php if ( 'fade' === $ticker_slide_effect ) : ?>
											<?php foreach ( $post as $data ) : ?>
												<?php
													// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													echo $this->render_template_one( $data, $attributes );
												?>
											<?php endforeach; ?>
										<?php endif; ?>

										<!-- if animation is not Fade then render -->
										<?php if ( 'fade' !== $ticker_slide_effect ) : ?>
											<?php
												// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
												echo $this->render_template_one( $post, $attributes );
											?>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

						</div>
						<?php if ( $ticker_navigation ) : ?>
							<div class="sp-smart-post-swiper-nav-arrow">

								<?php if ( $ticker_divider && 'left' === $ticker_heading_position ) : ?>
									<span class="sp-smart-post-swiper-nav-arrow-btn" style="font-size: 30px; z-index: 2;">

										<span class="divider"> | </span>
									</span>
								<?php endif; ?>

								<span class="sp-smart-post-swiper-nav-arrow-btn btn-prev sps-news-ticker-vanilla-prev" style="position: static; margin: 1px;">
									<i>
										<?php
										// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- svg icon.
										echo Helper::get_arrow_icon( $news_carousel_arrow_style );
										?>
									</i>

								</span>


								<?php if ( $ticker_pause ) : ?>
									<span class="sp-smart-post-swiper-nav-arrow-btn btn-pause sps-news-ticker-slide-pause" style="position: static; margin: 1px;">
										<i class="sp-icon-toggle">
											<svg class="pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg">
												<rect x="6.5" y="5" width="3" height="14" fill="<?php echo esc_attr( $news_ticker_carousel_arrow_color['color'] ?? '' ); ?>" />
												<rect x="14.5" y="5" width="3" height="14" fill="<?php echo esc_attr( $news_ticker_carousel_arrow_color['color'] ?? '' ); ?>" />
											</svg>
										</i>
									</span>
								<?php endif; ?>
								<span class="sp-smart-post-swiper-nav-arrow-btn btn-next sps-news-ticker-vanilla-next" style="position: static; margin: 1px;"><i>
										<?php
										// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- svg icon.
										echo Helper::get_arrow_icon( $news_carousel_arrow_style );
										?>
									</i></span>

								<?php if ( $ticker_divider && 'right' === $ticker_heading_position ) : ?>
									<span style="font-size: 30px; z-index: 2;">|</span>
								<?php endif; ?>

							</div>
						<?php endif; ?>


					<?php endif; ?>

					<?php if ( 'typewriter' === $display ) : ?>
						<div class="sp-smart-post-card-content">
							<div class="sp-smart-post-ticker-title <?php echo esc_attr( $ticker_heading_global_typo_class ); ?>">
								<div
									class="sps-news-ticker-typewriter-js"
									data-posts='<?php echo esc_attr( wp_json_encode( $typewriter_data ) ); ?>'>
									<span class="sp-smart-post-ticker-title-img-wrapper  sp-d-flex">
										<?php if ( $ticker_img ) : ?>
											<img src="<?php echo esc_url( $thumbnail_image ); ?>" class="sp-ticker-img sp-img-circle">
										<?php endif; ?>
										<a class="sp-smart-post-ticker-title" href="" target="" rel="noopener noreferrer"></a>
									</span>
								</div>
							</div>
						</div>
					<?php endif; ?>


					<?php if ( 'ticker' === $display ) : ?>
						<div
							class="sp-smart-post-ticker sp-news-ticker"
							data-options='
							<?php
							echo esc_attr(
								wp_json_encode(
									array(
										'speed'        => $ticker_speed ?? 1000,
										'direction'    => $direction ?? 'right_to_left',
										'pauseOnHover' => $pause_onhover ?? false,
									)
								)
							);
							?>
								'>
							<?php foreach ( $posts as $index => $post ) : ?>
								<span class="sp-ticker-item ">
									<?php
									// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- The HTML output is already properly escaped at the time of generation, so additional escaping is not required here.
									echo $this->render_template( $post, $attributes );
									?>
									<?php if ( $separator && $index < ( count( $posts ) ) ) : ?>
										<span class="ticker-separator">|</span>
									<?php endif; ?>
								</span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<script>
						document.addEventListener("DOMContentLoaded", function() {
							const iconWrappers = document.querySelectorAll(".sp-icon-toggle");

							iconWrappers.forEach(function(iconWrapper) {
								let isPaused = true; // initial state for each icon

								iconWrapper.addEventListener("click", function() {
									isPaused = !isPaused;

									iconWrapper.innerHTML = isPaused ?
										`<svg class="pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg">
											<rect x="6.5" y="5" width="3" height="14" fill="<?php echo esc_attr( $news_ticker_carousel_arrow_color['color'] ); ?>" />
											<rect x="14.5" y="5" width="3" height="14" fill="<?php echo esc_attr( $news_ticker_carousel_arrow_color['color'] ); ?>" />
										</svg>` :
										`<svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg">
											<polygon points="6,4 20,12 6,20" fill="<?php echo esc_attr( $news_ticker_carousel_arrow_color['color'] ); ?>" />
										</svg>`;
								});
							});
						});
					</script>
				</div>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Render template function
	 *
	 * @param array $post Taxonomy posts.
	 * @param array $attributes Taxonomy block attributes.
	 * @return string
	 */
	private function render_template( $post, $attributes ) {
		$ticker_img                     = $attributes['tickerImg'] ?? false;
		$ticker_image_position          = $attributes['tickerImagePosition'] ?? 'left';
		$ticker_date                    = $attributes['tickerDate'] ?? false;
		$ticker_title_list_style_enable = $attributes['tickerTitleListStyleEnble'] ?? false;
		$date                           = $this->getDate( $attributes, $post );
		$title_length                   = $attributes['titleLength'] ?? array();
		$placeholder_img                = SP_PC_URL . 'public/assets/img/placeholder.png';
		$placeholder_img                = apply_filters( 'pcp_no_thumb_placeholder', $placeholder_img );
		$image_shape                    = isset( $attributes['tickerImgShape'] ) ? $attributes['tickerImgShape'] : 'square';

		$thumbnail_image = ! empty( $post['post_thumbnail_url'] ) ? $post['post_thumbnail_url'] : $placeholder_img;

		$ticker_heading_global_typo_class = isset( $attributes['tickerTitleGlobalTypography']['class'] ) ? $attributes['tickerTitleGlobalTypography']['class'] : '';
		$date_global_typo_class           = isset( $attributes['tickerDateGlobalTypography']['class'] ) ? $attributes['tickerDateGlobalTypography']['class'] : '';

		ob_start();
		?>
		<div class="sp-smart-post-ticker-title ">

			<?php if ( $ticker_title_list_style_enable ) : ?>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Svg icon.
				echo $this->render_icon( $attributes['tickerListStyle'] ?? 'list4', $attributes['tickerListStyleColor'] ?? '#757575' );
				?>
			<?php endif; ?>

			<div class="sp-smart-post-ticker-title-img-wrapper sp-d-flex<?php echo $ticker_img ? ' sp-img-' . esc_attr( $ticker_image_position ) : ''; ?>">

				<?php if ( $ticker_img ) : ?>
					<img
						src="<?php echo esc_url( $thumbnail_image ); ?>"
						alt="<?php echo esc_attr( $post['author'] ?? 'thumbnail image' ); ?>"
						class="sp-ticker-img sp-img-<?php echo esc_attr( $image_shape ); ?>"
						loading="lazy" />
				<?php endif; ?>

				<a
					class="sp-smart-post-ticker-title <?php echo esc_attr( $ticker_heading_global_typo_class ); ?>"
					href="<?php echo esc_url( $post['url'] ?? $post['link'] ); ?>"
					<?php echo ! empty( $attributes['tickerOpenNewTab'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
					<span>
						<?php
						echo wp_kses_post(
							$this->sp_string_trim(
								$post['title'],
								$title_length
							)
						);
						?>
					</span>
				</a>
			</div>

			<?php if ( $ticker_date ) : ?>
				<span class="ticker-date <?php echo esc_attr( $date_global_typo_class ); ?>"><?php echo esc_html( $date ); ?></span>
			<?php endif; ?>
		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Taxonomy render template one function
	 *
	 * @param array $post Post data.
	 * @param array $attributes Block attributes.
	 * @return string
	 */
	private function render_template_one( $post, $attributes ) {
		$ticker_date                    = $attributes['tickerDate'] ?? false;
		$date                           = $this->getDate( $attributes, $post );
		$ticker_img                     = $attributes['tickerImg'] ?? false;
		$ticker_image_position          = $attributes['tickerImagePosition'] ?? 'left';
		$ticker_title_list_style_enable = $attributes['tickerTitleListStyleEnble'] ?? false;
		$title_length                   = $attributes['titleLength'] ?? array();
		$placeholder_img                = SP_PC_URL . 'public/assets/img/placeholder.png';
		$placeholder_img                = apply_filters( 'pcp_no_thumb_placeholder', $placeholder_img );
		$image_shape                    = isset( $attributes['tickerImgShape'] ) ? $attributes['tickerImgShape'] : 'square';

		$ticker_heading_global_typo_class = isset( $attributes['tickerTitleGlobalTypography']['class'] ) ? $attributes['tickerTitleGlobalTypography']['class'] : '';
		$date_global_typo_class           = isset( $attributes['tickerDateGlobalTypography']['class'] ) ? $attributes['tickerDateGlobalTypography']['class'] : '';

		ob_start();
		?>
		<div class="sp-template-one sp-smart-post-ticker-title">
			<?php if ( $ticker_title_list_style_enable ) : ?>
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $this->render_icon( $attributes['tickerListStyle'] ?? 'list4', $attributes['tickerListStyleColor'] ?? '#757575' );
				?>
			<?php endif; ?>

			<?php
			$thumbnail_url = ! empty( $post['post_thumbnail_url'] )
				? $post['post_thumbnail_url']
				: $placeholder_img;
			?>

			<div class="sp-smart-post-ticker-title-img-wrapper sp-d-flex<?php echo $ticker_img ? ' sp-img-' . esc_attr( $ticker_image_position ) : ''; ?>">

				<?php if ( $ticker_img ) : ?>
					<img
						src="<?php echo esc_url( $thumbnail_url ); ?>"
						alt="<?php echo esc_attr( $post['author'] ?? 'thumbnail image' ); ?>"
						class="sp-ticker-img sp-img-<?php echo esc_attr( $image_shape ); ?>"
						loading="lazy" />
				<?php endif; ?>

				<a
					class="sp-smart-post-ticker-title <?php echo esc_attr( $ticker_heading_global_typo_class ); ?>"
					href="<?php echo esc_url( $post['url'] ?? $post['link'] ); ?>"
					<?php echo ! empty( $attributes['tickerOpenNewTab'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
					<span>
						<?php
						echo wp_kses_post(
							$this->sp_string_trim(
								$post['title'],
								$title_length
							)
						);
						?>
					</span>
				</a>
			</div>

			<?php if ( $ticker_date ) : ?>
				<span class="ticker-date <?php echo esc_attr( $date_global_typo_class ); ?>"><?php echo esc_html( $date ); ?></span>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Render icon function
	 *
	 * @param string $style Icon style.
	 * @param string $color Icon color.
	 * @return string
	 */
	private function render_icon( $style = '', $color = '#757575' ) {
		ob_start();

		switch ( $style ) {
			case 'list1':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M19.6 11.8C19.6 16.1079 16.1079 19.6 11.8 19.6C7.49211 19.6 4 16.1079 4 11.8C4 7.49211 7.49211 4 11.8 4C16.1079 4 19.6 7.49211 19.6 11.8Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list2':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M19.8002 5.40001V18.6C19.8002 19.2628 19.263 19.8 18.6002 19.8H5.4002C4.73739 19.8 4.2002 19.2628 4.2002 18.6V5.40001C4.2002 4.7372 4.73739 4.20001 5.4002 4.20001H18.6002C19.263 4.20001 19.8002 4.7372 19.8002 5.40001Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list3':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M13.4887 3.07487L14.8799 7.35743C15.089 8.00243 15.6909 8.43931 16.3687 8.43931H20.8716C22.3875 8.43931 23.0184 10.3799 21.7922 11.2706L18.149 13.9171C17.6005 14.3155 17.3709 15.0224 17.5809 15.6674L18.9721 19.9499C19.4409 21.3918 17.7899 22.5909 16.5637 21.7003L12.9205 19.0538C12.3721 18.6553 11.6286 18.6553 11.0802 19.0538L7.43699 21.7003C6.21074 22.5918 4.55987 21.3928 5.02859 19.9499L6.41985 15.6674C6.62891 15.0224 6.40016 14.3155 5.85172 13.9171L2.20756 11.2706C0.981304 10.379 1.6113 8.43931 3.12818 8.43931H7.63106C8.30886 8.43931 8.9098 8.00243 9.1198 7.35743L10.5111 3.07487C10.9798 1.633 13.02 1.633 13.4887 3.07487Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list4':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M4 22L21 12L4 2V22Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list5':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M21 12L4 2L7.6262 12L4 22L21 12Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list6':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M10.0798 5.52002C8.55448 5.52002 7.51012 6.41628 6.71236 7.21502C6.23517 7.68657 5.81798 8.17034 5.27985 8.49753V7.92004C5.27985 7.66879 5.0511 7.44004 4.79985 7.44004H1.15473C0.918479 7.46254 0.718794 7.68285 0.71973 7.92004V16.56C0.71973 16.8113 0.948479 17.04 1.19973 17.04H4.79973C4.96473 17.04 5.12692 16.9491 5.21224 16.8075C6.27443 17.9822 7.71352 18.4801 9.11968 18.4801H12.9597C13.8822 18.4801 14.6397 17.7226 14.6397 16.8001C14.6397 16.5366 14.5619 16.2947 14.4522 16.0726C15.3494 16.0435 16.0797 15.3038 16.0797 14.4001C16.0797 14.1366 16.0019 13.8947 15.8922 13.6726C16.2672 13.6669 16.6656 13.6004 16.9947 13.3276C17.5197 12.9572 17.5197 11.7572 17.0697 11.2801H21.1197C22.3169 11.2707 23.2619 10.4588 23.2797 9.36008C23.2197 8.0954 22.1997 7.4504 21.1197 7.44008H15.7946C15.7421 6.94882 15.5658 6.47634 15.2021 6.13508C14.7774 5.73663 14.1624 5.52008 13.4395 5.52008L10.0798 5.52002ZM1.6798 8.40002H4.3198V16.08H1.6798V8.40002Z"
						fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'list7':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M7.97877 7.31067L9.7619 13.9659C9.86878 14.3662 9.63159 14.7768 9.23222 14.8837L5.46062 15.8943C4.75562 16.0837 4.00468 15.9843 3.37375 15.6196C2.74188 15.2559 2.28062 14.6549 2.09313 13.9499L1.345 11.159C1.15563 10.4549 1.255 9.70397 1.61875 9.07304C1.98343 8.44117 2.58436 7.97991 3.28843 7.79149L7.06003 6.78181C7.46035 6.67399 7.8719 6.91212 7.97877 7.31149V7.31067Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M8.8317 14.3252L9.4617 19.562C9.5667 20.4263 9.01825 21.2363 8.17732 21.4613L7.75264 21.5757C7.26232 21.7079 6.73919 21.6198 6.31919 21.3357C5.89825 21.0507 5.62264 20.5988 5.56074 20.0945L4.96449 15.1416C4.91949 14.7703 5.1548 14.4235 5.51481 14.3278L7.89136 13.6913C8.10136 13.635 8.32542 13.6725 8.50542 13.7944C8.68542 13.9163 8.80449 14.1103 8.83074 14.326L8.8317 14.3252Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M15.0747 3.37227L17.8769 13.8291C17.936 14.0522 17.89 14.2903 17.7513 14.475C17.6125 14.6588 17.396 14.7694 17.1653 14.7731L9.05047 14.91C8.7064 14.9147 8.40266 14.686 8.3136 14.3541L6.53047 7.69888C6.44141 7.367 6.59047 7.01543 6.89047 6.84856L13.9863 2.9092C14.1879 2.79763 14.4307 2.78451 14.6435 2.87545C14.8563 2.96545 15.0157 3.14826 15.0757 3.37138L15.0747 3.37227Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M13.5041 3.3094C13.3973 2.90908 13.6345 2.49846 14.0338 2.39159C14.4341 2.28472 14.8457 2.52191 14.9526 2.92127L17.9967 14.28C18.1036 14.6803 17.8655 15.0909 17.4661 15.1987C17.0658 15.3056 16.6552 15.0675 16.5483 14.6681L13.5041 3.3094Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M20.2866 8.35226C19.8862 8.46007 19.4747 8.22288 19.3678 7.82351C19.26 7.42319 19.4972 7.01164 19.8966 6.90477L21.7969 6.3929C22.1972 6.28508 22.6087 6.52227 22.7166 6.92164C22.8234 7.32196 22.5862 7.73351 22.1869 7.84038L20.2866 8.35226Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M19.0841 12.1406C18.725 11.9335 18.6013 11.475 18.8084 11.1169C19.0147 10.7578 19.4731 10.6341 19.8322 10.8413L21.5384 11.8228C21.8975 12.0291 22.0203 12.4875 21.8141 12.8466C21.6069 13.2056 21.1485 13.3285 20.7894 13.1222L19.0841 12.1406Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M18.5722 5.1629C18.366 5.52196 17.9076 5.64477 17.5485 5.43852C17.1894 5.23133 17.0666 4.7729 17.2729 4.41384L18.2544 2.70852C18.4616 2.34945 18.92 2.22571 19.2791 2.4329C19.6372 2.63915 19.761 3.09758 19.5538 3.45664L18.5722 5.1629Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;
		}

		return ob_get_clean();
	}

	/**
	 * Custom date format function
	 *
	 * @param string $date_string Date.
	 * @param string $type Format type.
	 * @return string
	 */
	private function format_date_custom( $date_string, $type = 'date' ) {
		$timestamp = strtotime( $date_string );

		if ( ! $timestamp ) {
			return '';
		}

		if ( 'daysAgo' === $type ) {
			$now       = time();
			$diff_sec  = $now - $timestamp;
			$diff_days = floor( $diff_sec / ( 60 * 60 * 24 ) );

			if ( 0 === $diff_days ) {
				return 'Today';
			}
			if ( 1 === $diff_days ) {
				return '1 day ago';
			}
			return $diff_days . ' days ago';
		}

		// Default: formatted like "Jun 19, 2025".
		return wp_date( 'M j, Y', $timestamp );
	}

	/**
	 * Human readable time ago function
	 *
	 * @param string $date Post date.
	 * @return string
	 */
	private function human_readable_time_ago( $date ) {
		$timestamp = is_numeric( $date ) ? (int) $date : strtotime( $date );
		if ( ! $timestamp ) {
			return '';
		}

		$now          = time();
		$seconds_diff = $now - $timestamp;

		if ( $seconds_diff < 60 ) {
			return $seconds_diff . ' second' . ( 1 !== $seconds_diff ? 's' : '' ) . ' ago';
		}
		if ( $seconds_diff < 3600 ) {
			$minutes = floor( $seconds_diff / 60 );
			return $minutes . ' minute' . ( 1 !== $minutes ? 's' : '' ) . ' ago';
		}
		if ( $seconds_diff < 86400 ) {
			$hours = floor( $seconds_diff / 3600 );
			return $hours . ' hour' . ( 1 !== $hours ? 's' : '' ) . ' ago';
		}
		if ( $seconds_diff < 604800 ) {
			$days = floor( $seconds_diff / 86400 );
			return $days . ' day' . ( 1 !== $days ? 's' : '' ) . ' ago';
		}
		if ( $seconds_diff < 2592000 ) {
			$weeks = floor( $seconds_diff / 604800 );
			return $weeks . ' week' . ( 1 !== $weeks ? 's' : '' ) . ' ago';
		}
		if ( $seconds_diff < 31536000 ) {
			$months = floor( $seconds_diff / 2592000 );
			return $months . ' month' . ( 1 !== $months ? 's' : '' ) . ' ago';
		}

		$years = floor( $seconds_diff / 31536000 );
		return $years . ' year' . ( 1 !== $years ? 's' : '' ) . ' ago';
	}

	/**
	 * Icon render function
	 *
	 * @param string $style Icon style.
	 * @param string $color Icon color.
	 * @return string
	 */
	private function get_icon_html( $style = '', $color = '#757575' ) {
		ob_start();

		switch ( $style ) {
			case 'newsIcon':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M17.9605 7.10498H10.1752C9.79684 7.10498 9.49023 7.41158 9.49023 7.7899V11.3515C9.49023 11.7299 9.79684 12.0365 10.1752 12.0365H17.9605C18.3391 12.0365 18.6455 11.7299 18.6455 11.3515V7.7899C18.6455 7.41162 18.3389 7.10498 17.9605 7.10498ZM17.2756 10.6666H10.8601V8.47482H17.2756V10.6666Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path d="M21.3151 4H6.79453C6.41621 4 6.10961 4.3066 6.10961 4.68492V7.4018H2.68492C2.3066 7.4018 2 7.70844 2 8.08676V17.927C2 19.4377 3.22898 20.6667 4.73973 20.6667H18.7352C20.5354 20.6667 22 19.2021 22 17.4018V4.68492C22 4.3066 21.6934 4 21.3151 4ZM6.10961 17.9269C6.10961 18.695 5.50777 19.2968 4.73973 19.2968C3.97168 19.2968 3.36988 18.695 3.36988 17.9269V8.77168H6.10961V17.9269ZM20.6302 17.4018C20.6302 18.4466 19.7799 19.2968 18.7352 19.2968H7.11188C7.34566 18.8936 7.47945 18.4253 7.47945 17.9269V5.36984H20.6302V17.4018Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path d="M17.9605 13.3835H10.1752C9.79684 13.3835 9.49023 13.6901 9.49023 14.0685C9.49023 14.4468 9.79684 14.7534 10.1752 14.7534H17.9605C18.3391 14.7534 18.6455 14.4468 18.6455 14.0685C18.6455 13.6901 18.3389 13.3835 17.9605 13.3835Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path d="M17.9605 16.1229H10.1752C9.79684 16.1229 9.49023 16.4295 9.49023 16.8078C9.49023 17.1862 9.79684 17.4928 10.1752 17.4928H17.9605C18.3391 17.4928 18.6455 17.1861 18.6455 16.8078C18.6455 16.4296 18.3389 16.1229 17.9605 16.1229Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'newsIcon2':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M12.0004 8.34924C9.98453 8.34924 8.34961 9.98416 8.34961 12C8.34961 14.0159 9.98453 15.6508 12.0004 15.6508C14.0163 15.6508 15.6512 14.0159 15.6512 12C15.6512 9.98416 14.0163 8.34924 12.0004 8.34924Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path d="M12.0002 5.17456C8.2383 5.17456 5.1748 8.23805 5.1748 12C5.1748 15.7619 8.2383 18.8254 12.0002 18.8254C15.7621 18.8254 18.8256 15.7619 18.8256 12C18.8256 8.23805 15.7621 5.17456 12.0002 5.17456ZM12.0002 17.2381C9.11131 17.2381 6.76211 14.8888 6.76211 12C6.76211 9.11107 9.11131 6.76186 12.0002 6.76186C14.8891 6.76186 17.2383 9.11107 17.2383 12C17.2383 14.8888 14.8891 17.2381 12.0002 17.2381Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path d="M12 2C6.49206 2 2 6.49206 2 12C2 17.5079 6.49206 22 12 22C17.5079 22 22 17.5079 22 12C22 6.49206 17.5079 2 12 2ZM12 20.4127C7.36508 20.4127 3.5873 16.6349 3.5873 12C3.5873 7.36508 7.36508 3.5873 12 3.5873C16.6349 3.5873 20.4127 7.36508 20.4127 12C20.4127 16.6349 16.6349 20.4127 12 20.4127Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'newsIcon3':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M19.0711 4.92895C17.1823 3.0402 14.6711 2 12 2C9.32891 2 6.8177 3.0402 4.92891 4.92895C3.0402 6.8177 2 9.32891 2 12C2 14.6711 3.0402 17.1823 4.92891 19.0711C6.8177 20.9598 9.32891 22 12 22C14.6711 22 17.1823 20.9598 19.0711 19.0711C20.9598 17.1823 22 14.6711 22 12C22 9.32891 20.9598 6.8177 19.0711 4.92895ZM3.27258 12.625H6.72289C6.76687 14.0166 6.95715 15.3548 7.2793 16.5683H4.54016C3.82504 15.4049 3.37453 14.0624 3.27258 12.625ZM12.625 6.18172V3.3666C13.3942 3.65121 14.1399 4.44832 14.7371 5.64918C14.8225 5.82082 14.9038 5.99867 14.9813 6.18172H12.625ZM15.424 7.43172C15.7727 8.62176 15.9794 9.96492 16.0266 11.375H12.625V7.43172H15.424ZM11.375 3.3666V6.18172H9.01875C9.09621 5.99871 9.17746 5.82086 9.26285 5.64918C9.86008 4.44832 10.6058 3.65121 11.375 3.3666ZM11.375 7.43172V11.375H7.97332C8.02055 9.96492 8.2273 8.62176 8.57594 7.43172H11.375ZM6.72289 11.375H3.27258C3.37453 9.93762 3.82508 8.59512 4.54016 7.43172H7.2793C6.95711 8.64516 6.76687 9.98344 6.72289 11.375ZM7.97332 12.625H11.375V16.5683H8.57598C8.2273 15.3782 8.02055 14.0351 7.97332 12.625ZM11.375 17.8183V20.6334C10.6058 20.3488 9.86008 19.5517 9.26285 18.3508C9.17746 18.1792 9.09625 18.0013 9.01875 17.8183H11.375ZM12.625 20.6334V17.8183H14.9813C14.9038 18.0013 14.8225 18.1791 14.7371 18.3508C14.1399 19.5517 13.3942 20.3488 12.625 20.6334ZM12.625 16.5683V12.625H16.0267C15.9795 14.0351 15.7727 15.3782 15.4241 16.5683H12.625ZM17.2771 12.625H20.7274C20.6255 14.0624 20.1749 15.4049 19.4598 16.5683H16.7207C17.0429 15.3548 17.2331 14.0166 17.2771 12.625ZM17.2771 11.375C17.2331 9.98344 17.0429 8.64516 16.7207 7.43172H19.4598C20.175 8.59516 20.6255 9.93762 20.7274 11.375H17.2771ZM18.5292 6.18172H16.3255C16.1837 5.80016 16.0271 5.43605 15.8563 5.09258C15.617 4.61121 15.3554 4.18262 15.0755 3.80852C16.4125 4.31215 17.5946 5.1341 18.5292 6.18172ZM8.92445 3.80852C8.64461 4.18262 8.38305 4.61121 8.14363 5.09258C7.97281 5.43605 7.81629 5.80012 7.67445 6.18172H5.47082C6.40535 5.1341 7.58746 4.31215 8.92445 3.80852ZM5.47082 17.8183H7.67449C7.81633 18.1998 7.97285 18.5639 8.14367 18.9074C8.38305 19.3888 8.64465 19.8174 8.92449 20.1915C7.58746 19.6879 6.40535 18.8659 5.47082 17.8183ZM15.0755 20.1915C15.3554 19.8174 15.617 19.3888 15.8564 18.9074C16.0272 18.5639 16.1837 18.1999 16.3255 17.8183H18.5292C17.5946 18.8659 16.4125 19.6879 15.0755 20.1915Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'newsIcon4':
				?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M12 2C17.514 2 21.999 6.48594 21.999 12C21.999 17.5141 17.5142 22 12 22C6.48582 22 2 17.5141 2 12C2 6.48586 6.48582 2 12 2ZM12 2.9375C7.00312 2.9375 2.9375 7.0027 2.9375 12C2.9375 16.9973 7.00312 21.0625 12 21.0625C16.9969 21.0625 21.0635 16.9968 21.0635 12C21.0635 7.00316 16.9969 2.9375 12 2.9375ZM13.6162 5.13281C13.7214 5.10954 13.8315 5.12263 13.9277 5.1709C14.0241 5.21935 14.1014 5.3 14.1455 5.39844C14.1896 5.49685 14.1979 5.60777 14.1699 5.71191L12.9062 10.4297L15.7617 11.1943C15.8367 11.2145 15.9055 11.2533 15.9619 11.3066C16.0183 11.3599 16.0606 11.4263 16.085 11.5C16.1093 11.5736 16.115 11.6521 16.1016 11.7285C16.0881 11.805 16.0559 11.8775 16.0078 11.9385L10.6504 18.7012C10.5835 18.7857 10.489 18.8439 10.3838 18.8672C10.2787 18.8905 10.1685 18.8773 10.0723 18.8291C9.97588 18.7806 9.8986 18.7 9.85449 18.6016C9.81039 18.5031 9.80209 18.3923 9.83008 18.2881L11.0938 13.5703L8.23828 12.8057C8.16328 12.7855 8.09454 12.7467 8.03809 12.6934C7.98168 12.6401 7.93944 12.5737 7.91504 12.5C7.89069 12.4264 7.88503 12.3478 7.89844 12.2715C7.91194 12.195 7.94401 12.1224 7.99219 12.0615L13.3496 5.29883C13.4165 5.21431 13.511 5.15614 13.6162 5.13281Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;

			case 'newsIcon5':
				?>
				<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M8.77858 7.31067L10.5617 13.9659C10.6686 14.3662 10.4314 14.7768 10.032 14.8837L6.26043 15.8943C5.55543 16.0837 4.80449 15.9843 4.17355 15.6196C3.54168 15.2559 3.08043 14.6549 2.89294 13.9499L2.14481 11.159C1.95544 10.4549 2.05481 9.70397 2.41855 9.07304C2.78323 8.44117 3.38417 7.97991 4.08823 7.79149L7.85983 6.78181C8.26015 6.67399 8.67171 6.91212 8.77858 7.31149V7.31067ZM7.52326 8.42348L4.4755 9.23909C4.15582 9.32535 3.88205 9.53535 3.71611 9.82222C3.55111 10.1091 3.50611 10.4504 3.59236 10.77L4.33956 13.561C4.42581 13.8807 4.63581 14.1544 4.92268 14.3204C5.20956 14.4863 5.55081 14.5313 5.87049 14.4451L8.91825 13.6285L7.52326 8.42348Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M9.63151 14.3252L10.2615 19.562C10.3665 20.4263 9.81806 21.2363 8.97712 21.4613L8.55244 21.5757C8.06212 21.7079 7.53899 21.6198 7.11899 21.3357C6.69806 21.0507 6.42244 20.5988 6.36055 20.0945L5.76429 15.1416C5.71929 14.7703 5.9546 14.4235 6.31461 14.3278L8.69116 13.6913C8.90116 13.635 9.12523 13.6725 9.30523 13.7944C9.48523 13.9163 9.60429 14.1103 9.63055 14.326L9.63151 14.3252ZM8.24589 15.363L7.33276 15.6067L7.85215 19.9145C7.86058 19.9867 7.89996 20.0504 7.95996 20.0917C8.01996 20.1329 8.09496 20.1451 8.16527 20.1254L8.58995 20.011C8.70995 19.9792 8.78777 19.8638 8.77277 19.7401L8.24589 15.362L8.24589 15.363Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M15.8745 3.37227L18.6767 13.8291C18.7358 14.0522 18.6898 14.2903 18.5511 14.475C18.4123 14.6588 18.1958 14.7694 17.9652 14.7731L9.85027 14.91C9.50621 14.9147 9.20246 14.686 9.1134 14.3541L7.33027 7.69888C7.24121 7.367 7.39027 7.01543 7.69027 6.84856L14.7861 2.9092C14.9877 2.79763 15.2305 2.78451 15.4433 2.87545C15.6561 2.96545 15.8155 3.14826 15.8755 3.37138L15.8745 3.37227ZM14.6735 4.68853L8.92938 7.87789L10.4097 13.4008L16.9787 13.2901L14.6734 4.6895L14.6735 4.68853Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M14.3039 3.3094C14.1971 2.90908 14.4343 2.49846 14.8336 2.39159C15.2339 2.28472 15.6455 2.52191 15.7524 2.92127L18.7965 14.28C18.9034 14.6803 18.6653 15.0909 18.2659 15.1987C17.8656 15.3056 17.455 15.0675 17.3481 14.6681L14.3039 3.3094Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M21.0864 8.35226C20.686 8.46007 20.2745 8.22288 20.1676 7.82351C20.0598 7.42319 20.297 7.01164 20.6964 6.90477L22.5967 6.3929C22.997 6.28508 23.4086 6.52227 23.5164 6.92164C23.6232 7.32196 23.386 7.73351 22.9867 7.84038L21.0864 8.35226Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M19.8839 12.1406C19.5248 11.9335 19.4011 11.475 19.6083 11.1169C19.8145 10.7578 20.2729 10.6341 20.632 10.8413L22.3383 11.8228C22.6973 12.0291 22.8201 12.4875 22.6139 12.8466C22.4067 13.2056 21.9483 13.3285 21.5892 13.1222L19.8839 12.1406Z" fill="<?php echo esc_attr( $color ); ?>" />
					<path fill-rule="evenodd" clip-rule="evenodd" d="M19.372 5.1629C19.1658 5.52196 18.7074 5.64477 18.3483 5.43852C17.9892 5.23133 17.8664 4.7729 18.0727 4.41384L19.0542 2.70852C19.2614 2.34945 19.7198 2.22571 20.0789 2.4329C20.437 2.63915 20.5608 3.09758 20.3536 3.45664L19.372 5.1629Z" fill="<?php echo esc_attr( $color ); ?>" />
				</svg>
				<?php
				break;
		}

		return ob_get_clean();
	}

	/**
	 * Get date function
	 *
	 * @param array $attributes Block attributes.
	 * @param array $post Post data.
	 * @return string
	 */
	private function getDate( $attributes = array(), $post = array() ) {
		$ticker_date_type = $attributes['tickerDateType'] ?? 'date';
		$meta_date_format = $attributes['metaDateFormat'] ?? 'default';

		$raw_date          = $post['date'] ?? '';
		$post_date_default = $post['post_date']['default'] ?? '';
		if ( 'date' === $ticker_date_type ) {
			if ( 'time_ago' === $meta_date_format ) {
				return $this->human_readable_time_ago( $raw_date );
			} else {
				return $post_date_default;
			}
		} else {
			return $this->format_date_custom( $raw_date, $ticker_date_type );
		}
	}

	/**
	 * String trim help function
	 *
	 * @param string $content Post content.
	 * @param array  $attributes Block attributes.
	 * @return string
	 */
	private function sp_string_trim( $content, $attributes = array() ) {
		if ( ! is_string( $content ) || empty( $content ) ) {
			return '';
		}

		$unit  = isset( $attributes['unit'] ) ? $attributes['unit'] : 'words';
		$value = isset( $attributes['value'] ) ? (int) $attributes['value'] : 10;

		if ( 'chars' === $unit ) {
			return mb_substr( $content, 0, $value );
		}

		if ( 'words' === $unit ) {
			$words = preg_split( '/\s+/', $content );
			if ( ! is_array( $words ) ) {
				return $content;
			}
			$words = array_slice( $words, 0, $value );
			return implode( ' ', $words );
		}

		return $content;
	}
}
