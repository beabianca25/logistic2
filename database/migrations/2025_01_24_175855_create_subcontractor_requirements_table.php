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
        Schema::create('subcontractor_requirements', function (Blueprint $table) {
            $table->id(); // Primary key
            

             // Add the subcontractor_id foreign key
             $table->foreignId('subcontractor_id')->constrained()->onDelete('cascade'); // Foreign key to subcontractors table

             
            // Financial Details
            $table->decimal('estimated_cost', 10, 2); // Cost estimate (Required)
            $table->string('preferred_payment_terms')->nullable(); // Payment terms (Optional)

            // Availability and Timeline
            $table->date('start_date_availability'); // Start date availability (Required)
            $table->string('estimated_completion_time'); // Completion timeline (Required)

            // Resources and Compliance
            $table->text('resources_required')->nullable(); // Resources needed (Optional)
            $table->string('insurance_coverage'); // Proof of insurance (Required)
            $table->text('certifications_or_licenses')->nullable(); // Certifications/Licenses (Optional)

            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontractor_requirements');
    }
};
