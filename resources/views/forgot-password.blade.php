<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password - SADBMS</title>
    @vite(['resources/css/login.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="login-layout">
        <header class="login-topbar">
            <div class="login-topbar-inner">
                <h1 class="login-brand-title">Admin Panel</h1>
                <a href="{{ url('/login') }}" class="login-signup-link">Back to Login</a>
            </div>
        </header>

        <main class="login-main">
            <div class="login-card-wrap">
                <div class="login-card">
                    <div class="login-card-header">
                        <h2>Forgot Password</h2>
                        <p>Enter your account email and we will send you a reset link.</p>
                    </div>

                    @if (session('status'))
                        <div class="login-alert login-alert--success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="login-alert login-alert--error">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="login-form">
                        @csrf

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">mail</span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Email address" autocomplete="email" required />
                        </div>

                        <button type="submit" class="login-submit">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
