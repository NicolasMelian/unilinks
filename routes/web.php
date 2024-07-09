<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\LandingController;


Route::middleware(['auth'])->group(function () {
    Route::get('/appearance', [AppearanceController::class, 'index'])->name('appearance.index');
    Route::post('/appearances', [AppearanceController::class, 'store']);
    Route::post('/appearances/{appearance}', [AppearanceController::class, 'update']);
});


Route::middleware(['auth'])->group(function () {
    Route::post('/links', [LinkController::class, 'store']);

    Route::patch('/links/{link}', [LinkController::class, 'update']);
    Route::post('/links/{link}', [LinkController::class, 'update']);
    Route::delete('/links/{link}', [LinkController::class, 'destroy']);
    Route::get('/links', [LinkController::class, 'index']);
});
Route::get('/', function () {
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/{slug}', [LandingController::class, 'show'])->name('landing.show');


