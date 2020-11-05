<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<!-- EXTRA START -->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!-- qgis2leaf -->
		<link rel="stylesheet" type="text/css" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/own_style_full.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
		<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.css" />
		<link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
		<link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />

		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
		<script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
		<script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>
	<!-- /qgis2leaf -->

	<script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
	<script src="http://www.cityplanner.it/experiment_host/php/leaflet_custom_libraries/leaflet-google_fixindex.js" class="_iub_cs_activate"></script>

	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>

	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">
	<link rel="stylesheet" href="http://watson.lennardvoogdt.nl/Leaflet.awesome-markers/dist/leaflet.awesome-markers.css">
	<script src="http://watson.lennardvoogdt.nl/Leaflet.awesome-markers/dist/leaflet.awesome-markers.js"></script>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.js"></script>
	<link rel="stylesheet" href="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.css" />

<!-- https://github.com/bbecquet/Leaflet.PolylineDecorator/blob/master/example/example.html -->
	<script src="http://www.cityplanner.it/experiment_host/php/Leaflet.PolylineDecorator-master/src/L.LineUtil.PolylineDecorator.js"></script>
	<script src="http://www.cityplanner.it/experiment_host/php/Leaflet.PolylineDecorator-master/src/L.RotatedMarker.js"></script>
	<script src="http://www.cityplanner.it/experiment_host/php/Leaflet.PolylineDecorator-master/src/L.Symbol.js"></script>
	<script src="http://www.cityplanner.it/experiment_host/php/Leaflet.PolylineDecorator-master/src/L.PolylineDecorator.js"></script>

  <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
  <script src="http://www.cityplanner.it/experiment_host/php/leaflet_custom_libraries/leaflet-google_fixindex.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

</head>
<body>
