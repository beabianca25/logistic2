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
        Schema::create('asset_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade'); // Links to assets
            $table->string('report_title');
            $table->text('report_details');
            $table->enum('report_type', ['Maintenance', 'Warranty Expiry', 'Disposal']); // Categorization
            $table->enum('status', ['Pending Review', 'Reviewed', 'Resolved'])->default('Pending Review');
            $table->date('report_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_reports');
    }
};
