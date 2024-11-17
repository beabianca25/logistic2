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
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->string('registration_number')->unique();
            $table->integer('capacity');
            $table->enum('current_status', ['active', 'inactive', 'maintenance', 'retired'])->default('active');
            $table->date('maintenance_schedule')->nullable();
            $table->string('insurance_info')->nullable();
            $table->unsignedBigInteger('assigned_driver_id')->nullable(); // Foreign key for driver assignment
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
