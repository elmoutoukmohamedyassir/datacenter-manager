<?php

namespace App\Http\Controllers;use App\Models\Reservation;
use App\Models\Resource;
use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
class ReservationController extends Controller{
    /**
     * Display a listing of the reservations (Manager View).
     */
    public function index()
    {
        // We use 'with' to get user and resource names to avoid errors in the view
        $reservations = Reservation::with(['user', 'resource'])->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create()
    {
        // This is the GET method the browser is looking for
        $resources = Resource::all();
        return view('reservations.create', compact('resources'));
    }

    /**
     * Store a newly created reservation in storage (User Action).
     */
    public function store(Request $request){
        $request->validate([
            'resource_id'   => 'required|exists:resources,id',
            'start_time'    => 'required|date|after:now',
            'end_time'      => 'required|date|after:start_time',
            'justification' => 'required|string|min:10',
        ]);

        Reservation::create(['user_id'       => Auth::id(),
            'resource_id'   => $request->resource_id,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'justification' => $request->justification,
            'status'        => 'pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation requested successfully!');
    }

    /**
     * Update the status of a reservation (Manager Action).
     */
        public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $reservation->update([
            'status'     => $request->status, 
            'admin_note' => $request->admin_note,
        ]);

        // --- ADD THIS PART FOR THE NOTIFICATION ---
        \App\Models\Notification::create([
            'user_id' => $reservation->user_id,
            'title'   => 'Reservation ' . ucfirst($request->status),
            'message' => "Your request for {$reservation->resource->name} has been {$request->status}." . 
                        ($request->admin_note ? " Note: " . $request->admin_note : ""),
        ]);
        // ------------------------------------------

        return back()->with('success', 'Reservation status updated and user notified!');
    }
}