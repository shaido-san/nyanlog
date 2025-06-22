<h1>投稿の詳細</h1>

<img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
<p>メモ:{{ $post->memo }}</p>
<p>猫ちゃんの種類:{{ $post->category }}</p>
<p>緯度:{{ $post->latitude }}</p>
<p>経度:{{ $post->longitude }}</p>
<p>投稿日時:{{ $post->spotted_at }}</p>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<div id="map" style="height: 500px; margin-bottom:30px;"></div>
<script>
    var map = L.map('map').setView([{{ $post->latitude }}, {{ $post->longitude }}], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.marker([{{ $post->latitude }}, {{ $post->longitude }}]).addTo(map)
    .bindPopup("ここで猫ちゃんと遭遇したにゃ")
    .openPopup()
</script>

<a href="{{ route('posts.edit', ['id' => $post->id]) }}">内容を編集する</a>
<a href="{{ route('posts.index') }}">投稿一覧ページに戻る</a>
<a href="{{ route('mypage') }}">マイページに戻る</a>

