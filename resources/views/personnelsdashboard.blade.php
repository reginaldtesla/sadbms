<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Personnel Dashboard Simplified</title>
    <link rel="stylesheet" href="build/assets/css/personneldashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>

<div class="app-container">
    <aside class="sidebar">
        <h1 class="logo">Personnel Panel</h1>
        <nav>
            <ul class="nav-list">
                <li>
                    <a class="nav-item active" href="{{ url('/personnel/add-profile') }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span>Add Profile</span>
                    </a>
                </li>
                <li>
                    <a class="nav-item" href="{{ url('/personnel') }}">
                        <span class="material-symbols-outlined">group</span>
                        <span>View Profile</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="logout-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">


        <div class="dashboard-grid">

            <div class="welcome-widget">
                <div class="card profile-card">
                    <img alt="User avatar" class="avatar" src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}" />
                    <div>
                        <h3 class="welcome-title">Welcome back, {{ auth()->user()->name ?? 'Guest' }}</h3>
                        <p class="welcome-text">Here's a quick overview of your profile and quick links.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>
