<?php
/*
 * Template Name: Public FORM3
 *
 */
$update_id=$_GET['new_postid'];
$in_value=get_field('immagine_esterna',$update_id);
$fileexact=substr($in_value, 0, strlen($in_value)-4);
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
					<?php the_content(); ?>
					<div class="clear"></div>

	<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body"> 	
					<div id="map" style="width: 100%px; height: 670px"></div>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->

	

	<script src="http://leafletjs.com/dist/leaflet.js"></script>
	<script>
	<?php
$location = get_field('map',$update_id); // MANCA l'ID !!!
if( !empty($location) ):
$lat=$location['lat'];
$lng=$location['lng']; 
endif; // lat lng
?>
		var map = L.map('map').setView([<? echo $lat; ?>, <? echo $lng; ?>], 13);

		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);


L.marker([<? echo $lat; ?>, <? echo $lng; ?>]).addTo(map)
    .bindPopup('<img src="../thumb/<?php echo $fileexact;?>_200x200.jpg" width="200">')
    .openPopup();

	</script>
	        <div class="col-sm-6">
				<div class="panel panel-default">
				<div class="panel-heading">
                  <h3 class="panel-title">Inserisci dettagli</h3>
                </div>
				<form method="POST"  style='padding:5px;'>
					<legend>Nome autore o nickname:</legend> <input  type="text" name="nome_autore" placeholder='Simon Red' value="" style='width:100%'>
					<legend>Profilo o sito web autore (URL):</legend> <input  type="text" name="url_autore" placeholder='http://mio.profilo.it' value="" style='width:100%'>
					<legend>Titolo fotografia:</legend> <input  type="text" name="note"  placeholder='Caratteristica veduta ...' value="" style='width:100%'>
					<legend>Licenza d'uso: <a href="http://creativecommons.org/choose/?lang=it" target='_blank'><i class="fa fa-question-circle"></i></a></legend>
					<select name="licenza" style='width:100%'>
						<optgroup label="Questa è una licenza Free Culture!">
						<option value="CC-BY">Attribuzione 4.0 Internazionale</option>
						<option value="CC-BY-SA">Attribuzione - Condividi allo stesso modo 4.0 Internazionale</option>
						</optgroup>
						<optgroup label="Questa non è una licenza Free Culture.">
						<option value="CC-BY-ND">Attribuzione - Non opere derivate 4.0 Internazionale</option>
						<option value="CC-BY-NC-SA">Attribuzione - Non commerciale - Condividi allo stesso modo 4.0 Internazionale</option>
						<option value="CC-BY-NC-ND">Attribuzione - Non commerciale - Non opere derivate 4.0 Internazionale</option>
						</optgroup>
					</select>
					<fieldset style='margin-bottom:10px;'>
					<legend>Opera prorpia:</legend>
						Opera propria <input type="radio" name="tipo_opera" value="opera_propria"/> - 
						Opera derivata <input type="radio" name="tipo_opera" value="opera_derivata"/>
					</fieldset>					
					<fieldset>
					<legend>Assegna una categoria:</legend>
						Ed. Religioso <input type="radio" name="tipo_poi" value="ed-religioso"/> - 
						Ed. Storico <input type="radio" name="tipo_poi" value="ed-storico"/> - 
						Punto oss. <input type="radio" name="tipo_poi" value="punto-oss"/> - 
						Info <input type="radio" name="tipo_poi" value="info"/> - 
						Arc. Industriale <input type="radio" name="tipo_poi" value="arc_industriale"/><br /> 
						Centro storico <input type="radio" name="tipo_poi" value="centro_storico"/> - 
						Fontana <input type="radio" name="tipo_poi" value="fontana"/> - 
						Museo <input type="radio" name="tipo_poi" value="museo"/> - 
						Int. paesagg. <input type="radio" name="tipo_poi" value="interesse_paesaggistico"/> - 
						Pic nic <input type="radio" name="tipo_poi" value="picnic"/><br /> 
						Teatro <input type="radio" name="tipo_poi" value="teatro"/> - 
						Ed. civile <input type="radio" name="tipo_poi" value="ed_civile"/> - 
						Infernot <input type="radio" name="tipo_poi" value="infernot"/> - 
						Giardino <input type="radio" name="tipo_poi" value="giardino"/>
					</fieldset>
					<div style="text-align:center;"><input type="submit" name="submit" value="Invia il tuo post" class="btn btn-primary btn-lg" style='margin-top:15px;margin-bottom:8px;'></div>
				</form>
        	</div>
        </div><!-- /.col-sm-4 -->
    </div> 	            
<?php 
if(isset($_POST['submit']))
    {
		global $wpdb;

		//add_post_meta( $update_id, $field_key, $location );
		add_post_meta( $update_id, 'titolo_opera',$_POST['note']);
		add_post_meta( $update_id, 'nome_autore',$_POST['nome_autore']);
		add_post_meta( $update_id, 'url_autore',$_POST['url_autore']);
		add_post_meta( $update_id, 'licenza',$_POST['licenza']);
		add_post_meta( $update_id, 'tipo_opera',$_POST['tipo_opera']);
		add_post_meta( $update_id, 'tipo',$_POST['tipo_poi']);
		echo "
		<meta http-equiv='refresh' content='0;url=?page_id=10408&new_postid=$update_id'>
		";
    }
?>            
				</div>
			</article>
		</div><!--/content-part-->

<?php endwhile; ?>
        

		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer();

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
 ?>