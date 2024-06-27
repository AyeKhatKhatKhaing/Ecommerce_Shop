<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_promotion_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('label_id')->nullable();
            $table->string('code')->nullable();
            $table->enum('type',['hk', 'ma'])->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_hant')->nullable();
            $table->string('name_hans')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->string('currency_type')->nullable();
            $table->decimal('original_price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->integer('sell_quantity')->default(0)->nullable();
            $table->integer('refill_quantity')->default(0)->nullable();
            $table->integer('min_stock_quantity')->default(0)->nullable();
            $table->json('recommendations')->nullable();
            $table->float('weight', 8, 2)->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('feature_image')->nullable();
            $table->integer('ordered_quantity')->nullable();
            $table->integer('ordered_count')->nullable();
            $table->integer('year')->nullable();
            $table->string('capacity')->nullable();
            $table->tinyInteger('is_exclusive')->default(0)->nullable();
            $table->tinyInteger('is_promotion')->default(0)->nullable();
            $table->integer('sort')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('product_status')->default(1)->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index(['name_en', 'name_hant', 'name_hans']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
