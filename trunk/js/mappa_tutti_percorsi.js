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

// linee CAI START
var context_cai = {
        getColor1 : function (feature){
            if(feature.attributes.name=="Percoso Mulini")
                return "#263466";     
            else if(feature.attributes.name=="Percorso Marchesi storico")
                return "#FF9990";   
            else if(feature.attributes.name=="Percorso Cemento")
                return "#DCD31F";  
            else if(feature.attributes.name=="percorso CAI")
                return "#960000";                                                                                                      
            else
                return "#56001B";
        } ,

        getImageURL: function(feature) {
            return feature.attributes['imageurl'];
        },
        getLabel: function(feature) {
            return feature.attributes['label'];
    }
};

var template_cai = {
    //externalGraphic: '${getImageURL}',
    //pointRadius: 15,
    strokeWidth: 2,
    strokeColor: "${getColor1}",
    strokeOpacity: 0.5,
    strokeLinecap: 'round',
    strokeDashstyle: 'dot'            
};

var style_cai = new OpenLayers.Style(template_cai, { context: context_cai });

            var layer_cai = new OpenLayers.Layer.Vector("Percosi CAI e piste ciclabili", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_percorsi_cai.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer_cai.styleMap = new OpenLayers.StyleMap(style_cai);
// linee CAI STOP

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

// linee dafuori START
var context_j2 = {

    getImageURL: function(feature) {
        return feature.attributes['imageurl'];
    },
    getLabel: function(feature) {
        return feature.attributes['label'];
    }
};

var template_j2 = {
    strokeWidth: 8,
    strokeColor: "#000",
    strokeOpacity: 0.2        
};

var style_j2 = new OpenLayers.Style(template_j2, { context: context_j2 });

            var layer_j2 = new OpenLayers.Layer.Vector("Per arrivare", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_2.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer_j2.styleMap = new OpenLayers.StyleMap(style_j2);
// linee dafuori STOP


// linee principali START
var context = {
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

var template = {
    //externalGraphic: '${getImageURL}',
    //pointRadius: 15,
    strokeWidth: 4,
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



            var layer = new OpenLayers.Layer.Vector("Percorsi principali", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "http://www.monferratopaesaggi.org/geodata/pl_linee_pano_0.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer.styleMap = new OpenLayers.StyleMap(style);
// linee principali STOP


            map.addLayers([olmapnik,gmap,layer,layer_j2,layerBuff,layer_cai]); //change
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
                popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                         feature.geometry.getBounds().getCenterLonLat(),
                                         new OpenLayers.Size(100,100),
                                         "<b><a href='http://www.monferratopaesaggi.org/?page_id="+feature.attributes.idm + "'>Apri percorso</a></b>",
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
