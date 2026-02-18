<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Resource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
{
    $user = Auth::user();
    
    // IF ADMIN/MANAGER: Get EVERY reservation in the system
    if ($user->isAdmin() || $user->isManager()) {
        $reservations = Reservation::with(['user', 'resource'])->latest()->get();
    } else {
        // IF USER: Only get THEIR reservations
        $reservations = Reservation::where('user_id', $user->id)->with('resource')->latest()->get();
    }

    return view('reservations.index', compact('reservations'));
}

    public function create()
    {
        $resources = Resource::where('is_active', true)->get();
        return view('reservations.create', compact('resources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resource_id'   => 'required|exists:resources,id',
            'start_time'    => 'required|date|after:now',
            'end_time'      => 'required|date|after:start_time',
            'justification' => 'required|string|min:10',
        ]);

        // AUTOMATIC CONFLICT CHECK (Requirement: Gestion des conflits)
        $overlap = Reservation::where('resource_id', $request->resource_id)
            ->whereIn('status', ['approved', 'active'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'Conflict Detected: This resource is already booked for this timeframe.');
        }

        Reservation::create([
            'user_id'       => Auth::id(),
            'resource_id'   => $request->resource_id,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'justification' => $request->justification,
            'status'        => 'pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation request submitted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $reservation->update([
            'status'     => $request->status, 
            'admin_note' => $request->admin_note,
        ]);

        // SEND NOTIFICATION
        Notification::create([
            'user_id' => $reservation->user_id,
            'title'   => 'Reservation ' . ucfirst($request->status),
            'message' => "Your request for {$reservation->resource->name} has been {$request->status}." . 
                         ($request->admin_note ? " Note: " . $request->admin_note : ""),
        ]);

        return back()->with('success', 'Status updated and user notified!');
    }
}