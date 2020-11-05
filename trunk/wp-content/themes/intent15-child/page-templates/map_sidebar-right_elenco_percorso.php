<?php
/*
Template Name: MAP Elenco percorso Sidebar Right
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
//$idframe=$_GET['gid'];//questo numero varia ed è da associare al frame
$page_id=$_GET['page_id'];
$percorso_id=$_GET['percorso_id'];

$key="mykey";
$lat = get_post_meta($post->ID, 'lat', true);
$lon = get_post_meta($post->ID, 'lon', true);
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&percorso_id=$percorso_id' width='100%' height='800px'></iframe>";
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&lat=$lat&lon=$lon' width='100%' height='520px'></iframe>";
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

        $return='1951';//la pagina dell'elenco dei percorsi rimane sempre la stessa e senza variabile
echo"<li class='recentcomments'>
<a href='http://www.monferratopaesaggi.org/?page_id=$return'>torna all'elenco percorsi</a>
</li>";
echo"
    </ul></li><br />";
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Elenco POI</span></h3>
";
echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso_elenco.php?gid=$page_id&mypage_id=$page_id' width='100%' height='200px'></iframe>";
echo"
    </li><br />";
?>
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>