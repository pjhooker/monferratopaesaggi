<?php 
// <!DOCTYPE html>
while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!wpb_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</header>

	<?php get_template_part('_post-formats'); ?>

	<div class="clear"></div>
	
	<div class="text">
		<?php the_content(); ?>
		<div class="clear"></div>

<?php endwhile;?>

<?php

// PJH MOD --- START
echo "
    <iframe src='http://192.81.215.55/experiment192/php/tools/crea_kml_linee_monferrato3.php' style='width:100%;height:100px;'></iframe>
";
echo "<hr>
    <iframe src='http://192.81.215.55/experiment192/php/tools/crea_kml_linee_buff_monferrato3.php' style='width:100%;height:300px;'></iframe>
";
// PJH MOD --- STOP
?>
		<?php 
        echo "
            -
        ";
        ?>
		<div class="clear"></div>
	</div>

</article>

