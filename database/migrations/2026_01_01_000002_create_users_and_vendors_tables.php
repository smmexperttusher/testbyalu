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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar', 255)->nullable();
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('store_name', 150)->unique();
            $table->string('store_slug', 160)->unique();
            $table->string('logo', 255)->nullable();
            $table->string('banner', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('phone', 25);
            $table->string('email', 150);
            $table->text('address');
            $table->decimal('commission_percentage', 5, 2)->default(10.00); // Admin configurable
            $table->decimal('balance', 12, 2)->default(0.00);
            $table->decimal('pending_balance', 12, 2)->default(0.00);
            $table->decimal('total_sales', 14, 2)->default(0.00);
            $table->unsignedInteger('total_orders')->default(0);
            $table->unsignedInteger('total_products')->default(0);
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status', ['active', 'suspended', 'inactive'])->default('active');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->string('trade_license_number', 100)->nullable();
            $table->string('nid_number', 50)->nullable();
            $table->string('nid_front_path', 255)->nullable();
            $table->string('nid_back_path', 255)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_branch', 100)->nullable();
            $table->string('bank_account_name', 150)->nullable();
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bank_routing_number', 50)->nullable();
            $table->string('bkash_payout_number', 20)->nullable();
            $table->string('nagad_payout_number', 20)->nullable();
            $table->string('facebook_page', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_profiles');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('users');
    }
};
