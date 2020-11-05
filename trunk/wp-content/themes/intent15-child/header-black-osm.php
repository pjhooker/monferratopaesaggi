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

<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->
<?
//php wp_head(); 
//        <link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>
//        <link rel='stylesheet' href='http://openlayers.org/dev/examples/style.css' type='text/css'>
?>
<?php /* OSM */ ?>
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->
        <!--<script src='http://openlayers.org/dev/OpenLayers.js'></script>-->
        <script src='http://www.monferratopaesaggi.org/php/openlayers-master/lib/OpenLayers.js'></script>
        <script src='http://maps.google.com/maps/api/js?v=3&amp;sensor=false'></script> 
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->




<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/blog/blog.css" rel="stylesheet">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://www.monferratopaesaggi.org/php/lightbox-master/dist/ekko-lightbox.css" rel="stylesheet">

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
<?php wp_head(); ?>

<?php /* OSM */ ?>
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->
        <link rel='stylesheet' href='http://www.monferratopaesaggi.org/php/openlayers-master/theme/default/style.css' type='text/css'>
        <!--<script src='http://openlayers.org/dev/OpenLayers.js'></script>-->
        <script src='http://www.monferratopaesaggi.org/php/openlayers-master/lib/OpenLayers.js'></script>
        <script src='http://maps.google.com/maps/api/js?v=3&amp;sensor=false'></script> 
        <!--<link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>-->


        <style>
            #map{
                width: 100%;
                height: 500px;
            }

        
<?php /* OSM */ ?>


hgroup,
nav,
h1 {
  display: table-cell;
  vertical-align: middle;
}
</style>

</head>

<?php
$postid = get_the_ID();
get_metaimage($postid);
?>
</head>

<body <?php body_class(); ?> onload='init()'>
	
<div id="wrap">

    
    <header  id="header">
  		<nav id="header-nav" class="fix">
            <ul id="nav" class="menu">
                <li id="menu-item-2193" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="?page_id=2191">Territorio</a></li>
                <li id="menu-item-7530" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="?page_id=7528">Paesaggio</a></li>
                <li id="menu-item-2253" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="?page_id=1951">Itinerari</a></li>
                <li id="menu-item-7531" class="menu-item menu-item-type-custom menu-item-object-custom1"><a href="?page_id=2197">COMUNI</a></li>
                <li id="menu-item-2122" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="?page_id=2120">Chi siamo</a></li>
                <li id="menu-item-2122" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="?page_id=10067">POI foto</a></li>
            </ul>
        </nav>
      </div></div>
    </header>