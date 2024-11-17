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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->year('year');
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->string('registration_number')->unique();
            $table->enum('current_status', ['active', 'inactive', 'maintenance', 'retired'])->default('active');
            $table->string('image_path')->nullable();

            // Driver details
            $table->string('name');
            $table->string('license_number')->unique();
            $table->string('contact_number');
            $table->date('license_expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        
            // Maintenance details (example for storing only one record)
            $table->string('maintenance_schedule')->nullable();
    
            // Fuel records (exampl for storing only one refill)
            $table->date('fuel_refill_date')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
