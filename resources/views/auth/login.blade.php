<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-row gap-4">
            <x-authentication-card-logo />
            <!-- <h1 class='text-3xl font-bold'> Moria</h1> -->
        </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
       

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 relative">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <button type="button" id="togglePassword" class="absolute inset-y-10 right-0 flex items-center pr-3 focus:outline-none">
                    <span id="toggleButtonText" class="text-gray-500 dark:text-yellow-600">Tampilkan</span>
                </button>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm dark:text-white text-gray-600">{{ __('Ingat Saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>

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
