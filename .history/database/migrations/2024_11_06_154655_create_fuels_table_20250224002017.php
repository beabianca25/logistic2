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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('cascade');
            $table->date('refill_date'); 
            $table->decimal('fuel_amount', 8, 2); 
            $table->decimal('cost', 10, 2); 
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->string('fuel_station'); 
            $table->string('fuel_station_location')->nullable();
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid'])->nullable();
            $table->integer('odometer_reading')->nullable();
            $table->decimal('fuel_efficiency', 8, 2)->nullable(); 
            $table->enum('payment_method', ['Cash', 'Credit Card', 'Fuel Card', 'Company Account'])->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('vendor_contact')->nullable();
            $table->enum('fuel_status', ['Pending', 'Approved', 'Rejected', 'Completed'])->default('Pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};
