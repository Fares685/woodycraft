<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdresseController;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

// Accueil = liste des catégories
Route::get('/', [CategorieController::class, 'index'])->name('accueil');

Route::get('/', [AdresseController::class, 'index'])->name('accueil');

// Détail d’une catégorie = liste des puzzles
Route::get('/categories/{id}', [CategorieController::class, 'show'])
    ->whereNumber('id')
    ->name('categories.show');

/*
|--------------------------------------------------------------------------
| Dashboard / Espace authentifié
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [CategorieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD puzzles
    Route::resource('puzzles', PuzzleController::class);

    Route::resource('adresses', AdresseController::class);

    // CRUD catégories (admin) — on exclut index & show car publics ci-dessus
    Route::resource('categories', CategorieController::class);
});

require __DIR__.'/auth.php';
