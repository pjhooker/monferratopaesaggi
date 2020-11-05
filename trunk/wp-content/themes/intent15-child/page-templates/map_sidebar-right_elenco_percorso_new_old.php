<?php
/*
Template Name: MAP Elenco percorso Sidebar Right NEW OLD
*/
?>
<?php acf_form_head(); ?>
<?php get_header('osm-percorso'); ?>
<?php get_template_part('_page-image'); ?>


<?php while(have_posts()): the_post(); ?>

<?php

$postid = get_the_ID();
$page_id=$postid;//$_GET['page_id'];
$percorso_id=$postid;//$_GET['percorso_id'];
/*
<div id="page-title">
    <div id="page-title-inner" class="container fix">
        <h1><?php echo wpb_page_title(); ?></h1>
    </div><!--/page-title-inner-->
</div><!--/page-title-->
*/

if ($postid==1997) {$nome_vero='profili';}
else if ($postid==1993) {$nome_vero='po';}
else if ($postid==1989) {$nome_vero='miniere';}
else if ($postid==10617) {$nome_vero='miniere';}
else if ($postid==1987) {$nome_vero='bric';}
else if ($postid==1971) {$nome_vero='crea';}
else if ($postid==1969) {$nome_vero='vigne';}
else{$nome_vero='';}


?>

<div id="page" class="fix">
    <div id="page-inner" class="container fix">
        <div id="content">

            <article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                <div class="text">

                    <?php
                    echo"<h1>";
                    the_title();
                    echo"</h1>";?>
                    <!--<a href="pl_linee_percorso.kml" class="button medium" style='margin-top:15px;'><span style="color:white;">Scarica il percorso</span></a>-->
                    <?php
                    echo"<hr>";
                    echo"<div class='row'>
                        <div class='col-sm-8'>
                            <h3>";
                    the_content();
                    echo"</h3>
                        </div>
                        <div class='col-sm-4'>
                            ";
                    dati_percorso1($postid,$nome_vero);
                    scheda_percorso_div_elenco_poi_sum1($page_id);
                    echo"
                        </div>
                    </div>
                    ";                    ;
                    ?>
                    <div class="clear"></div>

                    <h2>Mappa del <?php echo wpb_page_title(); ?></h2>



<?php

$key="mykey";
$lat = get_post_meta($post->ID, 'lat', true);
$lon = get_post_meta($post->ID, 'lon', true);
?>

<?php
//NEW MAP START
// ------------------------------------------------------------------------- OPENLAYERS START

echo"
                    <div id='map'></div>
";
?>

<?php
if ($lat==NULL) {
$center_ln=$lon;
$center_lt=$lat;
$delta_ln=0.05;
$delta_lt=0.05;
}
else
{$center_ln=$lon;
$center_lt=$lat;
$delta_ln=0.05;
$delta_lt=0.05;
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
<script src='http://maps.google.com/maps/api/js?v=3&amp;sensor=false'></script>
    <script type="text/javascript">
        var map, layer;
            var map;

            var epsg4326 = new OpenLayers.Projection('EPSG:4326'),
            epsg900913 = new OpenLayers.Projection('EPSG:900913');


            var color1997 = <?php colore_percorso('1997') ?> ;
            var color1993 = <?php colore_percorso('1993') ?> ;
            var color1989 = <?php colore_percorso('1989') ?> ;
            var color1987 = <?php colore_percorso('1987') ?> ;
            var color1971 = <?php colore_percorso('1971') ?> ;
            var color1969 = <?php colore_percorso('1969') ?> ;

            var extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'),
            new OpenLayers.Projection('EPSG:900913'));

</script>
<script src='http://www.monferratopaesaggi.org/js/mappa_tutti_percorsi_percorso.js'></script>


<?php
// ------------------------------------------------------------------------- OPENLAYERS STOP
?>
<?php
// --- MAP --- STOP
?>
                    <div class="clear"></div>




<?php endwhile; ?>



<?php

// se tratta TAG è uguale a percorso, visualizza elenco                          ---START

if($page_id==1989){$tag='percorso_miniera';}
else if($page_id==1993){$tag='percorso_po';}
else if($page_id==10617){$tag='percorso_miniera';}
else if($page_id==1987){$tag='percorso_bosco';}
else if($page_id==1971){$tag='percorso_crea';}
else if($page_id==1997){$tag='percorso_sud';}
else if($page_id==1969){$tag='percorso_grignolino';}
else {}

?>
<?php

/* start portfolio like
*/
?>
<style>
<?php $colore_percorso= get_field('colore_percorso',$page_id); ?>
.btn-warning{
    color:#fff;
    border-color:<?php echo $colore_percorso;?>;
    background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);
    background-repeat: repeat-x;

}

.btn-warning:hover,.btn-warning:focus,.btn-warning.focus,.btn-warning:active,.btn-warning.active,.open>.dropdown-toggle.btn-warning{
    color:#fff;
    background-color:<?php echo $colore_percorso;?>;
    border-color:<?php echo $colore_percorso;?>
}

.btn-warning:active,.btn-warning.active,.open>.dropdown-toggle.btn-warning{
    background-image:none
}

.btn-warning.disabled,.btn-warning[disabled],fieldset[disabled] .btn-warning,.btn-warning.disabled:hover,.btn-warning[disabled]:hover,fieldset[disabled] .btn-warning:hover,.btn-warning.disabled:focus,.btn-warning[disabled]:focus,fieldset[disabled] .btn-warning:focus,.btn-warning.disabled.focus,.btn-warning[disabled].focus,fieldset[disabled] .btn-warning.focus,.btn-warning.disabled:active,.btn-warning[disabled]:active,fieldset[disabled] .btn-warning:active,.btn-warning.disabled.active,.btn-warning[disabled].active,fieldset[disabled] .btn-warning.active{
    background-color:<?php echo $colore_percorso;?>;
    border-color:<?php echo $colore_percorso;?>
}

</style>

                    <div class="row" style="padding: 30px 15px;">
                        <div class="col-sm-12">
                            <h1>Elenco tratte</h1>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="jumbotron">
                    <div class="row">
<?

// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'posts_per_page' => -1, 'order'=> 'ASC', 'orderby' => 'date','cat'=>69,'tag'=>$tag)  ); //cat 69 = tratta
$i=0;
while ( $the_query->have_posts() ) : $the_query->the_post();
?>

                        <div class="col-sm-4">
                            <a style="margin:5px;width:100%;" class="btn btn-warning" href="http://www.monferratopaesaggi.org/?page_id=<?php echo $id?>">
                                <?php the_title(); ?>
                            </a>
                        </div>

<?php
endwhile;
// Reset Post Data
wp_reset_postdata();
?>

                    </div>
                    <div class="clear"></div>
                </div>
            </article>

            <?php comments_template(); ?>
        </div><!--/content-->

    </div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>
