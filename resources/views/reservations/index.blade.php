<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>
<div class="card">
    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
        <div class="card-header" style="margin: 0; padding: 0; border: none;">
            {{ Auth::user()->isManager() ? 'Pending Reservations' : 'My Reservations' }}
        </div>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">New Reservation</a>
    </div>

    @if($reservations->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    @if(Auth::user()->isManager())
                        <th>User</th>
                    @endif
                    <th>Resource</th>
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
                        @if(Auth::user()->isManager())
                            <td>{{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</td>
                        @endif
                        <td>{{ $reservation->resource->name }}</td>
                        <td>{{ $reservation->start_date->format('M d, Y H:i') }}</td>
                        <td>{{ $reservation->end_date->format('M d, Y H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $reservation->status }}">
                                {{ $reservation->status }}
                            </span>
                        </td>
                        <td>{{ $reservation->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-secondary">View</a>
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
            No reservations found. <a href="{{ route('reservations.create') }}">Create your first reservation</a>
        </p>
    @endif
</div>
</x-app-layout>