<h1>投稿内容を編集</h1>

<form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}" >
    @csrf
    @method('PUT')

    <p>メモ: <input type="text" name="memo" value="{{ old('memo', $post->memo) }}"></p>
    <p>緯度: <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $post->latitude) }}"></p>
    <p>経度: <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $post->longitude) }}"></p>
    <p>投稿日時: <input type="datetime-local" name="spotted_at" value="{{ old('spotted_at', $post->spotted_at) }}"></p>
    <h2>出会ったところ</h2>
    <div id="map" style="height: 400px; margin-bottom: 20px;"></div>
    <button type="submit">更新する</button>
</form>
@include('components.map-script', [
    'latitude' => $post->latitude,
    'longitude' => $post->longitude,
    'mode' => 'edit',
])