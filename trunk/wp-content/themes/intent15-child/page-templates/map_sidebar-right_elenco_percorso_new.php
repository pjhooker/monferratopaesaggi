<?php
/*
Template Name: MAP Elenco percorso Sidebar Right NEW
*/
?>
<?php get_header('leafletjs_base2'); ?>


<?php while(have_posts()): the_post(); ?>

<?php

$postid = get_the_ID();
$page_id=$postid;//$_GET['page_id'];
$percorso_id=$postid;//$_GET['percorso_id'];
$lat=format_location($postid,'lat');
$lng=format_location($postid,'lng');
$address=format_location($postid,'address');

$nome_vero=normalize_percorso($postid,'nome_vero');
$tag=normalize_percorso($postid,'tag');

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
echo"
                    <div id='map'></div>
";
?>


<script src='http://www.monferratopaesaggi.org/js/mappa_tutti_percorsi_percorso.js'></script>


<?php
// ------------------------------------------------------------------------- OPENLAYERS STOP
?>
<?php
// --- MAP --- STOP
?>

                    <div class="clear"></div>

<?php endwhile; ?>

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
<script>

  var map = L.map('map', { zoomControl:true }).setView([<?php echo $lat;?>,<?php echo $lng;?>], 12);
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
                    + '<a href="http://www.monferratopaesaggi.org/?page_id='
                    + feature.properties['idm']
                    + '">'
                    + getNomeP(feature.properties['idm'])
                    + '</a>'
                    + '</td></tr>'
                    + '</table>';
    layer.bindPopup(popupContent);

  }

  function getImage(d) {
      return  d === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
              d;
  }

  function pop_reg(feature, layer) {

      // l'elenco delle colonne è generato tramite un array di acf
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

  function getColor(l) {
      return  l === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
              l === 1997 ? <?php colore_percorso('1997') ?>  :
            l === 1993 ? <?php colore_percorso('1993') ?>  :
            l === 1989 ? <?php colore_percorso('1989') ?>  :
            l === 1987 ? <?php colore_percorso('1987') ?>  :
            l === 1971 ? <?php colore_percorso('1971') ?>  :
            l === 1969 ? <?php colore_percorso('1969') ?>  :
              'red';
  }

  function getOpacity(l) {
      return  l === <?php echo $postid; ?> ? 0.8 :
              0.4;
  }
  function getWeight(l) {
      return  l === <?php echo $postid; ?> ? 10 :
              5;
  }

  var linee0 = new L.featureGroup();

	$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
		var exp_linee = L.geoJson(data, {
			onEachFeature: pop_linee,
			style: function (feature) {
				return {
          weight: getWeight(feature.properties.idm),
          color: getColor(feature.properties.idm),
          opacity: getOpacity(feature.properties.idm)
				};
			}
		});

		linee0.addLayer(exp_linee);
    map.addLayer(linee0);
	});
  // 	var linee0 END

  // geometria POI
  //var poi = new L.featureGroup();
  $.getJSON("http://www.monferratopaesaggi.org/geodata/poi_monferrato.geojson", function(data) {
    var exp_regJSON = new L.geoJson(data,{
        onEachFeature: pop_reg,
        pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
            iconUrl: feature.properties.imageurl,
            //iconUrl: 'http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg',
            iconSize:     [20, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
            iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
            popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON

    //poi.addLayer(exp_regJSON);
    //map.addLayer(poi);

    var cluster_groupexp_regJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
    cluster_groupexp_regJSON.addLayer(exp_regJSON);

    //add comment sign to hide this layer on the map in the initial view.
    cluster_groupexp_regJSON.addTo(map);

	});

  // geometria POI -end

  var baseMaps = {
		'Google Hybrid': googleLayer,
		'OSM Summer': basemap_0,
		'OSM Winter': basemap_1
	};

	L.control.layers(baseMaps).addTo(map);
	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);

</script>
<?php get_footer(); ?>
