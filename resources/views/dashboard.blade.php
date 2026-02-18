<x-app-layout>
    <header style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 800; color: #1e293b;">Data Center Operations</h1>
        <div style="color: #64748b;">{{ now()->format('l, F j, Y') }}</div>
    </header>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <p style="color: #64748b; margin: 0; font-size: 14px; font-weight: 600;">Total Inventory</p>
            <h2 style="font-size: 32px; margin: 10px 0; color: #1e293b;">{{ \App\Models\Resource::count() }}</h2>
            <span style="color: #10b981; font-size: 12px; font-weight: 700;">● SYSTEM ACTIVE</span>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <p style="color: #64748b; margin: 0; font-size: 14px; font-weight: 600;">My Pending Requests</p>
            <h2 style="font-size: 32px; margin: 10px 0; color: #f59e0b;">
                {{ Auth::user()->reservations()->where('status', 'pending')->count() }}
            </h2>
            <a href="{{ route('reservations.index') }}" style="color: #4f46e5; text-decoration: none; font-size: 13px; font-weight: 600;">View History →</a>
        </div>

        <div style="background: white; padding: 25px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <p style="color: #64748b; margin: 0; font-size: 14px; font-weight: 600;">Maintenance Alerts</p>
            <h2 style="font-size: 32px; margin: 10px 0; color: #ef4444;">{{ \App\Models\Resource::where('is_active', false)->count() }}</h2>
            <span style="color: #ef4444; font-size: 12px; font-weight: 700;">REQUIRES ATTENTION</span>
        </div>
    </div>

    <h3 style="margin-bottom: 20px; font-size: 18px; font-weight: 700;">Control Panel</h3>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        
        @if(Auth::user()->isAdmin())
        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #4f46e5;">
            <h4 style="margin: 0 0 10px 0;">Hardware Provisioning</h4>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Register new servers or network gear into the system.</p>
            <a href="{{ route('resources.create') }}" style="background: #4f46e5; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Add Resource</a>
        </div>
        @endif

        @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #f59e0b;">
            <h4 style="margin: 0 0 10px 0;">Resource Health</h4>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Monitor hardware status and toggle maintenance modes.</p>
            <a href="{{ route('resources.index') }}" style="background: #f59e0b; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Manage Hardware</a>
        </div>
        @endif

        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #10b981;">
            <h4 style="margin: 0 0 10px 0;">New Allocation</h4>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Submit a new booking request for available resources.</p>
            <a href="{{ route('reservations.create') }}" style="background: #10b981; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Book Resource</a>
        </div>

        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 5px solid #64748b;">
            <h4 style="margin: 0 0 10px 0;">Access Logs</h4>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Review your history of hardware usage and requests.</p>
            <a href="{{ route('reservations.index') }}" style="background: #64748b; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">View History</a>
        </div>
    </div>
</x-app-layout>