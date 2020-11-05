
    var map = L.map('map').setView([lat, lng], 16);

        //var map = L.map('map', { zoomControl:true }).fitBounds([[45.4592590398,9.18071839168],[45.4691821303,9.20070411012]]);
        

var googleLayer = new L.Google('HYBRID');
//map.addLayer(googleLayer);

var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
var feature_group = new L.featureGroup([]);

var raster_group = new L.LayerGroup([]);

var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
    attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
}); 
basemap_0.addTo(map); 

var layerOrder=new Array();

    function getImage(d) {
        return  d === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                d;           
    }

    function pop_reg(feature, layer) {
    
        // l'elenco delle colonne Ã¨ generato tramite un array di acf                            
        var popupContent = '<table style="width:300px;">'
                        + '<tr><td colspan="2"><img src="'
                        + getImage(feature.properties['picture'])
                        + '" style="width:100%;" /></td></tr>'
                        + '<tr><th scope="row">Nome</th><td>' 
                        + '<a href="'
                        + feature.properties['url_post'] 
                        + '">'
                        + feature.properties['titolo'] 
                        + '</a>'
                        + '</td></tr>'
                        + '<tr><th scope="row">Comune</th><td>' 
                        + feature.properties['comune'] 
                        + '</td></tr>'
                        + '<tr><th scope="row">Tipo</th><td>' 
                        + feature.properties['tipo'] 
                        + '</td></tr>'
                        + '</table>';
        layer.bindPopup(popupContent);

    }    

    function pop_linee(feature, layer) {
    
        // l'elenco delle colonne Ã¨ generato tramite un array di acf                            
        var popupContent = '<table style="width:300px;">'
                        + '<tr>' 
                        + '<a href="http://www.monferratopaesaggi.org/?page_id='
                        + feature.properties['idm'] 
                        + '">'
                        + getNomeP(feature.properties['idm'])
                        + '</a>'
                        + '</td></tr>'
                        + '</table>';
        layer.bindPopup(popupContent);

    }    

    function getColor(l) {
        return  l === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                l === 1997 ? '#cf9c2b'  :
                l === 1993 ? '#394d9d'  :
                l === 1989 ? '#ba2030'  :
                l === 1987 ? '#016a38'  :
                l === 1971 ? '#e06410'  :
                l === 1969 ? '#804195'  :
                'red';           
    }

    function getNomeP(n) {
        return  n === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                n === 1997 ? 'Percorso PROFILI | Scorci di paesaggio antico'  :
                n === 1993 ? 'Percorso PO | Vedute tra Alpi e terre d’acqua'  :
                n === 1989 ? 'Percorso MINIERE | Vigneti e antiche vie del cemento'  :
                n === 1987 ? 'Percorso BRIC | I borghi tra i boschi'  :
                n === 1971 ? 'Percorso CREA | Il Sacro Monte tra colline/crinali e campanili'  :
                n === 1969 ? 'Percorso VIGNE | Terre di vino e pietra da cantoni'  :
                'red';           
    }    

        var exp_linee = new L.geoJson(exp_linee,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 5,
                                color: getColor(feature.properties.idm),
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
                    }).addTo(map);       //var exp_regJSON

        //Tratte panoramiche pl_linee_pano_1
        var exp_linee1 = new L.geoJson(exp_pl_linee_pano_1,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON
    
        //Tratte locali pl_linee_pano_3
        var exp_linee3 = new L.geoJson(exp_pl_linee_pano_3,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON
        
        //Tratte locali (AUTO) pl_linee_pano_4
        var exp_linee4 = new L.geoJson(exp_pl_linee_pano_4,{
            onEachFeature: pop_linee,
                    style: function (feature) {
                        return {weight: 15,
                                color: "#5b5b5b",
                                opacity: 0.5,
                                fillOpacity: 0.5};
                        }
        }).addTo(map);       //var exp_regJSON


        var exp_regJSON = new L.geoJson(exp_poi,{
            onEachFeature: pop_reg,
            pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {
              icon: L.icon({
                iconUrl: feature.properties.imageurl,          
                iconSize:     [20, 24], // size of the icon change this to scale your icon (first coordinate is x, second y from the upper left corner of the icon)
                iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location (first coordinate is x, second y from the upper left corner of the icon)
                popupAnchor:  [0, -14] // point from which the popup should open relative to the iconAnchor (first coordinate is x, second y from the upper left corner of the icon)
              })  // L.icon
            })    // L.marker
          }       //pointToLayer: function
        });       //var exp_regJSON

        var cluster_groupexp_regJSON= new L.MarkerClusterGroup({showCoverageOnHover: false});
        cluster_groupexp_regJSON.addLayer(exp_regJSON);

        //add comment sign to hide this layer on the map in the initial view.
        cluster_groupexp_regJSON.addTo(map);
                    


        var baseMaps = {
            'Google Hybrid': googleLayer,
            'OSM Standard': basemap_0,
        };

        L.control.layers(baseMaps,{"GeoJson <a href='http://www.monferratopaesaggi.org/geodata/textfile.json' target='_blank'><i class='fa fa-download'></i></a>": cluster_groupexp_regJSON},{collapsed:false}).addTo(map);
