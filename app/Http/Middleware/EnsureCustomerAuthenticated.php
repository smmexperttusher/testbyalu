<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerAuthenticated
{
    /**
     * Handle an incoming request: ensure user is authenticated customer.
     * Prevents guest cart manipulation, guest checkout, and unauthorized order creation.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'requires_auth' => true,
                    'message' => 'Please log in or create an account to add items to your cart.',
                    'login_url' => route('customer.login'),
                    'register_url' => route('customer.register'),
                ], 401);
            }

            // Save intended target and product for preservation after auth
            if ($request->isMethod('post') && $request->has('product_id')) {
                session()->put('pending_cart_item', [
                    'product_id' => $request->input('product_id'),
                    'quantity' => (int) $request->input('quantity', 1),
                ]);
            }

            return redirect()->guest(route('customer.login'))->with(
                'error',
                'Please log in or create an account to add items to your cart.'
            );
        }

        // Verify role is customer (or administrator testing checkout)
        $user = auth()->user();
        if (! $user->isCustomer() && ! $user->isAdmin()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shopping operations require a customer account. Please sign in as a customer.',
                ], 403);
            }

            return redirect()->route('home')->with('error', 'Only customer accounts can purchase items.');
        }

        return $next($request);
    }
}
