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
        //Media

        Schema::table('product_media', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('category_media', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        //Coupons

        Schema::table('category_coupons', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
        });

        Schema::table('product_coupons', function (Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('brand_coupons', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
        });

        //Languages

        Schema::table('brand_languages', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

        Schema::table('category_languages', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

        Schema::table('product_languages', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->unique(['product_id', 'language_id']);
        });

        //Products

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        Schema::table('product_sizes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['product_id', 'size']);
        });

        Schema::table('product_stock', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('product_sizes')->onDelete('cascade');
        });

        //Categories

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        //Customers

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
        });

        //Roles

        Schema::table('customer_roles', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        //Orders

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); //I won't use soft deletes anymore and cascade delete it since keeping history requires more complex logic which is not my mvp here
            $table->foreign('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
        });

        //Wishlists

        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Media
    Schema::table('product_media', function (Blueprint $table) {
        $table->dropForeign(['product_id']);
    });

    Schema::table('category_media', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
    });

    //Coupons
    Schema::table('category_coupons', function (Blueprint $table) {
        $table->dropForeign(['category_id', 'coupon_id']);
    });

    Schema::table('product_coupons', function (Blueprint $table) {
        $table->dropForeign(['coupon_id', 'product_id']);
    });

    Schema::table('brand_coupons', function (Blueprint $table) {
        $table->dropForeign(['brand_id', 'coupon_id']);
    });

    //Languages
    Schema::table('brand_languages', function (Blueprint $table) {
        $table->dropForeign(['brand_id', 'language_id']);
    });

    Schema::table('category_languages', function (Blueprint $table) {
        $table->dropForeign(['category_id', 'language_id']);
    });

    Schema::table('product_languages', function (Blueprint $table) {
        $table->dropForeign(['product_id', 'language_id']);
    });

    //Products
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['brand_id', 'category_id']);
    });

    Schema::table('product_sizes', function (Blueprint $table) {
        $table->dropForeign(['product_id']);
    });

    Schema::table('product_stock', function (Blueprint $table) {
        $table->dropForeign(['product_id', 'size_id']);
    });

    //Categories
    Schema::table('categories', function (Blueprint $table) {
        $table->dropForeign(['parent_category_id']);
    });

    //Customers
    Schema::table('customers', function (Blueprint $table) {
        $table->dropForeign(['address_id']);
    });

    //Orders
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['address_id', 'coupon_id', 'customer_id']);
    });

    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['order_id', 'product_id']);
    });

    //Wishlists
    Schema::table('wishlists', function (Blueprint $table) {
        $table->dropForeign(['customer_id', 'product_id']);
    });
    }
};
