@extends('layouts.app')

@section('title', 'Customer Login - AmarDokan Bangladesh')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="bg-stone-900 text-white p-6 text-center">
            <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-extrabold text-xl mx-auto mb-2">
                অ
            </div>
            <h1 class="text-xl font-black">Customer Login</h1>
            <p class="text-xs text-stone-300 mt-1">Sign in to access your orders, wishlist, and shopping cart</p>
        </div>

        <div class="p-6 sm:p-8">
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Email or Mobile Number</label>
                    <input
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="01712345678 or customer@amardokan.bd"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-stone-700">Password</label>
                        <a href="#" class="text-[11px] text-orange-600 hover:underline">Forgot password?</a>
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
                        <span>Remember me on this device</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm"
                >
                    Sign In to Customer Account
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-stone-100 text-center text-xs text-stone-500">
                Don't have a customer account?
                <a href="{{ route('customer.register') }}" class="text-orange-600 font-bold hover:underline ml-1">
                    Register Now
                </a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('vendor.login') }}" class="text-[11px] text-stone-500 hover:text-stone-700">
                    Are you a merchant? <span class="text-orange-600 font-semibold">Vendor Login →</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
