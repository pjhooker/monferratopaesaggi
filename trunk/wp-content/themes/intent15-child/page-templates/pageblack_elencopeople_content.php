<?php
/*
Template Name: PBLACK - Elenco people contenuti
*/
?>
<?php acf_form_head(); ?>
<?php get_header('black'); ?>
<?php get_template_part('_page-image'); ?>


<?php while(have_posts()): the_post(); ?>

<?php 
$postid = get_the_ID();
?>

	<div id="page" class="fix">
    	<div id="page-inner" class="container fix">
        	<div id="content">
            	<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	                <div class="text">
	                    <?php
	                    echo"<h1>";
	                    the_title();
	                    echo"</h1>";
	                    the_content();
	                    ?>
	                    <div class="clear"></div>
					</div>
                	<div class="clear"></div>


<?php endwhile; ?>
        
					<div class="col-md-12">
          				<table class="table">
				            <thead>
				              <tr>
				                <th>#</th>
				                <th>Nome</th>
				                <th>pagina autore</th>
				                <th>inviate</th>
				                <th>Approvate</th>
				                <th>In attesa</th>	
				                <th>Non approvate</th>				                				                				                
				              </tr>
				            </thead>
				            <tbody>

<?php

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 87));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	

	$title=get_the_title();
	$title = str_replace('"', '', $title);
	$plink=get_permalink();
	$postid = get_the_ID();
	$email = get_field('email');
	$url_profilo = get_field('url_profilo');
	$profilo_public= get_field('profilo_public');
	$count_poi++;

$peoplecontent=get_people_totale($postid);
$array_peoplecontent=explode(',', $peoplecontent);
$inviate=$array_peoplecontent[0];
$approvate=$array_peoplecontent[1];
$in_attesa=$array_peoplecontent[2];
$non_approvate=$array_peoplecontent[3];

echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'>$title</td>
	    <td style='text-align:left;'>url_profilo</td>
		<td>$inviate</td>
		<td>$approvate</td>
		<td>$in_attesa</td>	
		<td>$non_approvate</td>	
";

echo"              
  	</tr>
";
endwhile;
// Reset Post Data
wp_reset_postdata();
?>
		            		</tbody>
		          		</table>
		        	</div>
		        	<div class="clear"></div>
		    	</section><!--/#portfolio-->
		    </article>
    	</div><!--/content-->
        
    </div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>