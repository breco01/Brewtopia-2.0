<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PublicProfileController extends Controller
{
    public function show(string $username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.public', compact('user'));
    }
}

