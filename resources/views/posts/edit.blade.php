<h1>投稿内容を編集</h1>

<form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}" >
    @csrf
    @method('PUT')

    <p>メモ: <input type="text" name="memo" value="{{ old('memo', $post->memo) }}"></p>
    <p>猫ちゃんの種類:</p>
    <select name="category" required>
        <option value="">選んでください</option>
        <option value="黒猫" {{ old('category', $post->category) == '黒猫' ? 'selected' : '' }}>黒猫</option>
        <option value="白猫" {{ old('category', $post->category) == '白猫' ? 'selected' : '' }}>白猫</option>
        <option value="三毛猫" {{ old('category', $post->category) == '三毛猫' ? 'selected' : '' }}>三毛猫</option>
        <option value="キジトラ" {{ old('category', $post->category) == 'キジトラ' ? 'selected' : '' }}>キジトラ</option>
        <option value="茶トラ" {{ old('category', $post->category) == '茶トラ' ? 'selected' : '' }}>茶トラ</option>
        <option value="その他" {{ old('category', $post->category) == 'その他' ? 'selected' : '' }}>その他</option>
    </select>
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