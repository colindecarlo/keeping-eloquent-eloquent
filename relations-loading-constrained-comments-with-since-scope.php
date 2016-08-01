<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class PostRecentCommentsController extends Controller
{
    public function index($id)
    {
        $post = Post::with([
            'comments' => function ($query) {
                return $query->since(Carbon::yesterday());
            }
        ])->findOrFail($id);

        return response()->json(['comments' => $post->comments]);
    }
}
