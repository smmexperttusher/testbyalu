@extends('layouts.app')

@section('title', 'Customer Registration - AmarDokan Bangladesh')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="bg-stone-900 text-white p-6 text-center">
            <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white font-extrabold text-xl mx-auto mb-2">
                অ
            </div>
            <h1 class="text-xl font-black">Customer Registration</h1>
            <p class="text-xs text-stone-300 mt-1">Join AmarDokan to shop from verified sellers across Bangladesh</p>
        </div>

        <div class="p-6 sm:p-8">
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.register.submit') }}" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="e.g. Tanvir Ahmed"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="customer@example.com"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Mobile Number (Bangladesh 11-digit)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-xs font-semibold text-stone-500">+88</span>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            placeholder="01712345678"
                            class="w-full pl-11 pr-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                    <span class="text-[10px] text-stone-500 mt-0.5 block">Used for order delivery and SMS status updates</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Minimum 8 characters"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Re-enter password"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div class="text-[11px] text-stone-500 leading-relaxed">
                    By registering, you agree to AmarDokan's <a href="#" class="text-orange-600 underline">Terms of Service</a> and <a href="#" class="text-orange-600 underline">Privacy Policy</a>.
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm"
                >
                    Create Customer Account
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-stone-100 text-center text-xs text-stone-500">
                Already registered as a customer?
                <a href="{{ route('customer.login') }}" class="text-orange-600 font-bold hover:underline ml-1">
                    Customer Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
