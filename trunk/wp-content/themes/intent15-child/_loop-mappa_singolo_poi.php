<?php
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$postid = get_the_ID();
$id=$postid;
$user = wp_get_current_user();
$menu = $_GET['menu'];
$idautore = $_GET['autore'];
$lat=format_location($postid,'lat');
$lng=format_location($postid,'lng');
$address=format_location($postid,'address');
$percorso = get_field('field_5352634f44829',$id);
$img1=get_field('immagine_evidenza');
$img1ext=get_field('immagine_esterna');
?>

<?php while(have_posts()): the_post(); ?>

<div class="row" style='padding-top:15px;'>
  <div class="col-sm-8 blog-main">
    <article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
    	<header class="fix">

<?php
//temp
if ($idautore==NULL){}
else{
	update_field('id_autore', $idautore, $postid);
}

if ($menu==NULL){}
else{esegui_menu_poi($menu,$postid);}

?>

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

<?php

  // POST THUMBNAIL START

  if ( has_post_thumbnail() ) { // controlla se il post ha un'immagine in evidenza assegnata.
    //the_post_thumbnail();
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
  ?>
    	      <div itemscope itemtype="http://schema.org/ImageObject">
    	        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                  <img
                    src="<?php echo $large_image_url[0]; ?>"
                    title="<?php esc_attr( $thumbnail->post_title ); ?>"
                    width="100%" itemprop="contentUrl"
                    />
                    <p style="z-index:100;
                      background-color:RGBA(255,255,255,0.5);
                      padding:5px;
                      margin:5px;
                      position:absolute;
                      color:#000;
                      font-size:14px;
                      right:0px;
                      bottom:0px;">
                      <a href="<?php echo get_permalink( get_post_thumbnail_id($post->ID) ); ?>"><i class="fa fa-info-circle"></i> Crediti immagine</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
  <?php
  } // has_post_thumbnail STOP
  else {

    $image_esiste=0;
    //$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
    if ($img1==NULL) {
    	//$img1=$nullimg;
    	if ($img1ext==NULL){$image_esiste=0;}
    	else{$img1=site_url($path, $scheme).'/store_public/'.$img1ext;$image_esiste=1;}
    }
    else {$image_esiste=1;}

    if ($image_esiste==1){

	    $titolo_opera = get_field('titolo_opera');

?>
	      <div itemscope itemtype="http://schema.org/ImageObject">
	        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="item active">
            	<?php
            		echo"<!-- $img1 -->";
            	?>
              <img data-holder-rendered="true" src="<?php return_thumb_main($img1); ?>"
              <?php
              if ($titolo_opera==NULL){echo"alt='".the_title()."'";}
			        else{echo"alt='".$titolo_opera."'";}
              ?>
              width="100%" itemprop="contentUrl" />
			          <div class="carousel-caption" style='background-color:RGBA(0,0,0,0.5);'>
  <?php

      echo"<meta itemprop='contentLocation' content='$address' />";
      if ($titolo_opera==NULL){}
      else{echo"<span itemprop='name'> $titolo_opera</span> ";}

      $licenza = get_field('licenza');
      if ($titolo_opera=='nd'){echo"Licenza non definita<br>";}
      else{echo"$licenza<br>";}

      $nome_autore = get_field('nome_autore');
      if ($nome_autore==NULL){}
      else{
      	$url_autore = get_field('url_autore');
      	if ($url_autore==NULL){echo"$nome_autore ";}
      	else{echo"<a href='$url_autore' style='color:#AD8F92'><span itemprop='author'>$nome_autore</span></a> ";}
      }

      $tipo_opera = get_field('tipo_opera');
      if ($tipo_opera==NULL){}
      else{echo"$tipo_opera ";}

      $fonte_opera = get_field('fonte_opera');
      if ($fonte_opera==NULL){}
      else{echo"<a href='$fonte_opera' style='color:#AD8F92'>Link a fonte opera</a>";}

      echo"</p>";
  ?>
			          </div>
              </div>
            </div>
          </div>
  	    </div>

<?php /*endforeach; */?>

<?php
    }
  } // has_post_thumbnail ELSE STOP
  // POST THUMBNAIL STOP

visualizza_galleria($postid);
?>
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

