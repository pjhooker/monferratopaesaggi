<?php
/*
Template Name: Full-width
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title" class="fix">
	<?php /*<div id="page-title-inner" class="container">
		<h1>echo wpb_page_title(); </h1>
	</div><!--/page-title-inner-->*/?>
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">
	
		<div id="content">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</article>
			
			<?php comments_template(); ?>
		</div>	
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php endwhile;?>

<?php get_footer(); ?>