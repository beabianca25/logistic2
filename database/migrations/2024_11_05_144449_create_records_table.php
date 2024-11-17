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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('auditor_name');
            $table->enum('audit_type', ['supplies', 'assets']);
            $table->string('item_or_asset_name');
            $table->text('condition')->nullable();
            $table->text('notes')->nullable();
            $table->date('audit_date');
            $table->string('status')->default('Pending'); // e.g., pending, completed
            $table->text('actions_taken')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
