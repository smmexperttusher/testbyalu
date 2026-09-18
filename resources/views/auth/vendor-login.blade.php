@extends('layouts.app')

@section('title', 'Vendor Login - AmarDokan Seller Center')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="bg-gradient-to-br from-stone-950 via-stone-900 to-orange-950 text-white p-6 text-center border-b border-orange-900/30">
            <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-extrabold text-xl mx-auto mb-2 shadow-xs">
                🏪
            </div>
            <h1 class="text-xl font-black">AmarDokan Seller Center</h1>
            <p class="text-xs text-stone-300 mt-1">Merchant Portal Login for Store Managers</p>
        </div>

        <div class="p-6 sm:p-8">
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Merchant Email or Phone</label>
                    <input
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="merchant@store.bd"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-stone-700">Password</label>
                        <a href="#" class="text-[11px] text-orange-600 hover:underline">Merchant Help?</a>
                    </div>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div class="flex items-center text-xs text-stone-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-stone-300 text-orange-600 focus:ring-orange-500" />
                        <span>Keep me logged in on this computer</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2"
                >
                    <span>Sign In to Seller Center</span>
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-stone-100 text-center text-xs text-stone-500">
                Want to sell on AmarDokan?
                <a href="{{ route('vendor.register') }}" class="text-orange-600 font-bold hover:underline ml-1">
                    Become a Verified Merchant
                </a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('customer.login') }}" class="text-[11px] text-stone-500 hover:text-stone-700">
                    Looking to buy products? <span class="text-stone-800 font-semibold">Customer Login →</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
