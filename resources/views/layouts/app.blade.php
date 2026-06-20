<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Gradient background -->
    <div class="min-h-screen bg-gradient-to-br from-pink-400 via-purple-500 to-indigo-600 dark:from-gray-900 dark:via-gray-800 dark:to-black">

        <!-- Navigation -->
        <header class="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-600 p-4 text-white shadow-lg">
            <div class="flex justify-between items-center max-w-7xl mx-auto">
                <h1 class="text-2xl font-bold">
                    @if(Auth::user()->role === 'seller')
                        🏬 Seller Dashboard
                    @elseif(Auth::user()->role === 'buyer')
                        🛒 Buyer Dashboard
                    @elseif(Auth::user()->role === 'admin')
                        ⚙️ Admin Dashboard
                    @elseif(Auth::user()->role === 'regulator')
                        📊 Regulator Dashboard
                    @else
                        Dashboard
                    @endif
                </h1>
                <nav class="space-x-6">
                    <!-- Role-aware dashboard link -->
                    <a href="{{ route('dashboard') }}" class="hover:text-yellow-300">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="hover:text-yellow-300">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-yellow-300">Log Out</button>
                    </form>
                </nav>
            </div>
        </header>

        <!-- Page Heading -->
        @isset($header)
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-xl font-semibold text-gray-800 dark:text-gray-200">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Page Content -->
        <main>
            <div class="max-w-6xl mx-auto mt-10 bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-10">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
                const toggle = document.getElementById('theme-toggle');
                if (toggle) toggle.textContent = '☀️';
            }

            const toggle = document.getElementById('theme-toggle');
            if (toggle) {
                toggle.addEventListener('click', function() {
                    document.documentElement.classList.toggle('dark');
                    if (document.documentElement.classList.contains('dark')) {
                        localStorage.setItem('theme', 'dark');
                        toggle.textContent = '☀️';
                    } else {
                        localStorage.setItem('theme', 'light');
                        toggle.textContent = '🌙';
                    }
                });
            }
        });
    </script>
</body>
</html>
