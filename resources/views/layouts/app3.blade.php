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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <!-- <x-banner /> -->


    @livewire('navigation-menu')
    @guest
    @if (isset($header))
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif
    @else

    @if (Auth::user()->level != 'Admin')


    @endif
    @endguest
    @livewireScripts

    @yield('styles')
    </head>

    <body id="page-top">
        @guest
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>

        @else
        @if (Auth::user()->level == 'Admin')

        @yield('content')
        Copyright &copy; 2020
        @if (date('Y') != '2020')
        - {{ date('Y') }}
        @endif
        &nbsp; All rights reserved • by

        >.

        @else
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <div class="container mx-auto mt-5">
            @yield('content')
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container mx-auto">
                <div class="text-center py-3">
                    <span>
                        Copyright &copy;
                        @if (date('Y') != '2020')
                        {{ date('Y') }}
                        @endif
                        &nbsp; All rights reserved • by
                        <a href="" target="_blank">Saryoni</a>.
                    </span>
                </div>
            </div>
        </footer>
        @endif
        @endguest

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        <!-- Custom scripts for all pages-->


        @yield('script')

        @if (count($errors)>0)
        @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}");
        </script>
        @endforeach
        @endif
        @if (Session::has('success'))
        <script>
            toastr.success("{{ Session('success') }}");
        </script>
        @endif
        @if (Session::has('error'))
        <script>
            toastr.error("{{ Session('error') }}");
        </script>
        @endif
        @include('layouts.partials.footer')
    </body>

</html>
