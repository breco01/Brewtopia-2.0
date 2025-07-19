<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsManagementController extends Controller
{
    public function index()
    {
        $articles = News::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/news', $filename);
            $validated['image'] = $filename;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Artikel toegevoegd.');
    }


    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/news', $filename);
            $validated['image'] = $filename;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Artikel bijgewerkt.');
    }

}
