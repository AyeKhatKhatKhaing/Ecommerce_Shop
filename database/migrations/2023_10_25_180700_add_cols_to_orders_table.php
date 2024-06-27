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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('hk_change_amount', 12, 2)->default(0)->nullable()->after('total_amount');
            $table->decimal('currency_rate', 6, 2)->default(0)->nullable()->after('hk_change_amount');
            $table->string('lang_key', 10)->nullable()->after('currency_rate'); /* to check 3 languages condition in email/pdf after recon payment response */

            $table->index(['code', 'member_id', 'created_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('lang_key');
            $table->dropColumn('hk_change_amount');
            $table->dropColumn('currency_rate');

            $table->dropIndex(['code', 'member_id', 'created_date']);
        });
    }
};
