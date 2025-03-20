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
        Schema::create('supply_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_id'); // Foreign key to supplies table
            $table->string('report_title');
            $table->text('description')->nullable(); // Optional report description
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending'); // Report status
            $table->string('location')->nullable(); // Location where the supply is stored or used
            $table->date('report_date'); // Date when the report is generated
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('supply_id')->references('id')->on('supplies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_reports');
    }
};
