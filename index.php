<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Carte Leaflet avec données d'API</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css" />

    <style>
        
        #map {
            height: 100vh;
            /* 100% de la page */
        }
    </style>
</head>

<body>
    <!-- formulaire de recherche -->
    <div class="test"></div>
    <form id="searchForm">
        <label for="userInput">Entrez une adresse au hasard</label>
        <input type="text" name="userInput" id="userInput" required>
        <input type="submit" value="Rechercher">
    </form>

    <!-- la carte leaflet -->
    <div id="map"></div>

    
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

    <script type="text/javascript">
        var macarte = null;
        var geojsonLayer = null;

        function initMap() {
            macarte = L.map('map').setView([46.603354, 1.888334], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte);

            // Ajoutez un écouteur d'événement sur le formulaire
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                // cela empeche le formulaire de se soumettre normalement
                event.preventDefault();

                // cela appel la fonction pour charger les données sur la carte
                loadMapData();
            });
        }

        function loadMapData() {
            // pour obtenir la valeur de l'input 'userInput'
            var userInput = document.getElementById('userInput').value;

            // construction de l'URL'
            var apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(userInput);

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // elle supprime le GeoJson si elle existe plusieurs fois
                    if (geojsonLayer) {
                        macarte.removeLayer(geojsonLayer);
                    }

                    // l'ajour d'une nouvelle couche GeoJson à la carte avec les données de l'API
                    geojsonLayer = L.geoJSON(data, {
                        pointToLayer: function(feature, latlng) {
                            return L.marker(latlng);
                        },
                        onEachFeature: function(feature, layer) {
                            var popupContent = `
                          <strong>Nom:</strong> ${feature.properties.name}<br>
                          <strong>Adresse:</strong> ${feature.properties.street}<br>
                          <strong>Ville:</strong> ${feature.properties.city}<br>
                          <strong>Code Postal:</strong> ${feature.properties.postcode}
                        `;
                            layer.bindPopup(popupContent);
                        }
                    }).addTo(macarte);
                })
                .catch(error => console.error('Erreur lors de la récupération des données de l\'API :', error));
        }

        window.onload = function() {
            initMap();
        };
    </script>
</body>

</html>