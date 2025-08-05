<h2>この猫ちゃんでいいですか？</h2>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="hidden" name="image_path" value="{{ $image_path }}">
    <input type="hidden" name="memo" value="{{ $memo }}">
    <input type="hidden" name="latitude" value="{{ $latitude }}">
    <input type="hidden" name="longitude" value="{{ $longitude }}">
    <input type="hidden" name="spotted_at" value="{{ $spotted_at }}">

    <div>
        <label for="category">猫ちゃんの種類(AI予測+自分で選択):</label>
        <select name="category" id="category" required>
            <option value="">-- 猫ちゃんの種類を選択してください --</option>
            @if ($suggested_category)
                <option value="{{ $suggested_category }}" selected>{{ $suggested_category }}(AIの予測)</option>
            @endif
            @foreach (['黒猫', '白猫', '三毛猫', 'キジトラ', '茶トラ', 'その他'] as $type)
                @if ($type !== $suggested_category)
                   <option value="{{ $type }}">{{ $type }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <h3>この猫ちゃんに見覚えはある？</h3>
    @if (!empty($candidates))
       @foreach ($candidates as $candidate)
        <label>
           <input type="radio" name="individual_id" value="{{ $candidate['individual_id'] }}" required>
           猫ちゃんID:{{ $candidate['individual_id'] }}(信頼度{{ $candidate['confidence'] }})
           <br>
           <img src="{{ asset('storage/' . $candidate['image_path']) }}" width="200"></imag>
        </label><br>
      @endforeach
    
    <label>
        <input type="radio" name="individual_id" value="new_{{ time() }}" required>
        新しい猫ちゃんで登録する
    </label><br>
    @else
      <p>似ている猫ちゃんは見つかりませんでした。新しい猫ちゃんとして登録する</p>
      <input type="hidden" name="individual_id" value="new_{{ time() }}" required>
    @endif

    <div>
        <label for="name">猫ちゃんの名前を決めてね(新規登録の場合)</label>
        <input type="text" name="name" id="name">
    </div>

    <button type="submit">投稿する</button>
</form>

<a href="{{ route('posts.create') }}">投稿フォームに戻る</a>