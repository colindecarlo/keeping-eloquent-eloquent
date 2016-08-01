<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Controller;

class PostCommentsController extends Controller
{
    public function index($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return response()->json(['comments' => $post->comments]);
    }
}
