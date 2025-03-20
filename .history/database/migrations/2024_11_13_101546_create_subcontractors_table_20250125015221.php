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
        Schema::create('subcontractors', function (Blueprint $table) {
            $table->id(); // Primary key
            // Basic Information
            $table->string('subcontractor_name'); // Subcontractor Name (Required)
            $table->string('business_registration_number')->unique(); // Business Registration Number (Required)
            $table->string('contact_person'); // Contact Person (Required)

            // Contact Information
            $table->text('business_address'); // Business Address (Required)
            $table->string('phone'); // Phone Number (Required)
            $table->string('email')->unique(); // Email Address (Required)
            $table->string('website')->nullable(); // Website (Optional)

            // Project Scope and Expertise
            $table->text('services_offered'); // Services Offered (Required)
            $table->text('relevant_experience'); // Relevant Experience (Required)

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontractors');
    }
};
