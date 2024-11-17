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
            $table->unsignedBigInteger('auction_id');      // Ensure this matches the type in `auctions`
            $table->unsignedBigInteger('buyer_id');        // Make sure buyer_id is also consistent with buyers table
            $table->decimal('bid_amount', 10, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('bid_time')->useCurrent();
            $table->timestamps();
        
            // Define the foreign keys correctly
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
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
