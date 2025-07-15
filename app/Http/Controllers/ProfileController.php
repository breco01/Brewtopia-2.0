<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Algemene velden updaten
    $user->fill([
        'name'     => $request->input('name'),
        'email'    => $request->input('email'),
        'username' => $request->input('username'),
        'birthdate'=> $request->input('birthdate'),
        'about'    => $request->input('about'),
    ]);

    // Profielfoto uploaden
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');

        // Unieke bestandsnaam genereren
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Bestand opslaan in 'public/profile_pictures'
        $file->storeAs('public/profile_pictures', $filename);

        // Pad opslaan in database
        $user->profile_picture = 'profile_pictures/' . $filename;
    }

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
