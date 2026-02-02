<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
<<<<<<< HEAD
            {{ __('My Reservations') }}
        </h2>
    </x-slot>
<div class="card">
    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
        <div class="card-header" style="margin: 0; padding: 0; border: none;">
            {{ Auth::user()->isManager() ? 'Pending Reservations' : 'My Reservations' }}
=======
            {{ __('Pending Approvals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 font-semibold text-gray-700">User</th>
                            <th class="p-4 font-semibold text-gray-700">Resource</th>
                            <th class="p-4 font-semibold text-gray-700">Justification</th>
                            <th class="p-4 font-semibold text-gray-700 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $res->user->name }}</td>
                            <td class="p-4">{{ $res->resource->name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $res->justification }}</td>
                            <td class="p-4">
                                <form action="{{ route('reservations.update', $res->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="admin_note" placeholder="Admin note..." class="text-sm rounded border-gray-300">
                                    <div class="flex justify-center gap-2">
                                        <button name="status" value="approved" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">Approve</button>
                                        <button name="status" value="rejected" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Reject</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
>>>>>>> feat/logic/reservation-system
        </div>
    </div>
<<<<<<< HEAD

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
=======
>>>>>>> feat/logic/reservation-system
</x-app-layout>