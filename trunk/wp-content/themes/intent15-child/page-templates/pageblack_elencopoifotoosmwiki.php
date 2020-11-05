<?php
/*
Template Name: PBLACK - POI OSM/FOTO/WIKI elenco
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
				                <th>Comune</th>
				                <th>POI</th>
				                <th>FOTO</th>
				                <th>OSM</th>
				                <th>WIKI</th>	
				                <th>email</th>				                				                				                
				              </tr>
				            </thead>
				            <tbody>

<?php

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	

	$title=get_the_title();
	$title = str_replace('"', '', $title);
	$plink=get_permalink();
	$postid = get_the_ID();
	$id_comune = get_field('id_comune');
	$comune = get_the_title($id_comune);
	$url_image = get_field('immagine_evidenza');
	$osm_id= get_field('osm_id');
	$wiki_id= get_field('wiki_id');
	$nome_autore= get_field('nome_autore');
	//temp
	$idautore=get_id_autore($nome_autore);

	$count_poi++;
echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'>$comune</td>
	    <td style='text-align:left;'><a href='$plink'>$title</a></td>
";

if (substr($url_image, 0, 4)=='http') {echo"<td style='text-align:left;'><a href='$url_image'>IMG</a></td>";} else {echo"<td></td>";}
if ($osm_id==NULL) {echo"<td></td>";} else {echo"<td style='text-align:left;'><a href='$plink'>OSM</a></td>";}
if ($wiki_id==NULL) {echo"<td></td>";} else {echo"<td style='text-align:left;'><a href='$plink'>WIKI</a></td>";}
if ($nome_autore==NULL) {echo"<td></td>";} else {echo"<td style='text-align:left;'><a href='$plink?autore=$idautore'>$nome_autore</a></td>";}

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