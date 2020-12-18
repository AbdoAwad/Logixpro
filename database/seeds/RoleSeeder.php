<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'user_type' => 'user',
            
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'user_type' => 'manager',
            
        ]);
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3,
            'user_type' => 'GM',
            
        ]);
        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 4,
            'user_type' => 'CEO',
            
        ]);
    }
}
