<?php $meta = get_post_custom(); ?>

<div id="page" class="portfolio single single-right">
	<div id="page-inner" class="container fix">
	
		<div id="content-part">
			<div class="portfolio-item-single">

			<?php if(!isset($meta['_portfolio_video'])): ?>

				<div class="flexslider" id="flex-portfolio">
					<ul class="slides">
						<?php foreach ( $post_images as $image ): ?>
						<?php $img = wp_get_attachment_image_src($image->ID,'post-format'); ?>
						<li>
							<img src="<?php echo $img[0]; ?>" alt="<?php echo $image->post_title; ?>" />
							<?php if($image->post_excerpt): ?>
							<span class="caption-bar"><i><?php echo $image->post_excerpt; ?></i></span>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<script type="text/javascript">
					jQuery(window).load(function() {
						jQuery('#flex-portfolio').flexslider({
							/* slideDirection: "", */
							animation: "fade",
							slideshow: true,
							directionNav: true,
							controlNav: true,
							pauseOnHover: true,
							slideshowSpeed: 7000,
							animationDuration: 600 
						});
						jQuery('.slides').addClass('loaded');
					}); 
				</script>

			<?php endif; // end check for portfolio video ?>

				<?php
				if(isset($meta['_portfolio_video'])) {
					echo '<div class="video-container">';
					if(isset($meta['_portfolio_video_url'])) {
						global $wp_embed;
						$video = $wp_embed->run_shortcode('[embed width="640"]'.$meta['_portfolio_video_url'][0].'[/embed]');
						echo $video;
					} elseif(isset($meta['_portfolio_video_embed_code'][0])) {
						echo $meta['_portfolio_video_embed_code'][0];
					}
					echo '</div>';
				}
				?>

			</div>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right portfolio">
			<article>
				<div class="text">
					<p class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></p>
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/sidebar-->
		
		<?php if ( ('open' == $post->comment_status) && !air_portfolio::get_option('portfolio-comments-disable') ): ?>
		<div id="content-part" class="fix comments">
			<?php comments_template(); ?>
		</div><!--/content-part-->
		<?php endif;?>
		
	</div><!--/page-inner-->
</div><!--/page-->