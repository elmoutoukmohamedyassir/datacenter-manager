<x-app-layout>
    <header style="margin-bottom: 30px;">
        <a href="{{ route('resources.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">← Cancel</a>
        <h1 style="margin-top: 10px;">Update Resource Details</h1>
    </header>

    <div style="max-width: 500px; background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0;">
        <form action="{{ route('resources.update', $resource->id) }}" method="POST">
            @csrf @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Hardware Name</label>
                <input type="text" name="name" value="{{ $resource->name }}" required 
                       style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Operational Status</label>
                <select name="is_active" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                    <option value="1" {{ $resource->is_active ? 'selected' : '' }}>Available / Online</option>
                    <option value="0" {{ !$resource->is_active ? 'selected' : '' }}>Under Maintenance / Offline</option>
                </select>
            </div>

            <button type="submit" style="width: 100%; background: #4f46e5; color: white; padding: 14px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer;">
                Apply Changes
            </button>
        </form>
    </div>
</x-app-layout>