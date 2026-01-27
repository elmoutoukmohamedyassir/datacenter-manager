<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Reservation System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .login-container {
            height: 70%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 460px;
            padding: 3rem;
            position: relative;
            z-index: 1;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .logo h1 {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .logo p {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        label {
            display: block;
            margin-bottom: 0.625rem;
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9375rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.9375rem 1.125rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .error-message::before {
            content: "⚠";
        }

        .alert {
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            font-size: 0.9375rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-error {
            background-color: #fef2f2;
            border: 2px solid #fecaca;
            color: #991b1b;
        }

        .alert-error::before {
            content: "✕";
            font-size: 1.25rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 0.625rem;
            width: 1.125rem;
            height: 1.125rem;
            cursor: pointer;
            accent-color: #4f46e5;
        }

        .remember-me label {
            margin: 0;
            font-weight: 500;
            cursor: pointer;
            color: #475569;
            font-size: 0.9375rem;
        }

        .btn {
            width: 100%;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.0625rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        }

        .btn:active {
            transform: translateY(0);
        }

        .test-accounts {
            margin-top: -0.5rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .test-accounts h3 {
            font-size: 0.9375rem;
            color: #475569;
            margin-bottom: 1.25rem;
            text-align: center;
            font-weight: 600;
        }

        .account-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 0.875rem;
            font-size: 0.875rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .account-box:hover {
            border-color: #4f46e5;
            background: white;
            transform: translateX(4px);
        }

        .account-info {
            flex: 1;
        }

        .account-box strong {
            color: #1e293b;
            display: block;
            margin-bottom: 0.375rem;
            font-size: 0.9375rem;
        }

        .account-box span {
            color: #64748b;
            font-family: 'Courier New', monospace;
            font-size: 0.8125rem;
        }

        .quick-login {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border-radius: 8px;
            font-size: 0.8125rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
        }

        .quick-login:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .quick-login::before {
            content: "→";
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .logo h1 {
                font-size: 1.75rem;
            }

            .logo-icon {
                font-size: 3rem;
            }

            .account-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .quick-login {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-icon">📊</div>
            <h1>Reservation System</h1>
            <p>DataCenter Resource Management</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn">Sign In</button>
        </form>

        <div class="test-accounts">
            <h3>📝 Quick Login with Test Accounts</h3>

            <div class="account-box">
                <div class="account-info">
                    <strong>👨‍💼 Manager Account</strong>
                    <span>manager@datacenter.com</span>
                </div>
                <a href="#" class="quick-login" onclick="fillForm('manager@datacenter.com'); return false;">Login</a>
            </div>

            <div class="account-box">
                <div class="account-info">
                    <strong>👤 Regular User</strong>
                    <span>john@datacenter.com</span>
                </div>
                <a href="#" class="quick-login" onclick="fillForm('john@datacenter.com'); return false;">Login</a>
            </div>

            <div class="account-box">
                <div class="account-info">
                    <strong>👑 Admin Account</strong>
                    <span>admin@datacenter.com</span>
                </div>
                <a href="#" class="quick-login" onclick="fillForm('admin@datacenter.com'); return false;">Login</a>
            </div>
        </div>
    </div>

    <script>
        function fillForm(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = 'password';
            document.getElementById('email').focus();
        }

        // Auto-focus on email field
        document.getElementById('email').focus();
    </script>
</body>
</html>
