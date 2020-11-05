<?php $meta = get_post_custom(); ?>

<div id="page" class="portfolio single single-full">
	<div id="page-inner" class="container fix">
	
		<div id="content">
			<div class="portfolio-item-single">

			<?php if(!isset($meta['_portfolio_video'])): ?>

				<div class="flexslider" id="flex-portfolio">
					<ul class="slides">
						<?php /*foreach( $post_images as $image ): */?>
						<?php /*$img = wp_get_attachment_image_src($image->ID,'large'); */?>
						<li>
							<?php /*<img src="<?php echo $img[0]; ?>" alt="<?php echo $image->post_title; ?>" /> */?>
<?php

$imH='627';
$imW='960';

$img1=get_field('field_535963af94eff');
$nullimg='http://www.monferratopaesaggi.it/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
if ($img1==NULL) {$img1=$nullimg;}
else {}
echo"<img src='image.php?myimage=$img1&h=$imH&w=$imW' >";
?>
							<?php /*if($image->post_excerpt):
							<span class="caption-bar"><i><?php echo $image->post_excerpt; ?></i></span>*/ ?>
							<?php /* endif; */?>
						</li>
						
<?php
$img2=get_field('field_5359650d4e1c0');
if ($img2==NULL) {}
else{
echo"<li>";
echo"<img src='image.php?myimage=$img2&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img3=get_field('field_535965174e1c1');
if ($img3==NULL) {}
else{
echo"<li>";
echo"<img src='image.php?myimage=$img3&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img4=get_field('field_5359651e4e1c2');
if ($img4==NULL) {}
else{
echo"<li>";
echo"<img src='image.php?myimage=$img4&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img5=get_field('field_535965254e1c3');
if ($img5==NULL) {}
else{
echo"<li>";
echo"<img src='image.php?myimage=$img5&h=$imH&w=$imW' >";
echo"</li>";
} 
?>

						<?php /*endforeach; */?>
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
						$video = $wp_embed->run_shortcode('[embed width="940"]'.$meta['_portfolio_video_url'][0].'[/embed]');
						echo $video;
					} elseif(isset($meta['_portfolio_video_embed_code'][0])) {
						echo $meta['_portfolio_video_embed_code'][0];
					}
					echo '</div>';
				}
				?>

			</div>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-full portfolio">
			<article>
				<div class="text">
					<p class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></p>
					<?php the_content(); ?>
                   
<?php
//$idframe=$_GET['gid'];//questo numero varia ed è da associare al frame
$page_id=$_GET['page_id'];
$percorso_id=$_GET['percorso_id'];
$portfolio=$_GET['portfolio'];
if ($portfolio=='comune-99'){}
else if ($portfolio=='comune-4') {$lat=45.155805;$lon=8.193695;}
else if ($portfolio=='comune-3') {$lat=45.142336;$lon=8.335852;}
else if ($portfolio=='comune-2') {$lat=45.147573;$lon=8.373501;}
else if ($portfolio=='alfiano-natta') {$lat=45.154503;$lon=8.160716;}
else {$lat=45.142336;$lon=8.335852;}
//$key="mykey";
//$lat = get_post_meta($post->ID, 'lat', true);
//$lon = get_post_meta($post->ID, 'lon', true);
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&percorso_id=$percorso_id' width='100%' height='800px'></iframe>";
echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&lat=$lat&lon=$lon' width='100%' height='520px'></iframe>";
?>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/sidebar-->
		
		<?php if ( ('open' == $post->comment_status) && !air_portfolio::get_option('portfolio-comments-disable') ): ?>
		<div id="content" class="fix comments">
			<?php comments_template(); ?>
		</div><!--/content-part-->
		<?php endif;?>
		
	</div><!--/page-inner-->
</div><!--/page-->