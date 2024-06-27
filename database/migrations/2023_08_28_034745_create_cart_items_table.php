<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\Translation\t;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->enum('type', ['hk', 'ma']);
            $table->string('product_name')->nullable();
            $table->string('product_image')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('amount')->default(0);
            $table->decimal('sub_total')->default(0);
            $table->boolean('is_auth')->default(false); // true - member login , false - cookie key
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
        Schema::dropIfExists('cart_items');
    }
};
