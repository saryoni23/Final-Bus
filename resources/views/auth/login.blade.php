<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-row gap-4">
            <x-authentication-card-logo />
            <!-- <h1 class='text-3xl font-bold'> Moria</h1> -->
        </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif
       

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="relative mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                <button type="button" id="togglePassword" class="absolute right-0 flex items-center pr-3 inset-y-10 focus:outline-none">
                    <span id="toggleButtonText" class="text-gray-500 dark:text-yellow-600">Tampilkan</span>
                </button>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="text-sm text-gray-600 ms-2 dark:text-white">{{ __('Ingat Saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-white hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script>
    const passwordInput = document.getElementById("password");
    const toggleButton = document.getElementById("togglePassword");
    const toggleButtonText = document.getElementById("toggleButtonText");

    toggleButton.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButtonText.textContent = "Sembunyikan";
        } else {
            passwordInput.type = "password";
            toggleButtonText.textContent = "Tampilkan";
        }
    });
</script>
