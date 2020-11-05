<?php
/*
Template Name: PAGEBLACK - poi-verify-photo
*/
$postid = get_the_ID();
$page_url=get_permalink(10938);

$thumb = $_GET['thumb'];
$get_stato_verifica = $_GET['get_stato_verifica'];

?>
<?php acf_form_head(); ?>
<?php get_header('black'); ?>
<?php get_template_part('_page-image'); ?>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container theme-showcase" role="main">
	
        
<?php



if ($thumb==NULL){echo"<div class='col-md-12' style='padding:5px;'><a href='?thumb=1'>Rigenera miniature</a>";}
else {echo"<div class='col-md-12' style='padding:5px;'><a href='$page_url'>Rigenerazione completata, torna alla visualizzazione leggera.</a>";}
echo"</div>";

echo"
	<div class='col-md-12' style='padding:5px;'>
		Vedi foto taggate: 
		<a href='$page_url'>in attesa</a> -
		<a href='$page_url?get_stato_verifica=true'>va bene</a> -
		<a href='$page_url?get_stato_verifica=archive'>archiviare</a> -
		<a href='$page_url?get_stato_verifica=false'>buttare</a>
	</div>
";

// THE_QUERY
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'post_status' => 'private'));
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
	$stato_verifica = get_field('stato_verifica');
	$licenza = get_field('licenza');


	if($get_stato_verifica==NULL){$search_stato_verifica='pending';}
	else {$search_stato_verifica=$get_stato_verifica;}

	// START IF STATO-VERIFICA
	if ($search_stato_verifica==$stato_verifica){

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
		
		// ---
		if( array_intersect($allowed_roles, $user->roles ) ) { 
			if($thumb==NULL){}
			else{
					if ($img1==NULL) {
						if ($img1ext==NULL){}
						else{
							if(substr($img1ext,0,4)=='http'){crea_thumb_esatte($img1ext,500,500);}
							else{crea_thumb_esatte('store_public/'.$img1ext,500,500);}
						}
					}
					else {
						crea_thumb_esatte($img1,500,500);
					}
			}
			//the_meta();
		} // IF EDITNG --STOP
		else
		{
		} // ELSE EDITNG --STOP
		// ---

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
		// ---

		if ($image_esiste==1){
			
			$count++;
			$contacolonna++;

			$titolo_opera = get_field('titolo_opera');
			
			//restituisce la miniatura
			$img_src=return_thumb_esatte($img1,'500','500');

			if ($titolo_opera==NULL){$alt=get_the_title();}
			else{$alt=$titolo_opera;}

			if($contacolonna==1){echo"<div class='row'>";}
			else if($contacolonna<3){echo"";}
			else {echo"";}

			echo"
				<form method='POST'>
				<div class='col-md-4' style='padding:5px;'>
					<div class='panel panel-info'>
			            <div class='panel-heading'>
			";

			$title_subst=substr($title, 8, 25);
			echo"
							<div class='row'>
						        <div class='col-md-12'>
			    					$title_subst<br>
			";
		    if ($lat==0){$plinkid=get_permalink(10839);echo " <a href='$plinkid?new_postid=$postid' class='btn btn-warning'>Map it!</a>";}
		    else {$plinkid=get_permalink(10865);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-success'><i class='fa fa-map-marker'></i></a>";}
		    $plinkpost=get_permalink($postid);
		    echo" <a href='$plinkpost' class='btn btn-primary'><i class='fa fa-eye'></i></a>";
		    echo " <span class='label label-info'>$licenza</span>";
						            echo"
						        </div>
						    </div>
						    
						";
			if($stato_verifica==NULL){$pendingcolor='#D9534F';}
			else{
				if($stato_verifica=='pending'){$pendingcolor='#D9534F';}else{$pendingcolor='#5b5b5b';}
			}
			if($stato_verifica=='true'){$truecolor='#D9534F';}else{$truecolor='#5b5b5b';}
			if($stato_verifica=='false'){$falsecolor='#D9534F';}else{$falsecolor='#5b5b5b';}
			if($stato_verifica=='archive'){$archivecolor='#D9534F';}else{$archivecolor='#5b5b5b';}
			echo"
			            </div>
			            <div class='panel-body'>
							<a data-toggle='modal' data-target='#myModal-$postid'>
								<img class='img-thumbnail' src='$img_src' alt='$alt' width='100%' itemprop='contentUrl' />
							</a><br>
							<button type='submit' name='stato_pending' value='$postid' class='btn btn-sm btn-danger' style='background: none repeat scroll 0% 0% $pendingcolor;padding: 5px;'>In attesa</button>
							<button type='submit' name='stato_true' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $truecolor;padding: 5px;'>Va bene</button>
							<button type='submit' name='stato_false' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $falsecolor;padding: 5px;'>Buttare</button>
							<button type='submit' name='stato_archive' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $archivecolor;padding: 5px;'>Archiviare</button>
			            </div>
		          	</div>
				</div>
				</form>
			";
			if($contacolonna==1){echo"";}
			else if($contacolonna<3){echo"";}
			else {echo"</div> <!-- ROW -->";$contacolonna=0;}

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
			";

			if ($lat==0){$plinkid=get_permalink(10839);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-warning'>Conosci questo posto? Mappalo!</a>";}
			else {echo" <a href='' class='btn btn-success'><i class='fa fa-map-marker'></i> Posizione conosciuta</a>";}

			$plinkpost=get_permalink($postid);
			echo" <a href='$plinkpost' class='btn btn-primary'><i class='fa fa-eye'></i> Vedi scheda</a>";
			$fonte_opera = get_field('fonte_opera');


			echo"
						<form method='POST'>
							<button type='submit' name='stato_pending' value='$postid' class='btn btn-sm btn-danger' style='background: none repeat scroll 0% 0% $pendingcolor;'>In attesa</button>
							<button type='submit' name='stato_true' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $truecolor;'>Va bene</button>
							<button type='submit' name='stato_false' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $falsecolor;'>Buttare</button>
							<button type='submit' name='stato_archive' value='$postid' class='btn btn-sm btn-primary' style='background: none repeat scroll 0% 0% $archivecolor;'>Archiviare</button><br>
						</form>
			        <img class='img-thumbnail'  style='margin-top:10px;' src='$img1' style='width:100%;>
			      </div>
			      <div class='modal-footer'>
			      </div>
			    </div>
			  </div>
			</div>
			";

		} // END IF IMAGE-ESISTE
		else{}
	// END IF STATO-VERIFICA
	}
	else{}

endwhile;
// Reset Post Data
wp_reset_postdata();

?>
	
</div>
<?php
if(isset($_POST['stato_pending']))
    {

		$id=$_POST['stato_pending'];

		$post_id = wp_insert_post( $my_post, $wp_error );

		update_field('stato_verifica', 'pending', $id)

?>
<script>
   	alert("Foto aggionata!");
</script>
<?php

		echo "
		<meta http-equiv='refresh' content='0;url=$page_url'>
		";
	}

else if(isset($_POST['stato_true'])){
	$id=$_POST['stato_true'];
	$post_id = wp_insert_post( $my_post, $wp_error );
	update_field('stato_verifica', 'true', $id)
?>
<script>
   	alert("Foto aggionata!");
</script>
<?php
	echo "<meta http-equiv='refresh' content='0;url=$page_url'>";
}

else if(isset($_POST['stato_false'])){
	$id=$_POST['stato_false'];
	$post_id = wp_insert_post( $my_post, $wp_error );
	update_field('stato_verifica', 'false', $id)
?>
<script>
   	alert("Foto aggionata!");
</script>
<?php
	echo "<meta http-equiv='refresh' content='0;url=$page_url'>";
}

else if(isset($_POST['stato_archive'])){
	$id=$_POST['stato_archive'];
	$post_id = wp_insert_post( $my_post, $wp_error );
	update_field('stato_verifica', 'archive', $id)
?>
<script>
   	alert("Foto aggionata!");
</script>
<?php
	echo "<meta http-equiv='refresh' content='0;url=$page_url'>";
}

else{}


?>
<?php get_footer(); ?>
