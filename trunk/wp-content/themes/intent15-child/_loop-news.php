
<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!wpb_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
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
	
	<div class="text">
	<?php
	$img1=get_field('immagine_evidenza');


//SLIDER START

//echo $url_image;
//echo"<img src='image.php?myimage=$img1&h=$imH&w=$imW' >";
	$titolo_opera = get_field('titolo_opera');
?>
	<div itemscope itemtype="http://schema.org/ImageObject">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">

            <img src="<? echo $img1; ?>" 

             width="100%" itemprop="contentUrl" />
			
          </div>
        </div>
    </div>
  	</div>
		<?php

		the_content(); ?>
		<?php

$cat= get_the_category();
$cat_name=$cat[0]->cat_name;
if($cat_name=='Tratta'){


$location = get_field('map',$id); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lon=$location['lng']; 
endif; // lat lng


echo"
            <div id='map'></div>

";

?>

<?php
if ($lat==NULL) {
$center_ln=8.295681;
$center_lt=45.105879;
$delta_ln=0.01;
$delta_lt=0.01;
}
else
{$center_ln=$lon;
$center_lt=$lat;
$delta_ln=0.01;
$delta_lt=0.01;
}



$SO_ln=$center_ln-$delta_ln;
$SO_lt=$center_lt-$delta_lt;
$NE_ln=$center_ln+$delta_ln;
$NE_lt=$center_lt+$delta_lt;
$bounds=$SO_ln . "," . $SO_lt . "," . $NE_ln . "," . $NE_lt;

$SO_ln=$center_ln-$delta_plus_ln;
$SO_lt=$center_lt-$delta_plus_lt;
$NE_ln=$center_ln+$delta_plus_ln;
$NE_lt=$center_lt+$delta_plus_lt;
$delta_plus_ln=0.02;
$delta_plus_lt=0.02;
$bounds_plus=$SO_ln . "," . $SO_lt . "," . $NE_ln . "," . $NE_lt;
$nord_it_extent=$bounds_plus;
?>
<style>
.olPopupContent{
    padding: 25px;
}
.olPopupContent,
.olFramedCloudPopupContent {
    background-color: #EDEDED;
    border:1px solid black;
}

</style>
<script src='http://maps.google.com/maps/api/js?v=3&amp;sensor=false'></script>

<script type="text/javascript">
            var extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'), 
            new OpenLayers.Projection('EPSG:900913'));
            var color1997 = <?php colore_percorso('1997') ?> ;
            var color1993 = <?php colore_percorso('1993') ?> ;
            var color1989 = <?php colore_percorso('1989') ?> ;
            var color1987 = <?php colore_percorso('1987') ?> ;
            var color1971 = <?php colore_percorso('1971') ?> ;
            var color1969 = <?php colore_percorso('1969') ?> ;
</script>

<script src='http://www.monferratopaesaggi.org/js/mappa_tutti_percorsi_comune.js'></script> 



<?php
// --- MAP --- STOP

}; //if($cat_name=='Tratta')



		?>
        <?php

  $mykey_values = get_post_custom_values('link_comune');
  if ($mykey_values ==NULL){}
  else{
      foreach ( $mykey_values as $key => $value ) {
        
        $comune=get_the_title($value);
        $link=get_permalink($value);
        echo"<span style='background-color:#9abdc0;color:#3644d7;padding:0 5px 0 5px;'><a href='$link'>$comune</a></span>";
    }
  }

?>
    
		<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','intent'),'after'=>'</div>')); ?>
		<div class="clear"></div>
	</div>

	<?php if(!wpb_option('post-hide-tags')): // Post Tags ?>
		<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','intent').'</span> ','','</p>'); ?>
	<?php endif; ?>

</article>

<?php if(!wpb_option('post-hide-categories')): // Post Categories ?>
	<p class="entry-category"><span><?php _e('Posted in:','intent'); ?></span> <?php the_category(' &middot; '); ?></p>
<?php endif; ?>
<?php if(wpb_option('post-enable-author-block')): // Post Author Block ?>
	<div class="entry-author-block fix">
		<div class="entry-author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'80'); ?></div>
		<p class="entry-author-name"><?php the_author_meta('display_name'); ?></p>
		<p class="entry-author-description"><?php the_author_meta('description'); ?></p>
	</div>
<?php endif; ?>

<?php comments_template(); ?>

<?php endwhile;?>