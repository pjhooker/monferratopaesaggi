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
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->
<!-- qgis2leaf -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
  <link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.css" />
  <link rel="stylesheet" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
  <link rel="stylesheet" type="text/css" href="http://cityplanner.name/justintime/php/qgis2leaf/main_map/css/own_style.css">
  <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
  <script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script>
  <script src="http://cityplanner.name/justintime/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>

  <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
  <script src="http://www.cityplanner.it/experiment_host/php/leaflet_custom_libraries/leaflet-google_fixindex.js"></script>
<!-- /qgis2leaf -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- font-awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrap">

  <header  id="header">
    <div id="header-inner" class="container fix">
      <hgroup>
      	<?php echo wpb_site_name(); ?>
      	<?php echo wpb_site_desc(); ?>
      </hgroup>
      <nav>
        <div id="header-search" class="fix" style="margin-top: -150px;">
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
      </div>
    </div>
  </header>
