<?php
/*
Template Name: PBLACK - creageojsperasscomuni
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
$myFile = "./geodata/geojsonperasscomuni.geojson";
$fh = fopen($myFile, 'w') or die("can't open file");
$myFileJS = "./geodata/geojsonperasscomuni.js";
$fhJS = fopen($myFileJS, 'w') or die("can't open file");

$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);
$stringDataJS = 'var exp_reg='.$stringData;
fwrite($fhJS, $stringDataJS);

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	$plink=get_permalink();
	$postid = get_the_ID();
	$location = get_field('map');
	if( !empty($location) ):
		$lat= $location['lat'];
		$lng=$location['lng']; 
	endif; // lat lng

	if ($lat==NULL){}
	else if ($lat==0){}
	else{
		$count_poi++;

		$stringData = ' { "geometry" : { "coordinates" : ['.$lng.',
		            '.$lat.' 
		              ],
		            "type" : "Point"
		          },
		        "properties" : { "wpid":"'.$postid.'","plink":"'.$plink.'"
		          },
		        "type" : "Feature"
		      }
		';
		if($count_poi==1){$comma='';}
		else {$comma=', ';}
		fwrite($fh, $comma.$stringData);
		fwrite($fhJS, $comma.$stringData);
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
fwrite($fhJS, $stringData);
fclose($fhJS);
?>

<?php

//crea JSON
$myFile_com = "./geodata/json_comuni.json";
$fh_com = fopen($myFile_com, 'w') or die("can't open file");

$stringData = '{ "features" : [ ';
fwrite($fh_com, $stringData);


$the_query = new WP_Query(array('posts_per_page' => -1, 'post_type' => 'portfolio'));

$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

	$plink=get_permalink();
	$postid = get_the_ID();
	$title = get_the_title();


	if ($lat==NULL){}
	else if ($lat==0){}
	else{
		$count_poi++;

		$stringData = ' {"properties" : { "wpid":"'.$postid.'","plink":"'.$plink.'","title":"'.$title.'"}}
		';
		if($count_poi==1){$comma='';}
		else {$comma=', ';}
		fwrite($fh_com, $comma.$stringData);
	}
endwhile;
// Reset Post Data
wp_reset_postdata();

$stringData = '
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fh_com, $stringData);
fclose($fh_com);
?>

	<!-- qgis2leaf -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/own_style.css">
    <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>
	<!-- /qgis2leaf -->
	

	<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->

	<?php $filegeojson='http://www.monferratopaesaggi.org/geodata/geojsonperasscomuni.geojson'; ?>
	<?php $filegeojson_js='http://www.monferratopaesaggi.org/geodata/geojsonperasscomuni.js'; ?>
	<script src='<?php echo $filegeojson_js; ?>'></script>

<script>

	var map = L.map('map', { zoomControl:true }).setView([45.094,8.275], 14);
	
	var basemap_0 = L.tileLayer('http://a.tiles.mapbox.com/v3/lyzidiamond.map-ietb6srb/{z}/{x}/{y}.png', { 
		attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
	});	
	basemap_0.addTo(map);	

	var layerOrder=new Array();
							
    var exp_regJSON = new L.geoJson(exp_reg,{
      pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
  			iconUrl: 'http://cityplanner.name/justintime/php/bootleaf-master/assets/img/star-3_green.png',          
            iconSize:     [24, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
            popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON
              						

var cluster_groupexp_regJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
	cluster_groupexp_regJSON.addLayer(exp_regJSON);
	cluster_groupexp_regJSON.addTo(map);
				
	var baseMaps = {
		'OSM Standard': basemap_0
	};

	L.control.layers(baseMaps,{"GeoJson <a href='<?php echo $filegeojson; ?>' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);



</script>	
		        	</div>
		        	<div class="clear"></div>
		    	</section><!--/#portfolio-->
		    </article>
    	</div><!--/content-->
        
    </div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>