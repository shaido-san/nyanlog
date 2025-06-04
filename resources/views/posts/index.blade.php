<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
    <h1>投稿一覧</h1>

    @foreach ($posts as $post )
        <div style="margin-bottom: 30px;">
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
            <p>{{ $post->memo }}</p>
            <p>緯度: {{ $post->latitude }}</p>
            <p>経度: {{ $post->longitude }}</p>
            <hr>
        </div>
    @endforeach
    
</body>
</html>