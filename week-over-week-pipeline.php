<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostMetricsEngagementController extends Controller
{
    public function index(Post $post)
    {
        $trend = $post->comments->groupBy(function ($comment) use ($post) {
            return $comment->created_at->diffInWeeks($post->published_at);
        })->flatMap(function ($group) {
            return $group->count();
        })->eachCons(2)->map(function ($pair) {
            return $pair->last() - $pair->first();
        })->toBase();

        return response()->json(['metrics' => $trend]);
    }
}
