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
                return $query->where('created_at', '>', Carbon::yesterday());
            }
        ])->findOrFail($id);

        return response()->json(['comments' => $post->comments]);
    }
}
