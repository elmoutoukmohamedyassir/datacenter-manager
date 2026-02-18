<x-app-layout>
    <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1>Reservations</h1>
            <p style="color: #64748b; font-size: 14px;">Manage and monitor data center resource allocations.</p>
        </div>
        <a href="{{ route('reservations.create') }}" style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">+ Request Hardware</a>
    </header>

    @if(session('success')) <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div> @endif
    @if(session('error')) <div style="color: red; margin-bottom: 20px;">{{ session('error') }}</div> @endif

    @php $pending = $reservations->where('status', 'pending'); @endphp
    @if((Auth::user()->isManager() || Auth::user()->isAdmin()) && $pending->count() > 0)
    <div style="margin-bottom: 40px;">
        <h3 style="font-size: 16px; color: #f59e0b; margin-bottom: 15px;">Pending Approval Required</h3>
        <div style="background: white; border-radius: 12px; border: 1px solid #fde68a; overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    @foreach($pending as $res)
                    <tr style="border-bottom: 1px solid #fef3c7;">
                        <td style="padding: 15px 20px;">
                            <div style="font-weight: 700;">{{ $res->resource->name }}</div>
                            <div style="font-size: 12px; color: #64748b;">By {{ $res->user->name }}</div>
                        </td>
                        <td style="padding: 15px 20px; color: #64748b;">
                            {{ $res->start_time->format('M d, H:i') }} to {{ $res->end_time->format('M d, H:i') }}
                        </td>
                        <td style="padding: 15px 20px; text-align: right;">
                            <form action="{{ route('reservations.update', $res->id) }}" method="POST" style="display: inline;">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button style="background: #10b981; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;">Approve</button>
                            </form>
                            <form action="{{ route('reservations.update', $res->id) }}" method="POST" style="display: inline;">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button style="background: #ef4444; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;">Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <h3 style="font-size: 16px; margin-bottom: 15px;">Reservation History</h3>
    <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th style="padding: 15px 20px;">Resource</th>
                    <th style="padding: 15px 20px;">Period</th>
                    <th style="padding: 15px 20px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $res)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px;">
                        <div style="font-weight: 600;">{{ $res->resource->name }}</div>
                    </td>
                    <td style="padding: 15px 20px; color: #64748b;">
                        {{ $res->start_time->format('M d, Y') }}
                    </td>
                    <td style="padding: 15px 20px;">
                        <span style="padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; 
                            background: {{ $res->status == 'approved' ? '#dcfce7' : ($res->status == 'rejected' ? '#fee2e2' : '#fef9c3') }}; 
                            color: {{ $res->status == 'approved' ? '#166534' : ($res->status == 'rejected' ? '#991b1b' : '#854d0e') }};">
                            {{ $res->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>