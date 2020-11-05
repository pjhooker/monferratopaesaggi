<?php
$img_get= get_field('immagine_full');
//$img= wp_get_attachment_image_src(get_field('immagine_full'));
$call_text= get_field('call_to_action_text');
$call_url= get_field('call_to_action_url');
?>
<style>
.full {
  background: url(<?php echo $img_get ?>) no-repeat center center fixed; 
}
</style>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12" style='background-color:RGBA(255,255,255,0.7);'>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
                <p>
                <?php
                //the_meta();
                echo " 
                    <a href='$call_url' class='btn btn-primary btn-lg' role='button'>$call_text »</a
                "; 
                ?>
                </p>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="http://www.cityplanner.it/php/the-big-picture/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://www.cityplanner.it/php/the-big-picture/js/bootstrap.min.js"></script>

</body>

</html>