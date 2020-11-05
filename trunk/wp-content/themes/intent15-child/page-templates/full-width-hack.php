<?php
/*
Template Name: Full-width HACK
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
				<div class="alert alert-success" role="alert">
<p style="text-align: left;"><i class="fa fa-bug"></i> 
<?php the_content(); ?>
</p>
</div>
					
					<div class="clear"></div>


<table class="table table-bordered">
<thead>
<tr>
<th>Stato</th>
<th>Nome (link)</th>
<th>Descrizione</th>
</tr>
</thead>
<tbody>

<?php
//POI
$count_poi=0;
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 85));
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

    $plink=get_permalink();
    $postid = get_the_ID();
    $content = get_the_content();
    $title = get_the_title();
    $count_poi++;
    if (get_field('link_tools')==NULL){$link=$plink;}
	else{$link=get_field('link_tools');} 
	if (get_field('stato_tools')=='in_work'){$icon='<i class="fa fa-clock-o"></i>';}
	else{$icon='<i class="fa fa-check"></i>';} 

echo"
<tr>
<td>($icon)</td>
<td style='text-align: left;'><a href='$link'>$title</a></td>
<td style='text-align: left;'>$content</td>
</tr>
";

endwhile;
// Reset Post Data
wp_reset_postdata();
//POI END
?>			
</tbody>
</table>		
				</div>
			</article>
			
			<?php comments_template(); ?>
		</div>	
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php endwhile;?>

<?php get_footer(); ?>