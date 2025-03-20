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
        Schema::create('vehicle_release_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_release_id')->constrained('vehicle_releases')->onDelete('cascade');
            $table->foreignId('vehicle_reservation_id')->constrained('vehicle_reservations')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->dateTime('reservation_start_date');
            $table->dateTime('release_date');
            $table->dateTime('drop_off_date')->nullable();
            $table->string('released_by');
            $table->text('condition_report')->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->boolean('payment_status')->default(false);
            $table->enum('status', ['Completed']); // Only store completed records
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_release_histories');
    }
};
