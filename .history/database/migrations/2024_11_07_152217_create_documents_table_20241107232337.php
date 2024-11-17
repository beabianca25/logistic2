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
            $table->unsignedBigInteger('vendor_id'); // Foreign key for vendors
            $table->string('document_title');
            $table->string('document_number')->unique();
            $table->string('file_path'); // Path to the file or image
            $table->string('department');
            $table->string('current_holder')->nullable();
            $table->text('purpose')->nullable();
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
