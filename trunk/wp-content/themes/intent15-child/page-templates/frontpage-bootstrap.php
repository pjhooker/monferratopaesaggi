<?php
/*
Template Name: Frontpage Bootstrap
*/

global $meta;
$meta = get_post_custom(); // Custom fields
?>
<?php get_header('light'); ?>

<?php // Is slider enabled on front page ?
if(isset($meta['_front_slider_enable'])) {
	// Set slider layout
	$s_layout = isset($meta['_front_slider_layout'])?$meta['_front_slider_layout'][0]:'_front-slider-1';
	// Get slider template
	if($s_layout=='_front-slider-1' || $s_layout=='_front-slider-3') {
		get_template_part($s_layout);
	}
}
?>

<?php while (have_posts()) : the_post(); ?>
<div id="page" class="front">
	<div id="page-inner" class="container fix">
	<?php
		if(isset($s_layout) && ($s_layout=='_front-slider-2' || $s_layout=='_front-slider-4')) {
			get_template_part($s_layout);
		}
	?>

<!-- CAROUSEL SEZ.1 -->
	<?php
		$width_slide='1200px';
		$height_slide='667px';
		$style='style="width:'.$width_slide.';height:'.$height_slide.';"';
	?>
      <div id="carousel-example-generic" class="carousel slide hidden-xs hidden-sm" data-ride="carousel" data-interval="9000">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          <li data-target="#carousel-example-generic" data-slide-to="3"></li>
          <li data-target="#carousel-example-generic" data-slide-to="4"></li>
          <li data-target="#carousel-example-generic" data-slide-to="5"></li>
        </ol>
        <div class="carousel-inner">
        <!-- -->
        <?php


        /*$slide1_img='';
        $slide1_p='';
        $slide1_h2='';
        $slide1_button='';
        $slide1_url='';
        */?>
