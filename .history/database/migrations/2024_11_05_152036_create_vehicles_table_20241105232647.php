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
            $table->string('insurance_info')->nullable();
            $table->string('image_path')->nullable();
        
            // Driver details
            $table->string('name');
            $table->string('license_number')->unique();
            $table->string('contact_number');
            $table->string('email');
            $table->string('address');
            $table->string('certifications')->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        
            // Trip details (example for storing only one trip)
            $table->string('trip_starting_location')->nullable();
            $table->string('trip_destination')->nullable();
            $table->dateTime('trip_departure_time')->nullable();
            $table->dateTime('trip_expected_arrival_time')->nullable();
            $table->enum('trip_status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->nullable();
        
            // Maintenance details (example for storing only one record)
            $table->string('maintenance_type')->nullable();
            $table->date('maintenance_date')->nullable();
            $table->string('service_vendor')->nullable();
            $table->decimal('maintenance_cost', 10, 2)->nullable();
            $table->enum('maintenance_status', ['pending', 'completed'])->nullable();
        
            // Fuel records (example for storing only one refill)
            $table->date('fuel_refill_date')->nullable();
            $table->decimal('fuel_amount', 10, 2)->nullable();
            $table->decimal('fuel_cost', 10, 2)->nullable();
            $table->string('fuel_station')->nullable();
        
            // Expense records (example for storing only one expense)
            $table->string('expense_type')->nullable();
            $table->date('expense_date')->nullable();
            $table->decimal('expense_amount', 10, 2)->nullable();
            $table->text('expense_description')->nullable();
        
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
