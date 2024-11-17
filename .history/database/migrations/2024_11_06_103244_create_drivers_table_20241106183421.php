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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('cascade');
            $table->string('driver_name');
            $table->string('license_number')->unique();
            $table->string('contact_number');
            $table->string('email');
            $table->string('address');
            $table->string('certifications')->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
