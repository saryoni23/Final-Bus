@extends('layouts.front')

@section('front')
<div class="wrapper">

    <!-- Navbar -->
    <x-front-dashboard-navbar></x-front-dashboard-navbar>
    <!-- /.Navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
            <img src="{{ asset('dist/img/ticbusLogo.png') }}" alt="ticbus Logo">
        </a>

        <!-- Sidebar Menu -->
        <x-front-sidemenu></x-front-sidemenu>
        <!-- /.sidebar Menu -->

    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">


            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        @endsection