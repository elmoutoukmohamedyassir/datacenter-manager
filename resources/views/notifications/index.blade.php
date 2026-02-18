<x-app-layout>
    <header style="margin-bottom: 30px;">
        <h1>Notifications</h1>
        <p style="color: #64748b;">System alerts and updates for your account.</p>
    </header>

    <div style="max-width: 800px; display: flex; flex-direction: column; gap: 15px;">
        @forelse(Auth::user()->notifications()->latest()->get() as $note)
            <div style="background: {{ $note->is_read ? 'white' : '#f0f4ff' }}; 
                        padding: 20px; 
                        border-radius: 12px; 
                        border: 1px solid {{ $note->is_read ? '#e2e8f0' : '#6366f1' }};
                        display: flex;
                        justify-content: space-between;
                        align-items: center;">
                <div>
                    <h4 style="margin: 0; color: #0f172a;">{{ $note->title }}</h4>
                    <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">{{ $note->message }}</p>
                    <small style="color: #94a3b8; font-size: 11px;">{{ $note->created_at->diffForHumans() }}</small>
                </div>
                @if(!$note->is_read)
                    <span style="width: 10px; height: 10px; background: #6366f1; border-radius: 50%;"></span>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 50px; color: #94a3b8; background: white; border-radius: 15px; border: 1px dashed #cbd5e1;">
                No new notifications.
            </div>
        @endforelse
    </div>
</x-app-layout>