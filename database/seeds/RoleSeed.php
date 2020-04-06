<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->insert([
            'id' => 2,
            'name' => "СТО",
            'slug' => "STO",
        ]);

        DB::table('admin_role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 1,
        ]);
        
    }
}
