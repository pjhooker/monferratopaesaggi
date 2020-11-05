<?php
/*
Template Name: Page Progetto
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
						<li class="active"><a href="#tab-1">Il progetto</a></li>
						<li><a href="#tab-2">Utilizzo dei dati</a></li>
						<li><a href="#tab-3">Tematiche</a></li>
						<li><a href="#tab-4">Formato</a></li>	
						<li><a href="#tab-5">OpenData</a></li>	
						<li><a href="#tab-6">OpenStreetMap</a></li>	
						<li><a href="#tab-7">Sintesi</a></li>	
						<li><a href="#tab-8">Altre informazioni</a></li>	
						<li><a href="#tab-9">Dal pubblico</a></li>	
						<li><a href="#tab-10">Navigatore</a></li>	
					</ul>	
<?php
$count_tab++;
get_tab_scopriportale(11896,$count_tab);				
$count_tab++;
get_tab_scopriportale(11902,$count_tab);					
$count_tab++;
get_tab_scopriportale(11904,$count_tab);					
$count_tab++;
get_tab_scopriportale(11906,$count_tab);
$count_tab++;
get_tab_scopriportale(11909,$count_tab);
$count_tab++;
get_tab_scopriportale(11913,$count_tab);
$count_tab++;
get_tab_scopriportale(11915,$count_tab);
$count_tab++;
get_tab_scopriportale(11917,$count_tab);
$count_tab++;
get_tab_scopriportale(11919,$count_tab);
$count_tab++;
get_tab_scopriportale(11921,$count_tab);

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
