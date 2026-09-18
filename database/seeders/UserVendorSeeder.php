<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Role;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserVendorSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $vendorRole = Role::where('name', 'vendor')->first();
        $customerRole = Role::where('name', 'customer')->first();

        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@amardokan.bd'],
            [
                'name' => 'Kazi Tanvir (Super Admin)',
                'phone' => '01711000001',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]
        );
        $superAdmin->roles()->sync([$superAdminRole->id]);

        // 2. Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@amardokan.bd'],
            [
                'name' => 'Rashid Ahmed (Payment Operations)',
                'phone' => '01711000002',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        // 3. Vendor 1: Dhaka Fashion Hub
        $vendorUser1 = User::firstOrCreate(
            ['email' => 'vendor1@dhakafashion.bd'],
            [
                'name' => 'Anwar Hossain (Dhaka Fashion)',
                'phone' => '01819000001',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $vendorUser1->roles()->sync([$vendorRole->id]);

        $vendor1 = Vendor::firstOrCreate(
            ['user_id' => $vendorUser1->id],
            [
                'store_name' => 'Dhaka Fashion Hub',
                'store_slug' => 'dhaka-fashion-hub',
                'description' => 'Premium traditional and contemporary apparel, Jamdani sarees, and Punjabi.',
                'phone' => '01819000001',
                'email' => 'contact@dhakafashion.bd',
                'address' => 'Plot 12, Road 4, Sector 7, Uttara, Dhaka-1230',
                'commission_percentage' => 10.00,
                'approval_status' => 'approved',
                'status' => 'active',
                'approved_at' => now(),
            ]
        );

        VendorProfile::firstOrCreate(
            ['vendor_id' => $vendor1->id],
            [
                'trade_license_number' => 'TRAD/DNCC/012948/2024',
                'nid_number' => '19902692518000123',
                'bank_name' => 'Dutch-Bangla Bank PLC',
                'bank_branch' => 'Uttara Branch',
                'bank_account_name' => 'Dhaka Fashion Hub',
                'bank_account_number' => '1201510098765',
                'bank_routing_number' => '090263451',
                'bkash_payout_number' => '01819000001',
            ]
        );

        // 4. Vendor 2: Bengal Tech Mart
        $vendorUser2 = User::firstOrCreate(
            ['email' => 'vendor2@bengaltech.bd'],
            [
                'name' => 'Mahmudul Hasan (Bengal Tech)',
                'phone' => '01911000002',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $vendorUser2->roles()->sync([$vendorRole->id]);

        $vendor2 = Vendor::firstOrCreate(
            ['user_id' => $vendorUser2->id],
            [
                'store_name' => 'Bengal Tech Mart',
                'store_slug' => 'bengal-tech-mart',
                'description' => 'Original consumer electronics, powerbanks, smart accessories, and cables.',
                'phone' => '01911000002',
                'email' => 'support@bengaltech.bd',
                'address' => 'Shop 42, Multiplan Center, Elephant Road, Dhaka-1205',
                'commission_percentage' => 8.00,
                'approval_status' => 'approved',
                'status' => 'active',
                'approved_at' => now(),
            ]
        );

        VendorProfile::firstOrCreate(
            ['vendor_id' => $vendor2->id],
            [
                'trade_license_number' => 'TRAD/DSCC/098172/2023',
                'nid_number' => '19882691238000456',
                'bank_name' => 'BRAC Bank PLC',
                'bank_branch' => 'Elephant Road Branch',
                'bank_account_name' => 'Bengal Tech Mart',
                'bank_account_number' => '1501209876543001',
                'bank_routing_number' => '060261122',
                'nagad_payout_number' => '01911000002',
            ]
        );

        // 5. Demo Customers
        $customer = User::firstOrCreate(
            ['email' => 'customer@amardokan.bd'],
            [
                'name' => 'Tamim Iqbal',
                'phone' => '01715000009',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]
        );
        $customer->roles()->sync([$customerRole->id]);

        $dhakaDiv = Division::where('name', 'Dhaka')->first();
        $dhakaDist = District::where('name', 'Dhaka')->first();
        $dhanmondiUpazila = Upazila::where('name', 'Dhanmondi')->first();

        if ($dhakaDiv && $dhakaDist && $dhanmondiUpazila) {
            Address::firstOrCreate(
                ['user_id' => $customer->id, 'is_default_delivery' => true],
                [
                    'full_name' => 'Tamim Iqbal',
                    'phone' => '01715000009',
                    'division_id' => $dhakaDiv->id,
                    'district_id' => $dhakaDist->id,
                    'upazila_id' => $dhanmondiUpazila->id,
                    'area' => 'Dhanmondi 27',
                    'full_address' => 'House 45/A, Road 27 (Old 16), Flat 4B',
                    'landmark' => 'Near Rapa Plaza',
                    'postal_code' => '1209',
                    'type' => 'home',
                    'is_default_delivery' => true,
                    'is_default_billing' => true,
                ]
            );
        }
    }
}
