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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('registration_number')->unique();
            $table->integer('seats');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade'); // Foreign key referencing drivers table
            $table->string('category');
            $table->string('status');
            $table->string('picture')->nullable(); // To store image paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
