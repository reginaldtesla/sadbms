<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/dashboard.css" />
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
                <p>
                    Use the navigation on the left to manage profiles. You can add new profiles, view existing ones,
                    search for specific profiles, or remove profiles from the system.
                </p>
            </div>
        </main>
    </div>
</body>

</html>
