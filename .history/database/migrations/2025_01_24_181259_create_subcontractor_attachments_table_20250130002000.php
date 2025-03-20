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
        Schema::create('subcontractor_attachments', function (Blueprint $table) {
            $table->id(); // Primary Key


             // Add the subcontractor_id foreign key
             $table->foreignId('subcontractor_id')->constrained()->onDelete('cascade'); // Foreign key to subcontractors table


            // Attachments
            $table->string('portfolio_samples'); // File path for portfolio/project samples (Required)
            $table->string('business_licenses'); // File path for licenses/permits (Required)
            
            // Acknowledgments and Signature
            $table->boolean('agreement_acknowledged')->default(false); // Checkbox to confirm terms and conditions (Required)
            $table->string('signature'); // File path for signature image or digital signature (Required)
            $table->timestamp('submission_date'); // Date of submission
            
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontractor_attachments');
    }
};
