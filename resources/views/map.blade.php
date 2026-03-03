<!DOCTYPE html>
<html>
<head>
    <title>Arsenic-Safe Bangladesh Map</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        #map { height: 100vh; width: 100%; }
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; }
        .form-popup { padding: 10px; }
        .form-popup input, .form-popup select { width: 100%; margin-bottom: 10px; padding: 5px; }
        .form-popup button { background: #28a745; color: white; border: none; padding: 8px; width: 100%; cursor: pointer; }
    </style>
</head>
<body>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // ১. ম্যাপ ইনিশিয়ালাইজ করা (বাংলাদেশ সেন্টার করে)
        var map = L.map('map').setView([23.6850, 90.3563], 7);

        // ২. ম্যাপের লেয়ার সেট করা (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // ৩. ডাটাবেস থেকে আসা ৫০০টি পিন ম্যাপে বসানো
        var tubewells = @json($tubewells);

        tubewells.forEach(function(well) {
            // স্ট্যাটাস অনুযায়ী পিনের রঙ ঠিক করা
            var color = well.status === 'safe' ? 'green' : (well.status === 'danger' ? 'red' : 'orange');
            
            L.circleMarker([well.lat, well.lng], {
                radius: 8,
                fillColor: color,
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            })
            .addTo(map)
            .bindPopup(`<b>Area:</b> ${well.area_name}<br><b>Status:</b> ${well.status}`);
        });

        // ৪. ম্যাপে ক্লিক করলে নতুন ডাটা সাবমিট করার ফর্ম আসা
        var popup = L.popup();

       function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent(`
            <div style="padding:10px; min-width:200px;">
                <h6>Report Tubewell</h6>
                <form action="/submit-well" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lat" value="${e.latlng.lat}">
                    <input type="hidden" name="lng" value="${e.latlng.lng}">
                    
                    <div class="mb-2">
                        <label class="small">Area Name</label>
                        <input type="text" name="area_name" class="form-control form-control-sm" required>
                    </div>
                    
                    <div class="mb-2">
                        <label class="small">Water Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="safe">Safe (Green)</option>
                            <option value="danger">Arsenic Danger (Red)</option>
                            <option value="untested">Untested (Gray)</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="small">Upload Photo</label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm w-100">Submit Data</button>
                </form>
            </div>
        `)
        .openOn(map);
}

        map.on('click', onMapClick);
    </script>

</body>
</html>