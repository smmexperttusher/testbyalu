<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 32)->unique(); // e.g. BD-20260918-0001
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0.00);
            $table->decimal('coupon_discount', 12, 2)->default(0.00);
            $table->decimal('shipping_cost', 8, 2)->default(0.00);
            $table->decimal('tax_amount', 8, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            $table->string('currency', 10)->default('BDT');
            $table->string('payment_method', 30); // cod, bkash, nagad
            $table->enum('payment_status', [
                'pending',
                'pending_verification',
                'paid',
                'failed',
                'rejected',
                'refunded'
            ])->default('pending');
            $table->enum('order_status', [
                'pending',
                'payment_verification',
                'confirmed',
                'processing',
                'ready_to_ship',
                'shipped',
                'delivered',
                'cancelled',
                'refunded'
            ])->default('pending');
            $table->text('customer_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('type', 20)->default('delivery'); // delivery or billing
            $table->string('full_name', 100);
            $table->string('phone', 25);
            $table->string('division_name', 50);
            $table->string('district_name', 50);
            $table->string('upazila_name', 60);
            $table->string('area', 100);
            $table->text('full_address');
            $table->string('landmark', 150)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name', 200);
            $table->string('variant_label', 100)->nullable(); // e.g. "Size: XL | Color: Black"
            $table->string('sku', 64);
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 12, 2); // quantity * unit_price
            $table->decimal('commission_rate', 5, 2); // snapshot of vendor commission %
            $table->decimal('commission_amount', 10, 2); // platform cut
            $table->decimal('vendor_earning', 12, 2); // vendor cut (subtotal - commission)
            $table->enum('vendor_order_status', [
                'pending',
                'processing',
                'ready_to_ship',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('order_addresses');
        Schema::dropIfExists('orders');
    }
};
