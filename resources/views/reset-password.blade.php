<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password - SADBMS</title>
    @include('partials.favicon')
    @vite(['resources/css/login.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="login-layout">
        <header class="login-topbar">
            <div class="login-topbar-inner">
                <h1 class="login-brand-title">
                    <img src="{{ asset('images/logo-192.png') }}" alt="SADBMS" class="brand-logo" width="32" height="32">
                    <span>Admin Panel</span>
                </h1>
                <a href="{{ url('/login') }}" class="login-signup-link">Back to Login</a>
            </div>
        </header>

        <main class="login-main">
            <div class="login-card-wrap">
                <div class="login-card">
                    <div class="login-card-header">
                        <h2>Reset Password</h2>
                        <p>Choose a new password for your account.</p>
                    </div>

                    @if ($errors->any())
                        <div class="login-alert login-alert--error">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class="login-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <input type="hidden" name="email" value="{{ $email }}" />

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">mail</span>
                            <input type="email" id="email_display" value="{{ $email }}" placeholder="Email"
                                autocomplete="email" readonly />
                        </div>

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">lock</span>
                            <input type="password" id="password" name="password" placeholder="New password"
                                autocomplete="new-password" required />
                        </div>

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">lock</span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm new password" autocomplete="new-password" required />
                        </div>

                        <button type="submit" class="login-submit">Update Password</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
