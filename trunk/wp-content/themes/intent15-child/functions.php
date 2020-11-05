<?php

function prova(){
	return "Aaa";
/*
1997) **profili**  		sud
1993) **po** 			po
1989) **miniere** 		miniera
1987) **bric** 			bosco
1971) **crea** 			crea
1969) **vigne**			grignolino


*/

}

function normalize_percorso($ID,$TYPE){
	if ($ID==1997) {
		$nome_vero='profili';
		$tag='percorso_sud';
	}
	else if ($ID==1993) {
		$nome_vero='po';
		$tag='percorso_po';
	}
	else if ($ID==1989) {
		$nome_vero='miniere';
		$tag='percorso_miniera';
	}
	else if ($ID==10617) {
		$nome_vero='miniere';
		$tag='percorso_miniera';
	}
	else if ($ID==1987) {
		$nome_vero='bric';
		$tag='percorso_bosco';
	}
	else if ($ID==1971) {
		$nome_vero='crea';
		$tag='percorso_crea';
	}
	else if ($ID==1969) {
		$nome_vero='vigne';
		$tag='percorso_grignolino';
	}
	else{
		$nome_vero='';
	}

	if($TYPE=='nome_vero'){return $nome_vero;}
	else if ($TYPE=='tag'){return $tag;}
	else if ($TYPE=='titolo_breve'){
		$text=explode("|",get_the_title($ID));
		return $text[0];
	}
	else{return 'variabile TYPE non definita';}

}

function colore_percorso($ID){
  $colore_percorso = get_field('colore_percorso',$ID);
  echo "'$colore_percorso'";
}
function nome_percorso($ID){
  //$nome_percorso = get_the_title($ID);
	$nome_percorso = normalize_percorso($ID,'titolo_breve');
  echo "'$nome_percorso'";
}


function format_text($TEXT){
    $text = str_replace('"', '', $TEXT);
		$text = str_replace("'", '', $TEXT);
    $text = strip_tags($text);
    $text = trim(preg_replace('/\s\s+/', ' ', $text));
    return $text;
}
function format_location($ID,$TYPE){

  $loctxt = get_field('map_txt',$ID);
  $location = get_field('map',$ID);
	$location_att = get_field('att_map',$ID);

  if(!empty($location_att)){
		$location = get_field('att_map',$ID); // MANCA l'ID !!!
		if( !empty($location) ):
			$lat=$location['lat'];
			$lng=$location['lng'];
			$address=$location['address'];
		endif; // lat lng
	}
	else{
	  if(!empty($loctxt)){
	    $arrloc=explode(',',$loctxt);
	    $lat=$arrloc[0];
	    $lng=$arrloc[1];
	  }
	  else if(!empty($location)){
	    $location = get_field('map',$ID); // MANCA l'ID !!!
	    if( !empty($location) ):
	      $lat=$location['lat'];
	      $lng=$location['lng'];
	      $address=$location['address'];
	    endif; // lat lng
	  }
	  else{
	    $lat=0;
	    $lng=0;
	    $address=0;
	  }
	}

  if ($TYPE=='lat'){return $lat;}
  else if ($TYPE=='lng'){return $lng;}
  else if ($TYPE=='address'){return $address;}
  else{}


}


function menu_segreto() {

$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);

if (
      /*implode(', ', $user_info->roles)=='administrator'
      */
      $user_ID==1){

echo"
    <div style='
    margin: 5px 0px 15px;
    background-color: #FFF;
    border-left: 4px solid #7AD03A;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.1);
    padding: 5px;
    '>
        Menù segreto:
<a href='http://www.monferratopaesaggi.org/?p=2301'>Aggiorna kml POI</a> -
<a href='http://www.monferratopaesaggi.org/?p=2547'>Aggiorna kml Percorsi + BUFF</a> -
<a href='http://www.monferratopaesaggi.org/?page_id=2349'>Insert POI da DB</a><br>
</div>
";

}

else {echo"<hr>";}


}

/*
 * inserisci_nuovo_post_progress
 *
 *
 */

function inserisci_nuovo_post_progress($myid) {

//$date=date("Y").date("m").date("d");

// Create post object
$my_post = array(
  'post_title'    => wp_strip_all_tags('Gallery - POI:'.$myid),
  'post_content'  => 'Inserire al posto di questo testo la Galleria',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array(70), //Interni POI (Galleria)
  'tags_input'     => ''
);

// Insert the post into the database
//wp_insert_post( $my_post );
$post_id = wp_insert_post( $my_post, $wp_error );

//now you can use $post_id withing add_post_meta or update_post_meta

// Questo aggiunge un custom field RELAZIONE
add_post_meta( $post_id, 'relazione', $myid );

// Questo aggiunge un custom field TEMPLATE
add_post_meta( $post_id, 'template', 'galleria-poi' );

echo "<meta http-equiv='refresh' content='0;url=#'>";

}

/*
 *
 * CREA FILE GeoJSON
 * nelle scehde POI
 * ogni volta che viene visualizzato il POI
 * quindi ogni volta che viene modificato un POI
 *
 */

function crea_geojson_poi_schedapoi() {

//crea JSON
$myFile = "./geodata/textfile.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$myFileJS = "./geodata/poi_monferrato.js";
$fhJS = fopen($myFileJS, 'w') or die("can't open file");

//crea JSON
$myFileT = "./geodata/tofusiontable.txt";
$fhT = fopen($myFileT, 'w') or die("can't open file");

$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);

fwrite($fhJS, 'var exp_poi='.$stringData);
/*
// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'meta_key' => 'mappa', 'meta_value' => 'prova' ) );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post(15);
*/

/* The loop */
//while ( have_posts() ) : the_post();

//$args = array( 'posts_per_page' => -1, 'category' => 52 );
//$myposts = get_posts( $args );

//foreach ( $myposts as $post ) : setup_postdata( $post );

/*
 * Query per generare il loop
 * per tutti (-1) i post
 * nella categoria specificata (52)
 *
 */
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, post_status => 'publish'));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();



// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$postid = get_the_ID();
$id_comune = get_field('id_comune');
$comune = get_the_title($id_comune);


// Immagine nel popup
$url_image = get_field('immagine_evidenza');
$imH='200';
$imW='300';

// Inserisce l'immagine nel popup solo se esiste una immagine in evidenza
$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';

if (substr($url_image, 0, 4)=='http') {$tofusiontable=1;
    $url_image=return_thumb_popup($url_image);
    //$url_image="http://www.monferratopaesaggi.org/image.php?myimage=$url_image&h=$imH&w=$imW";
}
else { $tofusiontable=0;
	$url_image="noimage";
}

// prende le coordinate dal meta 'map'
$location = get_field('map');
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng'];
endif; // lat lng

