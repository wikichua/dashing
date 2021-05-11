<x-dashing::guest-layout>
    <x-dashing::auth-card>

        <x-slot name="message">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
        </x-slot>

        <x-dashing::auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="mt-4 text-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <x-dashing::button class="ml-4" class="w-100 btn btn-lg btn-primary" type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-dashing::button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @honeypot
                <button type="submit" class="btn btn-link">
                    {{ __('Log out') }}
                </button>
            </form>
        </div>
    </x-dashing::auth-card>
</x-dashing::guest-layout>
