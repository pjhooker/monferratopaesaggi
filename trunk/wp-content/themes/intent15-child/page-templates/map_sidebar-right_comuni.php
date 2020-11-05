<?php
/*
Template Name: MAP Elenco comuni
*/
?>
<?php acf_form_head(); ?>
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

<style>

/* Wrapper */
.icon-button {
	background-color: #e2e2e2;
	border-radius: 3.6rem;
	cursor: pointer;
	display: inline-block;
	font-size: 2.0rem;
	height: 3.6rem;
	line-height: 3.6rem;
	margin: 0 5px;
	position: relative;
	text-align: center;
	-webkit-user-select: none;
	   -moz-user-select: none;
	    -ms-user-select: none;
	        user-select: none;
	width: 7rem;
}

/* Circle */
.icon-button span {
	border-radius: 0;
	display: block;
	height: 0;
	left: 50%;
	margin: 0;
	position: absolute;
	top: 50%;
	-webkit-transition: all 0.3s;
	   -moz-transition: all 0.3s;
	     -o-transition: all 0.3s;
	        transition: all 0.3s;
	width: 0;
}
.icon-button:hover span {
	width: 7rem;
	height: 3.6rem;
	border-radius: 3.6rem;
	margin-top: -1.8rem;
    margin-left: -3.5rem;
}
.twitter span {
	background-color: #4099ff;
}
.facebook span {
	background-color: #3B5998;
}
.google-plus span {
	background-color: #db5a3c;
}

/* Icons */
.icon-button i {
	background: none;
	color: white;
	height: 3.6rem;
	left: 25px;
	line-height: 1rem;
	position: absolute;
	top: 15px;
	-webkit-transition: all 0.3s;
	   -moz-transition: all 0.3s;
	     -o-transition: all 0.3s;
	        transition: all 0.3s;
	width: 3.6rem;
	z-index: 10;
}
.icon-button .icon-twitter {
	color: #4099ff;
    font-size:10px;
}
.icon-button .icon-facebook {
	color: #3B5998;
    font-size:10px;
}
.icon-button .icon-google-plus {
	color: #db5a3c;
    font-size:10px;
}
.icon-button:hover .icon-twitter,
.icon-button:hover .icon-facebook,
.icon-button:hover .icon-google-plus {
	color: white;
}
</style>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
<div id="wrap">
	
	<header id="header">
		<div id="header-inner" class="container fix">
			<?php echo wpb_site_name(); ?>
			<?php echo wpb_site_desc(); ?>
			
			<?php if(!wpb_option('disable-search')): ?>
			<div id="header-search" class="fix">
				<?php get_search_form(); ?>
			</div>
			<?php endif; ?>

			<?php echo wpb_social_media_links(array('id'=>'header-social')); ?>
			
			<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'wpb-nav-header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>
			
			<?php if ( wpb_breadcrumbs_enabled() ): ?>
				<div id="header-breadcrumbs">
					<?php echo wpb_breadcrumbs(); ?>
				</div>
			<?php endif; ?>
		</div>
	</header><!--/header-->
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h1><?php echo wpb_page_title(); ?></h1>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text" style="text-align:center;">
					<?php the_content(); ?>
					<div class="clear"></div>


<?php
// Imposta gli oggetti richiesti
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1));

// Ottiene la pagina come oggetto
$portfolio =  get_page('2022');

// Filtra tutte le pagine e trova i figli di Portfolio
$portfolio_children = get_page_children( $portfolio->ID, $all_wp_pages );

$pages = $portfolio_children; 

$i=0;
foreach ( $pages as $page) {
    $i++;
	$title = $page->post_title;
    $guid = $page->guid;
    $id = $page->ID;
    $id_finto=1951;
    if ($i==1) {echo "<a href='?page_id=$id' class='icon-button twitter'><i class='icon-twitter'>$title</i><span></span></a>";}
    else if ($i==2) {echo "<a href='?page_id=$id' class='icon-button facebook'><i class='icon-facebook'>$title</i><span></span></a>";}
    else if ($i==3) {echo "<a href='?page_id=$id' class='icon-button google-plus'><i class='icon-google-plus'>$title</i><span></span></a>";$i=0;}
    else{}
}


?>


					<div class="clear"></div>
				</div>
			</article>

			<?php comments_template(); ?>
		</div><!--/content-part-->

<?php endwhile; ?>
		
		<div id="sidebar" class="sidebar-right">
        <?php
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Elenco POI</span></h3>
";
echo"Elenco";
echo"
    </li><br />";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Servizi e ospitalità</span></h3>
";
echo"Lorem ipsum";
echo"
    </li><br />";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Link</span></h3>
";
echo"Lorem ipsum";
echo"
    </li><br />";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Banner pubblicitari</span></h3>
";
echo"Lorem ipsum";
echo"
    </li><br />";
?>
			<?php /*get_sidebar();*/ ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>