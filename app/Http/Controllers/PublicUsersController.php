<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicUsersController extends Controller
{
    public function index()
    {
        // Toon enkel profielen met een username (publieke URL) – pas filter aan indien nodig
        $users = User::query()
            ->whereNotNull('username')
            ->orderBy('name')
            ->paginate(12);

        return view('users.index', compact('users'));
    }
}
