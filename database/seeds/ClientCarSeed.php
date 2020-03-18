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
        DB::table('cars')->insert([
            'id' => 1,
            'model_id' => 1,
            'client_id' => 1,
            'year_manufacture' => '2020',
            'cylinders' => '8',
            'vin' => 'gsdgsgfsdgrg',
            'government_number' => 'dfzdsgfsdgssdfg',
            'body_number' => 'ertgergergdfsgd453',
            'chassis' => '4dfste34r6354te',
            'data_sheet' => '4563rtgfdg345e45',
            'created_at' => '2020-03-18 07:10:27',
            'updated_at' => '2020-03-18 07:10:27',
        ]);
    }
}
