<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\NewsManagementController;
use App\Http\Controllers\Admin\FaqManagementController;
use App\Http\Controllers\Admin\ContactFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard (user of admin)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profielbeheer (auth vereist)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-routes (alleen toegankelijk voor admins)
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Gebruikersbeheer via resource controller
    Route::resource('users', AdminUserController::class);

    // Andere adminmodules
    Route::get('/nieuws', [NewsManagementController::class, 'index'])->name('news.index');
    Route::get('/faq', [FaqManagementController::class, 'index'])->name('faq.index');
    Route::get('/contactformulieren', [ContactFormController::class, 'index'])->name('contact.index');

    Route::patch('/gebruikers/{user}/toggle-admin', [\App\Http\Controllers\Admin\UserManagementController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});

// Auth
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

// Publieke profielpagina's
Route::get('/profiel/{username}', [PublicProfileController::class, 'show'])->name('public.profile');

require __DIR__ . '/auth.php';
