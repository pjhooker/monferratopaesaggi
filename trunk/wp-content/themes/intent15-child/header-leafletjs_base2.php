<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php wp_title(''); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,600italic,600,400italic,300italic,300&subset=latin,latin-ext">
<!-- Bootstrap core CSS -->
<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://danzel.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="http://www.monferratopaesaggi.org/MarkerCluster.Default.Monferrato.css" />

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

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->

<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
<script src="http://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>

<script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
<script src="http://www.cityplanner.it/experiment_host/php/leaflet_custom_libraries/leaflet-google_fixindex.js"></script>
<!-- EXTRA END -->

<?php wp_head(); ?>


<style>

hgroup,
nav,
h1 {
  display: table-cell;
  vertical-align: middle;
}
#map {
    height: 600px;
    width:100%;
}
</style>

</head>

<body <?php body_class(); ?> onload='init()'>

<div id="wrap">


    <header  id="header">
    	<div id="header-inner" class="container fix">
  <hgroup>
			<?php echo wpb_site_name(); ?>
			<?php echo wpb_site_desc(); ?>
  </hgroup>
  <nav>
  			<div id="header-search" class="fix">
			<?php if(!wpb_option('disable-search')): ?>

				<?php get_search_form(); ?>

			<?php endif; ?>

                <?php /*echo wpb_social_media_links(array('id'=>'header-social')); */?>
            </div>
  </nav>
  <div>
  			<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'wpb-nav-header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>
			<?php if ( wpb_breadcrumbs_enabled() ): ?>
				<div id="header-breadcrumbs">
					<?php echo wpb_breadcrumbs(); ?>
				</div>
			<?php endif; ?>
            </div></div>
</header>
