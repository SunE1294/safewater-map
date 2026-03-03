<!DOCTYPE html>
<html>
<head>
    <title>SafeWater Map - Live Demo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 100vh; width: 100%; }
        body { margin: 0; }
    </style>
</head>
<body>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Set view to Bangladesh coordinates
        var map = L.map('map').setView([23.6850, 90.3563], 7);

        // Add OpenStreetMap layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Convert Laravel data to JavaScript JSON
        var tubewells = @json($tubewells);

        // Loop through each data point and add to map
        tubewells.forEach(function(well) {
            var markerColor = well.status === 'safe' ? 'green' : (well.status === 'danger' ? 'red' : 'gray');

            L.circleMarker([well.lat, well.lng], {
                radius: 8,
                fillColor: markerColor,
                color: "#000",
                weight: 1,
                fillOpacity: 0.8
            }).addTo(map).bindPopup("<b>Area:</b> " + well.area_name + "<br><b>Status:</b> " + well.status);
        });
    </script>
</body>
</html>