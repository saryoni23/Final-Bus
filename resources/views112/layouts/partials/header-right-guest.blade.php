<div class="flex space-x-5">
    <x-nav-link class='dark:text-white' href="{{ route('login') }}" :active="request()->routeIs('login')">
        {{ __('Login') }}
    </x-nav-link>
    <x-nav-link class='dark:text-white' href="{{ route('register') }}" :active="request()->routeIs('register')">
        {{ __('Daftar') }}
    </x-nav-link>
</div>
