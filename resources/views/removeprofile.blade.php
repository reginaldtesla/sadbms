<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Remove Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/remove-profile.css" />
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
                <a href="{{ URL('/searchprofile') }}">Search Profile</a>
                <a class="active" href="#">Remove Profile</a>
            </nav>
            <form action="LOGOUT" method="post" style="display: inline;position: absolute; bottom: 40px; width: 38%;">
                @csrf
                <button type="submit" class="logout-btn"
                    style="background: linear-gradient(to right, #dc8582, #b89292); color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; cursor: pointer; width: 40%;height: 35px;">
                    Logout
                </button>
            </form>

        </aside>

        <main class="main">
            <div class="content">
                <h2>Remove Profile</h2>
                <p>Search for a profile to permanently delete it from the system. This action is irreversible.</p>

                <div class="card">
                    <div class="form-group">
                        <label for="search-profile">Search Profile by Name or ID</label>
                        <form method="GET" action="{{ url('/removeprofile') }}">
                            @csrf
                            <div class="search-input">
                                <span class="material-symbols-outlined">search</span>
                                <input type="text" id="search-profile" name="query" placeholder="e.g., John Doe or 12345" value="{{ $query ?? '' }}" />
                                <button type="submit">Search</button>
                            </div>
                        </form>
                    </div>

                    @if(session('status'))
                        <div class="notice success">{{ session('status') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="notice error">{{ session('error') }}</div>
                    @endif

                    @if(isset($results))
                        <form id="delete-form" method="POST" action="{{ url('/removeprofile') }}">
                            @csrf
                            <h3>Matching Profiles</h3>
                            @if(count($results) > 0)
                                <div class="results-list">
                                    @foreach($results as $profile)
                                        <label class="result-item">
                                            <input type="radio" name="delete_id" value="{{ $profile->id }}" data-name="{{ $profile->name }}" data-email="{{ $profile->email }}" data-type="{{ $profile->personnel_type }}" />
                                            <div class="result-info">
                                                <strong>{{ $profile->name }}</strong> (ID: {{ $profile->id }})
                                                <div class="small">{{ $profile->email }} — {{ $profile->personnel_type }}</div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                <div id="delete-warning" class="warning-box" style="display:none;">
                                    <h4>Delete Preview</h4>
                                    <p id="warning-text"></p>
                                </div>

                                <div style="margin-top:12px;">
                                    <button id="confirm-delete" type="button" class="delete-btn" disabled>Delete Selected Profile</button>
                                </div>
                            @else
                                <p>No matching profiles found.</p>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        // Enable delete button when a profile is selected and show preview warning
        document.addEventListener('DOMContentLoaded', function () {
            const radioItems = document.querySelectorAll('input[name="delete_id"]');
            const deleteBtn = document.getElementById('confirm-delete');
            const warningBox = document.getElementById('delete-warning');
            const warningText = document.getElementById('warning-text');
            const deleteForm = document.getElementById('delete-form');

            if (!radioItems || radioItems.length === 0) return;

            radioItems.forEach(r => {
                r.addEventListener('change', function () {
                    if (deleteBtn) deleteBtn.disabled = false;
                    const name = this.dataset.name || '';
                    const email = this.dataset.email || '';
                    const type = this.dataset.type || '';
                    if (warningText) warningText.innerHTML = `You are about to permanently delete <strong>${name}</strong> (Email: ${email}, Type: ${type}). This action cannot be undone.`;
                    if (warningBox) warningBox.style.display = 'block';
                });
            });

            deleteBtn && deleteBtn.addEventListener('click', function () {
                if (!confirm('This will permanently delete the selected profile. Are you sure?')) return;
                // submit the form
                deleteForm && deleteForm.submit();
            });
        });
    </script>

</body>

</html>
