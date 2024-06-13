<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-slot name="logo">
                <div class="flex flex-row gap-4">
                    <x-authentication-card-logo />
                    <!-- <h1 class='text-3xl font-bold'> Moria</h1> -->
                </div>
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                        autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="tgllahir" value="{{ __('Tanggal Lahir') }}" />
                    <x-input id="tgllahir" class="block w-full mt-1" type="date" name="tgllahir"
                        :value="old('tgllahir')" required autocomplete="date" />
                </div>
                <div class="mt-4">
                    <x-label for="no_hp" value="{{ __('No HP') }}" />
                    <x-input id="no_hp"
                        class="block mt-1 w-full form-input [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                        type="number" name="no_hp" :value="old('no_hp')" required autocomplete="date" />
                </div>

                <div class="relative mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-inputpassword type="password" name="password" class='dark:bg-gray-600' id="password" placeholder="••••••••" required />
                    <button type="button" id="togglePassword"
                        class="absolute right-0 flex items-center pr-3 inset-y-10 focus:outline-none">
                        <span id="toggleButtonText" class="text-yellow-500 dark:text-yellow-500">Tampilkan</span>
                    </button>
                </div>


                <div class="relative mt-4 ">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-inputpassword id="password_confirmation" class="block w-full mt-1 dark:bg-gray-600" type="password"
                        name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <button type="button" id="toggleConfirmPassword"
                        class="absolute right-0 flex items-center pr-3 inset-y-12 focus:outline-none">
                        <span id="toggleConfirmPasswordText" class="text-yellow-500 dark:text-yellow-500">Tampilkan</span>
                    </button>
                </div>
                <div class="hidden">
                    <x-input id="password" class="block w-full mt-1" type="password" name="is_admin" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('Saya setuju dengan :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Ketentuan Layanan').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Kebijakan pribadi').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
                @endif

                <div class="flex items-center justify-between mt-4">
                    <x-a href='/'>
                        {{ __('Kembali') }}
                    </x-a>
                    <div class="justify-end">
                        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Sudah Mendaftar?') }}
                        </a>

                        <x-button class="ms-4">
                            {{ __('Daftar') }}
                        </x-button>
                    </div>
                </div>
            </form>
    </x-authentication-card>
</x-guest-layout>
<script>
    const passwordInput = document.getElementById("password");
    const toggleButton = document.getElementById("togglePassword");
    const toggleButtonText = document.getElementById("toggleButtonText");

    toggleButton.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButtonText.textContent = "Sembunyikan";
        } else {
            passwordInput.type = "password";
            toggleButtonText.textContent = "Tampilkan";
        }
    });


    const confirmPasswordInput = document.getElementById("password_confirmation");
    const toggleConfirmPasswordButton = document.getElementById("toggleConfirmPassword");
    const toggleConfirmPasswordText = document.getElementById("toggleConfirmPasswordText");

    toggleConfirmPasswordButton.addEventListener("click", function () {
        if (confirmPasswordInput.type === "password") {
            confirmPasswordInput.type = "text";
            toggleConfirmPasswordText.textContent = "Sembunyikan";
        } else {
            confirmPasswordInput.type = "password";
            toggleConfirmPasswordText.textContent = "Tampilkan";
        }
    });

</script>
