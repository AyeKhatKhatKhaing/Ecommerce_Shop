<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = collect([
            [
                'type'         => 'basic',
                'options'      => [
                    'en_law'      => 'According to Hong Kong law, it is not allowed to sell or supply intoxicating alcohol to minors in the course of business.',
                    'hant_law'    => '根據香港法律，不允許在業務過程中向未成年人出售或供應醉酒。',
                    'hans_law'    => '根据香港法律，不允许在业务过程中向未成年人出售或供应醉酒。',
                    'hk_whatsapp' => '',
                    'ma_whatsapp' => '',
                ],
                'created_date' => now(),
            ],
            [
                'type'         => 'currency',
                'options'      => [
                    'hk_rate' => 1,
                    'ma_rate' => 1.03,
                ],
                'created_date' => now(),
            ],
            [
                'type'         => 'contact',
                'options'      => [
                    'contact_email' => '',
                    'hk_phone'      => '',
                    'hk_email'      => '',
                    'ma_phone'      => '',
                    'ma_email'      => '',
                ],
                'created_date' => now(),
            ],
        ]);

        $datas->map(function ($data) {
            SiteSetting::create($data);
        });
    }
}
