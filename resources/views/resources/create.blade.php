<x-app-layout>
    <header style="margin-bottom: 30px;">
        <a href="{{ route('resources.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">← Back to Inventory</a>
        <h1 style="margin-top: 10px;">Register New Hardware</h1>
    </header>

    <div style="max-width: 500px; background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0;">
        <form action="{{ route('resources.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Hardware Name / ID</label>
                <input type="text" name="name" placeholder="e.g. Rack-01 Server B" required 
                       style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">Category</label>
                <select name="category_id" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="is_active" value="1">

            <button type="submit" style="width: 100%; background: #0f172a; color: white; padding: 14px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer;">
                Save to Database
            </button>
        </form>
    </div>
</x-app-layout>