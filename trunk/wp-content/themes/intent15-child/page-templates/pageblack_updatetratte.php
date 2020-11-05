<?php
/*
Template Name: update tratte
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
        
					<div class="col-md-6">
          				<table class="table">
				            <thead>
				              <tr>
				                <th>#</th>
				                <th>id</th>
				                <th>tratta</th>
				                <th>len</th>
				              </tr>
				            </thead>
				            <tbody>

<?php


/*
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 69));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
	
	$title=get_the_title();
	$plink=get_permalink();
	$postid = get_the_ID();

	$field_key = "lunghezza_panoramiche";
	update_field( $field_key, 0,$post_id);	
	$field_key = "lunghezza_totale";
	update_field( $field_key, 0,$post_id);


$count_poi++;

echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'>$postid</td>
	    <td style='text-align:left;'><a href='$plink'>$title</a></td>
	    <td style='text-align:left;'><a href='$plink'>$len</a></td>
  	</tr>
";

endwhile;
// Reset Post Data
wp_reset_postdata();
*/

global $wpdb;
// --- LIMIT --- $result = $wpdb->get_results("SELECT * FROM wp_odpmtb_punti_pg  LIMIT 0, 2");
$result = $wpdb->get_results("SELECT * FROM tb_tratte_len");
//$result = $wpdb->get_results("SELECT * FROM tb_tratte_len_nopano");
$count_poi=0;
foreach($result as $r) {	 

  $len=$r->len;
  $tid=$r->tid;

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 69, 'p'=> $tid));

// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	$title=get_the_title();
	$plink=get_permalink();
	$postid = get_the_ID();

//$field_key = "lunghezza_panoramiche";
//$field_key = "lunghezza_totale";
//update_field( $field_key, $len,$post_id);


$count_poi++;
echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'>$postid</td>
	    <td style='text-align:left;'><a href='$plink'>$title</a></td>
	    <td style='text-align:left;'><a href='$plink'>".arrotonda($len,2)."</a></td>
  	</tr>
";


endwhile;
// Reset Post Data
wp_reset_postdata();


    } // END FOR EACH

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