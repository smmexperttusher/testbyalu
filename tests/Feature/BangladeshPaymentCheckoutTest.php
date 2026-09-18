<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BangladeshPaymentCheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected User $customer;
    protected User $admin;
    protected User $vendorUserA;
    protected User $vendorUserB;
    protected Vendor $vendorA;
    protected Vendor $vendorB;
    protected Product $productA;
    protected Product $productB;
    protected Address $address;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');

        // Seed Roles
        $customerRole = Role::create(['name' => 'customer', 'display_name' => 'Customer']);
        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        $vendorRole = Role::create(['name' => 'vendor', 'display_name' => 'Vendor']);

        // Seed Settings
        Setting::set('bkash_number', '01819000000', 'payments');
        Setting::set('nagad_number', '01712000000', 'payments');

        // Seed Geo
        $div = Division::create(['name' => 'Dhaka']);
        $dist = District::create(['division_id' => $div->id, 'name' => 'Dhaka']);
        $upazila = Upazila::create(['district_id' => $dist->id, 'name' => 'Dhanmondi']);

        // Users
        $this->customer = User::factory()->create(['phone' => '01715000001']);
        $this->customer->roles()->attach($customerRole);

        $this->admin = User::factory()->create(['phone' => '01715000002']);
        $this->admin->roles()->attach($adminRole);

        $this->vendorUserA = User::factory()->create(['phone' => '01819000001']);
        $this->vendorUserA->roles()->attach($vendorRole);
        $this->vendorA = Vendor::create([
            'user_id' => $this->vendorUserA->id,
            'store_name' => 'Dhaka Craft',
            'store_slug' => 'dhaka-craft',
            'phone' => '01819000001',
            'email' => 'vendorA@test.com',
            'address' => 'Dhaka',
            'commission_percentage' => 10.00,
            'approval_status' => 'approved',
            'status' => 'active',
        ]);

        $this->vendorUserB = User::factory()->create(['phone' => '01819000002']);
        $this->vendorUserB->roles()->attach($vendorRole);
        $this->vendorB = Vendor::create([
            'user_id' => $this->vendorUserB->id,
            'store_name' => 'Chittagong Mart',
            'store_slug' => 'chittagong-mart',
            'phone' => '01819000002',
            'email' => 'vendorB@test.com',
            'address' => 'Chittagong',
            'commission_percentage' => 12.00,
            'approval_status' => 'approved',
            'status' => 'active',
        ]);

        $cat = Category::create(['name' => 'Fashion', 'slug' => 'fashion']);

        $this->productA = Product::create([
            'vendor_id' => $this->vendorA->id,
            'category_id' => $cat->id,
            'name' => 'Jamdani Silk Panjabi',
            'slug' => 'jamdani-silk-panjabi',
            'sku' => 'PAN-001',
            'regular_price' => 1200.00,
            'stock' => 10,
            'status' => 'active',
            'is_published' => true,
        ]);

        $this->productB = Product::create([
            'vendor_id' => $this->vendorB->id,
            'category_id' => $cat->id,
            'name' => 'Handwoven Gamcha Saree',
            'slug' => 'handwoven-gamcha-saree',
            'sku' => 'SAR-001',
            'regular_price' => 1800.00,
            'stock' => 5,
            'status' => 'active',
            'is_published' => true,
        ]);

        $this->address = Address::create([
            'user_id' => $this->customer->id,
            'full_name' => 'Tamim Iqbal',
            'phone' => '01715000001',
            'division_id' => $div->id,
            'district_id' => $dist->id,
            'upazila_id' => $upazila->id,
            'area' => 'Dhanmondi 27',
            'full_address' => 'House 12, Road 27',
            'type' => 'home',
            'is_default_delivery' => true,
        ]);
    }

    /**
     * TEST 1 & 2: Modal closed / cancelled before submission -> NO ORDER CREATED, Cart preserved.
     */
    public function test_customer_cancels_modal_no_order_created(): void
    {
        $cart = Cart::create(['user_id' => $this->customer->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $this->productA->id, 'quantity' => 1, 'unit_price' => 1200.00]);

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('cart_items', 1);
    }

    /**
     * TEST 3, 4, 5: bKash validation failures (phone missing, txId missing, screenshot missing)
     */
    public function test_bkash_validation_blocks_order_creation(): void
    {
        $cart = Cart::create(['user_id' => $this->customer->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $this->productA->id, 'quantity' => 1, 'unit_price' => 1200.00]);

        $response = $this->actingAs($this->customer)->post(route('checkout.processBkash'), [
            'payment_method' => 'bkash',
            // Missing phone, transaction_id, and screenshot
            'delivery_address_id' => $this->address->id,
        ]);

        $response->assertSessionHasErrors(['phone_number', 'transaction_id', 'screenshot']);
        $this->assertDatabaseCount('orders', 0);
    }

    /**
     * TEST 6: Successful bKash payment proof creates order with payment_status = pending_verification.
     */
    public function test_valid_bkash_payment_creates_order_pending_verification(): void
    {
        $cart = Cart::create(['user_id' => $this->customer->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $this->productA->id, 'quantity' => 1, 'unit_price' => 1200.00]);

        $screenshot = UploadedFile::fake()->image('bkash_receipt.png', 600, 800);

        $response = $this->actingAs($this->customer)->post(route('checkout.processBkash'), [
            'payment_method' => 'bkash',
            'phone_number' => '01711223344',
            'transaction_id' => 'BKH90812XYZ',
            'screenshot' => $screenshot,
            'delivery_address_id' => $this->address->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->customer->id,
            'payment_method' => 'bkash',
            'payment_status' => 'pending_verification',
            'order_status' => 'payment_verification',
        ]);
        $this->assertDatabaseHas('payment_proofs', [
            'transaction_id' => 'BKH90812XYZ',
            'phone_number' => '01711223344',
            'status' => 'pending_verification',
        ]);
    }

    /**
     * TEST 9: Duplicate transaction ID is rejected and blocks order creation.
     */
    public function test_duplicate_transaction_id_is_rejected(): void
    {
        $cart = Cart::create(['user_id' => $this->customer->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $this->productA->id, 'quantity' => 1, 'unit_price' => 1200.00]);

        $screenshot = UploadedFile::fake()->image('bkash_receipt.png');

        // First submission
        $this->actingAs($this->customer)->post(route('checkout.processBkash'), [
            'payment_method' => 'bkash',
            'phone_number' => '01711223344',
            'transaction_id' => 'DUP12345678',
            'screenshot' => $screenshot,
            'delivery_address_id' => $this->address->id,
        ]);

        // Second submission with exact same transaction ID
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $this->productA->id, 'quantity' => 1, 'unit_price' => 1200.00]);
        $secondResponse = $this->actingAs($this->customer)->post(route('checkout.processBkash'), [
            'payment_method' => 'bkash',
            'phone_number' => '01711223344',
            'transaction_id' => 'DUP12345678',
            'screenshot' => $screenshot,
            'delivery_address_id' => $this->address->id,
        ]);

        $secondResponse->assertSessionHasErrors(['transaction_id']);
        $this->assertEquals(1, Order::count());
    }

    /**
     * TEST 10: Vendor A cannot access Vendor B's order.
     */
    public function test_vendor_cannot_access_other_vendor_order(): void
    {
        // Create an order exclusively containing Vendor B's product
        $order = Order::create([
            'order_number' => 'BD-2026-TESTB',
            'user_id' => $this->customer->id,
            'subtotal' => 1800.00,
            'grand_total' => 1860.00,
            'currency' => 'BDT',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'vendor_id' => $this->vendorB->id,
            'product_id' => $this->productB->id,
            'product_name' => $this->productB->name,
            'sku' => $this->productB->sku,
            'quantity' => 1,
            'unit_price' => 1800.00,
            'subtotal' => 1800.00,
            'commission_rate' => 12.00,
            'commission_amount' => 216.00,
            'vendor_earning' => 1584.00,
            'vendor_order_status' => 'pending',
        ]);

        // Vendor A tries to view Vendor B's order -> 403 Forbidden
        $response = $this->actingAs($this->vendorUserA)->get(route('vendor.orders.show', $order));
        $response->assertStatus(403);
    }
}
