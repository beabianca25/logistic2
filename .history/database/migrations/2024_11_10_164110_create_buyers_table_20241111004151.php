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
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        // Full name of the buyer
            $table->string('email')->unique();             // Unique email for login
            $table->string('password');                    // Encrypted password
            $table->string('phone')->nullable();           // Contact phone number
            $table->string('company_name')->nullable();    // Company name
            $table->string('address')->nullable();         // Address (optional)
            $table->enum('role', ['vendor', 'buyer'])->default('buyer'); // User role, defaulting to 'buyer'
            $table->enum('status', ['pending', 'active', 'suspended'])->default('pending'); // Account status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyers');
    }
};
