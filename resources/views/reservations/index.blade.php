<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Approvals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 font-semibold text-gray-700">User</th>
                            <th class="p-4 font-semibold text-gray-700">Resource</th>
                            <th class="p-4 font-semibold text-gray-700">Justification</th>
                            <th class="p-4 font-semibold text-gray-700 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $res->user->name }}</td>
                            <td class="p-4">{{ $res->resource->name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $res->justification }}</td>
                            <td class="p-4">
                                <form action="{{ route('reservations.update', $res->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="admin_note" placeholder="Admin note..." class="text-sm rounded border-gray-300">
                                    <div class="flex justify-center gap-2">
                                        <button name="status" value="approved" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">Approve</button>
                                        <button name="status" value="rejected" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Reject</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>