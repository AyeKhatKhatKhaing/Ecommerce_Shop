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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id')->nullable();
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedInteger('coupon_history_id')->nullable();
            $table->string('code')->nullable();
            $table->string('location')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_amount', 8, 2)->nullable();
            $table->decimal('shipping_amount', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('payment_status')->nullable();
            $table->tinyInteger('order_status')->nullable();
            $table->tinyInteger('delivery_status')->nullable();
            $table->json('pickup_datas')->nullable();
            $table->json('billing_addresses')->nullable();
            $table->json('shipping_addresses')->nullable();
            $table->tinyInteger('is_email')->nullable();
            $table->datetime('created_date')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
