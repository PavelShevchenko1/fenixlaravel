<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // get news
    public function getNews()
    {
        $news = FxNews::orderBy('created_at', 'desc')->get();
        return response()->json($news);
    }
}
