<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset | DATA CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; }
        .login-card { background: #ffffff; width: 100%; max-width: 400px; padding: 40px; border-radius: 20px; text-align: center;}
        .instruction { color: #64748b; font-size: 14px; margin-bottom: 25px; line-height: 1.5; }
        .form-group input { width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 20px; }
        .login-btn { width: 100%; background: #0f172a; color: white; border: none; padding: 14px; border-radius: 8px; font-weight: 700; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 style="text-transform: uppercase; letter-spacing: 2px;">Data Center</h2>
        <p class="instruction">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Email Address" required autofocus>
            <button type="submit" class="login-btn">Email Reset Link</button>
        </form>
    </div>
</body>
</html>