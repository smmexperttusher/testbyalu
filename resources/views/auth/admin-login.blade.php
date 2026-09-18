@extends('layouts.app')

@section('title', 'Administrative Security Console - AmarDokan')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12 bg-stone-950">
    <div class="w-full max-w-md bg-stone-900 rounded-2xl shadow-2xl border border-stone-800 overflow-hidden">
        <!-- Header -->
        <div class="p-6 sm:p-8 text-center border-b border-stone-800 bg-stone-950/60">
            <div class="w-12 h-12 rounded-xl bg-orange-600 flex items-center justify-center text-white font-black text-2xl mx-auto mb-3 shadow-lg shadow-orange-600/20">
                🔒
            </div>
            <h1 class="text-xl font-black tracking-tight text-white">AmarDokan Internal Operations</h1>
            <p class="text-xs text-stone-400 mt-1">Authorized Administrative Personnel Only</p>
            <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-950/80 border border-red-800/40 rounded-full text-[10px] font-bold text-red-300">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                <span>Restricted Gateway: Access Logged & Monitored</span>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            @if($errors->any())
                <div class="mb-5 p-3.5 bg-red-950/80 border border-red-800/50 text-red-200 text-xs rounded-xl flex items-start gap-2">
                    <svg class="w-4 h-4 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-stone-300 mb-1">Administrative Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="admin@amardokan.bd"
                        class="w-full px-3.5 py-2.5 bg-stone-950 border border-stone-700 rounded-xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                    />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-stone-300">Administrative Secret Key</label>
                    </div>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••••••"
                        class="w-full px-3.5 py-2.5 bg-stone-950 border border-stone-700 rounded-xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-hidden focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                    />
                </div>

                <div class="flex items-center text-xs text-stone-400">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-stone-700 bg-stone-950 text-orange-600 focus:ring-orange-500" />
                        <span>Establish persistent administrative session</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white font-extrabold text-xs sm:text-sm rounded-xl transition-all shadow-lg shadow-orange-950 flex items-center justify-center gap-2"
                >
                    <span>Verify Credentials & Enter Console</span>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-stone-800 text-center">
                <a href="{{ route('home') }}" class="text-[11px] text-stone-400 hover:text-stone-200 inline-flex items-center gap-1 transition-colors">
                    <span>← Return to Public Storefront</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
