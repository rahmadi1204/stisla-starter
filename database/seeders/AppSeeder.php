<?php

namespace Database\Seeders;

use App\Http\Controllers\FormatterController;
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
        $name = 'Aplikasi Starter';
        App::create([
            'uid' => 'APP1',
            'code' => 'aplikasi',
            'name' => $name,
            'desc' => 'Deskripsi ' . $name,
            'email' => 'aplikasi@example.com',
            'phone' => '6285155099250',
            'address' => 'Maospati, Magetan, Jawa Timur',
            'logo' => 'logo.png',
        ]);
        $formatter = new FormatterController;
        $env_update = $formatter->changeEnv([
            'APP_NAME' => str_replace(' ', '_', $name),
        ]);
    }
}
