<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check of ingelogde gebruiker admin is
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Anders toon standaard gebruikersdashboard
        return view('dashboard');
    }
}
