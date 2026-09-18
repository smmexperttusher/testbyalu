<!-- Guest Customer Authentication Modal (Triggered on Add to Cart, Buy Now, or Checkout) -->
<div
    id="customer-auth-modal"
    class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-stone-900/70 backdrop-blur-xs hidden transition-opacity"
    role="dialog"
    aria-modal="true"
    aria-labelledby="auth-modal-title"
>
    <div class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl border border-stone-200 overflow-hidden max-h-[92vh] flex flex-col">
        <!-- Close Button -->
        <button
            type="button"
            onclick="closeAuthModal()"
            class="absolute top-3.5 right-3.5 text-stone-400 hover:text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-full p-1.5 transition-colors z-10"
            aria-label="Close"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div class="bg-gradient-to-br from-stone-900 to-stone-800 text-white p-5 sm:p-6 text-center shrink-0">
            <div class="inline-flex w-10 h-10 rounded-xl bg-orange-600 items-center justify-center text-white font-extrabold text-xl mb-2.5 shadow-xs">
                অ
            </div>
            <h3 id="auth-modal-title" class="text-lg sm:text-xl font-extrabold tracking-tight">
                Welcome Back
            </h3>
            <p class="text-xs sm:text-sm text-stone-300 mt-1">
                Please log in to continue shopping.
            </p>
            <div class="mt-3 bg-orange-950/70 border border-orange-500/40 rounded-lg py-2 px-3 text-[11px] sm:text-xs text-orange-200 font-medium text-center">
                Please log in or create an account to add items to your cart.
            </div>
        </div>

        <!-- Mode Toggle Tabs: Customer Login vs Register -->
        <div class="flex border-b border-stone-200 bg-stone-50 shrink-0">
            <button
                type="button"
                id="tab-login-btn"
                onclick="switchAuthTab('login')"
                class="flex-1 py-3 text-xs sm:text-sm font-bold border-b-2 border-orange-600 text-orange-600 bg-white transition-colors"
            >
                Customer Login
            </button>
            <button
                type="button"
                id="tab-register-btn"
                onclick="switchAuthTab('register')"
                class="flex-1 py-3 text-xs sm:text-sm font-semibold text-stone-600 hover:text-stone-900 border-b-2 border-transparent transition-colors"
            >
                Create Account
            </button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="overflow-y-auto p-5 sm:p-6 space-y-4">
            <!-- 1. Customer Login Form -->
            <form id="modal-login-form" method="POST" action="{{ route('customer.login.submit') }}" class="space-y-3.5">
                @csrf
                <input type="hidden" name="intended_action" id="modal-intended-action" value="add_to_cart" />
                <input type="hidden" name="product_id" id="modal-product-id" value="" />

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Email or Phone Number</label>
                    <input
                        type="text"
                        name="email"
                        required
                        placeholder="e.g. 01712345678 or customer@amardokan.bd"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white transition-all"
                    />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-stone-700">Password</label>
                        <a href="#" class="text-[11px] text-orange-600 hover:underline">Forgot?</a>
                    </div>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white transition-all"
                    />
                </div>

                <div class="flex items-center justify-between text-xs text-stone-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-stone-300 text-orange-600 focus:ring-orange-500" />
                        <span>Remember my login</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2"
                >
                    Log In & Add to Cart
                </button>

                <div class="pt-2 text-center text-[11px] text-stone-500">
                    New to AmarDokan?
                    <button type="button" onclick="switchAuthTab('register')" class="text-orange-600 font-bold hover:underline ml-1">
                        Create a Customer Account
                    </button>
                </div>
            </form>

            <!-- 2. Customer Registration Form -->
            <form id="modal-register-form" method="POST" action="{{ route('customer.register.submit') }}" class="space-y-3 hidden">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        required
                        placeholder="Your full name"
                        class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="name@domain.com"
                        class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white"
                    />
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">Mobile Number (Bangladesh)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-xs font-semibold text-stone-500">+88</span>
                        <input
                            type="tel"
                            name="phone"
                            required
                            placeholder="01712345678"
                            class="w-full pl-11 pr-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Password</label>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Min. 8 chars"
                            class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Re-type password"
                            class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-hidden focus:ring-2 focus:ring-orange-600 focus:bg-white"
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-colors shadow-sm"
                >
                    Create Customer Account
                </button>

                <div class="pt-2 text-center text-[11px] text-stone-500">
                    Already have an account?
                    <button type="button" onclick="switchAuthTab('login')" class="text-orange-600 font-bold hover:underline ml-1">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAuthModal(productId, action = 'add_to_cart') {
        const modal = document.getElementById('customer-auth-modal');
        if (modal) {
            document.getElementById('modal-product-id').value = productId || '';
            document.getElementById('modal-intended-action').value = action;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeAuthModal() {
        const modal = document.getElementById('customer-auth-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function switchAuthTab(tab) {
        const loginForm = document.getElementById('modal-login-form');
        const registerForm = document.getElementById('modal-register-form');
        const loginBtn = document.getElementById('tab-login-btn');
        const registerBtn = document.getElementById('tab-register-btn');

        if (tab === 'login') {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginBtn.classList.add('border-orange-600', 'text-orange-600', 'bg-white', 'font-bold');
            loginBtn.classList.remove('text-stone-600', 'border-transparent');
            registerBtn.classList.remove('border-orange-600', 'text-orange-600', 'bg-white', 'font-bold');
            registerBtn.classList.add('text-stone-600', 'border-transparent');
        } else {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            registerBtn.classList.add('border-orange-600', 'text-orange-600', 'bg-white', 'font-bold');
            registerBtn.classList.remove('text-stone-600', 'border-transparent');
            loginBtn.classList.remove('border-orange-600', 'text-orange-600', 'bg-white', 'font-bold');
            loginBtn.classList.add('text-stone-600', 'border-transparent');
        }
    }
</script>
