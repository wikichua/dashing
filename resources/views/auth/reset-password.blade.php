<x-dashing::guest-layout>
    <x-dashing::auth-card>
        <x-slot name="message">
            {{ __('This is a secure area of the application. Please rest your password.') }}
        </x-slot>

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @honeypot
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mt-4">
                <x-dashing::label for="email" :value="__('Email')" />
                <x-dashing::input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-dashing::label for="password" :value="__('Password')" />
                <x-dashing::input id="password" class="form-control form-control-lg" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <x-dashing::label for="password_confirmation" :value="__('Confirm Password')" />
                <x-dashing::input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required />
            </div>

            <div class="text-center mt-4">
                <x-dashing::button class="ml-4" class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Reset Password') }}
                </x-dashing::button>
            </div>
        </form>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
