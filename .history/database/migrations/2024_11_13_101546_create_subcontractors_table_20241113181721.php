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
            $table->id();
            $table->string('subcontractor_name');
            $table->text('project_scope');
            $table->decimal('cost_estimate', 10, 2);
            $table->string('timeline');
            $table->text('resources_required')->nullable();
            $table->string('contact_information');
            $table->enum('status', ['Pending', 'Admin_Review', 'Buyer_Approved', 'Manager_Approved'])->default('Pending');
            $table->date('submitted_date');
            $table->timestamps();
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