<?php
for ($mul = 1; $mul <= 6; ++$mul) {
  if ($mul==1){$item='class="item active"';}
  else {$item='class="item"';}
  if ($mul==1){
    $slide_img='"https://lh5.googleusercontent.com/-Sh7VpNGWHm0/Vcup9JydysI/AAAAAAABkJ8/14O8mDxG8Zs/w1142-h669-no/1_Bric.jpg"';
    $slide_p='<p>Percorso BRIC</p>';
    $slide_h2='<h2>I borghi tra i boschi</h2>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1987"';
  }
  else if ($mul==2){
    $slide_img='"https://lh5.googleusercontent.com/-MKRSHoKcHDs/Vcup89Z-deI/AAAAAAABkJ0/nfPQ7yuQEuo/w1142-h669-no/2_crea.jpg"';
    $slide_p='<p>Percorso CREA</p>';
    $slide_h2='<h2>Il Sacro Monte tra colline/crinali e campanili</h2>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1971"';
  }
  else if ($mul==3){
    $slide_img='"https://lh3.googleusercontent.com/-pxHUoihgGdQ/Vcup9CYDBbI/AAAAAAABkJ4/uw7Xu4XMU10/w1142-h669-no/3_miniere.jpg"';
    $slide_p='<p>Percorso MINIERE</p>';
    $slide_h2='<h2>Vigneti e antiche vie del cemento</h2>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1989"';
  }
  else if ($mul==4){
    $slide_img='"https://lh5.googleusercontent.com/-H9vgF8siOck/Vcup-hOfXMI/AAAAAAABkKM/qJAjBghchm8/w1142-h669-no/4_po.jpg"';
    $slide_p='<p>Percorso PO</p>';
    $slide_h2='<h2>Vedute tra Alpi e terre di acqua</h2>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1993"';
  }
  else if ($mul==5){
    $slide_img='"https://lh3.googleusercontent.com/-I9xRGwmruD0/Vcup_BLsPHI/AAAAAAABkKU/vIq-o1HEqA8/w1142-h669-no/5_img_0445.jpg"';
    $slide_p='<p>Percorso PROFILI</p>';
    $slide_h2='<h2>Scorci di paesaggio antico</h2><p>di <a href="https://www.facebook.com/matteo.monzeglio" style="color:#fff;">Matteo Monzeglio</a></p>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1997"';
  }
  else if ($mul==6){
    $slide_img='"https://lh5.googleusercontent.com/-qSouTpTSlBs/Vcup_GHdWvI/AAAAAAABkKQ/54WkNHVV4Dc/w1142-h669-no/6_vigne.jpg"';
    $slide_p='<p>Percorso VIGNE</p>';
    $slide_h2='<h2>Terre di vino e pietra da cantoni</h2>';
    $slide_button='Vai al percorso';
    $slide_url='"http://www.monferratopaesaggi.it/?page_id=1969"';
  }
  else{}
  echo "
    <div $item>
      <img src=$slide_img alt='First slide' $style >
      <div class='carousel-caption'>
        $slide_p
        $slide_h2
        <p><a href=$slide_url><button type='button' class='btn btn-lg btn-danger'>$slide_button</button></a></p>
      </div>
    </div>
  ";
}
?>

        <?php
        /*
          <div class="item active">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_autunno.jpg" alt="First slide" <?php echo $style;?> >
            <div class="carousel-caption">
            	<!--<p>Percorso PROFILI</p>-->
            	<!--<h2>Scorci di paesaggio antico</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_geometrieestate1.jpg" alt="First slide"  <?php echo $style;?> >
            <div class="carousel-caption">
            	<!--<p>Percorso PO</p>-->
            	<!--<h2>Vedute tra Alpi e terre d'acqua</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_inverno1.jpg" alt="First slide"  <?php echo $style;?> >
            <div class="carousel-caption">
            	<!--<p>Percorso MINIERE</p>-->
            	<!--<h2>Vigneti e antiche vie del cemento</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_lavoro1.jpg" alt="First slide"  <?php echo $style;?> >
            <div class="carousel-caption">
            	<!--<p>Percorso BRIC</p>-->
            	<!--<h2>I borghi tra i boschi</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_versopianura2.jpg" alt="First slide"  <?php echo $style;?> >
            <div class="carousel-caption">
            	<!--<p>Percorso CREA</p>-->
            	<!--<h2>Il Sacro Monte tra colline/crinali e campanili</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
          <div class="item">
            <img src="http://www.monferratopaesaggi.it/wp-content/uploads/slide_oziarium2.jpg" alt="First slide"  <?php echo $style;?> >
            <div class="carousel-caption">
            	<p>Percorso VIGNE</p>-->
            	<h2>Terre di vino e pietra da cantoni</h2>-->
            	<p><a href="http://www.monferratopaesaggi.it/?page_id=1951"><button type="button" class="btn btn-lg btn-danger">Vai ai percorsi</button></a></p>
            </div>
          </div>
        */
        ?>
        <!-- -->
        </div> <!-- END carousel-inner -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>

<!-- CAROUSEL END -->

<!-- SEZ.2 -->
	<div style='padding: 40px 15px;text-align: center;'>
        <h2 style='text-align: center;font-size:36px;'>Percorsi, mete e vedute del Monferrato Casalese</h2>
    	<p class="lead">Alla scoperta di terre d'acqua e di crinali, di boschi e vigneti,<br>di memoria e tradizione lungo le strade del Monferrato Casalese.</p>
    </div>
<!-- SEZ.2 END -->

