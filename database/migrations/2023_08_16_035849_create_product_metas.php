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
        Schema::create('product_metas', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->json('contents')->nullable();
            $table->json('descriptions')->nullable();
            $table->json('testing_notes')->nullable();
            $table->json('product_details')->nullable();
            $table->json('awards')->nullable();
            $table->json('product_descriptions')->nullable();
            $table->json('meta_urls')->nullable();
            $table->json('meta_titles')->nullable();
            $table->json('meta_descriptions')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
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
        Schema::dropIfExists('product_metas');
    }
};
