<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>All User Profiles</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="build/assets/css/personnel.css" />
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
</head>

<body>
   <div class="page-container">
        <header class="header">
            <div class="logo">
                <svg viewBox="0 0 48 48" fill="currentColor">
                    <path d="M8.578 8.578C5.528 11.628 3.451 15.514 2.609 19.745C1.768 23.976 2.2 28.361 3.851 32.346C5.501 36.331 8.297 39.738 11.883 42.134C15.47 44.531 19.687 45.81 24 45.81C28.314 45.81 32.53 44.531 36.117 42.134C39.703 39.738 42.499 36.331 44.149 32.346C45.8 28.361 46.232 23.976 45.391 19.745C44.549 15.514 42.472 11.628 39.422 8.578L24 24L8.578 8.578Z" />
                </svg>
                <h2>All User Profiles</h2>
            </div>
            <div class="page-header">
                <form action="{{ url('/viewprofile') }}" method="GET" class="view-id-search" role="search" aria-label="Search profiles by name">
                    @csrf
                    <input type="text" name="name" placeholder="Search by Name" value="{{ request('name') }}" aria-label="Profile Name" />
                    <button type="submit">Search</button>
                    <a href="{{ url('/viewprofile') }}" class="reset-link">Reset</a>
                </form>
            </div>
            <nav class="nav">
                <a href="{{ url('/personnel/add-profile') }}">Add Profile</a>
                <a href="{{ url('/personnelsdashboard') }}">Dashboard</a>
            </nav>
        </header>
        <main class="main-content">
            <div class="profiles-container" id="profilesContainer">
                @foreach ($profiles as $profile)
                    <div class="profile-card">
                        @if ($profile['photo'])
                            <img src="{{ asset('storage/' . $profile['photo']) }}" alt="{{ $profile['name'] }}" style="width:100%;height:200px;object-fit:cover;border-radius:8px;margin-bottom:12px;" />
                        @else
                            <div style="width:100%;height:200px;background:#e0e0e0;border-radius:8px;margin-bottom:12px;display:flex;align-items:center;justify-content:center;">No Photo</div>
                        @endif
                        <h3>{{ $profile['name'] }}</h3>
                        <p>Age: {{ $profile['age'] }}</p>
                        <p>Role: {{ $profile['assigned_role'] }}</p>
                        <p>Personnel Type: {{ $profile['personnel_type'] }}</p>
                        <a href="#" class="view-details" onclick="openModal(event, {{ $loop->index }})">View Details</a>
                    </div>
                @endforeach
            </div>

            <div class="pagination-links">
                {{ $profiles->links('pagination::default') }}
            </div>
        </main>

        <!-- Modals -->
        @foreach ($profiles as $profile)
            <div id="profileModal{{ $loop->index }}" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal({{ $loop->index }})">&times;</span>
                    <div class="modal-body">
                        @if ($profile['photo'])
                            <img src="{{ asset('storage/' . $profile['photo']) }}" alt="{{ $profile['name'] }}" style="width:100%;max-height:300px;object-fit:cover;border-radius:8px;margin-bottom:16px;" />
                        @endif
                        <h2>{{ $profile['name'] }}</h2>
                        <ul>
                            <li><strong>Email:</strong> {{ $profile['email'] }}</li>
                            <li><strong>Phone:</strong> {{ $profile['phone'] }}</li>
                            <li><strong>Age:</strong> {{ $profile['age'] }}</li>
                            <li><strong>Gender:</strong> {{ $profile['gender'] }}</li>
                            <li><strong>Personnel Type:</strong> {{ $profile['personnel_type'] }}</li>
                            <li><strong>Department:</strong> {{ $profile['department'] }}</li>
                            <li><strong>Supervision Name:</strong> {{ $profile['supervision_name'] }}</li>
                            <li><strong>Assigned Role:</strong> {{ $profile['assigned_role'] }}</li>
                            <li><strong>Institution Name:</strong> {{ $profile['institution_name'] }}</li>
                            <li><strong>Duration:</strong> {{ $profile['duration'] }}</li>
                            <li><strong>Start Date:</strong> {{ $profile['start_date'] }}</li>
                            <li><strong>End Date:</strong> {{ $profile['end_date'] }}</li>
                            <li><strong>Address:</strong> {{ $profile['address'] }}</li>
                            <li><strong>Program:</strong> {{ $profile['program'] }}</li>
                            <li><strong>Bio:</strong> {{ $profile['bio'] }}</li>
                            <li><strong>Remarks:</strong> {{ $profile['remarks'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

   </div>
</body>

</html>
