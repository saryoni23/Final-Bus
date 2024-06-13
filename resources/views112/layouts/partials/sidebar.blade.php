<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <li>
                <a href="/"
                    class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 3a2 2 0 0 0-2 2v5h18V5a2 2 0 0 0-2-2H5ZM3 14v-2h18v2a2 2 0 0 1-2 2h-6v3h2a1 1 0 1 1 0 2H9a1 1 0 1 1 0-2h2v-3H5a2 2 0 0 1-2-2Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="ml-3" sidebar-toggle-item>Frontend</span>
                </a>
            </li>
            <x-responsive-nav-link href="/dashboard" wire:navigate :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @can('isAdmin')
            <x-responsive-nav-link href="{{ route('transportasi.index') }}" wire:navigate
                :active="request()->routeIs('transportasi.index')">
                {{ __('Transportasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('types.index') }}" wire:navigate
                :active="request()->routeIs('types.index')">
                {{ __('Kelas Transportasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tracks.index') }}" wire:navigate
                :active="request()->routeIs('tracks.index')">
                {{ __('Rute Transportasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('tickets.index') }}" wire:navigate
                :active="request()->routeIs('tickets.index')">
                {{ __('Daftar Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.create') }}" wire:navigate
                :active="request()->routeIs('orders.create')">
                {{ __('Pesan Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('transactions.index') }}" wire:navigate
                :active="request()->routeIs('transactions.index')">
                {{ __('Riwayat Transaksi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.index') }}" wire:navigate
                :active="request()->routeIs('orders.index')">
                {{ __('Riwayat Pesanan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('users.index') }}" wire:navigate
                :active="request()->routeIs('users.index')">
                {{ __('User') }}
            </x-responsive-nav-link>
            @endcan
            @can('isKaryawan')
            <x-responsive-nav-link href="{{ route('tickets.index') }}" wire:navigate
                :active="request()->routeIs('tickets.index')">
                {{ __('Daftar Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.create') }}" wire:navigate
                :active="request()->routeIs('orders.create')">
                {{ __('Pesan Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('transactions.index') }}" wire:navigate
                :active="request()->routeIs('transactions.index')">
                {{ __('Riwayat Transaksi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.index') }}" wire:navigate
                :active="request()->routeIs('orders.index')">
                {{ __('Riwayat Pesanan') }}
            </x-responsive-nav-link>
            @endcan

            @can('isCustomer')
            <x-responsive-nav-link href="{{ route('tickets.index') }}" wire:navigate
                :active="request()->routeIs('tickets.index')">
                {{ __('Daftar Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.create') }}" wire:navigate
                :active="request()->routeIs('orders.create')">
                {{ __('Pesan Tiket') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('transactions.index') }}" wire:navigate
                :active="request()->routeIs('transactions.index')">
                {{ __('Riwayat Transaksi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('orders.index') }}" wire:navigate
                :active="request()->routeIs('orders.index')">
                {{ __('Riwayat Pesanan') }}
            </x-responsive-nav-link>
            @endcan
        </ul>
    </div>
</aside>