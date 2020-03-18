<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarManufacturerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('car_manufacturers')->insert([
            'id' => 1,
            'name' => 'BMW',
            'image' => 'images/bmw_logo_PNG19714.png',
            'created_at' => '2020-03-18 07:05:34',
            'updated_at' => '2020-03-18 07:05:34',
        ]);
    }
}
