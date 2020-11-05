<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Tweet-BootBoard</title>

    <script src='http://www.cityplanner.it/php/openlayers-master/lib/OpenLayers.js'></script>
    <!-- Bootstrap core CSS -->
    <link href="http://www.cityplanner.it/bootstrap/docs/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="grid.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://www.cityplanner.it/bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://www.cityplanner.it/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	#panelGuest{
		    overflow-y:auto;
		    overflow-x:hidden;
		    max-height:200px;
		}
    </style>
  </head>

  <body onload='init()'>
    <div class="container">

<?php
echo"
<div class='row'>
	<div class='col-md-9' style='height:120px;'><h1>Tweet-BootBoard</h1>MySQL: 
";
$connessione = mysqli_connect("62.149.150.188", "Sql657432", "1993f589","Sql657432_5")
  or die("connessione non riuscita: " . mysqli_error());
print ("connesso con successo<br>");

echo"
	</div>
	<div class='col-md-3' style='height:120px;'>
		<p style='text-align:center;'>
			<a href='http://www.cityplanner.it'>
				<img src='http://goo.gl/96IDMs' style='width:80px;text-align:center;'>
			</a>
		</p> 
";
echo"	
	</div>
</div>";

echo"
      <div class='row'>
        <div class='col-md-3' style='height:550px;'>
";
//individua l'ultima passata
$result = mysqli_query($connessione,"SELECT starttime FROM tb_twitter01m ORDER BY starttime DESC LIMIT 1");

while($row = mysqli_fetch_array($result)) {
  $last_starttime=$row['starttime'];
}

echo"
          Ultima passata: $last_starttime<br>
";

$result = mysqli_query($connessione,"SELECT count(*) as total_count FROM tb_twitter01m");

while($row = mysqli_fetch_array($result)) {
  $total_count=$row['total_count'];
}

echo"
          Totale Tweet letti: $total_count<br>
";

$result = mysqli_query($connessione,"
  SELECT count(*) as total_unique_count
  FROM (
    SELECT field3
    FROM tb_twitter01m
    WHERE NOT(field7lat=0)
    GROUP BY field3
  ) foo
");

while($row = mysqli_fetch_array($result)) {
  $total_unique_count=$row['total_unique_count'];
}



echo"          
          Totale Tweet univoci: $total_unique_count<hr>
          <b>Totale Tweet univoci per passata</b><br>
          <div id='panelGuest' class='panel'>
";
$result = mysqli_query($connessione,"
SELECT count( * ) AS total_unique_count_by_starttime, starttime
FROM (

  SELECT field3, MIN( starttime ) AS starttime
  FROM tb_twitter01m
  GROUP BY field3
)foo
GROUP BY starttime
ORDER BY starttime DESC
");

while($row = mysqli_fetch_array($result)) {
  $total_unique_count=$row['total_unique_count_by_starttime'];
  $starttime=$row['starttime'];
  echo"$starttime: $total_unique_count<br>";
}

echo"
			</div>
	    </div>
        <div class='col-md-5' style='height:550px;'>
";

//genera json tweet nuovi ultima passata

//crea JSON
$myFile = "geodata/last_tweet_m.geojson";
$fh = fopen($myFile, 'w') or die("can't open file");


$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);


$result = mysqli_query($connessione,"
SELECT MIN(lat) AS lat, MIN(lng) AS lng, field3,starttime, MIN(field_link) as field_link
FROM (
  SELECT field3, MIN( starttime ) AS starttime, MIN(field_link) as field_link, MIN(field7lat) AS lat, MIN(field7lng) AS lng
  FROM tb_twitter01m
  GROUP BY field3
)foo
WHERE starttime='$last_starttime' AND NOT (lat='')
GROUP BY field3, starttime
");

while($row = mysqli_fetch_array($result)) {
	$postid=$row['field3'];
	$count_poi++;
	$title =$row['field3'];
	$plink=$row['field_link'];
	$tipo='tipo';
	$id_comune = '1';
	$comune = 'MILANO';
	$lat=$row['lat'];
	$lng=$row['lng'];
	$iconurl='http://maps.gstatic.com/mapfiles/ms2/micons/blue.png';
	$url_image='http://maps.gstatic.com/mapfiles/ms2/micons/blue.png';


$stringData = ' { "geometry" : { "coordinates" : ['.$lng.',
            '.$lat.' 
              ],
            "type" : "Point"
          },
        "properties" : { "colour" : "#ffffff", "progressiv" : "'.$count_poi.'",  "unico":"'.$postid.'", "picture":"'.$url_image.'","titolo":"'.$title.'","url_post":"'.$plink.'","tipo":"'.$tipo.'",
            "wpid_comune":"'.$id_comune.'","comune":"'.$comune.'","imageurl" : "'.$iconurl.'" 
          },
        "type" : "Feature"
      },
';
fwrite($fh, $stringData);
// ---
}

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

// NEW MAP START
?>
    <style type="text/css">
        #map {
            width: 100%;
            height: 500px;
            border: 1px solid #00BFFF;
            background-color: #fff;
    }
    </style>
<?php

echo"

            <div id='map'></div>
            Mappa dei nuovi Tweet raccolti nell'ultima passata
";
?>
<script src='js/mappa_scheda_poi_black_m.js'></script>
<script type="text/javascript">
    var lat =  45.143843,
    lon = 8.275973
</script>
<?php
echo"
        </div>
        <div class='col-md-4' style='height:550px;'>
        	Utlimi 10 Tweet raccolti<br>
";
$result = mysqli_query($connessione,"
SELECT field2, field_link, field_u4
FROM `tb_twitter01m`
ORDER BY field2 DESC
LIMIT 10
");

while($row = mysqli_fetch_array($result)) {
  $total_unique_count=$row['total_unique_count_by_starttime'];
  $field2=$row['field2'];
  $field_link=$row['field_link'];
  $field_u4=$row['field_u4'];
  echo"$field2 <a href='$field_link'>$field_u4</a><br>";
}
echo"
        </div>
      </div>
";      
?>      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
