<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Reservations for Approval') }}
        </h2>
    </x-slot>
<div class="card">
    <div class="card-header">Pending Reservations for Approval</div>

    @if($reservations->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Resource</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>#{{ $reservation->id }}</td>
                        <td>
                            {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}
                            <br>
                            <small style="color: #6c757d;">{{ $reservation->user->email }}</small>
                        </td>
                        <td>
                            <strong>{{ $reservation->resource->name }}</strong>
                            <br>
                            <small style="color: #6c757d;">{{ $reservation->resource->category->name }}</small>
                        </td>
                        <td>{{ $reservation->start_date->format('M d, Y H:i') }}</td>
                        <td>{{ $reservation->end_date->format('M d, Y H:i') }}</td>
                        <td>{{ $reservation->start_date->diffInDays($reservation->end_date) }} days</td>
                        <td>{{ $reservation->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="flex gap-2" style="flex-direction: column;">
                                <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-secondary">
                                    View Details
                                </a>

                                <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn btn-sm btn-success" style="width: 100%;">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="refuse">
                                    <button type="submit" class="btn btn-sm btn-danger" style="width: 100%;" onclick="return confirm('Are you sure?')">
                                        Refuse
                                    </button>
                                </form>
                            </div>
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
            No pending reservations at this time.
        </p>
    @endif
</div>
</x-app-layout>
