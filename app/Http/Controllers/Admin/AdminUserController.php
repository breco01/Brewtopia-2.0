<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    /**
     * Toon een overzicht van alle gebruikers.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        //Security logging
        Log::info('Admin viewed user list', [
            'event' => 'admin_user_index',
            'admin_id' => auth()->id(),
            'total_users' => $users->total(),
            'per_page' => $users->perPage(),
            'current_page' => $users->currentPage(),
        ]);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Toon het formulier om een nieuwe gebruiker aan te maken.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Sla een nieuwe gebruiker op.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        //Security logging
        Log::notice('Admin created user', [
            'event' => 'admin_user_created',
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker aangemaakt.');
    }

    /**
     * Toon het formulier om een gebruiker te bewerken.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update een gebruiker.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'is_admin' => 'boolean',
        ]);

        $original = $user->getOriginal();

        $user->update($validated);

        //Security logging
        Log::info('Admin updated user', [
            'event' => 'admin_user_updated',
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'email_before' => $original['email'] ?? null,
            'email_after' => $user->email,
            'username_before' => $original['username'] ?? null,
            'username_after' => $user->username,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker bijgewerkt.');
    }

    /**
     * Verwijder een gebruiker.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {

            //Security logging
            Log::warning('Admin attempted to delete own account', [
                'event' => 'admin_user_delete_blocked_self',
                'admin_id' => auth()->id(),
            ]);

            return redirect()->route('admin.users.index')->with('error', 'Je kan jezelf niet verwijderen.');
        }

        $deletedUserData = [
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
        ];

        $user->delete();

        //Security logging
        Log::notice('Admin deleted user', [
            'event' => 'admin_user_deleted',
            'admin_id' => auth()->id(),
            'user' => $deletedUserData,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker verwijderd.');
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id === auth()->id()) {

            //Security logging
            Log::warning('Admin attempted to change own admin rights', [
                'event' => 'admin_toggle_admin_blocked_self',
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
            ]);

            return back()->with('error', 'Je kan je eigen adminrechten niet wijzigen.');
        }

        if ($user->is_admin && User::where('is_admin', true)->count() === 1) {

            //Security logging
            Log::warning('Attempt to remove last remaining admin rights blocked', [
                'event' => 'admin_toggle_admin_blocked_last_admin',
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
            ]);

            return back()->with('error', 'Je kan de laatste admin niet uitschakelen.');
        }

        $oldValue = $user->is_admin;
        $user->is_admin = !$user->is_admin;
        $user->save();

        //Security logging
        Log::notice('Admin toggled admin rights for user', [
            'event' => 'admin_toggle_admin',
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'was_admin' => (bool) $oldValue,
            'is_admin' => (bool) $user->is_admin,
        ]);

        return back()->with('success', 'Adminrechten succesvol aangepast.');
    }


}
