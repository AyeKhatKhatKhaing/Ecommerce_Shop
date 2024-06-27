<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('original_price', 12, 2)->default(0)->change();
            $table->decimal('sale_price', 12, 2)->default(0)->change();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('coupon_amount', 12, 2)->default(0)->change();
            $table->decimal('total_amount', 12, 2)->default(0)->change();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->default(0)->change();
            $table->decimal('sub_total', 12, 2)->default(0)->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('coupon_amount', 12, 2)->default(0)->change();
            $table->decimal('shipping_amount', 12, 2)->default(0)->change();
            $table->decimal('total_amount', 12, 2)->default(0)->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('unit_price', 12, 2)->default(0)->change();
            $table->decimal('sub_total', 12, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('original_price', 12, 2)->default(0)->change();
            $table->decimal('sale_price', 12, 2)->default(0)->change();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('coupon_amount', 12, 2)->default(0)->change();
            $table->decimal('total_amount', 12, 2)->default(0)->change();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->default(0)->change();
            $table->decimal('sub_total', 12, 2)->default(0)->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('coupon_amount', 12, 2)->default(0)->change();
            $table->decimal('shipping_amount', 12, 2)->default(0)->change();
            $table->decimal('total_amount', 12, 2)->default(0)->change();
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('unit_price', 12, 2)->default(0)->change();
            $table->decimal('sub_total', 12, 2)->default(0)->change();
        });
    }
};
