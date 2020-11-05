<?php
/*
 * Template Name: MAP NO Sidebar Right
 * Questo template è utilizzato dalla pagina ITINERARI:MAPPA
 * url ?page_id=1951
 *
 */


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
<?php get_header('leafletjs_base2'); ?>

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


<script src='http://www.monferratopaesaggi.it/js/mappa_tutti_percorsi.js'></script>


<!-- SEZ.5 -->
<div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1997); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso PROFILI<br><i>Scorci di paesaggio antico</i></h3>
            </div>
            <div class="panel-body portfolio-item" style="margin-bottom: 0px;">
              <a href='http://www.monferratopaesaggi.it/?page_id=1997' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/23.-Zoom-su-Grazzano-visto-da-Spiazzo-Madonna-dei-Monti-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
              <a href='http://www.monferratopaesaggi.it/?page_id=1993' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/fotofiumepo-003-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
              <a href='http://www.monferratopaesaggi.it/?page_id=1989' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/CIMG2483-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
              <a href='http://www.monferratopaesaggi.it/?page_id=1987' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/P1000055-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
              <a href='http://www.monferratopaesaggi.it/?page_id=1971' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/P1000662-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
              <a href='http://www.monferratopaesaggi.it/?page_id=1969' class="portfolio-thumbnail">
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/P1000896-460x314.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
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
<script src='http://www.monferratopaesaggi.it/geodata/poi_monferrato.js'></script>
<script>

  var map = L.map('map', { zoomControl:true }).setView([45.09304,8.28100], 12);
  var additional_attrib = '';
  var feature_group = new L.featureGroup([]);

  var basemap_0 = L.tileLayer('http://a.tiles.mapbox.com/v4/runkeeper.4nc7syvi/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidHJpc3RlbiIsImEiOiJiUzBYOEJzIn0.VyXs9qNWgTfABLzSI3YcrQ', {
    attribution: additional_attrib + 'Map tiles by <a href="http://runkeeper.com/">runkeeper.com</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash;'
  });
  basemap_0.addTo(map);

  var basemap_1 = L.tileLayer('https://a.tiles.mapbox.com/v4/andreasviglakis.76e0cee7/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYW5kcmVhc3ZpZ2xha2lzIiwiYSI6IlVremRqN0kifQ.CFFJsLuWWyuhgsZTb51jWg', {
    attribution: additional_attrib + 'Map tiles by <a href="https://www.mapbox.com/">MapBox</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash;'
  });

  var googleLayer = new L.Google('HYBRID');
  //map.addLayer(googleLayer);

  var layerOrder=new Array();

  function pop_linee(feature, layer) {

    // l'elenco delle colonne Ã¨ generato tramite un array di acf
    var popupContent = '<table style="width:300px;">'
                    + '<tr>'
                    + '<a href="http://www.monferratopaesaggi.it/?page_id='
                    + feature.properties['idm']
                    + '">'
                    + getNomeP(feature.properties['idm'])
                    + '</a>'
                    + '</td></tr>'
                    + '</table>';
    layer.bindPopup(popupContent);

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

  var overlay_itinerari = L.tileLayer('http://www.cityplanner.it/experiment_host/tile/tiles_monferrato_v2/{z}/{x}/{y}.png', {
    maxZoom: 18,
    zIndex:1000,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'examples.map-i875mjb7'
  });//.addTo(map);

  var linee0 = new L.featureGroup();

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

	$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
		var exp_linee = L.geoJson(data, {
			onEachFeature: pop_linee,
			style: function (feature) {
				return {
					weight: 6,
					color: getColor(feature.properties.idm),
					opacity: 0.8,
					fillOpacity: 0.5
				};
			}
		});

		linee0.addLayer(exp_linee);
    map.addLayer(linee0);
	});
  // 	var linee0 END

  //TRATTE PANORAMICHE
		var t_panoramiche = new L.featureGroup();
		$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_1.geojson", function(data1) {
			var lineeGeoJson = L.geoJson(data1, {
				style: function (feature) {
					return {
						weight: 9,
						color: 'grey',
						opacity: 0.6
					};
				}
			});
			t_panoramiche.addLayer(lineeGeoJson);
			map.addLayer(t_panoramiche);
		});

    // PERCORSI EXTRA

  		// CAI
  			var lineeCAI = new L.featureGroup();
  			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
  				var lineeGeoJson = L.geoJson(data, {
  					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
  					filter: function(feature, layer) {return feature.properties.name == 'percorso CAI';}
  				});
  				lineeCAI.addLayer(lineeGeoJson);
  		    //map.addLayer(lineeCAI);
  			});

  		// Marchesi
  			var lineeMarchesi = new L.featureGroup();
  			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
  				var lineeGeoJson = L.geoJson(data, {
  					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
  					filter: function(feature, layer) {return feature.properties.name == 'Percorso Marchesi storico';}
  				});
  				lineeMarchesi.addLayer(lineeGeoJson);
  		    //map.addLayer(lineeMarchesi);
  			});

  		// Ciclovia PO
  			var lineeCPO = new L.featureGroup();
  			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
  				var lineeGeoJson = L.geoJson(data, {
  					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
  					filter: function(feature, layer) {return feature.properties.name == 'Ciclovia PO';}
  				});
  				lineeCPO.addLayer(lineeGeoJson);
  		    //map.addLayer(lineeCPO);
  			});

  		// Percorso Cemento
  			var lineeCemento = new L.featureGroup();
  			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
  				var lineeGeoJson = L.geoJson(data, {
  					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
  					filter: function(feature, layer) {return feature.properties.name == 'Percorso Cemento';}
  				});
  				lineeCemento.addLayer(lineeGeoJson);
  		    //map.addLayer(lineeCemento);
  			});

  		// Percorso Mulini
  			var lineeMulini = new L.featureGroup();
  			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
  				var lineeGeoJson = L.geoJson(data, {
  					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
  					filter: function(feature, layer) {return feature.properties.name == 'Percoso Mulini';}
  				});
  				lineeMulini.addLayer(lineeGeoJson);
  		    //map.addLayer(lineeMulini);
  			});

  var baseMaps = {
		'Google Hybrid': googleLayer,
		'OSM Summer': basemap_0,
		'OSM Winter': basemap_1
	};

	L.control.layers(baseMaps,{"Style": overlay_itinerari, "Tratte panoramiche": t_panoramiche,"Percorso Mulini":lineeMulini,"Percorso Cemento":lineeCemento,"Ciclovia PO":lineeCPO,"Marchesi":lineeMarchesi,"CAI":lineeCAI}).addTo(map);
	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);

</script>

<?php get_footer('leafletjs_base'); ?>
