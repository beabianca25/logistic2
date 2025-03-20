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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null');
            $table->string('starting_location');
            $table->string('destination');
            $table->enum('trip_type', ['One-Way', 'Round-Trip', 'Multi-Stop'])->default('One-Way');
            $table->dateTime('departure_time');
            $table->dateTime('expected_arrival_time');
            $table->dateTime('actual_departure_time')->nullable();
            $table->dateTime('actual_arrival_time')->nullable();
            $table->text('route_details')->nullable();
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->integer('passenger_count')->nullable();
            $table->decimal('fuel_consumed', 8, 2)->nullable();
            $table->decimal('fuel_cost', 10, 2)->nullable();
            $table->decimal('trip_expenses', 10, 2)->nullable();
            $table->string('gps_tracking_id')->nullable();
            $table->text('incident_report')->nullable();
            $table->string('weather_conditions')->nullable();
            $table->text('delay_reason')->nullable();
            $table->text('cargo_details')->nullable();
            $table->text('trip_notes')->nullable();
            $table->enum('status', ['Scheduled', 'Ongoing', 'Completed', 'Delayed'])->default('Scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
