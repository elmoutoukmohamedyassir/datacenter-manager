<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('resources', ResourceController::class);
});

require __DIR__ . '/auth.php';




use App\Http\Controllers\ReservationController;

// Grouping these under 'auth' ensures only logged-in users can access them
Route::middleware(['auth'])->group(function () {
    
    // Page to see all reservations (Manager View)
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Action to submit a new reservation (User Action)
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    // Action to approve/reject a reservation (Manager Action)
    Route::put('/reservations/{id}', [ReservationController::class, 'updateStatus'])->name('reservations.update');
    
});