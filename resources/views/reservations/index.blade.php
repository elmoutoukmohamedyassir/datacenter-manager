<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb; text-align: left;">
                            <th style="padding: 12px;">Resource</th>
                            <th style="padding: 12px;">User</th>
                            <th style="padding: 12px;">Period</th>
                            <th style="padding: 12px;">Status</th>
                            @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                                <th style="padding: 12px;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding: 12px;">{{ $reservation->resource->name }}</td>
                                <td style="padding: 12px;">{{ $reservation->user->name }}</td>
                                <td style="padding: 12px; font-size: 0.85rem; color: #6b7280;">
                                    {{ $reservation->start_date }} to {{ $reservation->end_date }}
                                </td>
                                <td style="padding: 12px;">
                                    <span style="padding: 4px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; 
                                        {{ $reservation->status === 'approved' ? 'background: #dcfce7; color: #166534;' : 'background: #fef3c7; color: #92400e;' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                                    <td style="padding: 12px;">
                                        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button style="color: #4f46e5; border: none; background: none; cursor: pointer; font-weight: bold;">Approve</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 20px; text-align: center; color: #9ca3af;">No reservations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>