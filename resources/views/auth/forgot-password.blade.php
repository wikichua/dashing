<x-dashing::guest-layout>
    <x-dashing::auth-card>
        <x-slot name="message">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </x-slot>

        <x-dashing::auth-session-status class="mb-4" :status="session('status')" />

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @honeypot
            <div class="mt-4">
                <x-dashing::label for="email" :value="__('Email')" />
                <x-dashing::input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus :placeholder="__('Email')" />
            </div>
            <div class="text-center mt-4">
                <a class="text-decoration-none" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                @if (Route::has('register'))
                    &nbsp;|&nbsp;
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>
            <div class="text-center mt-4">
                <x-dashing::button class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Email Password Reset Link') }}
                </x-dashing::button>
            </div>
        </form>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
