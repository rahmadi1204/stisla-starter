<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::create([
            'uid' => 'APP1',
            'code' => 'aplikasi',
            'name' => 'Aplikasi 1',
            'desc' => 'Deskripsi Aplikasi 1',
            'email' => 'aplikasi@example.com',
            'phone' => '6285155099250',
            'address' => 'Maospati, Magetan, Jawa Timur',
            'logo' => 'logo.png',
        ]);
    }
}
