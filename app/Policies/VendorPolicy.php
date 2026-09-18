<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

class VendorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the specific vendor details.
     */
    public function view(User $user, Vendor $vendor): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Vendor can ONLY view their own store
        return $user->vendor && $user->vendor->id === $vendor->id;
    }

    /**
     * Determine whether the user can update the vendor store.
     */
    public function update(User $user, Vendor $vendor): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->vendor && $user->vendor->id === $vendor->id;
    }

    /**
     * Admin actions: approve, reject, suspend, change commission
     */
    public function manageStatus(User $user): bool
    {
        return $user->isAdmin();
    }

    public function manageCommission(User $user): bool
    {
        return $user->isSuperAdmin();
    }
}
