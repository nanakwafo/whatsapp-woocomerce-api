<x-guest-layout>
    <div class="mb-7 text-center">
        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-3xl mx-auto mb-4">✉️</div>
        <h2 class="text-2xl font-bold text-gray-900">Verify your email</h2>
        <p class="mt-2 text-sm text-gray-500 leading-relaxed">
            We sent a verification link to your email address. Click the link to get started.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 px-4 py-3 bg-green-50 border border-green-100 rounded-xl text-sm text-green-700 font-medium text-center">
            A new verification link has been sent to your email.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center py-3 text-sm rounded-xl">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2.5 text-sm text-gray-500 hover:text-gray-700 font-medium transition rounded-xl hover:bg-gray-50">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
