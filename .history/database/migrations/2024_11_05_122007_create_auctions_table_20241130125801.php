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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Reference to the category
            $table->string('type'); // 'product', 'service', or 'rental'
            $table->string('auction_title');
            $table->year('year')->nullable(); // For products only
            $table->text('description');
            $table->string('condition')->nullable(); // For products only
            $table->string('product_version')->nullable(); // For products only
            $table->string('company')->nullable(); // For products only
            $table->string('photo')->nullable();
            $table->decimal('min_estimate_price', 10, 2)->nullable();
            $table->decimal('max_estimate_price', 10, 2)->nullable();
            $table->date('end_date')->nullable();
            
            // Service-specific fields
            $table->string('destination')->nullable();
            $table->string('duration')->nullable();
            $table->text('included_services')->nullable();
            $table->integer('availability')->nullable();
        
            // Rental-specific fields
            $table->string('rental_duration_unit')->nullable(); // e.g., 'hour', 'day', 'week'
            $table->decimal('price_per_unit', 10, 2)->nullable(); // Rental price per unit of time
            $table->boolean('is_available')->default(true);
        
            $table->timestamps();
    
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
