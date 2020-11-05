<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">
		<h1><?php echo wpb_page_title(); ?></h1>
		<?php if(!air_portfolio::get_option('portfolio-prevnext')): ?>
		<ul id="portfolio-pagination" class="fix">
			<?php next_post_link('<li class="previous">%link</li>','<i class="icon"></i>%title'); ?>
			<?php previous_post_link('<li class="next">%link</li>','<i class="icon"></i>%title'); ?>
		</ul>
		<?php endif; ?>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<?php
// Template
$template = get_post_meta($post->ID,'_portfolio_template',TRUE);
if ( !$template ) { $template = 'left'; }
$template = locate_template('_portfolio-single-'.$template.'.php');

// Get post images
$post_images = wpb_post_images();

// No post images, use featured thumbnail
if ( !$post_images && has_post_thumbnail() ) {
	// Get featured thumbnail id
	$img_id = get_post_thumbnail_id();
	// Get image
	$post_images = wpb_post_images(
		array(
			'p'				=> $img_id,
			'post_parent'	=> NULL
		)
	);
}

// Load template
require($template);
?>

<?php endwhile; ?>

<?php get_footer(); ?>
