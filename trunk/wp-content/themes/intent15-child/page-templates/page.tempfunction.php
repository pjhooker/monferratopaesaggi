<?php
/*
Template Name: TEMP FUNCTION
*/

get_header(); ?>

<div id="page">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

                    <h1 class="post-title"><img itemprop="image" style="float: left; margin: 0px 15px 15px 0px;width:50px;height:auto;" src="https://lh4.googleusercontent.com/-1UCSMjFdeHg/UvFt7fy5Y4I/AAAAAAAAvmc/p-Wd1KcFKCs/s444-no/tavole_svg.png">
                    <span itemprop="name"><?php echo get_the_title($ID);?></span></h1>
                    <span itemprop="description"><?php the_content(); ?></span>
                    <hr>
                    
            <?php
            // LANCIA QUESTA FUNZIONE
            update_poi_meta_id_comune();

            ?>

			<?php endwhile; ?>

		</div><!--/content-part-->
		
	</div><!--/page-inner-->
</div><!--/page-->


<?php get_footer(); ?>