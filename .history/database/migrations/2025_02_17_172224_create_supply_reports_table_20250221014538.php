<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supply_reports', function (Blueprint $table) {
            $table->id();

            // Foreign key for supply_id referencing the supplies table
            $table->foreignId('supply_id')->constrained('supplies')->onDelete('cascade');
            
            // Report details
            $table->string('report_title');
            $table->text('report_details');

            // Enum for the status of the report
            $table->enum('status', ['Pending Review', 'Reviewed', 'Resolved'])->default('Pending Review');

            // Enum for the document status
            $table->enum('document_status', ['Pending', 'Submitted', 'Approved', 'Rejected'])->default('Pending');

            // Nullable timestamp for when the report is submitted
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            // Foreign key for document_id referencing the documents table
            // $table->foreignId('document_id')->nullable()->constrained('documents')->onDelete('cascade');

            // Optional: You may want to add indexes for performance
            // $table->index('supply_id');
            // $table->index('document_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the audit_reports table
        Schema::dropIfExists('supply_reports');
    }
};
