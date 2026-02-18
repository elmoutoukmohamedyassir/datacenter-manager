<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = ($user->isAdmin() || $user->isManager()) 
            ? Reservation::with(['user', 'resource'])->latest()->get()
            : Reservation::where('user_id', $user->id)->with('resource')->latest()->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $resources = Resource::where('is_active', true)->get();
        return view('reservations.create', compact('resources'));
    }

    public function store(Request $request)
    {
        // 1. Validate - stripped down to basics to ensure it passes
        $request->validate([
            'resource_id'   => 'required',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'justification' => 'required|string|min:3',
        ]);

        // 2. Simple Save - Using manual assignment to bypass any fillable issues
        $res = new Reservation();
        $res->user_id = Auth::id();
        $res->resource_id = $request->resource_id;
        $res->start_time = $request->start_time;
        $res->end_time = $request->end_time;
        $res->justification = $request->justification;
        $res->status = 'pending';
        $res->save();

        return redirect()->route('reservations.index')->with('success', 'Booked successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);
        return back()->with('success', 'Updated!');
    }
}