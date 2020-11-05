<?php $meta = get_post_custom(); ?>

<div id="page" class="portfolio single single-full">
	<div id="page-inner" class="container fix">

<!-- CAROUSEL SEZ.1 -->
	<?php
		$width_slide='1200px';
		$height_slide='667px';
		$style='style="width:'.$width_slide.';height:'.$height_slide.';"';
	?>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
<?php
$postid = get_the_ID();
$imH=$height_slide;
$imW=$width_slide;

$img1=get_field('field_535963af94eff');
$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
if ($img1==NULL) {$img1=$nullimg;}
else {}
echo"<div class='item active'><img src='".site_url($path, $scheme)."/image.php?myimage=$img1&h=$imH&w=$imW' alt='First slide' $style ></div>";
?>

<?php
$img2=get_field('field_5359650d4e1c0');
if ($img2==NULL) {}
else{
echo"<div class='item'><img src='".site_url($path, $scheme)."/image.php?myimage=$img2&h=$imH&w=$imW' alt='First slide' $style ></div>";
}
?>
<?php
$img3=get_field('field_535965174e1c1');
if ($img3==NULL) {}
else{
echo"<div class='item'><img src='".site_url($path, $scheme)."/image.php?myimage=$img3&h=$imH&w=$imW' alt='First slide' $style ></div>";
}
?>
<?php
$img4=get_field('field_5359651e4e1c2');
if ($img4==NULL) {}
else{
echo"<div class='item'><img src='".site_url($path, $scheme)."/image.php?myimage=$img4&h=$imH&w=$imW' alt='First slide' $style ></div>";
}
?>
<?php
$img5=get_field('field_535965254e1c3');
if ($img5==NULL) {}
else{
echo"<div class='item'><img src='".site_url($path, $scheme)."/image.php?myimage=$img5&h=$imH&w=$imW' alt='First slide' $style ></div>";
}
?>
		</div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>

		<div id="content">
			<div class="portfolio-item-single">

			<?php if(!isset($meta['_portfolio_video'])): ?>

				<div class="flexslider" id="flex-portfolio">
					<ul class="slides">
						<?php /*foreach( $post_images as $image ): */?>
						<?php /*$img = wp_get_attachment_image_src($image->ID,'large'); */?>
						<li>
							<?php /*<img src="<?php echo $img[0]; ?>" alt="<?php echo $image->post_title; ?>" /> */?>
<?php

$postid = get_the_ID();

$imH='640';
$imW='960';

$img1=get_field('field_535963af94eff');
$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
if ($img1==NULL) {$img1=$nullimg;}
else {}
echo"<img src='".site_url($path, $scheme)."/image.php?myimage=$img1&h=$imH&w=$imW' >";
?>
							<?php /*if($image->post_excerpt):
							<span class="caption-bar"><i><?php echo $image->post_excerpt; ?></i></span>*/ ?>
							<?php /* endif; */?>
						</li>

