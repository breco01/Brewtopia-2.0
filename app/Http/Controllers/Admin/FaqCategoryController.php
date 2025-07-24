<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        return view('admin.faq_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FaqCategory::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.faq-categories.index')->with('success', 'Categorie aangemaakt.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq_categories.edit', [
            'category' => $faqCategory,
        ]);
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faqCategory->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.faq-categories.index')->with('success', 'Categorie bijgewerkt.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();
        return redirect()->route('admin.faq-categories.index')->with('success', 'Categorie verwijderd.');
    }
}
