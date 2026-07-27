<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-5">

            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
                <p class="mt-1 text-sm text-gray-500">Manage your profile and account security</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white rounded-2xl border border-red-50 shadow-sm p-7">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
