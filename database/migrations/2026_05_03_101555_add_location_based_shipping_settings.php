<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom untuk koordinat di shipping_rates
        Schema::table('shipping_rates', function (Blueprint $table) {
            $table->decimal('store_latitude', 10, 7)->nullable()->after('type');
            $table->decimal('store_longitude', 10, 7)->nullable()->after('store_latitude');
            $table->integer('base_rate')->default(5000)->after('store_longitude');
            $table->integer('per_km_rate')->default(2000)->after('base_rate');
            $table->integer('max_distance_km')->default(15)->after('per_km_rate');
            $table->boolean('use_distance_calculation')->default(false)->after('max_distance_km');
        });
    }

    public function down(): void
    {
        Schema::table('shipping_rates', function (Blueprint $table) {
            $table->dropColumn([
                'store_latitude',
                'store_longitude', 
                'base_rate',
                'per_km_rate',
                'max_distance_km',
                'use_distance_calculation'
            ]);
        });
    }
};
