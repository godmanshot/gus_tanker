<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'id' => 1,
            'first_name' => 'Максим',
            'last_name' => 'Ли',
            'iin' => '990505301058',
            'phone' => '+7 222 2222222',
            'address' => 'г.Алматы ул.Айманова 70-16',
            'created_at' => '2020-03-18 05:30:53',
            'updated_at' => '2020-03-18 05:30:53'
        ]);
    }
}
