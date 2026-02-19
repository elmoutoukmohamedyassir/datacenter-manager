<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DATA CENTER | Management Console</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #0f172a;
            color: #f1f5f9;
            position: fixed;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }

        .brand-section {
            padding: 35px 25px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #6366f1;
            border-bottom: 1px solid #1e293b;
        }

        .nav-links {
            padding: 20px 15px;
            flex-grow: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }

        .nav-item:hover {
            background: #1e293b;
            color: #ffffff;
        }

        .nav-item.active {
            background: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .notification-badge {
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 20px;
            background: #1e293b;
            border-top: 1px solid #334155;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }

        .user-role {
            font-size: 11px;
            text-transform: uppercase;
            color: #6366f1;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .logout-btn {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #ef4444;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-btn-sidebar {
            display: block;
            text-align: center;
            padding: 12px;
            background: #6366f1;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            margin-top: 10px;
        }

        .content {
            margin-left: 260px;
            width: 100%;
            padding: 40px;
            box-sizing: border-box;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid #bbf7d0;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-section">
            DATA CENTER
        </div>

        <nav class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>Dashboard</span>
                </a>
            @endauth

            <a href="{{ route('resources.index') }}" class="nav-item {{ request()->routeIs('resources.index') ? 'active' : '' }}">
                <span>Resources</span>
            </a>

            @auth
                <a href="{{ route('reservations.index') }}" class="nav-item {{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                    <span>Reservations</span>
                </a>
                
                <a href="{{ route('notifications.index') }}" class="nav-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                    <span>Notifications</span>
                    @php 
                        $unreadCount = Auth::user()->notifications()->where('is_read', false)->count(); 
                    @endphp
                    @if($unreadCount > 0)
                        <span class="notification-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
            @endauth
        </nav>

        <div class="sidebar-footer">
            @auth
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">{{ Auth::user()->role }}</span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Log Out</button>
                </form>
            @else
                <span class="user-name">Guest Mode</span>
                <a href="{{ route('login') }}" class="login-btn-sidebar">Login</a>
            @endauth
        </div>
    </aside>

    <main class="content">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>

</body>
</html>