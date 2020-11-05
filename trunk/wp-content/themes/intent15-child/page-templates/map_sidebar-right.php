<?php
/*
Template Name: MAP Sidebar Right
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<?php /*
<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h1><?php echo wpb_page_title(); ?></h1>
	</div><!--/page-title-inner-->
</div><!--/page-title-->
*/?>


<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
<?php

?>
					<div class="clear"></div>
				</div>
			</article>

			<?php comments_template(); ?>
		</div><!--/content-part-->

<?php endwhile; ?>
		
		
        
<?php

echo'<div id="sidebar" class="sidebar-right">';
echo"<h3 class='widget-title'><span>Elenco percorsi</span></h3>";
// Imposta gli oggetti richiesti
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1));

// Ottiene la pagina come oggetto
$portfolio =  get_page('1951');

// Filtra tutte le pagine e trova i figli di Portfolio
$portfolio_children = get_page_children( $portfolio->ID, $all_wp_pages );

$pages = $portfolio_children; 
echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
    <ul id='recentcomments'>";
foreach ( $pages as $page) {
	$title = $page->post_title;
    $guid = $page->guid;
    $id = $page->ID;
    $id_finto=1951;
    echo "
<li class='recentcomments'>
<a href='http://www.monferratopaesaggi.it/?page_id=$id' rel='external nofollow' class='url'>$title<br /></a>
</li>
";
}
echo"
    </ul></li><br />";


//echo '<div><hr /><pre>' . print_r( $portfolio_children, true ) . '</pre></div';

get_sidebar(); 
echo '		</div><!--/sidebar-->';
?>
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>