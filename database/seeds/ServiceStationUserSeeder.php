<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceStationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_station_users')->insert([
            'service_station_id' => 1,
            'user_id' => 1,
        ]);
    }
}
