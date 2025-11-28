<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Portal - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/signup.css" />
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
                <h2>Create your admin account</h2>
                <p>Or <a href="{{ url('/') }}">sign in to your existing account</a></p>
                <form method="POST" action="/register">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="name" required />
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email address</label>
                        <input type="email" id="email-address" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required />
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required />
                    </div>
                    <button type="submit" class="submit-btn">
                        Register
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
