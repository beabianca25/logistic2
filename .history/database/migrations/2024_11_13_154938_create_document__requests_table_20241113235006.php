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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requester_name');
            $table->date('request_date');
            $table->string('data_type');
            $table->text('description');
            $table->enum('priority_level', ['Low', 'Medium', 'High', 'Urgent']);
            $table->date('deadline')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Canceled'])->default('Pending');
            $table->string('assigned_to')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document__requests');
    }
};
