<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Portal - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/signup.css" />
    <style>
        .tab-container {
            width: 100%;
        }
        .tab-header {
            display: flex;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }
        .tab-link {
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-bottom: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }
        .tab-link.active {
            background-color: #ddd;
        }
        .tab-content {
            display: none;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <header class="header">
            <div class="header-inner">
                <div class="logo">
                    <svg viewBox="0 0 48 48" fill="currentColor">
                        <path
                            d="M12.0799 24L4 19.2479L9.95537 8.75216L18.04 13.4961L18.0446 4H29.9554L29.96 13.4961L38.0446 8.75216L44 19.2479L35.92 24L44 28.7521L38.0446 39.2479L29.96 34.5039L29.9554 44H18.0446L18.04 34.5039L9.95537 39.2479L4 28.7521L12.0799 24Z" />
                    </svg>
                    <h1>Admin Portal</h1>
                </div>
            </div>
        </header>

        <main class="main">
            <div class="form-box">
                <div class="tab-container">
                    <div class="tab-header">
                        <button class="tab-link active" onclick="openTab(event, 'Personnel')">Personnel</button>
                        <button class="tab-link" onclick="openTab(event, 'Admin')">Admin</button>
                    </div>

                    <div id="Personnel" class="tab-content" style="display: block;">
                        <h2>Create your personnel account</h2>
                        <p>Or <a href="{{ url('/') }}">sign in to your existing account</a></p>
                        <form method="POST" action="/register">
                            @csrf
                            <input type="hidden" name="role" value="{{ request()->get('role', 'personnel') }}">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email-address">Email address</label>
                                <input type="email" id="email-address" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" />
                            </div>
                            <button type="submit" class="submit-btn">
                                Register
                            </button>
                        </form>
                    </div>

                    <div id="Admin" class="tab-content">
                        <h2>Create your admin account</h2>
                        @if(session('code_sent'))
                            <div style="color: green; margin-bottom: 15px;">{{ session('code_sent') }}</div>
                        @endif
                        <form method="POST" action="/send-admin-code" style="margin-bottom: 20px;">
                            @csrf
                            <p>Click the button to send a verification code to the administrator's email.</p>
                            <button type="submit" class="submit-btn">Send Code</button>
                        </form>
                        <hr>
                        <p>Already have a code? Register below.</p>
                        <form method="POST" action="/register">
                            @csrf
                            <input type="hidden" name="role" value="admin">
                             <div class="form-group">
                                <label for="admin-name">Username</label>
                                <input type="text" id="admin-name" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="admin-password">Password</label>
                                <input type="password" id="admin-password" name="password" class="@error('password') is-invalid @enderror" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="admin-password-confirmation">Confirm Password</label>
                                <input type="password" id="admin-password-confirmation" name="password_confirmation" />
                            </div>
                            <div class="form-group">
                                <label for="code">Verification Code</label>
                                <input type="text" id="code" name="code" class="@error('code') is-invalid @enderror" />
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="submit-btn">
                                Register Admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>
