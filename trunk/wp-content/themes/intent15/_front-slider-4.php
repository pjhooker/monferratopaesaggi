<?php global $meta; ?>

<?php if(isset($meta['_heading']) || isset($meta['_subheading'])): ?>
<div id="page-title" class="front front-4 fix">
	<div id="page-title-inner" class="container">
		<?php if(isset($meta['_heading'])) { echo '<h1>'.$meta['_heading'][0].'</h1>'; } ?>
		<?php if(isset($meta['_subheading'])) { echo '<h2>'.$meta['_subheading'][0].'</h2>'; } ?>
	</div><!--/page-title-inner-->
</div><!--/page-title-->
<?php endif; ?>

<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('#flex-front-4').flexslider({
			animation: "fade",
			controlsContainer: ".flex-controls",
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

<?php $images = wpb_post_images(); ?>

<div class="flexslider" id="flex-front-4">
<?php /*pj mod*/ ?>
<div id="pin_a">
<h1 style="color:#fff;font-size:25px;">il Monferrato</h1>
<p style="color:#fff;">Se non lo conosci....</p>
<br />
<iframe width="240" height="180" src="//www.youtube.com/embed/HqbSLIneWew?rel=0" frameborder="0" allowfullscreen></iframe>
</div>
<?php /*END pj mod*/ ?>
	<ul class="slides">
		<?php foreach($images as $image): ?>
		<?php $img = wpb_vt_resize($image->ID,'','940','460',TRUE); ?>
		<?php $imagelink = ($image->post_content!='')?$image->post_content:NULL; ?>
		<li>
			<?php if($imagelink): ?>
				<a href="<?php echo $imagelink; ?>"><img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" /></a>
			<?php else: ?>
				<img src="<?php echo $img['url']; ?>" alt="<?php echo $image->post_title; ?>" />
			<?php endif; ?>

			<?php if($image->post_excerpt): ?>
			<div class="container">
				<p class="flex-caption"><?php echo $image->post_excerpt; ?></p>
			</div>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="flex-controls"></div>
</div>