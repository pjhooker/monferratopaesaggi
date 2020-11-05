<?php
$passid = get_the_ID();
?>
	<div class="clear"></div>
	<div id="footer-wrap">
		<?php /*if(wpb_option('footer-widgets') || wpb_option('footer-contact-enable')): ?>
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
	<?php endif; */?>

		<footer id="footer" class="fix">
			<div id="footer-inner" class="container fix">
			<?php/*
				<div class="one-half">
					<?php wp_nav_menu(array('container'=>'nav','container_id'=>'nav-footer','theme_location'=>'wpb-nav-footer','menu_id'=>'nav-alt','menu_class'=>'fix', 'fallback_cb'=>FALSE)); ?>
					<div class="clear"></div>
					<p id="copy"><?php echo wpb_footer_text(); ?></p>
				</div>
				<div class="one-half last">
					<a id="to-top" href="#"><i class="icon-top"></i></a>
					<?php echo wpb_social_media_links(array('id'=>'footer-social')); ?>
				</div>
			*/?>
				<div class="row">
	        		<div class="col-sm-4 hidden-xs hidden-sm">
	        			<p><b>Progetto</b></p>
						<p><a href="http://www.odpm.it/"><img src="http://www.monferratopaesaggi.org/wp-content/uploads/logo-odpm-footer2grey1.png"></a> </p>
						<p><a href="http://www.compagniadisanpaolo.it/"><img src="http://www.monferratopaesaggi.org/wp-content/uploads/logo-san-paologrey.png" style="width:50%;"></a></p>
					</div>
			        <div class="col-sm-4 hidden-xs hidden-sm">
			        	<p style='text-align:center;'>
						<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">
							<img alt="Licenza Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" />
						</a><br />
						<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Monferrato Paesaggi </span>
						di <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.odpm.it/" property="cc:attributionName" rel="cc:attributionURL" style='color:#fff;'>
						Osservatorio del paesaggio per il Monferrato Casalese</a>
						è distribuito con Licenza
						<a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/" style='color:#fff;'>Creative Commons Attribuzione - Non commerciale 4.0 Internazionale</a>.<br>
						Eventuali dati originali contenuti in questo sito, che sono caricati anche su <a href="https://github.com/pjhooker/pjh_geocms/tree/master/monferratopaesaggi" style='color:#fff;'>GitHub</a>, possono essere importati su OpenStreetMap.
						</p>
						<p style='text-align:center;'>
							Pagina Monferrato Paesaggi su <a href="https://plus.google.com/104858056468305692205" rel="publisher" style='color:#fff;'>Google+</a>
							<a href="http://www.monferratopaesaggi.org/?page_id=10356" style='color:#fff;'><i class="fa fa-bug"></i></a>
						</p>
			        </div>
			        <div class="col-sm-4 hidden-xs hidden-sm" style='padding-bottom:15px;' itemscope itemtype="http://data-vocabulary.org/Organization">
			        	<b>Contatti</b><br>
			        	<span itemprop="name">Osservatorio del paesaggio per il Monferrato Casalese</span><br>
			        	<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
      						<span itemprop="streetAddress">P.za Castello, 17</span> - <span itemprop="postalCode">15020</span> <span itemprop="addressLocality">Solonghello</span> (AL, <span itemprop='addressRegion' content='Piemonte, Italy'</span>)<br>
			        	</span>
			        	<a href="http://www.odpm.it/" itemprop="url" style='color:#fff;'>www.odpm.it</a>
			        	- email: <a href="mailto:info@odpm.it" itemprop="email" style='color:#fff;'>info@odpm.it</a><br>
			        	<hr>
								<a href="//www.iubenda.com/privacy-policy/340274" class="iubenda-white iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
			        </div>
			    </div>
				<div class="mastfoot">
					<div class="inner">
						<p style='text-align:center;'>
							WebGIS with Wordpress, Bootstrap, Leaflet, OpenLayers, by
							<a href="https://plus.google.com/+PJHooker" rel="author">PJHooker</a>
							<a href="http://www.cityplanner.it" itemprop="url" rel="author">@CityPlannerIT</a>.
						</p>
					</div>
				</div>
			</div><!--/footer-inner-->
		</footer><!--/footer-->

	</div><!--/footer-wrap-->

</div><!--/wrap-->
<!--<div style='position:fixed;bottom: 20px;right: 20px;float:right;'><h2><a data-toggle='modal' data-target='#myModal' class="label label-info"><i class="fa fa-plus"></i></a></h2></div>-->
<?php
echo"
<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog' style='  width: 100%;max-width: 1040px; height: auto;'>
		<div class='modal-content'>
";
//modal header
echo"
			<div class='modal-header' style='text-align:center;'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<h4  style='text-align:center;' class='modal-title' id='myModalLabel'>Benvenuto!</h4>
			</div>
";
//modal body
?>
<style type="text/css">
	td {text-align:left;}
</style>
<?php
echo"
			<div class='modal-body' style='text-align:center;'>
			      <div class='row' style='padding-top:15px;'>
					<div class='col-sm-8'>
						<table class='table'>
							<thead>
							  <tr>
							    <th>
							    	<i class='fa fa-quote-left'></i>
							    	In questo pannello potrai accedere a delle funzioni veloci
							    </th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
							    <td>
							    	<i class='fa fa-rocket'></i>
							    	Se vuoi inserire le tue foto clicca <a href='http://www.monferratopaesaggi.org/?page_id=10380'>QUI</a>
							    </td>
							  </tr>
							  <tr>
							    <td>
							    	<i class='fa fa-rocket'></i>
							    	Per navigare nel Monferrato con una webApp alleggerita vai <a href='http://www.monferratopaesaggi.org/tutte-mappe-bootstrap'>QUI</a>
							    </td>
							  </tr>
							  <tr>
							    <td>
							    	<i class='fa fa-rocket'></i>
							    	Se vuoi un supporto tecnico <a href='mailto:lima.cityplanner@gmail.com'>scrivici pure</a>
							    </td>
							  </tr>
							</tbody>
						</table>
					</div>
";
?>
	<div class='col-sm-4'>
		<div class="well">
		<p>Se vuoi mandarci un messaggio<br />fallo pure qui.</p>
		<style type="text/css">.label{text-align:left;}</style>

					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php /*acf_form(array(
							'post_id'	=> 'new',
							'field_groups'	=> array( 11140 ),
							'html_after_fields' => '<input type="hidden" name="fields[field_54c2683d5ac91]" value="'.$passid.'"/>',
							'submit_value'	=> 'Lascia messaggio'
						)); */?>

					<?php endwhile; ?>

		</div>
	</div>
</div>
<?php
echo"
			</div>
";
//modal footer
echo"
			<div class='modal-footer'>
			</div>
";
//END modal
echo"
		</div>
	</div>
</div>
";
?>
<?php wp_footer(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/ie/respond.min.js"></script> <![endif]-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
</body>
</html>
