<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
