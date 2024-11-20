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
        $news = FxNews::orderBy('updated_at', 'desc')->get();
        return response()->json($news);
    }

    // get news by id
    public function getNewsById($id)
    {
        $news = FxNews::find($id);
        return response()->json($news);
    }
}
