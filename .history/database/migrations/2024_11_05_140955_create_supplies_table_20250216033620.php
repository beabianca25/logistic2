<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('supply_name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('supplier_vendor');
            $table->integer('quantity_purchased');
            $table->string('unit_of_measurement');
            $table->integer('stock_on_hand');
            $table->integer('reorder_level')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->date('purchase_date');
            $table->string('invoice_receipt_number')->nullable();
            $table->string('issued_to')->nullable();
            $table->date('date_issued')->nullable();
            $table->text('purpose_usage')->nullable();
            $table->integer('remaining_stock')->default(0)->change();
            $table->string('storage_location')->nullable();
            $table->string('condition')->default('New');
            $table->date('expiration_date')->nullable();
            $table->string('maintenance_schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
