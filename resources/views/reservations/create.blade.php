<x-app-layout>
    <div style="max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 20px; font-size: 20px; font-weight: 700;">Request Hardware Resource</h2>
        
        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Select Resource</label>
                <select name="resource_id" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px;">
                    @foreach($resources as $res)
                        <option value="{{ $res->id }}">{{ $res->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 5px;">Start Date/Time</label>
                    <input type="datetime-local" name="start_time" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px;">
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 5px;">End Date/Time</label>
                    <input type="datetime-local" name="end_time" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Justification</label>
                <textarea name="justification" rows="3" required style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px;" placeholder="Why do you need this hardware?"></textarea>
            </div>

            <button type="submit" style="width: 100%; background: #4f46e5; color: white; font-weight: 700; padding: 12px; border: none; border-radius: 6px; cursor: pointer;">
                Submit Reservation
            </button>
        </form>
    </div>
</x-app-layout>