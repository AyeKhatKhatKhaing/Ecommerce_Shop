<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommonProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_problems', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_hant')->nullable();
            $table->string('title_hans')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_hant')->nullable();
            $table->text('description_hans')->nullable();
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
        Schema::drop('common_problems');
    }
}
