<!DOCTYPE html> 
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="full" lang="en"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title(''); ?></title>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,600italic,600,400italic,300italic,300&subset=latin,latin-ext">
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
get_metaimage_full($postid);
?>
    <!-- Bootstrap Core CSS -->
    <link href="http://www.cityplanner.it/php/the-big-picture/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://www.cityplanner.it/php/the-big-picture/css/the-big-picture_incontent.css" rel="stylesheet">

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
</script>
<link rel="shortcut icon" href="http://www.monferratopaesaggi.it/wp-content/uploads/favicon-150x150.png">
<meta name="robots" content="noodp,noydir">
<style type="text/css" media="print">#wpadminbar { display:none; }</style>

</head>

<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.monferratopaesaggi.it">Monferrato Paesaggi</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



