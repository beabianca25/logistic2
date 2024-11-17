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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_item_id'); // References auction item
            $table->unsignedBigInteger('buyer_id');        // References buyer
            $table->decimal('bid_amount', 10, 2);          // Bid amount with 2 decimal precision
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Bid status
            $table->timestamps();                          // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('auction_item_id')->references('id')->on('auction_items')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
