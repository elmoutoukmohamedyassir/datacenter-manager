<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DC-PRO | Next-Gen Data Center Management</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            margin: 0; 
            background-color: #0f172a; /* Dark Tech Background */
            color: white;
            overflow-x: hidden;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 80px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            position: fixed;
            width: calc(100% - 160px);
            top: 0;
            z-index: 100;
        }

        .logo { font-weight: 800; font-size: 24px; color: #6366f1; text-decoration: none; }
        .logo span { color: white; }

        .auth-links a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            margin-left: 30px;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-login {
            background: #6366f1;
            padding: 10px 25px;
            border-radius: 8px;
        }

        .btn-login:hover { background: #4f46e5; }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: radial-gradient(circle at top, #1e293b 0%, #0f172a 100%);
        }

        .hero h1 {
            font-size: 72px;
            margin: 0;
            line-height: 1.1;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            color: #94a3b8;
            font-size: 20px;
            max-width: 600px;
            margin: 25px 0 40px 0;
        }

        /* Features Section (Meets Requirements) */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 100px 80px;
            background: white;
            color: #1e293b;
        }

        .feature-card {
            padding: 40px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .feature-card h3 { color: #6366f1; margin-top: 0; }
        .feature-card p { color: #64748b; font-size: 15px; line-height: 1.6; }

        footer {
            text-align: center;
            padding: 40px;
            font-size: 14px;
            color: #64748b;
            border-top: 1px solid #1e293b;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" class="logo">DC-<span>PRO</span></a>
        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Open Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-login">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="hero">
        <div style="text-transform: uppercase; letter-spacing: 4px; color: #6366f1; font-weight: 700; margin-bottom: 20px; font-size: 12px;">
            Data Center Management v3.0
        </div>
        <h1>Control. Reserve.<br>Monitor.</h1>
        <p>The all-in-one infrastructure orchestration platform for modern data centers. Manage hardware life-cycles with military precision.</p>
        
        <div style="display: flex; gap: 20px;">
            <a href="{{ route('login') }}" class="btn-login" style="text-decoration: none; color: white; padding: 15px 40px; font-weight: bold; font-size: 16px;">Launch Console</a>
        </div>
    </div>

    <div class="features">
        <div class="feature-card">
            <h3>Inventory Management</h3>
            <p>Full control over your physical assets. Admins can add, update, and track every server and rack in the facility.</p>
        </div>
        <div class="feature-card">
            <h3>Role-Based Access</h3>
            <p>Strict permission layers for Admins, Managers, and Technicians ensuring secure operational workflows.</p>
        </div>
        <div class="feature-card">
            <h3>Smart Reservations</h3>
            <p>Client-side hardware booking system with Manager approval queues and automated status tracking.</p>
        </div>
    </div>

    <footer>
        &copy; 2026 DC-PRO Infrastructure Systems. All rights reserved.
    </footer>

</body>
</html>