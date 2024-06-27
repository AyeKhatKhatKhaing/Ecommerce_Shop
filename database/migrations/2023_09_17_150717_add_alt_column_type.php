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
        Schema::table('blogs', function(Blueprint $table) {
            $table->string('blog_image_alt')->nullable()->after('blog_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->string('feature_image_alt')->nullable()->after('feature_image');
        });

        Schema::table('product_metas', function(Blueprint $table) {
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('homes', function(Blueprint $table) {
            $table->string('feature_image_alt')->nullable()->after('feature_image');
            $table->string('penfold_image_alt')->nullable()->after('penfold_image');
            $table->string('exclusive_image_alt')->nullable()->after('exclusive_image');
            $table->string('about_image_alt')->nullable()->after('about_image');
            $table->string('store_image_alt')->nullable()->after('store_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('about_remflies', function (Blueprint $table) {
            $table->string('banner_image_alt')->nullable()->after('banner_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('common_problems', function (Blueprint $table) {
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('term_conditions', function (Blueprint $table) {
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('privacy_policies', function (Blueprint $table) {
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('contact_pages', function (Blueprint $table) {
            $table->string('banner_image_alt')->nullable()->after('banner_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('member_exclusive_offers', function (Blueprint $table) {
            $table->string('banner_image_alt')->nullable()->after('banner_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('exclusive_offers', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->string('store_image_alt')->nullable()->after('store_image');
        });

        Schema::table('store_distributions', function (Blueprint $table) {
            $table->string('banner_image_alt')->nullable()->after('banner_image');
            $table->string('meta_image_alt')->nullable()->after('meta_image');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->string('banner_image_alt')->nullable()->after('banner_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            Schema::hasColumn('blogs', 'blog_image_alt') ? $table->dropColumn('blog_image_alt') : '';
            Schema::hasColumn('blogs', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('products', function (Blueprint $table) {
            Schema::hasColumn('products', 'feature_image_alt') ? $table->dropColumn('feature_image_alt') : '';
        });

        Schema::table('product_metas', function (Blueprint $table) {
            Schema::hasColumn('product_metas', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('homes', function (Blueprint $table) {
            Schema::hasColumn('homes', 'feature_image_alt') ? $table->dropColumn('feature_image_alt') : '';
            Schema::hasColumn('homes', 'penfold_image_alt') ? $table->dropColumn('penfold_image_alt') : '';
            Schema::hasColumn('homes', 'exclusive_image_alt') ? $table->dropColumn('exclusive_image_alt') : '';
            Schema::hasColumn('homes', 'about_image_alt') ? $table->dropColumn('about_image_alt') : '';
            Schema::hasColumn('homes', 'store_image_alt') ? $table->dropColumn('store_image_alt') : '';
            Schema::hasColumn('homes', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('about_remflies', function (Blueprint $table) {
            Schema::hasColumn('about_remflies', 'banner_image_alt') ? $table->dropColumn('banner_image_alt') : '';
            Schema::hasColumn('about_remflies', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('pages', function (Blueprint $table) {
            Schema::hasColumn('pages', 'image_alt') ? $table->dropColumn('image_alt') : '';
            Schema::hasColumn('pages', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('common_problems', function (Blueprint $table) {
            Schema::hasColumn('common_problems', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('term_conditions', function (Blueprint $table) {
            Schema::hasColumn('term_conditions', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('privacy_policies', function (Blueprint $table) {
            Schema::hasColumn('privacy_policies', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('contact_pages', function (Blueprint $table) {
            Schema::hasColumn('contact_pages', 'banner_image_alt') ? $table->dropColumn('banner_image_alt') : '';
            Schema::hasColumn('contact_pages', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('member_exclusive_offers', function (Blueprint $table) {
            Schema::hasColumn('member_exclusive_offers', 'banner_image_alt') ? $table->dropColumn('banner_image_alt') : '';
            Schema::hasColumn('member_exclusive_offers', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('exclusive_offers', function (Blueprint $table) {
            Schema::hasColumn('exclusive_offers', 'image_alt') ? $table->dropColumn('image_alt') : '';
        });

        Schema::table('stores', function (Blueprint $table) {
            Schema::hasColumn('stores', 'store_image_alt') ? $table->dropColumn('store_image_alt') : '';
        });

        Schema::table('store_distributions', function (Blueprint $table) {
            Schema::hasColumn('store_distributions', 'banner_image_alt') ? $table->dropColumn('banner_image_alt') : '';
            Schema::hasColumn('store_distributions', 'meta_image_alt') ? $table->dropColumn('meta_image_alt') : '';
        });

        Schema::table('menus', function (Blueprint $table) {
            Schema::hasColumn('menus', 'image_alt') ? $table->dropColumn('image_alt') : '';
        });

        Schema::table('sliders', function (Blueprint $table) {
            Schema::hasColumn('sliders', 'banner_image_alt') ? $table->dropColumn('banner_image_alt') : '';
        });
    }
};
