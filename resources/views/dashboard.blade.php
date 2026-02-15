<x-app-layout>
    <header>
        <h1>Operations Overview</h1>
        <div class="date" style="color: #64748b;">{{ now()->format('D, M d, Y') }}</div>
    </header>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
        <div class="card">
            <p style="color: #64748b; margin: 0;">Total Resources</p>
            <h2 style="font-size: 32px; margin: 10px 0;">{{ \App\Models\Resource::count() }}</h2>
            <span style="color: #10b981; font-size: 14px;">● System Online</span>
        </div>
        <div class="card">
            <p style="color: #64748b; margin: 0;">Pending Bookings</p>
            <h2 style="font-size: 32px; margin: 10px 0;">{{ \App\Models\Reservation::where('status', 'pending')->count() }}</h2>
            <a href="{{ route('reservations.index') }}" style="color: #4f46e5; text-decoration: none; font-size: 14px;">Review Requests →</a>
        </div>
        <div class="card">
            <p style="color: #64748b; margin: 0;">Maintenance Mode</p>
            <h2 style="font-size: 32px; margin: 10px 0;">{{ \App\Models\Resource::where('is_active', false)->count() }}</h2>
            <span style="color: #f59e0b; font-size: 14px;">Requires Attention</span>
        </div>
    </div>

    <h3 style="margin-bottom: 20px;">Quick Actions</h3>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        
        @if(Auth::user()->isAdmin())
        <div class="card" style="border-left: 4px solid #4f46e5;">
            <h4>Administrator Tools</h4>
            <p style="color: #64748b; font-size: 14px;">Register new hardware into the data center inventory.</p>
            <a href="{{ route('resources.create') }}" class="btn-primary" style="display: inline-block; text-decoration: none;">Add New Resource</a>
        </div>
        @endif

        @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
        <div class="card" style="border-left: 4px solid #f59e0b;">
            <h4>Hardware Maintenance</h4>
            <p style="color: #64748b; font-size: 14px;">Toggle server availability for repair or upgrades.</p>
            <a href="{{ route('resources.index') }}" style="color: #f59e0b; font-weight: bold; text-decoration: none;">Go to Maintenance Mode →</a>
        </div>
        @endif

        @if(Auth::user()->role === 'user')
        <div class="card" style="border-left: 4px solid #10b981;">
            <h4>Request Hardware</h4>
            <p style="color: #64748b; font-size: 14px;">Submit a new reservation request for available servers.</p>
            <a href="{{ route('reservations.create') }}" class="btn-primary" style="display: inline-block; text-decoration: none;">Book a Resource</a>
        </div>
        @endif

        <div class="card" style="border-left: 4px solid #64748b;">
            <h4>Reservation Logs</h4>
            <p style="color: #64748b; font-size: 14px;">View status of your current and past hardware bookings.</p>
            <a href="{{ route('reservations.index') }}" style="color: #1e293b; font-weight: bold; text-decoration: none;">View History →</a>
        </div>
    </div>
</x-app-layout>