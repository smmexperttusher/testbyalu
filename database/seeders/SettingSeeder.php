<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Payment settings (Admin configurable, never hardcoded)
            ['group' => 'payments', 'key' => 'cod_enabled', 'value' => 'true', 'type' => 'boolean'],
            ['group' => 'payments', 'key' => 'bkash_enabled', 'value' => 'true', 'type' => 'boolean'],
            ['group' => 'payments', 'key' => 'nagad_enabled', 'value' => 'true', 'type' => 'boolean'],
            ['group' => 'payments', 'key' => 'bkash_number', 'value' => '01819000000', 'type' => 'string'], // Demo bKash merchant/personal number
            ['group' => 'payments', 'key' => 'nagad_number', 'value' => '01712000000', 'type' => 'string'], // Demo Nagad number
            ['group' => 'payments', 'key' => 'bkash_instructions', 'value' => "1. Open your bKash app.\n2. Select Send Money.\n3. Send the exact amount to the displayed number.\n4. Copy the Transaction ID.\n5. Enter your phone number, Transaction ID, and upload the payment screenshot below.", 'type' => 'string'],
            ['group' => 'payments', 'key' => 'nagad_instructions', 'value' => "1. Open your Nagad app.\n2. Select Send Money.\n3. Send the exact amount to the displayed number.\n4. Copy the Transaction ID.\n5. Enter your phone number, Transaction ID, and upload the payment screenshot below.", 'type' => 'string'],
            ['group' => 'payments', 'key' => 'screenshot_max_size_kb', 'value' => '4096', 'type' => 'integer'], // 4MB
            ['group' => 'payments', 'key' => 'allowed_screenshot_formats', 'value' => json_encode(['jpg', 'jpeg', 'png', 'webp']), 'type' => 'json'],
            ['group' => 'payments', 'key' => 'min_order_amount', 'value' => '100', 'type' => 'integer'],
            ['group' => 'payments', 'key' => 'max_order_amount', 'value' => '250000', 'type' => 'integer'],
            
            // Platform defaults
            ['group' => 'general', 'key' => 'site_name', 'value' => 'AmarDokan Bangladesh', 'type' => 'string'],
            ['group' => 'general', 'key' => 'currency_symbol', 'value' => '৳', 'type' => 'string'],
            ['group' => 'general', 'key' => 'currency_code', 'value' => 'BDT', 'type' => 'string'],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'Asia/Dhaka', 'type' => 'string'],
            ['group' => 'general', 'key' => 'default_commission_percentage', 'value' => '10.00', 'type' => 'float'],
            
            // Shipping defaults
            ['group' => 'shipping', 'key' => 'inside_dhaka_rate', 'value' => '60.00', 'type' => 'float'],
            ['group' => 'shipping', 'key' => 'outside_dhaka_rate', 'value' => '120.00', 'type' => 'float'],
            ['group' => 'shipping', 'key' => 'free_shipping_threshold', 'value' => '2500.00', 'type' => 'float'],
        ];

        foreach ($settings as $s) {
            Setting::set($s['key'], $s['value'], $s['group'], $s['type']);
        }
    }
}
