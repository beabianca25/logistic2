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
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']); // This drops the foreign key constraint

            // Then, remove the vendor_id column
            $table->dropColumn('vendor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
              // If we roll back, we will add the vendor_id column and foreign key constraint back
              $table->unsignedBigInteger('vendor_id')->nullable();
              $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
        });
    }
};
