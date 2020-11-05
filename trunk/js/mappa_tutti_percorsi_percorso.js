//----------------------------------------->
        function init(){
            var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326"),
                scales: [50000000, 30000000, 10000000, 5000000],
                    resolutions: [1.40625,0.703125,0.3515625,0.17578125,0.087890625,0.0439453125],
                    minScale: 50000000,
                    maxResolution: "auto",
                    maxExtent: new OpenLayers.Bounds(-180, -90, 180, 90),
                    maxResolution: 0.17578125,
                    maxScale: 10000000,
                    minResolution: "auto",
                    minExtent: new OpenLayers.Bounds(-1, -1, 1, 1),
                    minResolution: 0.0439453125,
                    numZoomLevels: 5,
                    units: "degrees"                
            };
            map = new OpenLayers.Map('map', option);
            olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );

            var gmap = new OpenLayers.Layer.Google("Google Satellite", {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 22});

            var sundials2 = new OpenLayers.Layer.Vector("KML esempio con PopUp", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pt_punti_esagoni.kml",
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });

// layer JOSM
var context = {
    getColor: function(feature) {
        return feature.attributes['Colour'];
    },
    getImageURL: function(feature) {
        return feature.attributes['imageurl'];
    },
    getLabel: function(feature) {
        return feature.attributes['Label'];
    }
};

var template = {
    externalGraphic: '${getImageURL}',
    pointRadius: 15,
    strokeWidth: 10,
    strokeColor: "${getColor}"
};

var style = new OpenLayers.Style(template, { context: context });

            var layer = new OpenLayers.Layer.Vector("GeoJSON", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/textfile.json",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer.styleMap = new OpenLayers.StyleMap(style);

            var sundials = new OpenLayers.Layer.Vector("Punti di interesse (POI)", { 
                projection: map.displayProjection,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    //url: "pt_punti_percorso.kml",
                    url: "http://www.monferratopaesaggi.org/pt_punti_wp_percorso.kml",
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });

// linee principali START
var context3 = {
    /*getColor: function(feature) {
        return feature.attributes['Colour'];
    },*/
        getColor : function (ft){
            if(ft.attributes.idm=="1997")
                return color1997;
            else if(ft.attributes.idm=="1993")
                return color1993;
            else if(ft.attributes.idm=="1989")
                return color1989;
            else if(ft.attributes.idm=="1987")
                return color1987;
            else if(ft.attributes.idm=="1971")
                return color1971;
            else if(ft.attributes.idm=="1969")
                return color1969;                                                            
            else
                return "#FF0000";
        } ,

    getImageURL: function(feature) {
        return feature.attributes['imageurl'];
    },
    getLabel: function(feature) {
        return feature.attributes['Label'];
    }
};

var template3 = {
    //externalGraphic: '${getImageURL}',
    //pointRadius: 15,
    strokeWidth: 4,
    strokeColor: "${getColor}"
};

var style3 = new OpenLayers.Style(template3, { context: context3 });



            var layer3 = new OpenLayers.Layer.Vector("Percorsi principali", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_0.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer3.styleMap = new OpenLayers.StyleMap(style3);
// linee principali STOP
layer.setVisibility(false);
sundials2.setVisibility(false);
sundials.setVisibility(false);

            map.addLayers([olmapnik,gmap,/*tracciati,*/layer3,sundials2,layer]); //change
            map.setBaseLayer(olmapnik);

map.events.register('zoomend', this, function (event) {
        var zLevel = map.getZoom();     

        if( zLevel == 11 || zLevel == 12 || zLevel == 13 )
        {
            sundials2.setVisibility(true);
            layer.setVisibility(false);
            
        }
        if( zLevel == 14 || zLevel == 15 || zLevel == 16)
        {
            sundials2.setVisibility(false);
            layer.setVisibility(true);
        }
        if( zLevel < 10)
        {
            sundials2.setVisibility(false);
            layer.setVisibility(false);
        }

    });

            /*
            select = new OpenLayers.Control.SelectFeature(sundials); 
            sundials.events.on({
                "featureselected": onFeatureSelect,
                "featureunselected": onFeatureUnselect
            });
            map.addControl(select);
            select.activate();   
            */
            map.addControl(new OpenLayers.Control.LayerSwitcher());
            //map.addControl(new OpenLayers.Control.Navigation());
            //map.addControl(new OpenLayers.Control.PanZoomBar());
            //map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
            //map.addControl(new OpenLayers.Control.Permalink());
            //map.addControl(new OpenLayers.Control.ScaleLine());
            //map.addControl(new OpenLayers.Control.MousePosition());
            //map.addControl(new OpenLayers.Control.OverviewMap());
            //map.addControl(new OpenLayers.Control.KeyboardDefaults());
            //extent = new OpenLayers.Bounds(mybounds).transform(new OpenLayers.Projection('EPSG:4326'), 
            //new OpenLayers.Projection('EPSG:900913'));
            map.zoomToExtent(extent);
            
            // Interaction; not needed for initial display.
                selectControl = new OpenLayers.Control.SelectFeature(layer);
                map.addControl(selectControl);
                selectControl.activate();
                layer.events.on({
                    'featureselected': onFeatureSelect,
                    'featureunselected': onFeatureUnselect
                });
            
        }
//----------------------------------------->
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
                var image = "<img src='" + feature.attributes.picture + "' style='width=200;height:auto;' />";
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
