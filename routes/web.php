<?php

use App\Http\Controllers\FooterSettingsController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('AdminDashboard');
    })->name('admin.dashboard');

    Route::get('/leagues/create', [LeagueController::class, 'create'])->name('leagues.create');
    Route::post('/leagues', [LeagueController::class, 'store'])->name('leagues.store');
    Route::get('/leagues/{id}/edit', [LeagueController::class, 'edit'])->name('leagues.edit');
    Route::put('/leagues/{id}', [LeagueController::class, 'update'])->name('leagues.update');
    Route::delete('/leagues/{id}', [LeagueController::class, 'destroy'])->name('leagues.destroy');

    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{id}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{id}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');

    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{id}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{id}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{id}', [PlayerController::class, 'destroy'])->name('players.destroy');

    Route::get('/admin/footer', [FooterSettingsController::class, 'edit'])->name('admin.footer.edit');
    Route::put('/admin/footer', [FooterSettingsController::class, 'update'])->name('admin.footer.update');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
    Route::get('/forums/create', [ForumController::class, 'create'])->name('forums.create');
    Route::post('/forums', [ForumController::class, 'store'])->name('forums.store');
    Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forums.show');
    Route::patch('/forums/{forum}/toggle', [ForumController::class, 'toggle'])->name('forums.toggle');
    Route::delete('/forums/{forum}', [ForumController::class, 'destroy'])->name('forums.destroy');

    Route::get('/search', [SearchController::class, 'index'])->name('search.index');

    Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/{id}', [PlayerController::class, 'show'])->name('players.show');

    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('/leagues', [LeagueController::class, 'index'])->name('leagues.index');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/football', [HomeController::class, 'index'])->name('football.index');
Route::get('/contacto', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

require __DIR__.'/auth.php';
