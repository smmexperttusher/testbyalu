<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    /**
     * Show dedicated Admin Login form (Hidden from public navigation).
     */
    public function showLoginForm(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Authenticate Administrator with strict role check.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();

            // Strict role verification: only Super Admin or Admin allowed
            if (! $user->isAdmin()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Access Denied: You do not possess administrative privileges.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Authenticated into Administrative Console.');
        }

        return back()->withErrors([
            'email' => 'Invalid administrative credentials.',
        ])->onlyInput('email');
    }
}
