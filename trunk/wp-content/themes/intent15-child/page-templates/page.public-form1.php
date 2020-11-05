<?php
/*
 * Template Name: Public FORM1
 *
 */
?>
<?php acf_form_head(); ?>
<?php get_header('osm-base'); ?>
<?php get_template_part('_page-image'); ?>


<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		<div id="content">
        
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
    <div class="row">
        <div class="col-sm-2">

        </div><!-- /.col-sm-4 -->
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Seleziona la foto dal tuo computer/smartphone</h3>
                </div>
                <div class="panel-body">                    
<?php
$filename=$_GET['filename'];
$update_id=$_GET['new_postid'];
if ($filename==NULL){
?>
            <form action="http://www.monferratopaesaggi.it/?page_id=10901&postid=<?php echo $update_id; ?>" method="POST" enctype="multipart/form-data">
 
<?php
}
//<input type='submit' name='submit' value='Submit'>
else{
?>
            <form method="POST">
 
<?php
}

?>

 
<?php

    if ($filename==NULL){
    // Nelle versioni di PHP precedenti alla 4.1.0 si deve utilizzare  $HTTP_POST_FILES anzichè
    // $_FILES.
    echo "
    <label for='file'>Filename:</label>
    <input type='file' name='file' id='file'><br>


    ";
    }
    //<input type='submit' name='submit' value='Submit'>
    else{
        crea_thumb_form($filename); 
        $fileexact=substr($filename, 0, strlen($filename)-4);
        echo"
        <div class='col-md-8' style='text-align:center;'>
            <img src='store_public/".$filename." ' width='400px'>
        </div>
        ";
        echo"
        <div class='col-md-4' style='text-align:center;'>
            <img src='thumb/".$fileexact."_200x200.jpg ' width='200px'>
        </div>
        ";        
    }
  
?>
<div class='col-md-12' style='text-align:center;'>
    <input type="hidden" name="immagine_esterna" value="<?php echo $filename; ?>">
    <input type="submit" name="submit" value="Continua" class="btn btn-primary btn-lg">
</div>
           </form> 

                </div>
            </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-2">
        </div><!-- /.col-sm-4 -->
    </div> 
<?php 
if(isset($_POST['submit']))
    {
		global $wpdb;
		add_post_meta( $update_id, 'immagine_esterna', ($_POST['immagine_esterna']) );
		echo "
		<meta http-equiv='refresh' content='0;url=?page_id=10406&new_postid=$update_id'>
		";
    }
?>

				</div>
			</article>
		</div><!--/content-part-->       

	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>