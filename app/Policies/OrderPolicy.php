<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Customer can view their own order
        if ($user->id === $order->user_id) {
            return true;
        }

        // Vendor can ONLY view if at least one item belongs to their vendor profile
        if ($user->isVendor() && $user->vendor) {
            return $order->items()->where('vendor_id', $user->vendor->id)->exists();
        }

        return false;
    }

    /**
     * Only Admin can verify or reject payments
     */
    public function verifyPayment(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Customer can cancel only while pending and before confirmation
     */
    public function cancel(User $user, Order $order): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $order->user_id && in_array($order->order_status, ['pending', 'payment_verification']);
    }
}
