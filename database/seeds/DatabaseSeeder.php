<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Encore\Admin\Auth\Database\AdminTablesSeeder::class);

        $this->call(ServiceStationSeed::class);
        $this->call(ServiceStationUserSeeder::class);
        $this->call(ClientSeed::class);
        $this->call(CarManufacturerSeed::class);
        $this->call(CarModelSeed::class);
        $this->call(ClientCarSeed::class);
        $this->call(ServiceStationClientSeed::class);
        
    }
}
