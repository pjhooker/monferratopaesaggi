<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!wpb_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<?php if(!wpb_option('post-hide-comments')): ?>
		<div class="entry-comments">
			<a class="bubble" href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?><span></span></a>
		</div>
		<?php endif; ?>
		<div class="entry-byline fix">	
			<?php if(!wpb_option('post-hide-author')): ?>
				<p class="entry-author"><?php _e('By','intent'); ?> <?php the_author_posts_link(); ?></p>
			<?php endif; ?>
			<p class="entry-date"><?php if(!wpb_option('post-hide-date')) { the_time('F jS, Y'); } ?></p>
		</div>
	</header>

	<?php get_template_part('_post-formats'); ?>

	<div class="clear"></div>
	
	<div class="text">
		<?php the_content(); ?>
        
<?php
// MOD PJH --- START
echo"<hr><b>Cosa serve?</b><br>";    
echo"<ul>";

$percorso = get_field('field_5352634f44829',$id);
$location = get_field('map',$id); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng
echo"<li>Latitudine: $lat</li>";
echo"<li>Longitudine: $lng</li>";

$tipo = get_field('field_53524fd43715d',$id);
echo"<li>Tipo: $tipo</li>";

echo"</ul><hr>";
?>

<?php /* NEW MAP START */ ?>
<?php
//$get_gid=$_GET['gid'];

// ------------------------------------------------------------------------- OPENLAYERS START

//$lat=$_GET['lat'] ;
//$lon=$_GET['lon'] ;

//$lat=45.122112;
//$lon=8.406231 ;

$kml1='http://www.monferratopaesaggi.org/pt_punti_wp_percorso.kml';
$kml2='http://www.monferratopaesaggi.org/pl_linee_percorso.kml';

?>
<div class="clear"></div>


        <ul class="tabs-nav fix">
            <li><a class="active"  href="#"><?php echo wpb_page_title(); ?></li>
            <li><a href="?page_id=$percorso">Torna al percorso</li>
            <li><a href="<?php echo $kml1;?>" class="button medium"><span style="color:white;">Scarica il percorso</span></a></li>
            <li><a href="<?php echo $kml2;?>" class="button medium"><span style="color:white;">Scarica i POI</span></a></li>
        </ul>
<div style="display: block;" id="tab-3" class="tab"><div class="tab-content">
<?php

echo"

            <div id='map'></div>
";
?>

<?php
$center_ln=$lng;
$center_lt=$lat;
$delta_ln=0.005;
$delta_lt=0.005;


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
//----------------------------------------->
        function init(){
            var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326")
                
            };
            map = new OpenLayers.Map('map', option);
            olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );

            var gmap = new OpenLayers.Layer.Google("Google Satellite", {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 22});

            var sundials = new OpenLayers.Layer.Vector("Punti di interesse (POI)", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: <?php echo'"'.$kml1.'"';?>,
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });

            var tracciati = new OpenLayers.Layer.Vector("Percorso", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: <?php echo'"'.$kml2.'"';?>,
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });

            map.addLayers([olmapnik,gmap,sundials,tracciati]); //change
            map.setBaseLayer(gmap);
            //**
            select = new OpenLayers.Control.SelectFeature(sundials); 
            sundials.events.on({
                "featureselected": onFeatureSelect,
                "featureunselected": onFeatureUnselect
            });
            map.addControl(select);
            select.activate();   
            //**
            map.addControl(new OpenLayers.Control.LayerSwitcher());
            //map.addControl(new OpenLayers.Control.Navigation());
            //map.addControl(new OpenLayers.Control.PanZoomBar());
            //map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
            //map.addControl(new OpenLayers.Control.Permalink());
            //map.addControl(new OpenLayers.Control.ScaleLine());
            //map.addControl(new OpenLayers.Control.MousePosition());
            //map.addControl(new OpenLayers.Control.OverviewMap());
            //map.addControl(new OpenLayers.Control.KeyboardDefaults());
            extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'), 
            new OpenLayers.Projection('EPSG:900913'));
            map.zoomToExtent(extent);
        }
//----------------------------------------->
function onPopupClose(evt) {
            select.unselectAll();
        }

function onFeatureSelect(event) {
            var feature = event.feature;
            var selectedFeature = feature;
            var popup = new OpenLayers.Popup.FramedCloud("chicken", 
                feature.geometry.getBounds().getCenterLonLat(),
                new OpenLayers.Size(100,100),
                "<h2>"+feature.attributes.name + "</h2>" 
                + feature.attributes.description,
                null, true, onPopupClose
            );
            feature.popup = popup;
            map.addPopup(popup);
        }

function onFeatureUnselect(event) {
            var feature = event.feature;
            if(feature.popup) {
                map.removePopup(feature.popup);
                feature.popup.destroy();
                delete feature.popup;
            }
        }
    </script>
<?php
// ------------------------------------------------------------------------- OPENLAYERS STOP
?>
<?php
/* 
 * NEW MAP STOP 
 * MOD PJH --- STOP
*/ 
?></div></div>
		<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','intent'),'after'=>'</div>')); ?>
		<div class="clear"></div>
	</div>

	<?php if(!wpb_option('post-hide-tags')): // Post Tags ?>
		<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','intent').'</span> ','','</p>'); ?>
	<?php endif; ?>

</article>

<?php if(!wpb_option('post-hide-categories')): // Post Categories ?>
	<p class="entry-category"><span><?php _e('Posted in:','intent'); ?></span> <?php the_category(' &middot; '); ?></p>
<?php endif; ?>
<?php if(wpb_option('post-enable-author-block')): // Post Author Block ?>
	<div class="entry-author-block fix">
		<div class="entry-author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'80'); ?></div>
		<p class="entry-author-name"><?php the_author_meta('display_name'); ?></p>
		<p class="entry-author-description"><?php the_author_meta('description'); ?></p>
	</div>
<?php endif; ?>

<?php comments_template(); ?>

<?php endwhile;?>