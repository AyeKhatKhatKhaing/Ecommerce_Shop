<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_type_id')->nullable();
            $table->string('code')->nullable();
            $table->json('products')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->decimal('percent', 8, 2)->nullable();
            $table->string('coupon_type')->nullable();
            $table->enum('discount_type', ['amount', 'percentage'])->nullable();
            $table->integer('per_coupon')->nullable();
            $table->integer('per_coupon_usage')->default(0)->nullable();
            $table->integer('per_user')->nullable();
            $table->json('descriptions')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}
