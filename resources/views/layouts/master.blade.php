<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 text-white">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 p-6 text-gray-300 transition-all duration-300" id="sidebar">
        <h2 class="text-lg font-semibold text-white">Dashboard</h2>
        <nav class="mt-6">
            <ul>
                <li class="mb-4">
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Inicio</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('monitors') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Monitores</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</div>

</body>
</html>
