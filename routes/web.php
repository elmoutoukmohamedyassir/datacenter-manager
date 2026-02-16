<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Redirect home to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Standard Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    
    // 1. Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Resource - General Viewing
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    
    // 3. ADMIN ONLY ACTIONS (Must be ABOVE the {resource} detail route)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
        Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
        Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
        Route::put('/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
        Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    });

    // 4. Resource - Specific Details & Maintenance
    // (This must come after 'create' so 'create' isn't treated as an ID)
    Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');
    Route::patch('/resources/{id}/maintenance', [ResourceController::class, 'toggleMaintenance'])->name('resources.maintenance');

    // 5. The Reservation System
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'updateStatus'])->name('reservations.update');
});

require __DIR__ . '/auth.php';