<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/games');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

// Catálogo de Jogos
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

// Reviews – somente usuários autenticados podem criar/editar/deletar
Route::middleware('auth')->group(function () {
    Route::post('/games/{game}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/games/{game}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/games/{game}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Área Admin
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/games', [AdminController::class, 'index'])->name('games.index');
    Route::get('/games/create', [AdminController::class, 'create'])->name('games.create');
    Route::post('/games', [AdminController::class, 'store'])->name('games.store');
    Route::get('/games/{game}/edit', [AdminController::class, 'edit'])->name('games.edit');
    Route::put('/admin/games/{game}', [AdminController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [AdminController::class, 'destroy'])->name('games.destroy');
});


require __DIR__.'/auth.php';
