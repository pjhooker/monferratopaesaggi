
<?php while(have_posts()): the_post(); ?>

<?php
$from_poi=get_field('from_poi');
$from_comune=get_field('from_comune');
$to_poi=get_field('to_poi');
$to_comune=get_field('to_comune');

if(!$from_poi==NULL){$from=$from_poi;}
else{$from=$from_comune;}
if(!$to_poi==NULL){$to=$to_poi;}
else{$to=$to_comune;}

if( !empty($from) ):
	$fromID=$from[0];
endif; // lat lng

if( !empty($to) ):
	$toID=$to[0];
endif; // lat lng

$cat= get_the_category();
$cat_name=$cat[0]->cat_name;

$lat=format_location($postid,lat);
$lng=format_location($postid,lng);

$fromLAT=format_location($fromID,lat);
$fromLNG=format_location($fromID,lng);

$toLAT=format_location($toID,lat);
$toLNG=format_location($toID,lng);

$fromTITLE=get_the_title($fromID);
$toTITLE=get_the_title($toID);

$fromPLINK=get_the_permalink($fromID);
$toPLINK=get_the_permalink($toID);

?>
	<div id="content">
		<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
			<div class="text">
				<div class="clear"></div>
				<div class="row">
					<div class="col-sm-12">
						<div id='map' style="height:400px;"></div>

						<!--<script src='http://www.monferratopaesaggi.org/js/mappa_tratta_leaflet.js'></script>-->
						<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_0.js'></script>
						<script src='http://www.monferratopaesaggi.org/geodata/poi_monferrato.js'></script>

						<script src='http://www.monferratopaesaggi.org/geodata/poi_monferrato.js'></script>

<?php

				  $mykey_values = get_post_custom_values('link_comune');
				  if ($mykey_values ==NULL){}
				  else{
				      foreach ( $mykey_values as $key => $value ) {

				        $comune=get_the_title($value);
				        $link=get_permalink($value);
				        echo"<span style='background-color:#9abdc0;color:#3644d7;padding:0 5px 0 5px;'><a href='$link'>$comune</a></span>";
				    }
				  }

?>

						<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','intent'),'after'=>'</div>')); ?>
					<?php if(!wpb_option('post-hide-tags')): // Post Tags ?>
						<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','intent').'</span> ','','</p>'); ?>
					<?php endif; ?>
			</div><!-- /.col-sm-8 -->
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php if(!wpb_option('post-hide-format-icon')): ?>
					<div class="format-icon"><i class="icon"></i></div>
				<?php endif; ?>
				<h1 class="entry-title" style="padding-top:15px;">
					<?php the_title(); ?>
				</h1>
				<div style="padding-bottom:15px;">
					<?php echo "<a href='$fromPLINK'>$fromTITLE</a> > <a href='$toPLINK'>$toTITLE</a>"; /*the_title();*/ ?>
				</div>
						<?php
						$pano = arrotonda(get_field('lunghezza_panoramiche',$id),0);
						$tot = arrotonda(get_field('lunghezza_totale',$id),0);
						echo"Lunghezza totale: $tot m<br>
						Lunghezza panoramiche: $pano m<hr>";
						the_content(); ?>
			</div><!-- /.col-sm-12 -->
		</div>
	</div>
	<?php comments_template(); ?>
</article>

</div><!--/content-part-->

<?php endwhile; ?>


<script type='text/javascript'>
	var lon = <?php echo $lng; ?>;
	var lat = <?php echo $lat; ?>;
	var fromLAT = <?php echo $fromLAT; ?>;
	var fromLNG = <?php echo $fromLNG; ?>;
	var toLAT = <?php echo $toLAT; ?>;
	var toLNG = <?php echo $toLNG; ?>;

	var map = L.map('map', { zoomControl:true }).setView([lat,lon], 14);
	//var map = L.map('map', { zoomControl:true }).setView([45.09422490056251,8.275603204965591], 10);
	var googleLayer = new L.Google('HYBRID');
	map.addLayer(googleLayer);

	var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	var raster_group = new L.LayerGroup([]);

	var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
	});
	//basemap_0.addTo(map);

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
              l === 1997 ? <?php colore_percorso('1997') ?>  :
            l === 1993 ? <?php colore_percorso('1993') ?>  :
            l === 1989 ? <?php colore_percorso('1989') ?>  :
            l === 1987 ? <?php colore_percorso('1987') ?>  :
            l === 1971 ? <?php colore_percorso('1971') ?>  :
            l === 1969 ? <?php colore_percorso('1969') ?>  :
              'red';
  }

  function getNomeP(n) {
      return  n === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
              n === 1997 ? <?php nome_percorso('1997') ?>  :
            n === 1993 ? <?php nome_percorso('1993') ?>  :
            n === 1989 ? <?php nome_percorso('1989') ?>  :
            n === 1987 ? <?php nome_percorso('1987') ?>  :
            n === 1971 ? <?php nome_percorso('1971') ?>  :
            n === 1969 ? <?php nome_percorso('1969') ?>  :
              'red';
  }

    var exp_linee = new L.geoJson(exp_linee,{
      onEachFeature: pop_linee,
      style: function (feature) {
        return {weight: 5,
            color: getColor(feature.properties.idm),
            opacity: 0.8
				};
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

	var tratta = new L.featureGroup();

		var circle = L.circle([fromLAT, fromLNG], 200, {
	      color: 'green',
	      fillColor: 'white',
	      fillOpacity: 0.2
	  });
		tratta.addLayer(circle);

	  var circle = L.circle([toLAT, toLNG], 200, {
	      color: 'red',
	      fillColor: 'white',
	      fillOpacity: 0.2
	  });
		tratta.addLayer(circle);
		map.addLayer(tratta);

		var polyline = L.polyline([
		    [fromLAT, fromLNG],
		    [toLAT, toLNG]
		]);
		map.fitBounds(polyline.getBounds());




  var baseMaps = {
    'Google Hybrid': googleLayer,
    'OSM Standard': basemap_0,
  };

  L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);

</script>
