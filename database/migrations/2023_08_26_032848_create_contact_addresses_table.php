<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en')->nullable();
            $table->string('name_hant')->nullable();
            $table->string('name_hans')->nullable();
            $table->longText('address_en')->nullable();
            $table->longText('address_hant')->nullable();
            $table->longText('address_hans')->nullable();
            $table->longText('google_map')->nullable();
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
        Schema::drop('contact_addresses');
    }
}
