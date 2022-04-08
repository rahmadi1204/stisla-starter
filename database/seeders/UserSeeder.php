<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'code' => 'developer',
                'name' => 'developer',
                'username' => 'dev',
                'email' => 'indesignplant@gmail.com',
                'password' => bcrypt(12041996),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'superadmin',
                'name' => 'superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@indesignplant.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'admin',
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@indesignplant.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
