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
<!-- EXTRA END -->

<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->
<!--wp_head START-->
<?php wp_head();
//        <link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>
//        <link rel='stylesheet' href='http://openlayers.org/dev/examples/style.css' type='text/css'>
?>
<!--wp_head STOP--> 
<?php /* OSM */ ?>
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->
        <link rel='stylesheet' href='http://www.monferratopaesaggi.it/php/openlayers-master/theme/default/style.css' type='text/css'>
        <!--<script src='http://openlayers.org/dev/OpenLayers.js'></script>-->
        <script src='http://www.monferratopaesaggi.it/php/openlayers-master/lib/OpenLayers.js'></script>
        <script src='http://maps.google.com/maps/api/js?v=3&amp;sensor=false'></script> 
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->


        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>
        <script src='http://openlayers.org/dev/OpenLayers.js'></script>-->
        <style>
            #map{
                width: 100%;
                height: 500px;
                border: 0px solid #000;
            }
            body{margin:0px;}
        </style>
<style>
hgroup,
nav,
h1 {
  display: table-cell;
  vertical-align: middle;
}
</style>
<?php
$postid = get_the_ID();
get_metaimage($postid);
?>
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