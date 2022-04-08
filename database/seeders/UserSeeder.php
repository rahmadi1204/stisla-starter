<?php

namespace Database\Seeders;

use Haruncpi\LaravelIdGenerator\IdGenerator;
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
        $id = IdGenerator::generate(['table' => 'users', 'field' => 'uid', 'length' => 6, 'prefix' => 'USR']);
        //output: P00001

        DB::table('users')->insert([
            [
                'uid' => $id,
                'code' => 'developer',
                'name' => 'developer',
                'username' => 'dev',
                'email' => 'indesignplant@gmail.com',
                'password' => bcrypt(12041996),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uid' => 'USR002',
                'code' => 'superadmin',
                'name' => 'superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@indesignplant.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uid' => 'USR003',
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
