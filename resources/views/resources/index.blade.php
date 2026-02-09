<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Resources') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <style>
                .resources-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1.5rem; }
                .view-switcher { display: flex; gap: 0.5rem; background: white; padding: 0.375rem; border-radius: 10px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border: 1px solid #e5e7eb; }
                .view-btn { padding: 0.625rem 1rem; border: none; background: transparent; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.9375rem; transition: all 0.3s ease; display: flex; align-items: center; gap: 0.5rem; }
                .view-btn.active { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; }
                .resources-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
                .resource-card { background: white; border-radius: 16px; padding: 1.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; position: relative; }
                .resource-status { position: absolute; top: 1rem; right: 1rem; }
                .badge { padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
                .badge-active { background-color: #d1fae5; color: #065f46; }
                .badge-inactive { background-color: #fee2e2; color: #991b1b; }
                .resource-category { display: inline-block; padding: 0.375rem 0.875rem; background: #f1f5f9; border-radius: 50px; font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-bottom: 1rem; }
                .btn-reserve { flex: 1; padding: 0.75rem; border-radius: 8px; background: #4f46e5; color: white; font-weight: 600; text-align: center; text-decoration: none; }
            </style>

            <div class="resources-header">
                <div></div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                        <a href="{{ route('resources.create') }}" class="btn-reserve">
                            ➕ Add New Resource
                        </a>
                    @endif
                    
                    <div class="view-switcher">
                        <button class="view-btn active" data-view="grid">Grid</button>
                        <button class="view-btn" data-view="list">List</button>
                    </div>
                </div>
            </div>

            <div class="resources-grid" id="gridView">
                @forelse($resources as $resource)
                    <div class="resource-card">
                        <div class="resource-status">
                            <span class="badge {{ $resource->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $resource->is_active ? 'Available' : 'Maintenance' }}
                            </span>
                        </div>

                        <h3 style="font-weight: bold; font-size: 1.2rem;">{{ $resource->name }}</h3>
                        <span class="resource-category">{{ $resource->category->name ?? 'Uncategorized' }}</span>

                        <div style="margin: 1rem 0; color: #6b7280; font-size: 0.875rem;">
                            @if(is_array($resource->specifications))
                                @foreach($resource->specifications as $key => $value)
                                    <div>🔹 {{ ucfirst($key) }}: {{ $value }}</div>
                                @endforeach
                            @endif
                        </div>

                        <div style="font-size: 0.875rem; margin-bottom: 1rem;">
                            📍 Managed by: {{ $resource->manager->name ?? 'Unknown' }}
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <a href="#" class="btn-reserve">Reserve</a>
                            <a href="{{ route('resources.show', $resource->id) }}" style="padding: 10px; border: 1px solid #ddd; border-radius: 8px; text-decoration: none; color: black;">Details</a>
                        </div>
                    </div>
                @empty
                    <p>No resources found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const view = this.dataset.view;
                document.getElementById('gridView').style.display = (view === 'grid') ? 'grid' : 'block';
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</x-app-layout>