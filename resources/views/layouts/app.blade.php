<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SF-AdTech</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
        <noscript>
        <div style="padding: 1rem; background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; margin: 0; text-align: center; z-index: 9999; position: relative;">
            <p><strong>Внимание!</strong> Для корректной работы всех функций этого сайта включите JavaScript в настройках вашего браузера. Некоторые интерактивные элементы могут не работать.</p>
        </div>
    </noscript>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SF-AdTech</a>
            <div class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                        <a class="nav-link" href="{{ route('admin.system-stats') }}">System Stats</a>
                        <a class="nav-link" href="{{ route('admin.pending-users') }}">Pending</a>
                    @elseif(auth()->user()->role === 'advertiser')
                        <a class="nav-link" href="{{ route('advertiser.dashboard') }}">Advertiser</a>
                    @elseif(auth()->user()->role === 'webmaster')
                        <a class="nav-link" href="{{ route('webmaster.dashboard') }}">Webmaster</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>