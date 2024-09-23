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
        Schema::create('products_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('headquarters_company_id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('quantity');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_composed')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('headquarters_company_id')->references('id')->on('headquarters_company')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_company');
    }
};
