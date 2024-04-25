<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }"
    x-bind:class="{'dark' : darkMode === true}"
    x-init="    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {localStorage.setItem('darkMode', JSON.stringify(true));    }    darkMode = JSON.parse(localStorage.getItem('darkMode'));    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    {{-- <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-DfZ-n7cB.css') }}">  --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client.key')}}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.js') }}"></script>
    <link href="{{ asset('plugins/select2/css/select2.css') }}" rel="stylesheet" />



    @livewireStyles
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-800">

    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>


   
    @stack('modals')

    @livewireScripts
</body>

</html>