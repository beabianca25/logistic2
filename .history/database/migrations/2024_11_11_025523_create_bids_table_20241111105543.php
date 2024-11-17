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
            $table->unsignedBigInteger('product_id');         // ID of the auctioned product
            $table->unsignedBigInteger('buyer_id');           // ID of the buyer placing the bid
            $table->decimal('bid_amount', 10, 2);             // Bid amount
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Status of the bid
            $table->timestamp('bid_time')->useCurrent();      // Timestamp of the bid
            $table->timestamps();                             // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
