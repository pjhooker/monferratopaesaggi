<?php
/*
Template Name: PAGEBLACK - photo
*/
?>
<?php acf_form_head(); ?>
<?php get_header('black'); ?>
<?php get_template_part('_page-image'); ?>
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container theme-showcase" role="main">
	<div class="row">

<?php

// THE_QUERY
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'post_status' => 'publish'));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	$title=get_the_title();
	$title = str_replace('"', '', $title);
	$plink=get_permalink();
	$postid = get_the_ID();
	$id_comune = get_field('id_comune');
	$comune = get_the_title($id_comune);

	$lat=0;$lng=0;
	// prende le coordinate dal meta 'map'
	$location = get_field('map');
	if( !empty($location) ):
		$lat= $location['lat'];
		$lng=$location['lng']; 
	endif; // lat lng

$img1=get_field('immagine_evidenza');
$img1ext=get_field('immagine_esterna');
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator');
if( array_intersect($allowed_roles, $user->roles ) ) { 
/*
	if ($img1==NULL) {
		if ($img1ext==NULL){}
		else{
			if(substr($img1ext,0,4)=='http'){crea_thumb_esatte($img1ext,300,300);}
			else{crea_thumb_esatte('store_public/'.$img1ext,300,300);}
		}
	}
	else {
		crea_thumb_esatte($img1,300,300);
	}
*/
	//the_meta();
} // IF EDITNG --STOP
else
{
} // ELSE EDITNG --STOP
// ---


$image_esiste=0;
if ($img1==NULL) {
	if ($img1ext==NULL){$image_esiste=0;}
	else{
		if(substr($img1ext,0,4)=='http'){$img1=$img1ext;}
		else{$img1='store_public/'.$img1ext;}

		$image_esiste=1;
	}
}
else {$image_esiste=1;}

if ($image_esiste==1){
	$titolo_opera = get_field('titolo_opera');
	
	//restituisce la miniatura
	$img_src=return_thumb_esatte($img1,'300','300');

	if ($titolo_opera==NULL){$alt=get_the_title();}
	else{$alt=$titolo_opera;}
	echo"
		<div class='col-md-4' style='padding:5px;'>
			<div class='panel panel-info'>
	            <div class='panel-heading'>
	";
global $wpdb;

$meta_key = 'id_like';
$meta_value = $postid;
$allmiles = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT count(meta_value) 
		FROM $wpdb->postmeta 
		WHERE meta_key = %s AND meta_value = %s
	", 
	$meta_key,
	$meta_value
) );
$allmiles1=$allmiles+1;

				echo " 
					<form method='POST'>
					<div class='row'>
				        <div class='col-md-12'>
				        	<button type='submit' name='submit01' value='$postid' class='btn btn-danger' style='background: none repeat scroll 0% 0% #D9534F;'>
				                <i class='fa fa-heart'></i> <span id='core-$id'>{$allmiles}</span>
				            </button>";
				            if ($lat==0){$plinkid=get_permalink(10839);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-warning'>Map it!</a>";}
				            else {$plinkid=get_permalink(10865);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-success'><i class='fa fa-map-marker'></i></a>";}
				            $plinkpost=get_permalink($postid);
				            echo" <a href='$plinkpost' class='btn btn-primary'><i class='fa fa-eye'></i></a>";
				            echo"<input type='hidden' name='core' value='{$allmiles1}'>";

				            echo"
				        </div>
				    </div>
				    </form>
				";	
	echo"
	            </div>
	            <div class='panel-body'>
					<a data-toggle='modal' data-target='#myModal-$postid'>
						<img class='img-thumbnail' src='$img_src' alt='$alt' width='100%' itemprop='contentUrl' />
					</a>
	            </div>
          	</div>
		</div>
	";
echo"
	<div class='modal fade' id='myModal-$postid' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	  <div class='modal-dialog' style='  width: 100%;max-width: 1040px; height: auto;'>
	    <div class='modal-content'>
	      	<div class='modal-header' style='text-align:center;'>
	        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	        			<h4  style='text-align:center;' class='modal-title' id='myModalLabel'>$title
";
	        $nome_autore = get_field('nome_autore');
if ($nome_autore==NULL){}
else{
	$url_autore = get_field('url_autore');
	if ($url_autore==NULL){}
	else{echo"<span style='font-size:14px;'>di <a href='$url_autore' style='color:#AD8F92'><span itemprop='author'>$nome_autore</span></a></span>";}
	
} 
echo"
	        			</h4>
	      </div>
	      <div class='modal-body' style='text-align:center;'>
						<button class='btn btn-danger' style='background: none repeat scroll 0% 0% #D9534F;'>
							<i class='fa fa-heart'></i>
						</button>
";
if ($lat==0){$plinkid=get_permalink(10839);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-warning'>Conosci questo posto? Mappalo!</a>";}
else {echo" <a href='' class='btn btn-success'><i class='fa fa-map-marker'></i> Posizione conosciuta</a>";}
$plinkpost=get_permalink($postid);
echo" <a href='$plinkpost' class='btn btn-primary'><i class='fa fa-eye'></i> Vedi scheda</a>";
$fonte_opera = get_field('fonte_opera');
if ($fonte_opera==NULL){}
else{echo" <a href='$fonte_opera'' class='btn btn-info'><i class='fa fa-eye'></i> Vedi origine</a>";} 

echo"

	        <img class='img-thumbnail'  style='margin-top:10px;' src='$img1' style='width:100%;>
	      </div>
	      <div class='modal-footer'>
	      </div>
	    </div>
	  </div>
	</div>
	";

}
else{
}

?>
<?php

endwhile;
// Reset Post Data
wp_reset_postdata();
?>
	</div>
</div>
<?php
if(isset($_POST['submit01']))
    {

		$id=$_POST['submit01'];
		$core=$_POST['core'];


		global $wpdb;

		/* ABILITA INSERIMENTO NUOV POST */
		// Create post object

		$my_post = array(
		  'post_title'    => 'Cuore per '. $id,
		  'post_content'  => '',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array(83) // CATEGORIA ID 83 "Cuori"
		);

		// Insert the post into the database
		//wp_insert_post( $my_post );
		$post_id = wp_insert_post( $my_post, $wp_error );

		//now you can use $post_id withing add_post_meta or update_post_meta
		add_post_meta( $post_id, 'id_like', $id );

?>
<script>
    var span = document.getElementById('core-<?php echo $id; ?>');
    
    while( span.firstChild ) {
        span.removeChild( span.firstChild );
    }
    span.appendChild( document.createTextNode("<?php echo $core; ?> Thanks!") );
   	//alert("Error! Name contains number." + $postid);
</script>
<?php

		}
		else{

		}


?>

<?php get_footer(); ?>
