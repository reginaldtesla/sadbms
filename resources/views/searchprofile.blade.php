<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Search Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/search-profile.css" />
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Panel</h1>
            </div>
            <nav class="nav-links">
                <a href="{{ URL('/addprofile') }}">Add Profile</a>
                <a href="{{ URL('/viewprofile') }}">View Profiles</a>
                <a href="{{ URL('/searchprofile') }}" class="active">Search Profile</a>
                <a href="{{ URL('/removeprofile') }}">Remove Profile</a>
            </nav>
            <form action="/logout" method="post" style="display: inline;position: absolute; bottom: 40px; width: 38%;">
                @csrf
                <button type="submit" class="logout-btn"
                    style="background: linear-gradient(to right, #dc8582, #b89292); color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer; width: 40%;height: 35px;">
                    Logout
                </button>
            </form>
        </aside>

        <main class="main">
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
        </main>
    </div>
</body>

</html>
