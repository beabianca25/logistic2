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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable(); // Add the column first
            $table->string('document_title');
            $table->string('file_path'); // Path to the file or image
            $table->string('department');
            $table->string('current_holder')->nullable();
            $table->text('purpose')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Archived'])->default('Active');
            $table->timestamps();

             // Foreign Key constraint
             $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
