<x-app-layout>
    <header style="margin-bottom: 30px;">
        <h1>Request Infrastructure</h1>
        <p style="color: #64748b; margin-top: 5px;">Select available hardware and define your usage period.</p>
    </header>

    <div style="max-width: 600px;">
        <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Target Resource</label>
                    <select name="resource_id" required 
                            style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 14px; background: #f8fafc;">
                        <option value="" disabled selected>Select a server/rack...</option>
                        @foreach(\App\Models\Resource::where('is_active', true)->get() as $resource)
                            <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Start Date</label>
                        <input type="date" name="start_date" required 
                               style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">End Date</label>
                        <input type="date" name="end_date" required 
                               style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    </div>
                </div>

                <div style="border-top: 1px solid #f1f5f9; padding-top: 20px; display: flex; gap: 12px;">
                    <button type="submit" 
                            style="flex: 1; background: #4f46e5; color: white; border: none; padding: 14px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 14px; transition: 0.2s;">
                        Submit Request
                    </button>
                    <a href="{{ route('reservations.index') }}" 
                       style="flex: 1; text-align: center; background: #f1f5f9; color: #475569; padding: 14px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>