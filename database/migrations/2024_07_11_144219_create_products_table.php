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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('code_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('quantity');
            $table->integer('sold')->default(0);
            $table->double('price_import')->nullable();
            $table->double('price_sale')->nullable();
            $table->string('weight');
            $table->longText('desc');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('origin_id')->references('id')->on('origins')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_products')->onDelete('cascade');
            $table->foreign('code_id')->references('id')->on('code_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
