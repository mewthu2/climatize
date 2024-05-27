<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '4Climatize - Web') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen" style="background: #36384f;">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="shadow" style="background-image: repeating-radial-gradient(circle at 0 0, transparent 0, #0b1134 20px), repeating-linear-gradient(rgb(25 33 66), #131431);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            
            <main class="mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200" style="min-height: 800px; backgrond-color: rgb(36 38 43);">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')
        <x-footer ></x-footer >
        @livewireScripts
    </body>
</html>