<?php
//SLIDER END
?>

        <?php show_block_title_poi($postid); ?>
        <p style="margin-bottom: 15px;">
          <span class="vcard author" style="font-size:10px;"><span class="fn">
            Pubblicato da <a href="https://plus.google.com/+PJHooker"
            rel="author"><?php echo"Monferrato Paesaggi"; ?></a>
          </span></span>
          <span style="font-size:10px;margin-bottom: 15px;" class='date updated'> il <?php the_time('j F Y'); ?></span>
        </p>
		    <?php the_content();/*the_meta();*/ ?>


        <div class="clear" style="padding-bottom:15px;"></div>

		    <?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','intent'),'after'=>'</div>')); ?>
		    <div class="clear"></div>
      </div>

    	<?php if(!wpb_option('post-hide-tags')): // Post Tags ?>
    		<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','intent').'</span> ','','</p>'); ?>
    	<?php endif; ?>
    </article>
  </div> <!--<div class="col-sm-8 blog-main">-->
  <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div itemscope itemtype="http://schema.org/TouristAttraction">
      <meta itemprop='hasMap' content='http://www.openstreetmap.org/#map=19/$lat/$lng' />
			<div class="panel panel-default">
	      <div class="panel-heading">
	        <span itemprop="name"><?php echo the_title()."<meta itemprop='address' content='$address' />";?></span>
	          <h3 class="panel-title">Informazioni aggiuntive</h3>
	      </div>
	      <div class="panel-body">
  				<table class="table">
  	        <tbody>
              <tr>
                <td><i class="fa fa-car"></i></td>
                <td><a href="?page_id=<?php echo $percorso; ?>">Torna al percorso</a></td>
              </tr>
              <tr>
                <td><i class="fa fa-home"></i></td>
                <td>
                  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                	<?php
                	$id_comune = get_field('id_comune');
                	$plink_comune = get_permalink($id_comune);
                	$comune = get_the_title($id_comune);
                	/*}
                	else{$comune=get_field('nome_comune');}
                	*/
                	echo "
                		<a href='$plink_comune'>Comune di <span itemprop='addressLocality'>$comune</span></a>
                		<meta itemprop='addressRegion' content='Piemonte, Italy' />
                	";
                	?>
    			        </div>
  			        </td>
              </tr>
              <tr>
                <td><i class="fa fa-map-marker"></i></td>
                <td>
                  <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                  <?php
                  if($lat==NULL || $lat==0){

                  $plinkid=get_permalink(10839);echo " <a href='$plinkid?new_postid=$postid' class='btn btn-warning'>Conosci il posto?</a>";
                  }
                  else{
                  	echo "<a href='http://www.openstreetmap.org/#map=19/$lat/$lng'>".substr($lat, 0, 6)." - ".substr($lng, 0, 5)."</a>
                  			                	<meta itemprop='latitude' content='$lat' />
                  			                	<meta itemprop='longitude' content='$lng' />";
                  }
                  ?>
                  </div>
                </td>
              </tr>
              <tr>
                <td><i class='fa fa-pencil-square-o'></i></td>
                <td>
  	            <?php
      					$osm_id = get_field('osm_id');
      					if ($osm_id==NULL){
                  // disabilitato, da sistemare perchè troppo tempo per caricare
                  // 1) si può creare una pagina di controllo per attivare varie opzioni
                  // 2) si abilita un utente per fare queste cose
                  /*
      						echo"<a href='http://www.openstreetmap.org/#map=19/$lat/$lng'>Questo elemento non è stato mappato in OpenStreetMap: MAPPALO!</a>";

      						search_osm_elements($postid,$user,'lite');
      						if(isset($_POST['invia_osm']))
      						    {
      						    	$invia_osm=$_POST['osmlist'];
      						    	insert_osm_in_post($postid,$invia_osm);
      						    }
      						else{}
                  */
                  echo"
      							<a href='http://www.openstreetmap.org/#map=19/$lat/$lng'>Questo elemento non è stato mappato in OpenStreetMap: MAPPALO!</a>
      						";
                }
      					else{
      						echo"
      							<a href='$osm_id'>Questo elemento è stato mappato in OpenStreetMap</a>
      						";
      					}
  	            ?>
                </td>
              </tr>
              <tr>
                <td><i class='fa fa-file-text'></i></td>
                <td>
    	          <?php
      					$wiki_id = get_field('wiki_id',$id);
      					if ($wiki_id==NULL){
      						echo"<a href='https://it.wikipedia.org/wiki/Wikipedia:Cinque_pilastri'>Questo elemento non è stato Wikizzato: FALLO TU!</a>";
      					}
      					else{
      						echo"
      							<meta itemprop='sameAs' content='$wiki_id' />
      							<a href='$wiki_id'>Questo elemento è presente in Wikipedia</a></span>
      						";
      					}
    	          ?>
                </td>
              </tr>
              <tr>
                <td><i class='fa fa-rocket'></i></td>
                <td><h1>
      	        <?php
      					if ($lat==NULL){
      						echo"<i class='fa fa-star-o' title='Nessun punteggio per coordinate'></i>";
      					}
      					else{
      						echo"<i class='fa fa-star fa-3' title='+1 per aver aggiunto coordinate'></i>";
      					}
      					if ($osm_id==NULL){
      						echo" <i class='fa fa-star-o fa-3' title='Nessun punteggio per OpenStreetMap'></i>";
      					}
      					else{
      						echo" <i class='fa fa-star fa-3' title='+1 per aver aggiunto OpenStreetMap'>";
      					}
      					if ($wiki_id==NULL){
      						echo" <i class='fa fa-star-o fa-3' title='Nessun punteggio per Wikipedia'></i>";
      					}
      					else{
      						echo" <i class='fa fa-star fa-3' title='+1 per aver aggiunto Wikipedia'>";
      					}
      					if ($image_esiste==0){
      						echo" <i class='fa fa-star-o fa-3' title='Nessun punteggio per aggiunta immagini'></i>";
      					}
      					else{
      						echo" <i class='fa fa-star fa-3' title='+1 per aver aggiunto una immagine'>";
      					}

      					$str_content = strip_tags(get_the_content());
      					$words = explode(" ", $str_content);
      					$count_word=count($words);

      					if ($count_word<300){
      						echo" <i class='fa fa-star-o fa-3' title='Nessun punteggio per parole'></i> ";
      					}
      					else{
      						echo" <i class='fa fa-star fa-3' title='+1 per aver raggiunto le 300 parole'>";
      					}
      	        ?>
                </h1></td>
              </tr>
            </tbody>
          </table>
          <?php show_menu_admin($user); ?>
  	    </div><!--<div class="panel-body">-->
      </div> <!--class="panel panel-default">-->
    </div><!-- itemscope itemtype="http://schema.org/TouristAttraction">  -->
  </div><!--<div class="col-sm-3 blog-main">-->
