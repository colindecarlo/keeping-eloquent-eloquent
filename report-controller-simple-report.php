<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostsByAuthorController extends Controller
{
    public function index()
    {
        $results = DB::table('users')
            ->select([
                'users.name',
                DB::raw('COUNT(disinct posts.id) as number_of_posts'),
                DB::raw('COUNT(comments.id) as total_comments')
            ])
            ->innerJoin('posts', 'users.id', '=', 'posts.author_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->groupBy('users.name')
            ->get();

        return response()->json(['report' => $results]);
    }
}
