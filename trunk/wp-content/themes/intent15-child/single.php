<?php


$versione = $_GET['versione'];



$template = get_field('template',$id);


if ($template=='2'){
	$template='single';
	$header='default_leafletjs';
	$footer='';
	$layout=0;
	$sidebar=3;
}

else if ($template=='tratta'){
	$template='tratta';
	$header='default_leafletjs';
	$footer='';
	$layout=0;
	$sidebar=3;
}

else if ($template=='test01b_kml'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=1;
}

else if ($template=='t1'){
	if ($versione==NULL){
		$header='osm-percorso-post-leaflet';
		$template='mappa_singolo_poi';
		$sidebar=3;
	}
	else {
		$header='osm-percorso-black';
		$template='mappa_singolo_poi_black';
		$sidebar=0;
	}
	$footer='';
	$layout=0;
}

else if ($template=='mappa_comune'){
	//{get_template_part('_loop-template1');}
	$template='mappa_comune';
	$sidebar=3;
	$layout=1;
	$header='leafletjs_base';
	$footer='leafletjs_base';
}

else if ($template=='landingpage_full'){
	$header=$template;
  $sidebar=2;
  $layout=1;
	$footer='';
}

else if ($template=='test02_kml'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=1;
}

else if ($template=='scheda_paesaggio'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=3;
}

else if ($template=='scheda_progetto'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=3;
}

else if ($template=='galleria-poi'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=1;
}

else if ($template=='bootleaf'){
  $template=get_field('custom_bootleaf');
  $header='bootleaf';
  $layout=1;
  $sidebar=2;
	$footer='';
}

else if ($template=='news'){
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=1;
}

else{
	$template='single';
	$footer='';
	$header='osm-percorso';
	$layout=0;
	$sidebar=1;
}

get_header($header);

?>

<?php
if($layout==0){
?>
	<?php if(wpb_option('blog-heading')): ?>
	<div id="page-title">
		<div id="page-title-inner" class="container fix">
			<h2><?php echo wpb_blog_heading(); ?></h2>
		</div><!--/page-title-inner-->
	</div><!--/page-title-->
	<?php endif; ?>

	<div id="page" class="fix">
		<div id="page-inner" class="container fix">

		<?php
		if ($sidebar==1){
		?>
			<div id="content-part">
			<?php
			get_template_part('_loop-' . $template);
			?>
			<?php menu_segreto(); ?>
			</div><!--/content-part-->
			<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
			</div><!--/sidebar-->
			<?php
		}
		else {
			get_template_part('_loop-' . $template);
		}
		?>

		</div><!--/page-inner-->
	</div><!--/page-->
	<?php
}
else{
	get_template_part('_loop-' . $template);
}

	if ($sidebar==1){
		?>

		<?php get_footer($footer); ?>

		<?php
	}
	else if ($sidebar==2){
	}
	else if ($sidebar==3){
		get_footer($footer);
	}
	else {
		?>
	    <div class="blog-footer">
	      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
	      <p>
	        <a href="#">Back to top</a>
	      </p>
	    </div>
		<?php
	}

?>
