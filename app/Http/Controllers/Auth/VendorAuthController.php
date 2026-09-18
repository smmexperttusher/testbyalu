<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class VendorAuthController extends Controller
{
    /**
     * Show dedicated Vendor Login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.vendor-login');
    }

    /**
     * Authenticate Vendor.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        $field = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();

            if (! $user->isVendor()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This login portal is exclusively for verified merchants. Customers should use Customer Login.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('vendor.dashboard'))->with('success', 'Logged into Merchant Portal.');
        }

        return back()->withErrors([
            'email' => 'Invalid merchant credentials.',
        ])->onlyInput('email');
    }

    /**
     * Show dedicated Become a Vendor / Registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.vendor-register');
    }

    /**
     * Process Vendor Registration: creates User with Vendor role and Vendor store with 'pending' status.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'store_name' => ['required', 'string', 'max:150', 'unique:vendors,store_name'],
            'description' => ['nullable', 'string', 'max:500'],
            'store_address' => ['required', 'string', 'max:255'],
            'trade_license' => ['nullable', 'string', 'max:100'],
        ], [
            'phone.regex' => 'Please provide a valid 11-digit Bangladeshi mobile number.',
            'store_name.unique' => 'A store with this name is already registered in Bangladesh.',
        ]);

        $phone = preg_replace('/^(?:\+88|88)/', '', $validated['phone']);

        DB::transaction(function () use ($validated, $phone, &$user) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $phone,
                'password' => Hash::make($validated['password']),
                'status' => 'active',
            ]);

            // Assign Vendor role strictly on server
            $vendorRole = Role::where('name', 'vendor')->first();
            if ($vendorRole) {
                $user->roles()->sync([$vendorRole->id]);
            }

            // Vendor store created with 'pending' approval status (requires Admin review)
            $vendor = Vendor::create([
                'user_id' => $user->id,
                'store_name' => $validated['store_name'],
                'store_slug' => Str::slug($validated['store_name']) . '-' . rand(100, 999),
                'description' => $validated['description'] ?? 'Merchant store on AmarDokan BD',
                'phone' => $phone,
                'email' => $validated['email'],
                'address' => $validated['store_address'],
                'commission_percentage' => 10.00,
                'approval_status' => 'pending',
                'status' => 'inactive',
            ]);

            if (! empty($validated['trade_license'])) {
                VendorProfile::create([
                    'vendor_id' => $vendor->id,
                    'trade_license_number' => $validated['trade_license'],
                ]);
            }
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('vendor.dashboard')->with('success', 'Merchant application submitted! Your store is currently under review by AmarDokan Operations.');
    }
}
