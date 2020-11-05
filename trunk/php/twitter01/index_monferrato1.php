<!DOCTYPE html>
<html lang="it-IT" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Twitter data (recent)</title>
	<link rel='stylesheet' id='style-css'  href='http://www.cityplanner.it/natural_tree/wp-content/themes/flat-theme/style.css?ver=3.9.1' type='text/css' media='all' /> 
</head><!--/head-->
<body>
<style>
table,tr,td{border:1px solid black;}
body{font-size:12px;}
</style>
<?php
    $connessione = mysqli_connect("62.149.150.188", "Sql657432", "1993f589","Sql657432_5")
        or die("Connessione non riuscita: " . mysqli_error());
    print ("Connesso con successo<br>");

$pageid=$_GET["id"];
$starttime=$_GET["start"];
if ($starttime==NULL){$starttime=date("Ymd-His");}else{}

$result = mysqli_query($connessione,"SELECT * FROM grid7000m WHERE `id`=$pageid");


while($row = mysqli_fetch_array($result)) {
  $lat=$row['lat'];
  $lng=$row['lng'];
  echo"lat: $lat | lng: $lng<br>";
}


ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/



$settings = array(
    //'oauth_access_token' => "2602299919-lP6mgkqAMVwvHM1L0Cplw8idxJzvuZoQRzyMkOx",
    //'oauth_access_token_secret' => "wGWny2kz67hGdnLe3Uuy63YZs4nIGs8wQtCU7KnOT5brS",
    //'consumer_key' => "zAzJRrPOj5BvOsK5QhscKogVQ",
    //'consumer_secret' => "Uag0ujVJomqPbfdoR2UAWbRYhjzgoU9jeo7qfZHCxR6a6ozcu1"
    'oauth_access_token' => "285268642-vT2ENyBj5NU8Cjw0RSArANvRpIWSQ4WswReNH6Si",
    'oauth_access_token_secret' => "UEHW9ZQAVyFV1gCAgwby5uXByof3p3p0UaBW557b2Q1Go",
    'consumer_key' => "ccwppb00YfKAHNgGx1IS0eGaL",
    'consumer_secret' => "rhuiIe457J0SvkcSEsS3zWg4ULhdGM5utsIaZLyWk9je5p3rGi"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=&geocode='.$lat.','.$lng.',10km'./*lang=eu&locale=it*/'&result_type=recent&count=100';
$requestMethod = 'GET';

echo $url.$getfield;

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();


$json_a=json_decode($response,true);
//print_r($json_a);
// --HTML echo"<table style='width:100%;'>";
//$json_a=json_decode($response);
foreach($json_a['statuses'] as $data2) { 

	// --HTMLecho"<tr>";

	//echo"<div style='postition:relative;border:1px;'>";
	
	$count++;
	// --HTMLecho"<td style='background-color:#5b5b5b;text-align:center;font-size:24px;'>$count</td>";

	$field1="recent";
	// --HTMLecho"<td>$field1</td>";

	$field2=$data2['created_at'];
	// --HTMLecho"<td>$field2</td>";

	$field3=$data2['id'];
	if ($field3==NULL){$field3=0;}else{}
	$val0=$field3;	
	// --HTMLecho"<td>$field3</td>";

	//$field4=htmlentities($data2['text'], ENT_QUOTES);
	$field4=str_replace("'", "`",  $data2['text']);
	// --HTMLecho"<td>$field4</td>";
	
	$field5=$data2['source'];
	// --HTMLecho"<td>$field5</td>";
	
	$field6=$data2['geo']['type'];
	// --HTMLecho"<td>$field6</td>";

	$field7lat=0;$field7lng=0;
	//foreach($data2['geo']['coordinates'] as $dataLL) {
	//	$iLL++;
	//	if ($iLL==1){$field7lat=$dataLL;}else{$field7lng=$dataLL;}
	//}
	$field7lat=$data2['geo']['coordinates'][0];
	$field7lng=$data2['geo']['coordinates'][1];
	// --HTMLecho"<td>Lat: $field7lat | Lng: $field7lng</td>";

	$field8=$data2['place']['id'];
	// --HTMLecho"<td>$field8</td>";
	
	$field9=$data2['place']['place_type'];
	// --HTMLecho"<td>$field9</td>";
	
	$field10=$data2['place']['name'];	
	// --HTMLecho"<td>$field10</td>";
	
	$field11=$data2['place']['full_name'];
	// --HTMLecho"<td>$field11</td>";
	
	$field12=$data2['place']['country_code'];
	// --HTMLecho"<td>$field12</td>";
	
	$field13=$data2['place']['country'];
	// --HTMLecho"<td>$field13</td>";

	$field14='';
	for ($mu = 0; $mu < 20; $mu++) {
		$hashtag=$data2['entities']['hashtags'][$mu]['text'];
		if ($mu==0){$field14=$hashtag;}
		else{if($hashtag==NULL){}else{$field14.=", $hashtag";}}
	}	
	// --HTMLecho"<td>$field14</td>";
	/*
	echo"<td>";
	echo  var_dump($data2['entities']['hashtags']);
	echo"</td>";
	*/
	
	$field15=$data2['entities']['user_mentions'][0]['screen_name'];
	// --HTMLecho"<td>$field15</td>";

	$field16=$data2['entities']['user_mentions'][0]['name'];
	// --HTMLecho"<td>$field16</td>";

	$field17=$data2['entities']['user_mentions'][0]['id'];
	// --HTMLecho"<td>$field17</td>";		
	
	$field18=$data2['lang'];
	// --HTMLecho"<td>$field18</td>";

// --HTMLecho"</tr><tr>";
//USER

	$field_u1=$data2['user']['id'];
	if ($field_u1==NULL){$field_u1=0;}else{}
	// --HTMLecho"<td>$field_u1</td>";

	$field_u2=$data2['user']['id_str'];
	if ($field_u2==NULL){$field_u2=0;}else{}
	// --HTMLecho"<td>$field_u2</td>";

	$field_u3=$data2['user']['name'];
	// --HTMLecho"<td>$field_u3</td>";

	$field_u4=$data2['user']['screen_name'];
	// --HTMLecho"<td>$field_u4</td>";

	$field_u5=$data2['user']['location_user'];
	// --HTMLecho"<td>$field_u5</td>";

	//$field_u6=htmlentities($data2['user']['description'], ENT_QUOTES);
	$field_u6=str_replace("'", "`",  $data2['user']['description']);
	// --HTMLecho"<td>$field_u6</td>";

	$field_u7=$data2['user']['expanded_url'];
	// --HTMLecho"<td>$field_u7</td>";

	$field_u8=$data2['user']['display_url'];
	// --HTMLecho"<td>$field_u8</td>";

	$field_u9=$data2['user']['followers_count'];
	// --HTMLecho"<td>$field_u9</td>";

	$field_u10=$data2['user']['friends_count'];
	if ($field_u10==NULL){$field_u10=0;}else{}
	// --HTMLecho"<td>$field_u10</td>";

	$field_u11=$data2['user']['listed_count'];
	if ($field_u11==NULL){$field_u11=0;}else{}
	// --HTMLecho"<td>$field_u11</td>";

	$field_u12=$data2['user']['created_at'];
	// --HTMLecho"<td>$field_u12</td>";

	$field_u13=$data2['user']['favourites_count'];
	if ($field_u13==NULL){$field_u13=0;}else{}
	// --HTMLecho"<td>$field_u13</td>";

	$field_u14=$data2['user']['geo_enabled'];
	if ($field_u14==NULL){$field_u14=0;}else{}
	// --HTMLecho"<td>$field_u14</td>";

	$field_u15=$data2['user']['statuses_count'];
	if ($field_u15==NULL){$field_u15=0;}else{}
	// --HTMLecho"<td>$field_u15</td>";

	$field_u16=$data2['user']['lang'];
	// --HTMLecho"<td>$field_u16</td>";

	$field_link="https://twitter.com/".$field_u4."/status/".$field3;
	// --HTMLecho"<td>";
	// --HTMLecho "<a href='$field_link'>Link</a>";
	// --HTMLecho"</td>";
	
	$field_oktime=date("Ymd-G:i:s");
	// --HTMLecho"<td colspan='2'>";
	// --HTMLecho $field_oktime;
	// --HTMLecho"</td>";
	// --HTMLecho"</tr>";

// SQL
/*
$result1 = mysqli_query($connessione,"SELECT * FROM `tb_twitter04` WHERE `field3`='$field3'");

$duplicato=1;
while($row1 = mysqli_fetch_array($result1)) {
  $duplicato=0;
}

if ($duplicato==0){
*/
	mysqli_query($connessione,"
	INSERT INTO `tb_twitter01m` (`field1`, `field2`, `field3`, `fiedl4`, `field5`, `field6`, `field7lat`, 
		`field7lng`, `field8`, `field9`, `field10`, `field11`, `field12`, `field13`, `field14`, `field15`, 
		`field16`, `field17`, `field18`, `field_u1`, `field_u2`, `field_u3`, `field_u4`, `field_u5`, 
		`field_u6`, `field_u7`, `field_u8`, `field_u9`, `field_u10`, `field_u11`, `field_u12`, 
		`field_u13`, `field_u14`, `field_u15`, `field_u16`, `field_link`, `field_oktime`,`datarow`,`quadrante`,`starttime`) 
	VALUES (
	'$field1', 
	'$field2', 
	'$field3',
	'$field4',
	'$field5',
	'$field6',
	'$field7lat',
	'$field7lng', 
	'$field8',
	'$field9', 
	'$field10', 
	'$field11',
	'$field12', 
	'$field13',
	'$field14',
	'$field15',
	'$field16',
	'$field17',
	'$field18',
	'$field_u1',
	'$field_u2',
	'$field_u3', 
	'$field_u4',
	'$field_u5',
	'$field_u6',
	'$field_u7',
	'$field_u8',
	'$field_u9',
	'$field_u10',
	'$field_u11', 
	'$field_u12',
	'$field_u13', 
	'$field_u14',
	'$field_u15',
	'$field_u16',
	'$field_link',
	'$field_oktime',
	'$count',
	'$pageid',
	'$starttime'
	);
		");

/*
	}
	else{}
*/
} // END foreach

echo "<hr>Inserimento di $count tweet in tabella tb_twitter01m avvenuto<br>";
// --HTMLecho"</table>";

    
$pageidnext=$pageid+1;
//if ($pageid<122){
if ($pageid<7411){
	echo'<META http-equiv="refresh" content="1;URL=index_monferrato1.php?id='.$pageidnext.'&start='.$starttime.'">';
}
// ELSE $pageid<7411
else{
	echo "STOP<br>$eseguita<br>$writeSQL";
	//var_dump($json_a);
	//print_r($respon
	mysqli_query($connessione,"
		CREATE TABLE tb_twitter01m_u
		SELECT *
		FROM tb_twitter01m
		WHERE NOT(field7lat=0)
		GROUP BY tb_twitter01m.field3;
	");

	echo "Tabella tb_twitter01m_u creata<br>";

	mysqli_query($connessione,"
		DROP TABLE `tb_twitter01m` 
	");
	echo "Tabella tb_twitter01m eliminata<br>";

	mysqli_query($connessione,"
		RENAME TABLE `Sql657432_5`.`tb_twitter01m_u` TO `Sql657432_5`.`tb_twitter01m` ;
	");
	echo "Tabella tb_twitter01m_u rinominata in tb_twitter01m<br>";

	//crea JSON
	$myFile = "geodata/exp_ptmon.js";
	$fh = fopen($myFile, 'w') or die("can't open file");

	$stringData = 'var exp_ptduomo = {
	"type": "FeatureCollection",
	"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
	                                                                                
	"features": [
	';
	fwrite($fh, $stringData);


	$myFile1 = "geodata/exp_ptmon_sel.js";
	$fh1 = fopen($myFile1, 'w') or die("can't open file");

	$stringData1 = 'var exp_ptmon_sel = {
	"type": "FeatureCollection",
	"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
	                                                                                
	"features": [
	';
	fwrite($fh1, $stringData1);

	// SQL SELECT CERCA TWEET UNIVOCI // i tweet sono già unici
	$result = mysqli_query($connessione,"
		SELECT *
		FROM tb_twitter01m
	");

	// WHILE SQL SELECT CERCA TWEET UNIVOCI // i tweet sono già unici
	while($row = mysqli_fetch_array($result)) {
		$field3=$row['field3'];
		$field2=$row['field2'];
		$field14=$row['field14'];
		$field7lat=$row['field7lat'];
		$field7lng=$row['field7lng'];
		$field_link=$row['field_link'];
		//echo $field2;
		if ($field14==NULL){}
		// ELSE $field14==NULL
		else{
	    $istring++;
	    $pieces = explode(", ", $field14);
	    foreach ($pieces as $s) { 
	      $s=strtolower($s);
	      	//if specific tag
	      	//if ($s=='xmas' OR $s=='christmas' OR $s=='natale' OR $s=='xmastree' OR $s=='natale2014' OR $s=='auguri' OR $s=='monferrato'){
		      	mysqli_query($connessione,"
			        INSERT INTO `tb_twitter01m_xmaps` (`indtag`,`field2`,`field3`,`field14`,`field7lat`,`field7lng`,`field_link`) 
			        VALUES ('$s','$field2','$field3','$field14','$field7lat','$field7lng','field_link');
		    	");
		    	
		    	//date diff
		    	$oggi=date('Y-m-d H:i:s');
				$dt = DateTime::createFromFormat('D M j H:i:s P Y', $field2);
				$dtweet= $dt->format('Y-m-d H:i:s');

				$datetime1 = date_create($dtweet);
				$datetime2 = date_create($oggi);
				$interval = date_diff($datetime1, $datetime2);
				$ddiff=(($interval->h)-1);
				$ddiffday=($interval->d);
				if ($ddiffday==0){$day0++;}
				elseif ($ddiffday==1){$day1++;}
				elseif ($ddiffday==2){$day2++;}
				elseif ($ddiffday==3){$day3++;}
				elseif ($ddiffday==4){$day4++;}
				elseif ($ddiffday==5){$day5++;}
				elseif ($ddiffday==6){$day6++;}
				elseif ($ddiffday==7){$day7++;}
				elseif ($ddiffday==8){$day8++;}
				elseif ($ddiffday==9){$day9++;}
				else{}
				$ddiff=($ddiff+($ddiffday*12));
				if ($ddiffday<3){
					//if ($ddiff<12){
					$itag++;
					$radius=18-($ddiff/3);
					if ($s=='xmas' OR $s=='christmas' OR $s=='natale' OR $s=='xmastree' OR $s=='natale2014' OR $s=='auguri' OR $s=='monferrato'  OR $s=='igerspiemonte'  OR $s=='monferratopaesaggi' OR $s=='xmastree' OR $s=='christmastime'){
						$itag1++;
						$color='#000';
						if($itag1==1){$comma='';}
						else{$comma=',';}
				    	//GEOJSON part
						$stringData1 = $comma.'
						{ "type": "Feature", "properties": { "tag": "'.$s.'","color_qgis2leaf": "'.$color.'", "radius_qgis2leaf": '.$radius.', "transp_qgis2leaf": 0.5, "transp_fill_qgis2leaf": 0.5, "tweet": "'.$field_link.'" }, "geometry": { "type": "Point", "coordinates": [ '.$field7lng.', '.$field7lat.' ] } }
						';
						fwrite($fh1, $stringData1);					
					}
					else{
						$itag99++;
						$color='#fff';
						if($itag99==1){$comma='';}
						else{$comma=',';}					
				    	//GEOJSON part
						$stringData = $comma.'
						{ "type": "Feature", "properties": { "tag": "'.$s.'","color_qgis2leaf": "'.$color.'", "radius_qgis2leaf": '.$radius.', "transp_qgis2leaf": 0.5, "transp_fill_qgis2leaf": 0.5, "tweet": "'.$field_link.'" }, "geometry": { "type": "Point", "coordinates": [ '.$field7lng.', '.$field7lat.' ] } }
						';
						fwrite($fh, $stringData);					
					}
					//}
					//else{}
				} // END $ddiffday<3
				else{} // END $ddiffday<3
		    //}
		    //else{} //if specific tag END
	    	}// end foreach $pieces as $s
	  	} // ELSE $field14==NULL  
	} // END WHILE SQL SELECT CERCA TWEET UNIVOCI // i tweet sono già unici

	//SVUOTA TABELLA tb_twitter01m_tpd
	mysqli_query($connessione,"TRUNCATE TABLE `tb_twitter01m_tpd`");

  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day0','0');
	");
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day1','1');
	");	
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day2','2');
	");	
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day3','3');
	");			
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day4','4');
	");	
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day5','5');
	");	
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day6','6');
	");	
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day7','7');
	");		
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day8','8');
	");		
  	mysqli_query($connessione,"
        INSERT INTO `tb_twitter01m_tpd` (`count`,`day`) 
        VALUES ('$day9','9');
	");								

	$oggi=date('Y-m-d H:i:s');
	$dt = DateTime::createFromFormat('D M j H:i:s P Y', $field2);
	$dtweet= $dt->format('Y-m-d H:i:s');

	$datetime1 = date_create($dtweet);
	$datetime2 = date_create($oggi);
	$interval = date_diff($datetime1, $datetime2);
	$ddiff=(($interval->h)-1)*60;

	echo "Data registrata: $dtweet<br>";
	echo "Data oggi: $oggi<br>";
	echo "Data diff: $ddiff<br>";
	echo "Tweet analizzati: $istring<br>Tag archiviati: $itag<br>";

	//GEOJSON part END
	$stringData = '
	]
	}
	';
	fwrite($fh, $stringData);
	echo"creazione file <a href='$myFile1'>GEOJSON1</a> eseguita<br>";
	//crea JSON END
	//GEOJSON part END
	$stringData1 = '
	]
	}
	';
	fwrite($fh1, $stringData1);
	echo"creazione file <a href='$myFile'>GEOJSON</a> eseguita<br>";
	//crea JSON END

	mysqli_query($connessione,"TRUNCATE TABLE `tb_twitter01m_field14`");

	echo "Tabella tb_twitter01m_field14 svuotata<br>";

	$result = mysqli_query($connessione,"SELECT min(field14) as field14 FROM tb_twitter01m GROUP BY field3");

	while($row = mysqli_fetch_array($result)) {
	  $field14=$row['field14'];
	  if ($field14==NULL){}
	  else{
	    $istring++;
	    //echo "$field14<br>";
	    $pieces = explode(", ", $field14);
	    //echo"<ul>";
	    foreach ($pieces as $s) { 
	      $itag++;
	      //echo "<li>$i $s </li>";
	      $s=strtolower($s);
	      mysqli_query($connessione,"
	        INSERT INTO `tb_twitter01m_field14` (`field14`) 
	        VALUES (
	        '$s'
	      );
	    ");
	    
	    }
	    //echo"</ul>";
	  }
	}

	echo"Tweet analizzati: $istring<br>Tag archiviati: $itag<br>";

	mysqli_query($connessione,"TRUNCATE TABLE `tb_twitter01m_field14c`");

	echo "Tabella tb_twitter01m_field14c svuotata<br>";


	$result2 = mysqli_query($connessione,"SELECT count(*) as count, `field14` FROM `tb_twitter01m_field14` GROUP BY `field14`");
	while($row = mysqli_fetch_array($result2)) {
	  $count=$row['count'];
	  $field14=$row['field14'];
	    mysqli_query($connessione,"
	        INSERT INTO `tb_twitter01m_field14c` (`field14`,`count`) 
	        VALUES (
	        '$field14','$count'
	      );
	    ");  
	}

	echo "Tabella tb_twitter01m_field14c riempita<br>";

	echo "In attesa di 100 per riavviare!<br>";
	echo'<META http-equiv="refresh" content="100;URL=index_monferrato1.php">';
} // END ELSE $pageid<7411
mysqli_close($connessione);		
?>
          
	</body>
</html>