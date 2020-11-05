<?php
/*
Template Name: PBLACK - MAppa elementi OSM
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
        

<?php

//crea JSON
$myFile = "./geodata/osm_element.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$myFile2 = "./geodata/osm_element_ok.json";
$fh2 = fopen($myFile2, 'w') or die("can't open file");

$stringData = 'var exp_reg={ "features" : [ ';
fwrite($fh, $stringData);
$stringData = 'var exp_reg_ok={ "features" : [ ';
fwrite($fh2, $stringData);

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


// prende le coordinate dal meta 'map'
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

$tipo = get_field('field_53524fd43715d');
if ($tipo=='blue'){$tipo='none';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/vuoto.png';$tipoIcon='wht_blank';}
else if ($tipo=='ed-religioso'){$tipo='edreligioso';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/chiesa.png';$tipoIcon='grn_stars';}
else if ($tipo=='ed-storico'){$tipo='edstorico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/ed_storico.png';$tipoIcon='ltblu_stars';}
else if ($tipo=='punto-oss'){$tipo='puntooss';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/punto_panoramico.png';$tipoIcon='binoculars';}
else if ($tipo=='parcheggio'){$tipo='parcheggio';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/parcheggio.png';$tipoIcon='';}
else if ($tipo=='info'){$tipo='info';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/info.png';$tipoIcon='parking_lot';}
else if ($tipo=='arc_industriale'){$tipo='arc_industriale';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/arch_industriale.png';$tipoIcon='orange_stars';}
else if ($tipo=='centro_storico'){$tipo='centro_storico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/centro_storico.png';$tipoIcon='pink_stars';}
else if ($tipo=='fontana'){$tipo='fontana';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/fontana.png';$tipoIcon='measle_turquoise';}
else if ($tipo=='museo'){$tipo='museo';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/museo.png';$tipoIcon='purple_stars';}
else if ($tipo=='wc'){$tipo='wc';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/wc.png';$tipoIcon='toilets';}
else if ($tipo=='interesse_paesaggistico'){$tipo='interesse_paesaggistico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/interesse_paesaggistico.png';$tipoIcon='red_stars';}
else if ($tipo=='picnic'){$tipo='picnic';       $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/pic-nic.png';$tipoIcon='campfire';}
else if ($tipo=='teatro'){$tipo='teatro';       $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/teatro.png';$tipoIcon='wht_stars';}
else if ($tipo=='ed_civile'){$tipo='ed_civile'; $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/edificio-civile.png';$tipoIcon='ylw_stars';}
else if ($tipo=='infernot'){$tipo='infernot';   $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/infenot.png';$tipoIcon='capital_small_highlight';}
else if ($tipo=='giardino'){$tipo='giardino';   $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/parco-giardino.png';$tipoIcon='parks';}

if (substr($url_image, 0, 4)=='http') {} else {}
if ($wiki_id==NULL) {} else {}

if ($osm_id==NULL) {$osm='none';} else {$osm=$osm_id;}

if ($lat==NULL){}
else if ($lat==0){}
else{
	$count_poi++;

	$stringData = ' { "geometry" : { "coordinates" : ['.$lng.',
	            '.$lat.' 
	              ],
	            "type" : "Point"
	          },
	        "properties" : { "progressiv" : "'.$count_poi.'",  "unico":"'.$postid.'", "titolo":"'.$title.'","url_post":"'.$plink.'","tipo":"'.$tipo.'","icon_exp":"'.$iconurl.'","osm":"'.$osm.'"
	          },
	        "type" : "Feature"
	      }
	';
	if ($osm_id==NULL) {
		$count_poi1++;
		if($count_poi1==1){$comma1='';}
		else {$comma1=', ';}
		fwrite($fh, $comma1.$stringData);
	} 
	else {
		$count_poi2++;
		if($count_poi2==1){$comma2='';}
		else {$comma2=', ';}		
		fwrite($fh2, $comma2.$stringData);
	}
	
}

endwhile;
// Reset Post Data
wp_reset_postdata();

$stringData = '
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fh, $stringData);
fclose($fh);
fwrite($fh2, $stringData);
fclose($fh2);

?>
	<!-- qgis2leaf -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/own_style.css">
    <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/Autolinker.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/leaflet-hash.js"></script>
	<script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
	<script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>
	<!-- /qgis2leaf -->
	

	<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->


	<script src='http://www.monferratopaesaggi.org/geodata/osm_element.json'></script>
	<script src='http://www.monferratopaesaggi.org/geodata/osm_element_ok.json'></script>

<script>

	var map = L.map('map', { zoomControl:true }).setView([45.094,8.275], 14);
	var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	var raster_group = new L.LayerGroup([]);
	
	var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
		attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
	});	
	basemap_0.addTo(map);	
	
	var layerOrder=new Array();
							
	function pop_reg(feature, layer) {
	

		// l'elenco delle colonne è generato tramite un array di acf							
		var popupContent = '<table style="width:300px;">'
				    	+ '<tr><th scope="row"><a href="'
				    	+ feature.properties.url_post
				    	+ '">LINK</a></th><td><a href="' 
	    		    	+ feature.properties.osm 
	    		    	+ '">OSM</a></td></tr>'
				    	+ '<tr><th scope="row">Coordinate</th><td><a href="http://www.openstreetmap.org/#map=17/'
	    		    	+ feature.geometry.coordinates[1] + '/' + feature.geometry.coordinates[0] 
	    		    	+ '">osm-map</td></tr>'	    		    	
						+ '</table>';
		layer.bindPopup(popupContent);

	}

function getIcon(osm,icon_exp) {
    return  osm === 'none'   ? icon_exp :
            'http://cityplanner.name/justintime/php/bootleaf-master/assets/img/star-3_green.png';           
}
	
    var exp_regJSON = new L.geoJson(exp_reg,{
      onEachFeature: pop_reg,
      pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
  			iconUrl: getIcon(feature.properties.osm,feature.properties.icon_exp),          
            iconSize:     [24, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
            popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON

    var exp_regJSON_ok = new L.geoJson(exp_reg_ok,{
      onEachFeature: pop_reg,
      pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
  			iconUrl: getIcon(feature.properties.osm,feature.properties.icon_exp),          
            iconSize:     [24, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
            popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    }).addTo(map);       //var exp_regJSON
              						

var cluster_groupexp_regJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
	cluster_groupexp_regJSON.addLayer(exp_regJSON);
	cluster_groupexp_regJSON.addTo(map);
				
	//add comment sign to hide this layer on the map in the initial view.
	exp_regJSON_ok.addTo(map);		

	var title = new L.Control();
	title.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
		this.update();
		return this._div;
    };
    title.update = function () {
		this._div.innerHTML = 'Mappa idranti'
	};
	title.addTo(map);

	var baseMaps = {
		'OSM Standard': basemap_0
	};

	L.control.layers(baseMaps,{"GeoJson <a href='' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);
	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);

</script>	
		        	</div>
		        	<div class="clear"></div>
		    	</section><!--/#portfolio-->
		    </article>
    	</div><!--/content-->
        
    </div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>