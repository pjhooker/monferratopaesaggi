<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!wpb_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">
		<h1 class="entry-title">
			<?php /*the_title(); */?>
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
                // VERIFICA E VISUALIZZA LA RELAZIONE
                $key_r="relazione";
                $value_r=get_post_meta($post->ID, $key_r, true);
                if ($value_r==NULL){echo"NESSUNA RELAZIONE";}
                else {echo "
                            <h2>Torna a scheda POI <a href='" . get_permalink($value_r) . "'>" . get_the_title($value_r) . "</a>
                            </h2>"
                        ;}
                ?>
		<?php the_content(); ?>
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

<?php /*comments_template();*/ ?>

<?php endwhile;?>