<h1>投稿の詳細</h1>

<img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
<p>メモ:{{ $post->memo }}</p>
<p>緯度:{{ $post->latitude }}</p>
<p>経度:{{ $post->longitude }}</p>
<div id="map" style="height: 400px; margin-top: 20px"></div>

<a href="{{ route('posts.edit', ['id' => $post->id]) }}">内容を編集する</a>
<a href="{{ route('posts.index') }}">投稿一覧ページに戻る</a>