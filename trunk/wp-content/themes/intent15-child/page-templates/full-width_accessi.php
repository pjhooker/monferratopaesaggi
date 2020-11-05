<?php
/*
Template Name: ITINIERARI ACCESSI
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title" class="fix">
	<?php /*<div id="page-title-inner" class="container">
		<h1>echo wpb_page_title(); </h1>
	</div><!--/page-title-inner-->*/?>
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">
		<div id="content">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<ul class="tabs-nav fix">
						<li><a href="?page_id=2251" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.org/?page_id=2251', 'Guida']);">Guida</a></li>
						<li><a href="?page_id=7533" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.org/?page_id=7533', 'Accessi']);" class="active">Accessi</a></li>
						<li><a href="?page_id=1951" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.org/?page_id=1951', 'Mappa']);">Mappa</a></li>
					</ul>
					<div class="tab" id="tab-2" style="display: block;">
						<div class="tab-content">	

							<div class="row">
								<div class="col-md-8">
						
									<?php the_content(); ?>

								</div>
								<div class="col-md-4">
									<table class="table">
	        							<tbody>
											<tr>
												<td>
													<img class='img-thumbnail' alt="Immagine" src="http://www.monferratopaesaggi.org/wp-content/uploads/Immagine-300x206.jpg" 
													height="auto" width="100%">
												</td>
											</tr>
											<tr>
												<td>
													Dettaglio Regione Piemonte
												</td>
											</tr>											
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<table class="table">
	        							<tbody>
											<tr>
												<td>
													<a data-toggle='modal' data-target='#myModal2'>
													<img class='img-thumbnail' 
													alt="Accessi veloci" src="http://www.monferratopaesaggi.org/wp-content/uploads/Accessi-veloci-1024x484.jpg" 
													height="auto" width="100%">
													</a>
												</td>
											</tr>
											<tr>
												<td>
													Accessi autostradali e rete di collegamento veloce
												</td>
											</tr>											
										</tbody>
									</table>									
								</div>
								<div class="col-md-6">
									<table class="table">
	        							<tbody>
											<tr>
												<td>
													<a data-toggle='modal' data-target='#myModal'>
													<img class='img-thumbnail' alt="corridoitranseuropei" 
													src="http://www.monferratopaesaggi.org/wp-content/uploads/corridoitranseuropei1.jpg" 
													height="auto" width="100%">
													</a>
												</td>
											</tr>
											<tr>
												<td>
													da Il Periodico: 
													<a href='http://www.ilperiodico.it/roma/tunnel-del-brennero-avviata-a-innsbruck-fase-realizzativa/'>
													Tunnel del Brennero: avviata a Innsbruck fase realizzativa
													</a>
												</td>
											</tr>											
										</tbody>
									</table>								
								</div>
							</div>	

						</div>
					</div>
				</div>
			</article>
			
			<?php comments_template(); ?>
		</div>	
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php endwhile;?>

<?php get_footer(); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width: 800px;margin: 50px auto;'>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tunnel del Brennero: avviata a Innsbruck fase realizzativa</h4>
      </div>
      <div class="modal-body">
        <a href='http://www.monferratopaesaggi.org/wp-content/uploads/corridoitranseuropei1.jpg'>
        	<img src='http://www.monferratopaesaggi.org/wp-content/uploads/corridoitranseuropei1.jpg' width="100%" />
        </a>
      </div>
      <div class="modal-footer">
      	<a href='http://www.ilperiodico.it/roma/tunnel-del-brennero-avviata-a-innsbruck-fase-realizzativa/' class="btn btn-primary" >Apri articolo</a>
      	<a href='http://www.monferratopaesaggi.org/wp-content/uploads/corridoitranseuropei1.jpg' class="btn btn-primary" >Apri a tutto schermo</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='width: 800px;margin: 50px auto;'>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Accessi autostradali e rete di collegamento veloce </h4>
      </div>
      <div class="modal-body">
        <a href='http://www.monferratopaesaggi.org/wp-content/uploads/Accessi-veloci-1024x484.jpg'>
        	<img src='http://www.monferratopaesaggi.org/wp-content/uploads/Accessi-veloci-1024x484.jpg' width="100%" />
        </a>
      </div>
      <div class="modal-footer">
      	<a href='http://www.monferratopaesaggi.org/wp-content/uploads/Accessi-veloci-1024x484.jpg' class="btn btn-primary" >Apri a tutto schermo</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>