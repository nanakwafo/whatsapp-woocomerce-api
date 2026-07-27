<x-guest-layout>
    <div class="mb-7">
        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-3xl mx-auto mb-4 text-center">🔒</div>
        <h2 class="text-2xl font-bold text-gray-900 text-center">Confirm your password</h2>
        <p class="mt-2 text-sm text-gray-500 text-center">
            This is a secure area. Please enter your password to continue.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3 text-sm rounded-xl">
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</x-guest-layout>
