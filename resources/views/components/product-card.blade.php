@props(['product'])

@php
    $discountPercent = $product->discount_percentage;
    $regularPrice = (float) $product->regular_price;
    $salePrice = (float) ($product->sale_price ?? $product->regular_price);
    $hasDiscount = $regularPrice > $salePrice;
    $imageUrl = $product->display_image;
    $rating = $product->rating_score;
    $reviewsCount = $product->total_reviews_count;
@endphp

<div class="bg-white rounded-xl border border-stone-200 hover:border-orange-500 shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between overflow-hidden group relative h-full">
    <!-- Top Image Container with Badges & Wishlist -->
    <div class="relative w-full aspect-square bg-stone-50 overflow-hidden flex items-center justify-center p-3 border-b border-stone-100">
        <!-- Discount Badge -->
        @if($hasDiscount && $discountPercent)
            <div class="absolute top-2 left-2 z-10 bg-orange-600 text-white font-extrabold text-[10px] sm:text-xs px-2 py-0.5 rounded-md shadow-xs flex items-center gap-1">
                <span>-{{ $discountPercent }}%</span>
            </div>
        @elseif($product->is_featured)
            <div class="absolute top-2 left-2 z-10 bg-stone-900 text-white font-bold text-[10px] px-2 py-0.5 rounded-md shadow-xs">
                Featured
            </div>
        @endif

        <!-- Wishlist Button -->
        <button
            type="button"
            aria-label="Add to Wishlist"
            class="absolute top-2 right-2 z-10 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/90 hover:bg-white text-stone-400 hover:text-rose-600 border border-stone-200/80 shadow-xs flex items-center justify-center transition-colors"
            onclick="this.classList.toggle('text-rose-600'); this.classList.toggle('text-stone-400');"
        >
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>

        <!-- Product Image (Carefully fitted without awkward stretching or clipping) -->
        <a href="{{ route('shop.product', $product->slug) }}" class="w-full h-full flex items-center justify-center">
            <img
                src="{{ $imageUrl }}"
                alt="{{ $product->name }}"
                loading="lazy"
                class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
            />
        </a>
    </div>

    <!-- Product Info Section -->
    <div class="p-3 sm:p-4 flex flex-col flex-1 justify-between gap-2.5">
        <div>
            <!-- Vendor / Store Name -->
            <div class="flex items-center gap-1.5 text-[11px] text-stone-500 font-medium mb-1 line-clamp-1">
                <svg class="w-3 h-3 text-orange-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="hover:text-orange-700 truncate">{{ $product->vendor->store_name ?? 'Verified Merchant' }}</span>
            </div>

            <!-- Product Name -->
            <h3 class="font-bold text-stone-900 text-xs sm:text-sm leading-snug line-clamp-2 group-hover:text-orange-600 transition-colors">
                <a href="{{ route('shop.product', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>

            <!-- Rating & Reviews Count -->
            <div class="flex items-center gap-1.5 mt-1.5">
                <div class="flex items-center text-amber-400">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-stone-800">{{ number_format($rating, 1) }}</span>
                <span class="text-[11px] text-stone-400">({{ $reviewsCount }})</span>
            </div>
        </div>

        <!-- Price & Add to Cart -->
        <div class="pt-2 border-t border-stone-100 mt-auto">
            <div class="flex items-baseline gap-2 mb-2">
                <span class="text-sm sm:text-base font-extrabold text-stone-900">
                    ৳{{ number_format($salePrice, 2) }}
                </span>
                @if($hasDiscount)
                    <span class="text-xs text-stone-400 line-through">
                        ৳{{ number_format($regularPrice, 2) }}
                    </span>
                @endif
            </div>

            <!-- Add to Cart Form Button -->
            <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button
                    type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 active:bg-orange-800 text-white font-bold text-xs py-2 px-3 rounded-lg shadow-2xs hover:shadow-xs transition-colors flex items-center justify-center gap-1.5"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Add to Cart</span>
                </button>
            </form>
        </div>
    </div>
</div>
