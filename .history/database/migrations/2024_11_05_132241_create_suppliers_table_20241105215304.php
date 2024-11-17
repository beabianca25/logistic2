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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->text('product_service_description');
            $table->decimal('price_quote', 10, 2);
            $table->string('availability_lead_time');
            $table->string('contact_information');
            $table->string('attachments')->nullable();
            $table->enum('status', ['Pending', 'admin_review', 'buyer_approved', 'manager_approved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
