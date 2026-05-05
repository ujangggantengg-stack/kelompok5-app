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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('customers')->onDelete('cascade');
            
            // Address details
            $table->string('label')->default('Rumah'); // Rumah, Kantor, Kos, dll
            $table->string('recipient_name');
            $table->string('phone');
            $table->text('address');
            $table->text('address_detail')->nullable();
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('province');
            $table->string('postal_code')->nullable();
            
            // GPS coordinates
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Flags
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('is_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
