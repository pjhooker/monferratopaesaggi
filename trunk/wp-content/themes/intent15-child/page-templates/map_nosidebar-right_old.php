<?php
/*
 * Template Name: MAP NO Sidebar Right OLD
 * Questo template è utilizzato dalla pagina ITINERARI:MAPPA
 * url ?page_id=1951
 *
 */

// Portfolio functions
$portfolio_functions = locate_template('functions-portfolio.php');
require ( $portfolio_functions );
?>
<style>
.text h2 {
    font-size: 30px;
    line-height: 1.1em;
    text-transform: none;
    margin-top: 20px;
	margin-bottom: 10px;
}
.text h1 {
    font-size: 36px;
    line-height: 1.1em;
    margin-top: 20px;
	margin-bottom: 10px;
}
</style>
<?php acf_form_head(); ?>
<?php get_header('osm-percorso'); ?>
<?php get_template_part('_page-image'); ?>



<?php while(have_posts()): the_post(); ?>


<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		<div id="content">

			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div>

                    <!-- <iframe style="line-height: 1.5em;" src="http://192.81.215.55/experiment192/php/monferrato/fm_elenco_percorsi.php" height="500" width="100%" frameborder="0"></iframe> -->

			        <ul class="tabs-nav fix">
			            <li><a href="<?php echo get_permalink(2251); ?>">Guida</a></li>
			            <li><a href="<?php echo get_permalink(7533); ?>">Accessi</a></li>
			            <li><a class="active"  href="<?php echo get_permalink(1951); ?>">Mappa</a></li>
			            <li><a href="<?php echo get_permalink(9124); ?>"><i class="fa fa-location-arrow"></i> <span>webAPP navigatore</span></a></li>
			        </ul>
					<div style="display: block;" id="tab-3" class="tab">
						<div class="tab-content">

<?php
// --- MAP --- START
?>
<?php

$lat=$_GET['lat'] ;
$lon=$_GET['lon'] ;
$content=get_the_content();
echo"
				            <div id='map'></div>
							<div style='padding-top:30px;'>$content</div>
							<div class='clear' style='padding-top:50px;'></div>
";

?>

<?php
if ($lat==NULL) {
$center_ln=8.295681;
$center_lt=45.105879;
$delta_ln=0.1;
$delta_lt=0.1;
}
else
{$center_ln=$lon;
$center_lt=$lat;
$delta_ln=0.005;
$delta_lt=0.005;
}



$SO_ln=$center_ln-$delta_ln;
$SO_lt=$center_lt-$delta_lt;
$NE_ln=$center_ln+$delta_ln;
$NE_lt=$center_lt+$delta_lt;
$bounds=$SO_ln . "," . $SO_lt . "," . $NE_ln . "," . $NE_lt;

$SO_ln=$center_ln-$delta_plus_ln;
$SO_lt=$center_lt-$delta_plus_lt;
$NE_ln=$center_ln+$delta_plus_ln;
$NE_lt=$center_lt+$delta_plus_lt;
$delta_plus_ln=0.02;
$delta_plus_lt=0.02;
$bounds_plus=$SO_ln . "," . $SO_lt . "," . $NE_ln . "," . $NE_lt;
$nord_it_extent=$bounds_plus;
?>
<style>
.olPopupContent{
    padding: 25px;
}
.olPopupContent,
.olFramedCloudPopupContent {
    background-color: #EDEDED;
    border:1px solid black;
}

</style>

<script type="text/javascript">
            var extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'),
            new OpenLayers.Projection('EPSG:900913'));
            var color1997 = <?php colore_percorso('1997') ?> ;
            var color1993 = <?php colore_percorso('1993') ?> ;
            var color1989 = <?php colore_percorso('1989') ?> ;
            var color1987 = <?php colore_percorso('1987') ?> ;
            var color1971 = <?php colore_percorso('1971') ?> ;
            var color1969 = <?php colore_percorso('1969') ?> ;
</script>

<script src='http://www.monferratopaesaggi.org/js/mappa_tutti_percorsi.js'></script>



