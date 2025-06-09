<h1>投稿の詳細</h1>

<img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
<p>メモ:{{ $post->memo }}</p>
<p>緯度:{{ $post->latitude }}</p>
<p>経度:{{ $post->longitude }}</p>

<a href="{{ route('posts.index') }}">投稿一覧ページに戻る</a>