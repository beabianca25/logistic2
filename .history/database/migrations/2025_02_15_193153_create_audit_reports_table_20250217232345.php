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

            $table->foreignId('asset_id')->nullable()->constrained()->onDelete('cascade'); // Add asset_id as a foreign key
            $table->foreignId('supply_id')->nullable()->constrained()->onDelete('cascade'); // Add supply_id as a foreign key
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
