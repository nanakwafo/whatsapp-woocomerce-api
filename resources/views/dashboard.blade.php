<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Licenses</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage your WaOrders plugin licenses</p>
                </div>
                @if($licenses->count() > 0)
                    <div class="flex items-center gap-2 text-sm text-gray-500 bg-white border border-gray-100 rounded-xl px-4 py-2 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        {{ $licenses->count() }} {{ Str::plural('license', $licenses->count()) }}
                    </div>
                @endif
            </div>

            @forelse($licenses as $license)
                @php $isExpired = $license->expires_at->isPast(); @endphp
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-4 overflow-hidden hover:shadow-md transition">

                    <!-- Card Header -->
                    <div class="flex items-start justify-between p-6 pb-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full
                                    {{ $isExpired ? 'bg-red-50 text-red-600' : 'bg-green-50 text-primary' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isExpired ? 'bg-red-400' : 'bg-primary' }}"></span>
                                    {{ $isExpired ? 'Expired' : 'Active' }}
                                </span>
                                <span class="text-xs text-gray-400">
                                    Expires {{ $license->expires_at->toFormattedDateString() }}
                                </span>
                            </div>

                            <!-- License Key with copy -->
                            <div x-data="{ copied: false }" class="flex items-center gap-2 mt-1">
                                <code class="text-sm font-mono font-semibold text-gray-800 bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 truncate max-w-sm">
                                    {{ $license->key }}
                                </code>
                                <button
                                    @click="navigator.clipboard.writeText('{{ $license->key }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="flex-shrink-0 p-1.5 text-gray-400 hover:text-primary rounded-lg hover:bg-green-50 transition"
                                    title="Copy license key">
                                    <svg x-show="!copied" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <svg x-show="copied" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                                <span x-show="copied" x-transition class="text-xs text-primary font-medium">Copied!</span>
                            </div>
                        </div>
                    </div>

                    <!-- Activated Domains -->
                    <div class="px-6 pb-6">
                        <div class="pt-4 border-t border-gray-50">
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Activated Domains</p>
                            @if($license->activated_domains && count($license->activated_domains) > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($license->activated_domains as $domain)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 font-mono">
                                            <svg class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                            </svg>
                                            {{ $domain }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    No domains activated yet
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center text-3xl mx-auto mb-5">🔑</div>
                    <h3 class="text-lg font-bold text-gray-900">No licenses yet</h3>
                    <p class="mt-2 text-sm text-gray-500 max-w-xs mx-auto">
                        Purchase a WaOrders license to connect your WooCommerce store to WhatsApp.
                    </p>
                    <a href="/#pricing" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primaryDark transition shadow-md shadow-green-100 text-sm">
                        Buy a License
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
