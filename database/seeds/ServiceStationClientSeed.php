<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceStationClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_station_clients')->insert([
            'id' => 1,
            'service_station_id' => 1,
            'client_id' => 1,
            'created_at' => '2020-03-18 05:30:53',
            'updated_at' => '2020-03-18 05:30:53'
        ]);
    }
}
