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
        Schema::create('inventory_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_company');
    }
};
