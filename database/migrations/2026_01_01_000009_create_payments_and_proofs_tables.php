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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('payment_method', 30); // cod, bkash, nagad
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('BDT');
            $table->enum('status', [
                'pending',
                'pending_verification',
                'paid',
                'failed',
                'rejected',
                'refunded'
            ])->default('pending');
            $table->string('gateway_reference', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('payment_proofs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('payment_method', 30); // bkash, nagad
            $table->string('phone_number', 25); // Sender's bKash/Nagad number
            $table->string('transaction_id', 100)->unique(); // Anti-duplicate unique constraint
            $table->string('screenshot_path', 255); // Stored in private disk
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('BDT');
            $table->enum('status', ['pending_verification', 'verified', 'rejected'])->default('pending_verification');
            $table->timestamp('submitted_at')->useCurrent();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id', 100)->nullable();
            $table->string('type', 30); // charge, refund, manual_entry
            $table->decimal('amount', 12, 2);
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
        Schema::dropIfExists('payment_proofs');
        Schema::dropIfExists('payments');
    }
};
