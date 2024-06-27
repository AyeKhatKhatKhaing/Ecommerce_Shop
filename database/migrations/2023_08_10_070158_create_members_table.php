<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
                $table->id();
                $table->string('code')->nullable();
                $table->integer('member_type_id')->nullable();
                $table->integer('country_id')->nullable();
                $table->integer('region_id')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->enum('account_type', ['individual', 'company'])->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('company')->nullable();
                $table->string('company_website')->nullable();
                $table->string('business_type')->nullable();
                $table->text('address')->nullable();
                $table->text('address_detail')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('password')->nullable();
                $table->string('remember_token')->nullable();
                $table->string('ip_address')->nullable();
                $table->integer('point')->nullable();
                $table->decimal('purchased_amount', 12, 2)->default(0); /* purchased amount need to increase after order success */
                $table->tinyInteger('is_term_condition')->nullable();
                $table->tinyInteger('is_marketing')->default(0);
                $table->tinyInteger('status')->default(1)->nullable();
                $table->date('dob')->nullable();
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
        Schema::drop('members');
    }
}
