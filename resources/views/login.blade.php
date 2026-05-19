<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Login</title>
    @vite(['resources/css/login.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body class="login-page">
    <div class="login-layout">
        <header class="login-topbar">
            <div class="login-topbar-inner">
                <h1 class="login-brand-title">Admin Panel</h1>
                <a href="{{ url('/register') }}" class="login-signup-link">Sign Up</a>
            </div>
        </header>

        <main class="login-main">
            <div class="login-card-wrap">
                <div class="login-card">
                    <div class="login-card-header">
                        <h2>Welcome Back</h2>
                        <p>Sign in to manage your profiles</p>
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

                    <form method="POST" action="{{ url('/login') }}" class="login-form">
                        @csrf

                        <fieldset class="login-role-fieldset">
                            <legend class="sr-only">Login as</legend>
                            <div class="login-role-grid">
                                <div>
                                    <input class="login-role-input" type="radio" name="role" id="admin_login"
                                        value="admin" {{ old('role', 'admin') === 'admin' ? 'checked' : '' }} />
                                    <label class="login-role-label" for="admin_login">Admin Login</label>
                                </div>
                                <div>
                                    <input class="login-role-input" type="radio" name="role" id="personnel_login"
                                        value="personnel" {{ old('role') === 'personnel' ? 'checked' : '' }} />
                                    <label class="login-role-label" for="personnel_login">Personnel Login</label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">person</span>
                            <input type="text" id="username" name="loginname" value="{{ old('loginname') }}"
                                placeholder="Username" autocomplete="username" required />
                        </div>

                        <div class="login-input-group">
                            <span class="material-symbols-outlined login-input-icon" aria-hidden="true">lock</span>
                            <input type="password" id="password" name="loginpassword" placeholder="Password"
                                autocomplete="current-password" required />
                        </div>

                        <div class="login-forgot">
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>

                        <button type="submit" class="login-submit">Login</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
