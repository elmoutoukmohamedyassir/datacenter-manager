<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm rounded-lg">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Select Resource</label>
                        <select name="resource_id" style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem;">
                            @foreach($resources as $resource)
                                <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">Start Date</label>
                            <input type="date" name="start_date" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: bold; margin-bottom: 0.5rem;">End Date</label>
                            <input type="date" name="end_date" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem;">
                        <button type="submit" style="background: #4f46e5; color: white; padding: 0.75rem 1.5rem; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            Confirm Reservation
                        </button>
                        <a href="{{ route('resources.index') }}" style="padding: 0.75rem 1.5rem; color: #6b7280; text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>