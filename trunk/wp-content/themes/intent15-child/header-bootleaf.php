<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo('charset'); ?>">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
  <title><?php wp_title(''); ?></title>

  <!--<link rel="profile" href="http://gmpg.org/xfn/11">-->
  <!--<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,600italic,600,400italic,300italic,300&subset=latin,latin-ext">
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->


<!-- This site is optimized with the Yoast WordPress SEO plugin v1.5.4.2 - https://yoast.com/wordpress/plugins/seo/ -->
<!-- Avviso per l'amministratore: questa pagina non mostra una meta descrizione perché non ne ha una, è necessario scriverla per questa pagina o andare in SEO -> Menu titoli e impostare un modello. -->
<link rel="canonical" href="http://www.cityplanner.it/bootleaf-1/" />
<meta property="og:locale" content="it_IT" />
<meta property="og:type" content="article" />
<meta property="og:title" content="BootLeaf (1) - City Planner" />
<meta property="og:url" content="http://www.cityplanner.it/bootleaf-1/" />
<meta property="og:site_name" content="City Planner" />
<!-- / Yoast WordPress SEO plugin. -->

<link rel="alternate" type="application/rss+xml" title="City Planner &raquo; Feed" href="http://www.cityplanner.it/feed/" />
<link rel="alternate" type="application/rss+xml" title="City Planner &raquo; Feed dei commenti" href="http://www.cityplanner.it/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="City Planner &raquo; BootLeaf (1) Feed dei commenti" href="http://www.cityplanner.it/bootleaf-1/feed/" />
<!-- jQuery Core & UI-->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> <!-- this is the javascript file that does the magic-->
<script type="text/javascript">

  jQuery(document).ready(function(e) {
    jQuery('a').click(function(e) {
    var $this = jQuery(this);
        var href = $this.prop('href').split('?')[0];
    var ext = href.split('.').pop();
    if ('xls,xlsx,doc,docx,ppt,pot,pptx,pdf,pub,txt,zip,rar,tar,7z,exe,wma,mov,avi,wmv,wav,mp3,midi,csv,tsv,jar,psd,pdn,ai,pez,wwf'.split(',').indexOf(ext) !== -1) {
        ga('send', 'event', 'Download', ext, href);
      }
    if (href.toLowerCase().indexOf('mailto:') === 0) {
        ga('send', 'event', 'Mailto', href.substr(7));
      }
      if ((this.protocol === 'http:' || this.protocol === 'https:') && this.hostname.indexOf(document.location.hostname) === -1) {
        ga('send', 'event', 'Outbound', this.hostname, this.pathname);
      }
  });
});

</script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css">
    <link rel="stylesheet" href="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.24.0/L.Control.Locate.css">
    <link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/leaflet-sidebar-0.1.5/L.Control.Sidebar.css">
    <link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/css/app.css">

    <link rel="apple-touch-icon" sizes="76x76" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/img/favicon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/img/favicon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/img/favicon-152.png">
    <link rel="icon" sizes="196x196" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/img/favicon-196.png">
    <link rel="shortcut icon" sizes="196x196" href="http://www.cityplanner.it/experiment_host/php/bootleaf-master/assets/img/favicon-196.png">

</head><!--/head-->

<?php
/*<body <?php body_class(); ?> onload='init()'>*/
?>
  <body>


<?php
/*

  <?php if(zee_option('zee_theme_layout')=='boxed'){ ?>
    <div id="boxed">
  <?php } ?>

  <header id="header" class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only"><?php _e('Toggle navigation', ZEETEXTDOMAIN); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php logo();?>
      </div>

      <div class="hidden-xs">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location'  => 'primary',
            'container'       => false,
            'menu_class'      => 'nav navbar-nav navbar-main',
            'fallback_cb'     => 'wp_page_menu',
            'walker'          => new wp_bootstrap_navwalker()
            )
          );
        }
        ?>
      </div>

      <div id="mobile-menu" class="visible-xs">
        <div class="collapse navbar-collapse">
          <?php
          if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array(
              'theme_location'  => 'primary',
              'container'       => false,
              'menu_class'      => 'nav navbar-nav',
              'fallback_cb'     => 'wp_page_menu',
              'walker'          => new wp_bootstrap_mobile_navwalker()
              )
            );
          }
          ?>
        </div>
      </div><!--/.visible-xs-->
    </div>
  </header><!--/#header-->

  <?php
  //BARRA VERDE
  //get_template_part( 'sub', 'title' );
  ?>

  <?php if( ! is_page() ) { ?>
  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div id="primary" class="content-area">
            <?php } ?>

*/
?>
