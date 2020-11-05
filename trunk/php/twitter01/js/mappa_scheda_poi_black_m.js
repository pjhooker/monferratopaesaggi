var map;

var zoom = 11,
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
                    url: "geodata/last_tweet_m.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            layer.styleMap = new OpenLayers.StyleMap(style);

            var single = new OpenLayers.Layer.Vector("POI Scheda", {
                projection: epsg4326,
                //strategies: [new OpenLayers.Strategy.Fixed()],
                strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
                protocol: new OpenLayers.Protocol.HTTP({
                    url: "geodata/last_tweet_m.geojson",
                    format: new OpenLayers.Format.GeoJSON()
                })
            });
            single.styleMap = new OpenLayers.StyleMap(style_single);

       
            map.addLayers([olmapnik,layer]);
            map.setBaseLayer(olmapnik);
            map.setCenter(new OpenLayers.LonLat(lon, lat).transform(epsg4326, epsg900913), zoom);


            map.addControl(new OpenLayers.Control.LayerSwitcher());
            
                // Interaction; not needed for initial display.
                selectControl = new OpenLayers.Control.SelectFeature(layer);
                map.addControl(selectControl);
                selectControl.activate();
                layer.events.on({
                    'featureselected': onFeatureSelect,
                    'featureunselected': onFeatureUnselect
                });
            }

        

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
                var image = "<img src='" + feature.attributes.picture + " style='width=200;height:auto;' />";
                } 
                popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                         feature.geometry.getBounds().getCenterLonLat(),
                                         new OpenLayers.Size(100,100),
                                         "<a href='"+feature.attributes.url_post+"'><b>"+feature.attributes.titolo + "</b></a>"
                                         //+ "<br>" + image
                                         ,
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

