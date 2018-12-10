<?php

namespace App\Http\Controllers\Site;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $post->ratings()->create($request->all());

        return back()->with(['success' => 'Obrigado pela avaliação']);
    }
}
