@extends('layouts.app')

@section('title', isset($resource) ? 'Edit Resource' : 'Add New Resource')

@section('styles')
<style>
    .form-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        color: white;
        padding: 2.5rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-xl);
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .form-subtitle {
        font-size: 1rem;
        opacity: 0.9;
    }

    .form-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-grid.single {
        grid-template-columns: 1fr;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.9375rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label .required {
        color: #ef4444;
        font-size: 1.125rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        padding: 0.875rem 1.125rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 1rem;
        color: var(--text-primary);
        background: var(--card-bg);
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-help {
        font-size: 0.8125rem;
        color: var(--text-secondary);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid var(--border-color);
    }

    .btn {
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #4338ca 100%);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--border-color);
        color: var(--text-primary);
    }

    .btn-outline:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        gap: 0.75rem;
    }

    .status-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .status-option {
        padding: 1rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .status-option input[type="radio"] {
        display: none;
    }

    .status-option:hover {
        border-color: var(--primary-color);
    }

    .status-option input[type="radio"]:checked + label {
        background: var(--primary-color);
        color: white;
        border-radius: 8px;
        padding: 0.5rem;
    }

    .status-option label {
        cursor: pointer;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: center;
    }

    .status-icon {
        font-size: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ url()->previous() }}" class="back-link">
        ← Back
    </a>

    <!-- Form Header -->
    <div class="form-header">
        <div class="form-title">
            {{ isset($resource) ? '✏️ Edit Resource' : '➕ Add New Resource' }}
        </div>
        <div class="form-subtitle">
            {{ isset($resource) ? 'Update resource information and specifications' : 'Fill in the details to add a new resource to the inventory' }}
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form id="resourceForm" onsubmit="handleSubmit(event)">
            <!-- Basic Information -->
            <div class="form-section">
                <div class="section-title">
                    📋 Basic Information
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Resource Name <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            placeholder="e.g., Server-01"
                            value="{{ $resource->name ?? '' }}"
                            required
                        >
                        <span class="form-help">Enter a unique identifier for this resource</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Category <span class="required">*</span>
                        </label>
                        <select name="category" class="form-select" required>
                            <option value="">Select category...</option>
                            <option value="Servers" {{ (isset($resource) && $resource->category == 'Servers') ? 'selected' : '' }}>Servers</option>
                            <option value="Workstations" {{ (isset($resource) && $resource->category == 'Workstations') ? 'selected' : '' }}>Workstations</option>
                            <option value="Storage" {{ (isset($resource) && $resource->category == 'Storage') ? 'selected' : '' }}>Storage</option>
                            <option value="Network" {{ (isset($resource) && $resource->category == 'Network') ? 'selected' : '' }}>Network</option>
                            <option value="Other" {{ (isset($resource) && $resource->category == 'Other') ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid single">
                    <div class="form-group">
                        <label class="form-label">
                            Description
                        </label>
                        <textarea
                            name="description"
                            class="form-textarea"
                            placeholder="Provide a detailed description of the resource..."
                        >{{ $resource->description ?? '' }}</textarea>
                        <span class="form-help">Optional: Add any additional details about this resource</span>
                    </div>
                </div>
            </div>

            <!-- Technical Specifications -->
            <div class="form-section">
                <div class="section-title">
                    ⚙️ Technical Specifications
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            CPU / Processor
                        </label>
                        <input
                            type="text"
                            name="cpu"
                            class="form-input"
                            placeholder="e.g., 16 Cores, Intel Xeon"
                            value="{{ $resource->cpu ?? '' }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Memory (RAM)
                        </label>
                        <input
                            type="text"
                            name="memory"
                            class="form-input"
                            placeholder="e.g., 64 GB DDR4"
                            value="{{ $resource->memory ?? '' }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Storage
                        </label>
                        <input
                            type="text"
                            name="storage"
                            class="form-input"
                            placeholder="e.g., 2 TB SSD"
                            value="{{ $resource->storage ?? '' }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Operating System
                        </label>
                        <input
                            type="text"
                            name="os"
                            class="form-input"
                            placeholder="e.g., Ubuntu 22.04 LTS"
                            value="{{ $resource->os ?? '' }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Network Speed
                        </label>
                        <input
                            type="text"
                            name="network"
                            class="form-input"
                            placeholder="e.g., 10 Gbps"
                            value="{{ $resource->network ?? '' }}"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Additional Specs
                        </label>
                        <input
                            type="text"
                            name="additional_specs"
                            class="form-input"
                            placeholder="e.g., Redundant PSU"
                            value="{{ $resource->additional_specs ?? '' }}"
                        >
                    </div>
                </div>
            </div>

            <!-- Location & Status -->
            <div class="form-section">
                <div class="section-title">
                    📍 Location & Status
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Location <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="location"
                            class="form-input"
                            placeholder="e.g., Rack A - Slot 12"
                            value="{{ $resource->location ?? '' }}"
                            required
                        >
                        <span class="form-help">Physical location of the resource</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Resource ID / Serial Number
                        </label>
                        <input
                            type="text"
                            name="serial_number"
                            class="form-input"
                            placeholder="e.g., SN-2024-001-ABC"
                            value="{{ $resource->serial_number ?? '' }}"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Status <span class="required">*</span>
                    </label>
                    <div class="status-options">
                        <div class="status-option">
                            <input
                                type="radio"
                                name="status"
                                value="available"
                                id="status-available"
                                {{ (!isset($resource) || $resource->status == 'available') ? 'checked' : '' }}
                                required
                            >
                            <label for="status-available">
                                <span class="status-icon">✅</span>
                                <span>Available</span>
                            </label>
                        </div>
                        <div class="status-option">
                            <input
                                type="radio"
                                name="status"
                                value="reserved"
                                id="status-reserved"
                                {{ (isset($resource) && $resource->status == 'reserved') ? 'checked' : '' }}
                            >
                            <label for="status-reserved">
                                <span class="status-icon">⏳</span>
                                <span>Reserved</span>
                            </label>
                        </div>
                        <div class="status-option">
                            <input
                                type="radio"
                                name="status"
                                value="maintenance"
                                id="status-maintenance"
                                {{ (isset($resource) && $resource->status == 'maintenance') ? 'checked' : '' }}
                            >
                            <label for="status-maintenance">
                                <span class="status-icon">🔧</span>
                                <span>Maintenance</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="window.history.back()">
                    ❌ Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ isset($resource) ? '💾 Update Resource' : '➕ Add Resource' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleSubmit(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());

        // Display the form data (demo purposes)
        let message = '{{ isset($resource) ? '✅ Resource Updated Successfully!' : '✅ Resource Added Successfully!' }}\n\n';
        message += `Name: ${data.name}\n`;
        message += `Category: ${data.category}\n`;
        message += `Location: ${data.location}\n`;
        message += `Status: ${data.status}\n`;

        if (data.cpu) message += `CPU: ${data.cpu}\n`;
        if (data.memory) message += `Memory: ${data.memory}\n`;
        if (data.storage) message += `Storage: ${data.storage}\n`;
        if (data.os) message += `OS: ${data.os}\n`;

        message += '\nNote: This is a demo. Backend integration required for actual data persistence.';

        alert(message);

        // In real implementation, this would send data to backend
        // then redirect to resources list or detail page
        // window.location.href = "{{ url('/resources/browse') }}";
    }
</script>
@endsection
