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
            $table->string("name");
            $table->mediumText("description");
            $table->decimal("price", 8, 2);
            $table->string("sku")->unique();
            $table->string("status")->default("active");
            $table->string("ean_barcode")->unique();
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("category_id")->nullable();
            $table->timestamps();
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
