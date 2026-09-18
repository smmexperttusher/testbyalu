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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('rating'); // 1 to 5
            $table->string('title', 150)->nullable();
            $table->text('comment');
            $table->boolean('is_verified_purchase')->default(true);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
            $table->timestamps();
        });

        Schema::create('review_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained()->cascadeOnDelete();
            $table->string('image_path', 255);
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('subtitle', 200)->nullable();
            $table->string('image_path', 255);
            $table->string('link_url', 255)->nullable();
            $table->enum('position', ['hero_slider', 'top_feature', 'middle_promo', 'footer_banner'])->default('hero_slider');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 150)->unique();
            $table->longText('content');
            $table->string('seo_title', 200)->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group', 50)->default('general'); // payments, general, shipping, localization
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('type', 30)->default('string'); // string, boolean, integer, json
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action', 100);
            $table->string('subject_type', 100)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('review_images');
        Schema::dropIfExists('reviews');
    }
};
