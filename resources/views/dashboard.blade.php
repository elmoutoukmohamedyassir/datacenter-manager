<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="font-bold text-lg">Inventory</h3>
                    <p class="text-gray-600 mb-4">View and manage hardware.</p>
                    <a href="{{ route('resources.index') }}" class="text-indigo-600 font-semibold underline">Go to Resources →</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="font-bold text-lg">Bookings</h3>
                    <p class="text-gray-600 mb-4">Check reservation requests.</p>
                    <a href="{{ route('reservations.index') }}" class="text-indigo-600 font-semibold underline">View Reservations →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>