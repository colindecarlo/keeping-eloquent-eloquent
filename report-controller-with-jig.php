<?php

namespace App\Http\Controllers;

use App\Reports\PostsByAuthorReport;
use App\Http\Controllers\Controller;

class PostsByAuthorController extends Controller
{
    public function index(Request $request)
    {
        $results = app(PostsByAuthorReport::class)
            ->filterActiveUsers($request->input('only_active_authors'))
            ->includeDrafts($request->input('include_draft_posts'))
            ->havingBacklinks($request->input('with_backlinks'))
            ->postedSince($request->input('posted_since'))
            ->get();

        return response()->json(['report' => $results]);
    }
}
