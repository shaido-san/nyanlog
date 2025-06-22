<!DOCTYPE html>
<html>
<head>
    <title>にゃんログ投稿フォーム</title>
</head>
<body>
    <h1>投稿フォーム</h1>
    @if (session('message'))
    <p style="color: green">{{ session('message') }}</p>
    @endif
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">画像:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <div>
            <label for="memo">メモ:</label>
            <textarea name="memo" id="memo"></textarea>
        </div>
        <p>猫ちゃんの種類</p>
            <select name="category" required>
                <option value="">この中から選んでください</option>
                <option value="黒猫">黒猫</option>
                <option value="白猫">白猫</option>
                <option value="三毛猫">三毛猫</option>
                <option value="キジトラ">キジトラ</option>
                <option value="茶トラ">茶トラ</option>
                <option value="その他">その他</option>
            </select>
        <div>
            <label for="latitude">緯度:</label>
            <input type="text" name="latitude" id="latitude" readonly style="background-color: #f0f0f0;">
        </div>
        <div>
            <label for="longitude">経度:</label>
            <input type="text" name="longitude" id="longitude" readonly style="background-color: #f0f0f0;">
        </div>
        <label for="spotted_at">猫ちゃんと遭遇した日時:</label>
        <input type="datetime-local" name="spotted_at" id="spotted_at">
        <div style="margin-top: 20px;">
            <h3>地図で猫ちゃんの位置を決めてね！緯度と経度は位置を決めれば自動で決まるよ！</h3>
            <div id="map" style="height: 400px;"></div>
        </div>
        <button type="submit">投稿する</button>
    </form>
    <a href="{{ route('posts.index') }}">投稿一覧ページに戻る</a>
</body>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([35.6812, 139.7671], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
        maxZoom: 18,
    }).addTo(map);

    var marker;

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) map.removeLayer(marker);

        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });
</script>
</html>