<?php
$img2=get_field('field_5359650d4e1c0');
if ($img2==NULL) {}
else{
echo"<li>";
echo"<img src='".site_url($path, $scheme)."/image.php?myimage=$img2&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img3=get_field('field_535965174e1c1');
if ($img3==NULL) {}
else{
echo"<li>";
echo"<img src='".site_url($path, $scheme)."/image.php?myimage=$img3&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img4=get_field('field_5359651e4e1c2');
if ($img4==NULL) {}
else{
echo"<li>";
echo"<img src='".site_url($path, $scheme)."/image.php?myimage=$img4&h=$imH&w=$imW' >";
echo"</li>";
}
?>
<?php
$img5=get_field('field_535965254e1c3');
if ($img5==NULL) {}
else{
echo"<li>";
echo"<img src='".site_url($path, $scheme)."/image.php?myimage=$img5&h=$imH&w=$imW' >";
echo"</li>";
}
?>

						<?php /*endforeach; */?>
					</ul>
				</div>

				<script type="text/javascript">
					jQuery(window).load(function() {
						jQuery('#flex-portfolio').flexslider({
							/* slideDirection: "", */
							animation: "fade",
							slideshow: true,
							directionNav: true,
							controlNav: true,
							pauseOnHover: true,
							slideshowSpeed: 7000,
							animationDuration: 600
						});
						jQuery('.slides').addClass('loaded');
					});
				</script>

			<?php endif; // end check for portfolio video ?>

				<?php
				if(isset($meta['_portfolio_video'])) {
					echo '<div class="video-container">';
					if(isset($meta['_portfolio_video_url'])) {
						global $wp_embed;
						$video = $wp_embed->run_shortcode('[embed width="940"]'.$meta['_portfolio_video_url'][0].'[/embed]');
						echo $video;
					} elseif(isset($meta['_portfolio_video_embed_code'][0])) {
						echo $meta['_portfolio_video_embed_code'][0];
					}
					echo '</div>';
				}
				?>

			</div>


<div class="row">
	<div class="col-md-12">
		<h2>Elenco dei Punti di interesse e informazioni <?php the_title();?></h2>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<?php scheda_comune_div_elenco_poi1($postid,'tab-2'); ?>
	</div>
	<div class="col-md-4">
		<?php scheda_comune_div_elenco_poi2($postid,'tab-2'); ?>
	</div>
</div>


		</div><!--/content-part-->

		<div class="sidebar-full portfolio">
			<article>
				<div class="text">
					<p class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></p>
					<?php the_content(); ?>

<?php
//$idframe=$_GET['gid'];//questo numero varia ed è da associare al frame
$page_id=$_GET['page_id'];
$percorso_id=$_GET['percorso_id'];
$portfolio=$_GET['portfolio'];
/*if ($portfolio=='comune-99'){}
else if ($portfolio=='comune-4') {$lat=45.155805;$lon=8.193695;}
else if ($portfolio=='comune-3') {$lat=45.142336;$lon=8.335852;}
else if ($portfolio=='comune-2') {$lat=45.147573;$lon=8.373501;}
else if ($portfolio=='alfiano-natta') {$lat=45.154503;$lon=8.160716;}
else {$lat=45.142336;$lon=8.335852;}
*/
//$key="mykey";
//$lat = get_post_meta($post->ID, 'lat', true);
//$lon = get_post_meta($post->ID, 'lon', true);
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&percorso_id=$percorso_id' width='100%' height='800px'></iframe>";
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso.php?gid=$page_id&mypage_id=$page_id&lat=$lat&lon=$lon' width='100%' height='520px'></iframe>";
?>
<?php
$location = get_field('map',$id); // MANCA l'ID !!!
if( !empty($location) ):
$lat=$location['lat'];
$lng=$location['lng'];
endif; // lat lng
?>


	<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_0.js'></script>
	<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_1.js'></script>
	<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_3.js'></script>
	<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_4.js'></script>
	<script src='http://www.monferratopaesaggi.org/geodata/poi_monferrato.js'></script>
	<script>
		var lat = <?php echo $lat ?>;
		var lng = <?php echo $lng ?>;
	</script>
	<script src="http://www.monferratopaesaggi.org/js/mappa_comune_leaflet.js"></script>


					<div class="clear"></div>
				</div>
			</article>
			<div id="map" style="width: 100%; height: 400px"></div>

	<script>


    var map = L.map('map').setView([lat, lng], 16);

        //var map = L.map('map', { zoomControl:true }).fitBounds([[45.4592590398,9.18071839168],[45.4691821303,9.20070411012]]);


var googleLayer = new L.Google('HYBRID');
//map.addLayer(googleLayer);

var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
var feature_group = new L.featureGroup([]);

var raster_group = new L.LayerGroup([]);

var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
});
basemap_0.addTo(map);

