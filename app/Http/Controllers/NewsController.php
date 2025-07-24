<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $articles = News::orderBy('created_at', 'desc')->paginate(6);
        return view('news.index', compact('articles'));
    }

    public function show(News $news)
    {
        return view('news.show', ['article' => $news]);
    }
}