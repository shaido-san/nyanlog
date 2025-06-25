<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自分の投稿一覧</title>
</head>
<body>
    <h1>自分の投稿一覧</h1>

    @foreach ($posts as $post)
    <div style="margin-bottom: 30px;">
        <img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
        <p>メモ: {{ $post->memo }}</p>
        <p>猫の種類: {{ $post->category }}</p>
        <p>日時: {{ $post->spotted_at }}</p>
        <a href="{{ route('posts.show', ['id' => $post->id]) }}">詳細を見る</a>
        <a href="{{ route('posts.edit', ['id' => $post->id]) }}">編集する</a>
        <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？')">
            @csrf
            @method('DELETE')
            <button type="submit">削除する</button>
        </form>
    </div>
    @endforeach
</body>
</html>