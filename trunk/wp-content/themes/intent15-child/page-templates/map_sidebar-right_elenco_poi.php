<?php
/*
Template Name: MAP POI Sidebar Right
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
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
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
<?php
$my_returnpage=$_GET['my_returnpage'];
$percorso_id=$_GET['percorso_id'];
$return='1959';
$gid=$_GET['gid'];

// IFRAME 1
echo"
    <iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso_poi.php?gid=$gid&my_returnpage=$my_returnpage' width='100%' height='520px'>
    </iframe>
";
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
    <ul id='recentcomments'>";

$title= get_the_title($my_returnpage);

echo"<li class='recentcomments'>
<a href='http://www.monferratopaesaggi.org/?page_id=$my_returnpage'>torna al percorso</a><br />
$title
</li>";
echo"
    </ul></li>";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Geo tag</span></h3>
";

echo"
    <iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso_poi_dettaglio.php?idm=$percorso_id&gid=$gid&my_returnpage=$my_returnpage' width='100%' height='80px'>
    </iframe>
";
echo"
    </li>";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>POI navigation</span></h3>
";


echo"
    <iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso_poi_elenco.php?idm=$percorso_id&gid=$gid&my_returnpage=$my_returnpage' width='100%' height='80px'>
    </iframe>
";
echo"
    </li>";
echo"
    <hr>
    <a href='?page_id=2101&poi_page=$return&gid=$gid&my_returnpage=$my_returnpage'>MODIFICA</a>
    <hr>
";
    
?>
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>