<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $datas = collect([
            [
                'name_en'      => 'Red Wine',
                'name_hant'    => '紅葡萄酒',
                'name_hans'    => '红葡萄酒',
                'status'       => true,
                'sort'         => 1,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'White Wine',
                'name_hant'    => '白葡萄酒',
                'name_hans'    => '白葡萄酒',
                'status'       => true,
                'sort'         => 2,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'Whisky (OB)',
                'name_hant'    => '威士忌 (OB)',
                'name_hans'    => '威士忌 (OB)',
                'status'       => true,
                'sort'         => 3,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'Whisky (IB)',
                'name_hant'    => '威士忌 (IB)',
                'name_hans'    => '威士忌 (IB)',
                'status'       => true,
                'sort'         => 4,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'Cognac',
                'name_hant'    => '干邑',
                'name_hans'    => '干邑',
                'status'       => true,
                'sort'         => 5,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'Champagne',
                'name_hant'    => '香檳',
                'name_hans'    => '香槟',
                'status'       => true,
                'sort'         => 6,
                'created_date' => now(),
            ],
            [
                'name_en'      => 'Other Spirits',
                'name_hant'    => '其他烈酒',
                'name_hans'    => '其他烈酒',
                'status'       => true,
                'sort'         => 7,
                'created_date' => now(),
            ],
        ]);

        $datas->map(function($data) {
            Category::create($data);
        });
    }
}
