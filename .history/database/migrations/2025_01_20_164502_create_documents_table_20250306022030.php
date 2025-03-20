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
            $table->string('document_title');
            $table->string('file_path'); // Path to the file or image
            $table->string('department');
            $table->string('current_holder')->nullable();
            $table->text('purpose')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Active', 'Inactive', 'Archived'])->default('Pending')->change();
            $table->timestamps();
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
