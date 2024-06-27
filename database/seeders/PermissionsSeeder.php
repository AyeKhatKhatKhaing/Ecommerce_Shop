<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();

        $data = [
            [
                'name'  => 'can_access_listing',
                'label' => 'Access Listing',
            ],
            [
                'name'  => 'can_access_create',
                'label' => 'Access Create',
            ],
            [
                'name'  => 'can_access_edit',
                'label' => 'Access Edit',
            ],
            [
                'name'  => 'can_access_delete',
                'label' => 'Access Delete',
            ],
            [
                'name'  => 'can_access_view',
                'label' => 'Access View',
            ],
            [
                'name'  => 'can_access_send',
                'label' => 'Access Send',
            ],
            [
                'name'  => 'can_access_export',
                'label' => 'Access Export',
            ],
            [
                'name'  => 'can_access_import',
                'label' => 'Access Import',
            ],
            [
                'name'  => 'can_access_dashboard',
                'label' => 'Access Dashboard',
            ],
            [
                'name'  => 'can_access_member_list',
                'label' => 'Access Member List',
            ],
            [
                'name'  => 'can_access_member_type',
                'label' => 'Access Member Type',
            ],
            [
                'name'  => 'can_access_business_type',
                'label' => 'Access Business Type',
            ],
            [
                'name'  => 'can_access_member_country',
                'label' => 'Access Member Country',
            ],
            [
                'name'  => 'can_access_hk_product',
                'label' => 'Access Hk Product',
            ],
            [
                'name'  => 'can_access_ma_product',
                'label' => 'Access Ma Product',
            ],
            [
                'name'  => 'can_access_other_product',
                'label' => 'Access Other Product',
            ],
            [
                'name'  => 'can_access_category',
                'label' => 'Access Category',
            ],
            [
                'name'  => 'can_access_attribute',
                'label' => 'Access Attribute',
            ],
            [
                'name'  => 'can_access_product_label',
                'label' => 'Access Product Label',
            ],
            [
                'name'  => 'can_access_promotion',
                'label' => 'Access Promotion',
            ],
            [
                'name'  => 'can_access_offer_promotion',
                'label' => 'Access Offer Promotion',
            ],
            [
                'name'  => 'can_access_country',
                'label' => 'Access Country',
            ],
            [
                'name'  => 'can_access_region',
                'label' => 'Access Region',
            ],
            [
                'name'  => 'can_access_classification',
                'label' => 'Access Classification',
            ],
            [
                'name'  => 'can_access_home',
                'label' => 'Access Home',
            ],
            [
                'name'  => 'can_access_page',
                'label' => 'Access Page',
            ],
            [
                'name'  => 'can_access_common_problem',
                'label' => 'Access Common Problem',
            ],
            [
                'name'  => 'can_access_term_and_condition',
                'label' => 'Access Term and Condition',
            ],
            [
                'name'  => 'can_access_privacy_policy',
                'label' => 'Access Privacy Policy',
            ],
            [
                'name'  => 'can_access_about_remfly',
                'label' => 'Access About Remfly',
            ],
            [
                'name'  => 'can_access_contact_us',
                'label' => 'Access Contact Us',
            ],
            [
                'name'  => 'can_access_contact_address',
                'label' => 'Access Contact Address',
            ],
            [
                'name'  => 'can_access_member_exclusive_offer',
                'label' => 'Access Memeber Exclusive Offer',
            ],
            [
                'name'  => 'can_access_exclusive_offer',
                'label' => 'Access Exclusive Offer',
            ],
            [
                'name'  => 'can_access_store',
                'label' => 'Access Store',
            ],
            [
                'name'  => 'can_access_store_distribution',
                'label' => 'Access Store Distribution',
            ],
            [
                'name'  => 'can_access_blog',
                'label' => 'Access Blog',
            ],
            [
                'name'  => 'can_access_blog_category',
                'label' => 'Access Blog Category',
            ],
            [
                'name'  => 'can_access_media_library',
                'label' => 'Access Media Library',
            ],
            [
                'name'  => 'can_access_hong_kong_order',
                'label' => 'Access Hong Kong Order',
            ],
            [
                'name'  => 'can_access_ma_order',
                'label' => 'Access Ma Order',
            ],
            [
                'name'  => 'can_access_coupon',
                'label' => 'Access Coupon',
            ],
            [
                'name'  => 'can_access_shipping',
                'label' => 'Access Shipping',
            ],
            [
                'name'  => 'can_access_store_pickup',
                'label' => 'Access Store Pickup',
            ],
            [
                'name'  => 'can_access_member_report',
                'label' => 'Access Member Report',
            ],
            [
                'name'  => 'can_access_product_report',
                'label' => 'Access Product Report',
            ],
            [
                'name'  => 'can_access_order_report',
                'label' => 'Access Order Report',
            ],
            [
                'name'  => 'can_access_subscription',
                'label' => 'Access Subscription',
            ],
            [
                'name'  => 'can_access_notification',
                'label' => 'Access Notification',
            ],
            [
                'name'  => 'can_access_contact_form_submission',
                'label' => 'Access Contact Form Submission',
            ],
            [
                'name'  => 'can_access_site_setting',
                'label' => 'Access Site Setting',
            ],
            [
                'name'  => 'can_access_header_menu',
                'label' => 'Access Header Menu',
            ],
            [
                'name'  => 'can_access_user',
                'label' => 'Access User',
            ],
            [
                'name'  => 'can_access_role',
                'label' => 'Access Role',
            ],
            [
                'name'  => 'can_access_permission',
                'label' => 'Access Permission',
            ],
            [
                'name'  => 'can_access_footer',
                'label' => 'Access Footer',
            ],
            [
                'name'  => 'can_access_slider',
                'label' => 'Access Slider',
            ],
        ];

        foreach ($data as $item) {
            Permission::create($item);
        }
    }
}
