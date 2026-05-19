@extends('layouts.personnel')

@section('title', 'View Profiles - Personnel')

@section('vite')
    @vite(['resources/css/personnel.css'])
@endsection

@push('head')
    <script>
        function openModal(event, index) {
            if (event && typeof event.preventDefault === 'function') event.preventDefault();
            var el = document.getElementById('profileModal' + index);
            if (el) el.style.display = 'block';
        }

        function closeModal(index) {
            var el = document.getElementById('profileModal' + index);
            if (el) el.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target && event.target.classList && event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
@endpush

@section('content')
    <div class="welcome-box personnel-header">
        <h2>All Profiles</h2>
        <p>Browse all personnel profiles. Filter by name, year, or company location.</p>

        <form action="{{ url('/personnel') }}" method="GET" class="profile-filter-form search-form" role="search" aria-label="Search profiles by name, year, and company location">
            <input type="text" name="name" placeholder="Search by Name" value="{{ request('name') }}" aria-label="Profile Name" />
            <select name="company_location" aria-label="Company location" onchange="this.form.submit()">
                <option value="">All Locations</option>
                @foreach ($companyLocations as $location)
                    <option value="{{ $location }}" {{ request('company_location') === $location ? 'selected' : '' }}>{{ $location }}</option>
                @endforeach
            </select>
            <select name="year" aria-label="Select Year" onchange="this.form.submit()">
                <option value="">All Years</option>
                @php
                    $currentYear = date('Y');
                    $startYear = $currentYear - 10;
                @endphp
                @for ($year = $currentYear; $year >= $startYear; $year--)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            <button type="submit">Search</button>
            <a href="{{ url('/personnel') }}" class="reset-link">Reset</a>
        </form>
    </div>

    <div class="profiles-container" id="profilesContainer">
        @forelse ($profiles as $profile)
            <div class="profile-card">
                @if ($profile->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="profile-card-photo" />
                @else
                    <div class="profile-card-placeholder">No Photo</div>
                @endif
                <h3>{{ $profile->name }}</h3>
                <p>Age: {{ $profile->age }}</p>
                <p>Role: {{ $profile->assigned_role }}</p>
                <p>Location: {{ $profile->company_location ?? '—' }}</p>
                <p>Personnel Type: {{ $profile->personnel_type }}</p>
                <a href="#" class="view-details" onclick="openModal(event, {{ $loop->index }})">View Details</a>
            </div>
        @empty
            <p class="personnel-empty">No profiles found.</p>
        @endforelse
    </div>

    <div class="pagination-links">
        {{ $profiles->links('pagination::default') }}
    </div>

    @foreach ($profiles as $profile)
        <div id="profileModal{{ $loop->index }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal({{ $loop->index }})">&times;</span>
                <div class="modal-body">
                    @if ($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="modal-profile-photo" />
                    @endif
                    <h2>{{ $profile->name }}</h2>
                    <ul>
                        <li><strong>Email:</strong> {{ $profile->email }}</li>
                        <li><strong>Phone:</strong> {{ $profile->phone }}</li>
                        <li><strong>Age:</strong> {{ $profile->age }}</li>
                        <li><strong>Gender:</strong> {{ $profile->gender }}</li>
                        <li><strong>Personnel Type:</strong> {{ $profile->personnel_type }}</li>
                        <li><strong>Department:</strong> {{ $profile->department }}</li>
                        <li><strong>Supervision Name:</strong> {{ $profile->supervision_name }}</li>
                        <li><strong>Assigned Role:</strong> {{ $profile->assigned_role }}</li>
                        <li><strong>Institution Name:</strong> {{ $profile->institution_name }}</li>
                        <li><strong>Company Location:</strong> {{ $profile->company_location ?? '—' }}</li>
                        <li><strong>Duration:</strong> {{ $profile->duration }}</li>
                        <li><strong>Start Date:</strong> {{ $profile->start_date }}</li>
                        <li><strong>End Date:</strong> {{ $profile->end_date }}</li>
                        <li><strong>Address:</strong> {{ $profile->address }}</li>
                        <li><strong>Program:</strong> {{ $profile->program }}</li>
                        <li><strong>Bio:</strong> {{ $profile->bio }}</li>
                        <li><strong>Remarks:</strong> {{ $profile->remarks }}</li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endsection
