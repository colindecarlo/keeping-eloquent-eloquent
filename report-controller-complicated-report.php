<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostsByAuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('users')
            ->select([
                'users.name',
                DB::raw('COUNT(disinct posts.id) as number_of_posts'),
                DB::raw('COUNT(comments.id) as total_comments')
            ])
            ->innerJoin('posts', 'users.id', '=', 'posts.author_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->groupBy('users.name');

        if ($request->input('only_active_authors')) {
            $query->where('users.last_login', '>=', Carbon::now()->subMonths(3));
        }

        if (!$request->input('include_draft_posts')) {
            $query->whereNotNull('posts.published_at');
        }

        if ($request->input('with_backlinks') !== null) {
            $query->leftJoin('backlinks', 'posts.id', '=', 'backlinks.post_id');
            if ($request->input('with_backlinks') {
                $query->whereNotNull('backlinks.id');
            } else {
                $query->whereNull('backlinks.id');
            }
        }

        if ($since = $request->input('posts_since')) {
            $query->where('posts.created_at', '>=', Carbon::parse($since));
        }

        $results = $query->get();

        return response()->json(['report' => $results]);
    }
}
