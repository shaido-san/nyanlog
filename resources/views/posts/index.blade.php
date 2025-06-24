<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
    </head>
<body>
    <h1>投稿一覧</h1>
    
    <form method="GET" action="{{ route('posts.index') }}">
        <label for="category">カテゴリで絞る</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">全て</option>
            <option value="黒猫" {{ request('category') == '黒猫' ? 'selected' : '' }}>黒猫</option>
            <option value="白猫" {{ request('category') == '白猫' ? 'selected' : '' }}>白猫</option>
            <option value="三毛猫" {{ request('category') == '三毛猫' ? 'selected' : '' }}>三毛猫</option>
            <option value="キジトラ" {{ request('category') == 'キジトラ' ? 'selected' : '' }}>キジトラ</option>
            <option value="茶トラ" {{ request('category') == '茶トラ' ? 'selected' : '' }}>茶トラ</option>
            <option value="その他" {{ request('category') == 'その他' ? 'selected' : '' }}>その他</option>
        </select>
    </form>

    @foreach ($posts as $post )
        <div style="margin-bottom: 30px;">
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="画像" width="300">
            <p>メモ: {{ $post->memo }}</p>
            <p>猫ちゃんの種類: {{ $post->category }}</p>
            <p>緯度: {{ $post->latitude }}</p>
            <p>経度: {{ $post->longitude }}</p>
            <p>猫ちゃんに会った日時: {{ $post->spotted_at }}</p>
            <a href="{{ route('posts.show', ['id' => $post->id]) }}">投稿の詳細を見る</a>
            <hr>
        </div>
        <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">投稿を削除する</button>
    </form>
    @endforeach
    
</body>
</html>