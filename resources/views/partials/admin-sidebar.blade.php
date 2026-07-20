<aside class="sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-brand">
            <img src="{{ asset('images/logo-192.png') }}" alt="SADBMS" class="brand-logo" width="32" height="32">
            <span>Admin Panel</span>
        </h1>
    </div>
    <nav class="nav-links">
        @php
            $adminNav = [
                ['path' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
                ['path' => 'addprofile', 'icon' => 'add_box', 'label' => 'Add Profile'],
                ['path' => 'viewprofile', 'icon' => 'group', 'label' => 'View Profiles'],
                ['path' => 'searchprofile', 'icon' => 'search', 'label' => 'Search Profile'],
                ['path' => 'removeprofile', 'icon' => 'delete', 'label' => 'Remove Profile'],
            ];
        @endphp
        @foreach ($adminNav as $item)
            <a href="{{ url('/' . $item['path']) }}"
                class="nav-item {{ request()->is($item['path']) ? 'active' : '' }}">
                <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
    <form action="{{ route('logout') }}" method="post" class="sidebar-logout-form">
        @csrf
        <button type="submit" class="logout-btn">
            <span class="material-symbols-outlined">logout</span>
            <span>Logout</span>
        </button>
    </form>
</aside>
