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
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default operating hours
        DB::table('shop_settings')->insert([
            ['key' => 'weekday_open', 'value' => '08:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'weekday_close', 'value' => '15:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'saturday_open', 'value' => '08:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'saturday_close', 'value' => '13:00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'sunday_closed', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};
