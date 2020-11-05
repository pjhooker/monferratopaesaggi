
<!DOCTYPE html> 
<!--[if lt IE 7 ]><html class="no-js ie ie6" lang="it-IT" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" lang="it-IT" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="it-IT" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="it-IT" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> <!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Form per aggiungere foto, pubblica1 - Monferrato Paesaggi</title>

<link rel="stylesheet" href="http://www.monferratopaesaggi.org/wp-content/themes/intent15-child/style.css">
<link rel="pingback" href="http://www.monferratopaesaggi.org/xmlrpc.php">

<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,600italic,600,400italic,300italic,300&subset=latin,latin-ext">
<!-- EXTRA START -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- EXTRA END -->
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://www.monferratopaesaggi.org/wp-content/themes/intent15/js/ie/selectivizr.js"></script>
<![endif]-->



<!-- This site uses the Yoast Google Analytics plugin v5.2.7 - Universal disabled - https://yoast.com/wordpress/plugins/google-analytics/ -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-49258953-1']);
  _gaq.push(['_gat._forceSSL']);
  _gaq.push(['_trackPageview']);

  (function () {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- / Yoast Google Analytics -->
</head>
<?php
$post_id=$_GET['postid'];
$page_id=$_GET['page_id'];
$allowedExts = array("gif", "jpeg", "jpg", "png","PNG","GIF", "JPEG", "JPG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 8000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  }
  else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    /*if (file_exists("store_public/" . $_FILES["file"]["name"])) {
    echo $_FILES["file"]["name"] . " already exists. ";
    } else {*/

    $uploads_dir = 'store_public';
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = "id".$post_id."_" . $_FILES["file"]["name"];
    $name = strtolower($name);
    $name = str_replace (" ", "", $name);
    $name = strip_tags($name,"");
    $name = preg_replace('/[^A-Za-z0-9\s.\s-]/','',$name);

    move_uploaded_file($tmp_name, $uploads_dir."/".$name);

    /*move_uploaded_file(
    $_FILES["file"]["tmp_name"],
    "store_public/id".$post_id."_" . $_FILES["file"]["name"]
    );*/

    echo "Stored in: <a href='" . $uploads_dir."/".$name."'>".$name."</a>";
    global $wpdb;
    add_post_meta( $post_id, 'immagine_esterna', $name );
    echo "
    <meta http-equiv='refresh' content='0;url=?page_id=10406&new_postid=$post_id'>
    ";
    //echo "<meta http-equiv='refresh' content='0;url=http://www.monferratopaesaggi.org/?page_id=10405&new_postid=$post_id&filename=".$name."'>";
  }
}
else {
  echo "Invalid file";
  echo "<meta http-equiv='refresh' content='4;url=http://www.monferratopaesaggi.org/?page_id=10405&new_postid=$post_id'>";
}

?> 