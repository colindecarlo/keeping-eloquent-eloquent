<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostMetricsEngagementController extends Controller
{
    public function index(Post $post)
    {
        $trend = $post->comments->weekOverWeekEngagement();







        return response()->json(['metrics' => $trend]);
    }
}
