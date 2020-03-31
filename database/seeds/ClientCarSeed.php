<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientCarSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_cars')->insert([
            'id' => 1,
            'model_id' => 1,
            'client_id' => 1,
            'year_manufacture' => '2020',
            'cylinders' => '8',
            'vin' => 'WAUZZZ44ZEN096063',
            'government_number' => '001 AAA 02',
            'body_number' => '221710В0214476',
            'chassis' => '231000В0102526',
            'data_sheet' => '015984',
            'auto_length' => 10000,
            'equipment' => 1,
            'state' => 1,
            'created_at' => '2020-03-18 07:10:27',
            'updated_at' => '2020-03-18 07:10:27',
        ]);
    }
}
