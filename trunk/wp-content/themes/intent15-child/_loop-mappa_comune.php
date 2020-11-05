
<?php while(have_posts()): the_post(); ?>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="table-responsive">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>

            

<?php
$location = get_field('map',$id); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng
?>
	<script src='http://www.monferratopaesaggi.it/geodata/pl_linee_pano_0.js'></script>
	<script src='http://www.monferratopaesaggi.it/geodata/pl_linee_pano_1.js'></script>
	<script src='http://www.monferratopaesaggi.it/geodata/pl_linee_pano_3.js'></script>
	<script src='http://www.monferratopaesaggi.it/geodata/pl_linee_pano_4.js'></script>
	<script src='http://www.monferratopaesaggi.it/geodata/poi_monferrato.js'></script>
	<script>
		var lat = <?php echo $lat ?>;
		var lng = <?php echo $lng ?>;
	</script>
	<script src="http://www.monferratopaesaggi.it/js/mappa_comune_leaflet.js"></script>
<?php endwhile;?>