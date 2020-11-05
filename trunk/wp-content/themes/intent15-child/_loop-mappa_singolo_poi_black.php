<?php

$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$postid = get_the_ID();

?>

<?php while(have_posts()): the_post(); ?>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title"><?php the_title(); ?></h1>
        <p class="lead blog-description"><?php $tipo = get_field('tipo'); echo $tipo;?></p>
      </div>

      <div class="row">

<div class="col-sm-8 blog-main">

          <div class="blog-post">
            <p class="blog-post-meta"><span class="vcard author"><span class="fn">

by <a href="https://plus.google.com/+PJHooker"
rel="author"><?php echo"Monferrato Paesaggi"; ?></a>

</span></span>
<span class='date updated'> Published on <?php the_time('F S, Y'); ?></span></p>
          

	<?php if(!wpb_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">

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
           
<?php
//SLIDER END
?>

		<?php the_content();/*the_meta();*/ ?>

<?php

$percorso = get_field('field_5352634f44829',$id);
$location = get_field('map',$id); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

?>

<?php /* NEW MAP START */ ?>

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
";
?>

<script src='http://www.monferratopaesaggi.it/js/mappa_scheda_poi_black.js'></script>
<script type="text/javascript">
    var lon = <?php echo $lng; ?>,
    lat = <?php echo $lat; ?>
</script>

<?php
// ------------------------------------------------------------------------- OPENLAYERS STOP
?>
<?php
/* 
 * NEW MAP STOP 
 * MOD PJH --- STOP
*/ 
$img1=get_field('immagine_evidenza');
$rest = substr($img1, 0, -4); 
?>

</div><!-- /.blog-post -->
</div> <!--<div class="col-sm-8 blog-main">-->
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p><!--<a href="<?php /*echo $img1; */?>">-->
            <?php
$image = wp_get_image_editor( $img1); 
$imageX = wp_get_image_editor( $img1); 
// Return an implementation that extends <tt>WP_Image_Editor</tt>

if ( ! is_wp_error( $image ) ) {
    $image->resize( 200, 200, true );
    $image->save('new_image.jpg');
}
if ( ! is_wp_error( $imageX ) ) {
    $imageX->resize( 1024, 768, true );
    $imageX->save('new_image_x.jpg');
}

            ?>
                            <a href="new_image_x.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                <img src="new_image.jpg" class="img-responsive" height="auto" width="100%">
                            </a>
            <!--<img class="alignnone size-thumbnail wp-image-9687" alt="IMG_1810" src="new_image.jpg" height="auto" width="100%">
            </a>--></p>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
<?php endwhile;?>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="http://www.monferratopaesaggi.it/php/lightbox-master/dist/ekko-lightbox.js"></script>

        <script type="text/javascript">
            $(document).ready(function ($) {
                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        onShown: function() {
                            if (window.console) {
                                return console.log('Checking our the events huh?');
                            }
                        },
						onNavigate: function(direction, itemIndex) {
                            if (window.console) {
                                return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                            }
						}
                    });
                });

                //Programatically call
                $('#open-image').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();
                });
                $('#open-youtube').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();
                });

            });
        </script>