<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberExclusiveOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_exclusive_offers', function (Blueprint $table) {
            $table->id();
            $table->longText('tier_benefit_en')->nullable();
            $table->longText('tier_benefit_hant')->nullable();
            $table->longText('tier_benefit_hans')->nullable();
            $table->longText('work_en')->nullable();
            $table->longText('work_hant')->nullable();
            $table->longText('work_hans')->nullable();
            $table->json('notes')->nullable();
            $table->json('banner_titles')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('meta_titles')->nullable();
            $table->json('meta_descriptions')->nullable();
            $table->string('meta_image')->nullable();
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
        Schema::drop('member_exclusive_offers');
    }
}
