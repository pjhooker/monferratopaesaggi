<?php
/**
 * Template Name: Form upload >>
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
$post_id=$_GET['postid'];
//$page_id=$_GET['page_id'];
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

        crea_thumb_form($name); 
        $fileexact=substr($name, 0, strlen($name)-4);
        echo"
        <div class='col-md-8' style='text-align:center;'>
            <img src='store_public/".$name." ' width='400px'>
        </div>
        ";
        echo"
        <div class='col-md-4' style='text-align:center;'>
            <img src='http://www.monferratopaesaggi.it/thumb/".$fileexact."_200x200.jpg ' width='200px'>
        </div>
        "; 

    global $wpdb;
    add_post_meta( $post_id, 'immagine_esterna', $name );
    echo "
    <meta http-equiv='refresh' content='0;url=?page_id=10406&new_postid=$post_id'>
    ";
    //echo "<meta http-equiv='refresh' content='0;url=http://www.monferratopaesaggi.it/?page_id=10405&new_postid=$post_id&filename=".$name."'>";
  }
}
else {
  echo "<h1>Il file non risulta valido</h1>";
  echo "<meta http-equiv='refresh' content='4;url=http://www.monferratopaesaggi.it/?page_id=10405&new_postid=$post_id'>";
}

?> 
	</div><!-- .entry-content -->

</article><!-- #post-## -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
