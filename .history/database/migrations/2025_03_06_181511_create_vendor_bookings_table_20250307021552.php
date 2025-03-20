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
        Schema::create('vendor_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Requestor
            $table->string('booking_type'); // Service, Vehicle, Tour, Accommodation, Equipment
            $table->string('pickup_location'); // New field for pickup location
            $table->string('dropoff_location'); // New field for dropoff location
            $table->text('notes')->nullable(); // New field for additional notes
            $table->dateTime('booking_date');
            $table->enum('status', ['Pending', 'Approved', 'Scheduled', 'Ongoing', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_bookings');
    }
};
