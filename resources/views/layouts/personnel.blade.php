<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Personnel Panel')</title>
    @yield('vite')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    @stack('head')
</head>

<body>
    <div class="dashboard-container">
        @include('partials.personnel-sidebar')

        <main class="main-content @yield('main-class')">
            @yield('content')
        </main>
    </div>

    @include('partials.prevent-back-cache')
    @stack('scripts')
</body>

</html>
