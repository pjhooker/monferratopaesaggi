var map = L.map('map', { zoomControl:true }).setView([lat,lon], 18);
//var map = L.map('map', { zoomControl:true }).setView([45.09422490056251,8.275603204965591], 10);
var googleLayer = new L.Google('HYBRID');
map.addLayer(googleLayer);

var additional_attrib = 'created w. <a href="https://github.com/geolicious/qgis2leaf" target ="_blank">qgis2leaf</a> by <a href="http://www.geolicious.de" target ="_blank">Geolicious</a> & contributors<br>';
var feature_group = new L.featureGroup([]);

var raster_group = new L.LayerGroup([]);

var basemap_0 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
    attribution: additional_attrib + '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
}); 
//basemap_0.addTo(map); 

var layerOrder=new Array();

    function getImage(d) {
        return  d === "noimage" ? "http://www.cityplanner.it/supply/icon_web/iconmonstr/iconmonstr-puzzle-3-icon.svg" :
                d;           
    }

    function pop_reg(feature, layer) {
    
        // l'elenco delle colonne è generato tramite un array di acf                            
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
    
        // l'elenco delle colonne è generato tramite un array di acf                            
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
    