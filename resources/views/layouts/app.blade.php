<!DOCTYPE html>
<html lang="en" class="h-full bg-stone-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AmarDokan - Bangladesh General Multivendor Marketplace')</title>
    <meta name="description" content="Shop groceries, electronics, home appliances, fashion and everyday consumer goods from verified sellers in Bangladesh.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#ea580c', // strong marketplace orange
                            hover: '#c2410c',
                            light: '#ffedd5',
                        },
                        charcoal: {
                            DEFAULT: '#1c1917',
                            muted: '#44403c',
                            light: '#78716c',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="min-h-full flex flex-col bg-stone-100 text-stone-900 antialiased">
    <!-- Header -->
    @include('components.header')

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm px-4 py-3 rounded-xl flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-900 text-sm px-4 py-3 rounded-xl flex items-center justify-between">
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Marketplace Footer -->
    <footer class="bg-stone-900 text-stone-300 mt-16 text-sm border-t border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Info -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-orange-600 flex items-center justify-center text-white font-extrabold text-base">
                            অ
                        </div>
                        <span class="font-bold text-lg text-white">AmarDokan <span class="text-orange-500">BD</span></span>
                    </div>
                    <p class="text-xs text-stone-400 leading-relaxed">
                        Bangladesh's premier multi-category digital marketplace connecting certified local merchants with millions of customers across all 64 districts.
                    </p>
                    <div class="text-xs text-stone-400">
                        Helpline: <strong class="text-white">09612-000000</strong> (9 AM - 10 PM)
                    </div>
                </div>

                <!-- Customer Care -->
                <div>
                    <h5 class="text-white font-bold text-sm mb-3">Customer Service</h5>
                    <ul class="space-y-2 text-xs text-stone-400">
                        <li><a href="#" class="hover:text-white">Help Center & FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Order Tracking (All 8 Divisions)</a></li>
                        <li><a href="#" class="hover:text-white">bKash & Nagad Payment Guide</a></li>
                        <li><a href="#" class="hover:text-white">Returns & Refund Policy</a></li>
                    </ul>
                </div>

                <!-- Sell with Us -->
                <div>
                    <h5 class="text-white font-bold text-sm mb-3">Sell on AmarDokan</h5>
                    <ul class="space-y-2 text-xs text-stone-400">
                        <li><a href="{{ route('vendor.dashboard') }}" class="hover:text-white">Vendor Registration</a></li>
                        <li><a href="#" class="hover:text-white">Seller Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white">Transparent 5-10% Commission</a></li>
                        <li><a href="#" class="hover:text-white">Bi-weekly Payouts (Bank/bKash)</a></li>
                    </ul>
                </div>

                <!-- Payment Assurance & Security -->
                <div>
                    <h5 class="text-white font-bold text-sm mb-3">Payment Methods</h5>
                    <p class="text-xs text-stone-400 mb-3">
                        Cash on Delivery across Bangladesh, with instant manual bKash & Nagad verification.
                    </p>
                    <div class="flex flex-wrap gap-2 text-xs font-bold">
                        <span class="px-2 py-1 bg-stone-800 text-stone-200 rounded border border-stone-700">Cash on Delivery</span>
                        <span class="px-2 py-1 bg-stone-800 text-stone-200 rounded border border-stone-700">bKash Personal/Merchant</span>
                        <span class="px-2 py-1 bg-stone-800 text-stone-200 rounded border border-stone-700">Nagad</span>
                        <span class="px-2 py-1 bg-stone-800 text-stone-200 rounded border border-stone-700">Local Bank Transfer</span>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-stone-800 flex flex-wrap justify-between items-center text-xs text-stone-500 gap-4">
                <div>&copy; {{ date('Y') }} AmarDokan Bangladesh. Production Multivendor Platform.</div>
                <div>Timezone: Asia/Dhaka | Currency: BDT (৳)</div>
            </div>
        </div>
    </footer>

    <!-- Guest Customer Authentication Modal Component -->
    @include('components.auth-modal')

    <script>
        window.IS_AUTHENTICATED_CUSTOMER = {{ auth()->check() && (auth()->user()->isCustomer() || auth()->user()->isAdmin()) ? 'true' : 'false' }};
        
        // Intercept any guest add to cart button click
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-require-auth="cart"]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    if (!window.IS_AUTHENTICATED_CUSTOMER) {
                        e.preventDefault();
                        e.stopPropagation();
                        const productId = btn.getAttribute('data-product-id') || '';
                        if (typeof openAuthModal === 'function') {
                            openAuthModal(productId, 'add_to_cart');
                        } else {
                            window.location.href = "{{ route('customer.login') }}";
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
