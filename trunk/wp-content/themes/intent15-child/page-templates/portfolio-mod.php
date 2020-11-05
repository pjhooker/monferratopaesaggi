<?php
/*
Template Name: Portfolio MOD
*/

// Portfolio functions
$portfolio_functions = locate_template('functions-portfolio.php');
require ( $portfolio_functions );
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>
<?php /*
<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">

		 if ( !wpb_meta('_portfolio_disable_switcher') ): ?>
			<ul id="portfolio-size" class="fix" data-current="<?php echo wpb_meta('_portfolio_layout', 'grid one-third'); ?>">
				<li><a id="switch-small" href="#" data-layout="grid one-fourth"><i class="icon-size small"></i>Small</a></li>
				<li><a id="switch-medium" href="#" data-layout="grid one-third"><i class="icon-size medium"></i>Medium</a></li>
				<li><a id="switch-large" href="#" data-layout="grid one-half"><i class="icon-size large"></i>Large</a></li>
			</ul><!--/#portfolio-size-->
		<?php endif; ?>
		
	</div><!--/#page-title-inner-->
</div><!--/#page-title-->

*/
?>
<div id="page" class="portfolio">
	<div id="page-inner" class="container fix">
        <div id="content">
    <?php /*                    
<ul class="tabs-nav fix">
	<li><a href="http://www.monferratopaesaggi.it/?page_id=1951">Mappa</a></li>
	<li><a href="http://www.monferratopaesaggi.it/?page_id=2251">Guida</a></li>
	<li><a class="active" href="http://www.monferratopaesaggi.it/?page_id=2197">Comuni</a></li>
    <li>
    
    </li>
</ul>*/
?>
<div style="display: block;" id="tab-3" class="tab">
    <div class="tab-content">
    Visualizza in base al percorso
    <a class='button medium' href='http://www.monferratopaesaggi.it/?page_id=5934'>Crea</a>
    <a class='button medium'  href='http://www.monferratopaesaggi.it/?page_id=5983'>Bric</a><!-- bOSCO -->
    <a class='button medium'  href='http://www.monferratopaesaggi.it/?page_id=5986'>Po</a>
    <a class='button medium'  href='http://www.monferratopaesaggi.it/?page_id=5987'>Miniere</a>
    <a class='button medium'  href='http://www.monferratopaesaggi.it/?page_id=5989'>Vigne</a><!-- Grignolino -->
    <a class='button medium'  href='http://www.monferratopaesaggi.it/?page_id=5988'>Profili</a><!-- Sud -->
            <?php if ( !wpb_meta('_portfolio_disable_switcher') ): ?>
			<ul id="portfolio-size" style='margin-top: 0px;'class="fix" data-current="<?php echo wpb_meta('_portfolio_layout', 'grid one-third'); ?>">
				<li><a id="switch-small" href="#" data-layout="grid one-fourth"><i class="icon-size small"></i>Small</a></li>
				<li><a id="switch-medium" href="#" data-layout="grid one-third"><i class="icon-size medium"></i>Medium</a></li>
				<li><a id="switch-large" href="#" data-layout="grid one-half"><i class="icon-size large"></i>Large</a></li>
			</ul><!--/#portfolio-size-->
		<?php endif; ?>
    </div>
</div>
			<?php while(have_posts()): the_post(); ?>
				<?php if ( $post->post_content ) : ?>
					<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
							<?php the_content(); ?>
							<div class="clear"></div>
						</div>
					</article>
				<?php endif; ?>
			<?php endwhile;?>
			
			<?php if ( !wpb_meta('_portfolio_disable_categories') ): ?>

<?php /*
				<ul id="portfolio-filter" class="<?php echo $isotope_class; ?> fix">				
					<?php if ( $meta_view ): ?>
						<?php wp_list_categories( 
							array(
								'taxonomy'	=> 'portfolio_category',
								'orderby'	=> 'name',
								'title_li'	=> '',
								'depth'		=> 2
							)
						); ?>					
					<?php else: ?>
						<li class="current"><a href="#" data-filter="*"><?php _e('All','intent'); ?></a></li>
						<?php air_portfolio::isotope_menu(wpb_meta('_portfolio_category')); ?>
					<?php endif; ?>
				</ul>		
                */ ?>
                
			<?php endif; ?>
			
			<?php do_action('wpb_portfolio_javascript', wpb_meta('_portfolio_disable_categories'),
				wpb_meta('_portfolio_disable_switcher'), wpb_meta('_portfolio_lightbox')); ?>
		
			<section id="portfolio" class="isotope"  style ="max-width:1930px !important;">
				<?php $item_rel = wpb_meta('_portfolio_lightbox_gallery')?'rel="gallery"':''; ?>
				<?php $lightbox = wpb_meta('_portfolio_lightbox'); ?>


				<?php // inizio LOOP COMUNI
				while ( $loop_orderbytitle->have_posts() ): $loop_orderbytitle->the_post(); wpb_metadata('_portfolio_orderby', 'title'); ?>
				<?php $item_link = wpb_portfolio_link($lightbox); ?>

				<div class="isotope-item <?php echo wpb_portfolio_class($meta_layout); ?>">
					<article class="portfolio-item">
						<a class="portfolio-thumbnail" href="<?php echo $item_link; ?>" title="<?php the_title_attribute(); ?>" <?php echo $item_rel; ?>>	
							
							<?php if ( has_post_thumbnail() ): ?>
								<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'portfolio-thumbnail-large'); ?>
								<img src="<?php echo $img[0]; ?>" alt="<?php the_title() ;?>" />						
							<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />
							<?php endif; ?>
							
							<?php if ( wpb_meta('_portfolio_video') ): ?><span class="play"></span><?php endif; ?>
							<span class="zoom"><i class="icon-zoom"></i></span>
							
						</a>
						
						<?php if( !wpb_option('hide-meta-portfolio') ): ?>
						<a class="button medium" style="margin:5px;"  href="<?php echo wpb_meta('_link', get_permalink()); ?>">
							<?php the_title(); ?>
						</a>
						<?php endif; ?>
						
					</article>
				</div><!--/.isotope-item-->
				
				<?php endwhile; ?>
				<?php wpb_reset_metadata(); ?>
				
				<div class="clear"></div>
			</section><!--/#portfolio-->

		</div><!--/#content-->
	</div><!--/#page-inner-->
</div><!--/#page-->

<?php get_footer(); ?>