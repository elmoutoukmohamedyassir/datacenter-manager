<x-app-layout>
    <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1>Hardware Inventory</h1>
            <p style="color: #64748b; font-size: 14px;">Total managed assets in the Data Center.</p>
        </div>
        @if(Auth::user()->isAdmin())
            <a href="{{ route('resources.create') }}" style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">+ Add Hardware</a>
        @endif
    </header>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        @foreach($resources as $resource)
        <div style="background: white; border-radius: 15px; border: 1px solid #e2e8f0; padding: 20px; position: relative; transition: 0.3s;">
            <div style="position: absolute; top: 20px; right: 20px;">
                <span style="display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; 
                    background: {{ $resource->is_active ? '#dcfce7' : '#fee2e2' }}; 
                    color: {{ $resource->is_active ? '#166534' : '#991b1b' }};">
                    <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%;"></span>
                    {{ $resource->is_active ? 'Online' : 'Maintenance' }}
                </span>
            </div>

            <h3 style="margin: 0 0 5px 0; font-size: 18px;">{{ $resource->name }}</h3>
            <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0;">Category: {{ $resource->category->name ?? 'General' }}</p>

            <div style="border-top: 1px solid #f1f5f9; pt: 15px; display: flex; flex-wrap: wrap; gap: 10px; padding-top: 15px;">
                @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                <form action="{{ route('resources.maintenance', $resource->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                        {{ $resource->is_active ? 'Disable' : 'Enable' }}
                    </button>
                </form>
                @endif

                @if(Auth::user()->isUser() && $resource->is_active)
                <a href="{{ route('reservations.create', ['resource_id' => $resource->id]) }}" style="background: #4f46e5; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">Book Now</a>
                @endif

                @if(Auth::user()->isAdmin())
                <a href="{{ route('resources.edit', $resource->id) }}" style="color: #64748b; font-size: 12px; font-weight: 600; padding: 6px; text-decoration: none;">Edit</a>
                <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" onsubmit="return confirm('Archive this hardware?');">
                    @csrf @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ef4444; font-size: 12px; font-weight: 600; cursor: pointer; padding: 6px;">Delete</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>