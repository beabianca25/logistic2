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
        Schema::create('vehicle_releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_reservation_id')->constrained('vehicle_reservations')->onDelete('cascade'); // Links to vehicle reservations
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->dateTime('reservation_start_date'); // Date when the booking was made
            $table->dateTime('release_date'); // Date the vehicle is picked up
            $table->dateTime('drop_off_date')->nullable(); // Optional drop-off date
            $table->string('released_by'); // Staff member releasing the vehicle
            $table->text('condition_report')->nullable(); // Report on vehicle condition
            $table->decimal('total_cost', 10, 2); // Total rental cost
            $table->boolean('payment_status')->default(false); // Payment status
            $table->enum('status', ['Pending', 'Ongoing', 'Completed', 'Cancelled'])->default('Pending'); // Release status
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_releases');
    }
};
