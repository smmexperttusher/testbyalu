<header class="bg-white border-b border-stone-200 sticky top-0 z-40 shadow-xs">
    <!-- Top Utility Bar: Bangladesh Context & Direct Access -->
    <div class="bg-stone-900 text-stone-300 text-xs py-1.5 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="bg-orange-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded tracking-wider">
                    BANGLADESH
                </span>
                <span class="hidden sm:inline text-stone-400">Currency: <strong>BDT (৳)</strong> | Timezone: <strong>Asia/Dhaka</strong></span>
                <span class="text-stone-400">Express Delivery: Inside Dhaka ৳60 / Outside ৳120</span>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="{{ route('vendor.register') }}" class="text-orange-400 hover:text-orange-300 font-medium">Become a Vendor</a>
                <span class="text-stone-700">|</span>
                <a href="{{ route('vendor.login') }}" class="hover:text-white">Vendor Login</a>
                <span class="text-stone-700">|</span>
                <a href="#" class="hover:text-white">Customer Help: 09612-000000</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
        <div class="flex items-center justify-between gap-4 lg:gap-8">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-extrabold text-xl shadow-xs group-hover:bg-orange-700 transition-colors">
                        অ
                    </div>
                    <div>
                        <div class="font-extrabold text-xl tracking-tight text-stone-900 leading-none">
                            Amar<span class="text-orange-600">Dokan</span>
                        </div>
                        <div class="text-[10px] font-semibold text-stone-500 uppercase tracking-wider mt-0.5">
                            Bangladesh Marketplace
                        </div>
                    </div>
                </a>
            </div>

            <!-- Desktop Search Bar -->
            <div class="hidden md:flex flex-1 max-w-2xl">
                <form action="{{ route('shop.index') }}" method="GET" class="w-full relative flex items-center">
                    <div class="relative w-full flex items-center">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search for products, brands and categories"
                            class="w-full pl-4 pr-12 py-2.5 bg-stone-100/80 border border-stone-300 rounded-xl text-sm text-stone-900 placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white transition-all"
                        />
                        <button
                            type="submit"
                            aria-label="Search"
                            class="absolute right-1.5 top-1.5 bottom-1.5 px-3.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg flex items-center justify-center transition-colors shadow-2xs"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Desktop Right Navigation Icons & Sell CTA -->
            <div class="hidden lg:flex items-center gap-5 shrink-0">
                <!-- Become a Vendor CTA -->
                <a
                    href="{{ route('vendor.register') }}"
                    class="bg-orange-50 hover:bg-orange-100 text-orange-700 hover:text-orange-800 border border-orange-200 text-xs font-bold px-3 py-2 rounded-lg transition-colors flex items-center gap-1.5"
                >
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Become a Vendor
                </a>

                <!-- Wishlist -->
                <a href="{{ auth()->check() ? route('customer.wishlist.index') : route('customer.login') }}" class="text-stone-600 hover:text-stone-900 flex flex-col items-center text-[11px] font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>Wishlist</span>
                </a>

                <!-- Cart -->
                <a href="{{ auth()->check() ? route('cart.index') : route('customer.login') }}" class="relative text-stone-600 hover:text-stone-900 flex flex-col items-center text-[11px] font-medium transition-colors">
                    <div class="relative">
                        <svg class="w-5 h-5 text-stone-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="absolute -top-1.5 -right-2 bg-orange-600 text-white font-black text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                            {{ auth()->check() && auth()->user()->cart ? auth()->user()->cart->total_quantity : 0 }}
                        </span>
                    </div>
                    <span>Cart</span>
                </a>

                <!-- Account & Authentication -->
                @auth
                    <div class="relative group">
                        <button class="text-stone-700 hover:text-stone-900 flex items-center gap-1.5 text-xs font-semibold py-1">
                            <div class="w-7 h-7 rounded-full bg-orange-100 border border-orange-200 flex items-center justify-center text-orange-700 text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="line-clamp-1 max-w-[90px]">{{ auth()->user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-stone-400 group-hover:text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-stone-200 py-2 hidden group-hover:block z-50">
                            <div class="px-4 py-2 border-b border-stone-100">
                                <p class="text-xs font-bold text-stone-900">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-stone-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600">
                                Customer Account
                            </a>
                            <a href="{{ route('customer.orders.index') }}" class="block px-4 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600">
                                My Orders
                            </a>
                            <a href="{{ route('customer.wishlist.index') }}" class="block px-4 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600">
                                Saved Wishlist
                            </a>
                            <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-xs text-stone-700 hover:bg-orange-50 hover:text-orange-600">
                                My Cart
                            </a>
                            <div class="border-t border-stone-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-red-50">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('customer.login') }}" class="text-stone-700 hover:text-orange-600 text-xs font-semibold px-2 py-1">
                            Customer Login
                        </a>
                        <a href="{{ route('customer.register') }}" class="bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold px-3 py-2 rounded-xl transition-colors shadow-2xs">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Action Bar (Search Icon, Cart, Menu) -->
            <div class="flex lg:hidden items-center gap-3">
                <a href="{{ auth()->check() ? route('cart.index') : route('customer.login') }}" class="relative p-2 text-stone-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="absolute top-1 right-1 bg-orange-600 text-white font-bold text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                        {{ auth()->check() && auth()->user()->cart ? auth()->user()->cart->total_quantity : 0 }}
                    </span>
                </a>

                <a href="{{ auth()->check() ? route('customer.dashboard') : route('customer.login') }}" class="p-2 text-stone-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Mobile Search Row -->
        <div class="md:hidden mt-2.5">
            <form action="{{ route('shop.index') }}" method="GET" class="relative">
                <input
                    type="text"
                    name="search"
                    placeholder="Search for products, brands and categories"
                    class="w-full pl-3.5 pr-10 py-2 bg-stone-100 border border-stone-300 rounded-lg text-xs text-stone-900 placeholder-stone-500 focus:outline-hidden focus:ring-1 focus:ring-orange-600"
                />
                <button type="submit" aria-label="Search" class="absolute right-2 top-2 bottom-2 text-stone-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
