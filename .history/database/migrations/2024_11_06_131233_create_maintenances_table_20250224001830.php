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
            $table->string('maintenance_type');  
            $table->date('maintenance_date');    
            $table->string('service_vendor');    
            $table->string('service_vendor_contact')->nullable();
            $table->decimal('labor_cost', 8, 2)->nullable();
            $table->decimal('parts_cost', 8, 2)->nullable();
            $table->decimal('total_cost', 8, 2)->nullable(); 
            $table->text('parts_replaced')->nullable();
            $table->integer('odometer_reading')->nullable();
            $table->string('warranty_period')->nullable();
            $table->date('next_service_due')->nullable();
            $table->text('issue_reported')->nullable();
            $table->text('issue_fixed')->nullable();
            $table->string('technician_name')->nullable();
            $table->text('maintenance_notes')->nullable();
            $table->enum('maintenance_status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
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
