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

<!-- EXTRA START -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

<!-- EXTRA END -->
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
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->
<?php wp_head(); ?>
<style>
hgroup,
nav,
h1 {
  display: table-cell;
  vertical-align: middle;
}
</style>

</head>



<body <?php body_class(); ?>>

<div id="wrap">
    <header id="header">
    	<div id="header-inner" class="container fix">
    	<?php /*
	  	<hgroup class='hidden-xs hidden-sm'>
				<?php echo wpb_site_name(); ?>
				<?php echo wpb_site_desc(); ?>
	  	</hgroup>
	  	<nav>
	  		<div id="header-search" class="fix">
	            <?php
	            //echo wpb_social_media_links(array('id'=>'header-social'));
	            ?>
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
	    */
	    ?>
		<div class="row">
			<div class="col-md-8">
				<a href="http://www.monferratopaesaggi.org/">
					<img src="http://www.monferratopaesaggi.org/wp-content/uploads/logo-monf340x80_pos-1024x215.png" style="padding:25px;width:100%">
				</a>
			</div>
			<div class="col-md-4">
				<?php if(!wpb_option('disable-search')): ?>

					<?php get_search_form(); ?>

				<?php endif; ?>
				<br>
				<p style="text-align:right;"><a href="http://www.monferratopaesaggi.org/menzione-mibact/">
					<img src="http://www.monferratopaesaggi.org/wp-content/uploads/Menzione-MiBACT-1024x7261.jpg">
				</a></p>
			</div>
		</div>
		<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'wpb-nav-header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>
	</div>
</header>
<?php /*

	<header id="header">
		<div id="header-inner" class="container fix">
			<?php echo wpb_site_name(); ?>
			<?php echo wpb_site_desc(); ?>

			<?php if(!wpb_option('disable-search')): ?>
			<div id="header-search" class="fix">
				<?php get_search_form(); ?>
			</div>
			<?php endif; ?>

			<div id="header-search" class="fix">
                <?php echo wpb_social_media_links(array('id'=>'header-social')); ?>
            </div>

			<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'wpb-nav-header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>

			<?php if ( wpb_breadcrumbs_enabled() ): ?>
				<div id="header-breadcrumbs">
					<?php echo wpb_breadcrumbs(); ?>
				</div>
			<?php endif; ?>
		</div>
	</header><!--/header-->
    */ ?>
