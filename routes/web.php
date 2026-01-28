<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('reservations.index');
});

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboards/user', function () {
        return view('dashboards.user');
    })->name('dashboards.user');

    Route::get('/dashboards/manager', function () {
        return view('dashboards.manager');
    })->name('dashboards.manager');

    Route::get('/dashboards/admin', function () {
        return view('dashboards.admin');
    })->name('dashboards.admin');
});

// Resource Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/resources/browse', function () {
        return view('resources.browse');
    })->name('resources.browse');

    Route::get('/resources/create', function () {
        return view('resources.form');
    })->name('resources.create');

    Route::get('/resources/{id}/edit', function ($id) {
        return view('resources.form');
    })->name('resources.edit');

    Route::get('/resources/{id}', function ($id) {
        return view('resources.show');
    })->name('resources.show');
});

// Notification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', function () {
        return view('notifications.index');
    })->name('notifications.index');
});

// Reservation Routes
Route::middleware(['auth'])->group(function () {
    // User routes
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/history/all', [ReservationController::class, 'history'])->name('reservations.history');
    Route::post('/reservations/check-availability', [ReservationController::class, 'checkAvailability'])->name('reservations.check-availability');

    // Manager routes
    Route::get('/reservations/pending/list', [ReservationController::class, 'pending'])->name('reservations.pending');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

    // Incident Routes
    Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create');
    Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
    Route::get('/incidents/{incident}', [IncidentController::class, 'show'])->name('incidents.show');
});

