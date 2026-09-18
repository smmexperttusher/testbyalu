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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name', 200);
            $table->string('slug', 220)->unique();
            $table->string('sku', 64)->unique();
            $table->enum('type', ['simple', 'variable'])->default('simple');
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->decimal('weight_kg', 8, 3)->default(0.500);
            $table->enum('status', ['draft', 'pending', 'active', 'rejected'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->string('seo_title', 200)->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('image_path', 255);
            $table->boolean('is_thumbnail')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique(); // Size, Color, Weight
            $table->string('display_name', 100);
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->cascadeOnDelete();
            $table->string('value', 100); // e.g. XL, Red, 500g
            $table->string('color_code', 20)->nullable(); // for color hex #FF0000
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku', 64)->unique();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('image_path', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['product_variant_id', 'attribute_value_id'], 'variant_attr_val_unique');
        });

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('quantity_change'); // positive for restock, negative for deduction
            $table->string('action_type', 50); // initial, restock, order_deduction, order_restoration, adjustment
            $table->string('reference_id', 100)->nullable(); // e.g. Order #10023
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
