<?php

namespace App\Http\Controllers;

use App\Reports\PostsByAuthorReport;
use App\Http\Controllers\Controller;

class PostsByAuthorController extends Controller
{
    public function index()
    {
        $results = app(PostsByAuthorReport::class)->get();
        return response()->json(['report' => $results]);
    }
}
