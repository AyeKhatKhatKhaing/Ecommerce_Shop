<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_types', function (Blueprint $table) {
                $table->id();
                $table->string('name_en')->nullable();
                $table->string('name_hant')->nullable();
                $table->string('name_hans')->nullable();
                $table->json('descriptions')->nullable();
                $table->string('currency_type', 20)->nullable();
                $table->decimal('min_purchase_amount', 8, 2)->nullable();
                $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::drop('member_types');
    }
}
