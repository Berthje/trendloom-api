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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->dateTime('order_date');
            $table->enum('status', ['shipping', 'paid', 'cancelled', 'delivered', 'returned', 'refunded']);
            $table->integer('amount_products');
            $table->decimal('total_price', 8, 2);
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
