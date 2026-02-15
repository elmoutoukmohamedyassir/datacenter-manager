<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm | DATA CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; }
        .login-card { background: #ffffff; width: 100%; max-width: 400px; padding: 40px; border-radius: 20px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 style="text-align: center; text-transform: uppercase;">Secure Area</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">This is a secure area of the application. Please confirm your password before continuing.</p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 20px;">
            <button type="submit" style="width: 100%; background: #0f172a; color: white; padding: 14px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">Confirm</button>
        </form>
    </div>
</body>
</html>