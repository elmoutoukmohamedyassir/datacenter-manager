@extends('layouts.app')

@section('title', 'My Reservation History')

@section('content')
<div class="card">
    <div class="card-header">My Reservation History</div>

    @if($reservations->count() > 0)
        <div style="margin-bottom: 1rem;">
            <div class="flex gap-2">
                <span class="badge badge-pending">Pending: {{ $reservations->where('status', 'pending')->count() }}</span>
                <span class="badge badge-approved">Approved: {{ $reservations->where('status', 'approved')->count() }}</span>
                <span class="badge badge-active">Active: {{ $reservations->where('status', 'active')->count() }}</span>
                <span class="badge badge-finished">Finished: {{ $reservations->where('status', 'finished')->count() }}</span>
                <span class="badge badge-refused">Refused: {{ $reservations->where('status', 'refused')->count() }}</span>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Resource</th>
                    <th>Category</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>#{{ $reservation->id }}</td>
                        <td>{{ $reservation->resource->name }}</td>
                        <td>{{ $reservation->resource->category->name }}</td>
                        <td>{{ $reservation->start_date->format('M d, Y') }}</td>
                        <td>{{ $reservation->end_date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge badge-{{ $reservation->status }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td>{{ $reservation->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-secondary">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $reservations->links() }}
        </div>
    @else
        <p class="text-center" style="padding: 2rem; color: #6c757d;">
            You haven't made any reservations yet. <a href="{{ route('reservations.create') }}">Create your first reservation</a>
        </p>
    @endif
</div>
@endsection