</div><!--<div ROW>-->
<div class="row" style='padding-top:15px;'>

  <?php
  if($lat==NULL || $lat==0){
    $plinkid=get_permalink(10839);echo " <a href='$plinkid&new_postid=$postid' class='btn btn-warning'>Conosci questo posto? Mappalo!</a>";
    ?>
    <div class="col-sm-12 blog-main">
    <?php
  }
  else{
  ?>
    <div class="col-sm-6 blog-main">
  <?php
  if ($address==NULL){}
  else{echo "
  <div class='alert alert-info' role='alert'>
    <i class='fa fa-location-arrow'></i> <strong>$address</strong> $lat, $lng.
  </div>
  ";}
  ?>
    <div id='map'></div>
    	<script type="text/javascript">
    		var lon = <?php echo $lng; ?>,
    		lat = <?php echo $lat; ?>
    	</script>
    	<script src='http://www.monferratopaesaggi.org/js/mappa_scheda_poi_leaflet.js'></script>
    	<script src='http://www.monferratopaesaggi.org/geodata/pl_linee_pano_0.js'></script>
    	<script src='http://www.monferratopaesaggi.org/geodata/poi_monferrato.js'></script>

    	<script src='http://www.monferratopaesaggi.org/geodata/poi_monferrato.js'></script>
    </div>
    <div class="col-sm-6 blog-main">
  <?php
  }
  ?>

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
  </div>
</div>
<?php endwhile;?>

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

  var poi_extra = new L.featureGroup();

  // geometria FONTANA
  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_fontana.geojson", function(data) {
    var geojson = new L.geoJson(data,{
        pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/water-24@2x.png',
            iconSize:     [20, 24],
            iconAnchor:   [12, 12]
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON
    poi_extra.addLayer(geojson);
	});
  // geometria FONTANA -end
  // geometria PARCHEGGI
  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_parcheggi.geojson", function(data) {
    var geojson = new L.geoJson(data,{
        pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/parking-24@2x.png',
            iconSize:     [20, 24],
            iconAnchor:   [12, 12]
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON
    poi_extra.addLayer(geojson);
	});
  // geometria PARCHEGGI -end
  // geometria WC
  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_wc.geojson", function(data) {
    var geojson = new L.geoJson(data,{
        pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
          icon: L.icon({
            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/toilets-24@2x.png',
            iconSize:     [30, 30],
            iconAnchor:   [15, 15]
          })  // L.icon
        })    // L.marker
      }       //pointToLayer: function
    });       //var exp_regJSON
    poi_extra.addLayer(geojson);
    map.addLayer(poi_extra);
	});
  // geometria WC -end

  var circle = L.circle([lat, lon], 30, {
      color: 'red',
      fillColor: 'white',
      fillOpacity: 0.2
  }).addTo(map);

  var baseMaps = {
    'Google Hybrid': googleLayer,
    'OSM Standard': basemap_0,
  };

  L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON,"Parcheggi, fontane, WC": poi_extra},{collapsed:false}).addTo(map);

</script>
