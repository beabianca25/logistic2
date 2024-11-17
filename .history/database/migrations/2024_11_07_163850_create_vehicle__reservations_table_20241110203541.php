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
        Schema::create('vehicle__reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->integer('seats');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade'); // Foreign key referencing drivers table
            $table->enum('status', ['available', 'booked', 'maintenance', 'inactive'])->default('available'); // Enum for status with default as 'available'
            $table->string('location')->nullable(); // Location where the vehicle is available (e.g., city, depot, etc.)
            $table->timestamp('availability_date')->nullable(); // The date and time when the vehicle will be available
            $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle__reservations');
    }
};
