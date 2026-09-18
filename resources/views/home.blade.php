@extends('layouts.app')

@section('title', 'AmarDokan - Everything You Need. One Marketplace.')

@section('content')
<div class="space-y-10 sm:space-y-12 pb-20">
    <!-- ================= HERO SECTION ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6">
        <div class="bg-white rounded-2xl border border-stone-200 shadow-xs overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
                <!-- Left: Typography & CTAs -->
                <div class="lg:col-span-7 p-6 sm:p-10 lg:p-12 space-y-4 sm:space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/80 border border-orange-200 text-orange-800 text-xs font-bold tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-orange-600 animate-pulse"></span>
                        BANGLADESH MULTIVENDOR GENERAL STORE
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-stone-900 tracking-tight leading-tight">
                        Everything You Need.<br/>
                        <span class="text-orange-600">One Marketplace.</span>
                    </h1>

                    <p class="text-stone-600 text-sm sm:text-base max-w-xl leading-relaxed">
                        Shop groceries, electronics, fashion, home essentials, books, tools and more from trusted verified sellers across Bangladesh.
                    </p>

                    <!-- Hero Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a
                            href="{{ route('shop.index') }}"
                            class="bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold px-6 py-3 rounded-xl shadow-sm transition-colors flex items-center gap-2"
                        >
                            <span>Shop Now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a
                            href="#categories-section"
                            class="bg-stone-100 hover:bg-stone-200 text-stone-800 text-sm font-bold px-5 py-3 rounded-xl border border-stone-300 transition-colors"
                        >
                            Explore Categories
                        </a>
                    </div>

                    <!-- Marketplace Value Badges -->
                    <div class="pt-4 border-t border-stone-100 grid grid-cols-3 gap-2 sm:gap-4 text-[11px] sm:text-xs font-semibold text-stone-600">
                        <div class="flex items-center gap-1.5">
                            <span class="text-orange-600 font-bold">✓</span>
                            <span>Cash on Delivery</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-orange-600 font-bold">✓</span>
                            <span>bKash & Nagad</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-orange-600 font-bold">✓</span>
                            <span>64 Districts</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Multi-Category Visual Showcase -->
                <div class="lg:col-span-5 p-4 sm:p-6 lg:p-8 bg-stone-50 border-t lg:border-t-0 lg:border-l border-stone-200">
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <!-- Grocery Card -->
                        <div class="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs group hover:border-orange-500 transition-colors">
                            <div class="h-24 sm:h-28 rounded-lg bg-amber-50 overflow-hidden mb-2">
                                <img
                                    src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=500&auto=format&fit=crop&q=80"
                                    alt="Groceries"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                />
                            </div>
                            <div class="font-bold text-xs text-stone-900">Pantry & Groceries</div>
                            <div class="text-[10px] text-stone-500">Rice, Oil, Dal & Food</div>
                        </div>

                        <!-- Electronics Card -->
                        <div class="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs group hover:border-orange-500 transition-colors">
                            <div class="h-24 sm:h-28 rounded-lg bg-blue-50 overflow-hidden mb-2">
                                <img
                                    src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80"
                                    alt="Electronics"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                />
                            </div>
                            <div class="font-bold text-xs text-stone-900">Electronics & Phones</div>
                            <div class="text-[10px] text-stone-500">Mobiles, TV & Audio</div>
                        </div>

                        <!-- Home & Kitchen Card -->
                        <div class="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs group hover:border-orange-500 transition-colors">
                            <div class="h-24 sm:h-28 rounded-lg bg-emerald-50 overflow-hidden mb-2">
                                <img
                                    src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=500&auto=format&fit=crop&q=80"
                                    alt="Home & Appliances"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                />
                            </div>
                            <div class="font-bold text-xs text-stone-900">Home & Kitchen</div>
                            <div class="text-[10px] text-stone-500">Blenders, Cookware</div>
                        </div>

                        <!-- Beauty & Personal Care Card -->
                        <div class="bg-white rounded-xl p-3 border border-stone-200 shadow-2xs group hover:border-orange-500 transition-colors">
                            <div class="h-24 sm:h-28 rounded-lg bg-rose-50 overflow-hidden mb-2">
                                <img
                                    src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500&auto=format&fit=crop&q=80"
                                    alt="Beauty & Fashion"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                                />
                            </div>
                            <div class="font-bold text-xs text-stone-900">Beauty & Lifestyle</div>
                            <div class="text-[10px] text-stone-500">Skincare, Apparel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SHOP BY CATEGORY SECTION ================= -->
    <section id="categories-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-black text-stone-900 tracking-tight">Shop by Category</h2>
                <p class="text-xs text-stone-500 mt-0.5">Browse 14 distinct categories across general consumer goods</p>
            </div>
            <a href="{{ route('shop.index') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1">
                <span>View All</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4">
            @foreach($categories as $category)
                <a
                    href="{{ route('shop.category', $category->slug) }}"
                    class="bg-white rounded-xl p-3 border border-stone-200 hover:border-orange-500 shadow-2xs hover:shadow-xs transition-all flex flex-col items-center text-center group"
                >
                    <div class="w-14 h-14 rounded-xl bg-stone-100 flex items-center justify-center text-stone-700 group-hover:bg-orange-50 group-hover:text-orange-600 transition-colors mb-2">
                        @switch($category->slug)
                            @case('grocery')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                @break
                            @case('electronics')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @break
                            @case('fashion')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                @break
                            @case('beauty-personal-care')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                @break
                            @case('mobile-accessories')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                @break
                            @case('computers')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @break
                            @case('home-living')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                @break
                            @case('appliances')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                @break
                            @case('shoes-bags')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @break
                            @case('baby-kids')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @break
                            @case('sports-fitness')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                @break
                            @case('books-stationery')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                @break
                            @case('automotive')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h2"/></svg>
                                @break
                            @case('tools-hardware')
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                @break
                            @default
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                        @endswitch
                    </div>
                    <span class="font-bold text-xs text-stone-900 group-hover:text-orange-600 line-clamp-1">
                        {{ $category->name }}
                    </span>
                    <span class="text-[10px] text-stone-400 mt-0.5">
                        {{ $category->products_count }} items
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- ================= 1. FLASH DEALS SECTION ================= -->
    <x-product-section
        id="flash-deals"
        title="Flash Deals"
        subtitle="Limited-time price drops on groceries, phones, appliances & lifestyle essentials"
        badge="Limited Time"
        badgeColor="red"
        icon="⚡"
        :products="$flashDeals"
        :limit="10"
        seeMoreUrl="{{ route('shop.index') }}?filter=flash_deals"
        seeMoreText="See More Flash Deals"
    />

    <!-- ================= PROMOTIONAL BANNERS: GROCERY & TECH ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            @if(isset($promotionalBanners[0]))
                @php $b1 = $promotionalBanners[0]; @endphp
                <div class="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                    <img
                        src="{{ $b1['image'] }}"
                        alt="{{ $b1['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r {{ $b1['bg_gradient'] }}"></div>
                    <div class="relative z-10 space-y-2">
                        <span class="inline-block bg-amber-500 text-stone-950 font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                            {{ $b1['badge'] }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black tracking-tight">{{ $b1['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-stone-200 max-w-sm">{{ $b1['subtitle'] }}</p>
                    </div>
                    <div class="relative z-10 pt-4">
                        <a
                            href="{{ route('shop.category', $b1['category_slug']) }}"
                            class="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-orange-500 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                            <span>{{ $b1['link_text'] }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif

            @if(isset($promotionalBanners[1]))
                @php $b2 = $promotionalBanners[1]; @endphp
                <div class="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                    <img
                        src="{{ $b2['image'] }}"
                        alt="{{ $b2['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r {{ $b2['bg_gradient'] }}"></div>
                    <div class="relative z-10 space-y-2">
                        <span class="inline-block bg-sky-500 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                            {{ $b2['badge'] }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black tracking-tight">{{ $b2['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-stone-200 max-w-sm">{{ $b2['subtitle'] }}</p>
                    </div>
                    <div class="relative z-10 pt-4">
                        <a
                            href="{{ route('shop.category', $b2['category_slug']) }}"
                            class="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-sky-500 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                            <span>{{ $b2['link_text'] }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- ================= 2. BEST SELLERS SECTION ================= -->
    <x-product-section
        id="best-sellers"
        title="Best Sellers"
        subtitle="Most ordered items backed by real customer sales & delivery records"
        badge="Top Ordered"
        badgeColor="orange"
        icon="🔥"
        :products="$bestSellers"
        :limit="10"
        seeMoreUrl="{{ route('shop.index') }}?filter=best_sellers"
        seeMoreText="See More Best Sellers"
    />

    <!-- ================= CATEGORY-FOCUSED MARKETPLACE SECTIONS ================= -->
    {{-- 1. GROCERY & DAILY ESSENTIALS --}}
    @if(isset($categorySections['grocery']))
        <x-product-section
            id="category-grocery"
            :title="$categorySections['grocery']['meta']['title']"
            :subtitle="$categorySections['grocery']['meta']['subtitle']"
            :badge="$categorySections['grocery']['meta']['badge']"
            :badgeColor="$categorySections['grocery']['meta']['badgeColor']"
            :icon="$categorySections['grocery']['meta']['icon']"
            :products="$categorySections['grocery']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'grocery') }}"
            seeMoreText="See More in Grocery"
        />
    @endif

    {{-- 2. ELECTRONICS & GADGETS --}}
    @if(isset($categorySections['electronics']))
        <x-product-section
            id="category-electronics"
            :title="$categorySections['electronics']['meta']['title']"
            :subtitle="$categorySections['electronics']['meta']['subtitle']"
            :badge="$categorySections['electronics']['meta']['badge']"
            :badgeColor="$categorySections['electronics']['meta']['badgeColor']"
            :icon="$categorySections['electronics']['meta']['icon']"
            :products="$categorySections['electronics']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'electronics') }}"
            seeMoreText="See More Electronics"
        />
    @endif

    <!-- ================= PROMOTIONAL BANNERS: HOME & BEAUTY ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            @if(isset($promotionalBanners[2]))
                @php $b3 = $promotionalBanners[2]; @endphp
                <div class="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                    <img
                        src="{{ $b3['image'] }}"
                        alt="{{ $b3['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r {{ $b3['bg_gradient'] }}"></div>
                    <div class="relative z-10 space-y-2">
                        <span class="inline-block bg-emerald-500 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                            {{ $b3['badge'] }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black tracking-tight">{{ $b3['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-stone-200 max-w-sm">{{ $b3['subtitle'] }}</p>
                    </div>
                    <div class="relative z-10 pt-4">
                        <a
                            href="{{ route('shop.category', $b3['category_slug']) }}"
                            class="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-emerald-600 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                            <span>{{ $b3['link_text'] }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif

            @if(isset($promotionalBanners[4]))
                @php $b5 = $promotionalBanners[4]; @endphp
                <div class="relative rounded-2xl overflow-hidden min-h-[190px] sm:min-h-[220px] p-6 sm:p-8 flex flex-col justify-between text-white shadow-xs group">
                    <img
                        src="{{ $b5['image'] }}"
                        alt="{{ $b5['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r {{ $b5['bg_gradient'] }}"></div>
                    <div class="relative z-10 space-y-2">
                        <span class="inline-block bg-rose-500 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                            {{ $b5['badge'] }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black tracking-tight">{{ $b5['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-stone-200 max-w-sm">{{ $b5['subtitle'] }}</p>
                    </div>
                    <div class="relative z-10 pt-4">
                        <a
                            href="{{ route('shop.category', $b5['category_slug']) }}"
                            class="inline-flex items-center gap-1.5 bg-white text-stone-900 hover:bg-rose-600 hover:text-white font-bold text-xs px-4 py-2 rounded-xl transition-colors shadow-xs"
                        >
                            <span>{{ $b5['link_text'] }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- 3. FASHION & LIFESTYLE (Fashion must NOT dominate the homepage) --}}
    @if(isset($categorySections['fashion']))
        <x-product-section
            id="category-fashion"
            :title="$categorySections['fashion']['meta']['title']"
            :subtitle="$categorySections['fashion']['meta']['subtitle']"
            :badge="$categorySections['fashion']['meta']['badge']"
            :badgeColor="$categorySections['fashion']['meta']['badgeColor']"
            :icon="$categorySections['fashion']['meta']['icon']"
            :products="$categorySections['fashion']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'fashion') }}"
            seeMoreText="See More Fashion"
        />
    @endif

    {{-- 4. HOME & LIVING --}}
    @if(isset($categorySections['home-living']))
        <x-product-section
            id="category-home-living"
            :title="$categorySections['home-living']['meta']['title']"
            :subtitle="$categorySections['home-living']['meta']['subtitle']"
            :badge="$categorySections['home-living']['meta']['badge']"
            :badgeColor="$categorySections['home-living']['meta']['badgeColor']"
            :icon="$categorySections['home-living']['meta']['icon']"
            :products="$categorySections['home-living']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'home-living') }}"
            seeMoreText="See More Home & Living"
        />
    @endif

    {{-- 5. BEAUTY & PERSONAL CARE --}}
    @if(isset($categorySections['beauty-personal-care']))
        <x-product-section
            id="category-beauty"
            :title="$categorySections['beauty-personal-care']['meta']['title']"
            :subtitle="$categorySections['beauty-personal-care']['meta']['subtitle']"
            :badge="$categorySections['beauty-personal-care']['meta']['badge']"
            :badgeColor="$categorySections['beauty-personal-care']['meta']['badgeColor']"
            :icon="$categorySections['beauty-personal-care']['meta']['icon']"
            :products="$categorySections['beauty-personal-care']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'beauty-personal-care') }}"
            seeMoreText="See More Beauty"
        />
    @endif

    {{-- 6. MOBILE & ACCESSORIES --}}
    @if(isset($categorySections['mobile-accessories']))
        <x-product-section
            id="category-mobile"
            :title="$categorySections['mobile-accessories']['meta']['title']"
            :subtitle="$categorySections['mobile-accessories']['meta']['subtitle']"
            :badge="$categorySections['mobile-accessories']['meta']['badge']"
            :badgeColor="$categorySections['mobile-accessories']['meta']['badgeColor']"
            :icon="$categorySections['mobile-accessories']['meta']['icon']"
            :products="$categorySections['mobile-accessories']['products']"
            :limit="10"
            seeMoreUrl="{{ route('shop.category', 'mobile-accessories') }}"
            seeMoreText="See More Mobile & Gadgets"
        />
    @endif

    <!-- ================= PROMOTIONAL BANNER: FASHION DEALS ================= -->
    @if(isset($promotionalBanners[3]))
        @php $b4 = $promotionalBanners[3]; @endphp
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-2xl overflow-hidden min-h-[160px] sm:min-h-[190px] p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between text-white shadow-xs group gap-4">
                <img
                    src="{{ $b4['image'] }}"
                    alt="{{ $b4['title'] }}"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                />
                <div class="absolute inset-0 bg-gradient-to-r {{ $b4['bg_gradient'] }}"></div>
                <div class="relative z-10 space-y-1.5">
                    <span class="inline-block bg-orange-600 text-white font-extrabold text-[10px] sm:text-xs px-2.5 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                        {{ $b4['badge'] }}
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black tracking-tight">{{ $b4['title'] }}</h3>
                    <p class="text-xs sm:text-sm text-stone-300 max-w-lg">{{ $b4['subtitle'] }} — {{ $b4['tagline'] }}</p>
                </div>
                <div class="relative z-10 shrink-0">
                    <a
                        href="{{ route('shop.category', $b4['category_slug']) }}"
                        class="inline-flex items-center gap-1.5 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm"
                    >
                        <span>{{ $b4['link_text'] }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- ================= 3. NEW ARRIVALS SECTION ================= -->
    <x-product-section
        id="new-arrivals"
        title="New Arrivals"
        subtitle="Freshly listed products from verified Bangladeshi merchants"
        badge="Just In"
        badgeColor="orange"
        icon="✨"
        :products="$newArrivals"
        :limit="10"
        seeMoreUrl="{{ route('shop.index') }}?sort=newest"
        seeMoreText="See More New Arrivals"
    />

    <!-- ================= 4. FEATURED PRODUCTS SECTION ================= -->
    <x-product-section
        id="featured-products"
        title="Featured Products"
        subtitle="Handpicked quality selections across everyday household and tech needs"
        badge="Staff Pick"
        badgeColor="orange"
        icon="⭐"
        :products="$featuredProducts"
        :limit="10"
        seeMoreUrl="{{ route('shop.index') }}?filter=featured"
        seeMoreText="See More Featured"
    />

    <!-- ================= 5. RECOMMENDED PRODUCTS SECTION ================= -->
    <x-product-section
        id="recommended-products"
        title="Recommended For You"
        subtitle="Personalized suggestions based on popular demand and shopping interests"
        badge="For You"
        badgeColor="orange"
        icon="🎯"
        :products="$recommendedProducts"
        :limit="10"
        seeMoreUrl="{{ route('shop.index') }}"
        seeMoreText="Explore All Recommendations"
    />

    <!-- ================= TOP VENDORS: POPULAR STORES ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-stone-100">
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl sm:text-2xl font-black text-stone-900 tracking-tight">Popular Stores</h2>
                        <span class="bg-orange-100 text-orange-800 text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-full border border-orange-200">
                            Verified Sellers
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-stone-500 mt-1">
                        Shop directly from authorized and active vendors across Bangladesh with audited business licenses.
                    </p>
                </div>
                <a href="{{ route('vendor.dashboard') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group">
                    <span>Become a Seller</span>
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($popularVendors as $vendor)
                    <div class="bg-stone-50 rounded-xl p-4 border border-stone-200 hover:border-orange-400 transition-all flex flex-col justify-between group">
                        <div class="flex items-start gap-3.5">
                            <!-- Store Logo / Avatar -->
                            <div class="w-12 h-12 rounded-xl bg-white border border-stone-200 flex items-center justify-center text-orange-600 font-black text-lg shadow-2xs shrink-0 overflow-hidden">
                                @if($vendor->logo)
                                    <img src="{{ $vendor->logo }}" alt="{{ $vendor->store_name }}" class="w-full h-full object-cover"/>
                                @else
                                    <span>{{ substr($vendor->store_name, 0, 2) }}</span>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-1">
                                    <h4 class="font-bold text-stone-900 text-sm group-hover:text-orange-600 transition-colors truncate">
                                        {{ $vendor->store_name }}
                                    </h4>
                                    <!-- Verified Badge -->
                                    <span class="inline-flex items-center text-emerald-600 text-[10px] font-bold shrink-0">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    </span>
                                </div>
                                <p class="text-[11px] text-stone-500 line-clamp-2 mt-0.5">
                                    {{ $vendor->description ?? 'Verified merchant on AmarDokan marketplace.' }}
                                </p>
                                <div class="flex items-center gap-3 text-[11px] text-stone-500 mt-2">
                                    <span class="font-semibold text-stone-700">{{ $vendor->products_count }} Products</span>
                                    <span>•</span>
                                    <span class="flex items-center text-amber-500 font-bold">
                                        ★ 4.8
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-t border-stone-200/70 flex items-center justify-between">
                            <span class="text-[11px] text-stone-400 truncate max-w-[140px]">{{ $vendor->address ?? 'Dhaka, Bangladesh' }}</span>
                            <a
                                href="{{ route('shop.vendor', $vendor->store_slug) }}"
                                class="inline-flex items-center gap-1 text-xs font-bold text-orange-600 hover:text-orange-700 group-hover:underline"
                            >
                                <span>Visit Store</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= WHY SHOP WITH US: TRUST SECTION ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 lg:p-10 shadow-xs">
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
                <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 mb-1 inline-block">
                    Marketplace Reliability
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-stone-900 tracking-tight">Why Shop With Us</h2>
                <p class="text-xs sm:text-sm text-stone-500 mt-1">
                    Every order is protected by verified merchant guidelines and secure payment workflows.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8">
                <!-- 1. Trusted Sellers -->
                <div class="flex flex-col items-center text-center space-y-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-600 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm text-stone-900">Trusted Sellers</h4>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        100% verified Bangladeshi stores with verified Trade Licenses and authentic merchandise.
                    </p>
                </div>

                <!-- 2. Secure Checkout -->
                <div class="flex flex-col items-center text-center space-y-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm text-stone-900">Secure Checkout</h4>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        End-to-end encrypted order placement with zero unverified deductions or card leakages.
                    </p>
                </div>

                <!-- 3. Multiple Payment Options -->
                <div class="flex flex-col items-center text-center space-y-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm text-stone-900">Cash on Delivery, bKash & Nagad</h4>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Pay cash at your doorstep, or make instant mobile banking payments via personal bKash or Nagad.
                    </p>
                </div>

                <!-- 4. Fast Delivery -->
                <div class="flex flex-col items-center text-center space-y-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-200 flex items-center justify-center text-purple-600 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm text-stone-900">Fast Nationwide Delivery</h4>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        24–48 hours delivery inside Dhaka, and 48–72 hours across all 64 districts in Bangladesh.
                    </p>
                </div>

                <!-- 5. Customer Support -->
                <div class="flex flex-col items-center text-center space-y-2.5">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h4 class="font-bold text-sm text-stone-900">Customer Support</h4>
                    <p class="text-xs text-stone-500 leading-relaxed">
                        Direct hotline support and rapid order query resolution in Bengali and English.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
