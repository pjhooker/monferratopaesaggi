var map;

var zoom = 19,
epsg4326 = new OpenLayers.Projection('EPSG:4326'),
epsg900913 = new OpenLayers.Projection('EPSG:900913');

var layer, markers;

var currentPopup;

// different popup types

    //style popup (FramedCloud vs Anchored)
        style_popup = OpenLayers.Class(OpenLayers.Popup.FramedCloud, {
            'autoSize': true,             'backgroundColor':'#000', 'opacity':0.5
        });
        
//----------------------------------------->
        function init(){
            var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326")
                
            };
            
            
            map = new OpenLayers.Map('map', option);
            olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );

            var gmap = new OpenLayers.Layer.Google("Google Satellite", {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 22});
/*
            var sundials = new OpenLayers.Layer.Vector("Punti di interesse (POI)", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: <?php echo'"'.$kml1.'"';?>,
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });

            var tracciati = new OpenLayers.Layer.Vector("Percorso", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: <?php echo'"'.$kml2.'"';?>,
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });
            */
// nuovo

var context = {
    getColor: function(feature) {
        return feature.attributes['colour'];
    },
    getImageURL: function(feature) {
        return feature.attributes['imageurl'];
    },
    getLabel: function(feature) {
        return feature.attributes['label'];
    }
};

var template = {
    externalGraphic: '${getImageURL}',
    pointRadius: 15,
    strokeWidth: 10,
    strokeColor: "${getColor}"
};

var template_single = {
    pointRadius: 25,
    strokeWidth: 2,
    strokeColor: '#FFF',
    fillColor: "#571419",
    fillOpacity: 0
};

var style = new OpenLayers.Style(template, { context: context });
var style_single = new OpenLayers.Style(template_single, { context: context });



            var layer = new OpenLayers.Layer.Vector("Tutti i POI", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/textfile.json",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer.styleMap = new OpenLayers.StyleMap(style);

            var single = new OpenLayers.Layer.Vector("POI Scheda", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/single_poi.json",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            single.styleMap = new OpenLayers.StyleMap(style_single);

       
            map.addLayers([olmapnik,gmap,layer,single]);
            map.setBaseLayer(gmap);
            map.setCenter(new OpenLayers.LonLat(lon, lat).transform(epsg4326, epsg900913), zoom);
//nuovo END

            map.addControl(new OpenLayers.Control.LayerSwitcher());
            //map.addLayers([olmapnik,gmap,sundials,tracciati]); //change
            //map.setBaseLayer(gmap);
            //**
            //select = new OpenLayers.Control.SelectFeature(sundials); 
            //sundials.events.on({
            //   "featureselected": onFeatureSelect,
            //   "featureunselected": onFeatureUnselect
            // });
            //map.addControl(select);
            //select.activate();   
            
                // Interaction; not needed for initial display.
                selectControl = new OpenLayers.Control.SelectFeature(layer);
                map.addControl(selectControl);
                selectControl.activate();
                layer.events.on({
                    'featureselected': onFeatureSelect,
                    'featureunselected': onFeatureUnselect
                });
            }

            
            
            /*
            //map.addControl(new OpenLayers.Control.Navigation());
            //map.addControl(new OpenLayers.Control.PanZoomBar());
            //map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
            //map.addControl(new OpenLayers.Control.Permalink());
            //map.addControl(new OpenLayers.Control.ScaleLine());
            //map.addControl(new OpenLayers.Control.MousePosition());
            //map.addControl(new OpenLayers.Control.OverviewMap());
            //map.addControl(new OpenLayers.Control.KeyboardDefaults());
            extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'), 
            new OpenLayers.Projection('EPSG:900913'));
            map.zoomToExtent(extent);
        }*/
//----------------------------------------->


            // Needed only for interaction, not for the display.
            function onPopupClose(evt) {
                // 'this' is the popup.
                var feature = this.feature;
                if (feature.layer) { // The feature is not destroyed
                    selectControl.unselect(feature);
                } else { // After "moveend" or "refresh" events on POIs layer all 
                         //     features have been destroyed by the Strategy.BBOX
                    this.destroy();
                }
            }
            function onFeatureSelect(evt) {
                feature = evt.feature;
                if (feature.attributes.picture == 'noimage') {
                var image = "";
                } else {
                var image = "<img src='" + feature.attributes.picture + "'' style='width:200;height:auto;' />";
                } 
                popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                         feature.geometry.getBounds().getCenterLonLat(),
                                         new OpenLayers.Size(100,100),
                                         "<a href='"+feature.attributes.url_post+"'><b>"+feature.attributes.titolo + "</b></a>" +
                                         "<br>" + image,
                                         null, true, onPopupClose);
                feature.popup = popup;
                popup.feature = feature;
                map.addPopup(popup, true);
            }
            function onFeatureUnselect(evt) {
                feature = evt.feature;
                if (feature.popup) {
                    popup.feature = null;
                    map.removePopup(feature.popup);
                    feature.popup.destroy();
                    feature.popup = null;
                }
            }
/*
function onPopupClose(evt) {
            select.unselectAll();
        }

function onFeatureSelect(event) {
            var feature = event.feature;
            var selectedFeature = feature;
            var popup = new OpenLayers.Popup.FramedCloud("chicken", 
                feature.geometry.getBounds().getCenterLonLat(),
                new OpenLayers.Size(100,100),
                "<h2>"+feature.attributes.name + "</h2>" 
                + feature.attributes.description,
                null, true, onPopupClose
            );
            feature.popup = popup;
            map.addPopup(popup);
        }

function onFeatureUnselect(event) {
            var feature = event.feature;
            if(feature.popup) {
                map.removePopup(feature.popup);
                feature.popup.destroy();
                delete feature.popup;
            }
        }*/
