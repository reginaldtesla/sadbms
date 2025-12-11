<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/dashboard.css" />
    <link rel="stylesheet" href="{{ asset('css/personnel.css') }}">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Panel</h1>
            </div>
            <nav class="nav-links">
                <a href="{{ url('/addprofile') }}" class="nav-item active">
                    <span class="material-symbols-outlined">add_box</span>
                    <span>Add Profile</span>
                </a>
                <a href="{{ URL('/viewprofile') }}" class="nav-item">
                    <span class="material-symbols-outlined">group</span>
                    <span>View Profiles</span>
                </a>
                <a href="{{ url('/searchprofile') }}" class="nav-item">
                    <span class="material-symbols-outlined">search</span>
                    <span>Search Profile</span>
                </a>
                <a href="{{ url('/removeprofile') }}" class="nav-item">
                    <span class="material-symbols-outlined">delete</span>
                    <span>Remove Profile</span>
                </a>
            </nav>
            <form action="/logout" method="post"
                style="display: inline;position: absolute; bottom: 10px; width: 256px;">
                @csrf
                <button type="submit" class="logout-btn"
                    style="background: linear-gradient(to right, #dc8582, #b89292); color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer; width: 90%;height: 35px;margin-left: 10px;">
                    Logout
                </button>
            </form>
        </aside>
        <main class="main-content">
            <div class="welcome-box">
                <h2>Welcome, Admin</h2>
                <p>Use the navigation on the left to manage profiles. You can add new profiles, view existing ones, search for specific profiles, or remove profiles from the system.</p>
                <p>Manage personnel by service or attachment.</p>

                <div class="tabs">
                    <button class="tab-button active" data-tab="service">Service</button>
                    <button class="tab-button" data-tab="attachment">Attachment</button>
                </div>

                <div class="tab-content active" id="service-tab">
                    <table class="personnel-table">
                        <thead>
                            <tr>
                                <th>PERSONNEL NAME</th>
                                <th>DEPARTMENT</th>
                                <th>ID</th>
                                <th>START DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicePersonnel as $person)
                                <tr>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->department }}</td>
                                    <td>{{ $person->id }}</td>
                                    <td>{{ $person->start_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $servicePersonnel->links() }}
                    </div>
                </div>

                <div class="tab-content" id="attachment-tab">
                    <table class="personnel-table">
                        <thead>
                            <tr>
                                <th>PERSONNEL NAME</th>
                                <th>INSTITUTION NAME</th>
                                <th>ID</th>
                                <th>START DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attachmentPersonnel as $person)
                                <tr>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->institution_name }}</td>
                                    <td>{{ $person->id }}</td>
                                    <td>{{ $person->start_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $attachmentPersonnel->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;

                // Remove active class from all buttons and content
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                // Add active class to clicked button and corresponding content
                this.classList.add('active');
                document.getElementById(tabName + '-tab').classList.add('active');
            });
        });
    </script>
</body>

</html>
