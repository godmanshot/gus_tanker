<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceStationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_stations')->insert([
            'id' => 1,
            'name' => 'Главная СТО',
            'image' => 'ыфвфыв',
            'phone' => '+77076060461',
            'address' => 'Джандосова 69/6',
            'currency' => 'тг.',
            'timezone' => '+6',
            'created_at' => NULL,
            'updated_at' => NULL
        ]);
    }
}
