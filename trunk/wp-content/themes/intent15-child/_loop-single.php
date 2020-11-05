
<?php while(have_posts()): the_post(); ?>
	<div id="content">
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
	<div class="text">
		<div class="clear"></div>
		<div class="row">
			<div class="col-sm-8">
				<?php if(!wpb_option('post-hide-format-icon')): ?>
					<div class="format-icon"><i class="icon"></i></div>
				<?php endif; ?>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
				<?php
					$cat= get_the_category();
					$cat_name=$cat[0]->cat_name;
				?>
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
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Info percorso</h3>
					</div>
					<div class="panel-body">
						<?php
						$pano = arrotonda(get_field('lunghezza_panoramiche',$id),0);
						$tot = arrotonda(get_field('lunghezza_totale',$id),0);
						echo"Lunghezza totale: $tot<br>
						Lunghezza panoramiche: $pano<hr>";
						the_content(); ?>
					</div>
				</div>
			</div><!-- /.col-sm-4 -->
		</div>
	</div>
	<?php comments_template(); ?>
</article>

</div><!--/content-part-->

<?php endwhile; ?>


<script type='text/javascript'>
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

  var circle = L.circle([lat, lon], 30, {
      color: 'red',
      fillColor: 'white',
      fillOpacity: 0.2
  }).addTo(map);

  var baseMaps = {
    'Google Hybrid': googleLayer,
    'OSM Standard': basemap_0,
  };

  L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);

</script>
