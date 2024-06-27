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
        Schema::table('products', function(Blueprint $table) {
            $table->tinyInteger('is_other')->default(0)->nullable()->after('product_status');
        });

        Schema::table('categories', function(Blueprint $table) {
            $table->tinyInteger('is_other')->default(0)->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            Schema::hasColumn('products', 'is_other') ? $table->dropColumn('is_other') : '';
        });

        Schema::table('categories', function (Blueprint $table) {
            Schema::hasColumn('categories', 'is_other') ? $table->dropColumn('is_other') : '';
        });
    }
};
