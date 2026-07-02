<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Portal - Register</title>
    @vite(['resources/css/signup.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="signup-page">
    <header class="signup-topbar">
        <div class="signup-topbar-inner">
            <h1 class="signup-brand-title">Admin Portal</h1>
        </div>
    </header>

    <main class="signup-main">
        <div class="signup-card-wrap">
            <div class="signup-card">
                <div class="signup-card-header">
                    <h2>Create your account</h2>
                    <p>Or <a href="{{ url('/') }}">sign in to your existing account</a></p>
                </div>

                @if (session('code_sent'))
                    <div id="codeSentFlash" class="signup-flash signup-flash-admin is-visible">{{ session('code_sent') }}</div>
                @endif

                @if (session('dev_admin_code'))
                    <div class="signup-flash signup-flash-dev">{{ session('dev_admin_code') }}</div>
                @endif

                @if ($errors->has('email'))
                    <div class="signup-flash signup-flash-dev">{{ $errors->first('email') }}</div>
                @endif

                <form method="POST" action="{{ url('/send-admin-code') }}" id="adminCodeForm" class="signup-admin-actions">
                    @csrf
                    <p class="signup-admin-hint">
                        Admin accounts require a verification code emailed to
                        <strong>{{ config('mail.admin_registration_email') }}</strong>.
                        Use your own email below for the account. Click send code before you sign up.
                    </p>
                    <button type="submit" class="signup-send-code">Send verification code</button>
                </form>

                <form method="POST" action="{{ url('/register') }}" class="signup-form" id="signupForm">
                    @csrf

                    <div class="signup-role-grid">
                        <label class="signup-role-option" for="role-admin">
                            <input class="signup-role-input" type="radio" name="role" id="role-admin" value="admin"
                                {{ old('role', 'personnel') === 'admin' ? 'checked' : '' }} />
                            <span class="signup-role-text">Admin</span>
                        </label>
                        <label class="signup-role-option" for="role-personnel">
                            <input class="signup-role-input" type="radio" name="role" id="role-personnel" value="personnel"
                                {{ old('role', 'personnel') === 'personnel' ? 'checked' : '' }} />
                            <span class="signup-role-text">Personnel</span>
                        </label>
                    </div>

                    <div class="signup-field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="name" value="{{ old('name') }}" required
                            class="@error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="signup-field" id="emailFieldContainer">
                        <label for="email-address">Email address</label>
                        <input type="email" id="email-address" name="email" value="{{ old('email') }}" autocomplete="email"
                            class="@error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="secretCodeContainer">
                        <div class="signup-field">
                            <label for="secret-code">Verification code</label>
                            <input type="text" id="secret-code" name="code" value="{{ old('code') }}"
                                class="@error('code') is-invalid @enderror" autocomplete="one-time-code" />
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="signup-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" required
                            class="@error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="signup-field">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="password_confirmation" autocomplete="new-password" required />
                    </div>

                    <button type="submit" class="signup-submit">Sign Up</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        const roleAdmin = document.getElementById('role-admin');
        const rolePersonnel = document.getElementById('role-personnel');
        const secretCodeContainer = document.getElementById('secretCodeContainer');
        const secretCodeInput = document.getElementById('secret-code');
        const emailFieldContainer = document.getElementById('emailFieldContainer');
        const emailInput = document.getElementById('email-address');
        const adminCodeForm = document.getElementById('adminCodeForm');

        const codeSentFlash = document.getElementById('codeSentFlash');

        function toggleRoleFields() {
            const isAdmin = roleAdmin.checked;

            if (isAdmin) {
                secretCodeContainer.classList.add('is-open');
                secretCodeInput.required = true;
                emailFieldContainer.classList.remove('is-hidden');
                emailInput.required = true;
                adminCodeForm.classList.add('is-visible');
                codeSentFlash?.classList.add('is-visible');
            } else {
                secretCodeContainer.classList.remove('is-open');
                secretCodeInput.required = false;
                secretCodeInput.value = '';
                emailFieldContainer.classList.remove('is-hidden');
                emailInput.required = true;
                adminCodeForm.classList.remove('is-visible');
                codeSentFlash?.classList.remove('is-visible');
            }
        }

        roleAdmin.addEventListener('change', toggleRoleFields);
        rolePersonnel.addEventListener('change', toggleRoleFields);
        toggleRoleFields();
    </script>
</body>

</html>
