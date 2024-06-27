<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAboutRemfliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_remflies', function (Blueprint $table) {
            $table->id();
            $table->json('banner_titles')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_hant')->nullable();
            $table->text('description_hans')->nullable();
            $table->text('key_operation_en')->nullable();
            $table->text('key_operation_hant')->nullable();
            $table->text('key_operation_hans')->nullable();
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
        Schema::drop('about_remflies');
    }
}
