<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class UpdateLastLoginAt
{
    public function handle(): void
    {
        $user = Auth::user();

        if ($user) {
            $user->last_login_at = now();
            $user->save();
        }
    }
}
