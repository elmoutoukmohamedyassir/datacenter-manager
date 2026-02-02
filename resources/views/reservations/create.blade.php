<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
    </div>
</x-app-layout>