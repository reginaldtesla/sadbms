<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="build/assets/css/login.css" />
</head>

<body>
    <div class="signup">
        <a href="{{ url('/register') }}">Sign Up</a>
    </div>
    <div class="container">
        <header class="header">
            <h1>Admin Panel</h1>
        </header>

        <main class="main">
            <div class="login-box">
                <div class="login-header">
                    <h2>Welcome Back</h2>
                    <p>Sign in to manage your profiles</p>
                </div>
                <form method="POST" action="/login">
                    @csrf
                    <div class="tabs">
                        <button type="button" class="tab-button active" data-role="admin">Admin Login</button>
                        <button type="button" class="tab-button" data-role="personnel">Personnel Login</button>
                    </div>
                    <input type="hidden" name="role" id="role" value="admin" />
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="loginname" placeholder="Username" required />
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="loginpassword" placeholder="Password" required />
                    </div>
                    <div class="forgot">
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function () {
                const role = this.dataset.role;
                document.getElementById('role').value = role;

                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                alert(`You have selected ${role} login.`);
            });
        });
    </script>
</body>

</html>