<!-- SEZ.3 -->
	<div class="row">
		<div class="col-lg-4" style='text-align: center;'>
			<a href='http://www.monferratopaesaggi.it/?page_id=1951'><img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/iconmonstr-map-2-icon-256.png" style="width: 200px; height: 200px;" class="img-thumbnail" alt="200x200">
			<h2>ITINERARI</h2>
			<p style='font-size:21px;'>Scopri i percorsi<br>più suggestivi</p></a>
		</div>
		<div class="col-lg-4" style='text-align: center;'>
			<a href='http://www.monferratopaesaggi.it/?page_id=2191'><img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/noun_72353_cc.png" style="width: 200px; height: 200px;" class="img-thumbnail" alt="200x200">
			<h2>TERRITORIO</h2>
			<p style='font-size:21px;'>Conosci il paesaggio<br>e la storia</p></a>
		</div>
		<div class="col-lg-4" style='text-align: center;'>
			<a href='http://www.monferratopaesaggi.it/?page_id=10380'><img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/noun_2159_cc.png" style="width: 200px; height: 200px;" class="img-thumbnail" alt="200x200">
			<h2>PARTECIPA</h2>
			<p style='font-size:21px;'>Entra nella community<br>del Monferrato Casalese</p></a>
		</div>
	</div>
<!-- SEZ.3 END -->

<!-- SEZ.4 -->
	<div style='padding: 40px 15px;text-align: center;'>
        <h2 style='text-align: center;font-size:36px;'>Percorsi tra natura e cultura</h2>
    </div>
<!-- SEZ.4 END -->

<!-- SEZ.5 -->
<div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1997); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso PROFILI<br><i>Scorci di paesaggio antico</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1997'>
              	<img data-holder-rendered="true" src="https://lh3.googleusercontent.com/-fp-YPZxvU2o/VcvbOJy-ihI/AAAAAAABkLY/2zorrSPK5Ko/w320-h219-no/20150813_Selezione_001.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1993); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso PO<br><i>Vedute tra Alpi e terre d’acqua</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1993'>
              	<img data-holder-rendered="true" src="https://lh3.googleusercontent.com/-Hz5XDuyd_nk/VcvbRmpEwBI/AAAAAAABkLw/GQyZvw0uDBM/w320-h219-no/20150813_Selezione_004.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1989); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso MINIERE<br><i>Vigneti e antiche vie del cemento</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1989'>
              	<img data-holder-rendered="true" src="https://lh3.googleusercontent.com/-LfmXDK3D9vw/VcvbP0dhn0I/AAAAAAABkLg/1WmBPkO0Pm4/w320-h219-no/20150813_Selezione_002.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
            <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1987); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso BRIC<br><i>I borghi tra i boschi</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1987'>
              	<img data-holder-rendered="true" src="https://lh6.googleusercontent.com/-Q7QwNWQzLto/VcvbSmJShxI/AAAAAAABkL4/oqYbcH5zhOI/w320-h218-no/20150813_Selezione_005.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1971); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso CREA<br><i>Il Sacro Monte tra colline/crinali e campanili</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1971'>
              	<img data-holder-rendered="true" src="https://lh6.googleusercontent.com/-OzSrsJlqL-w/VcvbQ9Ax8zI/AAAAAAABkLo/xvdK5gAXqDE/w318-h219-no/20150813_Selezione_003.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
          <div class="panel panel-default">
          	<?php $colore_percorso= get_field('colore_percorso',1969); ?>
            <div class="panel-heading" style='background-image: linear-gradient(to bottom, <?php echo $colore_percorso;?> 0px, <?php echo $colore_percorso;?> 100%);background-repeat: repeat-x;'>
              <h3 class="panel-title" style='text-align:center;color:#fff;text-shadow: 1px 1px #5b5b5b;'>Percorso VIGNE<br><i>Terre di vino e pietra da cantoni</i></h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=1969'>
              	<img data-holder-rendered="true" src="https://lh3.googleusercontent.com/-X5ous91-6sM/VcvbTyg5gwI/AAAAAAABkMA/W7mqAFhLt64/w320-h219-no/20150813_Selezione_006.jpg" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
      </div>
<!-- SEZ.5 END-->

<!-- SEZ.6 -->
	<div style='padding: 40px 15px;text-align: center;'>
        <h2 style='text-align: center;font-size:36px;'>Racconta i tuoi #monferratopaesaggi</h2>
    </div>
