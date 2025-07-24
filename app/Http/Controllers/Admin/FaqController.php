<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('category')->orderBy('faq_category_id')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::all();
        return view('admin.faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_categories,id',
        ]);

        Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'faq_category_id' => $request->input('faq_category_id'),
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'Vraag toegevoegd.');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::all();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_categories,id',
        ]);

        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'faq_category_id' => $request->input('faq_category_id'),
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'Vraag bijgewerkt.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Vraag verwijderd.');
    }

    public function public()
    {
        $categories = \App\Models\FaqCategory::with('faqs')->get();
        return view('faq.public', compact('categories'));
    }
}
