<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Admins gaan naar het admin-dashboard
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Data voor het gebruikersdashboard
        $user = Auth::user()->loadCount('reviews');

        // Laatste review van de gebruiker (incl. bijhorend bier)
        $lastReview = $user->reviews()
            ->latest()
            ->with('beer')
            ->first();

        // Gemiddelde score die de gebruiker gegeven heeft
        $avgGiven = round((float) ($user->reviews()->avg('rating') ?? 0), 1);

        return view('dashboard', [
            'user'       => $user,
            'lastReview' => $lastReview,
            'avgGiven'   => $avgGiven,
        ]);
    }
}
