<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeTerm;
use DB;
use Str;

class AttributeTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name_en'       => 'Vintage',
                'name_hans'     => '葡萄收获期',
                'name_hant'     => '葡萄收獲期',
                'slug'          => Str::slug('Vintage'),
                'created_date'  => now(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name_en'       => 'Bottle Size',
                'name_hans'     => '瓶子尺寸',
                'name_hant'     => '瓶子尺寸',
                'slug'          => Str::slug('Bottle Size'),
                'created_date'  => now(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name_en'       => 'Package Size',
                'name_hans'     => '封装尺寸',
                'name_hant'     => '封裝尺寸',
                'slug'          => Str::slug('Package Size'),
                'created_date'  => now(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('attribute_terms')->insert($datas);
    }
}
