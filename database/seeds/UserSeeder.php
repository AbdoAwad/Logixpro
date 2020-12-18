<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "USER",
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'name' => "MANAGER",
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'name' => "GM",
            'email' => 'GM@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'name' => "CEO",
            'email' => 'CEO@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
       
    }
}
