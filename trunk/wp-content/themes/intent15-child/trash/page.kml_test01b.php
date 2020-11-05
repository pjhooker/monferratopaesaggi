<?php
/*
Template Name: KML test01b TEST01
*/
?>
<!DOCTYPE html>
<?php
$myFile = "pt_punti_wp_percorso.kml";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "<?xml version='1.0' encoding='UTF-8'?>
<kml xmlns='http://earth.google.com/kml/2.2'>
<Document>
  <name>Monferrato punti (prova)</name>
  <description><![CDATA[casaleMonferrato-sgiorgio1.kml]]></description>
  <Style id='style_none'>
    <IconStyle>
      <Icon>
        <href>http://maps.gstatic.com/mapfiles/ms2/micons/blue.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_edreligioso'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/ed-religioso.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_edstorico'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/ed-storico2.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_puntooss'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/punto-oss.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_attivitaprodotti'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/attivita-e-prodotti.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_parcheggio'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/parcheggio.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_casettaacqua'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/casetta-acqua.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_bedbreak'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/bedbreak.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_ristorante'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/ristorante.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_hotel'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/hotel.png</href>
      </Icon>
    </IconStyle>
  </Style>
  <Style id='style_info'>
    <IconStyle>
      <Icon>
        <href>http://www.monferratopaesaggi.org/wp-content/uploads/2014/01/info.png</href>
      </Icon>
    </IconStyle>
  </Style>
";
fwrite($fh, $stringData);

/* The loop */ 
while ( have_posts() ) : the_post(); 

$args = array( 'posts_per_page' => 50, 'category' => 52 );
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post );


/*
$kml =$row['kml'];
$idm =$row['idm'];
$gid =$row['gid'];
$tipo =$row['tipo'];
$name =$row['name'];

if ($tipo==NULL){$tipo='none';}
else {}
$query1 = @pg_query(" 
SELECT *
from tb_percorsi WHERE id_wp=$idm
");
while($row1 = pg_fetch_assoc($query1)) {
$denominazione =$row1['denominazione'];
$id_wp =$row1['id_wp'];
}
*/

$stringData = '
  <Placemark>
    <name>';
fwrite($fh, $stringData);
$stringData = get_the_title( $id );
fwrite($fh, $stringData);

// POI: $gid
// $denominazione
$stringData = '</name>
    <description><![CDATA[<div dir="ltr">Clicca <a href="';
fwrite($fh, $stringData);
// http://www.monferratopaesaggi.org/?page_id=1959&gid=$gid&my_returnpage=$idm&percorso_id=$idm
$stringData =  get_permalink( $id );
fwrite($fh, $stringData);
$stringData = '">qui</a> per aprire la scheda<hr>';
fwrite($fh, $stringData);
// $denominazione
// $name
$stringData =  get_the_content( $id );
fwrite($fh, $stringData);

$stringData = '</div>]]></description>';
fwrite($fh, $stringData);
//#style_$tipo

$stringData =  '<styleUrl>#style_';
fwrite($fh, $stringData);
$tipo = get_field('field_53524fd43715d',$id);
if ($tipo=='blue'){$tipo='none';}
else if ($tipo=='ed-religioso'){$tipo='edreligioso';}
else if ($tipo=='ed-storico'){$tipo='edstorico';}
else if ($tipo=='punto-oss'){$tipo='puntooss';}
else if ($tipo=='attivita-e-prodotti'){$tipo='attivitaprodotti';}
else if ($tipo=='parcheggio'){$tipo='parcheggio';}
else if ($tipo=='casetta-acqua'){$tipo='casettaacqua';}
else if ($tipo=='bedbreak'){$tipo='bedbreak';}
else if ($tipo=='ristorante'){$tipo='ristorante';}
else if ($tipo=='hotel'){$tipo='hotel';}
else if ($tipo=='info'){$tipo='info';}
else {$tipo='none';}

$stringData =  $tipo;
fwrite($fh, $stringData);

$stringData =   '</styleUrl>';
fwrite($fh, $stringData);
$stringData =  '<Point>
      <coordinates>';
fwrite($fh, $stringData);
      
/* VISUALIZZA LE COORDINATE REGISTRATE */ 
$location = get_field('map',$id); // MANCA l'ID !!!
 
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 

endif; // lat lng  

$stringData = $lng;
fwrite($fh, $stringData);
$stringData = ',';
fwrite($fh, $stringData);
$stringData = $lat;
fwrite($fh, $stringData);
$stringData =',0.000000</coordinates>
    </Point>
  </Placemark>
';

fwrite($fh, $stringData);

endforeach; 
wp_reset_postdata();
endwhile;

$stringData = '
</Document>
</kml>';
fwrite($fh, $stringData);
?>
