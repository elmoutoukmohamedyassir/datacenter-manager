<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incident Details') }}
        </h2>
    </x-slot>
<div class="card">
    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
        <div class="card-header" style="margin: 0; padding: 0; border: none;">
            Incident #{{ $incident->id }}
        </div>
        <span class="badge badge-{{ $incident->status }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
            {{ str_replace('_', ' ', ucfirst($incident->status)) }}
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <div>
            <h3 style="margin-bottom: 1rem; color: #495057;">Incident Details</h3>

            <p style="margin-bottom: 0.75rem;">
                <strong>Reported By:</strong> {{ $incident->reporter->first_name }} {{ $incident->reporter->last_name }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Email:</strong> {{ $incident->reporter->email }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Reported On:</strong> {{ $incident->created_at->format('F d, Y - H:i') }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Last Updated:</strong> {{ $incident->updated_at->format('F d, Y - H:i') }}
            </p>

            <p style="margin-bottom: 0.75rem;">
                <strong>Time Elapsed:</strong> {{ $incident->created_at->diffForHumans() }}
            </p>
        </div>

        <div>
            <h3 style="margin-bottom: 1rem; color: #495057;">Resource Information</h3>

            <p style="margin-bottom: 0.75rem;">
                <strong>Resource Name:</strong> {{ $incident->resource->name }}
            </p>

            @if($incident->resource->category)
                <p style="margin-bottom: 0.75rem;">
                    <strong>Category:</strong> {{ $incident->resource->category->name }}
                </p>
            @endif

            <p style="margin-bottom: 0.75rem;">
                <strong>Resource Status:</strong>
                <span class="badge badge-{{ $incident->resource->status === 'available' ? 'active' : 'pending' }}">
                    {{ ucfirst($incident->resource->status) }}
                </span>
            </p>

            @if($incident->resource->location)
                <p style="margin-bottom: 0.75rem;">
                    <strong>Location:</strong> {{ $incident->resource->location }}
                </p>
            @endif
        </div>
    </div>

    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e9ecef;">
        <h3 style="margin-bottom: 1rem; color: #495057;">Incident Description</h3>
        <div style="padding: 1.5rem; background-color: #f8f9fa; border-radius: 4px; white-space: pre-wrap;">{{ $incident->description }}</div>
    </div>

    <div style="margin-top: 2rem;">
        <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Back to Incidents</a>
    </div>
</div>
</x-app-layout>
