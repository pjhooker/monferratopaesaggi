	<div class="clear"></div>
	<div id="footer-wrap">
	
	<?php if(wpb_option('footer-widgets') || wpb_option('footer-contact-enable')): ?>
		<div id="subfooter">
			<div id="subfooter-inner" class="container fix">
				<?php if(wpb_option('footer-widgets')): ?>
				<div id="subfooter-widgets">
					<ul class="one-fourth">
						<?php dynamic_sidebar('widget-footer-1'); ?>
					</ul>
					<ul class="one-fourth">
						<?php dynamic_sidebar('widget-footer-2'); ?>
					</ul>
					<ul class="one-fourth">
						<?php dynamic_sidebar('widget-footer-3'); ?>
					</ul>
					<ul class="one-fourth last">
						<?php dynamic_sidebar('widget-footer-4'); ?>
					</ul>
					<div class="clear"></div>
				</div><!--/subfooter-widgets-->
				<?php endif; ?>

				<?php if(wpb_option('footer-contact-enable')): ?>
				<div id="subfooter-contact" class="fix">
					<?php if(wpb_option('footer-address')) { echo '<p id="contact-address">'.wpb_option('footer-address').'</p>'; } ?>
					<?php if(wpb_option('footer-phone')) { echo '<p id="contact-phone">'.wpb_option('footer-phone').'</p>'; } ?>
					<?php if(wpb_option('footer-email')) { echo '<p id="contact-email"><a href="mailto:'.wpb_option('footer-email').'">'.wpb_option('footer-email').'</a></p>'; } ?>
				</div><!--/subfooter-contact-->
				<?php endif; ?>

			</div><!--/subfooter-inner-->
		</div><!--/subfooter-->
	<?php endif; ?>
		
		<footer id="footer" class="fix">
			<div id="footer-inner" class="container fix">
				<div class="one-half">
					<?php wp_nav_menu(array('container'=>'nav','container_id'=>'nav-footer','theme_location'=>'wpb-nav-footer','menu_id'=>'nav-alt','menu_class'=>'fix', 'fallback_cb'=>FALSE)); ?>
					<div class="clear"></div>
					<p id="copy"><?php echo wpb_footer_text(); ?></p>
				</div>
				<div class="one-half last">
					<a id="to-top" href="#"><i class="icon-top"></i></a>
					<?php echo wpb_social_media_links(array('id'=>'footer-social')); ?>
				</div>
			</div><!--/footer-inner-->
		</footer><!--/footer-->
		
	</div><!--/footer-wrap-->
	
</div><!--/wrap-->
<?php wp_footer(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/ie/respond.min.js"></script> <![endif]-->
</body>
</html>