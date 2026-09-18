<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'super_admin', 'display_name' => 'Super Administrator', 'description' => 'Full unrestricted platform access'],
            ['name' => 'admin', 'display_name' => 'Platform Administrator', 'description' => 'Operations, payment verification, and vendor management'],
            ['name' => 'vendor', 'display_name' => 'Merchant / Vendor', 'description' => 'Vendor store manager for products and order fulfillment'],
            ['name' => 'customer', 'display_name' => 'Registered Customer', 'description' => 'Regular customer account for shopping and reviews'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(['name' => $roleData['name']], $roleData);
        }

        $permissions = [
            // Admin & Super Admin permissions
            ['name' => 'manage_users', 'display_name' => 'Manage Platform Users', 'group' => 'admin'],
            ['name' => 'manage_vendors', 'display_name' => 'Approve, Reject, and Suspend Vendors', 'group' => 'vendors'],
            ['name' => 'manage_products', 'display_name' => 'Manage Marketplace Catalog Products', 'group' => 'catalog'],
            ['name' => 'manage_categories', 'display_name' => 'Manage Product Categories and Brands', 'group' => 'catalog'],
            ['name' => 'manage_orders', 'display_name' => 'Manage All Platform Customer Orders', 'group' => 'orders'],
            ['name' => 'manage_payments', 'display_name' => 'Verify and Manage bKash, Nagad, and COD Payments', 'group' => 'payments'],
            ['name' => 'manage_settings', 'display_name' => 'Manage Payment and Platform Settings', 'group' => 'settings'],
            ['name' => 'manage_commissions', 'display_name' => 'Manage Vendor Commissions and Rates', 'group' => 'finances'],
            ['name' => 'view_reports', 'display_name' => 'View Platform Analytics and Revenue Reports', 'group' => 'reports'],
            ['name' => 'manage_withdrawals', 'display_name' => 'Manage Vendor Payouts and Withdrawals', 'group' => 'finances'],
            ['name' => 'manage_shipping', 'display_name' => 'Manage Bangladesh Shipping Zones and Rates', 'group' => 'shipping'],
            ['name' => 'view_admin_dashboard', 'display_name' => 'View Admin Dashboard', 'group' => 'admin'],
            
            // Vendor permissions
            ['name' => 'manage_vendor_store', 'display_name' => 'Manage Store Profile and Business Settings', 'group' => 'vendor'],
            ['name' => 'manage_vendor_products', 'display_name' => 'Manage Vendor Products and Stock', 'group' => 'vendor'],
            ['name' => 'manage_vendor_orders', 'display_name' => 'View and Fulfill Vendor Orders', 'group' => 'vendor'],
            ['name' => 'view_vendor_dashboard', 'display_name' => 'View Vendor Store Dashboard', 'group' => 'vendor'],
            ['name' => 'request_withdrawals', 'display_name' => 'Request Balance Withdrawals', 'group' => 'vendor'],
            
            // Customer permissions
            ['name' => 'place_orders', 'display_name' => 'Checkout and Place Orders', 'group' => 'customer'],
            ['name' => 'manage_wishlist', 'display_name' => 'Manage Customer Saved Wishlist', 'group' => 'customer'],
            ['name' => 'write_reviews', 'display_name' => 'Write Verified Product Reviews', 'group' => 'customer'],
        ];

        foreach ($permissions as $permData) {
            Permission::firstOrCreate(['name' => $permData['name']], $permData);
        }

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $vendorRole = Role::where('name', 'vendor')->first();
        $customerRole = Role::where('name', 'customer')->first();

        // Assign all permissions to super_admin
        $allPerms = Permission::all();
        $superAdminRole->permissions()->sync($allPerms);

        // Admin gets operations
        $adminPerms = Permission::whereIn('group', ['admin', 'payments', 'vendors', 'finances', 'settings', 'catalog', 'shipping'])->get();
        $adminRole->permissions()->sync($adminPerms);

        // Vendor gets store operations
        $vendorPerms = Permission::where('group', 'vendor')->get();
        $vendorRole->permissions()->sync($vendorPerms);

        // Customer gets shopping & reviews
        $customerPerms = Permission::where('group', 'customer')->get();
        $customerRole->permissions()->sync($customerPerms);
    }
}
