<?php
/*
 * Template Name: Public FORM
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
	</div>
	<div class="row">
        <div class="col-sm-4">

        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
	        <div class="panel panel-default">
		        <div class="panel-heading">
		          <h3 class="panel-title">Inserisci la tua email per iniziare</h3>
		        </div>
		        <div class="panel-body">
					<form method="POST">
					<div class='col-md-12' style='text-align:center;'>
					<input  type="text" name="entry1" placeholder="Scrivi la tua email" style='width:100%;margin-bottom:25px;'>
					<input type="submit" name="submit" value="Continua" class="btn btn-primary btn-lg">
					</div>
					</form> 
		        </div>
		    </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
        </div><!-- /.col-sm-4 -->
    </div>      


<?php 
if(isset($_POST['submit']))
    {

		$A=$_POST['entry1'];

		if(filter_var($A, FILTER_VALIDATE_EMAIL)) {$errorE1=0;}
		else {$errorE1=1;}

		if ($errorE1==1){
			echo "
				<div class='alert alert-danger' role='alert'>
					<strong>Email non valida!</strong> L'indirizzo email che hai inserito, non risulta valido, ti invitiamo a riporvare, Grazie.
				</div>
			";
		}
		else{

			global $wpdb;

			/* ABILITA INSERIMENTO NUOV POST */
			// Create post object

			$my_post = array(
			  'post_title'    => $A,
			  'post_content'  => '',
			  'post_status'   => 'private',
			  'post_author'   => 1,
			  'post_category' => array(52,89) // CATEGORIA ID 52 "POI"
			);

			// Insert the post into the database
			//wp_insert_post( $my_post );
			$post_id = wp_insert_post( $my_post, $wp_error );

			//now you can use $post_id withing add_post_meta or update_post_meta
			add_post_meta( $post_id, 'template', 't1' );
			add_post_meta( $post_id, 'email', $A );
			//add_post_meta( $post_id, 'stato_verifica', 'pending' );
			update_field( "field_54ba444e2a387", "pending", $post_id );

			/*
				immagine_evidenza:
				tipo: ed_civile
				note:
				map: a:3:{s:7:"address";s:59:"Via Goffredo Mameli, 63, 15033 Casale Monferrato AL, Italia";s:3:"lat";s:18:"45.137237226195836";s:3:"lng";s:17:"8.454054594039917";}
				titolo_opera: Facciata della cattedrale di Sant'Evasio
				licenza: CC BY-SA 3.0
				nome_autore: Davide Papalini
				url_autore: https://commons.wikimedia.org/wiki/File:Casale_Monferrato-duomo-facciata1.jpg#mediaviewer/File:Casale_Monferrato-duomo-facciata1.jpg
				tipo_opera: opera propria
				fonte_opera: https://commons.wikimedia.org/wiki/File:Casale_Monferrato-duomo-facciata1.jpg#mediaviewer/File:Casale_Monferrato-duomo-facciata1.jpg
				osm_id: http://www.openstreetmap.org/way/80414060
				wiki_id: https://it.wikipedia.org/wiki/Duomo_di_Casale_Monferrato
			*/


		    echo "
		        <meta http-equiv='refresh' content='0;url=?page_id=10405&new_postid=$post_id'>
		    ";
			} // END ELSE ERROR E1
		}
		else{

		}
?>
					
				</div>
			</article>
		</div><!--/content-part-->

<?php endwhile; ?>
        

		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>