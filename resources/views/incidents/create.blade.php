<x-app-layout>
    <x-slot name="title">Report Incident</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Incident') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">Report an Incident</div>

        <form action="{{ route('incidents.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="resource_id">Resource *</label>
                <select name="resource_id" id="resource_id" required>
                    <option value="">Select a resource</option>
                    @foreach($resources as $resource)
                        <option value="{{ $resource->id }}" {{ old('resource_id') == $resource->id ? 'selected' : '' }}>
                            {{ $resource->name }}
                            @if($resource->category)
                                - {{ $resource->category->name }}
                            @endif
                        </option>
                    @endforeach
                </select>

                @error('resource_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea
                    name="description"
                    id="description"
                    rows="6"
                    required
                    placeholder="Describe the incident in detail (minimum 10 characters)..."
                >{{ old('description') }}</textarea>

                <small style="color: #6c757d;">
                    Please provide as much detail as possible about the incident.
                </small>

                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="alert alert-info">
                <strong>Note:</strong> Your incident report will be reviewed by the system administrators.
                Please ensure you provide accurate and detailed information.
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary">Submit Report</button>
                <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
