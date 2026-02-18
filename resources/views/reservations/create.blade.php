<x-app-layout>
    <div style="max-width: 600px; background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0; margin: auto;">
        <h2>New Reservation</h2>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label>Resource</label>
                <select name="resource_id" style="width: 100%; padding: 10px; border-radius: 8px;">
                    @foreach($resources as $res)
                        <option value="{{ $res->id }}">{{ $res->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label>Start Time</label>
                    <input type="datetime-local" name="start_time" required style="width: 100%; padding: 10px; border-radius: 8px;">
                </div>
                <div style="flex: 1;">
                    <label>End Time</label>
                    <input type="datetime-local" name="end_time" required style="width: 100%; padding: 10px; border-radius: 8px;">
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <label>Justification</label>
                <textarea name="justification" required style="width: 100%; padding: 10px; border-radius: 8px;" rows="3"></textarea>
            </div>
            <button type="submit" style="width: 100%; background: #4f46e5; color: white; padding: 12px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                Submit Request
            </button>
        </form>
    </div>
</x-app-layout>