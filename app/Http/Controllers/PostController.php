<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'memo' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Post::create([
            'image_path' => $path,
            'memo' => $validated['memo'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        return redirect('/posts/create')->with('message', '投稿完了だにゃん！');
    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }
}
