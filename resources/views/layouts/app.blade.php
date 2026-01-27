<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Reservation System')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 0;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            gap: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo::before {
            content: "📊";
            font-size: 1.75rem;
        }

        nav {
            flex: 1;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: center;
        }

        nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-1px);
        }

        nav a.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            font-size: 0.9rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Main Content */
        main {
            padding: 2.5rem 0;
            min-height: calc(100vh - 180px);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease;
            box-shadow: var(--shadow-sm);
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

        .alert::before {
            font-size: 1.5rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: var(--success-color);
            color: #166534;
        }

        .alert-success::before {
            content: "✓";
        }

        .alert-error {
            background-color: #fef2f2;
            border-color: var(--danger-color);
            color: #991b1b;
        }

        .alert-error::before {
            content: "✕";
        }

        .alert-info {
            background-color: #eff6ff;
            border-color: var(--info-color);
            color: #1e40af;
        }

        .alert-info::before {
            content: "ℹ";
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.75rem;
        }

        label {
            display: block;
            margin-bottom: 0.625rem;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="datetime-local"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 0.875rem 1.125rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--card-bg);
            color: var(--text-primary);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error-message {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .error-message::before {
            content: "⚠";
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.875rem 1.75rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: var(--shadow-sm);
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #475569 0%, #64748b 100%);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card-bg);
        }

        .table th,
        .table td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 700;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.01);
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.375rem 1rem;
            font-size: 0.8125rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        .badge-pending {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #78350f;
        }

        .badge-approved {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .badge-active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-finished {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
        }

        .badge-refused {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .badge-open {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #78350f;
        }

        .badge-in_progress {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .badge-resolved {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 0.625rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .pagination a:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .pagination .active {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-color: var(--primary-color);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, #0f172a 100%);
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
        }

        .gap-2 {
            gap: 1rem;
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            nav ul {
                gap: 0.25rem;
            }

            nav a {
                padding: 0.5rem 0.875rem;
                font-size: 0.875rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                padding: 0.75rem 0;
            }

            .logo {
                font-size: 1.25rem;
            }

            nav {
                width: 100%;
            }

            nav ul {
                justify-content: center;
            }

            .card {
                padding: 1.25rem;
            }

            .card-header {
                font-size: 1.375rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }

            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9375rem;
            }

            .user-info {
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 480px) {
            .table-container {
                border-radius: 8px;
            }

            .table th,
            .table td {
                padding: 0.625rem 0.375rem;
                font-size: 0.8125rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .flex.gap-2 {
                flex-direction: column;
            }

            .card {
                padding: 1rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="{{ route('reservations.index') }}" class="logo">Reservation System</a>
                @auth
                <nav>
                    <ul>
                        @if(Auth::user()->isAdmin())
                            <li><a href="/dashboards/admin" class="{{ request()->is('dashboards/admin') ? 'active' : '' }}">Administration</a></li>
                        @elseif(Auth::user()->isManager())
                            <li><a href="/dashboards/manager" class="{{ request()->is('dashboards/manager') ? 'active' : '' }}">Management</a></li>
                        @else
                            <li><a href="/dashboards/user" class="{{ request()->is('dashboards/user') ? 'active' : '' }}">Dashboard</a></li>
                        @endif
                        @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                            <li><a href="/resources/browse" class="{{ request()->is('resources/browse') || request()->is('resources/*') ? 'active' : '' }}">Browse Resources</a></li>
                        @endif
                        <li><a href="{{ route('reservations.create') }}" class="{{ request()->routeIs('reservations.create') ? 'active' : '' }}">New Reservation</a></li>

                        <li><a href="{{ route('incidents.index') }}" class="{{ request()->routeIs('incidents.*') ? 'active' : '' }}">Incidents</a></li>
                        <li>
                            <a href="/notifications" class="{{ request()->is('notifications') ? 'active' : '' }}" style="position: relative;">
                                🔔
                                <span style="position: absolute; top: 0; right: 0; background: var(--danger-color); color: white; font-size: 0.625rem; font-weight: 700; padding: 0.125rem 0.375rem; border-radius: 50px; min-width: 16px; text-align: center;">3</span>
                            </a>
                        </li>
                        <li>
                            <span class="user-info">
                                <span class="user-avatar">{{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}</span>
                                <span>{{ Auth::user()->first_name }}</span>
                            </span>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm" style="box-shadow: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Reservation System. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
