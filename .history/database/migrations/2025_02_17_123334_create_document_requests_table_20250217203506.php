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
             $table->string('request_reference')->unique(); // Unique reference number
            $table->string('requester_name');
            $table->date('request_date')->default(now());
            $table->string('document_type'); // More flexible than "data_type"
            $table->text('description')->nullable();
            $table->enum('priority_level', ['Low', 'Medium', 'High', 'Urgent']);
            $table->date('deadline')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Canceled'])->default('Pending');
            $table->string('assigned_to')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('related_document_id')->nullable(); // Link to an actual document
            $table->foreign('related_document_id')->references('id')->on('documents')->onDelete('set null');
            $table->string('file_path')->nullable(); // Stores the file path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};
