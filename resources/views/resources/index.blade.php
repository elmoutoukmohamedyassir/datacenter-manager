<div class="resource-card" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 8px;">
    <h3>{{ $resource->name }}</h3>
    <p>Status: <strong>{{ $resource->is_active ? 'Available' : 'Maintenance' }}</strong></p>

    <div style="margin-top: 10px; display: flex; gap: 10px;">
        @if($resource->is_active)
            <a href="{{ route('reservations.create', ['resource_id' => $resource->id]) }}" 
               style="background: #4f46e5; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none;">
                Book Now
            </a>
        @endif

        @if(auth()->user()->isTechnician() || auth()->user()->isAdmin())
            <form action="{{ route('resources.maintenance', $resource->id) }}" method="POST">
                @csrf @method('PATCH')
                <button style="background: #ef4444; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
                    Toggle Maintenance
                </button>
            </form>
        @endif
        
        @if(auth()->user()->isAdmin())
            <form action="{{ route('resources.destroy', $resource->id) }}" method="POST">
                @csrf @method('DELETE')
                <button onclick="return confirm('Delete this hardware?')" style="color: red; border: none; background: none; cursor: pointer;">
                    Delete
                </button>
            </form>
        @endif
    </div>
</div>