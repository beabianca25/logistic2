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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('cascade');
            $table->string('maintenance_type');  // Type of maintenance (e.g., oil change, tire rotation)
            $table->date('maintenance_date');    // Date of maintenance
            $table->string('service_vendor');    // Service provider (e.g., repair shop name)
            $table->decimal('cost', 8, 2);       // Cost of the maintenance
            $table->string('status')->default('pending'); // Maintenance status (e.g., pending, completed)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