var layerOrder=new Array();

    function getImage(d) {
        return  d === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                d;
    }

    function pop_reg(feature, layer) {

        // l'elenco delle colonne Ã¨ generato tramite un array di acf
        var popupContent = '<table style="width:300px;">'
                        + '<tr><td colspan="2"><img src="'
                        + getImage(feature.properties['picture'])
                        + '" style="width:100%;" /></td></tr>'
                        + '<tr><th scope="row">Nome</th><td>'
                        + '<a href="'
                        + feature.properties['url_post']
                        + '">'
                        + feature.properties['titolo']
                        + '</a>'
                        + '</td></tr>'
                        + '<tr><th scope="row">Comune</th><td>'
                        + feature.properties['comune']
                        + '</td></tr>'
                        + '<tr><th scope="row">Tipo</th><td>'
                        + feature.properties['tipo']
                        + '</td></tr>'
                        + '</table>';
        layer.bindPopup(popupContent);

    }

    function pop_linee(feature, layer) {

        // l'elenco delle colonne Ã¨ generato tramite un array di acf
        var popupContent = '<table style="width:300px;">'
                        + '<tr>'
                        + '<a href="http://www.monferratopaesaggi.org/?page_id='
                        + feature.properties['idm']
                        + '">'
                        + getNomeP(feature.properties['idm'])
                        + '</a>'
                        + '</td></tr>'
                        + '</table>';
        layer.bindPopup(popupContent);

    }

    function getColor(l) {
        return  l === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                l === 1997 ? '#cf9c2b'  :
                l === 1993 ? '#394d9d'  :
                l === 1989 ? '#ba2030'  :
                l === 1987 ? '#016a38'  :
                l === 1971 ? '#e06410'  :
                l === 1969 ? '#804195'  :
                'red';
    }

    function getNomeP(n) {
        return  n === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                n === 1997 ? 'Percorso PROFILI | Scorci di paesaggio antico'  :
                n === 1993 ? 'Percorso PO | Vedute tra Alpi e terre d’acqua'  :
                n === 1989 ? 'Percorso MINIERE | Vigneti e antiche vie del cemento'  :
                n === 1987 ? 'Percorso BRIC | I borghi tra i boschi'  :
                n === 1971 ? 'Percorso CREA | Il Sacro Monte tra colline/crinali e campanili'  :
                n === 1969 ? 'Percorso VIGNE | Terre di vino e pietra da cantoni'  :
                'red';
    }

        var exp_linee = new L.geoJson(exp_linee,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 5,
                                color: getColor(feature.properties.idm),
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
                    }).addTo(map);       //var exp_regJSON

        //Tratte panoramiche pl_linee_pano_1
        var exp_linee1 = new L.geoJson(exp_pl_linee_pano_1,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON

        //Tratte locali pl_linee_pano_3
        var exp_linee3 = new L.geoJson(exp_pl_linee_pano_3,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON

        //Tratte locali (AUTO) pl_linee_pano_4
        var exp_linee4 = new L.geoJson(exp_pl_linee_pano_4,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON


        var exp_regJSON = new L.geoJson(exp_poi,{
            onEachFeature: pop_reg,
            pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {
              icon: L.icon({
                iconUrl: feature.properties.imageurl,
                iconSize:     [20, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
                iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
                popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
              })  // L.icon
            })    // L.marker
          }       //pointToLayer: function
        });       //var exp_regJSON

        var cluster_groupexp_regJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
        cluster_groupexp_regJSON.addLayer(exp_regJSON);

        //add comment sign to hide this layer on the map in the initial view.
        cluster_groupexp_regJSON.addTo(map);



        var baseMaps = {
            'Google Hybrid': googleLayer,
            'OSM Standard': basemap_0,
        };

        L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);


	</script>

		</div><!--/sidebar-->


		<?php if ( ('open' == $post->comment_status) && !air_portfolio::get_option('portfolio-comments-disable') ): ?>
		<div id="content" class="fix comments">
			<?php comments_template(); ?>
		</div><!--/content-part-->
		<?php endif;?>



	</div><!--/page-inner-->
</div><!--/page-->



<?php
// --- MAP --- STOP
?>
