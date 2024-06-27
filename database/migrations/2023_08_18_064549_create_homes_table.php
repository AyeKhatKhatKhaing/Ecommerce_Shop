<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->increments('id');
            $table->json('feature_names')->nullable();
            $table->json('feature_titles')->nullable();
            $table->json('feature_descriptions')->nullable();
            $table->string('feature_link')->nullable();
            $table->string('feature_image')->nullable();
            $table->json('penfold_names')->nullable();
            $table->json('penfold_titles')->nullable();
            $table->json('penfold_descriptions')->nullable();
            $table->string('penfold_link')->nullable();
            $table->string('penfold_image')->nullable();
            $table->json('exclusive_titles')->nullable();
            $table->json('exclusive_descriptions')->nullable();
            $table->string('exclusive_link')->nullable();
            $table->string('exclusive_image')->nullable();
            $table->json('about_titles')->nullable();
            $table->json('about_descriptions')->nullable();
            $table->string('about_link')->nullable();
            $table->string('about_image')->nullable();
            $table->json('store_titles')->nullable();
            $table->json('store_descriptions')->nullable();
            $table->string('store_link')->nullable();
            $table->string('store_image')->nullable();
            $table->json('brand_logo')->nullable();
            $table->json('meta_titles')->nullable();
            $table->json('meta_descriptions')->nullable();
            $table->string('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::drop('homes');
    }
}
