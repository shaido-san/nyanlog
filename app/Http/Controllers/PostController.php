<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $validated = $request->validate([
            'image' => 'required|image',
            'memo' => 'nullable|string',
            'category' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'spotted_at' => 'nullable|date',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Post::create([
            'user_id' => auth()->id(),
            'image_path' => $path,
            'memo' => $validated['memo'] ?? null,
            'category' => $validated['category'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'spotted_at' => $validated['spotted_at'] ?? now(),
        ]);

        return redirect()->route('posts.index')->with('message', '投稿完了だにゃん！');
    }

    public function index()
    {
        $posts = Post::latest()->get();
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
            'category' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'spotted_at' => 'nullable|date',
        ]);

        
        $post->update([
            'memo' => $validated['memo'] ?? $post->memo,
            'category' => $validated['category'],
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
}
