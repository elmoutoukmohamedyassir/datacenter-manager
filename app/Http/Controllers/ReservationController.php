<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations for the Manager.
     */
    public function index()
    {
        // Load reservations with User and Resource details
        $reservations = Reservation::with(['user', 'resource'])->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Store a new reservation request (The User's part).
     */
    public function store(Request $request)
    {
        // 1. Validation using your exact model names
        $request->validate([
            'resource_id'   => 'required|exists:resources,id',
            'start_time'    => 'required|date|after:now',
            'end_time'      => 'required|date|after:start_time',
            'justification' => 'required|string|min:5',
        ]);

        // 2. Flawless Check: Prevent double-booking for the same resource
        $overlap = Reservation::where('resource_id', $request->resource_id)
            ->where('status', 'approved')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($overlap) {
            return back()->with('error', 'This resource is already reserved for the selected time.');
        }

        // 3. Create the record
        Reservation::create([
            'user_id'       => Auth::id(),
            'resource_id'   => $request->resource_id,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'justification' => $request->justification,
            'status'        => 'pending', // Starts as pending for Role 3
        ]);

        return back()->with('success', 'Reservation request sent successfully!');
    }

    /**
     * Update the status (The Manager's part).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'     => 'required|in:approved,rejected',
            'admin_note' => 'required|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        
        $reservation->update([
            'status'     => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Reservation has been ' . $request->status . '.');
    }
}