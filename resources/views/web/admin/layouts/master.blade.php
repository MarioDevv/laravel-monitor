<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Laravel')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50">

        @if (session('error'))
            <x-admin::alert error="{{ session('error') }}" />
        @endif

        <main class="mx-auto flex h-[100vh] items-center justify-center overflow-auto p-6">
            <div>
                @yield('content')
            </div>
        </main>


        <script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
    </body>
</html>
