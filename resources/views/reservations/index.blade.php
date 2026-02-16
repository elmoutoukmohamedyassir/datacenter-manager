<x-app-layout>
    <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1>Reservations</h1>
            <p style="color: #64748b; font-size: 14px;">Manage and monitor data center resource allocations.</p>
        </div>
        <a href="{{ route('reservations.create') }}" style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">+ Request Hardware</a>
    </header>

    @if((Auth::user()->isManager() || Auth::user()->isAdmin()) && $reservations->where('status', 'pending')->count() > 0)
    <div style="margin-bottom: 40px;">
        <h3 style="font-size: 16px; color: #f59e0b; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
            <span style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%;"></span>
            Pending Approval Required
        </h3>
        <div style="background: white; border-radius: 12px; border: 1px solid #fde68a; overflow: hidden; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.05);">
            <table style="width: 100%; border-collapse: collapse;">
                <tbody style="font-size: 14px;">
                    @foreach($reservations->where('status', 'pending') as $res)
                    <tr style="border-bottom: 1px solid #fef3c7;">
                        <td style="padding: 15px 20px;">
                            <div style="font-weight: 700;">{{ $res->resource->name }}</div>
                            <div style="font-size: 12px; color: #64748b;">Requested by {{ $res->user->name }}</div>
                        </td>
                        <td style="padding: 15px 20px; color: #64748b;">{{ $res->start_date }} to {{ $res->end_date }}</td>
                        <td style="padding: 15px 20px; text-align: right;">
                            <form action="{{ route('reservations.update', $res->id) }}" method="POST" style="display: inline-block;">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button style="background: #10b981; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; margin-right: 5px;">Approve</button>
                            </form>
                            <form action="{{ route('reservations.update', $res->id) }}" method="POST" style="display: inline-block;">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button style="background: #ef4444; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600;">Reject</button>
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
            <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                <tr>
                    <th style="padding: 15px 20px; font-size: 12px; color: #64748b; text-transform: uppercase;">Resource</th>
                    <th style="padding: 15px 20px; font-size: 12px; color: #64748b; text-transform: uppercase;">Period</th>
                    <th style="padding: 15px 20px; font-size: 12px; color: #64748b; text-transform: uppercase;">Status</th>
                    <th style="padding: 15px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; text-align: right;">Details</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                @foreach($reservations as $res)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px 20px;">
                        <div style="font-weight: 600;">{{ $res->resource->name }}</div>
                        @if(Auth::user()->isAdmin()) <div style="font-size: 11px; color: #94a3b8;">User: {{ $res->user->name }}</div> @endif
                    </td>
                    <td style="padding: 15px 20px; color: #64748b;">{{ $res->start_date }} - {{ $res->end_date }}</td>
                    <td style="padding: 15px 20px;">
                        <span style="padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; 
                            background: {{ $res->status == 'approved' ? '#dcfce7' : ($res->status == 'rejected' ? '#fee2e2' : '#fef9c3') }}; 
                            color: {{ $res->status == 'approved' ? '#166534' : ($res->status == 'rejected' ? '#991b1b' : '#854d0e') }};">
                            {{ $res->status }}
                        </span>
                    </td>
                    <td style="padding: 15px 20px; text-align: right;">
                        <a href="{{ route('reservations.show', $res->id) }}" style="color: #4f46e5; text-decoration: none; font-weight: 600; font-size: 13px;">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>