if ($lat==NULL){}
else if ($lat==0){}
else{

$count_poi++;

// Genera una proprietà del file GeoJson che inserisce un box con immagine e link (deprecated)
// $url='<iframe src="http://www.tiellex.org/cityplanner/php/ol_map_geopost2_frame.php?post_id='.$Zm.'" height="200" />';
// $url="<a href='".$plink."'>".$title."</a><br><img src='".$url_image."' style='width:150px;height:auto;'>";

// IconUrl di defaul, se non definita
//$iconurl='http://www.cityplanner.it/supply/icon_web/set2/icon_2429.png';
$iconurl='http://maps.gstatic.com/mapfiles/ms2/micons/blue.png';

$tipo = get_field('field_53524fd43715d');
if ($tipo=='blue'){$tipo='none';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/vuoto.png';$tipoIcon='wht_blank';}
else if ($tipo=='ed-religioso'){$tipo='edreligioso';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/chiesa.png';$tipoIcon='grn_stars';}
else if ($tipo=='ed-storico'){$tipo='edstorico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/ed_storico.png';$tipoIcon='ltblu_stars';}
else if ($tipo=='punto-oss'){$tipo='puntooss';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/punto_panoramico.png';$tipoIcon='binoculars';}
else if ($tipo=='parcheggio'){$tipo='parcheggio';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/parcheggio.png';$tipoIcon='';}
else if ($tipo=='info'){$tipo='info';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/info.png';$tipoIcon='parking_lot';}
else if ($tipo=='arc_industriale'){$tipo='arc_industriale';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/arch_industriale.png';$tipoIcon='orange_stars';}
else if ($tipo=='centro_storico'){$tipo='centro_storico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/centro_storico.png';$tipoIcon='pink_stars';}
else if ($tipo=='fontana'){$tipo='fontana';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/fontana.png';$tipoIcon='measle_turquoise';}
else if ($tipo=='museo'){$tipo='museo';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/museo.png';$tipoIcon='purple_stars';}
else if ($tipo=='wc'){$tipo='wc';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/wc.png';$tipoIcon='toilets';}
else if ($tipo=='interesse_paesaggistico'){$tipo='interesse_paesaggistico';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/interesse_paesaggistico.png';$tipoIcon='red_stars';}
else if ($tipo=='picnic'){$tipo='picnic';       $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/pic-nic.png';$tipoIcon='campfire';}
else if ($tipo=='teatro'){$tipo='teatro';       $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/teatro.png';$tipoIcon='wht_stars';}
else if ($tipo=='ed_civile'){$tipo='ed_civile'; $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/edificio-civile.png';$tipoIcon='ylw_stars';}
else if ($tipo=='infernot'){$tipo='infernot';   $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/infenot.png';$tipoIcon='capital_small_highlight';}
else if ($tipo=='giardino'){$tipo='giardino';   $iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/parco-giardino.png';$tipoIcon='parks';}

// --- altre categorie abbandonate
//else if ($tipo=='attivita-e-prodotti'){$tipo='attivitaprodotti';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/attivita-e-prodotti.png';}
//else if ($tipo=='casetta-acqua'){$tipo='casettaacqua';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/casetta-acqua.png';}
//else if ($tipo=='bedbreak'){$tipo='bedbreak';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/bedbreak.png';}
//else if ($tipo=='ristorante'){$tipo='ristorante';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/ristorante.png';}
//else if ($tipo=='hotel'){$tipo='hotel';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/hotel.png';}

else {$tipo='none';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/vuoto.png';}

if($count_poi==1){$comma='';}
else {$comma=', ';}

$stringData = $comma.' { "geometry" : { "coordinates" : ['.$lng.',
            '.$lat.'
              ],
            "type" : "Point"
          },
        "properties" : { "colour" : "#ffffff", "progressiv" : "'.$count_poi.'",  "unico":"'.$postid.'", "picture":"'.$url_image.'","titolo":"'.$title.'","url_post":"'.$plink.'","tipo":"'.$tipo.'",
            "wpid_comune":"'.$id_comune.'","comune":"'.$comune.'","imageurl" : "'.$iconurl.'"
          },
        "type" : "Feature"
      }
';
fwrite($fh, $stringData);
fwrite($fhJS, $stringData);

if ($tofusiontable==1){
$stringDataT = '"Monferrato Paesaggi","http://monferratopaesaggi.org/","'.$title.'","'.$url_image.'","'.$plink.'","'.$tipo.'","'.$tipoIcon.'","2014-09-10","'.$lat.','.$lng.'"
';
fwrite($fhT, $stringDataT);
}

}

/*
endwhile;
// Reset Post Data
wp_reset_postdata();
*/

endwhile;
// Reset Post Data
wp_reset_postdata();

/*
endforeach;
wp_reset_postdata();
endwhile;
*/


$stringData = '
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fh, $stringData);
fclose($fh);
fwrite($fhJS, $stringData);
fclose($fhJS);
}

function crea_geojson_poi_schedapoi_singolo($ID) {

//crea JSON
$myFile = "./geodata/single_poi.json";
$fh = fopen($myFile, 'w') or die("can't open file");



$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);


// TITOLO
$title=get_the_title($ID);
$title = str_replace('"', '', $title);
$plink=get_permalink($ID);
$postid = $ID;

// Immagine nel popup
$url_image = get_field('immagine_evidenza',$ID);
$imH='200';
$imW='300';

// Inserisce l'immagine nel popup solo se esiste una immagine in evidenza
$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
if ($url_image==NULL) {
  $url_image=$nullimg;
}
else {
  $url_image="http://www.monferratopaesaggi.org/image.php?myimage=$url_image&h=$imH&w=$imW";
}


// prende le coordinate dal meta 'map'
$location = get_field('map',$ID);
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng'];
endif; // lat lng

// Genera una proprietà del file GeoJson che inserisce un box con immagine e link (deprecated)
// $url='<iframe src="http://www.tiellex.org/cityplanner/php/ol_map_geopost2_frame.php?post_id='.$Zm.'" height="200" />';
// $url="<a href='".$plink."'>".$title."</a><br><img src='".$url_image."' style='width:150px;height:auto;'>";

// IconUrl di defaul, se non definita
//$iconurl='http://www.cityplanner.it/supply/icon_web/set2/icon_2429.png';
$iconurl='http://maps.gstatic.com/mapfiles/ms2/micons/blue.png';

$tipo = get_field('field_53524fd43715d',$ID);
$tipo='none';$iconurl='http://www.monferratopaesaggi.org/wp-content/uploads/vuoto.png';


$stringData = ' { "geometry" : { "coordinates" : ['.$lng.',
            '.$lat.'
              ],
            "type" : "Point"
          },
        "properties" : { "Colour" : "#ffffff", "progressivo" : "'.$count_poi.'",  "unico":"'.$postid.'", "picture":"'.$url_image.'","titolo":"'.$title.'","url_post":"'.$plink.'","tipo":"'.$tipo.'",
            "ImageURL" : "'.$iconurl.'"
          },
        "type" : "Feature"
      },
';
fwrite($fh, $stringData);


$stringData = '
  { "geometry" : { "coordinates" : [ 0,
                0
              ],
            "type" : "Point"
          },
        "properties" : { "Colour" : "#ffffff",
            "ImageURL" : "/360Scheduling/Content/Images/ByBox.png"
          },
        "type" : "Feature"
      }
    ],
  "type" : "FeatureCollection"
}
';
fwrite($fh, $stringData);
fclose($fh);
}

function crea_csv_elenco_comuni_id() {

//crea JSON
$myFile = site_url($path, $scheme)."/elenco_comuni.csv";
$fh = fopen($myFile, 'w') or die("can't open file");


$the_query = new WP_Query(array('posts_per_page' => -1,'post_type' => 'portfolio'));
$count_poi=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

// TITOLO
$title=get_the_title();
$title = str_replace('"', '', $title);
$plink=get_permalink();
$postid = get_the_ID();

$stringData = $title.','.$postid.'
';
fwrite($fh, $stringData);


endwhile;
// Reset Post Data
wp_reset_postdata();

}

function legge_tabella_plus($table){

global $wpdb;

// --- LIMIT --- $result = $wpdb->get_results("SELECT * FROM wp_odpmtb_punti_pg  LIMIT 0, 2");
$result = $wpdb->get_results("SELECT * FROM $table");

echo"Ciao<ul>";
//    2. visualizzazione dei record, comprensivi di intestazione di colonna;
foreach($result as $r) {
echo"<li>".$r->unico."";
echo" - ".$r->comune."";
echo" - ".$r->wpid_comune."</li>";

// Questo aggiunge un custom field PROVA
add_post_meta( $r->unico, 'id_comune', $r->wpid_comune );
add_post_meta( $r->unico, 'nome_comune', $r->comune );
}
echo"</ul>";
/*


// ABILITA INSERIMENTO NUOV POST
// Create post object
$my_post = array(
  'post_title'    => $r->name,
  'post_content'  => substr($r->descriptio, 1, -1),
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array(52) // CATEGORIA ID 52 "TEST01 risultato"
);

// Insert the post into the database
//wp_insert_post( $my_post );
$post_id = wp_insert_post( $my_post, $wp_error );
//now you can use $post_id withing add_post_meta or update_post_meta





*/

}

function scheda_comune_div_elenco_percorsi($ID,$TAB){

echo"
<div style='display: block;'' id='$TAB' class='tab'>
  <div class='tab-content'>
    <table>
";

// The Query to show a specific Custom Field

$the_query = new WP_Query( array( 'meta_key' => 'link_comune', 'meta_value' => $ID ) );
$i=0;
while ( $the_query->have_posts() ) : $the_query->the_post();
$i++;
endwhile;

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
echo"<tr>";
echo"<td><a href='". get_permalink() ."' target='_blank'>" . get_the_title() . "</a></td>";
echo"</tr>";
endwhile;

// Reset Post Data
wp_reset_postdata();

echo"
    </table>
  </div>
</div>
";
}

function get_myicon($tipo,$quale){

$elsenovariabile='hai dimenticato la variabile quale';

if ($tipo=='blue'){
  if ($quale=='tiponew'){return 'none';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/vuoto1.png';}
  else if ($quale=='tipoIcon'){return 'wht_blank';}
  else if ($quale=='human'){return 'Non è stata definita nessuna categoria';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'bed', markerColor: 'green', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='ed-religioso' || $tipo=='edreligioso' ){
  if ($quale=='tiponew'){return 'edreligioso';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/chiesa.png';}
  else if ($quale=='tipoIcon'){return 'grn_stars';}
  else if ($quale=='human'){return 'Edificio religioso (OSM amenity=place_of_worship or landuse=cemetery)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'plus', markerColor: 'red', prefix: 'fa'})";}
  else{return $elsenovariabile;}
}
else if ($tipo=='ed-storico' || $tipo=='edstorico' ){
  if ($quale=='tiponew'){return 'edstorico';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/ed_storico.png';}
  else if ($quale=='tipoIcon'){return 'ltblu_stars';}
  else if ($quale=='human'){return 'Edificio storico (OSM historic=castle)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'bank', markerColor: 'red', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='punto-oss' || $tipo=='puntooss' ){
  if ($quale=='tiponew'){return 'puntooss';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/punto_panoramico.png';}
  else if ($quale=='tipoIcon'){return 'binoculars';}
  else if ($quale=='human'){return 'Punto di osservazione (OSM tourism=viewpoint)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'eye', markerColor: 'yellow', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='parcheggio'){
  if ($quale=='tiponew'){return 'parcheggio';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/parcheggio.png';}
  else if ($quale=='tipoIcon'){return '';}
  else if ($quale=='human'){return 'Parcheggio consigliato (OSM amenity=parking or tourism=caravan_site)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'car', markerColor: 'blue', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='info'){
  if ($quale=='tiponew'){return 'info';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/info.png';}
  else if ($quale=='tipoIcon'){return 'parking_lot';}
  else if ($quale=='human'){return 'Info point (OSM tourism=information)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'info', markerColor: 'blue', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='arc_industriale'){
  if ($quale=='tiponew'){return 'arc_industriale';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/arch_industriale.png';}
  else if ($quale=='tipoIcon'){return 'orange_stars';}
  else if ($quale=='human'){return 'Archeologia industriale (OSM historic=ruins)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'industry', markerColor: 'red', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='centro_storico'){
  if ($quale=='tiponew'){return 'centro_storico';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/centro_storico.png';}
  else if ($quale=='tipoIcon'){return 'pink_stars';}
  else if ($quale=='human'){return 'Centro storico (OSM admin_level=8)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'cubes', markerColor: 'red', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='fontana'){
  if ($quale=='tiponew'){return 'fontana';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/fontana.png';}
  else if ($quale=='tipoIcon'){return 'measle_turquoise';}
  else if ($quale=='human'){return 'Fontana (OSM amenity=drinking_water)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'waterdrop', markerColor: 'blue', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='museo'){
  if ($quale=='tiponew'){return 'museo';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/museo.png';}
  else if ($quale=='tipoIcon'){return 'purple_stars';}
  else if ($quale=='human'){return 'Museo (OSM tourism=museum)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'ios-glasses-outline', markerColor: 'red', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='wc'){
  if ($quale=='tiponew'){return 'wc';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/wc.png';}
  else if ($quale=='tipoIcon'){return 'toilets';}
  else if ($quale=='human'){return 'Servizi igenici - w.c. (OSM amenity=toilets)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'user', markerColor: 'blue', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='interesse_paesaggistico'){
  if ($quale=='tiponew'){return 'interesse_paesaggistico';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/interesse_paesaggistico.png';}
  else if ($quale=='tipoIcon'){return 'red_stars';}
  else if ($quale=='human'){return 'Elemento di interesse paesaggistico (OSM tourism=attraction)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'ios-medical', markerColor: 'yellow', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='picnic'){
  if ($quale=='tiponew'){return 'picnic';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/pic-nic1.png';}
  else if ($quale=='tipoIcon'){return 'campfire';}
  else if ($quale=='human'){return 'Area pic-nic (OSM tourism=picnic_site)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'tree', markerColor: 'blue', prefix: 'fa'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='teatro'){
  if ($quale=='tiponew'){return 'teatro';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/teatro.png';}
  else if ($quale=='tipoIcon'){return 'wht_stars';}
  else if ($quale=='human'){return 'Teatro (OSM amenity=theatre)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'ios-body', markerColor: 'red', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='ed_civile'){
  if ($quale=='tiponew'){return 'ed_civile';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/edificio-civile.png';}
  else if ($quale=='tipoIcon'){return 'ylw_stars';}
  else if ($quale=='human'){return 'Edificio civile (OSM amenity= (public_building or community_centre or amenity=school))';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'android-wifi', markerColor: 'red', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='infernot'){
  if ($quale=='tiponew'){return 'infernot';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/infenot.png';}
  else if ($quale=='tipoIcon'){return 'capital_small_highlight';}
  else if ($quale=='human'){return 'Infernot (OSM tourism=wine_cellar)';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'wineglass', markerColor: 'yellow', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}
else if ($tipo=='giardino'){
  if ($quale=='tiponew'){return 'giardino';}
  else if ($quale=='iconurl'){return 'http://www.monferratopaesaggi.org/wp-content/uploads/parco-giardino.png';}
  else if ($quale=='tipoIcon'){return 'parks';}
  else if ($quale=='human'){return 'Parco o giardino attrezzato (OSM leisure=(park or garden))';}
	else if ($quale=='AwesomeMarkers'){return "L.AwesomeMarkers.icon({icon: 'heart', markerColor: 'yellow', prefix: 'ion'})";}
  else {return $elsenovariabile;}
}

}

function scheda_comune_div_elenco_poi1($ID,$TAB){

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'id_comune', 'meta_value'=>$ID, 'orderby' => 'title', 'order' => 'ASC'));

// Elenca POI
while ( $the_query->have_posts() ) : $the_query->the_post();

  $title=get_the_title();
  $id_comune=get_field('id_comune');
  $plink=get_permalink();
  $tipo = get_field('field_53524fd43715d');
  if ($tipo=='blue' OR $tipo=='wc' OR $tipo=='info' OR $tipo=='fontana' OR $tipo=='parcheggio'){}
  else{
    $i++;
    if ($i==1){$virgola='';}else{$virgola=', ';}
    echo"$virgola<a href='$plink'>$title</a>";
  }

endwhile;

wp_reset_postdata();
}

function scheda_comune_div_elenco_poi2($ID,$TAB){


$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'id_comune', 'meta_value'=>$ID, 'orderby' => 'title', 'order' => 'ASC'));


$altri=0;
$edreligioso=0;
$edstorico=0;
$puntooss=0;
$parcheggio=0;
$info=0;
$arc_industriale=0;
$centro_storico=0;
$fontana=0;
$museo=0;
$wc=0;
$interesse_paesaggistico=0;
$picnic=0;
$teatro=0;
$ed_civile=0;
$infernot=0;
$giardino=0;

// Elenca POI
while ( $the_query->have_posts() ) : $the_query->the_post();
$title=get_the_title();
$id_comune=get_field('id_comune');
$plink=get_permalink();
$i++;
if ($i==1){$virgola='';}else{$virgola=', ';}

//
$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$altri++;}
else if ($tipo=='ed-religioso'){$edreligioso++;}
else if ($tipo=='ed-storico'){$edstorico++;}
else if ($tipo=='punto-oss'){$puntooss++;}
else if ($tipo=='arc_industriale'){$arc_industriale++;}
else if ($tipo=='centro_storico'){$centro_storico++;}
else if ($tipo=='museo'){$museo++;}
else if ($tipo=='interesse_paesaggistico'){$interesse_paesaggistico++;}
else if ($tipo=='picnic'){$picnic++;}
else if ($tipo=='teatro'){$teatro++;}
else if ($tipo=='ed_civile'){$ed_civile++;}
else if ($tipo=='infernot'){$infernot++;}
else if ($tipo=='giardino'){$giardino++;}
else{$altri++;}

endwhile;
echo"
  <div class='row'>
    <div class='panel panel-default'>
      <div class='panel-body'>
        <div class='row'>
          <div class='col-md-12' style='text-align:center;'><h3><span class='label label-primary' width='100%'>POI totali $i</span></h3></div>
        </div>
        <div class='row' style='padding-top:15px;'>
";
if($edreligioso==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('ed-religioso','iconurl')."' width='50px'><br><span class='label label-danger'>$edreligioso</span></div>";}
if($edstorico==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('ed-storico','iconurl')."' width='50px'><br><span class='label label-danger'>$edstorico</span></div>";}
if($puntooss==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('punto-oss','iconurl')."' width='50px'><br><span class='label label-danger'>$puntooss</span></div>";}
if($arc_industriale==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('arc_industriale','iconurl')."' width='50px'><br><span class='label label-danger'>$arc_industriale</span></div>";}
if($centro_storico==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('centro_storico','iconurl')."' width='50px'><br><span class='label label-danger'>$centro_storico</span></div>";}
if($museo==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('museo','iconurl')."' width='50px'><br><span class='label label-danger'>$museo</div>";}
if($interesse_paesaggistico==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:5px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('interesse_paesaggistico','iconurl')."' width='50px'><br><span class='label label-danger'>$interesse_paesaggistico</span></div>";}
if($picnic==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('picnic','iconurl')."' width='50px'><br><span class='label label-danger'>$picnic</span></div>";}
if($teatro==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('teatro','iconurl')."' width='50px'><br><span class='label label-danger'>$teatro</span></div>";}
if($ed_civile==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('ed_civile','iconurl')."' width='50px'><br><span class='label label-danger'>$ed_civile</span></div>";}
if($infernot==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('infernot','iconurl')."' width='50px'><br><span class='label label-danger'>$infernot</span></div>";}
if($giardino==0){}else{$col++;if($col<5){}else {echo"</div><div class='row' style='padding-top:15px;'>";$col=1;} echo"<div class='col-md-3' style='text-align:center;'><img src='".get_myicon('giardino','iconurl')."' width='50px'><br><span class='label label-danger'>$giardino</span></div>";}
echo"
        </div>
        <div class='row' style='padding-top:15px;'>
          <div class='col-md-12' style='text-align:center;'><h3><span class='label label-success' width='100%'>Altri $altri</span></h3></div>
        </div>
      </div>
    </div>
  </div>
";

// Reset Post Data
wp_reset_postdata();

}


function scheda_comune_div_elenco_poi($ID,$TAB){

echo"
<div id='$TAB' class='tab'>
  <div class='tab-content'>
";
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'id_comune', 'meta_value'=>$ID, 'orderby' => 'title', 'order' => 'ASC'));


$altri=0;
$edreligioso=0;
$edstorico=0;
$puntooss=0;
$parcheggio=0;
$info=0;
$arc_industriale=0;
$centro_storico=0;
$fontana=0;
$museo=0;
$wc=0;
$interesse_paesaggistico=0;
$picnic=0;
$teatro=0;
$ed_civile=0;
$infernot=0;
$giardino=0;

// Elenca POI
while ( $the_query->have_posts() ) : $the_query->the_post();
$title=get_the_title();
$id_comune=get_field('id_comune');
$plink=get_permalink();
$i++;
if ($i==1){$virgola='';}else{$virgola=', ';}
echo"$virgola<a href='$plink'>$title</a>";

//
$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$altri++;}
else if ($tipo=='ed-religioso'){$edreligioso++;}
else if ($tipo=='ed-storico'){$edstorico++;}
else if ($tipo=='punto-oss'){$puntooss++;}
else if ($tipo=='parcheggio'){$parcheggio++;}
else if ($tipo=='info'){$info++;}
else if ($tipo=='arc_industriale'){$arc_industriale++;}
else if ($tipo=='centro_storico'){$centro_storico++;}
else if ($tipo=='fontana'){$fontana++;}
else if ($tipo=='museo'){$museo++;}
else if ($tipo=='wc'){$wc++;}
else if ($tipo=='interesse_paesaggistico'){$interesse_paesaggistico++;}
else if ($tipo=='picnic'){$picnic++;}
else if ($tipo=='teatro'){$teatro++;}
else if ($tipo=='ed_civile'){$ed_civile++;}
else if ($tipo=='infernot'){$infernot++;}
else if ($tipo=='giardino'){$giardino++;}
else{$altri++;}

endwhile;

echo"<hr>";
echo"Totale POI: $i, ";
echo"Altri: $altri, ";
echo"Religiosi: $edreligioso, ";
echo"Storico: $edstorico, ";
echo"Osservazione: $puntooss, ";
echo"Parcheggi: $parcheggio, ";
echo"InfoPoint: $info, ";
echo"Archeologia industriale: $arc_industriale, ";
echo"Centro storico: $centro_storico, ";
echo"Fontana: $fontana, ";
echo"Museo: $museo, ";
echo"WC: $wc, ";
echo"Interesse paesaggistico: $interesse_paesaggistico, ";
echo"Area picnic: $picnic, ";
echo"Teatro: $teatro, ";
echo"Edificio civile: $ed_civile, ";
echo"Infernot: $infernot, ";
echo"Giardino: $giardino, ";
echo"<hr>";

// Reset Post Data
wp_reset_postdata();

echo"
  </div>
</div>
";
}

function scheda_percorso_div_elenco_poi($ID){

$altri=0;
$edreligioso=0;
$edstorico=0;
$puntooss=0;
$parcheggio=0;

echo"<li id='recent-comments-5' class='widget widget_recent_comments_map'>
<h3 class='widget-title'><span>Elenco POI</span></h3>
<li id='recent-comments-6' class='widget widget_recent_comments_pin'>
    <p style='text-align:center;'>";
//echo"<iframe src='http://192.81.215.55/experiment192/php/monferrato/fm_percorso_elenco.php?gid=$page_id&mypage_id=$page_id' width='100%' height='200px'></iframe>";
/* The loop */

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'percorso', 'meta_value'=>$ID));
while ( $the_query->have_posts() ) : $the_query->the_post();
$title=get_the_title();


$count_poi++;

echo"| <a href='";

$plink = the_permalink($postid);

echo"$plink'>$title</a> ";

$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$altri++;}
else if ($tipo=='ed-religioso'){$edreligioso++;}
else if ($tipo=='ed-storico'){$edstorico++;}
else if ($tipo=='punto-oss'){$puntooss++;}
else if ($tipo=='parcheggio'){$parcheggio++;}
else{$altri++;}

endwhile;

// Reset Post Data
wp_reset_postdata();

echo"|</p></li><br /></li><hr>";

echo"Altri: $altri<br>";
echo"Religiosi: $edreligioso<br>";
echo"Storico: $edstorico<br>";
echo"Osservazione: $puntooss<br>";
echo"PArcheggi: $parcheggio<br>";
echo"<hr>";


echo"
  </div>
";
}

function comuni_percorso($nome_vero){

global $post;
$args = array(
        'post_type' => 'portfolio',
        'portfolio_category'=>$nome_vero,
        'posts_per_page' => -1,
    ) ;

$posts = get_posts($args);

foreach ($posts as $post) :
  setup_postdata( $post );
  $i++;
  if ($i==1){$comma='';}else{$comma=', ';}
  $comuni.=$comma."<a href='".get_permalink()."'>".get_the_title()."</a>";

 endforeach;
wp_reset_postdata();

echo $comuni;
}

function dati_percorso($ID,$nome_vero){
echo"
  <div>
";
$lunghezza = get_field('lunghezza');
$lunghezza_km=arrotonda(($lunghezza/1000),0);
$panoramiche = get_field('panoramiche');
$panoramiche_km=arrotonda(($panoramiche/1000),0);
$perc_pano=arrotonda(($panoramiche/$lunghezza*100),0);
$elenco_comuni = get_field('elenco_comuni');
$numero_comuni = get_field('numero_comuni');
echo"
            <div style='width:8%;height:40px;background-color:#682027;display:inline-block;margin:2px;text-align:center;color:#000;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$lunghezza_km</span>
            </div>
            <div style='height:40px;display:inline-block;vertical-align:text-middle;'>
                Totale km
            </div>
";
echo"<br>
            <div style='width:8%;height:40px;background-color:#682027;display:inline-block;margin:2px;text-align:center;color:#000;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$perc_pano %</span>
            </div>
            <div style='height:40px;display:inline-block;vertical-align:text-middle;'>
                di tratte panoramiche ($panoramiche_km km)
            </div><br>";
echo"
            <div style='width:8%;height:40px;background-color:#682027;display:inline-block;margin:2px;text-align:center;color:#000;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$numero_comuni</span>
            </div>
            <div style='height:40px;width:80%;display:inline-block;vertical-align:text-middle;'>
                Comuni: <span style='font-style:italic;'>
                ";
                comuni_percorso($nome_vero);
                echo"</span>
            </div>";
echo"
  </div>
";
}

function dati_percorso1($ID,$nome_vero){

$lunghezza = get_field('lunghezza');
$lunghezza_km=arrotonda(($lunghezza/1000),0);
$panoramiche = get_field('panoramiche');
$panoramiche_km=arrotonda(($panoramiche/1000),0);
$perc_pano=arrotonda(($panoramiche/$lunghezza*100),0);
$elenco_comuni = get_field('elenco_comuni');
$numero_comuni = get_field('numero_comuni');
echo"
          <table class='table table-bordered'>
            <tbody>
              <tr>
                <td>$lunghezza_km</td>
                <td style='text-align:left;'>Totale km</td>
              </tr>
              <tr>
                <td>$perc_pano%</td>
                <td style='text-align:left;'>di tratte panoramiche ($panoramiche_km km)</td>
              </tr>
              <tr>
                <td>$numero_comuni</td>
                <td style='text-align:left;'>Comuni: <span style='font-style:italic;'>
                ";
                comuni_percorso($nome_vero);
                echo"</span></td>
              </tr>
";
}

function arrotonda_euro($val){
  return (number_format(round("$val", 2),2,',','.'));
}
function arrotonda($val,$decimali){
  return (number_format(round("$val", $decimali),$decimali,',','.'));
}
function scheda_percorso_div_elenco_poi_sum($ID){

$altri=0;
$edreligioso=0;
$edstorico=0;
$puntooss=0;
$parcheggio=0;

if ($ID==10617) {$ID=1989;}else{}

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'percorso', 'meta_value'=>$ID));
while ( $the_query->have_posts() ) : $the_query->the_post();
$title=get_the_title();


$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$altri++;}
else if ($tipo=='ed-religioso'){$edreligioso++;}
else if ($tipo=='ed-storico'){$edstorico++;}
else if ($tipo=='punto-oss'){$puntooss++;}
else if ($tipo=='parcheggio'){$parcheggio++;}
else{$altri++;}

endwhile;

// Reset Post Data
wp_reset_postdata();



echo"
<style>
.div1elenco{  float: left;
  width: 8%;
  height: 50px;
  margin: 1em;

            margin:2px;text-align:center;color:#000;
}
.div2elenco{  float: left;
  width: 80px;
  height: 50px;
  margin: 1em;
  //border: 1px solid #5b5b5b;

            margin:2px;text-align:center;color:#000;
}
.after-div1elenco {
  clear: left;
}
</style>
<div style='width:100%;text-align:center;'>
            <div class='div1elenco' style='background-color:#682027;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$edreligioso</span>
            </div>
            <div class='div2elenco'>
                Edifici religiosi
            </div>

            <div class='div1elenco' style='margin-left:10px;background-color:#682027;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$edstorico</span>
            </div>
            <div class='div2elenco'>
                Edifici storici
            </div>

            <div class='div1elenco' style='margin-left:10px;background-color:#682027;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$parcheggio</span>
            </div>
            <div class='div2elenco'>
                Parcheggi
            </div>

            <div class='div1elenco' style='margin-left:10px;background-color:#682027;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$puntooss</span>
            </div>
            <div class='div2elenco'>
                Punto oss
            </div>

            <div class='div1elenco' style='margin-left:10px;background-color:#682027;'>
              <span style='font-style:bold;color:#fff;font-size:20px;'>$altri</span>
            </div>
            <div class='div2elenco'>
                Altri
            </div>

";





echo"
 <div class='after-div1elenco'>&nbsp
</div>
</div>
";

}

function scheda_percorso_div_elenco_poi_sum1($ID){

$altri=0;
$edreligioso=0;
$edstorico=0;
$puntooss=0;
$parcheggio=0;

if ($ID==10617) {$ID=1989;}else{}

$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key'=> 'percorso', 'meta_value'=>$ID));
while ( $the_query->have_posts() ) : $the_query->the_post();
$title=get_the_title();

$tipo = get_field('field_53524fd43715d');

if ($tipo=='blue'){$altri++;}
else if ($tipo=='ed-religioso'){$edreligioso++;}
else if ($tipo=='ed-storico'){$edstorico++;}
else if ($tipo=='punto-oss'){$puntooss++;}
//else if ($tipo=='parcheggio'){$parcheggio++;}
else{$altri++;}

endwhile;

// Reset Post Data
wp_reset_postdata();
echo"
              <tr>
                <td>$edreligioso</td>
                <td style='text-align:left;'>Edifici religiosi</td>
              </tr>
              <tr>
                <td>$edstorico</td>
                <td style='text-align:left;'>Edifici storici</td>
              </tr>
              <tr>
                <td>$puntooss</td>
                <td style='text-align:left;'>Punto oss</td>
              </tr>
              <tr>
                <td>$altri</td>
                <td style='text-align:left;'>Altri</td>
              </tr>
            </tbody>
          </table>
";
}




function crea_lista_comuni_wpid(){
// funzione da richiamare in pagine a caso all'occorrenza
      query_posts(array(
        'post_type' => 'portfolio',
        'showposts' => -1
    ) );

//crea CSV
$myFile = "geodata/tb_comuni.csv";
$fh = fopen($myFile, 'w') or die("can't open file");

while (have_posts()) : the_post();


$title=get_the_title();
$id=get_the_ID();

$stringData = $title.",".$id."\n";
fwrite($fh, $stringData);


endwhile;
wp_reset_postdata();
}

function update_poi_meta_id_comune(){
// funzione da richiamare in pagine a caso all'occorrenza

global $wpdb;

//$result = $wpdb->get_results("SELECT * FROM pt_poi_wp_id_comuni  LIMIT 0, 10");
$result = $wpdb->get_results("SELECT * FROM pt_poi_wp_id_comuni");


foreach($result as $r) {
  $i++;
  //echo"<li>".$r->unico."";
  //echo" - ".$r->comune."";
  //echo" - ".$r->wpid_comune."</li>";

  // Questo aggiunge un custom field PROVA
  //add_post_meta( $r->wp_id_poi, 'id_comune', $r->wp_id_comuni );
  //add_post_meta( $r->wp_id_poi, 'nome_comune', $r->comune );
    $idcomune=$r->wp_id_comuni;
    $idpoi=$r->wp_id_poi;

    $nomecomune=get_page_title($idcomune);



    update_field( 'id_comune', $idcomune,$idpoi );
    update_field( 'nome_comune', $nomecomune,$idpoi );
    update_field( 'nome_manuale', 0,$idpoi );
    echo "$i) <a href='http://www.monferratopaesaggi.org/?p=$idpoi'>$idpoi</a> - $idcomune | $nomecomune<br>";
}

/*
for ($mul = 0; $mul <= 3; ++$mul) {
    $valore=$r->wp_id_comuni;
    update_field( 'id_comune', $valore,$r->wp_id_poi );
    echo $r->wp_id_poi."-".$valore."|";
}
*/
//echo"</ul>";

}

function get_page_title($ID){


  $nomecomune=get_the_title($ID);


return $nomecomune;

}

function visualizza_galleria($postid){

$VISUALIZZA_GALLERIA=0;



// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'meta_key' => 'relazione', 'meta_value' => $postid ) );

while ( $the_query->have_posts() ) : $the_query->the_post();
$VISUALIZZA_GALLERIA=1;
$id_galleria=get_the_ID();
endwhile;
wp_reset_postdata();
  if ($VISUALIZZA_GALLERIA==1)
{echo"


<a id='switch-small' href='http://www.monferratopaesaggi.org/?p=". $id_galleria ."'><i class='fa fa-file-image-o'></i> Visualizza la Galleria</a>
<br>
";}
else{}
}

function sezione_galleria($postid){

// menù per aggiungere/modificare galleria POI                          ---START

$VISUALIZZA_GALLERIA=0;



// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'meta_key' => 'relazione', 'meta_value' => $postid ) );
$i=0;
while ( $the_query->have_posts() ) : $the_query->the_post();
$i++;
endwhile;
if ($i>0){



echo "
    <div style='
    margin: 5px 0px 15px;
    background-color: #FFF;
    border-left: 4px solid #7AD03A;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.1);
    padding: 5px;
    '>
        <b>Strumento amministratore</b><br>";

echo"<ul>";
// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
$gallery_id = $the_query->post->ID;
$link_post_galleria=get_permalink($gallery_id);
// TITOLO
echo"<li> - Modifica la galleria <a href='". $link_post_galleria ."'>" . get_the_title() . "</a></li>";

endwhile;

// Reset Post Data
wp_reset_postdata();


echo"</ul>";
echo"</div>";


}
else {

    echo "
    <div style='
    margin: 5px 0px 15px;
    background-color: #FFF;
    border-left: 4px solid #7AD03A;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.1);
    padding: 5px;
    '>
        <b>Strumento amministratore</b><br>";
    echo"
        <form method='post'>
            <input value='crea galleria' type='submit' name='submit' class='minibutton' />
        </form>
    ";
        if(isset($_POST['submit']))
        {
            echo inserisci_nuovo_post_progress($postid);
        }
        else {}
    echo"</div>";

}

// menù per aggiungere/modificare galleria POI                          ---STOP
}

function get_metaimage($ID){
$img1=get_field('immagine_evidenza',$ID);
$nome_comune=get_field('nome_comune',$ID);
$title=get_the_title($ID);
$plink=get_permalink($ID);

$img1ext=get_field('immagine_esterna',$ID);


$nullimg='http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/3675229464_64f3c8b0ea_o.jpg';
if ($img1==NULL) {
  if ($img1ext==NULL){$img1=$nullimg;}
  else{$img1='http://www.monferratopaesaggi.org/store_public/'.$img1ext;}
}
else {}

  $osm_id = get_field('osm_id',$id);
  if ($osm_id==NULL){
    $osm_ref='OSM non presente';
  }
  else{
    $osm_ref='OSM ID: '.$osm_id;
  }

$contenuto = get_the_excerpt();
$percorso = get_field('field_5352634f44829',$ID);
$nome_percorso = get_the_title($percorso);
$location = get_field('map',$ID); // MANCA l'ID !!!


//<!-- This site is optimized with the Yoast WordPress SEO plugin v1.6.2 - https://yoast.com/wordpress/plugins/seo/ -->
//echo "<title>$title - Monferrato Paesaggi</title>";
//<!-- Avviso per l'amministratore: questa pagina non mostra una meta descrizione perché non ne ha una, è necessario scriverla per questa pagina o andare in SEO -> Menu titoli e impostare un modello. -->
echo "<link rel='canonical' href='$plink' />
";
echo "<link rel='publisher' href='https://plus.google.com/+MonferratopaesaggiOrg-Piemonte-Italy'/>
";
echo "<meta property='og:locale' content='it_IT' />
";
echo "<meta property='og:type' content='article' />
";
echo "<meta property='og:title' content='$title - Monferrato Paesaggi' />
";
//echo "<meta property='og:description' content='Il severo e importante prospetto esterno che domina Via Mameli è opera neoclassica del 1780 realizzata dello Scamozzi. Tanto rigore non accompagna e  non lascia suggerire lo straordinario spazio barocco del fabbricato realizzato dallo Scapitta tra il 1710 e 1714. Questo si evidenzia nel fastoso ingresso dove l’atrio, la corte e il corpo retrostante si &hellip;'' />";
if( !empty($location) ){
$lat= $location['lat'];
$lng=$location['lng'];
	if($lat==NULL || $lat==0){
	  echo "<meta property='og:description' content='$osm_ref - $nome_comune - $nome_percorso: $contenuto' />
	  ";

	  //echo "<meta property='article:section' content='Punti d&#039;interesse (POI)' />";
	  echo "<meta property='article:section' content='Punti d&#039;interesse (POI) - $nome_comune - $nome_percorso' />
	  ";
	}
	else{
	  echo "<meta property='og:description' content='POI ($lat, $lng) - $osm_ref - $nome_comune - $nome_percorso: $contenuto' />
	  ";
	  echo "<meta property='place:location:latitude'  content='$lat' />
	  ";
	  echo "<meta property='place:location:longitude' content='$lng' />
	  ";
	  echo "<meta property='og:latitude' content='$lat' />
	  ";
	  echo "<meta property='og:longitude' content='$lng' />
	  ";
	  //echo "<meta property='article:section' content='Punti d&#039;interesse (POI)' />";
	  echo "<meta property='article:section' content='Punti d&#039;interesse (POI) - $nome_comune - $nome_percorso' />
	  ";
	}
}
else{
  echo "<meta property='og:description' content='$contenuto' />
  ";
  //echo "<meta property='article:section' content='Punti d&#039;interesse (POI)' />";
  echo "<meta property='article:section' content='Documentazione su Monferrato Paesaggi' />
  ";
} // lat lng
echo "<meta property='og:url' content='http://www.monferratopaesaggi.org/?p=$ID' />
";
echo "<meta property='og:site_name' content='Monferrato Paesaggi - Piemonte - Italia' />
";
echo "<meta property='article:publisher' content='https://www.facebook.com/monferratopaesaggi.org' />
";
/*
echo "<meta property='article:published_time' content='2014-07-24T11:12:25+00:00' />
";
echo "<meta property='article:modified_time' content='2014-10-09T19:43:46+00:00' />
";
echo "<meta property='og:updated_time' content='2014-10-09T19:43:46+00:00' />
";
*/
echo "<meta property='fb:admins' content='100004399753459' />
";
echo "<meta property='og:image' content='$img1' />
";
//<!-- / Yoast WordPress SEO plugin. -->


}

function get_metaimage_full($ID){
$img1=get_field('immagine_full',$ID);
$title=get_the_title($ID);
$plink=get_permalink($ID);

$contenuto = get_the_excerpt();


//echo "<title>$title - Monferrato Paesaggi</title>";
//<!-- Avviso per l'amministratore: questa pagina non mostra una meta descrizione perché non ne ha una, è necessario scriverla per questa pagina o andare in SEO -> Menu titoli e impostare un modello. -->
echo "<link rel='canonical' href='$plink' />";
echo "<link rel='publisher' href='https://plus.google.com/+MonferratopaesaggiOrg-Piemonte-Italy'/>";
echo "<meta property='og:locale' content='it_IT' />";
echo "<meta property='og:type' content='article' />";
echo "<meta property='og:title' content='$title - Monferrato Paesaggi' />";
//echo "<meta property='og:description' content='Il severo e importante prospetto esterno che domina Via Mameli è opera neoclassica del 1780 realizzata dello Scamozzi. Tanto rigore non accompagna e  non lascia suggerire lo straordinario spazio barocco del fabbricato realizzato dallo Scapitta tra il 1710 e 1714. Questo si evidenzia nel fastoso ingresso dove l’atrio, la corte e il corpo retrostante si &hellip;'' />";
echo "<meta property='og:description' content='$contenuto' />";
echo "<meta property='og:url' content='http://www.monferratopaesaggi.org/?p=$ID' />";
echo "<meta property='og:site_name' content='Monferrato Paesaggi - Piemonte - Italia' />";
echo "<meta property='article:publisher' content='https://www.facebook.com/monferratopaesaggi.org' />";
//echo "<meta property='article:section' content='Punti d&#039;interesse (POI)' />";
echo "<meta property='article:section' content='$contenuto' />";
echo "<meta property='article:published_time' content='2014-07-24T11:12:25+00:00' />";
echo "<meta property='article:modified_time' content='2014-10-09T19:43:46+00:00' />";
echo "<meta property='og:updated_time' content='2014-10-09T19:43:46+00:00' />";
echo "<meta property='fb:admins' content='100004399753459' />";
echo "<meta property='og:image' content='$img1' />";
//<!-- / Yoast WordPress SEO plugin. -->

}

function crea_thumb($IMG){

$file_img1 = basename($IMG,'.jpg');


$image = wp_get_image_editor($IMG);
$imH='418';
$imW='640';
$newfile='./thumb/'.$file_img1.'_'.$imW.'x'.$imH.'.jpg';
if ( ! is_wp_error( $image ) ) {
    $image->resize( $imW, $imH, true );
    $image->save($newfile);
}

$imageX = wp_get_image_editor($IMG);
$imH='200';
$imW='200';
$newfile='./thumb/'.$file_img1.'_'.$imW.'x'.$imH.'.jpg';
if ( ! is_wp_error($imageX ) ) {
    $imageX->resize($imW, $imH, true );
    $imageX->save($newfile);
}

}

function return_thumb_main($IMG){
  $file_img1 = basename($IMG,'.jpg');
  $imH='418';
  $imW='640';
  $newfile=site_url($path, $scheme).'/thumb/'.$file_img1.'_'.$imW.'x'.$imH.'.jpg';
  echo $newfile;
}

function return_thumb_popup($IMG){
  $file_img1 = basename($IMG,'.jpg');
  $imH='200';
  $imW='200';
  $newfile='http://www.monferratopaesaggi.org/thumb/'.$file_img1.'_'.$imW.'x'.$imH.'.jpg';
  return $newfile;
}



function crea_thumb_form($IMG){

$file_img1 = 'http://www.monferratopaesaggi.org/store_public/'.$IMG;
$fileexact=substr($IMG, 0, strlen($IMG)-4);
/*
$image = wp_get_image_editor($IMG);
$imH='418';
$imW='640';
$newfile='thumb/'.$file_img1.'_'.$imW.'x'.$imH.'.jpg';
if ( ! is_wp_error( $image ) ) {
    $image->resize( $imW, $imH, true );
    $image->save($newfile);
}
*/

$imageX = wp_get_image_editor($file_img1);
$imH='200';
$imW='200';
$newfile='./thumb/'.$fileexact.'_'.$imW.'x'.$imH.'.jpg';
if ( ! is_wp_error($imageX ) ) {
    $imageX->resize($imW, $imH, true );
    $imageX->save($newfile);
}
}

function return_thumb_esatte($IMG,$imW,$imH){
  $file_img1 = basename($IMG);
  $newfile=strtolower('http://www.monferratopaesaggi.org/thumb/'.$imW.'x'.$imH.'_'.$file_img1);
  return $newfile;
}

function crea_thumb_esatte($IMG,$imW,$imH){

$file_img1 = $IMG;
$fileexact=substr($IMG, 0, strlen($IMG)-4);

$filename = basename($IMG);

$imageX = wp_get_image_editor($file_img1);
$newfile=strtolower('./thumb/'.$imW.'x'.$imH.'_'.$filename);
  if ( ! is_wp_error($imageX ) ) {
      $imageX->resize($imW, $imH, $crop=true);
      $imageX->save($newfile);
  }
}

function get_comune($ADDRESS){
$admin = explode(",", $ADDRESS);
foreach($admin as $key) {
$all++;
}

$adminCP = substr($admin[$all-2], -(strlen($admin[$all-2])-7), (strlen($admin[$all-2])-7));
$adminCmulti = explode(" ", $adminCP);

foreach($adminCmulti as $key) {
$C++;
}

$adminP=$adminCmulti[$C-1];
$adminC = substr($admin[$all-2], -(strlen($admin[$all-2])-7), (strlen($admin[$all-2])-7-strlen($adminP)-1));
return $adminC;
}

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
  wp_deregister_style( 'wp-admin' );
}

function my_pre_save_post( $post_id ) {

    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }

    // Create a new post
    $post = array(
        'post_status'  => 'private',
        'post_title'  => 'Commento',
        'post_type'  => 'post',
    );

    // insert the post
    $post_id = wp_insert_post( $post, $wp_error  );


    //now you can use $post_id withing add_post_meta or update_post_meta
    add_post_meta( $post_id, 'template', 'commento' );
    add_post_meta( $post_id, 'commento_to_id', $_POST['fields']['field_54c2683d5ac91'] );


    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    // return the new ID
    return $post_id;
}

add_filter('acf/pre_save_post' , 'my_pre_save_post' );

function tipo_osm_convert($postid){

    $tipo = get_field('tipo',$postid);

    $location = get_field('map',$postid); // MANCA l'ID !!!
    if( !empty($location) ):
    $lat= $location['lat'];
    $lng=$location['lng'];
    $address=$location['address'];
    endif; // lat lng

    //$json_url = file_get_contents("http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];way%28".$osm_id."%29;out;");
    $lat1=$lat-0.005;
    $lng1=$lng-0.005;
    $lat2=$lat+0.005;
    $lng2=$lng+0.005;

    if($tipo=='ed-storico'){
      return "http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(node($lat1,$lng1,$lat2,$lng2)[historic=castle];way($lat1,$lng1,$lat2,$lng2)[historic=castle];);(._;>;);out;";
    }
    else if($tipo=='ed-religioso'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=place_of_worship];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=place_of_worship];";
      $string.="node($lat1,$lng1,$lat2,$lng2)[landuse=cemetery];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[landuse=cemetery];";
      $string.=");(._;>;);out;";
      return $string;
    }

else if ($tipo=='punto-oss'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=viewpoint];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=viewpoint];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='parcheggio'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=parking];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=parking];";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=caravan_site];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=caravan_site];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='info'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=information];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=information];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='arc_industriale'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[historic=ruins];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[historic=ruins];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='centro_storico'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[admin_level=8];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[admin_level=8];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='fontana'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=drinking_water];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=drinking_water];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='museo'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=museum];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=museum];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='wc'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=toilets];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=toilets];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='interesse_paesaggistico'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=attraction];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=attraction];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='picnic'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=picnic_site];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=picnic_site];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='teatro'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=theatre];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=theatre];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='ed_civile'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=public_building];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=public_building];";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=community_centre];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=community_centre];";
      $string.="node($lat1,$lng1,$lat2,$lng2)[amenity=school];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[amenity=school];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='ed_storico'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[historic=castle];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[historic=castle];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='infernot'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[tourism=wine_cellar];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[tourism=wine_cellar];";
      $string.=");(._;>;);out;";
      return $string;
    }
else if ($tipo=='giardino'){
      $string="http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(";
      $string.="node($lat1,$lng1,$lat2,$lng2)[leisure=garden];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[leisure=garden];";
      $string.="node($lat1,$lng1,$lat2,$lng2)[leisure=park];";
      $string.="way($lat1,$lng1,$lat2,$lng2)[leisure=park];";
      $string.=");(._;>;);out;";
      return $string;
    }
    else {
      return "http://overpass.osm.rambler.ru/cgi/interpreter?data=[out:json];(node($lat1,$lng1,$lat2,$lng2););(._;>;);out;";
    }

}

function search_osm_elements($postid,$user,$version){

  $allowed_roles = array('editor', 'administrator', 'author');
  if( array_intersect($allowed_roles, $user->roles ) ) {
  // API OSM

    //echo"<b>Box ricerca</b><br>";
    //echo "$lat1 - $lng1 - $lat2 - $lng2 !";

    //http://www.openstreetmap.org/#map=19/45.09365401150467/8.273830264806747
    $json_url = file_get_contents(tipo_osm_convert($postid));

    $obj = json_decode($json_url, true);
    if($version=='full'){
    echo"<br>Cerca way or node<br><b>Print OBJ</b><br>";
    echo"<div style='width:100%;height:200px;overflow-x:scroll;'><pre>";
    print_r($obj);
    echo"</pre></div>";
    }
    else{}

    foreach($obj['elements'] as $item) {
        $i=0;

        $type = $item['type'];
        $ele_id = $item['id'];
        $name = $item['tags']['name'];

        echo"<br>";
        if($version=='full'){
          echo"<b>Type</b>: $type";
          echo" | <b>ele_id</b>: $ele_id";
          echo" | ";
        }
        else{}
        echo"<a href='http://www.openstreetmap.org/$type/$ele_id'>$type-$ele_id</a> $name";

        $array_id.='http://www.openstreetmap.org/'.$type.'/'.$ele_id.',';

        $arraynodes = $item['nodes'];
    }
    echo"<form method='post'>";
    echo"<select name='osmlist'>";

    $arr = explode(",", $array_id);

    foreach ($arr as &$value) {
      $arr1 = explode("org/", $value);
      echo"<option value='$value'>$arr1[1]</option>";
    }

    echo"</select>";
    echo"<input type='submit' name='invia_osm' value='Add' />";
    echo"</form>";

  // API OSM
  }else{}
}

//temp
function get_id_autore($nome_autore){
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 87, 'name'=>$nome_autore));

// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

  $title=get_the_title();
  $title = str_replace('"', '', $title);
  $plink=get_permalink();
  $postid = get_the_ID();
  return $postid;


endwhile;
// Reset Post Data
wp_reset_postdata();


}

function insert_osm_in_post($postid,$invia_osm){

    $post_id = wp_insert_post( $my_post, $wp_error );

    update_field('osm_id', $invia_osm, $postid);

?>
<script>
    alert("Inserito: <?php echo $invia_osm; ?>");
</script>
<?php
}

function show_menu_admin($user){
  $allowed_roles = array('editor', 'administrator');
  if( array_intersect($allowed_roles, $user->roles ) ) {
    echo"
      <a href='#' class='btn btn-primary'>editing</a>
      <a href='?menu=geojson' class='btn btn-primary'>Genera GeoJSON</a>
      <a href='?menu=creathumb' class='btn btn-primary'>Genera immagine</a>
    ";
  }
  else{}
}

function esegui_menu_poi($menu,$postid){
  if ($menu=='geojson'){
    crea_geojson_poi_schedapoi();
  }
  else if ($menu=='creathumb'){
    $img1=get_field('immagine_evidenza',$postid);
    $img1ext=get_field('immagine_esterna',$postid);
    sezione_galleria($postid);
    if ($img1==NULL) {
      if ($img1ext==NULL){}
      else{crea_thumb(site_url($path, $scheme).'/store_public/'.$img1ext);}
    }
    else {
      crea_thumb($img1);
    }
  }
}

function show_block_title_poi($postid){
  $img1=get_field('immagine_evidenza',$postid);
  $img1ext=get_field('immagine_esterna',$postid);

  if ($img1==NULL) {
    if ($img1ext==NULL){$title=get_the_title($postid);}
    else{
      $titolo_opera = get_field('titolo_opera',$postid);
      if ($titolo_opera==NULL){$title="Ancora nessun nome...";}
      else{$title=$titolo_opera;}
    }
  }
  else {
    $title=get_the_title($postid);
  }
	$tipo = get_field('tipo',$postid);

  echo"
    <h1 style='margin-bottom: 0;'>";
		echo "<img src='";
	  echo get_myicon($tipo,'iconurl');
	  echo "' style='width:20px;'/> ";
		echo"
		  $title
    </h1>
  ";
  /*echo"
      <p>
        <span>
  ";


  echo get_myicon($tipo,'human');

  echo"
      </span>
    </p>
  ";
	*/
}

function get_people_totale($postid){
$the_query = new WP_Query(array('posts_per_page' => -1, 'cat' => 52, 'meta_key' =>'id_autore' , 'meta_value'=> $postid ));
$count=0;
$count_pending=0;
$count_true=0;
$count_other=0;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();

  $title=get_the_title();
  $title = str_replace('"', '', $title);
  $plink=get_permalink();
  $postid = get_the_ID();
  $stato_verifica = get_field('stato_verifica');
  $count++;

  if($stato_verifica=='pending'){$count_pending++;}
  else if($stato_verifica=='true'){$count_true++;}
  else{$count_other++;}


endwhile;
// Reset Post Data
wp_reset_postdata();

return $count.','.$count_true.','.$count_pending.','.$count_other;
}

function get_tab_scopriportale($ID,$count_tab){
$the_query = new WP_Query('p='.$ID);
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
$title_tab=get_the_title();
$excerpt_tab=get_the_excerpt();
$plink=get_permalink();
$img1=get_field('immagine_mini');
echo"
  <div id='tab-$count_tab' class='tab'>
    <div class='tab-content'>
      <div class='row'>
        <div class='col-md-8'>
          <div class='jumbotron'>
            <h2 style='text-align: left;'>$title_tab</h2>
            <p style='text-align: left;'>$excerpt_tab</p>
            <p><a class='btn btn-sm btn-success' href='$plink'>Apri pagina</a></p>
          </div>
        </div>
        <div class='col-md-4'>
          <img class='img-thumbnail' src='$img1' width='100%' itemprop='image' />
        </div>
      </div>
    </div>
  </div>
";
endwhile;
// Reset Post Data
wp_reset_postdata();
}
?>
