<h1>投稿内容を編集</h1>

<form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}" >
    @csrf
    @method('PUT')

    <p>メモ: <input type="text" name="memo" value="{{ old('memo', $post->memo) }}"></p>
    <p>緯度: <input type="text" name="latitude" value="{{ old('latitude', $post->latitude) }}"></p>
    <p>経度: <input type="text" name="longitude" value="{{ old('memo', $post->memo) }}"></p>
</form>