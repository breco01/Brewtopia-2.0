<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\NewsManagementController;
use App\Http\Controllers\Admin\FaqManagementController;
use App\Http\Controllers\Admin\ContactFormController;

/*
|--------------------------------------------------------------------------
| Algemene routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('home'))->name('home');

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

// Publieke profielpagina
Route::get('/profiel/{username}', [PublicProfileController::class, 'show'])->name('public.profile');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Gebruikersdashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Profielbeheer
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Admin-dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Gebruikersbeheer
    Route::resource('users', AdminUserController::class);
    Route::patch('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggleAdmin');

    // Nieuwsbeheer
    Route::resource('news', NewsManagementController::class)->names('news');

    // FAQ-beheer
    Route::get('faq', [FaqManagementController::class, 'index'])->name('faq.index');

    // Contactformulier-beheer
    Route::get('contactformulieren', [ContactFormController::class, 'index'])->name('contact.index');
});

/*
|--------------------------------------------------------------------------
| Publieke Nieuwsweergave
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\NewsController;

Route::get('/nieuws', [NewsController::class, 'index'])->name('news.public.index');
Route::get('/nieuws/{news}', [NewsController::class, 'show'])->name('news.public.show');

/*
|--------------------------------------------------------------------------
| Auth scaffolding (Laravel Breeze/Fortify)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
