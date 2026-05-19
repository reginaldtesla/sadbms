<aside class="sidebar personnel-sidebar">
    <div class="sidebar-header personnel-sidebar-user">
        @if (!empty($personnelUserProfile?->photo))
            <img
                src="{{ asset('storage/' . $personnelUserProfile->photo) }}"
                alt="{{ $personnelUserProfile->name }}"
                class="sidebar-user-avatar"
            />
        @else
            <div class="sidebar-user-avatar sidebar-user-avatar--placeholder" aria-hidden="true">
                {{ strtoupper(substr($personnelUserProfile->name ?? auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
        @endif
        <div class="sidebar-user-meta">
            <h1>Personnel Panel</h1>
            <p class="sidebar-user-name">{{ $personnelUserProfile->name ?? auth()->user()->name }}</p>
            @if (auth()->user()?->email)
                <p class="sidebar-user-email">{{ auth()->user()->email }}</p>
            @endif
        </div>
    </div>
    <nav class="nav-links">
        @php
            $personnelNav = [
                ['path' => 'personnelsdashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
                ['path' => 'personnel/add-profile', 'icon' => 'add_box', 'label' => 'Add Profile'],
                ['path' => 'personnel', 'icon' => 'group', 'label' => 'View Profiles', 'exact' => true],
            ];
        @endphp
        @foreach ($personnelNav as $item)
            @php
                $isActive = !empty($item['exact'])
                    ? request()->is($item['path'])
                    : request()->is($item['path']) || request()->is($item['path'] . '/*');
            @endphp
            <a href="{{ url('/' . $item['path']) }}" class="nav-item {{ $isActive ? 'active' : '' }}">
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
