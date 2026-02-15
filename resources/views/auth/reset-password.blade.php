<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Password | DATA CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; }
        .login-card { background: #ffffff; width: 100%; max-width: 400px; padding: 40px; border-radius: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group input { width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #e2e8f0; border-radius: 8px; }
        .login-btn { width: 100%; background: #0f172a; color: white; border: none; padding: 14px; border-radius: 8px; font-weight: 700; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 style="text-align: center; text-transform: uppercase;">Set New Password</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>
            </div>
            <button type="submit" class="login-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>