<?php
$user_ID = get_current_user_id();
$user_info = get_userdata($user_ID);
$postid = get_the_ID();
?>

<?php while(have_posts()): the_post(); ?>
<?php
$img1=get_field('immagine_progetto');
$plink = get_the_permalink();

?>
<div class="row" style='padding-top:80px;' itemscope itemtype="http://schema.org/WebPage">
	<div class="col-md-8">
		<div itemprop="breadcrumb">
		  <a href="http://www.monferratopaesaggi.org">Monferrato paesaggi</a> >
		  <a href="http://www.monferratopaesaggi.org/scopri-il-portale/">Scopri il portale</a> >
		  <a href="<?php echo $plink; ?>"><?php the_title();?></a>
		</div>	
		<h1 style='padding-top:15px;'><?php the_title();?></h1>

		<?php get_template_part('_post-formats'); ?>

		<?php the_content();?>
	</div> <!--<div class="col-md-8">-->

<?php 
// colonna 2
?>

    <div class="col-md-4">       
		<div class="panel panel-default">
	        <div class="panel-body">
<?php
//SLIDER START
       	echo"
			<a data-toggle='modal' data-target='#myModal_foto'> 
	            <img class='img-thumbnail' src='$img1' width='100%' itemprop='image' />
	    	</a>
	    ";
?>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal_foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width: 670px;margin: 50px auto;'>
    <div class="modal-content">
      <div class="modal-body">
        <a href='<?php echo "$img1";?>'><img src='<?php echo $img1;?>' style='width:100%;'></a>
      </div>
      <div class="modal-footer">
      	<a href='<?php echo "$img1";?>' class="btn btn-primary" >Apri a tutto schermo</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>

     </div><!--<div class="panel-body">-->
	    </div>
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