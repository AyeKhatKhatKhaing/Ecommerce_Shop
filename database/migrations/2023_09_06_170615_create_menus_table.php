<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedinteger('category_id')->nullable();
            $table->enum('type', ['category', 'promotion'])->nullable();
            $table->json('countries')->nullable();
            $table->json('promotions')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_hant')->nullable();
            $table->string('name_hans')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_hant')->nullable();
            $table->longText('description_hans')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('show_submenu')->default(0)->nullable();
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
        Schema::drop('menus');
    }
}
