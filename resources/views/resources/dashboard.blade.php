<x-app-layout>
    <header style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #1e293b;">Data Center Operations</h1>
        <div style="color: #64748b;">{{ now()->format('l, F j, Y') }}</div>
    </header>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
        <div class="card" style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <p style="color: #64748b; margin: 0;">System Inventory</p>
            <h2 style="font-size: 32px; margin: 10px 0;">{{ \App\Models\Resource::count() }}</h2>
            <span style="color: #10b981; font-size: 14px;">● Network Online</span>
        </div>
        <div class="card" style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <p style="color: #64748b; margin: 0;">My Pending Bookings</p>
            <h2 style="font-size: 32px; margin: 10px 0; color: #f59e0b;">{{ Auth::user()->reservations()->where('status', 'pending')->count() }}</h2>
            <a href="{{ route('reservations.index') }}" style="color: #4f46e5; text-decoration: none; font-size: 14px;">View Details →</a>
        </div>
        <div class="card" style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0;">
            <p style="color: #64748b; margin: 0;">Maintenance Mode</p>
            <h2 style="font-size: 32px; margin: 10px 0; color: #ef4444;">{{ \App\Models\Resource::where('is_active', false)->count() }}</h2>
            <span style="color: #64748b; font-size: 14px;">Inoperative Units</span>
        </div>
    </div>

    <h3 style="margin-bottom: 20px;">Control Panel</h3>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        @if(Auth::user()->isAdmin())
        <div class="card" style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #4f46e5;">
            <h4>Hardware Inventory</h4>
            <p style="color: #64748b; font-size: 14px;">Add new physical assets to the data center.</p>
            <a href="{{ route('resources.create') }}" style="color: #4f46e5; font-weight: bold; text-decoration: none;">Add Resource</a>
        </div>
        @endif

        <div class="card" style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #10b981;">
            <h4>Allocation Request</h4>
            <p style="color: #64748b; font-size: 14px;">Reserve high-performance computing resources.</p>
            <a href="{{ route('reservations.create') }}" style="color: #10b981; font-weight: bold; text-decoration: none;">Book Now</a>
        </div>

        <div class="card" style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #64748b;">
            <h4>Usage Logs</h4>
            <p style="color: #64748b; font-size: 14px;">Monitor the status of your current allocations.</p>
            <a href="{{ route('reservations.index') }}" style="color: #1e293b; font-weight: bold; text-decoration: none;">View History</a>
        </div>
    </div>
</x-app-layout>