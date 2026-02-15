<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | DATA CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; background-image: radial-gradient(circle at 2px 2px, #1e293b 1px, transparent 0); background-size: 40px 40px; }
        .login-card { background: #ffffff; width: 100%; max-width: 450px; padding: 40px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        .header { text-align: center; margin-bottom: 32px; }
        .header h1 { font-size: 24px; font-weight: 800; color: #0f172a; letter-spacing: 2px; margin: 0; text-transform: uppercase; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; }
        .login-btn { width: 100%; background: #6366f1; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; margin-top: 10px; }
        .footer-links { text-align: center; margin-top: 24px; font-size: 13px; }
        .footer-links a { color: #6366f1; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="header">
            <h1>DATA CENTER</h1>
            <p>Create Operator Account</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Access Role</label>
                <select name="role" required>
                    <option value="user">Standard User</option>
                    <option value="technician">Technician</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="login-btn">Register Account</button>
        </form>
        <div class="footer-links">
            <p>Already registered? <a href="{{ route('login') }}">Sign In</a></p>
        </div>
    </div>
</body>
</html>