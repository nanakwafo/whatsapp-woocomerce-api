<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WaOrders – WooCommerce WhatsApp Orders</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-800">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-white font-bold text-lg shadow-sm">W</div>
                <span class="text-xl font-bold text-gray-900">WaOrders</span>
            </a>
            <nav class="flex items-center gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-lg hover:bg-primaryDark transition shadow-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition">
                        Sign in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-lg hover:bg-primaryDark transition shadow-sm">
                            Get Started
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-gradient-to-br from-green-50 via-white to-emerald-50 py-24 lg:py-32">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-32 -right-32 w-[500px] h-[500px] bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 w-[400px] h-[400px] bg-emerald-400/10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-6">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        WhatsApp × WooCommerce Integration
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight tracking-tight">
                        Sell on WhatsApp<br>
                        <span class="text-primary">From Your Store</span>
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-lg">
                        WaOrders connects your WooCommerce store to WhatsApp — customers place orders directly via chat. No checkout friction, no abandoned carts.
                    </p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary text-white rounded-xl font-semibold hover:bg-primaryDark transition shadow-lg shadow-green-200">
                            Start for Free
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="#pricing" class="inline-flex items-center px-7 py-3.5 border border-gray-200 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 transition">
                            View Pricing
                        </a>
                    </div>
                    <div class="mt-8 flex items-center gap-6 text-sm text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="text-primary font-bold">✓</span> No credit card needed</span>
                        <span class="flex items-center gap-1.5"><span class="text-primary font-bold">✓</span> 5-minute setup</span>
                    </div>
                </div>

                <!-- WhatsApp chat mock -->
                <div class="relative">
                    <div class="rounded-2xl shadow-2xl bg-white p-6 border border-gray-100 max-w-sm mx-auto">
                        <div class="flex items-center gap-3 pb-4 mb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">W</div>
                            <div>
                                <p class="font-semibold text-sm text-gray-900">WaOrders Bot</p>
                                <p class="text-xs text-primary">● Online</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-end gap-2">
                                <div class="bg-green-50 rounded-2xl rounded-bl-none px-3.5 py-2 text-sm text-gray-700 max-w-[200px]">
                                    Hi! I'd like the Blue Sneakers, size 42 🛍️
                                </div>
                            </div>
                            <div class="flex items-end gap-2 justify-end">
                                <div class="bg-primary rounded-2xl rounded-br-none px-3.5 py-2 text-sm text-white max-w-[220px]">
                                    Order #1042 confirmed! Total: $89. Ships in 2–3 days ✅
                                </div>
                            </div>
                            <div class="flex items-end gap-2">
                                <div class="bg-green-50 rounded-2xl rounded-bl-none px-3.5 py-2 text-sm text-gray-700">
                                    Can I pay by card?
                                </div>
                            </div>
                            <div class="flex items-end gap-2 justify-end">
                                <div class="bg-primary rounded-2xl rounded-br-none px-3.5 py-2 text-sm text-white max-w-[200px]">
                                    Yes! Here's your secure payment link 🔗
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-primary/15 rounded-2xl -z-10"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-emerald-200/50 rounded-xl -z-10"></div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="py-20 bg-white" id="features">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-14">
                    <h2 class="text-3xl font-bold text-gray-900">Everything you need to sell via WhatsApp</h2>
                    <p class="mt-3 text-gray-500">Built specifically for WooCommerce store owners</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="p-7 rounded-2xl border border-gray-100 hover:border-primary/40 hover:shadow-lg transition group cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-2xl mb-5 group-hover:bg-primary/10 transition">⚡</div>
                        <h3 class="font-bold text-lg text-gray-900">Instant Orders</h3>
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed">Customers place orders via WhatsApp chat — no checkout flow, no friction, higher conversion.</p>
                    </div>
                    <div class="p-7 rounded-2xl border border-gray-100 hover:border-primary/40 hover:shadow-lg transition group cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-2xl mb-5 group-hover:bg-primary/10 transition">🔐</div>
                        <h3 class="font-bold text-lg text-gray-900">License-Based Access</h3>
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed">Secure plugin activation with domain-locked license keys managed from your dashboard.</p>
                    </div>
                    <div class="p-7 rounded-2xl border border-gray-100 hover:border-primary/40 hover:shadow-lg transition group cursor-default">
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-2xl mb-5 group-hover:bg-primary/10 transition">📦</div>
                        <h3 class="font-bold text-lg text-gray-900">WooCommerce Native</h3>
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed">Installs as a plugin. Works with your existing products, orders, and inventory seamlessly.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section class="py-20 bg-gray-50" id="pricing">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-14">
                    <h2 class="text-3xl font-bold text-gray-900">Simple, transparent pricing</h2>
                    <p class="mt-3 text-gray-500">No surprises. Cancel anytime.</p>
                </div>
                <div class="max-w-sm mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-br from-primary to-primaryDark p-8 text-white text-center">
                        <p class="text-sm font-medium uppercase tracking-widest text-green-100">Per-site license</p>
                        <div class="mt-2 text-6xl font-extrabold">$49</div>
                        <p class="text-green-100 text-sm mt-1">per year</p>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-green-100 text-primary flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span> 1 WooCommerce site</li>
                            <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-green-100 text-primary flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span> Unlimited WhatsApp orders</li>
                            <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-green-100 text-primary flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span> License key management</li>
                            <li class="flex items-center gap-2.5"><span class="w-5 h-5 rounded-full bg-green-100 text-primary flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span> 1 year of updates & support</li>
                        </ul>
                        <a href="{{ route('register') }}" class="mt-7 block w-full py-3.5 bg-primary text-white font-semibold rounded-xl hover:bg-primaryDark transition text-center shadow-md shadow-green-100">
                            Buy License
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-10 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-400">
            <a href="/" class="flex items-center gap-2 text-gray-600 hover:text-primary transition">
                <div class="w-6 h-6 rounded-lg bg-primary flex items-center justify-center text-white text-xs font-bold">W</div>
                <span class="font-semibold">WaOrders</span>
            </a>
            <p>© {{ date('Y') }} WaOrders. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
