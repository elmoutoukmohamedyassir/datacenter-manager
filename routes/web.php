<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. GUEST LANDING PAGE
Route::get('/', function () {
    return redirect()->route('resources.index');
});

// 2. PUBLIC LIST (No ID wildcard here, so it's safe)
Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

// 3. PROTECTED ROUTES
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('resources.dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Only: Hardware Management
    Route::middleware(['role:admin'])->group(function () {
        // MOVE CREATE ABOVE THE SHOW ROUTE
        Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
        Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
        Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
        Route::put('/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
        Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    });

    // 4. THE WILDCARD "SHOW" ROUTE (Moved down here to prevent 404s)
    Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');

    // Tech/Admin Only: Toggle Status
    Route::patch('/resources/{id}/maintenance', [ResourceController::class, 'toggleMaintenance'])->name('resources.maintenance');

    // RESERVATIONS
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'updateStatus'])->name('reservations.update');

    // Notifications
    Route::get('/notifications', function () {
        $notifications = Auth::user()->notifications;
        Auth::user()->notifications()->where('is_read', false)->update(['is_read' => true]);
        return view('notifications.index', compact('notifications'));
    })->name('notifications.index');
});

require __DIR__ . '/auth.php';