<?php
/*
 * Template Name: Public FORM2
 *
 */
$update_id=$_GET['new_postid'];
$in_value=get_field('immagine_esterna',$update_id);
$fileexact=substr($in_value, 0, strlen($in_value)-4);
?>
<?php acf_form_head(); ?>
<?php get_header('osm-base'); ?>
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
        <div class="col-sm-2">

        </div><!-- /.col-sm-4 -->
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Seleziona il luogo dello scatto o il punto di ripresa</h3>
                </div>
                <div class="panel-body"> 	
					<div id="map" style="width: 100%; height: 500px"></div>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-2">
        </div><!-- /.col-sm-4 -->
    </div> 
	<script src="http://leafletjs.com/dist/leaflet.js"></script>

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />
	<script src="http://maps.google.com/maps/api/js?v=3&sensor=false"></script>
	<script src="http://www.monferratopaesaggi.org/php/leaflet-plugins-master/layer/tile/Google.js"></script>


	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/css/own_style.css">
    <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />	
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/js/Autolinker.min.js"></script>

	<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>--> <!-- this is the javascript file that does the magic-->
	<script src="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/js/leaflet-hash.js"></script>
	<script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
	<script src="http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/js/leaflet.markercluster.js"></script>

<script src='http://www.monferratopaesaggi.org/php/qgis2leaf/export_2014_11_04_11_16_07/data/exp_ptduomo.js'></script>

<script type='text/javascript'>
var map = new L.Map('map', {center: new L.LatLng(45.075086, 8.288518), zoom: 13});
var osm = new L.TileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-i875mjb7'
		});
var ggl = new L.Google('HYBRID');
var ggl2 = new L.Google('TERRAIN');
map.addLayer(ggl);
map.addControl(new L.Control.Layers( {'OSM':osm, 'Google Satellite':ggl, 'Google Terrain':ggl2}, {}));


	var hash = new L.Hash(map); //add hashes to html address to easy share locations
	var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	var raster_group = new L.LayerGroup([]);
	

	var layerOrder=new Array();
							function pop_ptduomo(feature, layer) {
										
	var popupContent = '<table><tr><th scope="row">id</th><td>' + Autolinker.link(String(feature.properties['id'])) + '</td></tr><tr><th scope="row">highway</th><td>' + Autolinker.link(String(feature.properties['highway'])) + '</td></tr></table>';
	layer.bindPopup(popupContent);


				}
						
				var exp_ptduomoJSON = new L.geoJson(exp_ptduomo,{
					onEachFeature: pop_ptduomo,
					pointToLayer: function (feature, latlng) {  
						return L.circleMarker(latlng, {
							radius: feature.properties.radius_qgis2leaf,
							fillColor: feature.properties.color_qgis2leaf,

							color: feature.properties.borderColor_qgis2leaf,
							weight: 1,
							opacity: feature.properties.transp_qgis2leaf,
							fillOpacity: feature.properties.transp_qgis2leaf
							})
						}
					});
				
				feature_group.addLayer(exp_ptduomoJSON);
				layerOrder[layerOrder.length] = exp_ptduomoJSON;
				for (index = 0; index < layerOrder.length; index++) {
					feature_group.removeLayer(layerOrder[index]);feature_group.addLayer(layerOrder[index]);
				}
				
						//add comment sign to hide this layer on the map in the initial view.
						exp_ptduomoJSON.addTo(map);

		var osmGeocoder = new L.Control.OSMGeocoder({
            collapsed: false,
            position: 'topright',
            text: 'Find!',
			});
		osmGeocoder.addTo(map);
		

		var popup = L.popup();
		function onMapClick(e) {
			var lat = (e.latlng.lat);
    		var lng = (e.latlng.lng);			
			popup
				.setLatLng(e.latlng)
				.setContent("<form method='POST'>"
					+"<img src='../../thumb/<?php echo $fileexact;?>_200x200.jpg' width='200'><br>"
					+"Latitudine: <input disabled='disabled' type='text' id='element1' name='val_latv' style='width:100%;' value="+ lat +"><input type='hidden' name='val_lat' value="+ lat +">"
					+"Longitudine: <input disabled='disabled' type='text' id='element2' name='val_lngv' style='width:100%;' value="+ lng +"><input type='hidden' name='val_lng' value="+ lng +">"
					+"<div style='text-align:center;padding:15px;'><input type='submit' name='submit' value='Continua' class='btn btn-primary btn-lg'></div></form>" 
					//+ e.latlng.toString()
					)
				.openOn(map);
		}
		map.on('click', onMapClick);


</script>
<?php /*
	<script>

		var map = L.map('map').setView([45.075086, 8.288518], 13);

		L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-i875mjb7'
		}).addTo(map);

		// add layer groups to layer switcher control
		var controlLayers = L.control.layers(baseLayers).addTo(map);

		var popup = L.popup();
		function onMapClick(e) {
			var lat = (e.latlng.lat);
    		var lng = (e.latlng.lng);			
			popup
				.setLatLng(e.latlng)
				.setContent("<form method='POST'>"
					+"<img src='thumb/<?php echo $fileexact;?>_200x200.jpg' width='200'><br>"
					+"Latitudine: <input disabled='disabled' type='text' id='element1' name='val_latv' style='width:100%;' value="+ lat +"><input type='hidden' name='val_lat' value="+ lat +">"
					+"Longitudine: <input disabled='disabled' type='text' id='element2' name='val_lngv' style='width:100%;' value="+ lng +"><input type='hidden' name='val_lng' value="+ lng +">"
					+"<div style='text-align:center;padding:15px;'><input type='submit' name='submit' value='Continua' class='btn btn-primary btn-lg'></div></form>" 
					//+ e.latlng.toString()
					)
				.openOn(map);
			//var marker = L.marker([lat, lng], {draggable:true}).addTo(map).bindPopup($('<a href="#clickmap">Remove ME</a>').click(function() { map.removeLayer(marker);     })[0]);

            //var changer = document.getElementById('element1');        
            //changer.value = lng;

		}
		map.on('click', onMapClick);

	</script>
	*/
	?>
<?php 
if(isset($_POST['submit']))
    {
		global $wpdb;
// Questo aggiunge un custom field MAPPA
    $lat=$_POST['val_lat'];
    $lng=$_POST['val_lng'];
    $location = array(
    'lat' => $lat,
    'lng' => $lng
    );

    $field_key = "map";	
	add_post_meta( $update_id, $field_key, $location );
		
		echo "
		<meta http-equiv='refresh' content='0;url=?page_id=10407&new_postid=$update_id'>
		";
    }
?>
				</div>
			</article>
		</div><!--/content-part-->

<?php endwhile; ?>
        

		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>