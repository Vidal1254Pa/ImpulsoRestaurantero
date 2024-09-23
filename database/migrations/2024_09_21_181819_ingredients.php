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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('headquarters_company_id');
            $table->unsignedBigInteger('unit_mesure_id');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('unit_mesure_id')->references('id')->on('unit_mesure')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('headquarters_company_id')->references('id')->on('headquarters_company')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
