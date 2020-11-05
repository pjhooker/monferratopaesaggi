var map, layer;
var zoom = 19,
epsg4326 = new OpenLayers.Projection('EPSG:4326'),
epsg900913 = new OpenLayers.Projection('EPSG:900913');

//----------------------------------------->
//ftp://4309746@aruba.it@ftp.monferratopaesaggi.org/www.monferratopaesaggi.org/geodata/pl_linee_percorso.geojson
        function init(){
            var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326")
                
            };
            map = new OpenLayers.Map('map', option);
            olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );

            var gmap = new OpenLayers.Layer.Google("Google Satellite", {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 22});
            
            /*
            var sundials = new OpenLayers.Layer.Vector("KML esempio con PopUp", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    // url: "http://192.81.215.55/experiment192/php/monferrato/pl_linee_percorso.kml",
                    url: "pl_linee_percorso.kml",
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });
			*/
/*
            var sundials1 = new OpenLayers.Layer.Vector("Percorsi CAI", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    //url: "http://192.81.215.55/experiment192/supply/kml/pl_percorsi_cai.kml",
                    url: "geodata/pl_percorsi_cai.kml",
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });
*/            
/*
            var sundials2 = new OpenLayers.Layer.Vector("Aree di interesse", { 
                projection: map.displayProjection,
                strategies: [new OpenLayers.Strategy.Fixed()],
                protocol: new OpenLayers.Protocol.HTTP({
                    //url: "http://192.81.215.55/experiment192/supply/kml/pl_percorsi_cai.kml",
                    url: "geodata/pl_linee_percorso_buff.kml",
                    format: new OpenLayers.Format.KML({
                        extractStyles: true,
                        extractAttributes: true
                    })
                })
            });
            */


// POI START
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


var style = new OpenLayers.Style(template, { context: context });

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
// POI STOP

// linee MINI START
var context2 = {
    getImageURL: function(feature) {
        return feature.attributes['ImageURL'];
    },
    getLabel: function(feature) {
        return feature.attributes['Label'];
    }
};

var template2 = {
    strokeWidth: 4,
    strokeColor: "#FF0000",
    strokeOpacity: 1        
};

var style2 = new OpenLayers.Style(template2, { context: context2 });



            var layerMini = new OpenLayers.Layer.Vector("Tratte locali", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_3.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layerMini.styleMap = new OpenLayers.StyleMap(style2);
// linee MINI STOP


// linee MINI START CAR
var context4 = {
    getImageURL: function(feature) {
        return feature.attributes['imageurl'];
    },
    getLabel: function(feature) {
        return feature.attributes['label'];
    }
};

var template4 = {
    strokeWidth: 4,
    strokeColor: "#575A53",
    strokeOpacity: 1        
};

var style4 = new OpenLayers.Style(template4, { context: context4 });



            var layer4 = new OpenLayers.Layer.Vector("Tratte locali (AUTO)", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_4.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer4.styleMap = new OpenLayers.StyleMap(style4);
// linee MINI STOP CAR

// linee buffer START
var context1 = {
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
        return feature.attributes['label'];
    }
};

var template1 = {
    //externalGraphic: '${getImageURL}',
    //pointRadius: 15,
    strokeWidth: 8,
    strokeColor: "${getColor}",
    strokeOpacity: 0.5        
};

var template1_single = {
    pointRadius: 25,
    strokeWidth: 2,
    strokeColor: '#FFF',
    fillColor: "#571419",
    fillOpacity: 0.5
};

var style1 = new OpenLayers.Style(template1, { context: context1 });
var style_single1 = new OpenLayers.Style(template1_single, { context: context1 });



            var layerBuff = new OpenLayers.Layer.Vector("Tratte panoramiche", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_1.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layerBuff.styleMap = new OpenLayers.StyleMap(style1);
// linee buffer STOP

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
        return feature.attributes['label'];
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


            map.addLayers([olmapnik,gmap,/*sundials,*//*sundials1,*//*sundials2,*/layer,layer3,layer4,layerBuff,layerMini]); //change
            map.setBaseLayer(olmapnik);
            //**
            
            /*select = new OpenLayers.Control.SelectFeature(sundials); 
            sundials.events.on({
                "featureselected": onFeatureSelect,
                "featureunselected": onFeatureUnselect
            });
            map.addControl(select);
            select.activate();  
            */ 
            //**
            map.addControl(new OpenLayers.Control.LayerSwitcher());
            //map.addControl(new OpenLayers.Control.Navigation());
            //map.addControl(new OpenLayers.Control.PanZoomBar());
            //map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
            //map.addControl(new OpenLayers.Control.Permalink());
            //map.addControl(new OpenLayers.Control.ScaleLine());
            //map.addControl(new OpenLayers.Control.MousePosition());
            //map.addControl(new OpenLayers.Control.OverviewMap());
            //map.addControl(new OpenLayers.Control.KeyboardDefaults());

            //extent = new OpenLayers.Bounds(<?php echo $bounds ?>).transform(new OpenLayers.Projection('EPSG:4326'), new OpenLayers.Projection('EPSG:900913'));
            
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
            var popup = new OpenLayers.Popup.Anchored("chicken", 
                feature.geometry.getBounds().getCenterLonLat(),
                new OpenLayers.Size(200,120),
                "<h2>"+feature.attributes.name + "</h2>" 
                + feature.attributes.description,
                null, true, onPopupClose
            );
            popup.setOpacity(1);
            popup.setBorder(1);
            //popup.setBorder(50);
            popup.backgroundColor = 'trasparent';
            //popup.imageSrc = 'http://www.monferratopaesaggi.org/wp-content/uploads/logo-monf340x80_pos-1024x215.png';
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
        }
        */

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