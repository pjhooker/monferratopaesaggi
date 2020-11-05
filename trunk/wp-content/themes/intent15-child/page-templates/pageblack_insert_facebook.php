<?php
/*
Template Name: PAGEBLACK - Insert facebook
*/
?>
<?php acf_form_head(); ?>
<?php get_header('black'); ?>
<?php get_template_part('_page-image'); ?>





	<div id="page" class="fix">
    	<div id="page-inner" class="container fix">
        	<div id="content">
	<div class="row">
        <div class="col-sm-12">
	        <div class="panel panel-default">
		        <div class="panel-heading">
		          <h3 class="panel-title">Inserisci</h3>
		        </div>
		        <div class="panel-body">
					<form method="POST">
					<div class='col-md-12' style='text-align:center;'>
					<input  type="text" name="entry1" placeholder="Titolo" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="entry2" placeholder="Descrizione" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="entry3" placeholder="Immagine esterna" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="entry6" placeholder="Nome autore" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="entry7" placeholder="URL autore" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="entry8" placeholder="Fonte opera" style='width:100%;margin-bottom:25px;'>
					<input  type="text" name="val_lat" placeholder="Lat" style='width:50%;margin-bottom:25px;'>
					<input  type="text" name="val_lng" placeholder="Lng" style='width:50%;margin-bottom:25px;'>
					<input type="submit" name="submit" value="Continua" class="btn btn-primary btn-lg">
					</div>
					</form> 
		        </div>
		    </div>
        </div><!-- /.col-sm-4 -->
    </div>   
    	</div><!--/content-->
        
    </div><!--/page-inner-->
</div><!--/page-->

<?php 
if(isset($_POST['submit']))
    {

		$A=$_POST['entry1'];
		$B=$_POST['entry2'];
		$C=$_POST['entry3'];
		$F=$_POST['entry6'];
		$G=$_POST['entry7'];
		$H=$_POST['entry8'];

	    $lat=$_POST['val_lat'];
	    $lng=$_POST['val_lng'];
	    $location = array(
	    'lat' => $lat,
	    'lng' => $lng
	    );




			global $wpdb;

			/* ABILITA INSERIMENTO NUOV POST */
			// Create post object

			$my_post = array(
			  'post_title'    => $A,
			  'post_content'  => $B,
			  'post_status'   => 'private',
			  'post_author'   => 1,
			  'post_category' => array(52) // CATEGORIA ID 52 "POI"
			);

			// Insert the post into the database
			//wp_insert_post( $my_post );
			$post_id = wp_insert_post( $my_post, $wp_error );

			//now you can use $post_id withing add_post_meta or update_post_meta
			add_post_meta( $post_id, 'template', 't1' );
			//add_post_meta( $post_id, 'stato_verifica', 'pending' );
			update_field( "field_54ba444e2a387", "pending", $post_id );
			update_field( "field_534fa68a0069a", $location, $post_id );
			add_post_meta( $post_id, 'immagine_esterna', $C );
			add_post_meta( $post_id, 'titolo_opera', $A );
			add_post_meta( $post_id, 'licenza', 'Facebook' );
			add_post_meta( $post_id, 'nome_autore', $F );
			add_post_meta( $post_id, 'url_autore', $G );
			add_post_meta( $post_id, 'fonte_opera', $H );
			


		    echo "
		        <meta http-equiv='refresh' content='0;url=?page_id=11037'>
		    ";

		}
		else{

		}
?>
			
<?php get_footer(); ?>