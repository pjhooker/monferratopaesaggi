<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>
	<?php wp_head(); ?>
    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- qgis2leaf -->
  <link rel="stylesheet" href="http://danzel.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="http://danzel.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />

  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->

  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> <!-- this is the javascript file that does the magic-->

  <script src="http://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
  <!-- /qgis2leaf -->

	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>


  <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
  <script src="http://www.cityplanner.it/experiment_host/php/leaflet_custom_libraries/leaflet-google_fixindex.js"></script>
<style>
#map {
    height: 800px;
    width:100%;
}
</style>
</head>
<body>
