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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
           // Basic Information
           $table->string('asset_name');
           $table->string('asset_category');
           $table->string('asset_tag')->unique();
           $table->text('description')->nullable();
           
           // Acquisition Details
           $table->date('purchase_date');
           $table->string('supplier_vendor');
           $table->string('invoice_number')->nullable();
           $table->decimal('cost_of_asset', 10, 2);
           $table->decimal('depreciation_rate', 5, 2)->nullable();
           
           // Ownership & Assignment
           $table->string('assigned_to')->nullable();
           $table->string('location')->nullable();
           $table->enum('usage_status', ['Active', 'Under Maintenance', 'Retired'])->default('Active');
           
           // Maintenance & Warranty
           $table->date('warranty_expiry_date')->nullable();
           $table->string('maintenance_schedule')->nullable();
           $table->date('last_maintenance_date')->nullable();
           
           // Disposal Details (If Applicable)
           $table->date('disposal_date')->nullable();
           $table->string('disposal_method')->nullable();
           $table->decimal('resale_value', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
