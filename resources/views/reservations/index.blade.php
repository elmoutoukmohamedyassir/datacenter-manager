<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reservations Management') }}
            </h2>
            <a href="{{ route('reservations.create') }}" style="background: #4f46e5; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 0.875rem;">
                + New Reservation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb; text-align: left;">
                            <th style="padding: 12px; color: #4b5563; font-size: 0.75rem; text-transform: uppercase;">Resource</th>
                            <th style="padding: 12px; color: #4b5563; font-size: 0.75rem; text-transform: uppercase;">User</th>
                            <th style="padding: 12px; color: #4b5563; font-size: 0.75rem; text-transform: uppercase;">Period</th>
                            <th style="padding: 12px; color: #4b5563; font-size: 0.75rem; text-transform: uppercase;">Status</th>
                            @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                                <th style="padding: 12px; color: #4b5563; font-size: 0.75rem; text-transform: uppercase;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                            <tr style="border-bottom: 1px solid #f3f4f6; hover: background-color: #f9fafb;">
                                <td style="padding: 12px; font-weight: 500;">{{ $reservation->resource->name }}</td>
                                <td style="padding: 12px;">{{ $reservation->user->name }}</td>
                                <td style="padding: 12px; font-size: 0.85rem; color: #6b7280;">
                                    <span style="display: block;">{{ $reservation->start_date }}</span>
                                    <span style="font-size: 0.75rem; color: #9ca3af;">to</span>
                                    <span style="display: block;">{{ $reservation->end_date }}</span>
                                </td>
                                <td style="padding: 12px;">
                                    @php
                                        $statusStyles = [
                                            'approved' => 'background: #dcfce7; color: #166534;',
                                            'rejected' => 'background: #fee2e2; color: #991b1b;',
                                            'pending'  => 'background: #fef3c7; color: #92400e;'
                                        ];
                                        $style = $statusStyles[$reservation->status] ?? $statusStyles['pending'];
                                    @endphp
                                    <span style="padding: 4px 10px; border-radius: 9999px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; {{ $style }}">
                                        {{ $reservation->status }}
                                    </span>
                                </td>

                                @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                                    <td style="padding: 12px;">
                                        <div style="display: flex; gap: 10px;">
                                            @if($reservation->status !== 'approved')
                                            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button style="color: #059669; background: none; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 600;">Approve</button>
                                            </form>
                                            @endif

                                            @if($reservation->status !== 'rejected')
                                            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button style="color: #dc2626; background: none; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 600;">Reject</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #9ca3af;">
                                    No reservations found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>