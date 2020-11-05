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
<?php 
//wp_head();
//        <link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>
//        <link rel='stylesheet' href='http://openlayers.org/dev/examples/style.css' type='text/css'>
?>

<?php
//echo "<title>$title - Monferrato Paesaggi</title>";
$postid = get_the_ID();
get_metaimage($postid);
?>

<link rel="alternate" type="application/rss+xml" title="Monferrato Paesaggi &raquo; Feed" href="http://www.monferratopaesaggi.it/?feed=rss2" />
<link rel="alternate" type="application/rss+xml" title="Monferrato Paesaggi &raquo; Feed dei commenti" href="http://www.monferratopaesaggi.it/?feed=comments-rss2" />

            <script type="text/javascript">//<![CDATA[
            // Google Analytics for WordPress by Yoast v4.3.5 | http://yoast.com/wordpress/google-analytics/
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-49258953-1']);
                    _gaq.push(['_trackPageview']);
            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
            //]]></script>
      <link rel="alternate" type="application/rss+xml" title="Monferrato Paesaggi &raquo; Palazzo Gozzani di Treville Feed dei commenti" href="http://www.monferratopaesaggi.it/?feed=rss2&#038;p=6241" />
<link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.4'  media='all' />
<link rel='stylesheet' id='dashicons-css'  href='http://www.monferratopaesaggi.it/wp-includes/css/dashicons.min.css?ver=3.8.4'  media='all' />
<link rel='stylesheet' id='admin-bar-css'  href='http://www.monferratopaesaggi.it/wp-includes/css/admin-bar.min.css?ver=3.8.4'  media='all' />
<link rel='stylesheet' id='boxes-css'  href='http://www.monferratopaesaggi.it/wp-content/plugins/wordpress-seo/css/adminbar.min.css?ver=1.6.2'  media='all' />
<link rel='stylesheet' id='style-responsive-css'  href='http://www.monferratopaesaggi.it/wp-content/themes/intent15/style-responsive.css?ver=1.0'  media='all' />
<link rel='stylesheet' id='wpbandit-style-advanced-css'  href='http://www.monferratopaesaggi.it/wp-content/themes/intent15/style-advanced.css?ver=3.8.4'  media='all' />
<link rel='stylesheet' id='wpbandit-custom-css'  href='http://www.monferratopaesaggi.it/wp-content/themes/intent15/custom.css?ver=1.0'  media='all' />
<script type='text/javascript' src='http://www.monferratopaesaggi.it/wp-includes/js/comment-reply.min.js?ver=3.8.4'></script>
<script type='text/javascript' src='http://www.monferratopaesaggi.it/wp-includes/js/jquery/jquery.js?ver=1.10.2'></script>
<script type='text/javascript' src='http://www.monferratopaesaggi.it/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.monferratopaesaggi.it/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.monferratopaesaggi.it/wp-includes/wlwmanifest.xml" /> 
<link rel='shortlink' href='http://www.monferratopaesaggi.it/?p=6241' />
<script>
window.onload=function(){
    var combo=document.getElementById('buffercode_option');
    combo.onchange=function(){
        if(this.value!='0') window.open(this.value, '_self');
    };
}; 
</script> <style type="text/css">
      .postTabs_divs{
  padding: 4px; 
}


.postTabs_titles{
  display:none; 
}

ul.postTabs
  {
  margin:0px 0px 1em !important;
  padding: 0.2em 1em 0.2em 20px !important;
  border-bottom: 1px solid #ccc !important;
  font-size: 11px;
  list-style-type: none !important;
  line-height:normal;
  text-align: left;
  display: block !important;
  background: none;
  }

ul.postTabs li
  { 
  display: inline !important;
  font-size: 11px;
  line-height:normal;
  background: none;
  padding: 0px;
  margin: 0px;
  }
  
ul.postTabs li:before{
content: none;  
}  
    
ul.postTabs li a
  {
  text-decoration: none;
  background: #f3f3f3;
  border: 1px solid #ccc  !important;
  padding: 0.2em 0.4em !important;
  color: #5b5b5b !important;
  outline:none; 
  cursor: pointer;
  
  }
  
ul.postTabs li.postTabs_curr a{
  border-bottom: 1px solid #fff  !important;
  background: #fff;
  color: #000000 !important;
  text-decoration: none;
  
  }

ul.postTabs li a:hover
  {
  color: #5b5b5b !important;
  background: #fff;
  text-decoration: none;
  
  }

.postTabsNavigation{
  display: block !important;
  overflow:hidden;
}

.postTabs_nav_next{
  float:right;
}

.postTabs_nav_prev{
  float:left;
}
  </style>
  <style>
#wpadminbar #wp-admin-bar-wpbandit .ab-icon { background: url(http://www.monferratopaesaggi.it/wp-content/themes/intent15/air/base/assets/img/adminbar-icon.png); }
#wpadminbar #wp-admin-bar-wpbandit.menupop.hover .ab-icon { background-position: 0 -16px; }
</style>
<link rel="shortcut icon" href="http://www.monferratopaesaggi.it/wp-content/uploads/favicon-150x150.png">
<meta name="robots" content="noodp,noydir">
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
  html { margin-top: 32px !important; }
  * html body { margin-top: 32px !important; }
  @media screen and ( max-width: 782px ) {
    html { margin-top: 46px !important; }
    * html body { margin-top: 46px !important; }
  }
</style>
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