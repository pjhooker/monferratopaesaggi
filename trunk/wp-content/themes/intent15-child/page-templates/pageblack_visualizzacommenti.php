<?php
/*
Template Name: PBLACK - Visualizza elimina commenti
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
        
					<div class="col-md-6"><form method="POST">
          				<table class="table">
				            <thead>
				              <tr>
				                <th>#</th>
				                <th>Messaggio</th>
				                <th>email</th>
				                <th></th>
				              </tr>
				            </thead>
				            <tbody>

<?php

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 86));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	

	$title=get_the_title();
	$title = str_replace('"', '', $title);
	$plink=get_permalink();
	$postid = get_the_ID();
	$messaggio=get_field('commento');
	$email=get_field('contatto');


$count_poi++;
echo"              
	<tr>
	    <td>$count_poi</td>
	    <td style='text-align:left;'><a href='$plink'>$messaggio</a></td>
	    <td style='text-align:left;'>$email</td>
	    <td style='text-align:left;'><input type='submit' name='submit' value='$postid' class='btn btn-primary btn-lg'></td>
  	</tr>
";

endwhile;
// Reset Post Data
wp_reset_postdata();
?>
		            		</tbody>
		          		</table></form> 
		        	</div>
		        	<div class="clear"></div>
		    	</section><!--/#portfolio-->
		    </article>
    	</div><!--/content-->
        
    </div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>

<?php
if(isset($_POST['submit']))
    {

		$id=$_POST['submit'];


			global $wpdb;

			/* ABILITA INSERIMENTO NUOV POST */
			// Create post object

			wp_trash_post( $id  );


		    echo "
		        <meta http-equiv='refresh' content='0;url=http://www.monferratopaesaggi.it/tools/visualizza-elimina-commenti/'>
		    ";
		}
		else{

		}
		?>