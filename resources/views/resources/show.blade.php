<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resource Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <style>
                .resource-detail-container { max-width: 1400px; margin: 0 auto; }
                .resource-header { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; padding: 3rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); position: relative; overflow: hidden; }
                .resource-header::before { content: ''; position: absolute; top: -50%; right: -10%; width: 400px; height: 400px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; }
                .resource-header-content { position: relative; z-index: 1; }
                .resource-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 1rem; }
                .resource-subtitle { font-size: 1.125rem; opacity: 0.9; margin-bottom: 1.5rem; }
                .resource-meta { display: flex; gap: 2rem; flex-wrap: wrap; }
                .meta-item { display: flex; align-items: center; gap: 0.5rem; font-size: 1rem; }
                .detail-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem; }
                @media (max-width: 968px) { .detail-grid { grid-template-columns: 1fr; } }
                .detail-card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; margin-bottom: 2rem;}
                .detail-card-title { font-size: 1.375rem; font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
                .spec-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
                .spec-item { padding: 1.25rem; background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border-radius: 12px; border: 1px solid #e5e7eb; }
                .spec-label { font-size: 0.8125rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; }
                .spec-value { font-size: 1.25rem; font-weight: 600; color: #1f2937; display: flex; align-items: center; gap: 0.5rem; }
                .info-list { list-style: none; padding: 0; margin: 0; }
                .info-list li { padding: 1rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
                .info-list li:last-child { border-bottom: none; }
                .info-label { font-weight: 600; color: #6b7280; }
                .info-value { color: #1f2937; font-weight: 500; }
                .action-buttons { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.5rem; }
                .btn { padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; border: none; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none;}
                .btn:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
                .btn-primary { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: white; }
                .btn-secondary { background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white; }
                .btn-danger { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }
                .btn-outline { background: transparent; border: 2px solid #4f46e5; color: #4f46e5; }
                .btn-outline:hover { background: #4f46e5; color: white; }
                .badge { padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; display: inline-block; }
                .badge-active { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #166534; }
                .badge-maintenance { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }
                .back-link { display: inline-flex; align-items: center; gap: 0.5rem; color: #4f46e5; text-decoration: none; font-weight: 600; margin-bottom: 1.5rem; transition: all 0.2s ease; }
                .back-link:hover { gap: 0.75rem; }
            </style>

            <div class="resource-detail-container">
                <a href="{{ route('resources.index') }}" class="back-link">
                    ← Back to Resources
                </a>

                <div class="resource-header">
                    <div class="resource-header-content">
                        <div class="resource-title">
                            @if(stripos($resource->category->name ?? '', 'Server') !== false) 🖥️
                            @elseif(stripos($resource->category->name ?? '', 'Switch') !== false) 🌐
                            @elseif(stripos($resource->category->name ?? '', 'Storage') !== false) 💽
                            @else 📦
                            @endif
                            {{ $resource->name }}
                        </div>
                        <div class="resource-subtitle">
                            Category: {{ $resource->category->name ?? 'General Resource' }}
                        </div>
                        <div class="resource-meta">
                            <div class="meta-item">
                                <span>👤</span>
                                <span>Manager: {{ $resource->manager->name ?? 'Unassigned' }}</span>
                            </div>
                            <div class="meta-item">
                                <span>📅</span>
                                <span>Created: {{ $resource->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                @if($resource->is_active)
                                    <span class="badge badge-active">Available</span>
                                @else
                                    <span class="badge badge-maintenance">Maintenance</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-grid">
                    <div>
                        <div class="detail-card">
                            <div class="detail-card-title">
                                ⚙️ Technical Specifications
                            </div>
                            <div class="spec-grid">
                                @if(is_array($resource->specifications))
                                    @foreach($resource->specifications as $key => $value)
                                        <div class="spec-item">
                                            <div class="spec-label">{{ $key }}</div>
                                            <div class="spec-value">
                                                <span>🔹</span>
                                                <span>{{ $value }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500">No specifications defined for this resource.</p>
                                @endif
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="detail-card-title">
                                ℹ️ System Information
                            </div>
                            <ul class="info-list">
                                <li>
                                    <span class="info-label">Database ID</span>
                                    <span class="info-value">#{{ $resource->id }}</span>
                                </li>
                                <li>
                                    <span class="info-label">Managed By</span>
                                    <span class="info-value">{{ $resource->manager->email ?? 'N/A' }}</span>
                                </li>
                                <li>
                                    <span class="info-label">Last Updated</span>
                                    <span class="info-value">{{ $resource->updated_at->diffForHumans() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="detail-card">
                            <div class="detail-card-title">
                                ⚡ Actions
                            </div>
                            <p class="text-gray-600 mb-4">Manage this resource record.</p>
                            
                            <div class="action-buttons" style="flex-direction: column;">
                                @if(auth()->user()->role->name === 'admin' || auth()->user()->id === $resource->manager_id)
                                    <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-primary">
                                        ✏️ Edit Resource
                                    </a>
                                    
                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                                            🗑️ Delete Resource
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        🔒 View Only
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function reserveResource() {
                    alert('Reservation system integration coming in Phase 3.');
                }
            </script>
        </div>
    </div>
</x-app-layout>