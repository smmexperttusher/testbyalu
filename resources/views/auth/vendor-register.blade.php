@extends('layouts.app')

@section('title', 'Become a Vendor - AmarDokan Bangladesh')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="bg-gradient-to-br from-stone-950 via-stone-900 to-orange-950 text-white p-6 sm:p-8 text-center border-b border-orange-900/30">
            <div class="inline-flex items-center gap-2 bg-orange-600/20 text-orange-400 border border-orange-500/30 px-3 py-1 rounded-full text-xs font-bold mb-3">
                Bangladesh Merchant Onboarding
            </div>
            <h1 class="text-2xl font-black">Become a Vendor on AmarDokan</h1>
            <p class="text-xs sm:text-sm text-stone-300 mt-1 max-w-md mx-auto">
                Sell your products to millions of active buyers across all 64 districts in Bangladesh with guaranteed bi-weekly payouts.
            </p>
            
            <div class="mt-4 inline-flex items-center gap-2 text-[11px] bg-stone-800/80 px-3 py-1.5 rounded-lg text-stone-300">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Approval Process: <strong>Pending → Admin Review → Approved</strong></span>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('vendor.register.submit') }}" class="space-y-4">
                @csrf
                
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-orange-600 border-b border-stone-100 pb-1">
                    Store & Business Details
                </h3>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Store / Business Name *</label>
                    <input
                        type="text"
                        name="store_name"
                        value="{{ old('store_name') }}"
                        required
                        placeholder="e.g. Dhaka Electronics & Gadgets"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Store Address / Warehouse Location *</label>
                    <input
                        type="text"
                        name="store_address"
                        value="{{ old('store_address') }}"
                        required
                        placeholder="e.g. Shop 14, Level 3, Multiplan Center, Elephant Road, Dhaka"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Trade License / NID (Optional)</label>
                        <input
                            type="text"
                            name="trade_license"
                            value="{{ old('trade_license') }}"
                            placeholder="TRAD/DNCC/XXXXXX"
                            class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Commission Rate</label>
                        <input
                            type="text"
                            value="Standard 10% on Net Sale"
                            disabled
                            class="w-full px-3.5 py-2.5 bg-stone-100 border border-stone-200 rounded-xl text-xs sm:text-sm text-stone-500 font-semibold"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Short Store Description</label>
                    <textarea
                        name="description"
                        rows="2"
                        placeholder="Briefly describe the categories and items you specialize in..."
                        class="w-full px-3.5 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    >{{ old('description') }}</textarea>
                </div>

                <h3 class="text-xs font-extrabold uppercase tracking-wider text-orange-600 border-b border-stone-100 pb-1 pt-2">
                    Merchant Representative Account
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Representative Name *</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Proprietor / Manager Name"
                            class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Official Email *</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="merchant@store.bd"
                            class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Contact Phone (Bangladesh) *</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-xs font-semibold text-stone-500">+88</span>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            placeholder="01819000000"
                            class="w-full pl-11 pr-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Password *</label>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Min. 8 characters"
                            class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Confirm Password *</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Re-type password"
                            class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                </div>

                <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-[11px] text-amber-900 leading-relaxed">
                    <strong>Note:</strong> All new vendor accounts are submitted with <em>Pending Review</em> status. Our vendor operations team reviews your business information before product listings and payouts are activated.
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-extrabold text-sm rounded-xl transition-colors shadow-sm"
                >
                    Submit Merchant Application
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-stone-100 text-center text-xs text-stone-500">
                Already registered as a merchant?
                <a href="{{ route('vendor.login') }}" class="text-orange-600 font-bold hover:underline ml-1">
                    Vendor Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
