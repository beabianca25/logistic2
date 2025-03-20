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
        Schema::create('vehicle_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique(); // Unique reservation code
            $table->string('customer_name')->nullable(); // Customer's name
            $table->string('customer_contact')->nullable(); // Phone number or email
            $table->integer('vehicle_count')->default(1); // Number of vehicles requested
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade'); // Assign a driver
            $table->enum('status', ['Pending', 'Approved', 'Completed', 'Cancelled'])->default('Pending');
            $table->string('location')->nullable(); // Pickup location
            $table->text('reservation_notes')->nullable(); // Additional requests or instructions
            $table->date('reservation_start_date')->nullable(); // Start date of reservation
            $table->date('reservation_end_date')->nullable(); // End date of reservation
            $table->decimal('total_price', 10, 2)->nullable(); // Optional pricing
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // If linked to a user account
            $table->timestamps();
        });

        // Create a pivot table for many-to-many relationship between reservations and vehicles
        Schema::create('reservation_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('vehicle_reservations')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_vehicle');
        Schema::dropIfExists('vehicle_reservations');
    }
};
