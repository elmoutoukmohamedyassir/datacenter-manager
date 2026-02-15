<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify | DATA CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; }
        .login-card { background: #ffffff; width: 100%; max-width: 450px; padding: 40px; border-radius: 20px; text-align: center;}
        .btn-link { color: #6366f1; background: none; border: none; cursor: pointer; font-weight: bold; margin-top: 20px;}
    </style>
</head>
<body>
    <div class="login-card">
        <h2 style="text-transform: uppercase;">Verify Identity</h2>
        <p style="color: #64748b; font-size: 14px;">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" style="background: #0f172a; color: white; padding: 12px 20px; border-radius: 8px; border: none; cursor: pointer; font-weight: bold;">Resend Verification Email</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-link">Log Out</button>
        </form>
    </div>
</body>
</html>