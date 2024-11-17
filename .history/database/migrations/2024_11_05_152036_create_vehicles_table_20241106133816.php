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
            $table->year('license_plate')->unique();;
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->integer('capacity');
            $table->enum('current_status', ['active', 'inactive', 'maintenance', 'retired'])->default('active');
            $table->string('insurance_info')->nullable();
            $table->string('image_path')->nullable(); 
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
