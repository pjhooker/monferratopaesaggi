<?php
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$postid = get_the_ID();
?>
<style>
.medium {
	font-family: freight-text-pro, Georgia, Cambria, 'Times New Roman', Times, serif;
	font-size: 22px;
	font-style: normal;
	font-weight: normal;
	line-height: 33px;
}
</style>
<?php while(have_posts()): the_post(); ?>
<?php
$img1=get_field('immagine_evidenza');
$img1ext=get_field('immagine_esterna');
$autore_wiki=get_field('autore_wiki');
$licenza = get_field('licenza');
$nome_autore = get_field('nome_autore');
$tipo_opera = get_field('tipo_opera');
$fonte_opera = get_field('fonte_opera');
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator', 'author');
if( array_intersect($allowed_roles, $user->roles ) ) {
	if ($img1==NULL) {
		if ($img1ext==NULL){}
		else{crea_thumb('store_public/'.$img1ext);}
	}
	else {
		crea_thumb($img1);
	}
} // IF EDITNG --STOP
else{} // ELSE EDITNG --STOP
?>
<?php
if ( has_post_thumbnail() ) { // controlla se il post ha un'immagine in evidenza assegnata.
	//the_post_thumbnail();
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
?>
					<div itemscope itemtype="http://schema.org/ImageObject">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<div class="item active">
								<img
									src="<?php echo $large_image_url[0]; ?>"
									title="<?php esc_attr( $thumbnail->post_title ); ?>"
									width="100%" itemprop="contentUrl"
									/>
									<p style="z-index:100;
										background-color:RGBA(255,255,255,0.5);
										padding:5px;
										margin:5px;
										position:absolute;
										color:#000;
										font-size:14px;
										right:0px;
										bottom:0px;">
										<a href="<?php echo get_permalink( get_post_thumbnail_id($post->ID) ); ?>"><i class="fa fa-info-circle"></i> Crediti immagine</a>
									</p>
								</div>
							</div>
						</div>
					</div>
<?php
} // has_post_thumbnail STOP
?>
<div class="container" style="max-width: 730px;">

<div class="row" style='padding-top:80px;' itemscope itemtype="http://schema.org/WebPage">
	<div class="col-md-12">
		<div itemprop="breadcrumb">
		  <a href="http://www.monferratopaesaggi.it">Monferrato paesaggi</a> >
		  <a href="?page_id=2191">Territorio</a> >
		  <a href="?p=10658"><?php the_title();?></a>
		</div>
		<h1 class="medium" style='padding-top:15px;font-size:32px;'><?php the_title();?></h1>
		<p style='padding-bottom:30px;'>A cura di <?php echo $autore_wiki;?></p>

		<?php get_template_part('_post-formats'); ?>

		<?php $content=get_the_content();
		echo "<div class='medium'>$content</div>";
		?>
	</div> <!--<div class="col-md-8">-->

<?php
// colonna 2
?>

</div><!--<div ROW>-->

<div class="row" style='padding-top:80px;' itemscope itemtype="http://schema.org/WebPage">
	<div class="col-md-12">
		<h3>Risorse utili per approfondire <?php echo the_title();?><meta itemprop="author" content="<?php echo $autore_wiki;?>" /></h3>

<?php
$numero_allegati=get_field('numero_allegati');
if ($numero_allegati==0){}
else{
		for ($i=1;$i<=$numero_allegati;$i++) {
			$allegato=get_field('allegato_'.$i);
			$allegato_url=get_field('allegato_'.$i.'_url');
			echo"
				<span class='glyphicon glyphicon-save'></span>
				<a href='$allegato_url'>$allegato</a>
				<meta itemprop='url' content='$allegato_url' />
				<meta itemprop='name' content='$allegato' />
	";
	}
}

?>
	</div> <!--<div class="col-md-4">-->
</div><!--<div ROW>-->
<div class="row" style='padding-top:80px;'>
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
</div><!--<div ROW>-->
</div><!--<div CONTAINER>-->
