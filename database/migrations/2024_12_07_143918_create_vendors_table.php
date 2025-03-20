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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('registration_number')->nullable();
            $table->enum('business_type', ['Company', 'Partnership', 'Sole Trader', 'Not-For-Profit', 'Trust', 'Other']);
            $table->enum('industry_segment', ['Accommodation', 'Transportation', 'Tour Guide', 'Event Management', 'Hospitality', 'Travel Agency', 'Other']);
            $table->enum('number_of_employees', ['1-10', '10-50', '50-100', '100-1000', '1000+']);
            $table->enum('geographical_coverage', ['Local', 'National', 'Regional', 'Global']);
            $table->text('business_address');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
