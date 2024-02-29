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
        Schema::create('products_language', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('language_id');
            $table->decimal('price', 8, 2);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_language');
    }
};
