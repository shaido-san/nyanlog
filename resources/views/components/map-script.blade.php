@props(['latitude' => 35.6812, 'longitude' => 139.7671, 'mode' => 'create'])

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var lat = {{ $latitude }};
        var lng = {{ $longitude }};
        var map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        var marker = L.marker([lat, lng], { draggable: true }).addTo(map);

        // map.on('click', ...) と dragend は、マーカーだけ動かす（inputは変更しない）
map.on('click', function (e) {
    marker.setLatLng(e.latlng);
});

marker.on('dragend', function (e) {
    // 入力フィールドは何も変更しない
});

// formのsubmit時にだけinputを更新
var form = document.querySelector('form');
if (form) {
    form.addEventListener('submit', function () {
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');
        var latlng = marker.getLatLng();
        if (latInput && lngInput) {
            latInput.value = latlng.lat;
            lngInput.value = latlng.lng;
        }
    });
}
});
</script>