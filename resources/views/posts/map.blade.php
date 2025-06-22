<div class="container">
    <h1>にゃんログマップ 🐾</h1>
    <div id="map" style="height: 600px;"></div>
</div>
<a href="{{ route('posts.map') }}">すべてのユーザーの投稿を表示</a>
<a href="{{ route('posts.map', ['filter' => 'mine']) }}">自分の投稿のみ表示</a>
<a href="{{ route('mypage') }}">マイページに戻る</a>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([35.6812, 139.7671], 12); // 東京駅を初期位置に

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        @foreach ($posts as $post)
           @if ($post->latitude && $post->longitude)
              L.marker([{{ $post->latitude }}, {{ $post->longitude }}])
                 .addTo(map).bindPopup(`
                <strong>{{ e($post->user?->name ?? '名無し') }}</strong><br>
                <img src="{{ asset('storage/' . $post->image_path) }}" width="100"><br>
                {{ e($post->memo ?? '') }}<br>
                {{ $post->category }}
                {{ $post->spotted_at ?? '' }}<br>
                <a href="{{ route('posts.show', ['id' => $post->id]) }}">この猫ちゃんの詳細を見る</a>
                `);
           @endif
        @endforeach
    });
</script>
