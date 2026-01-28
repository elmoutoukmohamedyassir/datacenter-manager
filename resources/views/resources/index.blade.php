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
                .view-btn:hover { background: rgba(79, 70, 229, 0.1); }
                .view-btn.active { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; }
                .filters-bar { background: white; border-radius: 16px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; }
                .filters-row { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 1rem; align-items: end; }
                .filter-group { display: flex; flex-direction: column; gap: 0.5rem; }
                .filter-label { font-weight: 600; font-size: 0.875rem; color: #374151; }
                .search-input { position: relative; }
                .search-input input { width: 100%; padding: 0.5rem 0.5rem 0.5rem 2.75rem; border-radius: 0.375rem; border: 1px solid #d1d5db; }
                .search-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); font-size: 1.25rem; color: #9ca3af; }
                .resources-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
                .resource-card { background: white; border-radius: 16px; padding: 1.75rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; transition: all 0.3s ease; position: relative; overflow: hidden; }
                .resource-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #4f46e5, #10b981); }
                .resource-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
                .resource-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
                .resource-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(67, 56, 202, 0.1) 100%); }
                .resource-status { position: absolute; top: 1rem; right: 1rem; }
                .resource-name { font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
                .resource-category { display: inline-block; padding: 0.375rem 0.875rem; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 50px; font-size: 0.8125rem; font-weight: 600; color: #64748b; margin-bottom: 1rem; }
                .resource-specs { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; margin: 1rem 0; }
                .spec-item { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #6b7280; }
                .resource-location { color: #6b7280; font-size: 0.875rem; margin: 0.75rem 0; display: flex; align-items: center; gap: 0.5rem; }
                .resource-actions { display: flex; gap: 0.75rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #e5e7eb; }
                .btn-reserve { flex: 1; padding: 0.75rem; border-radius: 8px; border: none; background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center;}
                .btn-reserve:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
                .btn-details { padding: 0.75rem 1.25rem; border-radius: 8px; border: 2px solid #e5e7eb; background: white; color: #1f2937; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center;}
                .btn-details:hover { border-color: #4f46e5; background: rgba(79, 70, 229, 0.05); }
                
                .resources-list { display: flex; flex-direction: column; gap: 1rem; }
                .resource-list-item { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); border: 1px solid #e5e7eb; display: flex; gap: 1.5rem; align-items: center; transition: all 0.3s ease; }
                .resource-list-item:hover { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transform: translateX(5px); }
                .list-item-content { flex: 1; }
                .list-item-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem; flex-wrap: wrap; }
                .list-item-name { font-size: 1.125rem; font-weight: 700; color: #111827; }
                .list-item-specs { display: flex; gap: 1.5rem; flex-wrap: wrap; font-size: 0.875rem; color: #6b7280; }
                
                .badge { padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
                .badge-active { background-color: #d1fae5; color: #065f46; }
                .badge-inactive { background-color: #fee2e2; color: #991b1b; }

                @media (max-width: 1024px) { .filters-row { grid-template-columns: 1fr 1fr; } .search-input { grid-column: 1 / -1; } }
                @media (max-width: 768px) { .resources-grid { grid-template-columns: 1fr; } .filters-row { grid-template-columns: 1fr; } }
            </style>

            <div>
                <div class="resources-header">
                    <div>
                    </div>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        @if(auth()->user()->role->name === 'admin' || auth()->user()->role->name === 'manager')
                            <a href="{{ route('resources.create') }}" class="btn-reserve" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                ➕ Add New Resource
                            </a>
                        @endif
                        
                        <div class="view-switcher">
                            <button class="view-btn active" data-view="grid"><span>⊞</span> Grid</button>
                            <button class="view-btn" data-view="list"><span>☰</span> List</button>
                        </div>
                    </div>
                </div>

                <div class="filters-bar">
                    <div class="filters-row">
                        <div class="filter-group">
                            <label class="filter-label">🔍 Search</label>
                            <div class="search-input">
                                <span class="search-icon">🔍</span>
                                <input type="text" placeholder="Search resources..." id="searchInput">
                            </div>
                        </div>
                         <div class="filter-group">
                            <label class="filter-label" style="opacity: 0;">Action</label>
                            <button class="btn-reserve">Apply Filters</button>
                        </div>
                    </div>
                </div>

                <div class="results-summary" style="margin-bottom: 20px;">
                    <div class="results-count">
                        Showing <strong>{{ $resources->count() }}</strong> resources
                    </div>
                </div>

                <div class="resources-grid" id="gridView">
                    @forelse($resources as $resource)
                        <div class="resource-card">
                            <div class="resource-header">
                                <div class="resource-icon">
                                    @if(stripos($resource->category->name ?? '', 'Server') !== false) 🖥️
                                    @elseif(stripos($resource->category->name ?? '', 'Switch') !== false) 🌐
                                    @elseif(stripos($resource->category->name ?? '', 'Storage') !== false) 💽
                                    @else 📦
                                    @endif
                                </div>
                            </div>
                            
                            <div class="resource-status">
                                @if($resource->is_active)
                                    <span class="badge badge-active">Available</span>
                                @else
                                    <span class="badge badge-inactive">Maintenance</span>
                                @endif
                            </div>

                            <h3 class="resource-name">{{ $resource->name }}</h3>
                            <span class="resource-category">{{ $resource->category->name ?? 'Uncategorized' }}</span>

                            <div class="resource-specs">
                                @if(is_array($resource->specifications))
                                    @foreach($resource->specifications as $key => $value)
                                        @if($loop->iteration <= 4)
                                        <div class="spec-item">
                                            <span class="spec-icon">🔹</span>
                                            <span style="text-transform: capitalize;">{{ $key }}: {{ $value }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="spec-item">No specifications listed.</div>
                                @endif
                            </div>

                            <div class="resource-location">
                                📍 Managed by: {{ $resource->manager->name ?? 'Unknown' }}
                            </div>

                            <div class="resource-actions">
                                <button class="btn-reserve">Reserve</button>
                                <a href="{{ route('resources.show', $resource->id) }}" class="btn-details">Details</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <h3>No resources found in the database.</h3>
                            <p>Ask an Admin to add some!</p>
                        </div>
                    @endforelse
                </div>

                <div class="resources-list" id="listView" style="display: none;">
                    @foreach($resources as $resource)
                        <div class="resource-list-item">
                            <div class="resource-icon" style="font-size: 2.5rem;">
                                @if(stripos($resource->category->name ?? '', 'Server') !== false) 🖥️
                                @else 📦
                                @endif
                            </div>
                            <div class="list-item-content">
                                <div class="list-item-header">
                                    <h3 class="list-item-name">{{ $resource->name }}</h3>
                                    @if($resource->is_active)
                                        <span class="badge badge-active">Available</span>
                                    @else
                                        <span class="badge badge-inactive">Maintenance</span>
                                    @endif
                                    <span class="resource-category">{{ $resource->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <div class="list-item-specs">
                                    <span>📍 Manager: {{ $resource->manager->name ?? 'N/A' }}</span>
                                    @if(is_array($resource->specifications))
                                        @foreach($resource->specifications as $key => $value)
                                            @if($loop->iteration <= 3)
                                            <span>🔹 {{ $key }}: {{ $value }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.75rem;">
                                <button class="btn-reserve">Reserve</button>
                                <a href="{{ route('resources.show', $resource->id) }}" class="btn-details">Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <script>
                document.querySelectorAll('.view-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const view = this.dataset.view;
                        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');

                        if (view === 'grid') {
                            document.getElementById('gridView').style.display = 'grid';
                            document.getElementById('listView').style.display = 'none';
                        } else {
                            document.getElementById('gridView').style.display = 'none';
                            document.getElementById('listView').style.display = 'flex';
                        }
                    });
                });
            </script>
        </div>
    </div>
</x-app-layout>