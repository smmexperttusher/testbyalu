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
        Schema::create('vendor_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->decimal('item_subtotal', 12, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->decimal('vendor_net_amount', 12, 2);
            $table->timestamps();
        });

        Schema::create('vendor_earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('commission_deducted', 10, 2);
            $table->decimal('net_earning', 12, 2);
            $table->enum('status', ['pending', 'available', 'withdrawn', 'cancelled'])->default('pending');
            $table->timestamp('settled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['bkash', 'nagad', 'bank']);
            $table->string('account_number', 50);
            $table->string('account_holder_name', 100);
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_branch', 100)->nullable();
            $table->string('routing_number', 50)->nullable();
            $table->text('vendor_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->string('transaction_reference', 100)->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('vendor_earnings');
        Schema::dropIfExists('vendor_commissions');
    }
};
