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
            $table->string('vehicle_type');
            $table->string('model');
            $table->string('manufacturer');
            $table->year('year_of_manufacture');
            $table->string('license_plate')->unique();
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->integer('capacity');
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid']);
            $table->integer('mileage')->nullable();
            $table->string('color')->nullable();
            $table->string('engine_number')->unique();
            $table->string('chassis_number')->unique();
            $table->string('gps_tracking_id')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null');
            $table->date('last_maintenance_date')->nullable();
            $table->date('next_maintenance_due')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('depreciation_value', 10, 2)->nullable();
            $table->date('registration_expiry_date')->nullable();
            $table->string('owner_name')->nullable();
            $table->text('leasing_details')->nullable();
            $table->enum('current_status', ['Active', 'Inactive', 'Maintenance', 'Retired'])->default('Active');
            $table->string('insurance_info')->nullable();
            $table->string('image_path')->nullable(); 
            $table->text('remarks')->nullable();
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
