<x-app-layout>
    <header style="margin-bottom: 30px;">
        <a href="{{ route('reservations.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">← Back to Logs</a>
        <h1 style="margin-top: 10px;">Reservation #{{ $reservation->id }}</h1>
    </header>

    <div style="max-width: 800px; display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px;">
        <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0;">
            <h3 style="margin-top: 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">Hardware Information</h3>
            <div style="margin-top: 20px;">
                <p style="color: #64748b; margin: 0; font-size: 13px;">Resource Name</p>
                <p style="font-weight: 700; font-size: 18px; margin: 5px 0 20px 0;">{{ $reservation->resource->name }}</p>
                
                <p style="color: #64748b; margin: 0; font-size: 13px;">Technical Category</p>
                <p style="font-weight: 600; margin: 5px 0 20px 0;">{{ $reservation->resource->category->name ?? 'Uncategorized' }}</p>
                
                <p style="color: #64748b; margin: 0; font-size: 13px;">Usage Window</p>
                <p style="font-weight: 600; margin: 5px 0 0 0;">{{ $reservation->start_date }} to {{ $reservation->end_date }}</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0;">
                <h3 style="margin: 0 0 15px 0; font-size: 16px;">Request Status</h3>
                <div style="text-align: center; padding: 20px; border-radius: 10px; background: #f8fafc; font-weight: 800; font-size: 20px; text-transform: uppercase; border: 1px dashed #cbd5e1;">
                    {{ $reservation->status }}
                </div>
            </div>

            <div style="background: #0f172a; color: white; padding: 25px; border-radius: 15px;">
                <h3 style="margin: 0 0 15px 0; font-size: 16px; color: #94a3b8;">Requested By</h3>
                <p style="margin: 0; font-weight: 700;">{{ $reservation->user->name }}</p>
                <p style="margin: 5px 0 0 0; font-size: 13px; color: #94a3b8;">{{ $reservation->user->email }}</p>
            </div>
        </div>
    </div>
</x-app-layout>