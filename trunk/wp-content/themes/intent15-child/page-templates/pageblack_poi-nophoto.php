<?php
/*
Template Name: PAGEBLACK - poi-nophoto
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
				                <th>Comune</th>
				                <th>POI</th>
				              </tr>
				            </thead>
				            <tbody>

<?php

//crea JSON
$myFile = "geodata/poi_nofoto.geojson";
$fh = fopen($myFile, 'w') or die("can't open file");

$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);

//crea JSON(js exp_poinonimportante.js)
$myFileJS1 = "geodata/exp_poinonimportante.js";
$fhJS1 = fopen($myFileJS1, 'w') or die("can't open file");

$stringDataJS1 = 'exp_poinonimportante = {
"type": "FeatureCollection",
"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                                                                                
"features": [';
fwrite($fhJS1, $stringDataJS1);

//crea JSON(js exp_poinonimportante.js)
$myFileJS2 = "geodata/exp_poiimportante.js";
$fhJS2 = fopen($myFileJS2, 'w') or die("can't open file");

$stringDataJS2 = 'exp_poiimportante = {
"type": "FeatureCollection",
"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                                                                                
"features": [';
fwrite($fhJS2, $stringDataJS2);

// THE_QUERY
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

	// prende le coordinate dal meta 'map'
	$location = get_field('map');
	if( !empty($location) ):
		$lat= $location['lat'];
		$lng=$location['lng']; 
	endif; // lat lng

if (substr($url_image, 0, 4)=='http') {
}
else {
$count++;
echo"              
	<tr>
	    <td>$count</td>
	    <td style='text-align:left;'>$comune</td>
	    <td style='text-align:left;'><a href='$plink'>$title</a></td>
  	</tr>
";



$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$tipo='none';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/vuoto.png';}
else if ($tipo=='ed-religioso'){$tipo='edreligioso';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/chiesa.png';}
else if ($tipo=='ed-storico'){$tipo='edstorico';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/ed_storico.png';}
else if ($tipo=='punto-oss'){$tipo='puntooss';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/punto_panoramico.png';}
else if ($tipo=='parcheggio'){$tipo='parcheggio';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/parcheggio.png';}
else if ($tipo=='info'){$tipo='info';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/info.png';}
else if ($tipo=='arc_industriale'){$tipo='arc_industriale';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/arch_industriale.png';}
else if ($tipo=='centro_storico'){$tipo='centro_storico';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/centro_storico.png';}
else if ($tipo=='fontana'){$tipo='fontana';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/fontana.png';}
else if ($tipo=='museo'){$tipo='museo';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/museo.png';}
else if ($tipo=='wc'){$tipo='wc';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/wc.png';}
else if ($tipo=='interesse_paesaggistico'){$tipo='interesse_paesaggistico';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/interesse_paesaggistico.png';}
else if ($tipo=='picnic'){$tipo='picnic';       $iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/pic-nic.png';}
else if ($tipo=='teatro'){$tipo='teatro';       $iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/teatro.png';}
else if ($tipo=='ed_civile'){$tipo='ed_civile'; $iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/edificio-civile.png';}
else if ($tipo=='infernot'){$tipo='infernot';   $iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/infenot.png';}
else if ($tipo=='giardino'){$tipo='giardino';   $iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/parco-giardino.png';;}
else {$tipo='none';$iconurl='http://www.monferratopaesaggi.it/wp-content/uploads/vuoto.png';}

if ($count==1) {$comma='';}
else {$comma=', ';}

$stringData = $comma.' { "geometry" : { "coordinates" : ['.$lng.','.$lat.' ],"type" : "Point"},
        "properties" : { "unico":"'.$postid.'", "titolo":"'.$title.'","url_post":"'.$plink.'","tipo":"'.$tipo.'",
            "wpid_comune":"'.$id_comune.'","comune":"'.$comune.'","icon_exp" : "'.$iconurl.'" 
        },
        "type" : "Feature"
      }
';
fwrite($fh, $stringData);

	if ($tipo=='wc' OR $tipo=='parcheggio' OR $tipo=='fontana'){
		$countJS1++;
		if ($countJS1==1) {$commaJS1='';}
		else {$commaJS1=', ';}
		$stringDataJS1 = $commaJS1.'{ "type": "Feature", "properties": { 
				"color_qgis2leaf": "#c783d8", "radius_qgis2leaf": 4.0, "borderColor_qgis2leaf": "#000000", 
				"transp_qgis2leaf": 1.0, "transp_fill_qgis2leaf": 1.0, "unico": "'.$postid.'", 
				"titolo": "'.$title.'", "url_post": "'.$plink.'", 
				"tipo": "'.$tipo.'", "wpid_comun": "'.$id_comune.'", "comune": "'.$comune.'", 
				"icon_exp": "'.$iconurl.'" 
			}, "geometry": { "type": "Point", "coordinates": [ '.$lng.', '.$lat.' ] } }
		';
		fwrite($fhJS1, $stringDataJS1);
	}
	else{
		$countJS2++;
		if ($countJS2==1) {$commaJS2='';}
		else {$commaJS2=', ';}		
		$stringDataJS2 = $commaJS2.'{ "type": "Feature", "properties": { 
				"color_qgis2leaf": "#c783d8", "radius_qgis2leaf": 4.0, "borderColor_qgis2leaf": "#000000", 
				"transp_qgis2leaf": 1.0, "transp_fill_qgis2leaf": 1.0, "unico": "'.$postid.'", 
				"titolo": "'.$title.'", "url_post": "'.$plink.'", 
				"tipo": "'.$tipo.'", "wpid_comun": "'.$id_comune.'", "comune": "'.$comune.'", 
				"icon_exp": "'.$iconurl.'" 
			}, "geometry": { "type": "Point", "coordinates": [ '.$lng.', '.$lat.' ] } }
		';
		fwrite($fhJS2, $stringDataJS2);
	}
}

endwhile;
// Reset Post Data
wp_reset_postdata();

$stringData = '
]
}
';
fwrite($fh, $stringData);
fclose($fh);

$stringDataJS1 = '
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fhJS1, $stringDataJS1);
fclose($fhJS1);

$stringDataJS2 = '
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fhJS2, $stringDataJS2);
fclose($fhJS2);


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
