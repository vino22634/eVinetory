<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="container_auth_form">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="auth_error_msg" />
        </div>

        <div class="button_reset_form">
            <x-primary-button>
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
