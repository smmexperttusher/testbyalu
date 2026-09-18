<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class CustomerAuthController extends Controller
{
    /**
     * Show dedicated Customer Login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.customer-login');
    }

    /**
     * Process Customer Login.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        // Allow login with either Email or Bangladeshi Phone Number
        $field = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();

            // Role-based destination redirect
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($user->isVendor()) {
                return redirect()->intended(route('vendor.dashboard'));
            }

            // Customer: ensure database cart exists
            Cart::firstOrCreate(['user_id' => $user->id]);

            return redirect()->intended(route('home'))->with('success', "Welcome back, {$user->name}!");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our customer records.',
        ])->onlyInput('email');
    }

    /**
     * Show dedicated Customer Registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.customer-register');
    }

    /**
     * Process Customer Registration with strict validation and automatic Customer role.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ], [
            'phone.regex' => 'Please provide a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX).',
        ]);

        // Clean Bangladeshi phone format
        $phone = preg_replace('/^(?:\+88|88)/', '', $validated['phone']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $phone,
            'password' => Hash::make($validated['password']),
            'status' => 'active',
        ]);

        // Strictly assign Customer role on the server (never from user input)
        $customerRole = Role::where('name', 'customer')->first();
        if ($customerRole) {
            $user->roles()->sync([$customerRole->id]);
        }

        // Initialize personal cart
        Cart::firstOrCreate(['user_id' => $user->id]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('home'))->with('success', 'Account registered successfully! Welcome to AmarDokan.');
    }

    /**
     * Terminate the authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been signed out.');
    }
}
