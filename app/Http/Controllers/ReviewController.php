<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Beer $beer) {
        $data = $request->validate([
            'rating'  => ['required','numeric','min:0','max:5'],
            'comment' => ['nullable','string','max:2000'],
        ]);

        Review::updateOrCreate(
            ['user_id' => $request->user()->id, 'beer_id' => $beer->id],
            $data
        );

        return back()->with('success', 'Bedankt voor je review!');
    }

    public function destroy(Beer $beer) {
        $review = Review::where('beer_id', $beer->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Je review is verwijderd.');
    }
}
