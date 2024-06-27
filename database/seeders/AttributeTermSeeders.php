<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class AttributeTermSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute_terms')->truncate();

        \App\Models\AttributeTerm::create([
            'id'         => 1,
            'name_en'    => 'Vintage',
            'name_hant'  => '葡萄收獲期',
            'name_hans'  => '葡萄收获期',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \App\Models\AttributeTerm::create([
            'id'         => 2,
            'name_en'    => 'Bottle Size',
            'name_hant'  => '瓶子尺寸',
            'name_hans'  => '瓶子尺寸',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \App\Models\AttributeTerm::create([
            'id'         => 3,
            'name_en'    => 'Package Size',
            'name_hant'  => '封裝尺寸',
            'name_hans'  => '封装尺寸',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
