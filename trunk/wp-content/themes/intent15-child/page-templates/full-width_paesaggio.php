<?php
/*
Template Name: Page Paesaggio
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page">
	<div id="page-inner" class="container fix">
	
		<div id="content">

<div class="row" style='padding-top:80px;'>
	<div class="col-md-12">
		<h1 style='padding-top:15px;padding-bottom:30px;'><?php the_title();?></h1>


			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
</div>
<div class="col-md-12">				
				<div class="tabs fix">
					<ul class="tabs-nav fix">
						<li class="active"><a href="#tab-1">Il Paesaggio del Monferrato</a></li>
						<li><a href="#tab-2">Immagini guida</a></li>
						<li><a href="#tab-3">Caratteri sub-aree</a></li>
						<li><a href="#tab-4">Caratteri dell'ambiente costruito</a></li>					
					</ul>	
<?php
$the_query = new WP_Query('p=10737');
$count_tab++;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
$title_tab=get_the_title();
$excerpt_tab=get_the_content();
$plink=get_permalink();
$img1=get_field('immagine_evidenza');
$tipo_opera = get_field('tipo_opera');
echo"
	<div style='display: block;' id='tab-$count_tab' class='tab'>
		<div class='tab-content'>
			<h3 style='text-align: justify;'>$title_tab</h3>
			<p style='text-align: justify;'>$excerpt_tab</p>
			<p style='font-size:22px;'><a href='$plink'>Apri pagina</a></p>		
		</div>
	</div>
";
endwhile;
// Reset Post Data
wp_reset_postdata();					
?>
<?php
$the_query = new WP_Query('p=10738');
$count_tab++;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
$title_tab=get_the_title();
$excerpt_tab=get_the_content();
$plink=get_permalink();
$img1=get_field('immagine_evidenza');
$tipo_opera = get_field('tipo_opera');
echo"
	<div id='tab-$count_tab' class='tab'>
		<div class='tab-content'>
			<h3 style='text-align: justify;'>$title_tab</h3>
			<p style='text-align: justify;'>$excerpt_tab</p>
			<p style='font-size:22px;'><a href='$plink'>Apri pagina</a></p>		
		</div>
	</div>
";
endwhile;
// Reset Post Data
wp_reset_postdata();					
?>
<?php
$the_query = new WP_Query('p=10739');
$count_tab++;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
$title_tab=get_the_title();
$autore_wiki=get_field('autore_wiki');
$excerpt_tab=get_the_content();
$plink=get_permalink();
$img1=get_field('immagine_evidenza');
$tipo_opera = get_field('tipo_opera');
echo"
	<div id='tab-$count_tab' class='tab'>
		<div class='tab-content'>
			<h3 style='text-align: justify;'>$title_tab</h3>
			<p style='text-align: justify;'>$excerpt_tab</p>
			<p style='font-size:22px;'><a href='$plink'>Apri pagina</a></p>		
		</div>
	</div>
";
endwhile;
// Reset Post Data
wp_reset_postdata();					
?>
<?php
$the_query = new WP_Query('p=10740');
$count_tab++;
// Loop sulla query
while ( $the_query->have_posts() ) : $the_query->the_post();
$title_tab=get_the_title();
$excerpt_tab=get_the_content();
$plink=get_permalink();
$img1=get_field('immagine_evidenza');
$tipo_opera = get_field('tipo_opera');
echo"
	<div id='tab-$count_tab' class='tab'>
		<div class='tab-content'>
			<h3 style='text-align: justify;'>$title_tab</h3>
			<p style='text-align: justify;'>$excerpt_tab</p>
			<p style='font-size:22px;'><a href='$plink'>Apri pagina</a></p>		
		</div>
	</div>
";
endwhile;
// Reset Post Data
wp_reset_postdata();					
?>
				</div>				
			</article>

			<?php comments_template(); ?>


	</div><!--/md-->
</div><!--/row-->

		</div>	
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php endwhile;?>

<?php get_footer(); ?>
