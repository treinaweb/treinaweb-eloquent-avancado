<?php

namespace App\Http\Controllers\Site;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
                    ->whereHas('details', function($query) {
                        $query->where('status', 'publicado')
                              ->where('visibility', 'publico');
                    })
                    ->paginate(10);

        if (request()->query('categories')) {
            $posts->load('categories');
        }

        return view('news.index')->with([
            'posts' => $posts
        ]);
    }

    /**
     * Mostra um post único
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.single', [
            'post' => $post
        ]);
    }
}
