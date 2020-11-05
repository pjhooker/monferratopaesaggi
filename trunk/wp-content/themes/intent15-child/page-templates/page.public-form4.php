<?php
/*
 * Template Name: Public FORM4
 *
 */
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>



<?php while(have_posts()): the_post(); ?>

<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		<div id="content">
        
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<div class="clear"></div>
					<div class="jumbotron">
						<h1><?php the_title(); ?></h1>
						<p><?php the_content(); ?></p>
						<a href="http://www.monferratopaesaggi.org/?page_id=10380" class="btn btn-primary btn-lg" role="button">Inserisci »</a>
					</div>					
				</div>
			</article>
		</div><!--/content-part-->

<?php endwhile; ?>
        

		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>