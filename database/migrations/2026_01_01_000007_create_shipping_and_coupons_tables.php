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
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // e.g. "Inside Dhaka", "Outside Dhaka"
            $table->string('code', 50)->unique(); // inside_dhaka, outside_dhaka
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_zone_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100); // Standard Delivery, Express Delivery
            $table->decimal('cost', 8, 2); // e.g. ৳60 or ৳120
            $table->decimal('free_shipping_threshold', 10, 2)->nullable(); // e.g. Free if over ৳2000
            $table->string('estimated_days', 50)->default('2-3 Days');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete(); // null if platform-wide
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code', 50)->unique();
            $table->enum('type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('value', 10, 2); // 10% or 100 BDT
            $table->decimal('min_order_amount', 10, 2)->default(0.00);
            $table->decimal('max_discount_amount', 10, 2)->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->unsignedInteger('usage_limit_total')->nullable();
            $table->unsignedInteger('usage_limit_per_user')->default(1);
            $table->unsignedInteger('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->decimal('discount_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_usages');
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('shipping_methods');
        Schema::dropIfExists('shipping_zones');
    }
};
