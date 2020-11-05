<?php
/*
Template Name: PBLACK - POI categoria elenco ok
*/
?>
<?php acf_form_head(); ?>
<?php get_header('black'); ?>
<?php get_template_part('_page-image'); ?>


<?php while(have_posts()): the_post(); ?>

<?php 
$postid = get_the_ID();
$get_tipo = $_GET['tipo'];
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
	                    echo"<hr>
	                    	<a href='?page_id=10374&tipo=all'><button type='button' class='btn btn-sm btn-primary'>ALL</button></a>
	                    	<a href='?page_id=10374'><button type='button' class='btn btn-sm btn-primary'>NODEF</button></a>
	                    	<a href='?page_id=10374&tipo=arc_industriale'><button type='button' class='btn btn-sm btn-primary'>arc_industriale</button></a>
	                    	<a href='?page_id=10374&tipo=ed-religioso'><button type='button' class='btn btn-sm btn-primary'>ed-religioso</button></a>
	                    	<a href='?page_id=10374&tipo=ed-storico'><button type='button' class='btn btn-sm btn-primary'>ed-storico</button></a>
	                    	<a href='?page_id=10374&tipo=ed_civile'><button type='button' class='btn btn-sm btn-primary'>ed_civile</button></a>
	                    	<a href='?page_id=10374&tipo=fontana'><button type='button' class='btn btn-sm btn-primary'>fontana</button></a>
	                    	<a href='?page_id=10374&tipo=giardino'><button type='button' class='btn btn-sm btn-primary'>giardino</button></a><br>
	                    	<a href='?page_id=10374&tipo=infernot'><button type='button' class='btn btn-sm btn-primary'>infernot</button></a>
	                    	<a href='?page_id=10374&tipo=info'><button type='button' class='btn btn-sm btn-primary'>info</button></a>
	                    	<a href='?page_id=10374&tipo=interesse_paesaggistico'><button type='button' class='btn btn-sm btn-primary'>interesse_paesaggistico</button></a>
	                    	<a href='?page_id=10374&tipo=museo'><button type='button' class='btn btn-sm btn-primary'>museo</button></a>
	                    	<a href='?page_id=10374&tipo=parcheggio'><button type='button' class='btn btn-sm btn-primary'>parcheggio</button></a>
	                    	<a href='?page_id=10374&tipo=picnic'><button type='button' class='btn btn-sm btn-primary'>picnic</button></a>
	                    	<a href='?page_id=10374&tipo=punto-oss'><button type='button' class='btn btn-sm btn-primary'>punto-oss</button></a>
	                    	<a href='?page_id=10374&tipo=teatro'><button type='button' class='btn btn-sm btn-primary'>teatro</button></a>
	                    	<a href='?page_id=10374&tipo=wc'><button type='button' class='btn btn-sm btn-primary'>wc</button></a>
	                    ";
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
				              </tr>
				            </thead>
				            <tbody>

<?php

$the_query = new WP_Query(array('orderby' => 'meta_value', 'meta_key' => 'tipo', 'order' => 'ASC','posts_per_page' => -1, 'cat' => 52));

//$the_query = new WP_Query( array ( 'cat=3' ,'orderby' => 'meta_value_num', 'meta_key' => 'data_start' ,'meta_type' => 'DATE' , 'order' => 'ASC', 'posts_per_page' => '-1','post_status'=>'publish' ));



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
	$tipo = get_field('tipo');
	$osm_id = get_field('osm_id');

	// prende le coordinate dal meta 'map'
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

if ($get_tipo==NULL){$search_tipo='blue';}
else if ($get_tipo=='all'){
	$count_poi++;
	echo"              
		<tr>
		    <td>$count_poi</td>
		    <td style='text-align:left;'>$comune</td>
		    <td style='text-align:left;'>$osm_id $tipo: <a href='$plink'>$title</a> $lat,$lng</td>
	  	</tr>
	";	
}
else{$search_tipo=$get_tipo;}

if ($tipo==$search_tipo){
$count_poi++;
echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'>$comune</td>
	    <td style='text-align:left;'>";
	    if ($osm_id==NULL){}else{echo "<a href='$osm_id'>OSM</a>";}
	    echo" $tipo: <a href='$plink'>$title</a> $lat,$lng</td>
  	</tr>
";
}
else{}

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