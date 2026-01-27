@extends('layouts.app')

@section('title', 'Reservation Details')

@section('content')
<div class="card">
    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
        <div class="card-header" style="margin: 0; padding: 0; border: none;">
            Reservation #{{ $reservation->id }}
        </div>
        <span class="badge badge-{{ $reservation->status }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
            {{ ucfirst($reservation->status) }}
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div>
            <h3 style="margin-bottom: 1rem; color: #495057;">Reservation Details</h3>

            <p style="margin-bottom: 0.75rem;">
                <strong>User:</strong> {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Email:</strong> {{ $reservation->user->email }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Start Date:</strong> {{ $reservation->start_date->format('F d, Y - H:i') }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>End Date:</strong> {{ $reservation->end_date->format('F d, Y - H:i') }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Duration:</strong> {{ $reservation->start_date->diffInDays($reservation->end_date) }} days
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Created:</strong> {{ $reservation->created_at->format('F d, Y - H:i') }}
            </p>

            @if($reservation->justification)
                <div style="margin-top: 1.5rem;">
                    <strong>Justification:</strong>
                    <p style="margin-top: 0.5rem; padding: 1rem; background-color: #f8f9fa; border-radius: 4px;">
                        {{ $reservation->justification }}
                    </p>
                </div>
            @endif
        </div>

        <div>
            <h3 style="margin-bottom: 1rem; color: #495057;">Resource Details</h3>

            <p style="margin-bottom: 0.75rem;">
                <strong>Name:</strong> {{ $reservation->resource->name }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Category:</strong> {{ $reservation->resource->category->name }}
            </p>

            @if($reservation->resource->cpu)
                <p style="margin-bottom: 0.75rem;">
                    <strong>CPU:</strong> {{ $reservation->resource->cpu }} cores
                </p>
            @endif

            @if($reservation->resource->ram)
                <p style="margin-bottom: 0.75rem;">
                    <strong>RAM:</strong> {{ $reservation->resource->ram }} GB
                </p>
            @endif

            @if($reservation->resource->storage)
                <p style="margin-bottom: 0.75rem;">
                    <strong>Storage:</strong> {{ $reservation->resource->storage }} GB
                </p>
            @endif

            @if($reservation->resource->os)
                <p style="margin-bottom: 0.75rem;">
                    <strong>Operating System:</strong> {{ $reservation->resource->os }}
                </p>
            @endif

            @if($reservation->resource->location)
                <p style="margin-bottom: 0.75rem;">
                    <strong>Location:</strong> {{ $reservation->resource->location }}
                </p>
            @endif
        </div>
    </div>

    @if(Auth::user()->isManager() && $reservation->status === 'pending')
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e9ecef;">
            <h3 style="margin-bottom: 1rem;">Manager Actions</h3>
            <form action="{{ route('reservations.update', $reservation) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="approve">
                <button type="submit" class="btn btn-success">Approve Reservation</button>
            </form>

            <form action="{{ route('reservations.update', $reservation) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="action" value="refuse">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to refuse this reservation?')">
                    Refuse Reservation
                </button>
            </form>
        </div>
    @endif

    <div style="margin-top: 2rem;">
        <a href="{{ Auth::user()->isManager() && $reservation->status === 'pending' ? route('reservations.pending') : route('reservations.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>
</div>
@endsection
