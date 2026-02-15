<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold mb-6">
                My Licenses
            </h2>

            @forelse($licenses as $license)
                <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                    
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">
                                {{ $license->key }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Expires: {{ $license->expires_at->toFormattedDateString() }}
                            </p>
                        </div>

                        <div>
                            <span class="px-3 py-1 text-sm rounded-full
                                {{ $license->expires_at->isPast() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $license->expires_at->isPast() ? 'Expired' : 'Active' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 text-sm text-gray-600">
                        Activated Domains:
                        @if($license->activated_domains)
                            <ul class="list-disc ml-5 mt-2">
                                @foreach($license->activated_domains as $domain)
                                    <li>{{ $domain }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-400">No domains activated yet</p>
                        @endif
                    </div>

                </div>
            @empty
                <p>No licenses found.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
