@extends('layouts.app')

@section('title', 'My Incidents')

@section('content')
<div class="card">
    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
        <div class="card-header" style="margin: 0; padding: 0; border: none;">
            {{ Auth::user()->isManager() ? 'All Incident Reports' : 'My Incident Reports' }}
        </div>
        <a href="{{ route('incidents.create') }}" class="btn btn-primary">Report Incident</a>
    </div>

    @if($incidents->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    @if(Auth::user()->isManager())
                        <th>Reported By</th>
                    @endif
                    <th>Resource</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Reported</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidents as $incident)
                    <tr>
                        <td>#{{ $incident->id }}</td>
                        @if(Auth::user()->isManager())
                            <td>
                                {{ $incident->reporter->first_name }} {{ $incident->reporter->last_name }}
                                <br>
                                <small style="color: #6c757d;">{{ $incident->reporter->email }}</small>
                            </td>
                        @endif
                        <td>{{ $incident->resource->name }}</td>
                        <td>{{ Str::limit($incident->description, 50) }}</td>
                        <td>
                            <span class="badge badge-{{ $incident->status }}">
                                {{ str_replace('_', ' ', ucfirst($incident->status)) }}
                            </span>
                        </td>
                        <td>{{ $incident->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('incidents.show', $incident) }}" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $incidents->links() }}
        </div>
    @else
        <p class="text-center" style="padding: 2rem; color: #6c757d;">
            No incidents reported yet.
        </p>
    @endif
</div>
@endsection
