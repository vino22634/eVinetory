@extends('layouts/auth')
@section('title', 'Inscription')
@section('content')
<x-guest-layout>
    <div>
        <form method="POST" action="{{ route('verification.send') }}" class="container_auth_form">
            @csrf

            <p>
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <p>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            @endif

            <div class="button_form">
                <x-primary-button class="button info">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="container_auth_form">
            @csrf

            <button type="button info button_reset">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
@endsection