<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header('default_leafletjs');
$postid = get_the_ID();

?>
<?php get_template_part('_page-image'); ?>

<div id="page" class="fix">
	<div id="page-inner" class="container fix">

	<?php while(have_posts()): the_post(); ?>

			<div id="content">
				<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
					<div class="text">
						<div class="clear"></div>
						<div class="row">
			        <div class="col-sm-8">
								<?php
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'medium');
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
			                  </div>
			                </div>
			              </div>
			            </div>
						  	<?php
								?>
			        </div><!-- /.col-sm-4 -->
			        <div class="col-sm-4">
				        <div class="panel panel-default">
					        <div class="panel-heading">
					          <h3 class="panel-title"><?php the_title(); ?></h3>
					        </div>
					        <div class="panel-body">
										<p><?php the_content(); ?></p>
										<?php
											//echo $postid;
											$value=get_field('att_titolo_opera');if(!empty($value)){echo"Titolo alternativo: $value<br>";}
											$value=get_field('att_id_autore');//print_r($value);
											if(!empty($value)){echo"Autore: ".$value->post_title."<br>";}
											$value=get_field('att_immagine_esterna');if(!empty($value)){echo"Titolo alternativo: $value<br>";}
											$value=get_field('att_licenza');if(!empty($value)){echo"Licenza: $value<br>";}
											$value=get_field('att_tipo_opera');if(!empty($value)){echo"Tipo opera: $value<br>";}
											$value=get_field('att_fonte_opera');if(!empty($value)){
												echo"Fonte: <a href='$value'>link (".substr($value,6,20).")</a><br>";
												}
											//$value=get_field('att_stato_verifica');if(!empty($value)){echo"Titolo alternativo: $value<br>";}
											$value=get_field('att_map');if(!empty($value)){
												$lat=format_location($postid,lat);
												$lng=format_location($postid,lng);
											?>
												<div id='map' style="height:300px;"></div>
										    	<script type="text/javascript">
										    		var lon = <?php echo $lng; ?>,
										    		lat = <?php echo $lat; ?>
										    	</script>
										    	<script src='http://www.monferratopaesaggi.it/js/mappa_allegato_leaflet.js'></script>
										    	<script src='http://www.monferratopaesaggi.it/geodata/pl_linee_pano_0.js'></script>
										    	<script src='http://www.monferratopaesaggi.it/geodata/poi_monferrato.js'></script>
										    	<script src='http://www.monferratopaesaggi.it/geodata/poi_monferrato.js'></script>
											<?php
											}
											//the_meta();
										?>
					      	</div>
					    	</div>
			        </div><!-- /.col-sm-4 -->
			    </div>
				</div>
			</article>
		</div><!--/content-part-->

	<?php endwhile; ?>

	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>
