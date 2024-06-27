<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_hant')->nullable();
            $table->string('name_hans')->nullable();
            $table->string('slug')->nullable();
            $table->json('descriptions')->nullable();
            $table->tinyInteger('is_percent')->default(0)->nullable();
            $table->decimal('percent', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::drop('offer_promotions');
    }
}
