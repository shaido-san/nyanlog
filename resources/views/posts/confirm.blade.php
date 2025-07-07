<h2>この猫ちゃんでいいですか？</h2>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="hidden" name="image_path" value="{{ $image_path }}">
    <input type="hidden" name="memo" value="{{ $memo }}">
    <input type="hidden" name="category" value="{{ $suggested_category }}">
    <input type="hidden" name="latitude" value="{{ $latitude }}">
    <input type="hidden" name="longitude" value="{{ $longitude }}">
    <input type="hidden" name="spotted_at" value="{{ $spotted_at }}">

    @foreach ($candidates as $candidate)
       <label>
           <input type="radio" name="individual_id" value="{{ $candidate['individual_id'] }}" required>
           猫ちゃんID:{{ $candidate['individual_id'] }}(信頼度{{ $candidate['confidence'] }})
       </label><br>
    @endforeach

    <button type="submit">この猫ちゃんと同じにして投稿する。</button>
</form>