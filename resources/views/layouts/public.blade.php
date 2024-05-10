<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="font-sans min-h-screen bg-gray-900 text-gray-100 antialiased">
        <!-- Navigation -->
        @include('layouts.partials.navigation')
        <div class=" flex flex-col dark:bg-gray-900">
            <div class="w-full mx-auto max-w-7xl px-6 py-4">
                {{ $slot }}
            </div>
        </div>
        @livewireScripts
    </body>
</html>
