<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExclusiveOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exclusive_offers', function (Blueprint $table) {
            $table->id();
            $table->json('titles')->nullable();
            $table->json('descriptions')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->integer('sort')->nullable();
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
        Schema::drop('exclusive_offers');
    }
}
