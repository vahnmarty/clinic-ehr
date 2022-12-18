<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Home')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <style>
            [x-cloak]{
                display: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        
        <div x-data x-on:refresh-browser.window="setTimeout(() => {location.reload()}, 3000)"></div>

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="grid items-center grid-cols-3">
                            <div class="col-span-2">
                                {{ $header }}
                            </div>
                            {{ $rightHeader ?? ''}}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="py-3 text-xs text-gray-400 bg-indigo-900">
                <div class="wrapper">
                    <div class="flex justify-between">
                        <p>Developed by 
                            <a href="https://www.fortlewis.edu/academics/schools-departments/departments/sociology-human-services-department/faculty/waddell">@waddell</a> & <a href="https://vahnmarty.github.io/" target="_blank">@vahnmarty</a></p>
                        <div>
                            <p>{{ config('app.name') }} &copy {{ date('Y') }}</p>
                        </div>
                        <div>
                            <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
        <x-livewire-alert::scripts />
        @livewire('notifications')
        @livewire('search-patient')
        @stack('scripts')
    </body>
</html>
