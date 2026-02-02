<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 
redirect()->route('dashboard');
});

// Standard Dashboard for all logged-in users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role 2: Profile Management (Standard Laravel Auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// We keep 'resource' for Admins to create/edit, but allow GET for users to see them
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('resources', ResourceController::class);
});

// Role 3 & 4: The Reservation System
Route::middleware(['auth'])->group(function () {
    // Show form to create reservation
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    
    // Submit the reservation (Logic)
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    // List reservations for Manager/User
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    // Approve/Reject (Logic)
    Route::put('/reservations/{id}', [ReservationController::class, 'updateStatus'])->name('reservations.update');
});

require __DIR__ . '/auth.php';