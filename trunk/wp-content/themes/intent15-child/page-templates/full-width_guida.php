<?php
/*
Template Name: ITINIERARI GUIDA
*/
?>
<?php acf_form_head(); ?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<style>
.text h2 {
    font-size: 30px;
    line-height: 1.1em;
    text-transform: none;
    margin-top: 20px;
	margin-bottom: 10px;
}
.text h1 {
    font-size: 36px;
    line-height: 1.1em;
    margin-top: 20px;
	margin-bottom: 10px;
}
</style>
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
						<li><a href="?page_id=2251" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.it/?page_id=2251', 'Guida']);" class="active">Guida</a></li>
						<li><a href="?page_id=7533" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.it/?page_id=7533', 'Accessi']);">Accessi</a></li>
						<li><a href="?page_id=1951" onclick="_gaq.push(['_trackEvent', 'outbound-article-int', 'http://www.monferratopaesaggi.it/?page_id=1951', 'Mappa']);">Mappa</a></li>
					</ul>
					<div class="tab" id="tab-2" style="display: block;">
						<div class="tab-content">	

							<div class="row">
								<div class="col-md-8">
						
									<?php the_content(); ?>
<?php
/*
Cos'è monferratopaesaggi.it?

monferratopaesaggi.it è un "accompagnatore" virtuale proposto e realizzato dall’Osservatorio del Paesaggio per il Monferrato, 
cofinanziato dalla Compagnia di San Paolo e redatto con il contributo di Amministrazioni e Associazioni locali.
Come si usa?

Scarica QR code reader per poter accedere ai contenuti web e fatti accompagnare nella scoperta dei paesaggi del Monferrato.
Il territorio è ampio e molto vario, inoltre la fitta trama di percorsi e la dispersione dei centri storici e dei luoghi d’interesse, 
non facilitano visite d’insieme. Per questo motivo ti proponiamo 6 percorsi auto che coprono tutto il territorio collinare, con  i quali 
potrai esplorare aree paesisticamente diverse (per dominanti e caratteri ). La guida ti indicherà direzioni, tratti di maggior pregio, 
luoghi d’interesse e copre circa 30, 40 km. Ogni percorso richiede, con soste e visite puntuali, circa mezza giornata. In tutti i percorsi 
sono presenti molte e varie intersezioni e potrai incontrare anche percorsi a piedi offerti da altre associazioni.Nel loro insieme consentono 
molte combinazioni che permettono vari modi, tipi e tempi di percezione paesistica; ognuno poi, in esse, potrà selezionare stagioni e 
orari differenti, tempi e modi in grado di offrire percezioni di qualità differente.
*/
?>
								</div>
								<div class="col-md-4">
									<a href='http://www.monferratopaesaggi.it/?p=8515' target='_blank'>
										<img src="http://www.monferratopaesaggi.it/wp-content/uploads/20141230_Selezione_005.png" class="img-thumbnail" alt="368x368" 
											style="width: 368px; height: 377px;">
									</a>
								</div>
							</div>
							<div class="row" style="padding-top:100px;">
								<div class="col-md-8">
<?php
$testo2 = get_field('testo2');
echo $testo2;
/*
									<h1>In giro con Monferrato paesaggi</h1>
								    <h2>Una guida web che vi accompagna a scoprire la varietà del territorio collinare</h2>
						        	Il web è georeferenziato e consente di:
						        	<ul>
								        <li>essere utilizzato su computer, smartphone, tablet</li>
										<li>guidare tramite GPS l’utente</li>
										<li>vedere tutta la rete di percorsi esistenti nel territorio (auto, ciclo-pedonali, etc.)</li>
										<li>selezionare alle varie scale di ingrandimento percorsi, tratte, capoluoghi, punti di interesse</li>
										<li>fornire rapide descrizioni e immagini</li>
										<li>rimandare ai siti d’informazione esistenti, in particolare per l’accoglienza</li>
										<li>scaricare le mappe del territorio e del comune di Casale Monferrato</li>
										<li>accogliere commenti e nuove indicazioni da parte dei fruitori</li>
										<li>valutare indicativamente le diverse concentrazioni e i differenti gradimenti dei visitatori</li>
										<li>costruire nel tempo mappe sociali</li>
									</ul>
*/
?>
								</div>					        
								<div class="col-md-4">
									<div class="panel panel-default">
					            		<div class="panel-heading">
					              			<p class="panel-title">I numeri di Monferrato paesaggi</p>
					            		</div>
				            			<div class="panel-body">
<?php
$testo3 = get_field('testo3');
echo $testo3;
/*				            			
									        Riguarda 523 km2 di territorio
											Interessa 38 comuni
											Concerne 65.000 abitanti (con Casale M.)
											Comprende 7 comuni e un’area (Sacro Monte di Crea) riconoscimento Unesco
											Individua 6 percorsi paesistici per circa 335 km di cui&nbsp; 101 (33%) panoramici
											Suggerisce 31 percorsi nei borghi e luoghi storici
											Segnala oltre 500 punti di interesse, e 250 punti di veduta
											Evidenzia 12 percorsi d’accesso con interesse paesistico
											Accoglie 5 percorsi tematici
											Connette 29 percorsi ciclo-pedonali
											Rimanda ai siti d’informazione esistenti
*/
?>											
										</div>
									</div>							
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