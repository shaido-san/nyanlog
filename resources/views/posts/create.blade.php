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
        <div>
            <label for="latitude">緯度:</label>
            <input type="text" name="latitude" id="latitude">
        </div>
        <div>
            <label for="longitude">経度:</label>
            <input type="text" name="longitude" id="longitude">
        </div>
        <button type="submit">投稿する</button>
    </form>
    <a href="{{ route('posts.index') }}">投稿一覧ページに戻る</a>
</body>
</html>