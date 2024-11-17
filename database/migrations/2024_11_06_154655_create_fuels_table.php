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
            $table->date('refill_date'); // Date of fuel refill
            $table->decimal('fuel_amount', 8, 2); // Amount of fuel in liters/gallons
            $table->decimal('cost', 10, 2); // Cost of the fuel refill
            $table->string('fuel_station'); // Name of the fuel station
            $table->string('status')->default('pending'); // Maintenance status (e.g., pending, completed)
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
