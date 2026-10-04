<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    /**
     * Otorisasi Middleware via Constructor (Poin 3b Modul)
     */
    public function __construct()
    {
        $this->middleware('can:update,post')->only(['edit', 'update']);
    }

    /**
     * Menampilkan daftar semua postingan
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Menampilkan halaman edit postingan
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Mengubah data postingan dengan pengecekan Otorisasi (Poin 1b & 2d Modul)
     */
    public function update(Request $request, Post $post)
    {
        // Otorisasi menggunakan Gate (Poin 1b Modul)
        if (Gate::denies('edit-post', $post)) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit postingan ini.');
        }

        // Atau Otorisasi menggunakan Policy (Poin 2d Modul)
        // $this->authorize('update', $post);

        $post->update($request->all());

        return redirect()->back()->with('success', 'Postingan berhasil diperbarui!');
    }
}