<?php
  require_once("../wp-load.php");

  $args = array (
  	'posts_per_page'         => '-1',
  	'cat' => 69
  );
  $the_query = new WP_Query( $args);

  /*
  $stringData = '{
  "type": "FeatureCollection",
  "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },

  "features" : [ ';
  */
  // Il Loop
  while ( $the_query->have_posts() ) :
    $i++;
    if ($i==1){$comma='';}
    else{$comma=',';}
  	$the_query->the_post();
    $postid = get_the_ID();
    $title=format_text(get_the_title());
    $lat=format_location($postid,'lat');
    $lng=format_location($postid,'lng');
    //wp_set_post_terms( $postid, array(94), 'category', true );
    echo $title;
    the_meta();
    //update_field('template', 'tratta', $postid);
  /*
    $stringData.= $comma.' { "geometry" : { "coordinates" : ['.$lng.','.$lat.'],"type" : "Point"},
      "properties" : { "postid":"'.$postid.'","title":"'.$title.'"
      },"type" : "Feature"}
    ';
  */
  	//echo "$postid,$title,$lat,$lng,$percorso,$nome_comune,$id_comune,$nome_manuale,$option<br>";

  endwhile;

  // Ripristina Query & Post Data originali
  wp_reset_query();
  wp_reset_postdata();
  //echo $i;
  /*$stringData.= '
    ],"type" : "FeatureCollection"}
  ';
  echo $stringData;
  */
?>
