<x-app-layout>
    <header style="margin-bottom: 30px;">
        <a href="{{ route('resources.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">← Back to Inventory</a>
        <h1 style="margin-top: 10px; font-weight: 800;">Register New Hardware</h1>
    </header>

    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #fecaca;">
            <strong style="display: block; margin-bottom: 5px;">Wait! There are some errors:</strong>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="max-width: 550px; background: white; padding: 40px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
        <form action="{{ route('resources.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #334155;">Hardware Name / Asset Tag</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Dell PowerEdge R740" required 
                       style="width: 100%; padding: 14px; border: 2px solid #f1f5f9; border-radius: 10px; background: #f8fafc;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #334155;">Hardware Type</label>
                <select name="type" required style="width: 100%; padding: 14px; border: 2px solid #f1f5f9; border-radius: 10px; background: #f8fafc;">
                    <option value="Server">Server</option>
                    <option value="Network Switch">Network Switch</option>
                    <option value="Storage Array">Storage Array</option>
                    <option value="Firewall">Firewall</option>
                    <option value="PDU/UPS">PDU/UPS</option>
                </select>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #334155;">Logical Category</label>
                <select name="category_id" required style="width: 100%; padding: 14px; border: 2px solid #f1f5f9; border-radius: 10px; background: #f8fafc;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="is_active" value="1">

            <button type="submit" style="width: 100%; background: #4f46e5; color: white; padding: 16px; border: none; border-radius: 12px; font-weight: 800; font-size: 16px; cursor: pointer; transition: transform 0.2s;">
                Confirm & Add to Inventory
            </button>
        </form>
    </div>
</x-app-layout>