<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DC-PRO | Management</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; margin: 0; color: #1e293b; }
        
        /* Sidebar Design */
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            background: #0f172a; 
            color: white; 
            position: fixed; 
            left: 0; 
            top: 0; 
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-header { padding: 30px 20px; }
        .sidebar-nav { flex-grow: 1; padding: 0 15px; }

        .nav-item { 
            display: flex; 
            align-items: center;
            padding: 12px 15px; 
            color: #94a3b8; 
            text-decoration: none; 
            border-radius: 8px; 
            margin-bottom: 8px; 
            transition: 0.3s; 
            font-weight: 500;
        }
        
        .nav-item:hover { background: #1e293b; color: white; }
        .nav-item.active { background: #4f46e5; color: white; }

        /* Main Content Area */
        .main-content { margin-left: 260px; padding: 40px; min-height: 100vh; }

        /* UI Components */
        .card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .badge-role { background: #334155; color: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 11px; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px; }
        
        /* Fixed Logout Section at Bottom */
        .sidebar-footer {
            padding: 20px;
            background: #1e293b;
            border-top: 1px solid #334155;
        }

        .logout-btn {
            width: 100%;
            background: #ef4444;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s ease;
            display: block;
            text-align: center;
        }

        .logout-btn:hover { background: #dc2626; transform: translateY(-1px); }

        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        h1 { font-weight: 700; color: #0f172a; margin: 0; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2 style="color: #6366f1; margin: 0; letter-spacing: -1px;">DC-PRO</h2>
        </div>

        <div class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('resources.index') }}" class="nav-item {{ request()->routeIs('resources.index') ? 'active' : '' }}">
                Inventory
            </a>
            <a href="{{ route('reservations.index') }}" class="nav-item {{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                Reservations
            </a>
        </div>

        <div class="sidebar-footer">
            <div style="margin-bottom: 15px;">
                <p style="font-size: 12px; color: #64748b; margin: 0 0 4px 0;">Signed in as:</p>
                <p style="font-size: 14px; font-weight: 600; margin: 0 0 8px 0; color: #f1f5f9;">{{ Auth::user()->name }}</p>
                <span class="badge-role">{{ Auth::user()->role }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        {{ $slot }}
    </div>

</body>
</html>