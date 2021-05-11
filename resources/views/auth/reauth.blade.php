<x-dashing::guest-layout>
    <x-dashing::auth-card>
        <x-slot name="message">
            {{ __('Please confirm your password before continuing.') }}
        </x-slot>

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('reauth.confirm') }}">
            @csrf
            @honeypot
            <div class="mt-4">
                <x-dashing::label for="password" :value="__('Password')" />
                <x-dashing::input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" :placeholder="__('Password')" />
            </div>
            <div class="text-center mt-3">
                <x-dashing::button class="w-100 btn btn-lg btn-primary" type="submit">
                    {{ __('Confirm Password') }}
                </x-dashing::button>
            </div>
        </form>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