<!-- SEZ.6 END -->
<!-- SEZ.7 -->
	<div class="row">
  <?php /*
        <div class="col-lg-4 hidden-xs hidden-sm">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title" style='text-align:center;'>Seguici da Twitter</h3>
            </div>
            <div class="panel-body">
			<table class="table table-bordered">
				<tbody>
<?php
$json_out = file_get_contents('http://www.cityplanner.it/experiment_host/php/twitter02monferrato/geodata/tweet_monferrato.json');

$json_out_a = json_decode($json_out,true);

foreach($json_out_a['features'] as $data_out) {
	$it++;
	if ($it<6){
	$field_out1=$data_out['profile_image_url'];
	$field_out2=$data_out['screen_name'];
	$field_out3=$data_out['text'];
	$field_out4=$data_out['link'];
	echo"
		<tr>
			<td rowspan='2'><img src='$field_out1'></td>
			<td>$field_out2</td>
			</tr>
			<tr>
			<td><a href='$field_out4' target='_blank'>$field_out3</a></td>
		</tr>
		";
	}

}
	echo"
		<tr>
			<td></td>
			<td><a href='https://twitter.com/hashtag/monferratopaesaggi' target='_blank'>Continua su Twitter</a> [...]</td>
		</tr>
		";
?>

	            </tbody>
	          </table>

            </div>
          </div>
        </div><!-- /.col-sm-4 -->
*/
/*
?>
        <div class="col-lg-8  hidden-xs hidden-sm">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title" style='text-align:center;'>Ultime foto su Instagram</h3>
            </div>
            <div class="panel-body">
            <div class='row'>

<?php
$json_out = file_get_contents('http://www.cityplanner.it/experiment_host/php/twitter02monferrato/geodata/instagram_monferrato.json');

$json_out_a = json_decode($json_out,true);

foreach($json_out_a['features'] as $data_out) {
	$i++;
	if ($i<13){
	$field_out1=$data_out['profile_image_url'];
	$field_out2=$data_out['screen_name'];
	$field_out3=substr($data_out['text'], 0, 22);
	$field_out4=$data_out['link'];
	echo"
    <div class='col-md-2' style='padding-right: 0px;padding-left: 0px;'>
		<a href='$field_out4' target='_blank'><img src='$field_out1' width='100%'></a></div>
  ";
  /*
		$field_out2<br>
		$field_out3 [...]

    ";
  */
	/*
	}

}
	echo"
    </div>
    <a href='http://instagram.com' target='_blank'>Continua su Instagram</a> [...]

		";
?>

            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title" style='text-align:center;'>Aggungi la tua foto</h3>
            </div>
            <div class="panel-body">
              <a href='http://www.monferratopaesaggi.it/?page_id=10380'>
              	<img data-holder-rendered="true" src="http://www.monferratopaesaggi.it/wp-content/uploads/iconmonstr-location-8-icon-256.png" style="width: 100%;" class="img-thumbnail" alt="200x200">
              </a>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
				<?php */ ?>
	</div>
<!-- SEZ.7 END -->
		<div id="content">
			<div id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--/content-->
	</div><!--/page-inner-->
</div><!--/page-->
<?php endwhile; ?>

<?php

// Is portfolio enabled on front page ?
if(isset($meta['_front_portfolio_enable'])) {
	// Set portfolio layout
	$p_layout = isset($meta['_front_portfolio_layout'])?$meta['_front_portfolio_layout'][0]:'_front-portfolio-1';
	// Get portfolio template
	get_template_part($p_layout);
}

// Is blog enabled on front page ?
if(isset($meta['_front_blog_enable'])) {
	// Set blog layout
	$b_layout = isset($meta['_front_blog_layout'])?$meta['_front_blog_layout'][0]:'_front-blog-1';
	// Get blog template
	get_template_part($b_layout);
}

?>

<?php get_footer('light'); ?>
