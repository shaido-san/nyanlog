<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
{
    if ($request->has('image_path')) {
    $validated = $request->validate([
        'individual_id' => 'required|string',
        'image_path' => 'required|string',
        'memo' => 'nullable|string',
        'category' => 'required|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'spotted_at' => 'nullable|date',
    ]);

    $finalPath = str_replace('images/tmp/', 'images', $validated['image_path']);
    \Storage::disk('public')->move($validated['image_path'], $finalPath);
   
    Post::create([
        'user_id' => auth()->id(),
        'image_path' => $finalPath,
        'memo' => $validated['memo'],
        'category' => $validated['category'],
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
        'spotted_at' => $validated['spotted_at'] ?? now(),
        'individual_id' => $validated['individual_id'],
    ]);

    return redirect()->route('posts.index')->with('message', '投稿完了だにゃん！');
   }
}

    public function index(Request $request)
    {
        $query = Post::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $posts = $query->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != auth()->id()) {
            abort(403, '投稿や編集をする場合はログインしてください。');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != auth()->id()) {
            abort(403, '投稿や編集をする場合はログインしてください。');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != auth()->id()) {
            abort(403, '投稿や編集をする場合はログインしてください。');
        }
        
        $validated = $request->validate([
            'memo' => 'nullable|string|max:255',
            'category' => ['required', Rule::in(['黒猫', '白猫', '三毛猫', 'キジトラ', '茶トラ', 'その他'])],
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'spotted_at' => 'nullable|date',
        ]);

        
        $post->update([
            'memo' => $validated['memo'] ?? $post->memo,
            'category' => $validated['category'] ?? $post->category,
            'latitude' => $validated['latitude'] ?? $post->latitude,
            'longitude' => $validated['longitude'] ?? $post->longitude,
            'spotted_at' => $validated['spotted_at'] ?? $post->spotted_at,
        ]);

        return redirect()->route('posts.show', ['id' => $post->id])->with('success', '投稿内容が変更されました');
    }

    public function map(Request $request)
    {
       $query = Post::with('user');
       if ($request->get('filter') === 'mine') {
        $query->where('user_id', auth()->id());
       }
       $posts = $query->get();
        return view('posts.map', compact('posts'));
    }

    public function myposts()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('posts.myposts', compact('posts'));
    }

    public function identifyAndConfirm(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'memo' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'spotted_at' => 'nullable|date'
        ]);

        $image = $request->file('image');
        $path = $image->store('images/tmp', 'public');

        $response = Http::attach(
            'image',
            file_get_contents($image->getRealPath()),
            $image->getClientOriginalName()
        )->post('http://127.0.0.1:5000/identify');

        if (! $response->successful()) {
            return back()->withErrors(['api' => '識別APIに接続できませんでした'])->withInput();
        }

        $data = $response->json();

        return view('posts.confirm', [
            'image_path' => $path,
            'memo' => $validated['memo'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'spotted_at' => $validated['spotted_at'],
            'suggested_category' => $data['suggested_category'] ?? null,
            'candidates' => $data['match_candidates'] ?? []
        ]);
    }

}

