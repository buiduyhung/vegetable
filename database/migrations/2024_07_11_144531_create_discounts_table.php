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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code_id');
            $table->string('name');
            $table->string('code');
            $table->integer('quantity');
            $table->integer('condition');
            $table->integer('value');
            $table->string('status');
            $table->timestamps();

            $table->foreign('code_id')->references('id')->on('code_discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
