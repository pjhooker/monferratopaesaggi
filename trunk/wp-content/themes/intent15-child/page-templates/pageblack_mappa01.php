<?php
/*
Template Name: Mappa 01 >>
*/
?>
<?php get_header('leafletjs-full'); ?>



<?php while(have_posts()): the_post(); ?>

<?php
$postid = get_the_ID();
?>
<?php endwhile; ?>

<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->

<script>

	var map = L.map('map', { zoomControl:true }).setView([45.09304,8.28100], 12);
	var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
	var feature_group = new L.featureGroup([]);

	// MAPPE BASE

		var basemap_0 = L.tileLayer('http://a.tiles.mapbox.com/v4/runkeeper.4nc7syvi/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidHJpc3RlbiIsImEiOiJiUzBYOEJzIn0.VyXs9qNWgTfABLzSI3YcrQ', {
			attribution: additional_attrib + 'Map tiles by <a href="http://runkeeper.com/">runkeeper.com</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; <br>Map data: &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		});
		basemap_0.addTo(map);

		var basemap_1 = L.tileLayer('https://a.tiles.mapbox.com/v4/andreasviglakis.76e0cee7/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYW5kcmVhc3ZpZ2xha2lzIiwiYSI6IlVremRqN0kifQ.CFFJsLuWWyuhgsZTb51jWg', {
			attribution: additional_attrib + 'Map tiles by <a href="https://www.mapbox.com/">MapBox</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; <br>Map data: &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		});

		var googleLayer = new L.Google('HYBRID');
		//map.addLayer(googleLayer);


	// PERCORSI

		// PERCORSO 1997

			var percorso1997 = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.idm == 1997;}
				});
				percorso1997.addLayer(lineeGeoJson);
				//map.addLayer(percorso1997);
			});

			// PERCORSO 1993

				var percorso1993 = new L.featureGroup();
				$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
					var lineeGeoJson = L.geoJson(data, {
						style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
						filter: function(feature, layer) {return feature.properties.idm == 1993;}
					});
					percorso1993.addLayer(lineeGeoJson);
					//map.addLayer(percorso1993);
				});

			// PERCORSO 1989 10617

				var percorso1989 = new L.featureGroup();
				$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
					var lineeGeoJson = L.geoJson(data, {
						style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
						filter: function(feature, layer) {return feature.properties.idm == 1989;}
					});
					percorso1989.addLayer(lineeGeoJson);
					//map.addLayer(percorso1989);
				});

			// PERCORSO 1987

				var percorso1987 = new L.featureGroup();
				$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
					var lineeGeoJson = L.geoJson(data, {
						style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
						filter: function(feature, layer) {return feature.properties.idm == 1987;}
					});
					percorso1987.addLayer(lineeGeoJson);
					//map.addLayer(percorso1987);
				});

			// PERCORSO 1971

				var percorso1971 = new L.featureGroup();
				$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
					var lineeGeoJson = L.geoJson(data, {
						style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
						filter: function(feature, layer) {return feature.properties.idm == 1971;}
					});
					percorso1971.addLayer(lineeGeoJson);
					//map.addLayer(percorso1971);
				});

			// PERCORSO 1969

				var percorso1969 = new L.featureGroup();
				$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_0.geojson", function(data) {
					var lineeGeoJson = L.geoJson(data, {
						style: function (feature) {return {weight: 6,color: 'blue',opacity: 0.7};},
						filter: function(feature, layer) {return feature.properties.idm == 1969;}
					});
					percorso1969.addLayer(lineeGeoJson);
					//map.addLayer(percorso1969);
				});

	//TRATTE PANORAMICHE
		var t_panoramiche = new L.featureGroup();
		$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_linee_pano_1.geojson", function(data1) {
			var lineeGeoJson = L.geoJson(data1, {
				style: function (feature) {
					return {
						weight: 6,
						color: 'orange',
						opacity: 0.7
					};
				}
			});
			t_panoramiche.addLayer(lineeGeoJson);
			//map.addLayer(t_panoramiche);
		});

	// PERCORSI LOCALI
		var percorsi_locali = new L.featureGroup();
		$.getJSON("http://www.monferratopaesaggi.it/geodata/pl_linee_pano_3.geojson", function(data) {
			var lineeGeoJson = L.geoJson(data, {
				style: function (feature) {
					return {
						weight: 1,
						color: "red",
						opacity: 0.8,
						fillOpacity: 0.5
					};
				}
			});
			percorsi_locali.addLayer(lineeGeoJson);
	    //map.addLayer(percorsi_locali);
		});

	// PERCORSI AUTO
		var percorsi_auto = new L.featureGroup();
		$.getJSON("http://www.monferratopaesaggi.it/geodata/pl_linee_pano_4.geojson", function(data) {
			var lineeGeoJson = L.geoJson(data, {
				style: function (feature) {
					return {
						weight: 1,
						color: "red",
						opacity: 0.8,
						fillOpacity: 0.5
					};
				}
			});
			percorsi_auto.addLayer(lineeGeoJson);
	    //map.addLayer(linee4);
		});


	// PERCORSI EXTRA

		// CAI
			var lineeCAI = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.name == 'percorso CAI';}
				});
				lineeCAI.addLayer(lineeGeoJson);
		    //map.addLayer(lineeCAI);
			});

		// Marchesi
			var lineeMarchesi = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.name == 'Percorso Marchesi storico';}
				});
				lineeMarchesi.addLayer(lineeGeoJson);
		    //map.addLayer(lineeMarchesi);
			});

		// Ciclovia PO
			var lineeCPO = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.name == 'Ciclovia PO';}
				});
				lineeCPO.addLayer(lineeGeoJson);
		    //map.addLayer(lineeCPO);
			});

		// Percorso Cemento
			var lineeCemento = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.name == 'Percorso Cemento';}
				});
				lineeCemento.addLayer(lineeGeoJson);
		    //map.addLayer(lineeCemento);
			});

		// Percorso Mulini
			var lineeMulini = new L.featureGroup();
			$.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pl_percorsi_esistenti.geojson", function(data) {
				var lineeGeoJson = L.geoJson(data, {
					style: function (feature) {return {weight: 2,color: 'red',opacity: 0.7};},
					filter: function(feature, layer) {return feature.properties.name == 'Percoso Mulini';}
				});
				lineeMulini.addLayer(lineeGeoJson);
		    //map.addLayer(lineeMulini);
			});

  // geometria POI
		var poi = new L.featureGroup();
		$.getJSON("http://www.monferratopaesaggi.it/geodata/poi_monferrato.geojson", function(data) {
			var geojson = new L.geoJson(data,{
					pointToLayer: function (feature, latlng) {
					return L.marker(latlng)    // L.marker
				}       //pointToLayer: function
			});       //var exp_regJSON
			poi.addLayer(geojson);
			//map.addLayer(poi);
		});


  // geometria FONTANA
		var p_fontana = new L.featureGroup();
	  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_fontana.geojson", function(data) {
	    var geojson = new L.geoJson(data,{
	        pointToLayer: function (feature, latlng) {
	        return L.marker(latlng, {
	          icon: L.icon({
	            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/water-24@2x.png',
	            iconSize:     [20, 24],
	            iconAnchor:   [12, 12]
	          })  // L.icon
	        })    // L.marker
	      }       //pointToLayer: function
	    });       //var exp_regJSON
	    p_fontana.addLayer(geojson);
			//map.addLayer(p_fontana);
		});


  // geometria PARCHEGGI
		var p_parcheggi = new L.featureGroup();
	  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_parcheggi.geojson", function(data) {
	    var geojson = new L.geoJson(data,{
	        pointToLayer: function (feature, latlng) {
	        return L.marker(latlng, {
	          icon: L.icon({
	            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/parking-24@2x.png',
	            iconSize:     [20, 24],
	            iconAnchor:   [12, 12]
	          })  // L.icon
	        })    // L.marker
	      }       //pointToLayer: function
	    });       //var exp_regJSON
			p_parcheggi.addLayer(geojson);
			//map.addLayer(p_parcheggi);
	});
  // geometria PARCHEGGI -end

  // geometria WC
		var p_wc = new L.featureGroup();
	  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_wc.geojson", function(data) {
	    var geojson = new L.geoJson(data,{
	        pointToLayer: function (feature, latlng) {
	        return L.marker(latlng, {
	          icon: L.icon({
	            iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/toilets-24@2x.png',
	            iconSize:     [30, 30],
	            iconAnchor:   [15, 15]
	          })  // L.icon
	        })    // L.marker
	      }       //pointToLayer: function
	    });       //var exp_regJSON
	    p_wc.addLayer(geojson);
	    //map.addLayer(p_wc);
		});

	// geometria Comuni
		var p_comuni = new L.featureGroup();
	  $.getJSON("https://raw.githubusercontent.com/pjhooker/monferratopaesaggi/master/pt_comuni.geojson", function(data) {
	    var geojson = new L.geoJson(data,{
	        pointToLayer: function (feature, latlng) {
	        return L.marker(latlng)    // L.marker
	      },
				onEachFeature: function (feature, layer) {
					layer.bindPopup(feature.properties.title);
				}   //pointToLayer: function
	    });       //var exp_regJSON
	    p_comuni.addLayer(geojson);
	    map.addLayer(p_comuni);
		});


	var baseMaps = {
		'Google Hybrid': googleLayer,
		'OSM Summer': basemap_0,
		'OSM Winter': basemap_1
	};

	L.control.layers(baseMaps,{
		"Comuni": p_comuni,
		"<?php echo normalize_percorso(1997,'titolo_breve'); ?>":percorso1997,
		"<?php echo normalize_percorso(1993,'titolo_breve'); ?>":percorso1993,
		"<?php echo normalize_percorso(1989,'titolo_breve'); ?>":percorso1989,
		"<?php echo normalize_percorso(1987,'titolo_breve'); ?>":percorso1987,
		"<?php echo normalize_percorso(1971,'titolo_breve'); ?>":percorso1971,
		"<?php echo normalize_percorso(1969,'titolo_breve'); ?>":percorso1969,
		"Tratte panoramiche": t_panoramiche,
		"Percorsi locali": percorsi_locali,
		"Percorsi automobile": percorsi_auto,
		"Percorsi CAI": lineeCAI,
		"Percorso Marchesi storico": lineeMarchesi,
		"Ciclovia PO": lineeCPO,
		"Percorso Cemento": lineeCemento,
		"Percorso Mulini": lineeMulini,
		"Punti di interesse": poi,
		"Fontane": p_fontana,
		"Parcheggi": p_parcheggi,
		"WC": p_wc
	},{collapsed:false}).addTo(map);

	L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);

</script>

<?php get_footer('leafletjs-full'); ?>
