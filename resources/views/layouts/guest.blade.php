<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WaOrders') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">

            <!-- Left: Brand Panel -->
            <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-gradient-to-br from-primary to-primaryDark relative overflow-hidden flex-col items-center justify-center p-12">
                <div class="absolute inset-0 pointer-events-none opacity-10">
                    <div class="absolute -top-20 -left-20 w-80 h-80 bg-white rounded-full"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full"></div>
                </div>
                <div class="relative text-white max-w-xs text-center">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center text-3xl font-extrabold mx-auto mb-6 shadow-lg">
                        W
                    </div>
                    <h1 class="text-4xl font-extrabold leading-tight">WaOrders</h1>
                    <p class="mt-4 text-white/75 text-base leading-relaxed">
                        The easiest way to sell via WhatsApp from your WooCommerce store.
                    </p>
                    <div class="mt-10 space-y-3 text-left">
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                            <span class="text-xl">⚡</span>
                            <span class="text-sm font-medium">Instant WhatsApp orders</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                            <span class="text-xl">🔐</span>
                            <span class="text-sm font-medium">Domain-locked license keys</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                            <span class="text-xl">📦</span>
                            <span class="text-sm font-medium">WooCommerce-native plugin</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Form Panel -->
            <div class="flex-1 flex flex-col items-center justify-center p-6 sm:p-10 bg-gray-50">
                <div class="w-full max-w-md">
                    <!-- Mobile logo -->
                    <div class="mb-8 text-center lg:hidden">
                        <a href="/" class="inline-flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white font-bold text-xl shadow-sm">W</div>
                            <span class="text-2xl font-extrabold text-gray-900">WaOrders</span>
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
                        {{ $slot }}
                    </div>

                    <p class="mt-6 text-center text-sm text-gray-400">
                        <a href="/" class="hover:text-primary transition font-medium">← Back to homepage</a>
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
