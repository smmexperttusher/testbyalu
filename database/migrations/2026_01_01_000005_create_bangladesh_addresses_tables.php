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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('bn_name', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('bn_name', 50)->nullable();
            $table->timestamps();
            $table->unique(['division_id', 'name']);
        });

        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
            $table->string('name', 60);
            $table->string('bn_name', 60)->nullable();
            $table->timestamps();
            $table->unique(['district_id', 'name']);
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name', 100);
            $table->string('phone', 20); // BD Phone e.g. 01711000000
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
            $table->foreignId('upazila_id')->constrained()->cascadeOnDelete();
            $table->string('area', 100); // e.g. Mirpur 10, Banani, Dhanmondi
            $table->text('full_address'); // Road, House, Flat details
            $table->string('landmark', 150)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->enum('type', ['home', 'office', 'other'])->default('home');
            $table->boolean('is_default_delivery')->default(false);
            $table->boolean('is_default_billing')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('upazilas');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('divisions');
    }
};
