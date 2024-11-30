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
                <header class="shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                <a href="https://api.whatsapp.com/send?phone=554188365737&amp;text=" target="_blank" aria-describedby="a11y-external-message">
                    <img src="https://cdn.shopify.com/s/files/1/0865/5205/2017/files/whatsapp_7.webp?v=1723170638" style="height:60px; position:fixed; bottom:62px; right:28px; z-index:10;" data-selector="img">
                </a>
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
