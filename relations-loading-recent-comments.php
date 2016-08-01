<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Controller;

class PostRecentCommentsController extends Controller
{
    public function index($id)
    {
        $post = Post::with('recentComments')->findOrFail($id);
        return response()->json(['comments' => $post->recentComments]);
    }
}
