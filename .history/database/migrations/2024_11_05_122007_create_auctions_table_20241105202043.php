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
            $table->string('category');
            $table->string('auction_title');
            $table->year('year');
            $table->text('description');
            $table->string('condition');
            $table->string('product_version');
            $table->string('company');
            $table->string('photo')->nullable(); // For file uploads
            $table->decimal('min_estimate_price', 10, 2);
            $table->decimal('max_estimate_price', 10, 2);
            $table->date('end_date');
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
