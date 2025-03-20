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
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('national_id_number')->unique()->nullable();
            $table->string('license_number')->unique();
            $table->enum('license_category', ['A', 'B', 'C', 'D', 'E'])->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->string('contact_number');
            $table->string('email');
            $table->string('address');
            $table->enum('employment_status', ['Full-Time', 'Part-Time', 'Contract', 'Temporary'])->default('Full-Time');
            $table->date('hire_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->integer('driving_experience_years')->nullable();
            $table->text('assigned_routes')->nullable();
            $table->text('certifications')->nullable();
            $table->boolean('background_check_status')->default(false);
            $table->text('accident_history')->nullable();
            $table->text('training_completed')->nullable();
            $table->text('violation_records')->nullable();
            $table->string('medical_fitness_certificate')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->text('remarks')->nullable();
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
