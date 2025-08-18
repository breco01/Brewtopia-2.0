<?php

use Illuminate\Support\Facades\Route;
use App\Models\FaqCategory;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\NewsManagementController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PublicUsersController; // ✅ toegevoegd

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

// Publieke gebruikerslijst (voor navbar "Gebruikers")
Route::get('/gebruikers', [PublicUsersController::class, 'index'])->name('users.public.index'); // ✅ toegevoegd

/*
|--------------------------------------------------------------------------
| Publieke Bieren
|--------------------------------------------------------------------------
|
| Lijst en detail van bieren (publiek zichtbaar)
|
*/
Route::get('/bieren', [BeerController::class, 'index'])->name('beers.public.index');
Route::get('/bieren/{beer}', [BeerController::class, 'show'])->name('beers.public.show');

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

    Route::post('/bieren/{beer}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/bieren/{beer}/reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

/*
|--------------------------------------------------------------------------
| Gebruikers Contactberichten (overzicht + detail)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('contact')->name('contact.')->group(function () {
    Route::get('/overzicht', [ContactController::class, 'overzicht'])->name('overzicht');
    Route::get('/bericht/{message}', [ContactController::class, 'toon'])->name('toon');
    Route::post('/bericht/{message}/markeer-gelezen', [ContactController::class, 'markeerAlsGelezen'])->name('gelezen');
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
    Route::resource('faq-categories', FaqCategoryController::class)->names('faq-categories');
    Route::resource('faqs', FaqController::class)->names('faqs');

    // Contactformulier-beheer
    Route::get('contactformulieren', [ContactFormController::class, 'index'])->name('contact.index');
    Route::get('contactformulieren/{message}', [ContactFormController::class, 'show'])->name('contact.show'); // ✅ toegevoegd
    Route::post('contactformulieren/{message}/reply', [ContactFormController::class, 'reply'])->name('contact.reply'); // ✅ toegevoegd
});

/*
|--------------------------------------------------------------------------
| Publieke Nieuwsweergave
|--------------------------------------------------------------------------
*/

Route::get('/nieuws', [NewsController::class, 'index'])->name('news.public.index');
Route::get('/nieuws/{news}', [NewsController::class, 'show'])->name('news.public.show');

/*
|--------------------------------------------------------------------------
| Publieke FAQ-weergave
|--------------------------------------------------------------------------
*/

Route::get('/faq', function () {
    $categories = FaqCategory::with('faqs')->get();
    return view('faq.index', compact('categories'));
})->name('faq.public.index');

/*
|--------------------------------------------------------------------------
| Publieke Contact-weergave
|--------------------------------------------------------------------------
*/

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Auth scaffolding (Laravel Breeze/Fortify)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
