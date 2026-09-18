@props([
    'title',
    'subtitle' => null,
    'badge' => null,
    'badgeColor' => 'orange',
    'icon' => null,
    'seeMoreUrl' => '#',
    'seeMoreText' => 'See More',
    'products' => collect(),
    'limit' => 10,
    'id' => null
])

@php
    $displayProducts = $products->take($limit);
@endphp

@if($displayProducts->isNotEmpty())
<section @if($id) id="{{ $id }}" @endif class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl border border-stone-200 p-4 sm:p-6 lg:p-7 shadow-xs">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-stone-100">
            <div class="flex items-center gap-3">
                @if($icon)
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-orange-50 border border-orange-200/70 text-orange-600 flex items-center justify-center font-black text-lg shrink-0">
                        {!! $icon !!}
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-black text-stone-900 tracking-tight">
                            {{ $title }}
                        </h2>
                        @if($badge)
                            <span class="text-[10px] sm:text-xs font-extrabold uppercase px-2 py-0.5 rounded-full {{ $badgeColor === 'red' ? 'bg-rose-100 text-rose-700 border border-rose-200' : 'bg-orange-100 text-orange-800 border border-orange-200' }}">
                                {{ $badge }}
                            </span>
                        @endif
                    </div>
                    @if($subtitle)
                        <p class="text-xs sm:text-sm text-stone-500 mt-0.5">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            <!-- Top Desktop "See More" Link -->
            <a
                href="{{ $seeMoreUrl }}"
                class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold text-orange-600 hover:text-orange-700 transition-colors group"
            >
                <span>{{ $seeMoreText }}</span>
                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Strict Responsive Product Grid:
             Mobile: exactly 2 cols (2 cols × 5 rows = 10 products)
             Tablet: 3 cols
             Desktop: 4 cols (lg) and 5 cols (xl)
        -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5">
            @foreach($displayProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <!-- Mobile & Desktop Bottom "See More" Button -->
        <div class="mt-6 pt-5 border-t border-stone-100 flex items-center justify-center">
            <a
                href="{{ $seeMoreUrl }}"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-stone-50 hover:bg-orange-50 text-stone-800 hover:text-orange-700 font-bold text-xs sm:text-sm px-6 py-2.5 sm:py-3 rounded-xl border border-stone-200 hover:border-orange-300 transition-all shadow-2xs"
            >
                <span>{{ $seeMoreText }}</span>
                <span class="text-stone-400 font-normal">({{ $products->count() }}+ products)</span>
                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
