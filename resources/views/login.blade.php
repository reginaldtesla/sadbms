<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/css/login.css" />
</head>

<body>
    @auth
        <script>
            window.location.href = "/dashboard";
        </script>
    @endauth

    <div class="container">
        <header class="header"
            style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #f8f9fa;">
            <div class="logo" style="display: flex; align-items: center; gap: 10px;">
                <svg class="icon" fill="currentColor" viewBox="0 0 24 24" style="width: 32px; height: 32px;">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10C16 7.79 14.21 6 12 6ZM12 12C10.9 12 10 11.1 10 10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 11.1 13.1 12 12 12ZM20 17.5C20 19.99 15.5 21 12 21C8.5 21 4 19.99 4 17.5C4 15.01 8.5 14 12 14C15.5 14 20 15.01 20 17.5Z">
                    </path>
                </svg>
                <h1 style="margin: 0;">Admin Panel</h1>
            </div>

            @guest
                <form action="/register" method="GET" style="display: inline;">
                    <button type="submit"
                        style="background: linear-gradient(to right, #65d36c, #4bc92c); color: white; border: none; padding: 8px 16px; border-radius: 4px; font-size: 14px; cursor: pointer;">
                        Sign Up
                    </button>
                </form>
            @endguest
        </header>

        @guest
            <main class="main">
                <div class="login-box">
                    <div class="login-header">
                        <h2>Welcome Back</h2>
                        <p>Sign in to manage your profiles</p>
                    </div>
                    <form method="POST" action="/login">
                        @csrf
                        <div class="input-group">
                            <label for="username">Username</label>
                            <div class="input-icon">
                                <span class="material-symbols-outlined">person</span>
                                <input type="text" id="username" name="loginname" placeholder="Username" required />
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-icon">
                                <span class="material-symbols-outlined">lock</span>
                                <input type="password" id="password" name="loginpassword" placeholder="Password"
                                    required />
                            </div>
                        </div>
                        <div class="forgot">
                            <a href="#">Forgot password?</a>
                        </div>
                        <button type="submit" class="login-btn">Login</button>
                    </form>
                </div>
            </main>
        @endguest
    </div>
</body>
