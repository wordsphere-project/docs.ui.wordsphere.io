<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @wordsphereuiStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans min-h-screen bg-slate-900 text-gray-100 antialiased">
        @include('layouts.partials.navigation')
        <div class="flex flex-col dark:bg-slate-900 ">
            <div class="w-full mx-auto max-w-7xl px-6">
                <div class="grid grid-cols-10 gap-4">
                    <div class="col-span-2">
                        <aside class="py-8 border-r border-gray-700 h-[calc(100vh-(var(--header-height)+1px))] overflow-hidden lg:sticky lg:top-[--header-height]">
                            <select>
                                <option>WordSphere v1.0.0</option>
                                <option>WordSphere v0.0.0</option>
                            </select>
                        </aside>
                    </div>
                    <div class="col-span-8">
                        <div class="grid grid-cols-10 gap-4">
                            <div class="col-span-8">
                                Content
                            </div>
                            <div class="col-span-2">
                                Table of contents
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
