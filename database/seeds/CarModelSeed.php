<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_models')->insert([
            'id' => 1,
            'name' => 'X7',
            'manufacturer_id' => 1,
            'created_at' => '2020-03-18 07:05:34',
            'updated_at' => '2020-03-18 07:05:34',
        ]);
        DB::table('car_models')->insert([
            'id' => 2,
            'name' => 'X6',
            'manufacturer_id' => 1,
            'created_at' => '2020-03-18 07:05:34',
            'updated_at' => '2020-03-18 07:05:34',
        ]);
    }
}
