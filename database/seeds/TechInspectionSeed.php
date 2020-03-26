<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechInspectionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tech_inspections')->insert([
            'id' => 1,
            'car_id' => 1,
            'client_id' => 1,
            'number_ti' => 1,
            'comment' => 'Замена клапана',
            'time_ti' => now(),
        ]);
    }
}
