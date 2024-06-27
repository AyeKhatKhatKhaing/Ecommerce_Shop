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
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->tinyInteger('score_rp')->nullable();
            $table->tinyInteger('score_ws')->nullable();
            $table->tinyInteger('score_jh')->nullable();
            $table->tinyInteger('score_bc')->nullable(); /* change to bc from ja */
            $table->tinyInteger('score_js')->nullable(); 
            $table->tinyInteger('score_bh')->nullable(); /* change to bh from jr */
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
        Schema::dropIfExists('product_ratings');
    }
};
