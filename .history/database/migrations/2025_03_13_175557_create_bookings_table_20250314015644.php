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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

               // General Information
               $table->string('name'); // Name of the requestor
               $table->string('phone_number');
               $table->string('email');
               $table->string('address');
   
               // Service Type
               $table->string('service_type'); // Service type name
               
               // Service-Specific Information
               $table->string('venue_name')->nullable(); // Venue-related services
               $table->integer('number_of_participants')->nullable();
               $table->integer('number_of_guests')->nullable();
               $table->string('ceremony_venue')->nullable();
               $table->string('reception_venue')->nullable();
               $table->integer('guest_count')->nullable();
               $table->text('activities_preferred')->nullable();
               $table->string('event_date')->nullable();
               $table->string('seating_preference')->nullable();
               $table->string('school_group_name')->nullable();
               $table->string('destination')->nullable();
               $table->integer('number_of_students')->nullable();
               $table->date('departure_date')->nullable();
               $table->date('return_date')->nullable();
               $table->integer('passenger_count')->nullable();
               $table->integer('number_of_travelers')->nullable();
               $table->string('accommodation_preference')->nullable();
               $table->string('pickup_location')->nullable();
               $table->string('dropoff_location')->nullable();
               $table->integer('number_of_seats')->nullable();
               
               // Additional Fields
               $table->decimal('price', 10, 2)->nullable(); // Price of the service
               $table->enum('status', ['Pending', 'Approved', 'Scheduled', 'Ongoing', 'Completed', 'Cancelled'])->default('Pending');
               $table->enum('payment_status', ['Pending', 'Paid', 'Cancelled'])->default('Pending');
   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
