<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <nav class="mt-2">
        <ul class="nav" data-widget="treeview" role="menu" data-accordion="false">
            <div class="pb-3 mt-3 mb-3 user-panel d-flex align-items-right">
                <x-dropdown align="Left">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button
                            class="text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                            <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                    </x-slot>
                </x-dropdown>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ Request::is('/user/profile') || Request::is('logout') ? 'active' : '' }}">
                        <i class="fa-regular fa-gear"></i>
                        <p>
                            {{
                            Auth::user()->name
                            }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/user/profile" class="nav-link">
                                <i class="far fa-circle nav-icon"
                                    style="color	: {{ Request::is('/user/profile') ? 'rgb(0, 141, 193)' : '' }}"></i>
                                    {{ __('Profil') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="nav-link">
                                @csrf
    
                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                                    <i class="far fa-circle nav-icon"
                                    style="color	: {{ Request::is('/logout') ? 'rgb(0, 141, 193)' : '' }}"></i>
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                           
                        </li>
                    </ul>
                </li>
            </div>
        </ul>
    </nav>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
															with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <?php
                $url = $_SERVER['PHP_SELF'];
                $url = explode('/', $url);
                $lastPart = array_pop($url);
                if ($lastPart == 'index.php') {
                    echo '<a href="./../" class="nav-link">';
                } else {
                    echo '<a href="../../" class="nav-link">';
                }
                ?>
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Halaman Utama
                </p>
                </a>
            </li>
            <li class="nav-header">MENUS</li>
            <li class="nav-item menu-open">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/tickets" class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>
                        Daftar Tiket
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/orders/create" class="nav-link {{ Request::is('orders/create') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Buat Pesanan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ Request::is('transactions') || Request::is('orders') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>
                        Riwayat
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/orders" class="nav-link">
                            <i class="far fa-circle nav-icon"
                                style="color	: {{ Request::is('orders') ? 'rgb(0, 141, 193)' : '' }}"></i>
                            <p>Pesanan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transactions" class="nav-link">
                            <i class="far fa-circle nav-icon"
                                style="color	: {{ Request::is('transactions') ? 'rgb(0, 141, 193)' : '' }}"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                </ul>
            </li>
            @can('isAdmin')
            <li class="nav-item">
                <a href="/users" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="/transportasi" class="nav-link {{ Request::is('transportasi') ? 'active' : '' }}">
                    📜
                    <p>
                        transportasi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="/types" class="nav-link {{ Request::is('types') ? 'active' : '' }}">
                    📝
                    <p>
                        Kelas transportasi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/tracks" class="nav-link {{ Request::is('tracks') ? 'active' : '' }}">
                    📚
                    <p>
                        Rute
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="/methods" class="nav-link {{ Request::is('methods') ? 'active' : '' }}">
                    💳
                    <p>
                        Metode Pembayaran
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
            </li> -->
            @endcan
            @can('isKaryawan')
           
      
            @endcan
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>