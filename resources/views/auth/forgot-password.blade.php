<x-guest-layout>
    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">Reset your password</h2>
        <p class="mt-1 text-sm text-gray-500">
            Enter your email and we'll send you a reset link.
        </p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3 text-sm rounded-xl">
            {{ __('Send Reset Link') }}
        </x-primary-button>

        <p class="text-center text-sm text-gray-500 pt-1">
            <a href="{{ route('login') }}" class="text-primary hover:text-primaryDark font-semibold transition">← Back to sign in</a>
        </p>
    </form>
</x-guest-layout>
