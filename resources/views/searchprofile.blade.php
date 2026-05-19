@extends('layouts.admin')

@section('title', 'Admin Dashboard - Search Profile')

@section('vite')
    @vite(['resources/css/search-profile.css'])
@endsection

@section('content')
    <h2>Search Profile</h2>
    <form action="/searchprofile" method="GET" class="search-form">
        <div style="display:flex; gap:8px; align-items:center;">
            <select name="type" aria-label="Filter by personnel type" onchange="this.form.submit()">
                <option value="all" {{ (isset($type) && $type === 'all') || !isset($type) ? 'selected' : '' }}>All Types</option>
                <option value="service" {{ (isset($type) && $type === 'service') ? 'selected' : '' }}>Service</option>
                <option value="attachment" {{ (isset($type) && $type === 'attachment') ? 'selected' : '' }}>Attachment Personnel</option>
            </select>

            <input type="text" name="query" placeholder="Enter name or ID to search (optional)" value="{{ old('query', $searchTerm ?? '') }}" />
            <button type="submit">Search</button>
        </div>
    </form>

    @if(isset($results))
        @php
            $count = count($results);
            $t = $type ?? 'all';
            $typeLabel = $t === 'service' ? 'Service' : ($t === 'attachment' ? 'Attachment Personnel' : 'All Types');
        @endphp

        <h3>Search Results</h3>

        @if(($searchTerm ?? '') !== '' && $type && $type !== 'all')
            <p>Showing <strong>{{ $count }}</strong> result(s) for "<em>{{ $searchTerm }}</em>" in <strong>{{ $typeLabel }}</strong>.</p>
        @elseif(($searchTerm ?? '') !== '')
            <p>Showing <strong>{{ $count }}</strong> result(s) for "<em>{{ $searchTerm }}</em>".</p>
        @elseif($type && $type !== 'all')
            <p>Showing all personnel under <strong>{{ $typeLabel }}</strong> ({{ $count }}).</p>
        @endif

        @if($count > 0)
            <ul class="results-list">
                @foreach($results as $profile)
                    <li>
                        <strong>{{ $profile->name }}</strong> (ID: {{ $profile->id }})<br />
                        Email: {{ $profile->email }}<br />
                        Phone: {{ $profile->phone }}<br />
                        <small>Type: {{ $profile->personnel_type }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No personnel found matching your selection.</p>
        @endif
    @endif
@endsection
