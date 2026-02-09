<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'DataCenter') }}</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <style>
            /* Quick fix for the layout structure */
            body { background-color: #f3f4f6; margin: 0; font-family: sans-serif; }
            nav { background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem; display: flex; gap: 20px; }
            nav a { color: #374151; text-decoration: none; font-weight: 500; }
            .header-bg { background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 20px 0; margin-bottom: 30px; }
            .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
            h2 { margin: 0; color: #111827; }
        </style>
    </head>
    <body>
        <nav>
            <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="font-weight: bold; color: #4f46e5;">DATA CENTER PRO</div>
                <div style="display: flex; gap: 20px;">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('resources.index') }}">Resources</a>
                    <a href="{{ route('reservations.index') }}">Reservations</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-weight:500;">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        @isset($header)
            <div class="header-bg">
                <div class="container">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <main class="container">
            {{ $slot }}
        </main>
    </body>
</html>