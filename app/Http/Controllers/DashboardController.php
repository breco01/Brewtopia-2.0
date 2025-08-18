<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beer;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        // Admins -> admin-dashboard
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Gebruiker + aantal reviews
        $user = Auth::user()->loadCount('reviews');

        // Laatste review (incl. bier)
        $lastReview = $user->reviews()
            ->latest()
            ->with('beer')
            ->first();

        // Gemiddelde score die de gebruiker gaf
        $avgGiven = round((float) ($user->reviews()->avg('rating') ?? 0), 1);

        // Bier van de dag (random)
        $beerOfTheDay = Beer::query()
            ->withCount('reviews')
            ->inRandomOrder()
            ->first();

        // Laatste nieuwsitems
        $latestNews = News::query()
            ->latest()
            ->limit(3)
            ->get();

        return view('dashboard', [
            'user'         => $user,
            'lastReview'   => $lastReview,
            'avgGiven'     => $avgGiven,
            'beerOfTheDay' => $beerOfTheDay,
            'latestNews'   => $latestNews,
        ]);
    }
}
