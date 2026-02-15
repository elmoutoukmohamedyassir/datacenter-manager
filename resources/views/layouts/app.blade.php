<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DATA CENTER | Management Console</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Base styles - Clean and human-readable */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            display: flex;
        }

        /* Sidebar - The command center */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #0f172a; /* Deep Navy */
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
            display: block;
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

        /* Bottom section with user info */
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

        .logout-btn:hover {
            background: #dc2626;
        }

        /* Main Content */
        .content {
            margin-left: 260px;
            width: 100%;
            padding: 40px;
            box-sizing: border-box;
        }

        header h1 {
            margin: 0 0 30px 0;
            font-size: 28px;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-section">
            DATA CENTER
        </div>

        <nav class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('resources.index') }}" class="nav-item {{ request()->routeIs('resources.index') ? 'active' : '' }}">Resources</a>
            <a href="{{ route('reservations.index') }}" class="nav-item {{ request()->routeIs('reservations.index') ? 'active' : '' }}">Reservations</a>
        </nav>

        <div class="sidebar-footer">
            <span class="user-name">{{ Auth::user()->name }}</span>
            <span class="user-role">{{ Auth::user()->role }}</span>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>
    </aside>

    <main class="content">
        {{ $slot }}
    </main>

</body>
</html>