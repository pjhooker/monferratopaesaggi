<?php
/*
Template Name: All bootstrap
*/
// Portfolio functions
$portfolio_functions = locate_template('functions-portfolio.php');
require ( $portfolio_functions );
?>
<?php acf_form_head(); ?>
<?php get_header('osm-percorso_light'); ?>
<?php get_template_part('_page-image'); ?>




<div id="page" class="fix">
	<div id="page-inner" class="container fix">

<?php
// --- MAP --- START
?>
<?php

$lat=$_GET['lat'] ;
$lon=$_GET['lon'] ;



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

<script src='http://www.monferratopaesaggi.org/js/mappa_tutti_percorsi_light.js'></script> 

<div class='row' style='padding-top:80px;'>
    <div class="col-md-4">       
        <div class="panel panel-default" itemscope itemtype="http://schema.org/ScholarlyArticle">
            <div class="panel-heading">
                <h3><?php echo the_title();?></h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr><td><a href='<?php echo get_permalink(8522); ?>'><i class="fa fa-map-marker"></i> Percorso Vigne</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(8520); ?>'><i class="fa fa-map-marker"></i> Percorso Profili</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(8517); ?>'><i class="fa fa-map-marker"></i> Percorso Po</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(8515); ?>'><i class="fa fa-map-marker"></i> Percorso Miniere</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(8513); ?>'><i class="fa fa-map-marker"></i> Percorso Crea</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(8511); ?>'><i class="fa fa-map-marker"></i> Percorso Bric</a></td></tr>
                        <tr><td><a href='<?php echo get_permalink(12489); ?>'><i class="fa fa-map-marker"></i> Percorsi C.A.I.</a></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    <?php the_content(); ?>
    </div>
</div>     
<?php

echo"
            <div class='row hidden-xs hidden-sm' style='padding-top:80px;'>
                <div class='col-md-12'>
                    <div id='map'></div>
                </div>
            </div>

";
?>
       
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>