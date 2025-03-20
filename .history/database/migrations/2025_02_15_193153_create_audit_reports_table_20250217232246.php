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
        Schema::create('audit_reports', function (Blueprint $table) {
            $table->id();

            // Add supply and asset references
            $table->unsignedBigInteger('supply_id')->nullable();
            $table->unsignedBigInteger('asset_id')->nullable();

            // Foreign key constraints
            $table->foreign('supply_id')->references('id')->on('supplies')->onDelete('set null');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('set null');

            $table->string('report_title');
            $table->text('report_details');
            $table->enum('status', ['Pending Review', 'Reviewed', 'Resolved'])->default('Pending Review');
            $table->string('location')->nullable();
            $table->date('report_date')->default(now()); // Date when audit happened
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_reports');
    }
};
