var map = L.map('map', { zoomControl:true }).setView([lat,lon], 18);

var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
var feature_group = new L.featureGroup([]);

var raster_group = new L.LayerGroup([]);

var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
});
basemap_0.addTo(map);

var layerOrder=new Array();


  var circle = L.circle([lat, lon], 30, {
      color: 'red',
      fillColor: 'white',
      fillOpacity: 0.2
  }).addTo(map);

  var baseMaps = {
    'OSM Standard': basemap_0,
  };

  L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);
