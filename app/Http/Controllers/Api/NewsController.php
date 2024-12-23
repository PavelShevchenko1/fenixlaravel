<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    // get news
    public function getNews()
    {
        $news = FxNews::orderBy('updated_at', 'desc');
        $news = $news->where(function($query) {
            $query->whereNull('published')
              ->orWhere('published', '<=', now());
        });
        $news = $news->where('is_birthday', false)->get();
        
        $profile = Session::user();

        if (now()->format('m-d') == \Carbon\Carbon::parse($profile->birth_date)->format('m-d')) {
            $birthday_news = FxNews::where('is_birthday', true)->get();
            $news = $birthday_news->merge($news);
        }
        foreach ($news as &$new) {
            $new->description = mb_convert_encoding($new->description, 'UTF-8', 'auto');
            // $new->description = '' . $new->description;
            // $new->description = htmlentities($new->description);
        }

        return response()->json($news, 200, [], JSON_INVALID_UTF8_IGNORE);
    }

    // get news by id
    public function getNewsById($id)
    {
        $news = FxNews::find($id);
        return response()->json($news);
    }
}
