<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
<<<<<<< HEAD
            {{ __('Create New Reservation') }}
        </h2>
    </x-slot>

<div class="card">
    <div class="card-header">Create New Reservation</div>
=======
            {{ __('New Reservation Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
                @endif

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="resource_id" value="Resource ID (Server)" />
                        <x-text-input id="resource_id" name="resource_id" type="number" class="block mt-1 w-full" required />
                    </div>
>>>>>>> feat/logic/reservation-system

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="start_time" value="Start Time" />
                            <x-text-input name="start_time" type="datetime-local" class="block mt-1 w-full" required />
                        </div>
                        <div>
                            <x-input-label for="end_time" value="End Time" />
                            <x-text-input name="end_time" type="datetime-local" class="block mt-1 w-full" required />
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="justification" value="Why do you need this resource?" />
                        <textarea name="justification" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Describe your project..."></textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Submit Reservation') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
<<<<<<< HEAD

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
=======
    </div>
</x-app-layout>
>>>>>>> feat/logic/reservation-system
