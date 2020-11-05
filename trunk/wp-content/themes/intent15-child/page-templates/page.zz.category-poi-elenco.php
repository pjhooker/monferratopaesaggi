<?php
/*
Template Name: Category POI elenco
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>
    
<?php
//while(have_posts()): the_post(); 
?>
 
<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h1><?php echo wpb_page_title(); ?></h1>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php 
                    //the_content(); 
                    ?>
<?php 
// PJHMOD --- START

/*
query_posts('cat=52');

if ( have_posts() ) : while ( have_posts() ) : the_post();
echo"<h1><a href=" . the_permalink() . ">";
the_title();
echo"</a></h1>";
echo"<p>";
the_content(); 

endwhile; else: endif;
*/

// PJHMOD --- STOP
 ?>

<?php 
// PJHMOD 2 --- START
?>
		<?php // Display blog posts on any page @ http://m0n.co/l

		$temp = $wp_query; $wp_query= null;
        
		$wp_query = new WP_Query(); $wp_query->query('cat=52&showposts=20' . '&paged='.$paged);
        
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<?php
    the_post_thumbnail('thumbnails', array('class' => 'alignleft')); 
?>

<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>

<?php
    the_excerpt();
?>

<div class="clear"></div>
		<?php endwhile; ?>

		<?php if ($paged > 1) { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
			<div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
		</nav>

		<?php } else { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
		</nav>

		<?php } ?>

		<?php wp_reset_postdata(); ?>

 <?php
// PJHMOD 2 --- STOP
 ?>
					<div class="clear"></div>
				</div>
 
			</article>
		</div><!--/content-part-->

<?php
//endwhile; 
?>
		
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>