<?php
// --- MAP --- STOP
?>


<?php

/* start portfolio like
*/
/*
?>



			<?php do_action('wpb_portfolio_javascript', wpb_meta('_portfolio_disable_categories'),
				wpb_meta('_portfolio_disable_switcher'), wpb_meta('_portfolio_lightbox')); ?>

				<div class="row" style='margin-right: 0px;margin-left: 0px;'>
        			<div class="col-sm-12">
						<?php $item_rel = wpb_meta('_portfolio_lightbox_gallery')?'rel="gallery"':''; ?>
						<?php $lightbox = wpb_meta('_portfolio_lightbox'); ?>



<?php
// elenco dei percorsi sotto la mappa


// Imposta gli oggetti richiesti
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1));

// Ottiene la pagina come oggetto
$portfolio =  get_page('1951');

// Filtra tutte le pagine e trova i figli di Portfolio
$portfolio_children = get_page_children( $portfolio->ID, $all_wp_pages );

$pages = $portfolio_children;
echo"
    <ul id='recentcomments'>";
foreach ( $pages as $page) {
    $title = $page->post_title;
    $guid = $page->guid;
    $id = $page->ID;
    $id_finto=1951;
    $link=get_permalink($id);

?>
    <?php $item_link = wpb_portfolio_link($lightbox); ?>
    					<div class="isotope-item grid one-third" style='width:31%;'>
							<article class="portfolio-item">

						<a class="portfolio-thumbnail" href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" <?php echo $item_rel; ?>>

							<?php if ( has_post_thumbnail($id) ): ?>
								<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($id),'portfolio-thumbnail-large');
								$pieces = explode("|", get_the_title($id));
								$title1= $pieces[0]; // piece1
								$title2= $pieces[1]; // piece2
								?>
								<img src="<?php echo $img[0]; ?>" alt="<?php the_title() ; ?>" />
							<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />
							<?php endif; ?>

							<?php if ( wpb_meta('_portfolio_video') ): ?><span class="play"></span><?php endif; ?>
							<span class="zoom"><i class="icon-zoom"></i></span>

						</a>

						<?php
                        $colore_percorso= get_field('colore_percorso',$id);
                        if( !wpb_option('hide-meta-portfolio') ): ?>
						<a class="button medium" style="margin:5px;background-color:<?php echo $colore_percorso;?>;color:#fff;text-shadow: 1px 1px #5b5b5b;" href="http://www.monferratopaesaggi.org/?page_id=<?php echo $id?>">
                                <?php echo $title1."<br>".$title2; ?>
							<span class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></span>
						</a>
						<?php endif; ?>

							</article>
						</div><!--/.isotope-item-->

<?php

}
echo"
    </ul>";
?>

				<?php wpb_reset_metadata(); ?>

						<div class="clear"></div>
					</div>
				</div><!--/#portfolio-->

<?php
*/
//STOP portofolio like
 ?>

<!-- SEZ.5 -->
<div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1997); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso PROFILI<br><i>Scorci di paesaggio antico</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1997' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/23.-Zoom-su-Grazzano-visto-da-Spiazzo-Madonna-dei-Monti-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1993); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso PO<br><i>Vedute tra Alpi e terre d’acqua</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1993' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/fotofiumepo-003-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1989); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso MINIERE<br><i>Vigneti e antiche vie del cemento</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1989' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/CIMG2483-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1987); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso BRIC<br><i>I borghi tra i boschi</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1987' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/P1000055-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1971); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso CREA<br><i>Il Sacro Monte tra colline/crinali e campanili</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1971' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/P1000662-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1969); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso VIGNE<br><i>Terre di vino e pietra da cantoni</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.org/?page_id=1969' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.org/wp-content/uploads/P1000896-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              	<span class="zoom"><i class="icon-zoom"></i></span>
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
      </div>
<!-- SEZ.5 END-->
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</article>

			<?php comments_template(); ?>
			<?php menu_segreto(); ?>
		</div><!--/content-part-->

<?php endwhile; ?>
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>
