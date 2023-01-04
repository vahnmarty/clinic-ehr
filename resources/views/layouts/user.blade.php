<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

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
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="h-full font-sans antialiased">

    <div class="min-h-full">
        <div class="bg-gray-800 ">
            @include('includes.user.navigation')

            <header class="py-10">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header ?? '' }}
                </div>
            </header>
        </div>

        <main class="">
            <div class="px-4 pt-12 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                {{ $slot ?? '' }}
                @yield('content')
                <!-- /End replace -->
            </div>
        </main>
    </div>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    @livewire('notifications')
    @stack('scripts')

</body>

</html>
