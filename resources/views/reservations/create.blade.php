<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Reservation') }}
        </h2>
    </x-slot>

<div class="card">
    <div class="card-header">Create New Reservation</div>

    <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
        @csrf

        <div class="form-group">
            <label for="resource_id">Resource *</label>
            <select name="resource_id" id="resource_id" required>
                <option value="">Select a resource</option>
                @foreach($resources as $resource)
                    <option value="{{ $resource->id }}" data-resource="{{ json_encode($resource) }}" {{ old('resource_id') == $resource->id ? 'selected' : '' }}>
                        {{ $resource->name }} - {{ $resource->category->name }}
                        (CPU: {{ $resource->cpu }}, RAM: {{ $resource->ram }}GB, Storage: {{ $resource->storage }}GB)
                    </option>
                @endforeach
            </select>
            @error('resource_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div id="resourceDetails" style="display: none;" class="card" style="background-color: #f8f9fa; padding: 1rem; margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 0.5rem;">Resource Details</h3>
            <p><strong>Category:</strong> <span id="detailCategory"></span></p>
            <p><strong>CPU:</strong> <span id="detailCpu"></span> cores</p>
            <p><strong>RAM:</strong> <span id="detailRam"></span> GB</p>
            <p><strong>Storage:</strong> <span id="detailStorage"></span> GB</p>
            <p><strong>OS:</strong> <span id="detailOs"></span></p>
            <p><strong>Location:</strong> <span id="detailLocation"></span></p>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date & Time *</label>
            <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            @error('start_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_date">End Date & Time *</label>
            <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
            @error('end_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div id="availabilityCheck" style="display: none; margin-bottom: 1.5rem;">
            <button type="button" class="btn btn-secondary" id="checkAvailabilityBtn">
                Check Availability
            </button>
            <div id="availabilityResult" style="margin-top: 0.5rem;"></div>
        </div>

        <div class="form-group">
            <label for="justification">Justification (Optional)</label>
            <textarea name="justification" id="justification" rows="4" placeholder="Explain why you need this resource...">{{ old('justification') }}</textarea>
            @error('justification')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        @error('date_range')
            <div class="alert alert-error">{{ $message }}</div>
        @enderror

        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Submit Reservation</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const resourceSelect = document.getElementById('resource_id');
    const resourceDetails = document.getElementById('resourceDetails');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const availabilityCheck = document.getElementById('availabilityCheck');
    const checkAvailabilityBtn = document.getElementById('checkAvailabilityBtn');
    const availabilityResult = document.getElementById('availabilityResult');

    // Show resource details when selected
    resourceSelect.addEventListener('change', function() {
        if (this.value) {
            const selectedOption = this.options[this.selectedIndex];
            const resource = JSON.parse(selectedOption.getAttribute('data-resource'));

            document.getElementById('detailCategory').textContent = resource.category.name;
            document.getElementById('detailCpu').textContent = resource.cpu || 'N/A';
            document.getElementById('detailRam').textContent = resource.ram || 'N/A';
            document.getElementById('detailStorage').textContent = resource.storage || 'N/A';
            document.getElementById('detailOs').textContent = resource.os || 'N/A';
            document.getElementById('detailLocation').textContent = resource.location || 'N/A';

            resourceDetails.style.display = 'block';
        } else {
            resourceDetails.style.display = 'none';
        }

        updateAvailabilityCheck();
    });

    // Show availability check when dates are filled
    startDateInput.addEventListener('change', updateAvailabilityCheck);
    endDateInput.addEventListener('change', updateAvailabilityCheck);

    function updateAvailabilityCheck() {
        if (resourceSelect.value && startDateInput.value && endDateInput.value) {
            availabilityCheck.style.display = 'block';
        } else {
            availabilityCheck.style.display = 'none';
        }
    }

    // Check availability via AJAX
    checkAvailabilityBtn.addEventListener('click', function() {
        const resourceId = resourceSelect.value;
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (!resourceId || !startDate || !endDate) {
            return;
        }

        availabilityResult.innerHTML = '<div style="color: #6c757d;">Checking availability...</div>';

        fetch('{{ route("reservations.check-availability") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                resource_id: resourceId,
                start_date: startDate,
                end_date: endDate
            })
        })
        .then(response => response.json())
        .then(data => {
            const className = data.available ? 'alert-success' : 'alert-error';
            availabilityResult.innerHTML = `<div class="alert ${className}">${data.message}</div>`;
        })
        .catch(error => {
            availabilityResult.innerHTML = '<div class="alert alert-error">Error checking availability</div>';
        });
    });

    // Set minimum date to now
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    startDateInput.min = minDateTime;
    endDateInput.min = minDateTime;
});
</script>
</x-app-layout>
