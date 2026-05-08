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
        Schema::create('promo_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('discount_badge_text')->nullable();
            $table->decimal('price_original', 10, 2);
            $table->decimal('price_promo', 10, 2);
            $table->string('background_image')->nullable();
            $table->string('image_main')->nullable();
            $table->string('image_second')->nullable();
            $table->string('image_third')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create promo_products table for products in modal
        Schema::create('promo_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_banner_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_products');
        Schema::dropIfExists('promo_banners');
    }
};
