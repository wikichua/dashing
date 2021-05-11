<x-dashing::guest-layout>
    <x-dashing::auth-card>
        <x-slot name="message">
            Welcome!<br />Please Sign In
        </x-slot>

        <x-dashing::auth-session-status class="mb-4" :status="session('status')" />

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @honeypot
            <div class="mt-4">
                <x-dashing::label for="email" :value="__('Email')" />
                <x-dashing::input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus :placeholder="__('Email')" />
            </div>
            <div class="mt-4">
                <x-dashing::label for="password" :value="__('Password')" />
                <x-dashing::input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" :placeholder="__('Password')" />
            </div>
            <div class="mt-4 text-center">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                @if (Route::has('register'))
                    @if (Route::has('password.request'))
                    &nbsp;|&nbsp;
                    @endif
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>
            <div>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="remember" name="remember" checked>
                    <span class="form-check-label">
                        {{ __('Remember me') }}
                    </span>
                </label>
            </div>
            <div class="text-center mt-3">
                <x-dashing::button class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Log in') }}
                </x-dashing::button>
            </div>
        </form>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
