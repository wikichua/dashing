<x-dashing::guest-layout>
    <x-dashing::auth-card>
        <x-slot name="message">
            Welcome!<br />Please Register
        </x-slot>

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            @honeypot
            <div class="mt-4">
                <x-dashing::label for="name" :value="__('Name')" />
                <x-dashing::input id="name" class="form-control form-control-lg" type="name" name="name" :value="old('name')" required />
            </div>
            <div class="mt-4">
                <x-dashing::label for="email" :value="__('Email')" />
                <x-dashing::input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required />
            </div>
            <div class="mt-4">
                <x-dashing::label for="password" :value="__('Password')" />
                <x-dashing::input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <x-dashing::label for="password_confirmation" :value="__('Confirm Password')" />
                <x-dashing::input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required />
            </div>

            <div class="text-center mt-4">
                <a class="text-decoration-none" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <div class="text-center mt-4">
                <x-dashing::button class="ml-4" class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Register') }}
                </x-dashing::button>
            </div>
        </form>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
