<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WaOrders – WooCommerce WhatsApp Orders</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" class="" alt="WaOrders Logo" style="width: 10rem;
    height: 8rem;">
                <span class="text-xl font-bold text-gray-900">WaOrders</span>
            </div>

            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-primary">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-primary">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-medium hover:text-primary">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Text -->
            <div>
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    Sell on WhatsApp<br>
                    <span class="text-primary">Directly from WooCommerce</span>
                </h1>

                <p class="mt-6 text-lg text-gray-600">
                    WaOrders connects your WooCommerce store to WhatsApp, allowing customers
                    to place orders instantly — no checkout friction, no abandoned carts.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-md font-semibold hover:bg-primaryDark transition"
                    >
                        Get Started
                    </a>

                    <a
                        href="#pricing"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md font-semibold hover:bg-gray-100 transition"
                    >
                        Buy License
                    </a>
                </div>
            </div>

            <!-- Visual -->
            <div class="relative">
                <div class="rounded-xl shadow-lg bg-white p-6">
                    <img
                        src="{{ asset('images/waorders-preview.png') }}"
                        alt="WaOrders Preview"
                        class="rounded-lg"
                        onerror="this.style.display='none'"
                    >
                    <div class="text-center text-gray-500 text-sm">
                        WhatsApp-powered WooCommerce ordering
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Features -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">
            <div>
                <h3 class="font-semibold text-lg">⚡ Instant Orders</h3>
                <p class="mt-3 text-gray-600 text-sm">
                    Customers place orders directly via WhatsApp chat.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-lg">🔐 License-Based Access</h3>
                <p class="mt-3 text-gray-600 text-sm">
                    Secure plugin activation with license keys.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-lg">📦 WooCommerce Native</h3>
                <p class="mt-3 text-gray-600 text-sm">
                    Works seamlessly with existing WooCommerce stores.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 text-center text-sm text-gray-500">
        © {{ date('Y') }} WaOrders. All rights reserved.
    </footer>

</body>
</html>
