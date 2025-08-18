<?php

namespace App\Http\Controllers;

use App\Models\Beer;

class BeerController extends Controller
{
    public function index() {
        $beers = Beer::withCount('reviews')->get()->sortByDesc('reviews_count');
        return view('beers.index', compact('beers'));
    }

    public function show(Beer $beer) {
        $beer->load(['reviews.user']);
        $userReview = auth()->check()
            ? $beer->reviews()->where('user_id', auth()->id())->first()
            : null;

        $avg = $beer->averageRating();
        $count = $beer->reviewsCount();

        return view('beers.show', compact('beer', 'userReview', 'avg', 'count'));
    }
}
