<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            body { background-color: #f3f4f6; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; margin: 0; font-family: 'Figtree', sans-serif; }
            .login-card { width: 100%; max-width: 400px; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
            .logo-text { font-size: 2rem; font-weight: 800; color: #4f46e5; margin-bottom: 2rem; text-decoration: none; }
            input { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
            button { background: #4f46e5; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: 600; margin-top: 1rem; }
            .links { margin-top: 1rem; font-size: 0.875rem; color: #6b7280; text-align: center; }
        </style>
    </head>
    <body>
        <div>
            <a href="/" class="logo-text">
                DC-PRO
            </a>
        </div>

        <div class="login-card">
            {{ $slot }}
        </div>
    </body>
</html>