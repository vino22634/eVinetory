<x-guest-layout>
    <div>
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="container_auth_form">
        @csrf

        <!-- Password -->
        <div class="form_element">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="auth_error_msg" />
        </div>

        <div>
            <x-primary-button>
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
